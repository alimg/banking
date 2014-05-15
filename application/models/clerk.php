<?php
Class clerk extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this->db->get('user');
      
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 function isClerk($userid) {
   $this -> db -> where('id', $userid);
   $this -> db -> limit(1);

   $query = $this->db->get('clerk');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
}
?>
 
