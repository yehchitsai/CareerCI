<?php

    echo "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>";

    //mysql_connect('163.15.192.185', 'o9971', '12345') or die("Could not connect: " . mysql_error());
    mysql_connect('127.0.0.1', 'o9971', 'o9971') or die("Could not connect: " . mysql_error());
	mysql_query("set names 'utf8'");
	mysql_select_db("o9971");
	
    $subjectNum=0;
	// 算全部科目有多少
    $sql="SELECT count(`subject_id`) FROM `subject`";	
	$result = mysql_query($sql);
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
        foreach ($row as $value){
            //echo $value;
            $subjectNum = $value;
		}
    }
    
	//
    for($m=1;$m<=$subjectNum;$m++){
    //subject 科目->subject_id    record _score->s_id  year  semester  subject_id  subject_score 
	// 從 record _score 資料表 選出 每個科目的學生id與分數，並該科分數由高至低排序
        $sql="SELECT `record _score`.s_id, `record _score`.subject_score FROM `record _score` WHERE `record _score`.subject_id=".$m." ORDER BY `record _score`.subject_score desc";

        $result = mysql_query($sql);
        $id_score = array();
        while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            foreach ($row as $value){
                $id_score[]=$value; // id  score 將學生id與分數存數陣列中
                //echo $value;
            }
        }

        $i=count($id_score);
        $rank=1;
		//將分數由高至低排出排名，因陣列的偶數存放學生id，奇數存放分數
        for($j=1; $j<=$i-1; $j+=2){
            if($j>=3){
                if($id_score[$j]==$id_score[$j-2]){ //假如接下來的分數跟上一個的分數一樣，那就是相同排名
                    $rank = $rank;
                }
                else{ // 分數不同，就將陣列索引值除以2+1得到排名，第二個人:3/2+1=2，第三個人:5/2+1=3
                    $rank=(int)($j/2+1);
                }
            }


            //echo $m."=>".$id_score[$j-1]."=>".$id_score[$j]."=>".$rank.'<br>';
            //echo $id_score[$j-1]."=>".$id_score[$j]."=>".$rank.'<br>';

			//將排名更新到record _score 資料表裡
            mysql_select_db("o9971");
            $sql="UPDATE `record _score` SET `record _score`.class_rank=".$rank." WHERE `record _score`.s_id='".$id_score[$j-1]."' AND `record _score`.subject_id=".$m;

            $result = mysql_query($sql);

        }
    }
	

?>