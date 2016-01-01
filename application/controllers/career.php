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
	function menu($lan,$receive)
	{
		$this->lang->load($lan);
		$query = $this->db->get_where('student', array('s_id' => $receive));
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name=$row->s_name;
		}
		$patten = array('user_name'=>$name,'menu_welcome'=>$this->lang->line('menu_welcome'),'menu_job'=>$this->lang->line('menu_job'),'menu_track'=>$this->lang->line('menu_track'),'menu_message'=>$this->lang->line('menu_message'));
		$this->parser->parse('p2_menu', $patten);

	}
	function job($lan,$receive)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->progress_bar($lan,$receive);
		$this->parser->parse('p2_1_job', $patten);
	}
	function detailJob($lan,$receive)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->loaddetailJob($lan,$receive);
		$this->parser->parse('p2_1_1_detailJob', $patten);
		//$this->load->view('p2_1_1_detailJob');
	}
	function score($lan,$s_id,$cla)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->getscore($lan,$s_id,$cla);
		$this->parser->parse('p2_1_2_score', $patten);
	}

	function track($lan,$receive)
	{
		$this->load->model('track_model');
		$patten=$this->track_model->track($lan,$receive);
		$this->parser->parse('p2_2_track', $patten);
	}
	function push()
	{
		$this->load->view('p2_3_push');
	}
	function login()
	{
		$this->load->view('p1_login');
	}
	function chkversion($receive){
		$receive=urldecode($receive);
		if (base64_decode($receive)!="0.0.1") {	echo "false"; }
		else{	 echo "true";	}
	}
	function gettrack($receive){
		$this->load->model('track_model');	
		echo $this->track_model->gettrack($receive);
	}
	function addtrack($s_id,$jt_id){
		$this->load->model('track_model');	
		echo $this->track_model->addtrack($s_id,$jt_id);
	}
	function deltrack($s_id,$jt_id){
		$this->load->model('track_model');	
		echo $this->track_model->deltrack($s_id,$jt_id);
	}
	function joblistappend($lan,$jt_id,$page){
		$this->load->model('job_model');
		$patten=$this->job_model->joblistappend($lan,$jt_id,$page);
		$this->parser->parse('detailjob_append', $patten);
	}
}  
?> 