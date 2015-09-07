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
			return $row->s_name;
		} else
			return null;
	}
	
	
}

?>