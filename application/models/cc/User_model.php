<?php
class User_model extends CI_model{

//to get the count of the record
	public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
		$this->db->from('user u'); 
   		$this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left'); 
		if($searchtxt != ''){ 
        	$this->db->where("u.user_fname LIKE '%$searchtxt%' OR u.user_lname LIKE '%$searchtxt%'OR u.user_email LIKE '%$searchtxt%' OR r.ur_title LIKE '%$searchtxt%'");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }
	
//to get user roles	
	public function getRoles(){
    $this->db->select("ur_id,ur_title");
    $this->db->from('user_role');
    $query = $this->db->get();
    return $query->result();
    
    }
	
//to check the email
	public function emailCheck($email){

	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('user_email',$email);
	$query=$this->db->get();

	if($query->num_rows()>0){
		return false;
	}else{
		return true;
	}

	}

//to add user
	public function addUser($user){
        return $this->db->insert('user', $user);
    }
		
//to display user table
    public function getUsers($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('user u'); 
    $this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left'); 
	if($searchtxt != ''){ 
    $this->db->where("u.user_fname LIKE '%$searchtxt%' OR u.user_lname LIKE '%$searchtxt%'OR u.user_email LIKE '%$searchtxt%' OR r.ur_title LIKE '%$searchtxt%'");
	}
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	
//To activate user	
	public function activate_user($userid,$action){
	
	$this->db->query("UPDATE user SET user_status = '$action' 
	 WHERE user_id ='$userid'");
	}
	
//to view user
	public function userView($userid){
    
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left'); 
    $this->db->where('u.user_id',$userid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to update user
	public function updateUser($userid)
    {
        $update=array(
			'user_fname'=>$this->input->post('fname'),
			'user_lname'=>$this->input->post('lname'),
			'user_tel'=>$this->input->post('tel'),
			'user_nic'=>$this->input->post('nic'),
			'user_email'=>$this->input->post('email'),
			'user_ur_id'=>$this->input->post('role')
			
		); 
        $this->db->where('user_id',$userid);
       return $this->db->update('user', $update);
    }
//to get current password
	public function currentPassword($userid){
        
            $this -> db -> where('user_id', $userid);    
            $this->db->select("user_password");
            $this->db->from('user');
            return $this->db->get()->row()->user_password;
        
        ///return $query->result();
    
    }
//to update user
	public function updatePassword($userid)
    {
        $update=array(
			'user_password'=>md5($this->input->post('npassword'))
			
		); 
        $this->db->where('user_id',$userid);
       return $this->db->update('user', $update);
    }
//to delete user
 	public function deleteUser($userid)
    {
        $this -> db -> where('user_id', $userid);
        return $this -> db -> delete('user');
    }
	
//delete user select
	function deleteUserSelect($data)
    {
        if (!empty($data)) {
            $this->db->where_in('user_id', $data);
            return $this->db->delete('user');
        }
    }
//to get user notification
	public function countUserNotifi() {
		$this->db->where("user_view_status!='read'");
        $this->db->from('user'); 
		return $this->db->count_all_results();
    }

//to view user nitification
	public function userNotifiView($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('user u'); 
    $this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left');  
    $this->db->where("(u.user_name LIKE '%$searchtxt%' OR u.user_email LIKE '%$searchtxt%' OR r.ur_title LIKE '%$searchtxt%')AND u.user_view_status!='read'");
	$this->db->order_by("u.user_id", "desc");
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }
	


//To read user	
	public function read_user($userid,$action){
	
	$this->db->query("UPDATE user SET user_view_status = '$action' 
	 WHERE user_id ='$userid'");
	}
}
?>
