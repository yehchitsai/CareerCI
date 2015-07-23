<?php
class Area_model extends CI_Model {

	public function __construct()
	{
	}
	
	function search()
	{
		$id=$this->input->post('id');
		$city=$this->input->post('city');
		$area=$this->input->post('area');
		//echo "$id,$city,$area";
		$a=0;
		if($city=="")
		{
			//$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where (`j_address` like '%$city%' or `j_address` like '%$area%') and`s_id`='$id'";

			$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where`j_address` like '%$area%' and `s_id`='$id'";
			$a=1;
		}
		else if($area=="")
		{
			$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where`j_address` like '%$city%' and `s_id`='$id'";
			$a=2;
		}
		else
		{
			$sql = "SELECT `j_complete`, `j_date`, `j_name` ,`j_cname`, `j_address` ,`j_url` FROM `job_information` as i join `job_conform` as c on i.`j_id`=c.`j_id` where (`j_address` like '%$city%' and `j_address` like '%$area%') and `s_id`='$id'";
			$a=3;
		}
		$result =mysql_query($sql)or die ("無法查詢".mysql_error());
		$num=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$table[$num]=array(
				"j_complete" => $row['j_complete'],
				"j_date" => $row['j_date'],
				"j_name" => $row['j_name'],
				"j_cname" => $row['j_cname'],
				"j_address" => $row['j_address'],
				"j_url" => $row['j_url']
			);
		$num++;
		}
		$result1=json_encode($table);
		echo $result1;
	}
	
	
}

?>