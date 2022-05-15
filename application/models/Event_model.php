<?php
class Event_model extends CI_model{

//to get the count of the record
   public function records_count() {
        
		$q = $this -> db -> query("SELECT * FROM event WHERE  e_status='Active' ");
 		return $q -> num_rows();
        //return $this->db->count_all($query);
    }
//to display eventts
    public function getEvents($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('event e'); 
    $this->db->where("e.e_title LIKE '%$searchtxt%' AND e_status='active'");
	$this->db->order_by("e.e_id", "desc");
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	//to view events
    public function viewEvents($eventid){
		
	$this->db->select("*"); 
    $this->db->from('event'); 
    $this->db->where("e_id='$eventid'");
    
    $query = $this->db->get();
    
    return $query->result();	
	
	}




}
?>
