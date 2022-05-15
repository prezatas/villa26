<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestbook extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/guestbook_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->library('session');//load session


	}
	
	public function index()
	{
		
	}
	//to goto addguestbook page
	public function addguestbook(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Guestbook', base_url('cc/guestbook/addguestbook'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		$this->load->view('cc/module/guestbook/addguestbook',  $this->data);
	}
	
	//add guestbook  process
	public function addguestbookprocess(){
		
		 
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Guestbook', base_url('cc/guestbook/addguestbook'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  
		
		
	
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length[500]');
		
		
		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('cc/module/guestbook/addguestbook',$this->data);
		}
		
		else{
			$guestbook=array(
				'g_name'=>$this->input->post('name'),
				'g_title'=>$this->input->post('title'),
				'g_email'=>$this->input->post('email'),
				'g_comment'=>$this->input->post('comment'),
				'g_status'=>('active'),				
				'g_view_status'=>('unread'),
				'g_date'=>date('Y-m-d H:i:s')
				
			); 
	
			$inserted=$this->guestbook_model->addGuestbook($guestbook);
				if($inserted){
					$this->session->set_flashdata('success_msg', 'Guestbook Added Successfully');
				}else{
					$this->session->set_flashdata('success_msg', 'Something Went Wrong');
				}
				redirect('cc/guestbook/manageguestbook'); 
			
			
		}
        
	}
	
	
	
	//to goto manageguestbook page
	public function manageguestbook($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Guestbook', base_url('cc/guestbook/manageguestbook'));
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
		
		$config["base_url"] = base_url('cc/guestbook/manageguestbook');
		$config["total_rows"] = $this->guestbook_model->records_count($searchtxt);  
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
		$this->data['guestbooks'] = $this->guestbook_model->getGuestbooks($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
		$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/guestbook/manageguestbook', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/guestbook/manageguestbook/'.$pageno.'');
	}
	
	//to goto view guestbook page
	public function viewguestbook()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Guestbook', base_url('cc/guestbook/manageguestbook'));
		$this->mybreadcrumb->add('View Guestbook', base_url('cc/guestbook/viewguestbook'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$guestbookid = $this->input->get("g_id");  //get userid   
        $this->data['guestbooks']=$this->guestbook_model->guestbookView($guestbookid);
		$this->load->view('cc/module/guestbook/viewguestbook', $this->data);
	}
	
	
	//to goto update guestbook page
	public function updateguestbook() {

		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Guestbook', base_url('cc/guestbook/manageguestbook'));
		$this->mybreadcrumb->add('Update Guestbook', base_url('cc/guestbook/updateguestbook'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$guestbookid = $this->input->get("g_id");  //get userid  	
		
		$this->data['guestbooks']=$this->guestbook_model->guestbookView($guestbookid);
		$this->load->view('cc/module/guestbook/updateguestbook', $this->data); // load the view file , we are passing $data array to view file
			
			
	}
	//update guestbook process
	public function updateguestbookprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Guestbook', base_url('cc/guestbook/manageguestbook'));
		$this->mybreadcrumb->add('Update Guestbook', base_url('cc/guestbook/updateguestbook'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$guestbookid = $this->input->post("gid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[50]');
		$this->form_validation->set_rules('title','Name','trim|required|max_length[20]');
		$this->form_validation->set_rules('email','Email','trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('comment','Description','trim|required|max_length[500]');
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->data['guestbooks']=$this->guestbook_model->guestbookView($guestbookid);

			$this->load->view('cc/module/guestbook/updateguestbook', $this->data);
		}else{
			
			$updated=$this->guestbook_model->updateGuestbook($guestbookid);
			if($updated){
			$this->session->set_flashdata('success_msg', 'Guestbook Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/guestbook/manageguestbook/'.$pageno.'');
			
		}
			
	}
	
	
	
	
	//delete guestbook process
	public function deleteguestbookprocess() {
		$guestbookid = $this->input->get("g_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		
		$deleted=$this->guestbook_model->deleteGuestbook($guestbookid);
			if($deleted){
				$this->session->set_flashdata('success_msg', 'Guestbook Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/guestbook/manageguestbook/'.$pageno.'');  
		
	}
	
	//delete guestbook select process
	public function deleteguestbookselectprocess() {
		$guestbookid = $this->input->get("g_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$data = $this->input->post('checklist');
		
		 
			$selected=$this->guestbook_model->deleteGuestbookSelect($data);
			if($selected){
				$this->session->set_flashdata('success_msg', 'Selected Guestbook Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
	
			redirect('cc/guestbook/manageguestbook/'.$pageno.''); 
			
			
	}
	
	//guestbook activation process
	public function guestbookactivation() {
		$action = $this->input->get("action");//get ction
		$guestbookid = $this->input->get("g_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'active'){
			$this->guestbook_model->activate_guestbook($guestbookid,$action);
			$this->session->set_flashdata('success_msg', 'Guestbook Activate Successfully.');
			redirect('cc/guestbook/manageguestbook/'.$pageno.'');
		}else{
			$this->guestbook_model->activate_guestbook($guestbookid,$action);
			$this->session->set_flashdata('success_msg', 'Guestbook Deactivate Successfully.');
			redirect('cc/guestbook/manageguestbook/'.$pageno.'');
		}
    }
	
	
}
