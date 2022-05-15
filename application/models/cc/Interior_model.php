<?php
class Interior_model extends CI_model{

//to get the count of the record
	public function records_count($searchtxt) {
        $this->db->select('count(*) as allcount');
		$this->db->from('gallery');  
		$this->db->where('g_type="interior"');
		if($searchtxt != ''){ 
        	$this->db->where("g_image");
		}
		$query = $this->db->get();
    	$result = $query->result_array();
 
    return $result[0]['allcount'];
    
    }

//to add gallery
	public function insertGallery($datas)
    {
       
       return $this->db->insert('gallery', $datas);
      
      
    }	
		
//to display gallery table
    public function getGalleries($start,$limit,$searchtxt){
    
    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('gallery'); 
	$this->db->where('g_type="interior"');
	if($searchtxt != ''){ 
    $this->db->where("g_image LIKE '%$searchtxt%'");
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
//to view interior
public function interiorView($interiorid){
    
    $this->db->select('*');
    $this->db->from('gallery');
    $this->db->where('g_id',$interiorid);
    $query = $this->db->get();
    return $query->result();
    
    }
//to view gallery
	public function galleryView(){
    
    $this->db->select('*');
    $this->db->from('gallery');
    $this->db->where('g_type="interior"');
    $query = $this->db->get();
    return $query->result();
    
    }

public function galleryallImage($data){
        
            $this -> db -> where('g_image', $data);    
            $this->db->select("g_image");
            $this->db->from('gallery');
            return $this->db->get()->row()->g_image;
        
        ///return $query->result();
    
}
//delete gallery selected
function galleryDeleteSelected($gimage)
{
	if (!empty($gimage)) {
		$this->db->where_in('g_image', $gimage);
		$this->db->delete('gallery');
	}
}
//delete gallery
public function galleryDelete()
{
	$this -> db -> where('g_type="interior"');
	$this -> db -> delete('gallery');
}
//add gallery
public function addgalleryDetails($v)
    {
		if (!empty($v)) {
		$update = array(
				'g_image'=>$v,
                'g_type'=>('interior')
                 
            ); 
		$this->db->where('g_type="interior"');
        return $this->db->insert('gallery', $update);
		}
        
    }
//to delete interior
public function currentImage($interiorid){
        $this -> db -> where('g_id', $interiorid);    
        $this->db->select("g_image");
        $this->db->from('gallery');
        return $this->db->get()->row()->g_image;
        ///return $query->result();
    
    }
//to delete interior image
public function interiorDelete($interiorid)
    {
        $this -> db -> where('g_id', $interiorid);
        $this -> db -> delete('gallery');
    }

	
//delete interior select
function interiorDeleteSelected($data)
    {
        if (!empty($data)) {
            $this->db->where_in('g_id', $data);
            $this->db->delete('gallery');
        }
    }
//delete interior select image
    public function currentallImage($data){
        
            $this -> db -> where('g_id', $data);    
            $this->db->select("g_image");
            $this->db->from('gallery');
            return $this->db->get()->row()->g_image;
        
        ///return $query->result();
    
    }


}
?>
