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
		$data=array();$a=0;
		$sql ="SELECT ability.jt_id,jt_name,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$receive."' ORDER BY `ability`.`total` DESC";
		$result = $this->db->query($sql);
		foreach ($result->result() as $row)
		{
			$val=$row->total;
			$dom='<div class="progress" id="'.$row->jt_id.'">';
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
				
			};
		   $obj=array("jt_name"=>$row->jt_name,"score"=>$row->total,"progress_bar"=>$dom,"jt_id"=>$row->jt_id);
		   $data[$a]=$obj;$a++;
		}
		$patten=array("job_query"=>$data);
		$this->parser->parse('p2_1_job', $patten);
	}
	function detailJob()
	{
		$this->load->view('p2_1_1_detailJob');
	}
	function score($receive)
	{
		$receive=urldecode($receive);
		$data=explode('|', $receive);
		$s_id = $data[0];
		$cla=$data[1];
		$sql ="SELECT * FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$s_id."' AND ability.jt_id='".$cla."' ";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$row = $result->row();
			$val=$row->total;
			$dom="<div class='progress' id='".$row->jt_id."'>";
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
			};
			$patten=array("progress_bar"=>$dom,"learned"=>$row->rec_subject,"class_score"=>$row->rank_score,"lisence_score"=>$row->l_score,"total_score"=>$row->total,"jt_name"=>$row->jt_name);
			$this->parser->parse('p2_1_2_score', $patten);
		}
		
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

	
	function search()
	{	
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		$this->load->model('area_model');
		$this->area_model->search();
	}
	function chkversion($receive){
		$receive=urldecode($receive);
		if (base64_decode($receive)!="0.0.1") {
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function gettrack($receive){
		$data=array();$a=0;
		$sql='SELECT * FROM `track` inner join job_title on track.jt_id=job_title.jt_id where s_id="'.$receive.'"';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row){
			$obj=array("jt_id"=>$row->jt_id,"jt_name"=>$row->jt_name,"track_date"=>$row->t_date);
			$data[$a]=$obj;$a++;
		}
		echo json_encode($data);
	}
	function addtrack($s_id,$jt_id){
		$sql="INSERT INTO `track`(`s_id`, `jt_id`, `t_date`) VALUES ('".ucfirst($s_id)."','".$jt_id."',now())";
		if (!$this->db->query($sql)) {
    		echo "FALSE";
		}
		else {
    		echo "TRUE";
		}
	}
	function deltrack($s_id,$jt_id){
		$sql="DELETE FROM `track` WHERE `s_id`='".ucfirst($s_id)."' AND `jt_id`='".$jt_id."'";
		if (!$this->db->query($sql)) {
    		echo "FALSE";
		}
		else {
    		echo "TRUE";
		}
	}
}  
?> 