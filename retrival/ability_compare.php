<?php
    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
	mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
	/* �]��Ʈw�̥������ǥ� */
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
		// ��� professional ability ��ƪ� �� j_name ���
		$sql_2 = "SELECT DISTINCT `professional_ability`.j_name FROM `professional_ability`";
		$result_2 = mysql_query($sql_2);
		while($row = mysql_fetch_array($result_2, MYSQL_ASSOC)){
			foreach($row as $key => $value){
				$j_name_2 = $row['j_name'];			
			}	
			// ��� �H�ӤH������r�t��X���u�@�s�� ��X¾�~�W�٤ά�ئW��  select personal job and use 'like' to compare with `professioal_ability` 
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
				// �N�o�쪺�Ȧs�J�}�C��  put value into array
				array_push($compare, $j_name_2, $s_id, $subject_id, $j_id, $j_name);
			}
		}
		
		for($i = 0; $i < count($compare); $i+=5){
			$same = 0;
			$same_subNum = array();
			// ���X�ۦP��ئW�٪��A�N���Ӭ�ت�¾�ȦW�٨��X  compare same subject_name with select out key
			$sql = "SELECT DISTINCT pa.`subject_name` FROM `professional_ability` As pa where pa.`j_name`='" . $compare[$i] . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				foreach($row as $key => $value){
					$subject_name = $row['subject_name'];
					//echo "same : " . $subject_name . "<br/>";
				}	
				// �q��Ʈw��X��ئW�r�Arecord _score��subject��subject_id�ۦP  get persional study already class_name
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
			// �{���]�p�v -> A0028338 -> 41 -> 13258 -> ��`�{���]�p�v(R.D.-01) 
			// get single job must have to study subject total number 
			// �p���¾�ٻݭn��������׽�
			$sql_3 = "SELECT DISTINCT pa.`subject_name`, count(*) As pa_subNum FROM `professional_ability` AS pa WHERE pa.`j_name`='" . $compare[$i] . "'";
			$result_3 = mysql_query($sql_3);
			while($row = mysql_fetch_array($result_3, MYSQL_ASSOC)){
				$pa_subNum = $row['pa_subNum'];
			}
			if($pa_subNum > 0){ // �p�G�ݭn�ת���>0�A�p��X�ҵ{������
				//echo "pa_subNum: " . $pa_subNum . "<br/>";
				$ability_score = (int)($same/$pa_subNum*100); // �w�׹L�����/�ݭn�ת����
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