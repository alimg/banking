<?php
Class staff extends CI_Model
{
 function add($id,$salary,$name,$surname, $phone_number,$address )
 {
  $row = array (
      'id' => $id,
      'salary' => $salary,
	  'name' => $name,
	  'surname' => $surname,
	  'phone_number' => $phone_number,
	  'address' => $address
    );
   $this -> db -> insert('staff', $row);

 }
 
 function getEmploymentList($bankId){
	$sql="SELECT * FROM staff s, works_at w WHERE bank_id='$bankId' and w.id=s.id;";

	
	$query = $this->db->query($sql);
	if($query -> num_rows() > 0) {
		return $query->result();
	}else {
		return false;
	}

 }
 function fireEmployee($id){
	$this->db->delete('works_at', array('id' => $id));
	$this->db->delete('staff', array('id' => $id));
 }
 function updateSalary($id, $salary){
	$sql="update staff set salary ='$salary' where id='$id'";

	$query = $this->db->query($sql);


 }
 
 

	 
 

 
}
?>
 
