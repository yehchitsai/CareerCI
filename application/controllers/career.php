<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Career extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
        $this->load->helper('url');
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');		
    }  
	function menu()
	{
		$user_name = array('user_name'=>$this->session->userdata('user_name'));
		$this->parser->parse('p2_menu', $user_name);
	}
	function job()
	{
		$id = $this->session->userdata('user_id');
		$sql ="SELECT jt_name FROM job_title";
		$result = $this->db->query($sql);
		$data=array();
		$temp=array();
		foreach ($result->result() as $row)
		{
		 	$temp[]=$row->jt_name;
		}
		for ($i=0; $i < sizeof($temp); $i++) { //職業類型query
			$jt=$temp[$i];
			//課程完成度
			$learned=$this->job_model->learn_progress($jt,$id);
			//職業類型
			$score=$this->job_model->jt_board($jt,$id);
			//證照成績
			$l_score=$this->job_model->license_board($id);
			$sum=100-($learned+$score+$l_score);
			$obj=array("jt_name"=>$jt , "score"=>$sum);
			$data[$i]=$obj;
		}
		$patten=array("job_query"=>$data);
		//$data=$this->job_model->getTitle();
		$this->parser->parse('p2_1_job', $temp);
	}
	function detailJob()
	{
		$this->load->view('p2_1_1_detailJob');
	}
	function score()
	{
		$this->load->view('p2_1_2_score');
	}

	function track()
	{
		$this->load->view('p2_2_track');
	}
	function push()
	{
		$this->load->view('p2_3_push');
	}

	function login()
	{
		$this->load->view('p1_login');
	}

	
	function search()
	{	
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		$this->load->model('area_model');
		$this->area_model->search();
	}
}  
?> 