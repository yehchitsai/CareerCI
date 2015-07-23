<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Mobile extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	
    function cors_headers() //Cross-origin resource sharing
    {
	header('Access-Control-Allow-Origin: *');
//	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
    function regid_get()
    {
	$this->regid_post();
/*
		$data = array('returned: get'. $this->get('id'));
		$this->response($data);
*/
    }
    function regid_options() {
        $this->cors_headers();
        $this->response($_SERVER['HTTP_ORIGIN']);
    }

    function regid_post()
    {
	$this->cors_headers();
	$this->load->model('mobile_model');
//因為資料表已設定為unique所以不用擔心鍵值重複
	$data = array('success' =>  $this->mobile_model->setRegID($this->input->get_post('regId'), $this->input->get_post('platform')));
        $this->response($data);
    }
    function sendMsg_options()
    {
	$this->cors_headers();
	$this->response($_SERVER['HTTP_ORIGIN']);
    }

    function sendMsg_post()
    {		
//	log_message('debug','test1');
	$this->cors_headers();
//	log_message('debug','test2');
	$auth='';
	include("curl_php.php");
//	log_message('debug','test3');
	if($auth=='')
	  $data = array('success' => false, 'auth' => false);
	else
	  $data = array('success' => true, 'auth' => $auth);
	 log_message('debug',json_encode($data));
	$this->response($data);
    }
}
?>
