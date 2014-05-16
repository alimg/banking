<?php
Class User extends CI_Model
{/*
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }*/
 function login($username, $password)
 {
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this->db->get('user');
    
   if($query -> num_rows() == 1)
   {
     // 
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 function isCustomer($userid) {
   $this -> db -> where('id', $userid);
   $this -> db -> limit(1);

   $query = $this->db->get('customer');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function iscustomerAssistant($userid) {
   $this -> db -> where('id', $userid);
   $this -> db -> limit(1);

   $query = $this->db->get('customer_assistant');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function isBusinessAccount($userid) {
   $this -> db -> where('id', $userid);
   $this -> db -> limit(1);

   $query = $this->db->get('business_customer');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 public function updateCustomerInfo($uid,$fname,$lname,$address,$bdate){
   $row = array ('name_first'=>$fname,
         'name_last'=>$lname,
         'address'=>$address,
         'birthdate'=>$bdate);
         
   $this->db->where('id', $uid);
   $this->db->update('customer',$row);
 }
 
 public function getUserInfo($uid){
   $this->db->where('id', $uid);
   $query = $this->db->get('customer');
   
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
}
?>
 
