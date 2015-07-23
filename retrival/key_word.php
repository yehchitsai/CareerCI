<?php
    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
    mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
/*1.---------- print table(record _score) data with order by class_rank ----------*/   
    /*
    $sql="SELECT `record _score`.s_id, `record _score`.year, `record _score`.semester, `record _score`.subject_id, `record _score`.subject_score, `record _score`.class_rank, `subject`.subject_id, `subject`.subject_name FROM `record _score`, `subject` WHERE `record _score`.s_id='A0028382' AND `subject`.subject_id=`record _score`.subject_id ORDER BY `record _score`.class_rank";

	$result = mysql_query($sql);

    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		foreach($row as $key => $value){
			$s_id = $row['s_id'];
			$year = $row['year'];
			$semester = $row['semester'];
			$subject_id = $row['subject_id'];
			$subject_name = $row['subject_name'];
			$subject_score = $row['subject_score'];
			$class_rank = $row['class_rank'];
            
		}
        echo $s_id."->".$year."->".$semester."->".$subject_id."->".$subject_name."->".$subject_score."->".$class_rank."<br/>";
    }*/
    

/*2.---------- get people number in class ----------*/
    $subjectNum=0;
	// 計算有多少科目
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
        //計算科目有多少人修課
        $sql="SELECT `record _score`.subject_id, `record _score`.subject_id, `subject`.subject_name, count(*) As pNum FROM `record _score`,`subject` WHERE `subject`.subject_id=".$i." AND `subject`.subject_id=`record _score`.subject_id";

        $result = mysql_query($sql);
        
        while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            foreach($row as $key => $value){
                $subject_id = $i;
                $subject_name = $row['subject_name'];
                $pNum = $row['pNum'];
            }
        }
        //echo $subject_id.". ".$subject_name."->".$pNum."人<br/>";
        //$pNumAry[$i*2]=$subject_id;
        //$pNumAry[$i*2+1]=$pNum;
        $pNumAry[$subject_id*2]=$subject_id; //a[2]=1    a[4]=2
        $pNumAry[$subject_id*2+1]=$pNum;     //a[3]=39   a[5]=39
        //echo $subject_name."->".$pNum."人<br/>";
        //echo "array: 編號 ".$pNumAry[$i*2]." ... ".$pNumAry[$i*2+1]."人<br/>";
    }


/*3.---------- sort  1.class-rank,  2.year  3.semester  4.classPeopleNum -> get personal keyword ----------*/
	// 取得學生ID
	$sql="SELECT `student`.s_id FROM `student`";
	$result = mysql_query($sql);
	$student = array();
	$stu = 0;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		foreach($row as $key => $value){
			$s_id = $row['s_id'];
		}
		$student[$stu] = $s_id;
		$stu++;
	}
	
	
	$get = 0;
	for($num = 0; $num<count($student); $num++){	
		$get++;
		echo "<br/>".$get."<br/>";
		
		/*---------- get keyword ----------*/
		// 取得學生的單科成績修課排名、學年、學期，第一排名:單科成績修課排名由低至高、第二排名:學年由高至低、第三排名:學期由高學期先，並且取出前三個
		$sql="SELECT `record _score`.s_id, `record _score`.year, `record _score`.semester, `record _score`.subject_id, `record _score`.subject_score, `record _score`.class_rank FROM `record _score` WHERE `record _score`.s_id='".$student[$num]."' ORDER BY `record _score`.class_rank asc, `record _score`.year desc, `record _score`.semester desc limit 3";
		//$sql="SELECT `record _score`.s_id, `record _score`.year, `record _score`.semester, `record _score`.subject_id, `record _score`.subject_score, `record _score`.class_rank FROM `record _score` WHERE `record _score`.s_id='A0028338' ORDER BY `record _score`.class_rank asc, `record _score`.year desc, `record _score`.semester desc limit 3";
		
		$result = mysql_query($sql);
		$studentKeyAry = array();
		$m = 0;
		echo "<table border=1>";
		echo "<tr><td>學號</td><td>學年</td><td>學期</td><td>課程編號</td><td>成績</td><td>排名</td><td>班級人數</td></tr>";
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			foreach($row as $key => $value){
				$s_id = $row['s_id'];
				$year = $row['year'];
				$semester = $row['semester'];
				$subject_id = $row['subject_id'];
				$subject_score = $row['subject_score'];
				$class_rank = $row['class_rank'];
			}
			$studentKeyAry[$m] = $subject_id;
			$m++;
			echo "<tr><td>".$s_id."</td><td>".$year."</td><td>".$semester."</td><td>".$subject_id."</td><td>".$subject_score."</td><td>".$class_rank."</td><td>".$pNumAry[$subject_id*2+1]."</td></tr>";
			//echo $s_id." -> ".$subject_id."<br/>";
		}
		echo "</table>";
		
		/*---------- get job_id and insert into table`job_conform` with everyone's keyword, job_id ----------*/
		// 將每一個人取得的關鍵字及職稱ID 新增到job_conform資料表裡
		for($k = 0; $k < 3; $k++){
			$sql="SELECT `j_id` FROM `job_information` where `subject_id`=".$studentKeyAry[$k];
			$result = mysql_query($sql);
			//$jobIdAry = array();
			//$b = 0;
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				foreach($row as $key => $value){
					$j_id = $row['j_id'];
				}
				//$jobIdAry[$b] = $j_id;
				//$b++;
				//echo $studentKeyAry[$k]." -> ".$j_id."<br/>";
				$sql_2="INSERT INTO `job_conform`(`s_id`, `subject_id`, `j_id`) VALUES ('".$s_id."','".$studentKeyAry[$k]."','".$j_id."')";
				$result_2 = mysql_query($sql_2);
			}
		}
	}

?>