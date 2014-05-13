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
 
}
?>
 
