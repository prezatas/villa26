<?php
class Event_model extends CI_model{

//to get the count of the record
   public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
		$this->db->from('event');  
		
		if($searchtxt != ''){ 
        	$this->db->where("e_title LIKE '%$searchtxt%'");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }
	
	
//to display event table
    public function getEvents($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('event'); 
	if($searchtxt != ''){ 
    $this->db->where("e_title LIKE '%$searchtxt%'");
	}
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	
	

//to add event
	
	public function addEvent($event){
        $this->db->insert('event', $event);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
//add event image	
 public function addImage($last_e_id,$dataimage)
    {
        $update = array(
            'e_image' => $dataimage

        );
        $this->db->where('e_id',$last_e_id);
        return $this->db->update('event', $update);
    }

//To activate event
	public function activate_event($eventid,$action){
	
	$this->db->query("UPDATE event SET e_status = '$action' 
	 WHERE e_id ='$eventid'");
	}
	


//to view event
	public function eventView($eventid){
    
    $this->db->select('*');
    $this->db->from('event e');
    $this->db->where('e.e_id',$eventid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to update event
	public function updateEvent($eventid,$event)
    {
        
        $this->db->where('e_id',$eventid);
       return $this->db->update('event', $event);
    }

	
//current image
	public function currentImage($eventid){
        $this -> db -> where('e_id', $eventid);    
        $this->db->select("e_image");
        $this->db->from('event');
        return $this->db->get()->row()->e_image;
        ///return $query->result();
    
    }	
//to delete event
 	public function deleteEvent($eventid)
    {
        $this -> db -> where('e_id', $eventid);
        return $this -> db -> delete('event');
    }

//current all image
	public function currentallImage($data){
        
            $this -> db -> where('e_id', $data);    
            $this->db->select("e_image");
            $this->db->from('event');
            return $this->db->get()->row()->e_image;
        
        ///return $query->result();
    
    }
//delete event select
	function deleteEventSelect($data)
    {
        if (!empty($data)) {
            $this->db->where_in('e_id', $data);
            return $this->db->delete('event');
        }
    }
//to get rate notification
	public function countRateNotifi() {
		$this->db->where("rate_view_status!='read'");
        $this->db->from('rate'); 
		return $this->db->count_all_results();
    }

//to view rate nitification
	public function rateNotifiView($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('user u'); 
    $this->db->join('user_role r', 'r.ur_id = u.user_ur_id', 'left');
	$this->db->join('rate ra', 'u.user_id = ra.rate_create_by', 'left');   
    $this->db->where("(ra.rate_title LIKE '%$searchtxt%' OR u.user_name LIKE '%$searchtxt%')AND ra.rate_view_status!='read'");
	$this->db->order_by("ra.rate_id", "desc");
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }
	


//To read rate	
	public function read_rate($rateid,$action){
	
	$this->db->query("UPDATE rate SET rate_view_status = '$action' 
	 WHERE rate_id ='$rateid'");
	}
}
?>
