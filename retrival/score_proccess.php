<?php 
	$time_start = microtime(true);
	$link = mysqli_connect("163.15.192.201","a0128307","1234") or die("無法連接".mysql_error());  
	mysqli_query($link,"set names 'utf8'");
	mysqli_select_db($link,"career")or die ("無法選擇資料庫".mysql_error()); 
	$stu_name=array();
	$jt_id=array();
	$count=0;
	$x=0;
	//query student
	$sql = "SELECT s_id FROM `student`";
    $result = mysqli_query($link,$sql) or die('MySQL query error');    
    while($row = mysqli_fetch_assoc($result))
    {
    	$stu_name[$x]=$row["s_id"]; 
    	$x++;
    }
    //query job title
    $sql = "SELECT jt_id FROM `job_title`";
    $result = mysqli_query($link,$sql) or die('MySQL query error'); 
    $x=0;   
    while($row = mysqli_fetch_assoc($result))
    {
    	$jt_id[$x]=$row["jt_id"]; 
    	$x++;
    }
    //query 
    for ($i=0; $i < sizeof($stu_name); $i++) { 
    	$temp_stu=$stu_name[$i];
    	for ($j=0; $j < sizeof($jt_id); $j++) { 
    		$temp_job=$jt_id[$j];
    		//已修課程
    		$sql="SELECT count(*) as val FROM `professional_subject` INNER JOIN `subject` ON professional_subject.subject_name=subject.subject_name INNER JOIN `student_subject` ON subject.subject_id=student_subject.subject_id WHERE `jt_id`='".$temp_job."' AND student_subject.s_id='".$temp_stu."'";
			$result = mysqli_query($link,$sql) or die('MySQL query error' .mysql_error());
			$row=mysqli_fetch_assoc($result);
			$t1v=$row['val'];
			//所有建議課程總數
			//
			$sql="SELECT count(*) as val FROM `professional_subject` WHERE `jt_id`='".$temp_job."'";
			$result = mysqli_query($link,$sql) or die('MySQL query error'.mysql_error());
			$row=mysqli_fetch_assoc($result);
			$t2v=$row["val"];
				$proccess=($t1v/$t2v)*30;//課程完成度
			//
			$sql="SELECT round(sum((student_subject.pNum-student_subject.class_rank+1)/student_subject.pNum)/count(*)*30,0) as val FROM `professional_subject` INNER JOIN `subject` ON professional_subject.subject_name=subject.subject_name INNER JOIN `student_subject` ON subject.subject_id=student_subject.subject_id WHERE `jt_id`='".$temp_job."' AND student_subject.s_id='".$temp_stu."'";
			$result = mysqli_query($link,$sql) or die('MySQL query error'.mysql_error());
			$row=mysqli_fetch_assoc($result);
				$t3v=$row["val"];//職稱修課成績
			//
			$sql="SELECT (case when sum(license.value)>100 then 30 else sum(license.value)*0.3 end) as val FROM `student_license` INNER JOIN `license` ON student_license.l_id=license.l_id WHERE `s_id`='".$temp_stu."'";
			$result = mysqli_query($link,$sql) or die('MySQL query error'.mysql_error());
			$row=mysqli_fetch_assoc($result);
				$t4v=$row["val"];//證照積分
			$total=$proccess+$t3v+$t4v;
			$sql="INSERT INTO `ability`(`s_id`, `jt_id`, `rec_subject`, `l_score`, `rank_score`, `total`) VALUES ('".$temp_stu."','".$temp_job."','".$proccess."','".$t4v."','".$t3v."','".$total."')";
    		$result = mysqli_query($link,$sql) or die('MySQL query error'.mysql_error());
    		if ($result) {
    			$count++;
    		}
    	}
    }
    $time_end = microtime(true);
	$time = $time_end - $time_start;
    echo "success INSERT ".$count." data used time".$time;
    
    mysqli_close ($link);
 ?>
