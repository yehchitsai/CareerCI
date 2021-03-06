<?php
class Job_model extends CI_Model {

	public function __construct()
	{
	}
	
	function progress_bar($lan,$val){
		$this->lang->load($lan);
		$a=0;$unit=$this->lang->line('score_unit');
		switch ($lan) {
			case 'en_US':
				$sql ="SELECT ability.jt_id,jt_ename as jt_name,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$val."' ORDER BY `ability`.`total` DESC";				
				break;
			
			case 'zh_TW':
				$sql ="SELECT ability.jt_id,jt_name,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$val."' ORDER BY `ability`.`total` DESC";				
				break;
		}
		$result = $this->db->query($sql);
		foreach ($result->result() as $row)
		{
			$val=$row->total;
			$dom='<div class="progress" id="'.$row->jt_id.'">';
			if ($val<=20) {
				$dom.='<div class="progress-bar progress-bar-success" style="width: '.$val.'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>20&&$val<=40){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width: '.($val-20).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>40&&$val<=60){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width: '.($val-40).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>60&&$val<=80){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: '.($val-60).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>80&&$val<100) {
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: 20%">60%~80%</div>';
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: '.($val-80).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if($val==100){
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: 20%">100'.$unit.'!</div></div>';
				
			};
		   $obj=array("jt_name"=>$row->jt_name,"score"=>$row->total,"progress_bar"=>$dom,"jt_id"=>$row->jt_id);
		   $data[$a]=$obj;$a++;
		}
		$patten=array("job_query"=>$data,'job_caption'=>$this->lang->line('job_caption'));
		return $patten;
	}
	function loaddetailJob($lan,$receive){
		switch ($lan) {
			case 'en_US':
				$sql='SELECT jt_ename as jt_name,jt_id FROM `job_title` where jt_id="'.$receive.'"';
				break;
			case 'zh_TW':
				$sql='SELECT jt_name,jt_id FROM `job_title` where jt_id="'.$receive.'"';
				break;
		}
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$row = $result->row();
			$patten=array("jt_name"=>$row->jt_name,"jt_id"=>$row->jt_id);
			return $patten;
		}
	}
	function joblistappend($lan,$jt_id,$page){
		$this->lang->load($lan);
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
		$patten=array("page"=>$newpage,"job_query"=>$data,'detailjob_btn'=>$this->lang->line('detailjob_btn'));
		return $patten;
	}
	function getscore($lan,$s_id,$cla){
		$this->lang->load($lan);
		$unit=$this->lang->line('score_unit');
		switch ($lan) {
			case 'en_US':
				$sql ="SELECT ability.jt_id,jt_ename as jt_name,total,rec_subject,l_score,rank_score,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$s_id."' AND ability.jt_id='".$cla."'";				
				break;
			
			case 'zh_TW':
				$sql ="SELECT ability.jt_id,jt_name,total,rec_subject,l_score,rank_score,total FROM `ability` inner join job_title on ability.jt_id=job_title.jt_id where s_id='".$s_id."' AND ability.jt_id='".$cla."'";	
				break;
		}
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$row = $result->row();
			$val=$row->total;
			$dom="<div class='progress' id='".$row->jt_id."'>";
			if ($val<=20) {
				$dom.='<div class="progress-bar progress-bar-success" style="width: '.$val.'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>20&&$val<=40){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width: '.($val-20).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>40&&$val<=60){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width: '.($val-40).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>60&&$val<=80){
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: '.($val-60).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if ($val>80&&$val<100) {
				$dom.='<div class="progress-bar progress-bar-success" style="width:20%">0%~20%</div>';
				$dom.='<div class="progress-bar progress-bar-info" style="width:20%">20%~40%</div>';
				$dom.='<div class="progress-bar progress-bar-danger" style="width:20%">40%~60%</div>';
				$dom.='<div class="progress-bar progress-bar-warning" style="width: 20%">60%~80%</div>';
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: '.($val-80).'%"></div>';
				$dom.='<div class="progress-bar progress-bar-empty" style="width: '.(100-$val).'%"><span style="color:black;">'.$val.$unit.'</span></div></div>';
			}
			else if($val==100){
				$dom.='<div class="progress-bar progress-bar-shiny" style="width: 20%">100'.$unit.'!</div></div>';
			};
			$patten=array(	"progress_bar"=>$dom,
							"learned"=>$row->rec_subject,
							"class_score"=>$row->rank_score,
							"lisence_score"=>$row->l_score,
							"total_score"=>$row->total,
							"jt_name"=>$row->jt_name,
							'score_unit'=>$this->lang->line('score_unit'),
							'score_learned'=>$this->lang->line('score_learned'),
							'score_class_score'=>$this->lang->line('score_class_score'),
							'score_lisence_score'=>$this->lang->line('score_lisence_score'),
							'score_prepare_list'=>$this->lang->line('score_prepare_list'),
							'score_done_list'=>$this->lang->line('score_done_list'),
							'score_undone_list'=>$this->lang->line('score_undone_list'),
							'score_lisence'=>$this->lang->line('score_lisence'));
			return $patten;
		}
	}
}
