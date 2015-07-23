<?php
class Mobile_model extends CI_Model {

	public function __construct()
	{
	}
	
	function setRegID($args = FALSE,$platform = FALSE)
	{
		$data = array('registration_id' => $args, 'platform' => $platform);
//		$this->db->delete('tblregistration', $data); //避免重複
		$query = $this->db->get_where('tblregistration', $data);
		if($query->num_rows() == 0){
		  print_r($data);
		  $this->db->insert('tblregistration', $data); 
		}
		return true;
	}	
	
	function getAllRegID($platform = FALSE)//$args points out  the playform type
	{
		
		$this->db->select('registration_id');
		if($platform!=FALSE)
			$query = $this->db->get_where('tblregistration', array('platform' => $platform));
		else
			$query = $this->db->get('tblregistration');
		$registatoin_ids = array();
		foreach ($query->result() as $row)
			array_push($registatoin_ids,$row->registration_id);
		return  $registatoin_ids;
	}

	function deleteRegID($args)
	{
	  $this->db->delete('tblregistration', array('registration_id' => $args)); 
	}

}
