<?php
Class business extends CI_Model
{
 function makeInstallment($card_num, $tot_amount, $installment, $username)
 {
	$id = rand();
	
	$row = array (
		'id' => $id,
		'total_amount' => $tot_amount
	);
	
	$this->db->insert('installment', $row);
	
	$query = $this->db->query("SELECT CA.aid, CA.cid FROM customer C " . 
		"JOIN account A JOIN customer_accounts CA " . 
		"WHERE CA.aid=A.id AND CA.cid=" . $username);
	
	$aid = $query->result()[0]->aid;
	$cid = $query->result()[0]->cid;
	
	$row = array (
		'card_number' => $card_num,
		'ins_id' => $id,
		'a_id' => $aid,
		'c_id' => $cid
	);
	
	$this->db->insert('payment', $row);
	
	if($installment == "3mon")
		$this->makeSubInstallments(3, $id, $tot_amount);
	else if($installment == "6mon")
		$this->makeSubInstallments(6, $id, $tot_amount);
	else if($installment == "9mon")
		$this->makeSubInstallments(9, $id, $tot_amount);
	else if($installment == "11mon")
		$this->makeSubInstallments(11, $id, $tot_amount);
	
	echo "<script>
	alert('Installments made! \\n\\n\\tInstallment ID: " . $id . 
		"\\n\\t\\tSub-Installment Amount: " . ($tot_amount / $installment) . "');
	</script>";
	redirect('businessHome', 'refresh');
 }
 
 function makeSubInstallments($installment, $ins_id, $tot_amount){
	for ($i=0; $i < $installment; $i++){
		$row = array (
			'id' => $ins_id,
			'sub_id' => rand(),
			'amount' => ($tot_amount / $installment),
			'due_date' => date("Y") . "-" . ((intval(date("m")) + $installment)%12) . "-" . date("d")
		);
		$this->db->insert('sub_installment', $row);
	}
 }
}
?>
 
