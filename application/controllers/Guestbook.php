<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestbook extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('guestbook_model');//load model 
		$this->load->model('common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
		$this->load->helper('text');
		$this->load->helper('string');//string data  
		$this->load->library('user_agent');//user data
	}
	public function index()
	{
		$this->data['guestbooks'] = $this->guestbook_model->viewGuestbooks();
		$this->load->view('guestbook', $this->data);
	}
	//add guestbook  process
	public function addguestbookprocess(){
		
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('message', 'Comment', 'trim|required|max_length[500]');
		
		
		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			$this->data['guestbooks'] = $this->guestbook_model->viewGuestbooks();
			$this->load->view('guestbook',$this->data);
		}
		
		else{
			$guestbook=array(
				'g_name'=>$this->input->post('name'),
				'g_title'=>$this->input->post('subject'),
				'g_email'=>$this->input->post('email'),
				'g_comment'=>$this->input->post('message'),
				'g_status'=>('deactive'),				
				'g_view_status'=>('unread'),
				'g_date'=>date('Y-m-d H:i:s')
				
			); 
	
			$inserted=$this->guestbook_model->addGuestbook($guestbook);
				if($inserted){
					$this->session->set_flashdata('success_msg', 'Thankyou. Your Comment Sent Successfully');
				}else{
					$this->session->set_flashdata('success_msg', 'Something Went Wrong');
				}
				redirect('guestbook'); 
			
			
		}
        
	}
	
}
