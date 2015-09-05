<?php

# 引入這支檔案(下載來的)，可以取得 HTML DOM 物件
# 取得 DOM 後可以用類似 jQuery 的方式來取的 HTML 裡的內容
# http://xyz.cinc.biz/2012/10/phpphp-simple-html-dom-parser.html
# http://simplehtmldom.sourceforge.net/manual.htm
/*
Modified by Yeh 2014/11/5
 - 修改資料表 job_information, add a field `update` as timestamp, modified j_id as primary key and integer, subject_id as integer
 - 只找subject_url_104有資料的科目
 - 直接找尋10頁資料
 */
require_once('simple_html_dom.php');

# 直接使用網址取得 DOM 物件
function get_html_DOM($url) {

	return file_get_html($url);
}

# 先用 curl 抓取成文字，再轉換成 DOM 物件
# 有些網頁抓取需要調整 curl_setopt 內容時可使用
function get_html_DOM_byCurl($url) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($ch);
	curl_close($ch);
	
	return str_get_html($output);
}
//連結資料庫
	$link = mysql_connect("163.15.192.201","a0128307","1234") or die("無法連接".mysql_error());  
	mysql_query("set names 'utf8'");
	mysql_select_db("career")or die ("無法選擇資料庫".mysql_error()); 

//從資料庫讀取職稱 放入陣列jt
	$jt; $jtitle;
	$sql = "SELECT * FROM `job_title` ORDER BY `jt_id` ASC ;";
    $result = mysql_query($sql) or die('MySQL query error');    
    while($row = mysql_fetch_array($result))
    {
    //	$jtitle[]=$row['title'];
    	$jt[]=urlencode($row['title']) ; //將title欄位編碼後放入陣列
    }
 /*   for($i=0 ; $i< count($jt) ; $i++)
    {
    	echo $jtitle[$i] . "\n";
    }
*/
	$pageNum = 1;
	for($id=0 ; $id<count($jt) ; $id++)
	{
	//echo "http://www.104.com.tw/jobbank/joblist/joblist.cfm?jobsource=n104bank1&ro=0&keyword=".$jt[$id-1]."&order=2&asc=0&page=${page} \n";
		$c=$id+1;
		for($page=1; $page<=$pageNum;$page++)
		{
			$htmlDOM= get_html_DOM("http://www.104.com.tw/jobbank/joblist/joblist.cfm?jobsource=n104bank1&ro=0&keyword=".$jt[$id]."&order=2&asc=0&page=${page}");
			
			if($page==1) 
			{ //決定工作機會下載的頁數，超過十頁抓十頁，不足就以既有頁數為主
				$pages = count($htmlDOM->find(".box_page_top ul li a"));
				if($page==0)
				{ //有時會抓取頁數會為0 當為0時重新抓取 當連續5次為0時跳出
					$j=1;
					do{
						$pages = count($htmlDOM->find(".box_page_top ul li a"));
						$j++;
					}while($pages>0 || $j==5);
				}
				$pageNum = $pages < 10 ? $pages : 10;
			//	echo "${sname[$courseNum]} pages number is $pageNum\n" ;
			}
			$dname = $htmlDOM->find("div.jobname_summary"); //工作名稱
			$dcon=$htmlDOM->find("div.compname_summary"); //公司名稱
			$dlocation = $htmlDOM->find("div.area_summary "); //公司地址
			$date = $htmlDOM->find("div.date"); //刊登日期
			for($jobNum = 1;$jobNum < count($date); $jobNum++) 
			{
				$da=trim($date[$jobNum]->plaintext);
				if($da == "")//避免抓到焦點職缺，因為焦點職缺與關鍵字無關，且無日期
					continue;
				if($da == $lastDate){ //只新增新工作，先前的工作就不考慮
					$outofDate=true;
					break;
				}
	//			echo $da;
				$dn=trim($dname[$jobNum]->plaintext);
				$dl=trim($dlocation[$jobNum-1]->plaintext);
	//			echo "dname $jobNum - " . $dn . "\n";
				$d = $dname[$jobNum]->find("a");
				$d = $d[0];
				$dcname=$dreq[$jobNum]->innertext;
				$dcone=trim($dcon[$jobNum-1]->plaintext);
				//$jobData=$dnkame[$j]->href;
				$jobData = trim($d->href) ;
				$e="http://www.104.com.tw" . $jobData;
				$sql="INSERT INTO `job_information` (`j_id`, `jt_id`, `j_name`, `j_cname`, `j_address`,`j_setdate`,`j_update`,`j_url`)  VALUES ('null','".$c."','$dn','$dcone','$dl','$da',NOW(),'$e')";
				echo $sql ."\n";
				
				mysql_query($sql)or die ("無法新增".mysql_error());

			}   
			sleep(5); //設定休息時間
		}	
		
		echo  $c."  ".count($htmlDOM->find(".box_page_top ul li a"))."  ".$pageNum . "\n";  
	}

//	echo $htmlDOM , "\n";

//	echo $pages = count($htmlDOM->find("#box_page_top ul li a")) , "\n";

//	echo "http://www.104.com.tw/jobbank/joblist/joblist.cfm?jobsource=n104bank1&keyword=". $jt[0] ."&order=2&asc=0&page=1";



	mysql_close($link);	
?>