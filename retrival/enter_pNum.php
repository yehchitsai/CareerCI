<?php
    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
    mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
	$subjectNum=0;
	$sql="SELECT count(`subject_id`) FROM `subject`";	
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		foreach ($row as $value){
			//echo $value;
			$subjectNum = $value;
		}
	}
	$pNumAry = array();
	for($i=1; $i<=$subjectNum; $i++){
		// 將subject、record _score資料表的subject_id互相對照
		$sql="SELECT `record _score`.subject_id, `record _score`.subject_id, count(*) As pNum FROM `record _score`,`subject` WHERE `subject`.subject_id=".$i." AND `subject`.subject_id=`record _score`.subject_id";
		//$sql="SELECT `record _score`.subject_id, `record _score`.subject_id, `subject`.subject_name, count(*) As pNum FROM `record _score`,`subject` WHERE `subject`.subject_id=".$i." AND `subject`.subject_id=`record _score`.subject_id";

		$result = mysql_query($sql);
		
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			foreach($row as $key => $value){
				$subject_id = $i;
				//$subject_name = $row['subject_name'];
				$pNum = $row['pNum'];
			}
			// 依照subject_id 給予其修課人數
			$sql_2="UPDATE `record _score` SET `pNum`= ".$pNum." WHERE `subject_id`=".$subject_id;
			$result = mysql_query($sql_2);
		}
		echo $subject_id." -> ".$pNum."<br/>";
	}
	
?>

