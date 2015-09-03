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
	function Menu()
	{
		$this->load->view('p2_menu');
	}

	function Jobs()
	{
		$this->load->view('p2_1_job');
	}
	function Track()
	{
		$this->load->view('p2_2_track');
	}
	function Push()
	{
		$this->load->view('p2_3_push');
	}

	function Login()
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