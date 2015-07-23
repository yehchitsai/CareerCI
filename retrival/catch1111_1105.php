<?php

# 引入這支檔案(下載來的)，可以取得 HTML DOM 物件
# 取得 DOM 後可以用類似 jQuery 的方式來取的 HTML 裡的內容
# http://xyz.cinc.biz/2012/10/phpphp-simple-html-dom-parser.html
# http://simplehtmldom.sourceforge.net/manual.htm
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
	echo "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>";
	$sql="SELECT `subject_url_1111` FROM `subject`";
	mysql_query($sql)or die ("無法查詢".mysql_error());

	$result = mysql_query($sql);
	
	$id_score = array();
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
        foreach ($row as $value){
            $id_score[]=(string)$value;
          	echo $value."</br>";
		}

    }
	$url = $id_score;
	$sql2="SELECT count(`j_id`) FROM `job_information`";
	$num=0;  
	$result2 = mysql_query($sql2);
    while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
        foreach ($row2 as $value2){
            echo $value2;
			$num=$value2;
		}
	}
for ($i = 50; $i < count($url); $i++) {

	
	# 取得 DOM 物件
	$htmlDOM = get_html_DOM($url[$i]);
	
	# 判斷到底有幾頁
	$pages = count($htmlDOM->find("#showPageChangeCss a"));
	$pages = $pages == 1 ? 1 : $pages - 1;
	# 印出所有工作機會
	for ($j = 1; $j <= 10; $j++) {
	
		$htmlDOM= get_html_DOM($url[$i]."&page=$j");
		echo ($i+1);
		$date = $htmlDOM->find("li.showDatechangeCss");
		$dname = $htmlDOM->find("li.showPositionCss");
	  	$dcon=$htmlDOM->find("li.showOrganCss");
		$dlocation = $htmlDOM->find("li.showWorkcityCss");
		
		# 取得每一份工作資料	
		for($k = 1; $k < count($date); $k++) {
			
			$d= $dname[$k]->find("a")[0];
			$jobData=$dname[$k]->href;
			$jobData = $d->href ;
			$e="http://www.1111.com.tw". $jobData;
			$da=$date[$k]->plaintext;
			$dn=$d->plaintext;
			$dl=$dlocation[$k]->plaintext;
			$dcone=$dcon[$k]->plaintext;
			/*
			echo  "<table border='1'>"."<tr>"."</td>"."<td align='center' width='80px'>".$date[$k]->innertext."</td>"."<td align='left' width='300px'>"."<a href='$e'>".$d->plaintext."</a>"."<br/>"."<p>".$dcon[$k]->plaintext."</p>"."</td>"."<td align='center' width='120px'>".$dlocation[$k]->innertext."</td>"."<td align='center' width='120px'>"."<input type='submit' value='加入追蹤'/>"."</td>"."</tr>"."</table>";
			*/
			# 印出公司介紹	
			
			$sql="INSERT INTO `job_information`(`subject_id`,`j_id`,`j_date`, `j_name`,`j_cname`, `j_address`,`j_url`,`j_source`)VALUES ('".($i+1)."','".(++$num)."','$da','$dn','$dcone','$dl','$e','1111')";
			mysql_query($sql)or die ("無法新增".mysql_error()); //執行sql語法
			
		}
	}
	 
}	
	
mysql_close($link);	