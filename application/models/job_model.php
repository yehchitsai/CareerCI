<?php
class Job_model extends CI_Model {

	public function __construct()
	{
	}
	function getJobs($id,$date,$page)
	{
		$condition = " `s_id`='$id' ";
		$limit = 10;
		$offset = ($page-1)*$limit;
		if($date!=false)
			$condition = "$condition AND j_date='$date'";
		$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` " . 
			" FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` " . 
			" WHERE $condition Limit ${limit} OFFSET ${offset} ";
		$result = $this->db->query($sql);
		//echo $sql;
		return $result->result_array();
	}	 
	
	function getTitle()
	{
		$id = $this->session->userdata('user_id');
		$sql ="SELECT jt_name FROM `job_title`";
		$result = $this->db->query($sql);
		$num=0;
		$data=array();
		$temp;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$temp[$num]=$row['jt_name'];
			$num++;
		}
		for ($i=0; $i < $temp.length ; $i++) { //職業類型query
			$jt=$temp[$i]->jt_name;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$data[$num]->"jt_name"=$row['jt_name'];
			$num++;
		}
		for ($i=0; $i < $data.length ; $i++) { //職業類型query
			$jt=$data[$i]->jt_name;
			//課程完成度
			$learned=learn_progress($jt,$id);
			//職業類型
			$score=jt_board($jt,$id);
			//證照成績
			$l_score=license_board($id);
			$sum=100-($learned+$score+$l_score);
			$obj=array("jt_name"=>$jt , "score"=>$sum);
			$data[$i]=$obj;
			$data[$i]->"score"=$sum;
		}
		return $data;
	}
	
	function getjob(){
		$id=$_POST["id"];
		mysql_query("set names 'utf8'");
		$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where `s_id`='$id' Limit ${limit} OFFSET ${offset}";
		//$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where `s_id`='A0028338 Limit 10'";
		mysql_query($sql)or die ("無法查詢".mysql_error());
		$result = mysql_query($sql);
		
		/*
		echo "<table border=1 align=center>";
		echo "<tr><td>能力指標</td><td>日期</td><td>職務名稱</td><td>地區</td><td>加入追蹤</td></tr>";
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			
			foreach($row as $key => $value){
				$j_complete = $row['j_complete'];
				$j_date = $row['j_date'];
				$j_name = $row['j_name'];
				$j_cname = $row['j_cname'];
				$j_address = $row['j_address'];
				$j_url = $row['j_url'];
			}
				echo "<tr>";
				echo "<td>$j_complete</td><td>$j_date</td><td><a href=".$j_url.">$j_name</a></br>$j_cname</td><td>$j_address</td><td align=center><button type=button>追蹤</button></td>";
				echo "</tr>";
		}
		echo "</table>";
		*/
		$table1;
		$num=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$table1[$num]=array(
					"j_complete" => $row['j_complete'],
					"j_date" => $row['j_date'],
					"j_name" => $row['j_name'],
					"j_cname" => $row['j_cname'],
					"j_address" => $row['j_address'],
					"j_url" => $row['j_url']
				);
			$num++;
		}
		$result2=json_encode($table1);
		echo $result2;
	
	}
	function learn_progress($jt,$id){
			//已修課總數
			$sql="SELECT count(*) as val FROM `professional_subject` INNER JOIN `subject` ON professional_subject.subject_name=subject.subject_name INNER JOIN `student_subject` ON subject.subject_id=student_subject.subject_id WHERE `jt_name`='$jt' AND student_subject.s_id='$id'";
			$result = $this->db->query($sql);
			$t1=mysql_fetch_assoc($result);
			$t1v=$t1['val'];
			//所有建議課程總數
			$sql="SELECT count(*) as val FROM `professional_subject` WHERE `jt_name`='$jt'";
			$result = $this->db->query($sql);
			$t2=mysql_fetch_assoc($result);
			$t2v=$t2['val'];
			$proccess=((t1v/t2v)*0.3)
			return $proccess;
	}
	function jt_board($jt,$id){
			$sql="SELECT round(sum((student_subject.pNum-student_subject.class_rank+1)/student_subject.pNum)/count(*)*30,0)as val FROM `professional_subject` INNER JOIN `subject` ON professional_subject.subject_name=subject.subject_name INNER JOIN `student_subject` ON subject.subject_id=student_subject.subject_id WHERE `jt_name`='$jt' AND student_subject.s_id='$id'";
			return ((t1v/t2v)*0.3);
	}
	function jt_board($jt,$id){
			$sql="SELECT round(sum((student_subject.pNum-student_subject.class_rank+1)/student_subject.pNum)/count(*)*30,0)as val FROM `professional_subject` INNER JOIN `subject` ON professional_subject.subject_name=subject.subject_name INNER JOIN `student_subject` ON subject.subject_id=student_subject.subject_id WHERE `jt_name`='電子商務技術人員' AND student_subject.s_id='A0128307'";
			$result = $this->db->query($sql);
			$row=mysql_fetch_assoc($result);
			return $row['val'];
	}
	function license_board($id)
	{
			$sql="SELECT (case when sum(license.value)>100 then 30 else sum(license.value)*0.3 end) as v FROM `student_license` INNER JOIN `license` ON student_license.l_id=license.l_id WHERE `s_id`='$id'";
			$result = $this->db->query($sql);
			$row=mysql_fetch_assoc($result);
			return $row['val'];
	}
	function progress_bar($val){
		$dom="<div class='progress'>";
		if ($val<=20) {
			$dom.='<div class="progress-bar progress-bar-success" style="width: '.$val.'%"></div>';
			$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			return $dom;
		}
		else if ($val>20&&$val<=40){
			$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
			$dom.='<div class="progress-bar progress-bar-info" style="width: '.($val-20).'%"></div>';
			$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(80-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			return $dom;
		}
		else if ($val>40&&$val<=60){
			$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
			$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
			$dom.='<div class="progress-bar progress-bar-danger" style="width: '.($val-40).'%"></div>';
			$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(60-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			return $dom;
		}
		else if ($val>60&&$val<=80){
			$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
			$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
			$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
			$dom.='<div class="progress-bar progress-bar-warning" style="width: '.($val-60).'%"></div>';
			$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(40-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			return $dom;
		}
		else if ($val>80&&$val<100) {
			$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
			$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
			$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
			$dom.='<div class="progress-bar progress-bar-warning" style="width: 20%">60%~80%</div>';
			$dom.='<div class="progress-bar progress-bar-shiny" style="width: '.($val-80).'%"></div>';
			$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(20-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			return $dom;
		}
		else if($val==100){
			$dom.='<div class="progress-bar progress-bar-shiny" style="width: 20%">100分!</div></div>';
			return $dom;
		}

	}
}
