<?php
Class Bank extends CI_Model
{
 function get()
 {
   $this -> db -> where('bank_id', '1');
   $this -> db -> limit(1);

   $query = $this->db->get('bank');
      
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 
}
?>
 
