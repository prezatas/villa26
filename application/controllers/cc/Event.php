<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/event_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
	}
	
	public function index()
	{
		
	}
	//to goto addevent page
	public function addevent(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Event', base_url('cc/event/addevent'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		$this->load->view('cc/module/event/addevent',  $this->data);
	}
	//process of add event
	public function addeventprocess(){  
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Event', base_url('cc/event/addevent'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  	
		
		$this->form_validation->set_rules('etitle','Event Title','required|max_length[20]');
		$this->form_validation->set_rules('description','Description','required|max_length[500]');

		
		// check for validation
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('cc/module/event/addevent', $this->data);
		}
		
		else{
			$event=array(
				'e_title'=>$this->input->post('etitle'),
				'e_description'=>$this->input->post('description'),
				'e_status'=>('active'),				
				'e_view_status'=>('unread'),
				'e_date'=>date('Y-m-d H:i:s')
				
				
			); 
			
			$last_e_id=$this->event_model->addEvent($event);
			
			
			
			
			
			//image upload
			
            $config['upload_path'] = 'assets/img/event';
			$config['file_name']     = $last_e_id.'_'.substr(md5(rand()),0,7);
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
			
			 		$imageadd=$this->event_model->addImage($last_e_id,$dataimage);
                    if($imageadd){
						$this->session->set_flashdata('success_msg', 'Event Added Successfully.');
					}else{
						$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
					}
					redirect('cc/event/manageevent');
                  
				
		}
        
	}
	//to goto view event page
	public function viewevent()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Event', base_url('cc/event/manageevent'));
		$this->mybreadcrumb->add('View Event', base_url('cc/event/viewevent'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$eventid = $this->input->get("e_id");  //get userid   
        $this->data['events']=$this->event_model->eventView($eventid);
		$this->load->view('cc/module/event/viewevent', $this->data);
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
	
	//to goto update event page
	public function updateevent() {

		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Event', base_url('cc/event/manageevent'));
		$this->mybreadcrumb->add('Update Event', base_url('cc/rate/updateevent'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$eventid = $this->input->get("e_id");  //get userid  
		
		
		$this->data['events']=$this->event_model->eventView($eventid);
		$this->load->view('cc/module/event/updateevent', $this->data); // load the view file , we are passing $data array to view file
			
			
	}
	//update event process
	public function updateeventprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Event', base_url('cc/event/manageevent'));
		$this->mybreadcrumb->add('Update Event', base_url('cc/event/updateevent'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$eventid = $this->input->post("eid");  //get rateid 
		$pageno = $this->input->post("pageno");  //get pageno 
		$oldimage=$this->input->post("oldimage");
		
		$this->form_validation->set_rules('etitle','Event Title','required|max_length[20]');
		
		$this->form_validation->set_rules('description','Description','required|max_length[500]');


		
		if ($this->form_validation->run() == FALSE) {
			$this->data['events']=$this->event_model->eventView($eventid);//to load rate data
			$this->load->view('cc/module/event/updateevent', $this->data);
		}else{
			
			$event=array(
				
				'e_title'=>$this->input->post('etitle'),
				'e_description'=>$this->input->post('description')
				
			); 
			
			$updated=$this->event_model->updateEvent($eventid,$event);
			if($updated){
			$this->session->set_flashdata('success_msg', 'Event Updated Successfully.');
			}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/event/manageevent/'.$pageno.'');
			
		}
			
	}
	//update event image process
	public function updateimageprocess() {
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Event', base_url('cc/event/manageevent'));
		$this->mybreadcrumb->add('Update Event', base_url('cc/rate/updateevent'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   
		
		$eventid = $this->input->post("eid");  //get userid 
		$pageno = $this->input->post("pageno");  //get pageno 
		$oldimage=$this->input->post("oldimage");
		
		
		if($_FILES['image']['name']==""){//image not upload
				
				echo $dataimage    =  $oldimage;
				
		}else{//image upload
		
		
			$config['upload_path'] = 'assets/img/event';
			$config['file_name']     = $eventid.'_'.substr(md5(rand()),0,7);
            $config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = FALSE;
            $config['max_size'] = '0';
            $config['width']     = '0';
            $config['height']   = '0';
			
			
            $this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image')) {
					echo $this->upload->display_errors();
					
				} else {
					unlink("assets/img/event/".$oldimage);
					$file_data = $this->upload->data();
               		$dataimage    =  $file_data["file_name"] ;//before crop name
						// $datacropimage    =  $configSize1['new_image'] ;//after crop name
					
					$imageadd=$this->event_model->addImage($eventid,$dataimage);
					
					if($imageadd){
						$this->session->set_flashdata('success_msg', 'Event Image Added Successfully');
					}else{
						$this->session->set_flashdata('error_msg', 'Something Went Wrong');
					}
						redirect('cc/event/manageevent'); 
				}
		}
	}
	
	//delete event process
	public function deleteeventprocess() {
		$eventid = $this->input->get("e_id");  //get rateid 
		$pageno = $this->input->get("pageno");  //get pageno 
		
		//current image delete
		$currentimage=$this->event_model->currentImage($eventid);
			$deleteimage = unlink("assets/img/event/".$currentimage);//remove image
			//$deletethumb = unlink("assets/img/event/".'thumb_'.$currentimage);//remove image
		if($deleteimage){   
		    $deleted=$this->event_model->deleteEvent($eventid);
		
		
			if($deleted){
				$this->session->set_flashdata('success_msg', 'Event Deleted Successfully.');
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			}
			redirect('cc/event/manageevent/'.$pageno.'');  
		}else{
			$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
			redirect('cc/event/manageevent/'.$pageno.'');  
		}
			
	}
	//delete event select process
	public function deleteeventselectprocess() {
		$eventid = $this->input->get("e_id");  //get userid 
		$pageno = $this->input->get("pageno");  //get pageno 
		$data = $this->input->post('checklist');
		
		//to select current images
            for ($i = 0; $i < count($data); $i++) {
            	$currentimage=$this->event_model->currentallImage($data[$i]);
               	$deleteimage = unlink("assets/img/event/".$currentimage);//remove image
				//$deletethumb = unlink("assets/img/event/".'thumb_'.$currentimage);//remove image
				
            }
			
			if($deleteimage){   
				$deleted=$this->event_model->deleteEventSelect($data);
			
			
				if($deleted){
					$this->session->set_flashdata('success_msg', 'Event Deleted Successfully.');
				}else{
					$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
				}
				redirect('cc/event/manageevent/'.$pageno.'');  
			}else{
				$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
				redirect('cc/event/manageevent/'.$pageno.'');  
			}
		
		
			
	}
	
	//event managemant page
	public function manageevent($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Event', base_url('cc/event/manageevent'));
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
		$config["base_url"] = base_url('cc/event/manageevent');
		$config["total_rows"] = $this->event_model->records_count($searchtxt);  
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
		$this->data['events'] = $this->event_model->getEvents($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
		$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
	 
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		
		$this->load->view('cc/module/event/manageevent', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/event/manageevent/'.$pageno.'');
	}
	
	//event activation process
	public function eventactivation() {
		$action = $this->input->get("action");//get ction
		$eventid = $this->input->get("e_id");  //get userid
		$pageno = $this->input->get("pageno");    //get pagenumber
		if($action == 'active'){
			$this->event_model->activate_event($eventid,$action);
			$this->session->set_flashdata('success_msg', 'Event Activate Successfully.');
			redirect('cc/event/manageevent/'.$pageno.'');
		}else{
			$this->event_model->activate_event($eventid,$action);
			$this->session->set_flashdata('success_msg', 'Event Deactivate Successfully.');
			redirect('cc/event/manageevent/'.$pageno.'');
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
