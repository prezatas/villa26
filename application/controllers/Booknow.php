<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booknow extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('booknow_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->library('email');//email send 
	}
	public function index()
	{
		$this->data['bookings'] = $this->booknow_model->getBooking();
		$this->load->view('booknow', $this->data);
	}
	public function addbooknowprocess()
	{
		$this->form_validation->set_rules('checkin', 'Check In', 'trim|required|callback_compareDate');
		$this->form_validation->set_rules('checkout', 'Check Out', 'trim|required|callback_compareDate');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nog', 'Number of Guests', 'trim|required');
		$this->form_validation->set_rules('nor', 'Number of Rooms', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length[500]');

		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			
			$this->data['bookings'] = $this->booknow_model->getBooking();
			$this->load->view('booknow', $this->data);
		}
		
		else{
			$booking=array(
				'b_checkin'=>$this->input->post('checkin'),
				'b_checkout'=>$this->input->post('checkout'),
				'b_country'=>$this->input->post('country'),
				'b_nog'=>$this->input->post('nog'),
				'b_nor'=>$this->input->post('nor'),
				'b_fname'=>$this->input->post('fname'),
				'b_lname'=>$this->input->post('lname'),
				'b_email'=>$this->input->post('email'),
				'b_tel'=>$this->input->post('tel'),
				'b_comment'=>$this->input->post('comment'),
				'b_status'=>('active'),				
				'b_date'=>date('Y-m-d H:i:s')
				
			); 
	
			$inserted=$this->booknow_model->addBooking($booking);
				if($inserted){
					//if data added
					$cname= $this->input->post('firstname').$this->input->post('lastname');
					$cemail= $this->input->post('email');
					$cphone= $this->input->post('telephone');
					$cdesc= $this->input->post('desc');
				
                    $this->email->initialize(array(
					  'protocol' => 'smtp',
					  'smtp_host' => 'ssl://smtp.googlemail.com',
					  'smtp_user' => 'deseramdushan@gmail.com',
					  'smtp_pass' => 'b77b40rdrh5',
					  'smtp_port' => 587,
					  'crlf' => "\r\n",
					  'newline' => "\r\n"
					));
					
					$this->email->from('deseramdushan@gmail.com', 'Dushan De Seram');
					$this->email->to('gridlitesolutions@gmail.com');
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					$this->email->subject('Email Test');
					$this->email->message('Testing the email class.');
					$this->email->send();	
					
					$this->session->set_flashdata('success_msg', 'Thankyou! We will contact you Shortly');
					
				}else{
					$this->session->set_flashdata('error_msg', 'Something Went Wrong');
				}
				redirect('booknow');  

			
		}
	}
	
	/*------------------validation----*/
	
	
	function compareDate() {
	  $startDate = strtotime($_POST['checkin']);
	  $endDate = strtotime($_POST['checkout']);
	
	  if ($endDate >= $startDate)
		return True;
	  else {
		$this->form_validation->set_message('compareDate', 'Checkout should be greater than Checkin Date.');
		return False;
	  }
	}
	
}
