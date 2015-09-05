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
		$data=$this->job_model->getTitle();
		//$this->parser->parse('p2_1_job', $temp);
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