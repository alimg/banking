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
 
}
?>
 
