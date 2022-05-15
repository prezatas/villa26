<?php
class Guestbook_model extends CI_model{

//to get the count of the record
    public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
    	$this->db->from('guestbook');
		if($searchtxt != ''){ 
    		$this->db->where("g_title LIKE '%$searchtxt%' OR g_email LIKE '%$searchtxt%' OR g_date LIKE '%$searchtxt%'");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }
	
//to add guestbook
	public function addGuestbook($guestbook){
        $this->db->insert('guestbook', $guestbook);
		$insertid = $this->db->insert_id();

        return  $insertid;
    }


	
//to display guestbook table
    public function getGuestbooks($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('guestbook');
	if($searchtxt != ''){ 
    $this->db->where("g_title LIKE '%$searchtxt%' OR g_email LIKE '%$searchtxt%' OR g_date LIKE '%$searchtxt%'");
	}
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }	
	
	
//to view guestbook
	public function guestbookView($guestbookid){
    
    $this->db->select('*');
    $this->db->from('guestbook');
    $this->db->where('g_id',$guestbookid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to update guestbook
	public function updateGuestbook($guestbookid)
    {
        $update=array(
			'g_name'=>$this->input->post('name'),
			'g_title'=>$this->input->post('title'),
			'g_email'=>$this->input->post('email'),
			'g_comment'=>$this->input->post('comment')	
		); 
        $this->db->where('g_id',$guestbookid);
       return $this->db->update('guestbook', $update);
    }

//to delete guestbook
 	public function deleteGuestbook($guestbookid)
    {
        $this -> db -> where('g_id', $guestbookid);
        return $this -> db -> delete('guestbook');
    }
	
//delete guestbook select
	function deleteGuestbookSelect($data)
    {
        if (!empty($data)) {
            $this->db->where_in('g_id', $data);
            return $this->db->delete('guestbook');
        }
    }
//To activate guestbook
	public function activate_guestbook($guestbookid,$action){
	
	$this->db->query("UPDATE guestbook SET g_status = '$action' 
	 WHERE g_id ='$guestbookid'");
	}


}
?>
