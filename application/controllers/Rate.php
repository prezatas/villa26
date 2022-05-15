<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {

	function __Construct(){
		parent::__Construct ();      
		$this->load->model('rate_model');//load model 
		$this->load->model('common_model');//load model 
		$this->load->library("pagination");//load pagination
		$this->load->helper('typography');//space text
		$this->load->helper('text');
		$this->load->helper('string');//string data  
		$this->load->library('user_agent');//user data
	}
	public function index()
	{
		$searchtxt = $this->input->post("searchtxt");
		$config["base_url"] = base_url('rate/index');
		$config["total_rows"] = $this->rate_model->records_count();  
		$config["per_page"] = 9;
		$config["uri_segment"] =3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['use_page_numbers'] = true;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;
		$this->data['rates'] = $this->rate_model->getRates($page,$config["per_page"],$searchtxt); // calling Post model method getPosts()
	 
		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('rate',$this->data);
	}
	public function view()
	{
		$rateid = $this->input->get("rateid");
		
		$this->data['rates'] = $this->rate_model->viewRates($rateid);
		$this->load->view('rateview', $this->data);
	}
	
	
}
