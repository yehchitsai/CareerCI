<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Backend extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
        $this->load->helper('url');
        $this->load->model('backend_model');
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');	
        header('Access-Control-Allow-Origin: *');
        header("Content-Type:text/html; charset=utf-8");
    }  
    function index(){
        if($this->backend_model->is_login()){
            $this->parser->parse('backend/sidebar_frame', array('action'=>$this->backend_model->get_action()));
        }
        else{
        $this->load->view('backend/login_frame');
        }
	}
    function receivelogin(){
        if ($this->backend_model->login($this->input->post('id'),$this->input->post('pwd'))) {
            echo "true";
        }
        else{
            echo "false";
        }
    }
    function page($page){//initpage
        if($this->backend_model->is_login()){
            $this->session->set_userdata(array('action'=>$page));
            $this->load->view('backend/page_'.$page);
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect('/backend/', 'refresh');
    }
    function version($even){
        switch ($even) {
            case 'get_base':
                echo json_encode($this->backend_model->get_base_data());
                break;
            case 'add':
                $data = array(
               'v_name' => $this->input->post('name'),
               'v_type' => $this->input->post('pt'),
               'v_update' => $this->input->post('date'),
               'v_poster' => $this->input->post('poster'),
               'v_gitsha' => $this->input->post('gitsha'),
               'v_value' => $this->input->post('version'),
               'auth_key' =>hash('sha512',json_encode($this->input->post())));
                if ($this->db->insert('back_version', $data)) {
                    $newid=$this->db->insert_id();
                  echo json_encode(array('status'=>true,'newid'=>$newid));
                }else{
                  echo false;
                }
                break;
            case 'delete':
                $this->backend_model->version_delete($this->input->post('id'));
                break;
        }
    }
    function getform($name){
        $this->load->view('backend/'.$name);
    }
    function version_view($id){
        $patten=$this->backend_model->version_view($id);
        $this->parser->parse('backend/form_version_view', $patten);
    }
}  
?> 