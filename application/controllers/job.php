<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

//class Job extends CI_Controller{  
class Job extends REST_Controller{  
     
    function __construct() {  
        
		parent::__construct();  

    }  
     
    function cors_headers() //Cross-origin resource sharing
    {
	header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }

    function getTitle_options() {
        $this->cors_headers();
        //$this->response($_SERVER['HTTP_ORIGIN']);
    }

    function getTitle_get()
    {
		$this->cors_headers();
		$this->load->model('job_model');
		$data = $this->job_model->getTitle();
        $this->response($data);
    }
	
    function getJob_options() {
        $this->cors_headers();
        $this->response($_SERVER['HTTP_ORIGIN']);
    }

    function getJob_get()
    {
	$this->getJob_post();
    }

    function getJob_post()
    {
	$this->cors_headers();
	$this->load->model('job_model');
	$data = $this->job_model->getJobs($this->input->get_post('id'),$this->input->get_post('date'),$this->input->get_post('page'));
        $this->response($data);
    }

    function get_job(){
		header("Access-Control-Allow-Origin: *");
		$this->load->model('job_model');
		$this->job_model->getjob();		
    } 
}
?> 
