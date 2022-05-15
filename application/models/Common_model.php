<?php
class Common_model extends CI_model{
//to get user notification
	public function countUserNotifi() {
		$this->db->where("user_view_status!='read'");
        $this->db->from('user'); 
		return $this->db->count_all_results();
    }

//to get gallery notification
	public function countGalleryNotifi() {
		$this->db->where("g_view_status!='read'");
        $this->db->from('gallery'); 
		return $this->db->count_all_results();
    }
	

	
//to display user notification
	public function displayUser($usercreated) {
    
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left'); 
    $this->db->where('u.user_id',$usercreated);
    $query = $this->db->get();
    return $query->result();
    
    }


//to get guestbook notification
	public function countGuestbookNotifi() {
		$this->db->where("gb_view_status!='read'");
        $this->db->from('guestbook'); 
		return $this->db->count_all_results();
    }


//to get event notification
	public function countEventNotifi() {
		$this->db->where("event_view_status!='read'");
        $this->db->from('event'); 
		return $this->db->count_all_results();
    }

}

?>
