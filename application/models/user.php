<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
    echo " ddddd ";
    echo $username +"ddddd"+ $password;
   //$this -> db -> select('username, password');
  // $this -> db -> from('user');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this->db->get('user');
   
   print_r($query);
   
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
}
?>
 
