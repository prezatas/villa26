<?php
class Home_model extends CI_model{

//to display image Interiror limit 1
    public function imageInterior(){
    
    

    $this->db->select("*"); 
    $this->db->from('gallery'); 
    $this->db->where("g_type='interior'");
	$this->db->order_by("g_id", "desc");
    $this->db->limit(1);
    $query = $this->db->get();
    
    return $query->result();
    
    }   
//to display image Food and Beveragr limit 1
    public function imageFoodandBeverage(){
    
    

    $this->db->select("*"); 
    $this->db->from('gallery'); 
    $this->db->where("g_type='fandb'");
	$this->db->order_by("g_id", "desc");
    $this->db->limit(1);
    $query = $this->db->get();
    
    return $query->result();
    
    }   
}
?>
