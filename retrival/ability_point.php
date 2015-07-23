<?php
    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
	mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
	//$sql_5 = "SELECT `student`.`s_id` FROM `student`";
	//$result_5 = mysql_query($sql_5);
	//while($row = mysql_fetch_array($result_5, MYSQL_ASSOC)){
		//foreach($row as $key => $value){
			//$s_id = $row['s_id'];			
		//}
		//$user_id = $s_id;
		$user_id = "A0028382";
		//echo $user_id . "<br/>";
		
		// 計算能力指標
		$sql_2 = "SELECT DISTINCT RS.`subject_id`, RS.`class_rank`, RS.`pNum`, JC.`j_id`, JC.`j_complete`, JC.`ability_point` "
		. " FROM `job_conform` As JC, `record _score` As RS "
		. " WHERE RS.`subject_id`=JC.`subject_id` AND RS.`s_id` = '$user_id'";
		$result_2 = mysql_query($sql_2);
		while($row = mysql_fetch_array($result_2, MYSQL_ASSOC)){
			foreach($row as $key => $value){
				$subject_id = $row['subject_id'];	
				$class_rank = $row['class_rank'];	
				$pNum = $row['pNum'];			
				$j_id = $row['j_id'];	
				$j_complete = $row['j_complete'];
			}
			if($j_complete == 0){ 
			// 如果課程完成度是0 -> 將(該科修課人數-該科排名)/該科修課人數*50%，最後總乘以2，得到百分比乘以100得到 98.XXX
				$point = (($pNum - $class_rank)/$pNum*0.5*2)*100;
			}
			else{
			// 將(該科修課人數-該科排名)/該科修課人數*50%
				$point = (($pNum - $class_rank)/$pNum*0.5 + $j_complete * 0.005)*100;
			}
			$Ipoint = (int)$point;
			$star = 0;
			if($Ipoint == 100){
				$star = 10;
			}
			else if($Ipoint < 100 && $Ipoint >= 90){
				$star = 9;
			}
			else if($Ipoint < 90 && $Ipoint >= 80){
				$star = 8;
			}
			else if($Ipoint < 80 && $Ipoint >= 70){
				$star = 7;
			}
			else if($Ipoint < 70 && $Ipoint >= 60){
				$star = 6;
			}
			else if($Ipoint < 60 && $Ipoint >= 50){
				$star = 5;
			}
			else if($Ipoint < 50 && $Ipoint >= 40){
				$star = 4;
			}
			else if($Ipoint < 40 && $Ipoint >= 30){
				$star = 3;
			}
			else if($Ipoint < 30 && $Ipoint >= 20){
				$star = 2;
			}
			else if($Ipoint < 20 && $Ipoint >= 10){
				$star = 1;
			}
			else if($Ipoint < 10 && $Ipoint >= 0){
				$star = 0;
			}
			$sql = "UPDATE `job_conform` SET `ability_point`=$star WHERE `s_id`='$user_id' AND `j_id`='$j_id'";
			$result = mysql_query($sql);
			echo $j_id . " -> " . $Ipoint . " -> " . $star . " star<br/>";
		}
		echo "----------------------------------------------------------------<br/>";
	//}
?>