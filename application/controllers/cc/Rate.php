<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/rate_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
	}
	
	public function index()
	{
		
	}
	//to goto addrate page
	public function addrate(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Rate', base_url('cc/rate/addrate'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		$this->load->view('cc/module/rate/addrate',  $this->data);
	}
	//process of add rate
	public function addrateprocess(){  
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Rate', base_url('cc/rate/addrate'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  	
		
		$this->form_validation->set_rules('rtitle','Rate Title','required|max_length[20]');
		if($this->input->post('bed')){
			$this->form_validation->set_rules('bed','Bed','required|max_length[4]|callback_numeric_wcomma');
		}
		if($this->input->post('size')){
			$this->form_validation->set_rules('size','Size','required|max_length[4]|callback_numeric_wcomma');
		}
		
		$this->form_validation->set_rules('price','Price','required|max_length[4]');
		$this->form_validation->set_rules('description','Description','required|max_length[500]');

		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('cc/module/rate/addrate', $this->data);
		}
		
		else{
			$rate=array(
				'r_title'=>$this->input->post('rtitle'),
				'r_bed'=>$this->input->post('bed'),
				'r_size'=>$this->input->post('size'),
				'r_price'=>$this->input->post('price'),
				'r_description'=>$this->input->post('description'),
				'r_status'=>('active'),				
				'r_view_status'=>('unread'),
				'r_date'=>date('Y-m-d H:i:s')
				
				
			); 
			
			$last_r_id=$this->rate_model->addRate($rate);
			
			
			
			
			
			//image upload
			
            $config['upload_path'] = 'assets/img/rate';
			$config['file_name']     = $last_r_id.'_'.substr(md5(rand()),0,7);
            $config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = FALSE;
            $config['max_size'] = '0';
            $config['width']     = '0';
            $config['height']   = '0';
			
			
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image')) {
                echo $this->upload->display_errors();
            } else {
				
				
                      //here $file_data receives an array that has all the info
                      //pertaining to the upload, including 'file_name'
                		$file_data = $this->upload->data();
               			/* $this->load->library('image_lib');

						 
						 $configSize1['image_library']   = 'gd2';
						 $configSize1['source_image']    = $file_data["full_path"];
						 $configSize1['new_image']       = 'thumb_'.$file_data["file_name"];
						 $configSize1['image_type']      = $file_data['image_type'];
						 $configSize1['create_thumb']    = FALSE;
						 $configSize1['maintain_ratio']  = FALSE;
						 $configSize1['width']           = 900;
						 $configSize1['height']          = 900;
						
						 
						 
						 $this->image_lib->initialize($configSize1);
						 $this->image_lib->resize();
						 //$this->image_lib->crop();
						 $this->image_lib->clear();*/
						 
						
						 
						 
                         $dataimage    =  $file_data["file_name"] ;//before crop name
						// $datacropimage    =  $configSize1['new_image'] ;//after crop name
					
			}
			
			 		$imageadd=$this->rate_model->addImage($last_r_id,$dataimage);
                    if($imageadd){
						$this->session->set_flashdata('success_msg', 'Rate Added Successfully.');
					}else{
						$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
					}
					redirect('cc/rate/managerate');
                  
				
		}
        
	}
	//to goto view rate page
	public function viewrate()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Rate', base_url('cc/rate/managerate'));
		$this->mybreadcrumb->add('View Rate', base_url('cc/rate/viewrate'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$rateid = $this->input->get("r_id");  //get userid   
        $this->data['rates']=$this->rate_model->rateView($rateid);
		$this->load->view('cc/module/rate/viewrate', $this->data);
	}
	//to goto rate notification
	public function ratenotification()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Rate Notification', base_url('cc/rate/ratenotification'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		  
        $searchtxt = $this->input->post("searchtxt");
		$config["base_url"] = base_url('cc/rate/ratenotification');
		$config["total_rows"] = $this->rate_model->countRateNotifi();  
		$config["per_page"] = 9;
		$config["uri_segment"] =4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['rates'] = $this->rate_model->rateNotifiView($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
	 
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/rate/ratenotification', $this->data); // load the view file , we are passing $data array to view file
	}
	
	//rate notifiaction
	public function ratenotifiaction() {
		$action = $this->input->get("action");//get ction
		$rateid = $this->input->get("r_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'read'){
			$this->rate_model->read_rate($rateid,$action);
			$this->session->set_flashdata('success_msg', 'Mark as Read Successfully.');
			redirect('cc/rate/ratenotification/'.$pageno.'');
		}else{
			$this->rate_model->read_rate($rateid,$action);
			$this->session->set_flashdata('success_msg', 'Mark as Unread Successfully.');
			redirect('cc/rate/ratenotification/'.$pageno.'');
		}
    }
	
	//to goto update rate page
	public function updaterate() {

		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Rate', base_url('cc/rate/managerate'));
		$this->mybreadcrumb->add('Update Rate', base_url('cc/rate/updaterate'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$rateid = $this->input->get("r_id");  //get userid  
		
		
		$this->data['rates']=$this->rate_model->rateView($rateid);
		$this->load->view('cc/module/rate/updaterate', $this->data); // load the view file , we are passing $data array to view file
			
			
	}
	//update rate process
	public function updaterateprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Rate', base_url('cc/rate/managerate'));
		$this->mybreadcrumb->add('Update Rate', base_url('cc/rate/updaterate'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$rateid = $this->input->post("rid");  //get rateid 
		$pageno = $this->input->post("pageno");  //get pageno 
		$oldimage=$this->input->post("oldimage");
		
		$this->form_validation->set_rules('rtitle','Rate Title','required|max_length[20]');
		if($this->input->post('bed')){
			$this->form_validation->set_rules('bed','Bed','required|max_length[4]|callback_numeric_wcomma');
		}
		if($this->input->post('size')){
			$this->form_validation->set_rules('size','Size','required|max_length[4]|callback_numeric_wcomma');
		}
		
		$this->form_validation->set_rules('price','Price','required|max_length[4]');
		$this->form_validation->set_rules('description','Description','required|max_length[500]');


		
		if ($this->form_validation->run() == FALSE) {
			$this->data['rates']=$this->rate_model->rateView($rateid);//to load rate data
			$this->load->view('cc/module/rate/updaterate', $this->data);
		}else{
			
			$rate=array(
				
				'r_title'=>$this->input->post('rtitle'),
				'r_bed'=>$this->input->post('bed'),
				'r_size'=>$this->input->post('size'),
				'r_price'=>$this->input->post('price'),
				'r_description'=>$this->input->post('description')
				
			); 
			
			$updated=$this->rate_model->updateRate($rateid,$rate);
			if($updated){
			$this->session->set_flashdata('success_msg', 'Rate Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/rate/managerate/'.$pageno.'');
			
		}
			
	}
	//update rate image process
	public function updateimageprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Rate', base_url('cc/rate/managerate'));
		$this->mybreadcrumb->add('Update Rate', base_url('cc/rate/updaterate'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$rateid = $this->input->post("rid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		$oldimage=$this->input->post("oldimage");
		
		
		if($_FILES['image']['name']==""){//image not upload
				
				echo $dataimage    =  $oldimage;
				
		}else{//image upload
		
		
			$config['upload_path'] = 'assets/img/rate';
			$config['file_name']     = $rateid.'_'.substr(md5(rand()),0,7);
            $config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = FALSE;
            $config['max_size'] = '0';
            $config['width']     = '0';
            $config['height']   = '0';
			
			
            $this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')) {
					echo $this->upload->display_errors();
					
				} else {
					unlink("assets/img/rate/".$oldimage);
					$file_data = $this->upload->data();
               		$dataimage    =  $file_data["file_name"] ;//before crop name
						// $datacropimage    =  $configSize1['new_image'] ;//after crop name
					
					$imageadd=$this->rate_model->addImage($rateid,$dataimage);
					
					if($imageadd){
						$this->session->set_flashdata('success_msg', 'Rate Image Added Successfully');
					}else{
						$this->session->set_flashdata('error_msg', 'Something Went Wrong');
					}
						redirect('cc/rate/managerate'); 
				}
		}
	}
	
	//delete rate process
	public function deleterateprocess() {
		$rateid = $this->input->get("r_id");  //get rateid 
		$pageno = $this->input->get("pageno");  //get pageno 
		
		//current image delete
		$currentimage=$this->rate_model->currentImage($rateid);
			$deleteimage = unlink("assets/img/rate/".$currentimage);//remove image
			//$deletethumb = unlink("assets/img/event/".'thumb_'.$currentimage);//remove image
		if($deleteimage){   
		    $deleted=$this->rate_model->deleteRate($rateid);
		
		
			if($deleted){
				$this->session->set_flashdata('success_msg', 'Rate Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/rate/managerate/'.$pageno.'');  
		}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			redirect('cc/rate/managerate/'.$pageno.'');  
		}
			
	}
	//delete rate select process
	public function deleterateselectprocess() {
		$rateid = $this->input->get("r_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$data = $this->input->post('checklist');
		
		//to select current images
            for ($i = 0; $i < count($data); $i++) {
            	$currentimage=$this->rate_model->currentallImage($data[$i]);
               	$deleteimage = unlink("assets/img/rate/".$currentimage);//remove image
				//$deletethumb = unlink("assets/img/event/".'thumb_'.$currentimage);//remove image
				
            }
			
			if($deleteimage){   
				$deleted=$this->rate_model->deleteRateSelect($data);
			
			
				if($deleted){
					$this->session->set_flashdata('success_msg', 'Rate Deleted Successfully.');
				}else{
					$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
				}
				redirect('cc/rate/managerate/'.$pageno.'');  
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
				redirect('cc/rate/managerate/'.$pageno.'');  
			}
		
		
			
	}
	
	//rate managemant page
	public function managerate($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Rate', base_url('cc/rate/managerate'));
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
		$config["base_url"] = base_url('cc/rate/managerate');
		$config["total_rows"] = $this->rate_model->records_count($searchtxt);  
		$rowperpage=$config["per_page"] = 10;
		if($rowno != 0){
			  $rowno = ($rowno-1) * $rowperpage;
		}
		$config["uri_segment"] =4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['rates'] = $this->rate_model->getRates($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
		$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
	 
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/rate/managerate', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/rate/managerate/'.$pageno.'');
	}
	
	//rate activation process
	public function rateactivation() {
		$action = $this->input->get("action");//get ction
		$rateid = $this->input->get("r_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'active'){
			$this->rate_model->activate_rate($rateid,$action);
			$this->session->set_flashdata('success_msg', 'Rate Activate Successfully.');
			redirect('cc/rate/managerate/'.$pageno.'');
		}else{
			$this->rate_model->activate_rate($rateid,$action);
			$this->session->set_flashdata('success_msg', 'Rate Deactivate Successfully.');
			redirect('cc/rate/managerate/'.$pageno.'');
		}
    }
	//------------------validation area-----------------//
	
	function numeric_wcomma ($str)
		{
			if (!preg_match("/^[0-9]*$/", $str)){
				
				$this->form_validation->set_message('numeric_wcomma', 'Invalid Entry.');
				return FALSE;
				
			}else{
				return TRUE;
			}
			
				
		}
		
	
	
}
