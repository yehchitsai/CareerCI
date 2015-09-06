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
		$data=array();$a=0;
		$id = $this->session->userdata('user_id');
		$sql ="SELECT jt_name,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$id."' ORDER BY `ability`.`total` DESC";
		$result = $this->db->query($sql);
		foreach ($result->result() as $row)
		{
			$td=$this->job_model->progress_bar($row->total);
		   $obj=array("jt_name"=>$row->jt_name,"score"=>$row->total,"progress_bar"=>$td);
		   $data[$a]=$obj;$a++;
		}
		$patten=array("job_query"=>$data);
		$this->parser->parse('p2_1_job', $patten);

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