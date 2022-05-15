<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interior extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('cc/interior_model');//load model 
		$this->load->model('cc/common_model');//load model 
		$this->load->library('form_validation');//form validation 
		$this->load->library("pagination");//load pagination
		$this->load->library('session');//load session

	}
	
	public function index()
	{
		
	}
	//to goto addinterior page
	public function addinterior(){   
		//breadcrumb source
		
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Interior', base_url('cc/interior/addinterior'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
		
		
		$this->load->view('cc/module/interior/addinterior',  $this->data);
	}
	
	//add interior process
	public function addinteriorprocess(){  
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Interior', base_url('cc/interior/addinterior'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();  
		
		
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for($i=0; $i<$cpt; $i++){
			$_FILES['files']['name']= $files['image']['name'][$i];
			$_FILES['files']['type']= $files['image']['type'][$i];
			$_FILES['files']['tmp_name']= $files['image']['tmp_name'][$i];
			$_FILES['files']['error']= $files['image']['error'][$i];
			$_FILES['files']['size']= $files['image']['size'][$i];
			
			
			
			
			$uploadPath = 'assets/img/gallery';
            $config['upload_path'] = $uploadPath;
			$config['file_name']     = $i.'_'.substr(md5(rand()),0,7);
            $config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = FALSE;
            $config['max_size'] = '0';
            $config['width']     = '0';
            $config['height']   = '0';
			
			
            $this->load->library('upload', $config);
			$this->upload->initialize($config);
            if ( !$this->upload->do_upload('files')) {
                echo $this->upload->display_errors();
            } else {
				
				 $file_data = $this->upload->data();
               		/*	 $this->load->library('image_lib');

						
						 $configSize1['image_library']   = 'gd2';
						 $configSize1['source_image']    = $file_data["full_path"];
						 $configSize1['new_image']       = 'thumb_'.$file_data["file_name"];
						 $config['allowed_types'] = 'jpg|jpeg|png';
						 $configSize1['create_thumb']    = FALSE;
						 $configSize1['maintain_ratio']  = FALSE;
						 $configSize1['width']           = 900;
						 $configSize1['height']          = 900;
						
						 $this->image_lib->initialize($configSize1);
						 $this->image_lib->resize();
						 //$this->image_lib->crop();
						 $this->image_lib->clear();
						 */
						
						 
						 
                      echo   $dataimage    =  $file_data["file_name"] ;//before crop name
						 //$datacropimage    =  $configSize1['new_image'] ;//after crop name
						 
						
						$gallery=array(
						
						'g_image'=>$dataimage,
						'g_type'=>('interior')
						
					); 
			
			 		$result_set = $this->interior_model->insertGallery($gallery);
					 if($result_set){
						$this->session->set_flashdata('success_msg', 'Gallery Added Successfully.');
					 }else{
						$this->session->set_flashdata('error_msg', 'Something Went Wrong.');
					 }
			}
			
		}//end for
       	redirect('cc/interior/updateorder'.$pageno.'');
	}
	
	public function updateorder(){ 
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Interior', base_url('cc/interior/addinterior'));
		$this->mybreadcrumb->add('Update Order', base_url('cc/interior/updateorder'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render(); 
		
		$this->data['galleries']=$this->interior_model->galleryView();
		$this->load->view('cc/module/interior/updateorder', $this->data); 
	}
	
	public function updateorderprocess(){ 
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Add Interior', base_url('cc/interior/addinterior'));
		$this->mybreadcrumb->add('Update Order', base_url('cc/interior/updateorder'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render(); 
		
		$arr1= $this->input->post('arr1');
				
		//to delete marked image
		  for ($i = 0; $i < count($arr1); $i++) {
			$galleryimage=$this->interior_model->galleryallImage($arr1[$i]);
				unlink("assets/img/gallery/".$galleryimage);//remove image
		  }
		  $this->interior_model->galleryDeleteSelected($arr1);
				  
		//to delete all records belongs
		  $this->interior_model->galleryDelete();
				  
				//to add new records
				 if($arr1!=""){//if delete items  is available
				 foreach ($this->input->post('arr') as $v){
					//echo $v;
					if(!in_array($v,$arr1)) {
						
						$this->interior_model->addgalleryDetails($v);
						
					
					}else{
						echo $v;
					}
					
				 }
				 }else{//if delete item is not available
					 foreach ($this->input->post('arr') as $v){
					 $this->interior_model->addgalleryDetails($v);
					 }
				 }
				 $this->session->set_flashdata('success_msg', 'Gallery Updated Successfully.');
                 redirect('cc/interior/manageinterior/');
				//to add new records closed
                
        }
	//to goto manageinterior page
	public function manageinterior($rowno=0){   
		//breadcrumb source
        $this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Interior', base_url('cc/interior/manageinterior'));
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
		
		$config["base_url"] = base_url('cc/interior/manageinterior');
		$config["total_rows"] = $this->interior_model->records_count($searchtxt);  
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
		$this->data['galleries'] = $this->interior_model->getGalleries($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
	 	$this->data['row'] = $rowno;
	 	$this->data['search'] = $searchtxt;
		$this->data["links"] = $this->pagination->create_links();
		
		
		$this->load->view('cc/module/interior/manageinterior', $this->data); // load the view file , we are passing $data array to view file
	}
	//To search unset
	public function unsetsearch(){ 
		$this->session->unset_userdata('search');
		redirect('cc/interior/manageinterior/'.$pageno.'');
	}
	
	
	
	
	//to goto view interior page
	public function viewinterior()
	{
		//breadcrumb source
		$this->mybreadcrumb->add('Dashboard', base_url('cc/login/dashboard'));
		$this->mybreadcrumb->add('Manage Interior', base_url('cc/interior/manageinterior'));
		$this->mybreadcrumb->add('View Interior', base_url('cc/interior/viewinterior'));
		$this->data['breadcrumbs'] = $this->mybreadcrumb->render();   

		$interiorid = $this->input->get("i_id");  //get userid   
        $this->data['interiors']=$this->interior_model->interiorView($interiorid);
		$this->load->view('cc/module/interior/viewinterior', $this->data);
	}
	
	
	
	
	//delete interior process
        public function deleteinteriorprocess() {
            $interiorid = $this->input->get("i_id");  //get userid 
            $pageno = $this->input->get("pageno");  //get pageno 
            
            //to select current image
            $currentimage=$this->interior_model->currentImage($interiorid);
            unlink("assets/img/gallery/".$currentimage);//remove image
            
            
            $this->interior_model->interiorDelete($interiorid);
            $this->session->set_flashdata('success_msg', 'Project Deleted Successfully.');
            redirect('cc/interior/manageinterior/'.$pageno.'');  
                
        }
	
	//delete interior select process

        public function deleteinteriorselectprocess() {
            $interiorid = $this->input->get("i_id");  //get userid 
            $pageno = $this->input->get("pageno");  //get pageno 
            $data = $this->input->post('checklist');
            
            //to select current images
            for ($i = 0; $i < count($data); $i++) {
            $currentimage=$this->interior_model->currentallImage($data[$i]);
                unlink("assets/img/gallery/".$currentimage);//remove image
            }
            $this->interior_model->interiorDeleteSelected($data);
            $this->session->set_flashdata('success_msg', 'Interior Deleted Successfully.');
            redirect('cc/interior/manageinterior/'.$pageno.'');  
                
        }
	
	
	
	
	
}
