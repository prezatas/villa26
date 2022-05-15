<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/booking_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->library('session');//load session


	}
	
	public function index()
	{
		
	}
	//to goto addbooking page
	public function addbooking(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Booking', base_url('cc/booking/addbooking'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		$this->load->view('cc/module/booking/addbooking',  $this->data);
	}
	
	//add booking  process
	public function addbookingprocess(){
		
		 
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Booking', base_url('cc/booking/addbooking'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  
		
		
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
			$this->load->view('cc/module/booking/addbooking',$this->data);
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
	
			$inserted=$this->booking_model->addBooking($booking);
				if($inserted){
					$this->session->set_flashdata('success_msg', 'Booking Added Successfully');
				}else{
					$this->session->set_flashdata('success_msg', 'Something Went Wrong');
				}
				redirect('cc/booking/managebooking'); 
			
			
		}
        
	}
	
	
	
	//to goto managebooking page
	public function managebooking($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Booking', base_url('cc/booking/managebooking'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		// Search text
		$searchtxt = "";
		
		if($this->input->post('submit') != NULL ){
		  $searchtxt = $this->input->post('search');
		  $this->session->set_userdata(array("search"=>$searchtxt));
		}else{
		  if($this->session->userdata('search') != NULL){
			$searchtxt = $this->session->userdata('search');
		  }
		}
		
		$config["base_url"] = base_url('cc/booking/managebooking');
		$config["total_rows"] = $this->booking_model->records_count($searchtxt);  
		$rowperpage=$config["per_page"] = 10;
		if($rowno != 0){
			  $rowno = ($rowno-1) * $rowperpage;
		}
		$config["uri_segment"] =4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = 2;
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['bookings'] = $this->booking_model->getbookings($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
		$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/booking/managebooking', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/booking/managebooking/'.$pageno.'');
	}
	
	//to goto view booking page
	public function viewbooking()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Booking', base_url('cc/booking/managebooking'));
		$this->mybreadcrumb->add('View Booking', base_url('cc/booking/viewbooking'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$bookingid = $this->input->get("b_id");  //get userid   
        $this->data['bookings']=$this->booking_model->bookingView($bookingid);
		$this->load->view('cc/module/booking/viewbooking', $this->data);
	}
	
	
	//to goto update booking page
	public function updatebooking() {

		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Booking', base_url('cc/booking/managebooking'));
		$this->mybreadcrumb->add('Update Booking', base_url('cc/booking/updatebooking'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$bookingid = $this->input->get("b_id");  //get userid  	
		
		$this->data['bookings']=$this->booking_model->bookingView($bookingid);
		$this->load->view('cc/module/booking/updatebooking', $this->data); // load the view file , we are passing $data array to view file
			
			
	}
	//update booking process
	public function updatebookingprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Booking', base_url('cc/booking/managebooking'));
		$this->mybreadcrumb->add('Update Booking', base_url('cc/booking/updatebooking'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$bookingid = $this->input->post("bid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		
		
		$this->form_validation->set_rules('checkin', 'Check In', 'trim|required|callback_compareDate');
		$this->form_validation->set_rules('checkout', 'Check Out', 'trim|required|callback_compareDate');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nog', 'Number of Guests', 'trim|required');
		$this->form_validation->set_rules('nor', 'Number of Rooms', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length[500]');
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->data['bookings']=$this->booking_model->bookingView($bookingid);

			$this->load->view('cc/module/booking/updatebooking', $this->data);
		}else{
			
			$updated=$this->booking_model->updateBooking($bookingid);
			if($updated){
			$this->session->set_flashdata('success_msg', 'Booking Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/booking/managebooking/'.$pageno.'');
			
		}
			
	}
	
	
	
	
	//delete booking process
	public function deletebookingprocess() {
		$bookingid = $this->input->get("b_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		
		$deleted=$this->booking_model->deleteBooking($bookingid);
			if($deleted){
				$this->session->set_flashdata('success_msg', 'Booking Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/booking/managebooking/'.$pageno.'');  
		
	}
	
	//delete booking select process
	public function deletebookingselectprocess() {
		$bookingid = $this->input->get("b_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$data = $this->input->post('checklist');
		
		 
			$selected=$this->booking_model->deletebookingSelect($data);
			if($selected){
				$this->session->set_flashdata('success_msg', 'Selected Booking Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
	
			redirect('cc/booking/managebooking/'.$pageno.''); 
			
			
	}
	//booking activation process
	public function bookingactivation() {
		$action = $this->input->get("action");//get ction
		$bookingid = $this->input->get("b_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'active'){
			$this->booking_model->activate_booking($bookingid,$action);
			$this->session->set_flashdata('success_msg', 'Booking Activate Successfully.');
			redirect('cc/booking/managebooking/'.$pageno.'');
		}else{
			$this->booking_model->activate_booking($bookingid,$action);
			$this->session->set_flashdata('success_msg', 'Booking Deactivate Successfully.');
			redirect('cc/booking/managebooking/'.$pageno.'');
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
