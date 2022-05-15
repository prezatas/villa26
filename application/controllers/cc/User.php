<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/user_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->library('session');//load session

	}
	
	public function index()
	{
		
	}
	//to goto adduser page
	public function adduser(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add User', base_url('cc/user/adduser'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		$this->data['roles'] = $this->user_model->getRoles();
		$this->load->view('cc/module/user/adduser',  $this->data);
	}
	
	//add user process
	public function adduserprocess(){  
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add User', base_url('cc/user/adduser'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  
		
		$this->data['roles'] = $this->user_model->getRoles();
		
		$this->form_validation->set_rules('fname','First Name','trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('lname','Last Name','trim|required|min_length[3]|max_length[20]');
		if($this->input->post('tel')){
			$this->form_validation->set_rules('tel','Telephone','trim|required|min_length[10]|max_length[12]|callback_alphanumeric_check');
		}
		if($this->input->post('nic')){
			$this->form_validation->set_rules('nic','NIC NO','trim|min_length[10]|max_length[10]|callback_nic_check');
		}
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('cpassword','Confirm Password','trim|required|min_length[6]|max_length[15]|matches[password]');
		
		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('cc/module/user/adduser', $this->data);
		}
		
		else{
			$user=array(
				'user_fname'=>$this->input->post('fname'),
				'user_lname'=>$this->input->post('lname'),
				'user_tel'=>$this->input->post('tel'),
				'user_nic'=>$this->input->post('nic'),
				'user_email'=>$this->input->post('email'),
				'user_password'=>md5($this->input->post('password')),
				'user_status'=>('active'),
				'user_ur_id'=>$this->input->post('role'),
				'user_view_status'=>('unread'),				
				'user_create_at'=>date('Y-m-d H:i:s'),
				
			); 
	
			$email_check=$this->user_model->emailCheck($user['user_email']);
	
			if($email_check){
				$inserted=$this->user_model->addUser($user);
				if($inserted){
					$this->session->set_flashdata('success_msg', 'User Added Successfully');
				}else{
					$this->session->set_flashdata('success_msg', 'Something Went Wrong');
				}
				redirect('cc/user/manageuser');  

			}else{
				 $this->session->set_flashdata('error_msg', 'Email Exist.');
				 redirect('cc/user/manageuser');  
			}
		}
        
	}
	
	//to goto manageuser page
	public function manageuser($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage User', base_url('cc/user/manageuser'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		$searchtxt = "";
		
		if($this->input->post('submit') != NULL ){
		  $searchtxt = $this->input->post('search');
		  $this->session->set_userdata(array("search"=>$searchtxt));
		}else{
		  if($this->session->userdata('search') != NULL){
			$searchtxt = $this->session->userdata('search');
		  }
		}
		
		$config["base_url"] = base_url('cc/user/manageuser');
		$config["total_rows"] = $this->user_model->records_count($searchtxt);  
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
		$this->data['users'] = $this->user_model->getUsers($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
	 	$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
		$this->data["links"] = $this->pagination->create_links();
		
		
		$this->load->view('cc/module/user/manageuser', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/user/manageuser/'.$pageno.'');
	}
	//user activation process
	public function useractivation() {
		$action = $this->input->get("action");//get ction
		$userid = $this->input->get("u_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'active'){
			$this->user_model->activate_user($userid,$action);
			$this->session->set_flashdata('success_msg', 'User Activate Successfully.');
			redirect('cc/user/manageuser/'.$pageno.'');
		}else{
			$this->user_model->activate_user($userid,$action);
			$this->session->set_flashdata('success_msg', 'User Deactivate Successfully.');
			redirect('cc/user/manageuser/'.$pageno.'');
		}
    }
	
	
	
	//to goto view user page
	public function viewuser()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage User', base_url('cc/user/manageuser'));
		$this->mybreadcrumb->add('View User', base_url('cc/user/viewuser'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$userid = $this->input->get("u_id");  //get userid   
        $this->data['users']=$this->user_model->userView($userid);
		$this->data['roles'] = $this->user_model->getRoles();
		$this->load->view('cc/module/user/viewuser', $this->data);
	}
	//to goto view user page
	public function usernotification()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('User Notification', base_url('cc/user/usernotification'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		  
        $searchtxt = $this->input->post("searchtxt");
		$config["base_url"] = base_url('cc/user/usernotification');
		$config["total_rows"] = $this->user_model->countUserNotifi();  
		$config["per_page"] = 9;
		$config["uri_segment"] =4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['users'] = $this->user_model->userNotifiView($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
	 
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/user/usernotification', $this->data); // load the view file , we are passing $data array to view file
	}
	
	//to goto update user page
	public function updateuser() {

		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage User', base_url('cc/user/manageuser'));
		$this->mybreadcrumb->add('Update User', base_url('cc/user/updateuser'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$userid = $this->input->get("u_id");  //get userid  
		$this->data['roles'] = $this->user_model->getRoles();//to load selection role data
		
		
		$this->data['users']=$this->user_model->userView($userid);
		$this->load->view('cc/module/user/updateuser', $this->data); // load the view file , we are passing $data array to view file
			
			
	}
	//update user process
	public function updateuserprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage User', base_url('cc/user/manageuser'));
		$this->mybreadcrumb->add('Update User', base_url('cc/user/updateuser'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$userid = $this->input->post("uid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		
		
		$this->form_validation->set_rules('fname','First Name','trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('lname','Last Name','trim|required|min_length[3]|max_length[20]');
		if($this->input->post('tel')){
			$this->form_validation->set_rules('tel','Telephone','trim|required|min_length[10]|max_length[12]|callback_alphanumeric_check');
		}
		if($this->input->post('nic')){
			$this->form_validation->set_rules('nic','NIC NO','trim|min_length[10]|max_length[10]|callback_nic_check');
		}
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->data['roles'] = $this->user_model->getRoles();//to load selection role data
			$this->data['users']=$this->user_model->userView($userid);//to load user data

			$this->load->view('cc/module/user/updateuser', $this->data);
		}else{
			
			$updated=$this->user_model->updateUser($userid);
			if($updated){
			$this->session->set_flashdata('success_msg', 'User Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/user/manageuser/'.$pageno.'');
			
		}
			
	}
	
	//update user password
	public function updateuserpassword() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage User', base_url('cc/user/manageuser'));
		$this->mybreadcrumb->add('Update User', base_url('cc/user/updateuser'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$userid = $this->input->post("uid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		$currentpassword=$this->user_model->currentPassword($userid);
		 
		$this->form_validation->set_rules('opassword','Old Password','trim|required|min_length[6]|max_length[15]|callback_oldpassword_check['.$currentpassword.']');
		$this->form_validation->set_rules('npassword','New Password','trim|required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('cpassword','Confirm Password','trim|required|min_length[6]|max_length[15]|matches[npassword]');
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->data['roles'] = $this->user_model->getRoles();//to load selection role data
			$this->data['users']=$this->user_model->userView($userid);//to load user data

			$this->load->view('cc/module/user/updateuser', $this->data);
		}else{
			
			$updated=$this->user_model->updatePassword($userid);
			if($updated){
			$this->session->set_flashdata('success_msg', 'Password Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/user/manageuser/'.$pageno.'');
			
		}
			
	}
	
	//delete user process
	public function deleteuserprocess() {
		$userid = $this->input->get("u_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$deleted=$this->user_model->deleteUser($userid);
		if($deleted){
			$this->session->set_flashdata('success_msg', 'User Deleted Successfully.');
		}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
		}
		redirect('cc/user/manageuser/'.$pageno.'');  
			
	}
	
	//delete user select process
	public function deleteuserselectprocess() {
		$userid = $this->input->get("u_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$data = $this->input->post('checklist');
		$selected=$this->user_model->deleteUserSelect($data);
		if($selected){
			$this->session->set_flashdata('success_msg', 'Selected User Deleted Successfully.');
		}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
		}
		
		redirect('cc/user/manageuser/'.$pageno.'');  
			
	}
	
	//user notifiaction
	public function usernotifiaction() {
		$action = $this->input->get("action");//get ction
		$userid = $this->input->get("u_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'read'){
			$this->user_model->read_user($userid,$action);
			$this->session->set_flashdata('success_msg', 'Mark as Read Successfully.');
			redirect('cc/user/usernotification/'.$pageno.'');
		}else{
			$this->user_model->read_user($userid,$action);
			$this->session->set_flashdata('success_msg', 'Mark as Unread Successfully.');
			redirect('cc/user/usernotification/'.$pageno.'');
		}
    }
	
	
	
	/*----------VALIDATION AREA------------------*/
	
	public function alphanumeric_check($str_in = '')
	{
			if (! preg_match("^\d{2}\d{2}\d{3}\d{4}$^", $str_in))
			{
					$this->form_validation->set_message('alphanumeric_check', 'Error Format in %s field. Check  spaces, underscores and dashes.');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
	}
	public function nic_check($str_in )
	{
			if (!preg_match("^[0-9]{9}[vVxX]$^", $str_in))
			{
					$this->form_validation->set_message('nic_check', 'Enter the valid Identity card Number.');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
	}
	public function oldpassword_check($old_password,$currentpassword)
	{
			$old_password = md5($old_password);
			$currentpassword;
			if ($old_password != $currentpassword)
			{
					$this->form_validation->set_message('oldpassword_check', 'Old password not match.');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
	}
	
	
	
}
