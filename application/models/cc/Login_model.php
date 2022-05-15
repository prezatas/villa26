<?php
class Login_model extends CI_model{

//to login users
	public function login_user($useremail,$userpass){
  	$this->db->select('*');
  	$this->db->from('user u');
   	$this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left');
  	$this->db->where('u.user_email',$useremail);
  	$this->db->where('u.user_password',$userpass);
	$this->db->where('u.user_status="active"');

  	if($query=$this->db->get())
  	{
      return $query->row_array();
  	}
  	else{
   	 return false;
  	}

  	}

}


?>
