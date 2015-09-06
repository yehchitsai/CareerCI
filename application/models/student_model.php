<?php
class Student_model extends CI_Model {

	public function __construct()
	{
	}
	
	function getNamebyID($s_id)
	{
		$query = $this->db->get_where('student', array('s_id' => $s_id));
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return array("user_name"=>$row->s_name,"user_id"=>$row->s_id);
		} else
			return null;
	}
	
	
}

?>