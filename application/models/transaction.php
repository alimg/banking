<?php
Class Transaction extends CI_Model
{
 function add($cid, $aid, $atm_id, $amount,$date, $type )
 {
	$data = array(
		'cid' => $cid ,
		'aid' => $aid ,
		'atm_id' => $atm_id ,
		'amount' => $amount ,
		'date' => $date ,
		'type' => $type 
	);

	$this->db->insert('transactions', $data); 
 }
 
 public function searchTransaction($id){
	$this->db->where("cid",$id);
	$query=$this->db->get("transactions");
	if($query->num_rows()>0){
		return $query->result();
	}else return false;
 }
 public function withdrawMoney($id,$account_id,$amount){
	$sql = "SELECT balance from account as a";
	$query = $this->db->query($sql);
	$currentBalance = $query->result()[0]->balance;
	$after = $currentBalance - $amount;
	echo "what the : $after";
	if($after >= 0){
		$data = array();
		$data['balance'] = $after;
		$this->db->where('id', $account_id);
		$this->db->update('account',$data);
		return true;
	}
	else{
		return false;
	}
 }
 public function depositMoney($id,$account_id,$amount){
	$sql = "SELECT balance from account as a";
	$query = $this->db->query($sql);
	$currentBalance = $query->result()[0]->balance;
	$after = $currentBalance + $amount;
	echo "what the : $after";
	$data = array();
	$data['balance'] = $after;
	$this->db->where('id', $account_id);
	$this->db->update('account',$data);
 }
 
 
 
}
?>
