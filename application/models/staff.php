<?php
Class staff extends CI_Model
{
 function add($id,$salary,$name,$surname, $phone_number,$address,$password, $bank_id, $branch_name )
 {
	//for insert to user table
	$row = array (
      'username' => $id,
	  'password' => $password
    );
	
	$this->db->insert('user', $row);
	
	//then insert to staff table
	$row = array (
      'id' => $id,
      'salary' => $salary,
	  'name' => $name,
	  'surname' => $surname,
	  'phone_number' => $phone_number,
	  'address' => $address
    );

   $this -> db -> insert('staff', $row);
   
   //insert works_at relation
   $row = array (
      'id' => $id,
      'bank_id' =>$bank_id,
	  'bname' => $branch_name
    );

   $this -> db -> insert('works_at', $row);

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
	$this->db->delete('manager', array('id' => $id));
	$this->db->delete('clerk', array('id' => $id));
	$this->db->delete('customer_assistant', array('id' => $id));
	$this->db->delete('staff', array('id' => $id));
	
 }
 function updateSalary($id, $salary){
	$sql="update staff set salary ='$salary' where id='$id'";

	$query = $this->db->query($sql);
 }
 function addManager($id,$admin){
	$row = array (
      'id' => $id,
	  'admin' => $admin
    );
   $this -> db -> insert('manager', $row);
 }
 function addClerk($id,$title){
	$row = array (
      'id' => $id,
	  'title' => $title
    );
   $this -> db -> insert('clerk', $row);
 }
  function addAssistant($id){
	$row = array (
      'id' => $id
	
    );
   $this -> db -> insert('customer_assistant', $row);
 }
  function updateInfo($id,$salary,$name,$surname, $phone_number,$address, $password){
	$data = array();
	$change = false;
	if(!empty($salary)){
		$data['salary'] = $salary;
		$change= true;
	}
	if(!empty($name)){
		$data['name'] = $name;
		$change= true;
	}
	if(!empty($surname)){
		$data['surname'] = $surname;
		$change= true;
	}
	if(!empty($phone_number)){
		$data['phone_number'] = $phone_number;
		$change= true;
	}
	if(!empty($address)){
		$data['address'] = $address;
		$change= true;
	}
	if($change){
		$this->db->where('id', $id);
		$this->db->update('staff', $data); 
	}
	$change= false;
	$data = array();
	if(!empty($password)){
		$data['password'] = $password;
		$change= true;
	}
	if($change){
		$this->db->where('username', $id);
		$this->db->update('user', $data); 
	}
  
  }


	 
 

 
}
?>
 
