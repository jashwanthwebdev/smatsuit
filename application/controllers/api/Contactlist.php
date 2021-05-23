<?php

require APPPATH.'libraries/REST_Controller.php';


class Contactlist extends REST_Controller{   
	
	 
	public function __construct(){  
		
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('api/contactModel');
	}
	
##----------------------------------------------------------------------
	## CREATE CONTACT LIST
##--------------------------------------------------------------------------
	public function createContact_post()
	{ 
	    #Get Post values and evaluating security
		$first_name = $this->security->xss_clean($this->input->post('first_name'));
		$last_name = $this->security->xss_clean($this->input->post('last_name'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$mobile_number = $this->security->xss_clean($this->input->post('mobile_number'));
		$data_store = $this->security->xss_clean($this->input->post('data_store'));
		 
		#validation of values 
		$this->form_validation->set_rules("first_name","First Name","required");
		$this->form_validation->set_rules("last_name","Last Name","required");
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("mobile_number","Mobile Number","required");
		$this->form_validation->set_rules("data_store","Store Data","required");
		
		#checking validation
		if($this->form_validation->run() === FALSE){
			$this->response(array(
			'status'=>0, 
			'message'=>'Please Enter Correct Format Data'
			),REST_Controller::HTTP_NOT_FOUND); 
			
		}
		
		#checking values is not empty
		if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($mobile_number) && !empty($data_store)){
			
			$contact = array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'email'=>$email,
			'mobile_number'=>$mobile_number,
			'data_store'=>$data_store
			);
			 
			# Records inserting into contact table 
			if($this->contactModel->createContact($contact)){
				
				$this->response(array(
				'status'=>1,
				'message'=>'Contact Created Successfully'
				),REST_Controller::HTTP_OK);
			}else{
				$this->response(array(
				'status'=>0, 
				'message'=>'Failed to create contact'
				),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			
		}else{
			$this->response(array(
			'status'=>0,
			'message'=>'All Fields Are Required'
			),REST_Controller::HTTP_NOT_FOUND);
		}
	} 

##-------------------------------------------------------------------------------------
    ## GET CONTACT DETAILS
##----------------------------------------------------------------------------------------	
	
	public function getContact_get() 
	{
		# storing value form query params
		$contact_id = $this->input->get('contact_id'); 
	    
		#checking empty or not
		if(!empty($contact_id)){ 
			 
			#send Id to model to get mobile number 
			$data = $this->contactModel->getContact($contact_id); 
			if($data){ 
				$this->response(array(
				 'status'=>1,  
				 'message'=>$data['mobile_number']    
				),REST_Controller::HTTP_OK);   
			}else{  
				$this->response(array(    
				 'status'=>0, 
				 'message'=>'Sorry No Contact Found...'
				),REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			$this->response(array( 
			 'status'=>0,
			 'message'=>'Sorry..!! Required contact id'
			),REST_Controller::HTTP_NOT_FOUND); 
		}
		
	}
	
##----------------------------------------------------------------------------------------
    ## UPDATE RECORDS 
##-------------------------------------------------------------------------------------------
	
	public function updateContact_put(){
		
		#values from an json data for update of records
		$data = json_decode(file_get_contents('php://input'));
		$contact_id = isset($data->contact_id) ? $data->contact_id : ''; 
		$email = isset($data->email) ? $data->email : '';  
		$mobile_number = isset($data->mobile_number) ? $data->mobile_number: ''; 
		
		#checking contact id
		if($contact_id){
			    if($this->contactModel->updateContact($contact_id,$email,$mobile_number)){
                    $this->response(array(  
					 'status'=>1,
					 'message'=>'Email and Mobile Number updated successfully' 
					),REST_Controller::HTTP_OK);
			    }else{
                    $this->response(array( 
					 'status'=>0,
					 'message'=>'Sorry..!! Unable to update records'
					),REST_Controller::HTTP_NOT_FOUND);
                }				 
		}else{
			$this->response(array( 
			 'status'=>0,
			 'message'=>'Sorry..!! Required contact id'
			),REST_Controller::HTTP_NOT_FOUND);
		}
	} 

##----------------------------------------------------------------------------------------
    ## DELETING RECORDS
##-----------------------------------------------------------------------------------------


	public function deleteContact_post(){  
	
	    #Get contact Id to delete
		if($this->input->get('contact_id')){
			$contact_id = $this->input->get('contact_id');
			
			#passing data to delete records
			if($this->contactModel->deleteContact($contact_id)){
				    $this->response(array(  
					 'status'=>1,
					 'message'=>'Record Deleted Successfully'
					),REST_Controller::HTTP_OK);
			}else{
				    $this->response(array(    
					 'status'=>0, 
					 'message'=>'Sorry..!! Unable to update records'
					),REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			$this->response(array( 
			 'status'=>0,
			 'message'=>'Sorry..!! Required contact id'
			),REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	
##-------------------------------------------------------------------------------------------
    ## GET DATA SEARCH WISE
##-------------------------------------------------------------------------------------------

	
	public function getContactSearch_get(){
		
		#Get Search Value  
		if($this->input->get('searchbyname')){
			$search = $this->input->get('searchbyname');
			$data = $this->contactModel->getContactSearch($search);
		    if($data){ 
				$this->response(array(  
				 'status'=>1, 
				 'message'=>$data 
				),REST_Controller::HTTP_NOT_FOUND);
			}else{
				$this->response(array(  
				 'status'=>0, 
				 'message'=>'Sorry..!! No Records Found'
				),REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			$this->response(array( 
			 'status'=>0,  
			 'message'=>'Sorry..!! Search Cannot be empty'
			),REST_Controller::HTTP_NOT_FOUND);
		}
	} 
	
	
	
	
	
}



?>