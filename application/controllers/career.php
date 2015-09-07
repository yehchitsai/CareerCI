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
			$val=$row->total;
			$dom="<div class='progress' id='pog'>";
			if ($val<=20) {
				$dom.='<div class="progress-bar progress-bar-success" style="width: '.$val.'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			}
			else if ($val>20&&$val<=40){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width: '.($val-20).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			}
			else if ($val>40&&$val<=60){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width: '.($val-40).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			}
			else if ($val>60&&$val<=80){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: '.($val-60).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			}
			else if ($val>80&&$val<100) {
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: 20%">60%~80%</div>';
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: '.($val-80).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.'分</span></div></div>';
			}
			else if($val==100){
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: 20%">100分!</div></div>';
				return $dom;
			};
		   $obj=array("jt_name"=>$row->jt_name,"score"=>$row->total,"progress_bar"=>$dom);
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