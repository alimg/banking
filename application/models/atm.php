<?php
Class atm extends CI_Model
{
 function add($atm_id,$address,$balance,$branch_name, $bank_id )
 {
  $row = array (
      'atm_id' => $atm_id,
      'address' => $address,
      'balance' => $balance
    );
	echo "<script> alert(" .$balance . "); </script>";
   $this -> db -> insert('atm', $row);
 
	 $row = array (
      'atm_id' => $atm_id,
      'branch_name' => $branch_name,
      'bank_id' => $bank_id
    );
   $this -> db -> insert('atms', $row);
   
 
 }
 
 function getAtmList($bankId){
	$sql="SELECT * FROM atms R, atm A WHERE bank_id='$bankId' and R.atm_id=A.atm_id;";
	$query = $this->db->query($sql);
	if($query -> num_rows() > 0) {
		return $query->result();
	}else {
		return false;
	}

 }
 function deleteAtm($atm_id){
	$this->db->delete('atms', array('atm_id' => $atm_id));
	$this->db->delete('atm', array('atm_id' => $atm_id)); 
	 
 
 }
 
}
?>
 
