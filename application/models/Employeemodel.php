<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
@author:augustine jenin
 */

class Employeemodel extends CI_model
{

    public function __construct()
    {

        parent::__construct();
    }
    public function adddata($tblName,$data){
    	$this->db->insert($tblName, $data);
    	return $this->db->insert_id();
    }
    public function getDesignation($tblName){
    	$this->db->select('*');
        $this->db->from($tblName);
        $this->db->where_not_in('desigstatus', 'Deleted');
        $this->db->order_by('desigID', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getActiveDesignation($tblName){
    	$this->db->select('*');
        $this->db->from($tblName);
        $this->db->where('desigstatus', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCurrentdata($tblName,$id,$column){
    	$this->db->select('*');
        $this->db->from($tblName);
        $this->db->where($column,$id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkdesigavail($deleteID){
    	$this->db->select('*');
        $this->db->from('employee');
        $this->db->where('empDesig',$deleteID);
        $this->db->where_not_in('empStatus','Deleted');
        $query = $this->db->get();
        return $this->db->affected_rows();
    }

     public function updatedata($tblName,$data,$id,$column)
    {
        $this->db->where($column, $id);
        $this->db->update($tblName, $data);
        return $this->db->affected_rows();
    }

    public function checkemail(){ 
		$email	= $this->input->post('email');
		$empID	= $this->input->post('empID');
		$this->db->select('*');
        $this->db->from('employee');
        $this->db->where('empEmail', $email);
        if($empID){
	        $this->db->where_not_in('empID', $empID);
	    }
        $query = $this->db->get();		
		$rows = $this->db->affected_rows();
		
		if($rows!=0)
		{
			return false;
		}
		
		else
		{
			return true;
			
		}
	}
    public function getEmployees(){
    	$this->db->select('employee.*,designation.designation');
        $this->db->from('employee');
        $this->db->join('designation', 'employee.empDesig = designation.desigID ');
        $this->db->where_not_in('empStatus', 'Deleted');
        $this->db->order_by('empID', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
