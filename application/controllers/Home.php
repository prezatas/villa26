<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
function __Construct(){
		parent::__Construct ();      
		$this->load->model('home_model');//load model 
		/*$this->load->model('common_model');//load model 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
		 $this->load->helper('string');//string data  
		 $this->load->library('user_agent');//user data*/
	}
	public function index()
	{
		$this->data['ids'] = $this->home_model->imageInterior();
		$this->data['fbs'] = $this->home_model->imageFoodandBeverage();
		$this->load->view('home', $this->data);
	}
}
