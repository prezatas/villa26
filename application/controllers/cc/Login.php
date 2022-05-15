<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/login_model');//load model  
		$this->load->model('cc/common_model');//load model 
	}
	public function index()
	{
		$this->load->view('cc/module/login/login');
	}
	public function authentication()
	{
            $user_login=array(
                'user_email'=>$this->input->post('email'),
                'user_password'=>md5($this->input->post('password'))
	
            );
	
            $data=$this->login_model->login_user($user_login['user_email'],$user_login['user_password']);
                if($data)
                {
                      $this->session->set_userdata('user_id',$data['user_id']);
					  $this->session->set_userdata('user_ur_id',$data['ur_id']);
					  $this->session->set_userdata('user_ur_title',$data['ur_title']);
                      $this->session->set_userdata('user_email',$data['user_email']);
                      $this->session->set_userdata('user_fname',$data['user_fname']);
					   $this->session->set_userdata('user_lname',$data['user_lname']);
                      $this->session->set_userdata('user_tel',$data['user_tel']);
                      


                      $this->dashboard();
                      
                      redirect(base_url('cc/login/dashboard'));

                }
                else{

                      $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
                      $this->load->view('cc/module/login/login');

                }
	
	}
	
	public function dashboard(){   
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
				
		$this->load->view('cc/module/login/dashboard',  $this->data);
	}
	public function logout(){

	  $this->session->sess_destroy();
	  redirect('cc/login', 'refresh');
	}
}
