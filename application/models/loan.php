<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Loan extends CI_Model
{   
  function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
  }
   public function calculate($amount)
   {
      $amount=intval($amount);
      if($amount >10000){
         return 1.0210029;
      }
      if($amount >30000){
         return 1.031271;
      }
      return 1.0112947;
   }

   public function loanRequest($amount,$date,$interest,$uid,$branchName,$bankId)
   {
      $loanId = $this->unique_id(8);
      $row1=array('loan_id'=> $loanId,
         'date_given'=>date('Y-m-d H:i:s'),
         'date_due'=>$date,
         'amount'=>$amount,
         'interest_rate'=>$interest);
      $row2=array('loan_id'=>$loanId,
         'branch_name'=>$branchName,
         'bank_id'=>$bankId,
         'cid'=>$uid);
      $this->db->insert('loan',$row1);
      $this->db->insert('borrowing',$row2);
      
   }
   public function getLoanList($cid){
	$sql="SELECT amount, interest_rate, date_given, date_due FROM borrowing as b, loan as l, customer as c WHERE c.id = '$cid' && l.loan_id = b.loan_id;";
	$query = $this->db->query($sql);
	if($query -> num_rows() > 0) {
		return $query->result();
	}else {
		return false;
	}
   
   
   }
 
}
