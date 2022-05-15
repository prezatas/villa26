<?php
class Booknow_model extends CI_model{

//to get the count of the record
   public function records_count() {
        
		$q = $this -> db -> query("SELECT * FROM rate WHERE  r_status='Active' ");
 		return $q -> num_rows();
        //return $this->db->count_all($query);
    }
//to display nooking
    public function getBooking(){
    

    $this->db->select("*"); 
    $this->db->from('booking b'); 
    $this->db->where("b.b_status='active'");
    
    $query = $this->db->get();
    
    return $query->result();
    
    }
	
//to add booking
	public function addBooking($booking){
        return $this->db->insert('booking', $booking);
    }	



}
?>
