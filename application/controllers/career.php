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
	function menu($receive)
	{
		$query = $this->db->get_where('student', array('s_id' => $receive));
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name=$row->s_name;
		}
		$patten = array('user_name'=>$name);
		$this->parser->parse('p2_menu', $patten);
	}
	function job($receive)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->progress_bar($receive);
		$this->parser->parse('p2_1_job', $patten);
	}
	function detailJob($receive)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->loaddetailJob($receive);
		$this->parser->parse('p2_1_1_detailJob', $patten);
		//$this->load->view('p2_1_1_detailJob');
	}
	function score($s_id,$cla)
	{
		$this->load->model('job_model');
		$patten=$this->job_model->getscore($s_id,$cla);
		$this->parser->parse('p2_1_2_score', $patten);
	}

	function track($receive)
	{
		$data=array();$a=0;
		$sql='SELECT * FROM `track` inner join job_title on track.jt_id=job_title.jt_id where s_id="'.$receive.'"';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row){
			$obj=array("jt_id"=>$row->jt_id,"jt_name"=>$row->jt_name,"track_date"=>$row->t_date);
			$data[$a]=$obj;$a++;
		}
		$patten=array("track_query"=>$data);
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
		echo $this->track_model->addtrack($receive);
	}
	function deltrack($s_id,$jt_id){
		$this->load->model('track_model');	
		echo $this->track_model->deltrack($s_id,$jt_id);
	}
	function joblistappend($jt_id,$page){
		$this->load->model('job_model');
		$patten=$this->job_model->joblistappend($jt_id,$page);
		$this->parser->parse('detailjob_append', $patten);
	}
}  
?> 