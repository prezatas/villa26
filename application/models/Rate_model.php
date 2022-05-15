<?php
class Rate_model extends CI_model{

//to get the count of the record
   public function records_count() {
        
		$q = $this -> db -> query("SELECT * FROM rate WHERE  r_status='Active' ");
 		return $q -> num_rows();
        //return $this->db->count_all($query);
    }
//to display rates
    public function getRates($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('rate r'); 
    $this->db->where("r.r_title LIKE '%$searchtxt%' AND r_status='active'");
	$this->db->order_by("r.r_id", "desc");
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	//to view rates
    public function viewRates($rateid){
		
	$this->db->select("*"); 
    $this->db->from('rate'); 
    $this->db->where("r_id='$rateid'");
    
    $query = $this->db->get();
    
    return $query->result();	
	
	}




}
?>
