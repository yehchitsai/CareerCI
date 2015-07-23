<?php
    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
	mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
	/* 跑資料庫裡全部的學生 */
	$sql_5 = "SELECT `student`.`s_id` FROM `student`";
	$result_5 = mysql_query($sql_5);
	while($row = mysql_fetch_array($result_5, MYSQL_ASSOC)){
		foreach($row as $key => $value){
			$s_id = $row['s_id'];			
		}
	
		$user_id = $s_id;
		//echo $user_id . "<br/>";
		//$user_id = "A0028338";
		//$user_id = "A0028352";
		//$user_id = "A0028382";
		
		$compare = array();
		// 選擇 professional ability 資料表 的 j_name 欄位
		$sql_2 = "SELECT DISTINCT `professional_ability`.j_name FROM `professional_ability`";
		$result_2 = mysql_query($sql_2);
		while($row = mysql_fetch_array($result_2, MYSQL_ASSOC)){
			foreach($row as $key => $value){
				$j_name_2 = $row['j_name'];			
			}	
			// 選擇 以個人的關鍵字配對出的工作編號 對出職業名稱及科目名稱  select personal job and use 'like' to compare with `professioal_ability` 
			$sql  = "SELECT JC.s_id, JC.subject_id, JC.j_id, JI.j_name "  
			. " FROM `job_conform` AS JC, `job_information` AS JI "
			. " WHERE JC.s_id='$user_id'  AND JI.j_id=JC.j_id "
			. " AND JC.subject_id=JI.subject_id AND JI.`j_name` like '%$j_name_2%'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				foreach($row as $key => $value){
					$s_id = $row['s_id'];
					$subject_id = $row['subject_id'];
					$j_id = $row['j_id'];
					$j_name = $row['j_name'];
				}	
				// 將得到的值存入陣列中  put value into array
				array_push($compare, $j_name_2, $s_id, $subject_id, $j_id, $j_name);
			}
		}
		
		for($i = 0; $i < count($compare); $i+=5){
			$same = 0;
			$same_subNum = array();
			// 比對出相同科目名稱的，將有該科目的職務名稱取出  compare same subject_name with select out key
			$sql = "SELECT DISTINCT pa.`subject_name` FROM `professional_ability` As pa where pa.`j_name`='" . $compare[$i] . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				foreach($row as $key => $value){
					$subject_name = $row['subject_name'];
					//echo "same : " . $subject_name . "<br/>";
				}	
				// 從資料庫選出科目名字，record _score跟subject的subject_id相同  get persional study already class_name
				$sql_2 = "SELECT s.`subject_name` FROM `record _score` As rs, `subject` As s WHERE rs.`s_id` = '$user_id' AND rs.`subject_id` = s.`subject_id`";
				$result_2 = mysql_query($sql_2);
				while($row = mysql_fetch_array($result_2, MYSQL_ASSOC)){
					$subject_name_2 = $row['subject_name'];	
					if($subject_name == $subject_name_2){
						$same++;
						//echo $subject_name . " -> " . $subject_name_2 . " -> " . $same . "<br/>";
					}
				}
			}
			//echo $same . "<br/>";
			$ability_score = 0;
			// 程式設計師 -> A0028338 -> 41 -> 13258 -> 資深程式設計師(R.D.-01) 
			// get single job must have to study subject total number 
			// 計算該職稱需要完成什麼修課
			$sql_3 = "SELECT DISTINCT pa.`subject_name`, count(*) As pa_subNum FROM `professional_ability` AS pa WHERE pa.`j_name`='" . $compare[$i] . "'";
			$result_3 = mysql_query($sql_3);
			while($row = mysql_fetch_array($result_3, MYSQL_ASSOC)){
				$pa_subNum = $row['pa_subNum'];
			}
			if($pa_subNum > 0){ // 如果需要修的課>0，計算出課程完成度
				//echo "pa_subNum: " . $pa_subNum . "<br/>";
				$ability_score = (int)($same/$pa_subNum*100); // 已修過的科目/需要修的科目
				//echo "ability_score: " . $ability_score . "<br/>";
				
				// compare same j_name and update j_complete
				$sql = "SELECT JC.s_id, JC.subject_id, JC.j_id, JI.j_name, JC.j_complete FROM `job_conform` AS JC, `job_information` AS JI WHERE JC.s_id='$user_id' AND JI.j_id=JC.j_id AND JC.subject_id=JI.subject_id AND JI.j_name='" . $compare[$i+4] . "'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					foreach($row as $key => $value){
						$j_id = $row['j_id'];
					}
					//echo $j_id . "<br/>";
					
					$sql = "UPDATE `job_conform` SET `j_complete`=$ability_score WHERE `j_id`=$j_id";
					$result = mysql_query($sql);
				}
			}
			
			//echo "------------------------------------------------------------------------------------------------------------<br/>";
		}
	}
?>