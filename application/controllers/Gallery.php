<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('gallery_model');//load model 
		$this->load->model('common_model');//load model 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
		$this->load->helper('string');//string data  
		$this->load->library('user_agent');//user data
	}
	public function index()
	{
	//	$this->data['interior'] = $this->gallery_model->getGalleryInterior();
	//	$this->data['FandB'] = $this->gallery_model->getGalleryFandB();
		
		$this->data['ids'] = $this->gallery_model->galleryInterior();
		$this->data['fbs'] = $this->gallery_model->galleryFoodandBeverage(); 
		$this->load->view('gallery', $this->data);
	}
	public function view()
	{
		$gallerytype= $this->uri->segment(2);
		$this->data["pagetitle"]=$gtype= ucwords(str_replace("-"," ",$gallerytype));
		
		$config["base_url"] = base_url('gallery/'.$gallerytype.'');
		$config["total_rows"] = $this->gallery_model->records_count($gtype);  
		$config["per_page"] = 16;
		$config["uri_segment"] =3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['galleries'] = $this->gallery_model->getGallery($page,$config["per_page"],$gtype); // calling Post model method getPosts()
	 
		$this->data["links"] = $this->pagination->create_links();
		
		
		
		$this->load->view('galleryview',$this->data);
	}
	
}
