<?php
class Guestbook_model extends CI_model{


	//to view guestbooks
    public function viewGuestbooks(){
		
	$this->db->select("*"); 
    $this->db->from("guestbook"); 
    $this->db->where("g_status='active'");
    
    $query = $this->db->get();
    
    return $query->result();	
	
	}
	
	//to add guestbook
	public function addGuestbook($guestbook){
        $this->db->insert('guestbook', $guestbook);
		$insertid = $this->db->insert_id();

        return  $insertid;
    }




}
?>
