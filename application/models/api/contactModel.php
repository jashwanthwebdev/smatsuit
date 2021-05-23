<?php

class contactModel extends CI_Model{
	
	
	public function __construct(){
		
		parent::__construct();
		$this->load->database();
	}
	
	##INSERT RECORDS
	public function createContact($data= []){
		
		return $this->db->insert('contact_tb',$data); 
	}
	  
	#GET CONTACT NUMBER
	public function getContact($data = ''){
		 
		$result = $this->db->select('data_store')->from('contact_tb')->where('contact_id',$data)->get()->row_array();
		if($result){ 
			return $this->db->select('mobile_number')->from('contact_tb')->where('data_store',$result['data_store'])->get()->row_array();
		} 
		
	}   
	
	## UPDATE CONTACT
	public function updateContact($contact_id,$email,$mobile_number){
		
		$result = $this->db->select('data_store')->from('contact_tb')->where('contact_id',$contact_id)->get()->row_array(); 
		if($result){ 
			return $this->db->where('data_store',$result['data_store'])->where('contact_id',$contact_id)->update('contact_tb',[
			'email'=>$email,  
			'mobile_number'=>$mobile_number  
			]);
		}       
	}
	  
	## DELETE COTACT
	public function deleteContact($contact_id){
		$result = $this->db->select('data_store')->from('contact_tb')->where('contact_id',$contact_id)->get()->row_array(); 
		if($result){
		   return $this->db->where('data_store',$result['data_store'])->where('contact_id',$contact_id)->delete('contact_tb'); 
		}   
	} 
	 
	 ## SEARCH DATA
	public function getContactSearch($search){
		$this->db->select('*'); 
		$this->db->from('contact_tb');
		if(!empty($search)) {  
			$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->group_end();
		} 
		$query = $this->db->get();   

		return $query->result_array();
	}
	
	
	
	
}  


?>