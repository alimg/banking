<?php
Class customerAssistant extends CI_Model
{
 function changePersonal($firstName, $lastName, $address, $phone, $pass, $pass2, $uid){
	$data = array();
	$changeFlag = false;
		$alert = "";
	
	if(!empty($firstname)){
		$data['firstname'] = $firstname;
		$changeFlag = true;
	}
	if(!empty($lastName)){
		$data['lastName'] = $lastName;
		$changeFlag = true;
	}
	if(!empty($phone)){
		if(is_numeric($phone)){
			$data['phone_number'] = $phone;
			$changeFlag = true;
		}else
			$alert = $alert . "Error: The phone number needs to be numeric!\\n";
	}
	
	if(!empty($address)){
		$data['address'] = $address;
		$changeFlag = true;
	}
	
	if($changeFlag){
		$this->db->where('id', $uid);
		$this->db->update('staff', $data); 
	}
	$changeFlag = false;
	
	if(!empty($pass)){
		if($pass == $pass2){
			if(strlen($pass) >= 9){
				$data = array ('password' => $pass);
				$changeFlag = true;
			}else
				$alert = $alert . "Error: The password has to be at least 9 characters long!";
		}else
			$alert = $alert . "Error: Both passwords entered must be the same!";
	}

	if($changeFlag){
		$this->db->where('username', $uid);
		$this->db->update('user', $data); 
	}
	
	
	if(!empty($alert))
		echo "<script>alert('" . $alert . "');</script>";
	
	redirect('customerAssistantHome', 'refresh');
 }
	
 function addCustomer($firstName, $lastName, $address, $birth, $bName, $pass)
 {
	// Insert the user row.
	$cid = rand();
	$row = array (
		'username' => $cid,
		'password' => $pass
	);
	$this->db->insert('user', $row);
	
	// Insert the customer row.
	$row = array (
		'id' => $cid,
		'name_first' => $firstName,
		'name_last' => $lastName,
		'address' => $address,
		'birthdate' => $birth
	);
	
	$this->db->insert('customer', $row);
	
	// Insert the account row.
	$aid = rand();
	$iban = rand();
	
	$row = array (
		'id' => $aid,
		'bank_id' => '001', // Should stay the same
		'branch_name' => $bName,
		'IBAN' => $iban,
		'balance' => 0,
		'currency' => 'TL',
		'dateCreated' => date("y-m-d")
	);
	
	$this->db->insert('account', $row);
	
	$row = array(
		'cid' => $cid,
		'aid' => $aid
	);
	
	$this->db->insert('customer_accounts', $row);
	
	redirect('customerAssistantHome', 'refresh');
 }
 
 function addCorp($cName, $iban)
 {
	$cid = rand();
	
	$row = array (
		'company_id' => $cid,
		'name' => $cName,
		'account_IBAN' => $iban
	);
	
	$this->db->insert('corporation', $row);
	
	redirect('customerAssistantHome', 'refresh');
 }
 
 function addBusinessAcc($cid, $bName, $iban){
 
	$aid = rand();
	$tid = rand();
	
	$row = array (
		'id' => $aid,
		'bank_id' => '001', // Should stay the same
		'branch_name' => $bName,
		'IBAN' => $iban,
		'balance' => 0,
		'currency' => 'TL',
		'dateCreated' => date("y-m-d")
	);
	
	$this->db->insert('account', $row);
	
	$row = array (
		'id' => $aid,
		'tax_id' => $tid
	);
	
	$this->db->insert('business_account', $row);
	
	$row = array (
		'cid' => $cid,
		'aid' => $aid
	);
	
	$this->db->insert('customer_accounts', $row);
	
	redirect('customerAssistantHome', 'refresh');
 }
 
 function addSavingsAcc($cid, $bName, $iban, $dateEnd){
 
	$aid = rand();
	$tid = rand();
	$interest_rate = rand(1,10);
	
	$row = array (
		'id' => $aid,
		'bank_id' => '001', // Should stay the same
		'branch_name' => $bName,
		'IBAN' => $iban,
		'balance' => 0,
		'currency' => 'TL',
		'dateCreated' => date("y-m-d")
	);
	
	$this->db->insert('account', $row);
	
	$row = array (
		'id' => $aid,
		'interest_rate' => $tid,
		'date_start' => date("y-m-d"),
		'date_end' => $dateEnd
	);
	
	$this->db->insert('saving_account', $row);
	
	$row = array (
		'cid' => $cid,
		'aid' => $aid
	);
	
	$this->db->insert('customer_accounts', $row);
	
	redirect('customerAssistantHome', 'refresh');
 }
 
 function addStandardAcc($cid, $bName, $iban){
 
	$aid = rand();
	$tid = rand();
	
	$row = array (
		'id' => $aid,
		'bank_id' => '001', // Should stay the same
		'branch_name' => $bName,
		'IBAN' => $iban,
		'balance' => 0,
		'currency' => 'TL',
		'dateCreated' => date("y-m-d")
	);
	
	$this->db->insert('account', $row);
	
	$row = array (
		'cid' => $cid,
		'aid' => $aid
	);
	
	$this->db->insert('customer_accounts', $row);
	
	redirect('customerAssistantHome', 'refresh');
 }
 function searchCard($criteria){
	
	$name_first = $this->db->query('SELECT name_first FROM customer WHERE id = ' . $criteria);
	
	$name_last = $this->db->query('SELECT name_last FROM customer WHERE id = ' . $criteria);
	
	$query = $this->db->query('SELECT * FROM card NATURAL JOIN credit_cards NATURAL JOIN customer' .
		' WHERE (name_first LIKE \'' . $name_first->result()[0]->name_first . 
		'\' OR name_last LIKE \'' . $name_last->result()[0]->name_last . 
		'\') AND is_approved = FALSE AND credit_cards.card_number=card.card_number');
	
	$table = '';
	
	foreach ($query->result() as $row)
	{
		$fields = $row->id . '\t' . 
				  $row->card_number . '\t' . 
				  $row->PIN . '\t' . 
				  $row->valid_until . '\t' . 
				  $row->name_first . '\t' . 
				  $row->name_last . '\t' . 
				  $row->is_approved;
		$table = $table . '\n' . $fields;
	}
	
	return $table;
 }
 
 function searchLoan($loan){
	
	$name_first = $this->db->query('SELECT name_first FROM customer WHERE id = ' . $loan);
	
	$name_last = $this->db->query('SELECT name_last FROM customer WHERE id = ' . $loan);
	
	$query = $this->db->query('SELECT * FROM loan NATURAL JOIN borrowing NATURAL JOIN customer' .
		' WHERE (name_first LIKE \'' . $name_first->result()[0]->name_first . 
		'\' OR name_last LIKE \'' . $name_last->result()[0]->name_last . 
		'\') AND is_approved = FALSE AND loan.loan_id=borrowing.loan_id');
	
	$table = '';
	
	foreach ($query->result() as $row)
	{
		$fields = $row->id . '\t' . $row->loan_id . '\t' . 
			$row->date_given . '\t' . $row->date_due . '\t' . 
			$row->interest_rate . '\t' . $row->name_first . '\t' . 
			$row->name_last . '\t' . $row->is_approved;
		$table = $table . '\n' . $fields;
	}
	
	return $table;
 }
 
 function approveCard($card_number){
	$data = array(
		'is_approved' => 1
	);
	
	$this->db->where('card_number', $card_number);
	$this->db->update('card', $data); 
 }
 
 function approveLoan($loan_id){
	$data = array(
		'is_approved' => 1
	);
	
	$this->db->where('loan_id', $loan_id);
	$this->db->update('loan', $data); 
 }
}
?>
 
