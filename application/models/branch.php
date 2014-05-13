<?php
Class Branch extends CI_Model
{
 function add($bankId,$name,$address)
 {
    $row = array (
      'bank_id' => $bankId,
      'name' => $name,
      'address' => $address,
      'balance' => 0
    );
   $this -> db -> insert('branch', $row);
 }
 
 function get($bankId, $branchName ){
   $this -> db -> where('bank_id', $bankId);
   $this -> db -> where('name', $branchName);
   $this -> db -> limit(1);

   $query = $this->db->get('branch');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 function getBranchList($bankId){
	$this->db->where('bank_id', $bankId);

	$query = $this->db->get('branch');
	if($query -> num_rows() > 0) {
		return $query->result();
	}else {
		return false;
	}

 }
 
}
?>
 
