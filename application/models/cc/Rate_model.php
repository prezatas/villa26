<?php
class Rate_model extends CI_model{

//to get the count of the record
   public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
		$this->db->from('rate');  
		
		if($searchtxt != ''){ 
        	$this->db->where("r_title LIKE '%$searchtxt%' OR r_bed LIKE '%$searchtxt%'");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }
	
	
//to display rate table
    public function getRates($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('rate'); 
	if($searchtxt != ''){ 
    $this->db->where("r_title LIKE '%$searchtxt%' OR r_bed LIKE '%$searchtxt%'");
	}
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	
	

//to add rate
	
	public function addRate($rate){
        $this->db->insert('rate', $rate);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
//add rate image	
 public function addImage($last_r_id,$dataimage)
    {
        $update = array(
            'r_image' => $dataimage

        );
        $this->db->where('r_id',$last_r_id);
        return $this->db->update('rate', $update);
    }

//To activate rate
	public function activate_rate($rateid,$action){
	
	$this->db->query("UPDATE rate SET r_status = '$action' 
	 WHERE r_id ='$rateid'");
	}
	


//to view rate
	public function rateView($rateid){
    
    $this->db->select('*');
    $this->db->from('rate r');
    $this->db->where('r.r_id',$rateid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to update rate
	public function updateRate($rateid,$rate)
    {
        
        $this->db->where('r_id',$rateid);
       return $this->db->update('rate', $rate);
    }

	
//current image
	public function currentImage($rateid){
        $this -> db -> where('r_id', $rateid);    
        $this->db->select("r_image");
        $this->db->from('rate');
        return $this->db->get()->row()->r_image;
        ///return $query->result();
    
    }	
//to delete rate
 	public function deleteRate($rateid)
    {
        $this -> db -> where('r_id', $rateid);
        return $this -> db -> delete('rate');
    }

//current all image
	public function currentallImage($data){
        
            $this -> db -> where('r_id', $data);    
            $this->db->select("r_image");
            $this->db->from('rate');
            return $this->db->get()->row()->r_image;
        
        ///return $query->result();
    
    }
//delete rate select
	function deleteRateSelect($data)
    {
        if (!empty($data)) {
            $this->db->where_in('r_id', $data);
            return $this->db->delete('rate');
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
