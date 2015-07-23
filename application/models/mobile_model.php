<?php
class Mobile_model extends CI_Model {

	public function __construct()
	{
	}
	
	function setRegID($args = FALSE,$platform = 'android')
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
	function updateRegID($currentID,$newID)
	{
		$data = array('registration_id' => $newID);
		// 假如資料表內有新ID就移除舊ID，沒有則進行更新
		$query = $this->db->get_where('tblregistration', $data);
		if($query->num_rows() == 0){
			$this->db->where('registration_id', $currentID);
			$this->db->update('tblregistration', $data); 
		} else {
			$this->db->where('registration_id', $currentID);
			$this->db->delete('tblregistration');
		}
	}

	function setMsg($sender, $level, $message,$info)
	{
		$data = array('sender' => $sender,
			'level' => $level,
			'message' => $message,
			'info' => $info);
		$this->db->insert('message', $data); 
	//	return true;
		return $this->db->insert_id();	
	}

	function getMsg($deviceID)
	{
		$query = $this->db->get_where('tblregistration',array('registration_id' => $deviceID));
		if($query->num_rows()>0)
		{
			$row = $query->row(); 
			$id = $row->id;
			$sql = "SELECT `sender`,`level` , `message`, `info`, `timestamp` FROM `message` M, `message_log` ML WHERE M.m_id = ML.m_id AND receiver_id=$id";
			$result = $this->db->query($sql);
			return $result->result_array();
		} else
			return false;
		
	}

	function setMsgLog($m_id, $reg_id)
	{
		$query = $this->db->get_where('tblregistration', array('registration_id' => $reg_id));
		if ($query->num_rows() > 0){
		  $row = $query->row(); 
		  $data = array('m_id' => $m_id,
                        'receiver_id' => $row->id,
                        'status' => 1);
                  $this->db->insert('message_log', $data);
		}
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

