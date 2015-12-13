<?php
Class Backend_model extends CI_Model
{
 function login($username, $password){
 	$hash=hash('sha256', $password);
   $this -> db -> select('id, username, password');
   $this -> db -> from('back_user');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $hash);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
      $this->session->set_userdata(array('username'=>$username,'is_login'=>true));
     return true;
   }
   else
   {
     return false;
   }
 }
  function is_login(){
      if ($this->session->userdata('is_login')===true) {
        return true;
      }
      else
      {
        return false;
      }
  }
  function get_action(){
    if (empty($this->session->userdata('action'))){
      $this->session->set_userdata(array('action'=>'dashboard'));
      return 'dashboard';
    }
    else{
      return $this->session->userdata('action');
    }
  }
  function get_base_data(){
    $sql='SELECT `id`, `v_name`, `v_type`, `v_update`, `v_value` FROM `back_version`';
    $result = $this->db->query($sql);
    return $result->result();
  }
  function version_add($raw){
    $data = array(
   'v_name' => $raw->name ,
   'v_type' => $raw->pt ,
   'v_update' => $raw->date ,
   'v_poster' => $raw->poster ,
   'v_gitsha' => $raw->gitsha ,
   'v_value' => $raw->version,
   'auth_key' =>hash('sha512',json_encode($raw)));
    if ($this->db->insert('back_version', $data)) {
      return true;
    }else{
      return false;
    }
  }
  function version_view($id){
   $this -> db -> from('back_version');
   $this -> db -> where('id', $id);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
      $row = $query->row();
      $patten=array("id"=>$row->id,
                    "date"=>$row->v_update,
                    "name"=>$row->v_name,
                    "poster"=>$row->v_poster,
                    "type"=>$row->v_type,
                    "gitsha"=>$row->v_gitsha,
                    "version"=>$row->v_value,
                    "auth_key"=>$row->auth_key);
      return $patten;
   }
  }
  function version_delete($id){
    $this->db->where('id', $id);
    if ($this->db->delete('back_version')) {
      return true;
    }else{
      return false;
    }
  }
}
?>