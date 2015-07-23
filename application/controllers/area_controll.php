<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Area_controll extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
        $this->load->helper('url');
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