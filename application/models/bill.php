<?php
Class Bill extends CI_Model
{
 function get($id)
 {
   $this -> db -> where('bill_id', $id);
   $this -> db -> limit(1);

   $query = $this->db->get('bills');
      
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 function pay($billId, $accountId){
    //TODO
    return true;
 }
 
}
?>
 
