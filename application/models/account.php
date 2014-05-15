<?php
Class Account extends CI_Model
{
 function add($bankId,$branchName,$accountId,$IBAN, $data)
 {
    $row = array (
      'id' => $accountId,
      'bank_id' => $bankId,
      'branch_name' => $branchName,
      'IBAN' => $IBAN,
      'balance' => 0,
      'currency' => $currency,
      'dateCreated' => $date
    );
   $this -> db -> insert('account', $row);
 }
 
 function getCustomerAccounts ($customerId ){
   $sql="SELECT * FROM customer_accounts R, account A WHERE cid='$customerId' and R.aid=A.id;";
   $query = $this->db->query($sql);
   //echo $sql;
   //print_r($query->result());
   if($query -> num_rows() > 0) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function get($id){
   $this->db->where('id',$id);
   $query = $this->db->get('account');
    
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 function getByIBAN($IBAN){
   $this->db->where('IBAN',$IBAN);
   $query = $this->db->get('account');
    
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function getOwner($id){
   $query = $this->db->query("SELECT * FROM customer_accounts R, customer C WHERE R.aid='$id' and R.cid=C.id;");
    
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
 
 function transfer($from_id, $to_id,$cust_id, $amount, $date, $description){
   $row = array(
      'to_id' => $to_id,
      'from_id' => $from_id,
      'cid' => $cust_id,
      'amount' => $amount,
      'date' => $date,
      'description' => $description,
   );
   
   $query = $this->db->query("UPDATE account SET balance=balance-$amount WHERE id='$from_id';");
   if(!$query)
      return false;
   $query = $this->db->query("UPDATE account SET balance=balance+$amount WHERE id='$to_id';");
   if(!$query)
      return false;
   $query = $this->db->insert('money_transfers',$row);
   if(!$query)
      return false;
   return true;
 }
 
}
?>
 
