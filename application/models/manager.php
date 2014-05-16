<?php
Class manager extends CI_Model
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
 function isManager($userid) {
   $this -> db -> where('id', $userid);
   $this -> db -> limit(1);

   $query = $this->db->get('manager');
      
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function showReport1($bName){
 
	$table = '';
	
	$query1 = $this->db->query("SELECT id, name, surname, salary, Job
		FROM Staff NATURAL JOIN (
			SELECT CA.id, ('Customer Assistant') AS Job
			FROM customer_assistant CA, works_at WA
			WHERE CA.id = WA.id
				AND WA.bname = '" . $bName . "'
		) AS T");
	
	$row = $query1->result()[0];
	
	$fields = $row->Job . '\t' . 
			  $row->id . '\t' . 
			  $row->name . '\t' . 
			  $row->surname . '\t' . 
			  $row->salary;
			  
	$table = $table . '\n' . $fields;
	
	$query2 = $this->db->query("SELECT id, name, surname, salary, Job
		FROM Staff NATURAL JOIN (
			SELECT C.id, ('Clerk') AS Job
			FROM clerk C, works_at WA
			WHERE C.id = WA.id
				AND WA.bname = '" . $bName . "'
		) AS T");
	
	$row = $query2->result()[0];
	
	$fields = $row->Job . '\t' . 
			  $row->id . '\t' . 
			  $row->name . '\t' . 
			  $row->surname . '\t' . 
			  $row->salary;
	
	$table = $table . '\n' . $fields;
	
	$query3 = $this->db->query("SELECT id, name, surname, salary, Job
		FROM Staff NATURAL JOIN(
			SELECT M.id, ('Manager') AS Job
			FROM manager M, works_at WA
			WHERE M.id = WA.id
				AND WA.bname = '" . $bName . "'
		) AS T");
			  
	$row = $query3->result()[0];
	
	$fields = $row->Job . '\t' . 
			  $row->id . '\t' . 
			  $row->name . '\t' . 
			  $row->surname . '\t' . 
			  $row->salary;

	$table = $table . '\n' . $fields;
	
	return $table;
 }
 
 function showReport2($first, $last, $type, $dateStart, $dateEnd){
			 
	$query = $this->db->query("SELECT C.id, C.name_first, C.name_last, T.amount, T.date
			FROM Transactions T, customer C 
			WHERE T.type = '" . $type .
			"' AND C.name_first = '" . $first .
			"' AND C.name_last ='" . $last . 
			"' AND (T.date > '" . $dateStart . "' AND T.date < '" . $dateEnd . "')");
	
	$table = '';
	
	foreach ($query->result() as $row)
	{
		$fields = $row->date . '\t' . 
				  $row->id . '\t' . 
				  $row->name_first . '\t' . 
				  $row->name_last . '\t' . 
				  $row->type . '\t' . 
				  $row->amount;
		$table = $table . '\n' . $fields;
	}
	
	return $table;
 }
 
  function showReport3($cid){
	$table = '';
	$query1 = $this->db->query("SELECT card_number, valid_until
			FROM card NATURAL JOIN ( 
			SELECT C.card_number, ('Account Card') AS card_type 
			FROM account_cards ACs, card C
			WHERE ACs.cid = '" . $cid . "' 
			AND ACs.card_number = C.card_number
			AND C.is_approved = TRUE ) as T");
			
	if($query1->num_rows() > 0){
		$row = $query1->result()[0];
	
		$fields = $row->card_number . '\t' . 
				  $row->valid_until;
				  
		$table = $table . '\n' . $fields;
	}
	
	$query2 = $this->db->query("SELECT card_number, valid_until 
		FROM card NATURAL JOIN( 
		SELECT C.card_number, ('Credit Card') AS card_type 
		FROM credit_cards CCs, card C 
		WHERE CCs.cust_id = '" . $cid . "' 
		AND CCs.card_number = C.card_number 
		AND C.is_approved = TRUE) as t");
	
	if($query2->num_rows() > 0){
		$row = $query2->result()[0];
		
		$fields = $row->card_number . '\t' . 
				  $row->valid_until;
				  
		$table = $table . '\n' . $fields;
	}
	
	return $table;
 }
}
?>
 
