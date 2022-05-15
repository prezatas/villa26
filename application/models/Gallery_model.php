<?php
class Gallery_model extends CI_model{

/*//to get  gallery types interior
	public function getGalleryInterior() {
		$this->db->select("gt_title"); 
		$this->db->from('gallery_type'); 
		$this->db->where('gt_id',1); 
		return $this->db->get()->row()->gt_title;
    }

//to get  gallery types food $ beverage
	public function getGalleryFandB() {
		$this->db->select("gt_title"); 
		$this->db->from('gallery_type'); 
		$this->db->where('gt_id',2); 
		return $this->db->get()->row()->gt_title;
    }

*/
//to get the count of the record
    public function records_count($gtype) {
        
		$q = $this -> db -> query("SELECT * FROM gallery WHERE g_type='$gtype'");
 		return $q -> num_rows();
        //return $this->db->count_all($query);
    }
	
	
//to display get gallery
    public function getGallery($start,$limit,$gtype){
    

    $page = $start-1;
    if ($page<0) { 
            $page = 0;
    }
    $from = $page*$limit;
    $this->db->select("*"); 
    $this->db->from('gallery');   
    $this->db->where("g_type='interior'");
    $this->db->limit($limit, $from);
    
    $query = $this->db->get();
    
    return $query->result();
    
    }
 //to display gallery Interiror limit 4
    public function galleryInterior(){
    
    

    $this->db->select("*"); 
    $this->db->from('gallery'); 
	$this->db->where("g_type='interior'");
	$this->db->order_by("g_id", "desc");
    $this->db->limit(3);
    $query = $this->db->get();
    
    return $query->result();
    
    }   



//to display gallery food and beverage limit 4
    public function galleryFoodandBeverage(){
    
    

    $this->db->select("*"); 
    $this->db->from('gallery'); 
 	$this->db->where("g_type='fandb'");
	$this->db->order_by("g_id", "desc");
    $this->db->limit(3);
    $query = $this->db->get();
    
    return $query->result();
    
    }		

}
?>
