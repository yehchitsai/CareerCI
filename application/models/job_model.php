<?php
class Job_model extends CI_Model {

	public function __construct()
	{
	}
	
	function progress_bar($val){
		$a=0;
		$sql ="SELECT ability.jt_id,jt_name,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$val."' ORDER BY `ability`.`total` DESC";
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
		return $patten;
	}
	function loaddetailJob($receive){
		$sql='SELECT * FROM `job_title` where jt_id="'.$receive.'"';
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$row = $result->row();
			$patten=array("jt_name"=>$row->jt_name,"jt_id"=>$row->jt_id);
			return $patten;
		}
	}
	function joblistappend($jt_id,$page){
		$data=array();$a=0;
		$index=($page-1)*10;
		$newpage=$page+1;
		$sql='SELECT * FROM `job_information`where jt_id="'.$jt_id.'" limit '.$index.',10';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row)
		{
			$obj=array("j_name"=>$row->j_name,"j_cname"=>$row->j_cname,"j_address"=>$row->j_address,"j_setdate"=>$row->j_setdate,"j_url"=>$row->j_url);
			$data[$a]=$obj;$a++;
		}
		$patten=array("page"=>$newpage,"job_query"=>$data);
		return $patten;
	}
	function getscore($s_id,$cla){
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
			return $patten;
		}
	}
}
