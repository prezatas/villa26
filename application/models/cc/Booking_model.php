<?php
class Booking_model extends CI_model{

//to get the count of the record
    public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
    	$this->db->from('booking');
		if($searchtxt != ''){ 
    		$this->db->where("b_checkin LIKE '%$searchtxt%' OR b_checkout LIKE '%$searchtxt%' OR b_fname LIKE '%$searchtxt%' OR b_lname LIKE '%$searchtxt%' OR b_email LIKE '%$searchtxt%'");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }
	
//to add booking
	public function addBooking($booking){
        $this->db->insert('booking', $booking);
		$insertid = $this->db->insert_id();

        return  $insertid;
    }


	
//to display booking table
    public function getBookings($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('booking');
	if($searchtxt != ''){ 
    $this->db->where("b_checkin LIKE '%$searchtxt%' OR b_checkout LIKE '%$searchtxt%' OR b_fname LIKE '%$searchtxt%' OR b_lname LIKE '%$searchtxt%' OR b_email LIKE '%$searchtxt%'");
	}
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	
	
//to view booking
	public function bookingView($bookingid){
    
    $this->db->select('*');
    $this->db->from('booking');
    $this->db->where('b_id',$bookingid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to update booking
	public function updateBooking($bookingid)
    {
        $update=array(
			'b_checkin'=>$this->input->post('checkin'),
			'b_checkout'=>$this->input->post('checkout'),
			'b_country'=>$this->input->post('country'),
			'b_nog'=>$this->input->post('nog'),
			'b_nor'=>$this->input->post('nor'),
			'b_fname'=>$this->input->post('fname'),
			'b_lname'=>$this->input->post('lname'),
			'b_email'=>$this->input->post('email'),
			'b_tel'=>$this->input->post('tel'),
			'b_comment'=>$this->input->post('comment')	
		); 
        $this->db->where('b_id',$bookingid);
       return $this->db->update('booking', $update);
    }

//to delete guestbook
 	public function deleteBooking($bookingid)
    {
        $this -> db -> where('b_id', $guestbookid);
        return $this -> db -> delete('booking');
    }
	
//delete booking select
	function deleteBookingSelect($data)
    {
        if (!empty($data)) {
            $this->db->where_in('b_id', $data);
            return $this->db->delete('booking');
        }
    }
//To activate booking
	public function activate_booking($bookingid,$action){
	
	$this->db->query("UPDATE booking SET b_status = '$action' 
	 WHERE b_id ='$bookingid'");
	}



}
?>
