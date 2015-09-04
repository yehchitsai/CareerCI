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
		$sql = "SELECT * FROM `job_title` ";
		$result = $this->db->query($sql);
		//echo $sql;
		return $result->result_array();
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
	
}
