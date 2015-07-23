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

	$link = mysql_connect("163.15.192.185","o9971","12345") or die("無法連接".mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971")or die ("無法選擇資料庫".mysql_error()); 
//找出上次抓取資料的日期
	$sql = "SELECT `retrivalDate` FROM `retrival_log` " . 
		" WHERE `type`='104' " . 
		" ORDER BY `retrival_log`.`retrivalDate`  DESC" . 
		" LIMIT 0 , 1";
	$result = mysql_query($sql)or die ("無法查詢".mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC)	;
	$lastDate = date('m/d', strtotime($row['retrivalDate']));
//	echo "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>";
	$sql="SELECT * FROM `subject` WHERE `subject_url_104` is not NULL";
	$result = mysql_query($sql)or die ("無法查詢".mysql_error());

	//找出所有課程資料
	$count=1;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$url[] = $row['subject_url_104'];
		$sid[] = $row['subject_id'];
		$sname[] = $row['subject_name'];
//		echo "${count}. ${row['subject_url_104']} ${row['subject_id']}</br>\n";
		$count++;
    }
	
	$sum=0;
	//依照課程來抓取資料
	for ($courseNum = 0; $courseNum < count($sid); $courseNum++) {
//	for ($courseNum = 5; $courseNum < 6; $courseNum++) {
		$count = 0;
		$pageNum = 1;
		$outofDate=false;
		for ($page = 1; $page <= $pageNum; $page++) {

			$htmlDOM= get_html_DOM($url[$courseNum]."&page=${page}");
			if($page==1) { //決定工作機會下載的頁數，超過十頁抓十頁，不足就以既有頁數為主
				$pages = count($htmlDOM->find(".box_page_top ul li a"));
				$pageNum = $pages < 10 ? $pages-1 : 10;
				echo "${sname[$courseNum]} pages number is $pageNum\n" ;
			}
	//		echo "pages number is $pageNum\n" ;		
	//		echo ($i+1);
	#		echo "URL = " . $url[2] . "&page=$j";
			# 印出公司介紹
			#由階層去判斷該怎麼抓取那一欄的值
			$date = $htmlDOM->find("div.date"); //刊登日期
			$dname = $htmlDOM->find("div.jobname_summary"); //工作名稱
			$dlocation = $htmlDOM->find("div.area_summary "); //公司地址
		  
			$dcon=$htmlDOM->find("div.compname_summary"); //公司名稱
			$dreq=$htmlDOM->find("div.requirement"); 
			$dinfor=$htmlDOM->find("div.joblist_summary");
			
			# 取得每一份工作資料，避免抓到標題，從1開始
			for($jobNum = 1;$jobNum < count($date); $jobNum++) {
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

				$sql="INSERT INTO `job_information`(`subject_id`, `j_date`, `j_name`, `j_cname`, `j_address`,`j_url`,`j_source`) VALUES ('". $sid[$courseNum] . "','$da','$dn','$dcone','$dl','$e','104')";

				mysql_query($sql)or die ("無法新增".mysql_error()); //執行sql語法
				$count++;
			} // end of jobNum
			if($outofDate==true)
				break;
		} //end of page
		$sql = "INSERT INTO `retrival_log` (`type`,`message`) VALUES ('104','insert $count jobs from ${sname[$courseNum]}')";
		$sum += $count; //加總所有的新增資料筆數
		mysql_query($sql)or die ("無法新增".mysql_error());
	}	//end of for courseNum 

	//傳送推播訊息
	$message = urlencode(mb_convert_encoding("新工作通知",'UTF-8',"UTF-8"));
	$info = urlencode(date("Y/m/d") . mb_convert_encoding(" 104 有 " . $sum . " 個新工作",'UTF-8',"UTF-8"));
	$geturl = "https://163.15.192.185/career/index.php/mobile/sendMsg?" . "sender=system&level=job&message=${message}&info=" . $info;
/*
//check the charset 
	foreach(mb_list_encodings() as $chr){ 
			echo mb_convert_encoding($geturl, 'UTF-8', $chr)." : ".$chr."<br>";    
	} 	
*/
	$headers = array (
		"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36",
		"Cache-control: max-age=0",
		"Accept-Language: zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4"
	);	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $geturl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Get the response and close the channel.
	$response = curl_exec($ch);
	echo "$geturl \n";
	echo $response;
	curl_close($ch);
	
	mysql_close($link);	
	