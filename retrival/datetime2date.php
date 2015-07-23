<?php
/*
	$link = mysql_connect("163.15.192.185","o9971","12345") or die("無法連接".mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971")or die ("無法選擇資料庫".mysql_error()); 
	$sql = "SELECT `retrivalDate` FROM `retrival_log` " . 
		" WHERE `type`='104' " . 
		" ORDER BY `retrival_log`.`retrivalDate`  DESC" . 
		" LIMIT 0 , 1";
	$result = mysql_query($sql)or die ("無法查詢".mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC)	;
	$lastDate = date('m/d', strtotime($row['retrivalDate']));
	echo  "$lastDate\n";
	echo date("Y/m/d");	
*/	
/*
	$text = "新工作通知";
	foreach(mb_list_encodings() as $chr){ 
			echo mb_convert_encoding($text, 'UTF-8', $chr)." : ".$chr."<br>";    
	} 
*/
//	$encoding = mb_detect_encoding( "新工作通知", "auto" );

//	echo $encoding . "\n";
/*
	$message = urlencode(mb_convert_encoding("新工作通知",'UTF-8',"BIG-5"));
	$info = date("Y/m/d") . " 104 有 100 個新工作";
	$geturl = "https://163.15.192.185/career/index.php/mobile/sendMsg?" . "sender=system&level=job&message=${message}&info=100 jobs from 104";
*/
	$sum = 100;
	
	$message = urlencode(mb_convert_encoding("新工作通知",'UTF-8',"BIG-5"));
	$info = urlencode(date("Y/m/d") . mb_convert_encoding(" 104 有 " . $sum . " 個新工作",'UTF-8',"BIG-5"));
	$geturl = "https://163.15.192.185/career/index.php/mobile/sendMsg?" . "sender=system&level=job&message=${message}&info=" . $info;
	

	$headers = array (
	"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36",
	"Cache-control: max-age=0",
	"Accept-Language: zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4"
//	"Cookie: ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%2274d6c2586d9b106cde38f807c8de5e5c%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%22125.227.226.79%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A109%3A%22Mozilla%2F5.0+%28Windows+NT+6.3%3B+WOW64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F38.0.2125.104+Safari%2F537.36%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1415340073%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D220e21cd8112b65ae0927f0aaef7e4bc"
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
//	echo $response;

	curl_close($ch);
?>