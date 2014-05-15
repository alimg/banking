<?php
Class Bill extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->load->model('account','',TRUE);
   }
   function get($id)
   {
   $this -> db -> where('bill_id', $id);
      $this -> db -> limit(1);

      $query = $this->db->get('bills');
         
      if($query -> num_rows() == 1)
      {
        return $query->result();
      }
      else
      {
        return false;
      }
   }

   function getWithCompany($id)
   {
      $query = $this->db->query("SELECT * FROM bills B, bill_target R, corporation C WHERE B.bill_id=$id and R.bill_id=B.bill_id and R.company_id=C.company_id");
         
      if($query -> num_rows() == 1)
      {
        return $query->result();
      }
      else
      {
        return false;
      }
   }
   
   function isPaid($billId){
      $this->db->where('bill_id',$billId);
      $query = $this->db->get('pay_bills');
      if($query->num_rows()==0)
         return false;
      return true;
   }
 
   function pay($customerId, $billId, $accountId){
      $bill = $this->getWithCompany($billId);
     
      if($bill)
      {
         $row=$bill[0];
         $company_account = $this->account->getByIBAN($row->account_IBAN);
         if($company_account){
            $res = $this->account->transfer($accountId,$company_account[0]->id,$customerId,
                  $row->amount,date('Y-m-d H:i:s'),
                  "Automatic transaction to pay bill with id $billId.");
            $pb_row = array(
                  'bill_id' => $billId,
                  'aid' => $accountId,
                  'cid' => $customerId);
            $this->db->insert('pay_bills',$pb_row);
            return true;
         }
         return false;
      }
      else
      {
        return false;
      }
    }
 
}
?>
 
