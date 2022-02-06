<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->desigTbl='designation';
        $this->emplTbl='employee';

        $this->smtpprotocol='';
		$this->smtp_host='';

		$this->smtp_user='';
		$this->smtp_pass='';
		$this->smtp_fromname=''; 
    }
	public function index()
	{
		$employees 			= $this->Employeemodel->getEmployees();
		$designation 		=$this->Employeemodel->getDesignation($this->desigTbl);
		$data['empcount'] 	= count($employees);
		$data['desigcount']	= count($designation);
		$this->load->view('dashboard',$data);
	}
	public function designationadd(){
		if($this->input->post('submitbtn')){

			date_default_timezone_set('Asia/Kolkata');
		    $curntTime	= date('Y-m-d H:i:s', time());

			$data = array(
                    'designation' => $this->input->post('name'),
                    'desigstatus' => $this->input->post('status'),
                    'createdOn'   => $curntTime
                );
			$result=$this->Employeemodel->adddata($this->desigTbl,$data);
			if($result>0){
				$this->session->set_flashdata('msg',"Succesfully Insert"); 
				redirect('designationlist');
			}else{
				$this->session->set_flashdata('msg',"Can't Insert"); 
				$this->load->view('designationadd');
			}
		}else{
			$this->load->view('designationadd');
		}
	}
	public function designationedit(){
		if($this->input->post('submitbtn')){
			$desigID=$this->input->post('desigID');
			date_default_timezone_set('Asia/Kolkata');
		    $curntTime	= date('Y-m-d H:i:s', time());

			$data = array(
                    'designation' => $this->input->post('name'),
                    'desigstatus' => $this->input->post('status'),
                    'updatedOn'   => $curntTime
                );
			$column = 'desigID';
			$result = $this->Employeemodel->updatedata($this->desigTbl,$data,$desigID,$column);
			if($result>0){
				$this->session->set_flashdata('msg',"Succesfully Update"); 
			}else{
				$this->session->set_flashdata('msg',"Can't Update"); 
			}
			redirect('designationlist');
		}else{
			$editID=$this->input->post('editID');
			$column ='desigID';
			$data['curntdata']=$this->Employeemodel->getCurrentdata($this->desigTbl,$editID,$column);
			$this->load->view('designationadd',$data);
		}
	}
	public function checkdesigavail(){
		$deleteID		=$this->input->post('deleteID');
		$details 		= $this->Employeemodel->checkdesigavail($deleteID);
		$json_data  	= json_encode($details);
		echo $json_data;
	}
	public function designationdelete(){
		$deleteID	=$this->input->post('deleteID');
		date_default_timezone_set('Asia/Kolkata');
	    $curntTime	= date('Y-m-d H:i:s', time());

		$res 		= $this->Employeemodel->checkdesigavail($deleteID);
		if($res==0){
			$column ='desigID';
			$data 	= array(
	                   'desigstatus' => 'Deleted',
	                   'updatedOn'   => $curntTime
	                );
			$result	= $this->Employeemodel->updatedata($this->desigTbl,$data,$deleteID,$column);
			if($result>0){
				$this->session->set_flashdata('msg',"Succesfully Deleted"); 
			}else{
				$this->session->set_flashdata('msg',"Can't Delete"); 
			}
		}else{
			$this->session->set_flashdata('msg',"Can't Delete"); 
		}
		redirect('designationlist');
	}
	public function designationlist(){
		$data['designation']=$this->Employeemodel->getDesignation($this->desigTbl);
		$this->load->view('designationlist',$data);
	}
	public function employeeadd(){
		$data['designation']=$this->Employeemodel->getActiveDesignation($this->desigTbl);
		if($this->input->post('submitbtn')){
			
			$len = 8;

			//define character libraries - remove ambiguous characters like iIl|1 0oO
			$sets = array();
			$sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
			$sets[] = '0123456789';
			$password = '';
			//append a character from each set - gets first 4 characters
			foreach ($sets as $set) {
				$password .= $set[array_rand(str_split($set))];
			}
			//use all characters to fill up to $len
			while(strlen($password) < $len) {
				$randomSet = $sets[array_rand($sets)];
				$password .= $randomSet[array_rand(str_split($randomSet))];
			}
			//shuffle the password string before returning!
			$pswd= str_shuffle($password);

			date_default_timezone_set('Asia/Kolkata');
		    $curntTime	= date('Y-m-d H:i:s', time());
		    $imgName = '';
		if(!empty($_FILES['profilePic']['name']) && $_FILES['profilePic']!=='')
		{
			$image='Yes';
			$_FILES['image']=[];	
			$_FILES['image']['name'] 	 = $_FILES['profilePic']['name'];
			$_FILES['image']['type']     = $_FILES['profilePic']['type'];
			$_FILES['image']['tmp_name'] = $_FILES['profilePic']['tmp_name'];
			$_FILES['image']['error']    = $_FILES['profilePic']['error'];
			$_FILES['image']['size']     = $_FILES['profilePic']['size'];
			if(!empty($_FILES['image']['name']))
			{						
				$targetDir = "uploads/";
				$imgName  =basename($_FILES["image"]["name"]);
				$targetFile = $targetDir.$imgName;
				//echo $targetFile;
				
				move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);				
				
			}			
		}
			$data = array(
                    'empName' => $this->input->post('name'),
                    'empEmail' => $this->input->post('email'),
                    'empDesig' => $this->input->post('designation'),
                    'empPswd' => md5($pswd),
                    'empStatus' => $this->input->post('status'),
                    'empImgName' => $imgName,
                    'empCreatedOn'   => $curntTime
                );
			$result=$this->Employeemodel->adddata($this->emplTbl,$data);
			if($result>0){

				$to=$this->input->post('email');
				$from='liyatreesa98@gmail.com'; // enter email
				$username=$this->input->post('name');
			
				$config['protocol']    	= $this->smtpprotocol;
	            $config['smtp_host']    = $this->smtp_host;
	            $config['smtp_user']    = $this->smtp_user;
				$config['smtp_pass']    = $this->smtp_pass;
				$config['port']    		= 465;
	            $config['charset']   	= 'utf-8';
	            $config['newline']      = "\r\n";
	            $config['mailtype']     = 'html'; // or html
				$config['smtp_timeout'] = '60'; //in seconds
				$this->email->initialize($config);
            	$this->email->from($from, $this->smtp_fromname);
            	$this->email->to($to); 
            	$this->email->subject('Your account has been created');
            	$this->email->message('Below is your Name and password <br> Name:'.$username.'<br>Password:'.$pswd.'');  
				
				if($this->email->send())
				{
					//echo json_encode('success');
				}
				else
				{
					//show_error($this->email->print_debugger());
				}
				 

				$this->session->set_flashdata('msg',"Succesfully Insert"); 
				redirect('employeelist');
			}else{
				$this->session->set_flashdata('msg',"Can't Insert"); 
				$this->load->view('employeeadd',$data);
			}
		}else{
			$this->load->view('employeeadd',$data);
		}
	}

	public function empledit(){
		$data['designation']=$this->Employeemodel->getActiveDesignation($this->desigTbl);
		if($this->input->post('submitbtn')){
			$empID=$this->input->post('empID');
			date_default_timezone_set('Asia/Kolkata');
		    $curntTime	= date('Y-m-d H:i:s', time());

			$imgName = '';
		if(!empty($_FILES['profilePic']['name']) && $_FILES['profilePic']!=='')
		{
			$image='Yes';
			$_FILES['image']=[];	
			$_FILES['image']['name'] 	 = $_FILES['profilePic']['name'];
			$_FILES['image']['type']     = $_FILES['profilePic']['type'];
			$_FILES['image']['tmp_name'] = $_FILES['profilePic']['tmp_name'];
			$_FILES['image']['error']    = $_FILES['profilePic']['error'];
			$_FILES['image']['size']     = $_FILES['profilePic']['size'];
			if(!empty($_FILES['image']['name']))
			{						
				$targetDir = "uploads/";
				$imgName  =basename($_FILES["image"]["name"]);
				$targetFile = $targetDir.$imgName;
				//echo $targetFile;
				
				move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);				
				
			}			
		}
			$data = array(
                    'empName' => $this->input->post('name'),
                    'empEmail' => $this->input->post('email'),
                    'empDesig' => $this->input->post('designation'),
                    'empStatus' => $this->input->post('status'),
                    'empImgName' => $imgName,
                    'empUpdatedOn'   => $curntTime
                );
			$column = 'empID';
			$result = $this->Employeemodel->updatedata($this->emplTbl,$data,$empID,$column);
			if($result>0){
				$this->session->set_flashdata('msg',"Succesfully Update"); 
			}else{
				$this->session->set_flashdata('msg',"Can't Update"); 
			}
			redirect('employeelist');
		}else{
			$editID=$this->input->post('editID');
			$column ='empID';
			$data['curntdata']=$this->Employeemodel->getCurrentdata($this->emplTbl,$editID,$column);
			$this->load->view('employeeadd',$data);
		}
	}
	public function empldelete(){
		$deleteID=$this->input->post('deleteID');
		date_default_timezone_set('Asia/Kolkata');
	    $curntTime	= date('Y-m-d H:i:s', time());
		
		$column ='empID';
		$data = array(
                   'empStatus' => 'Deleted',
                   'empUpdatedOn'   => $curntTime
                );
		$result=$this->Employeemodel->updatedata($this->emplTbl,$data,$deleteID,$column);
		if($result>0){
			$this->session->set_flashdata('msg',"Succesfully Deleted"); 
		}else{
			$this->session->set_flashdata('msg',"Can't Delete"); 
		}
		redirect('employeelist');
	}
	public function checkemail(){
		$details = $this->Employeemodel->checkemail();
		$json_data  = json_encode($details);
		echo $json_data;
	}
	public function employeelist(){
		$data['employees']=$this->Employeemodel->getEmployees();
		$this->load->view('employeelist',$data);
	}
}
