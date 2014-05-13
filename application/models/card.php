<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card extends CI_Controller {

  function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
  }
  
  public function newCreditCard($customerId, $validUntil, $PIN, $limit, $statementDay){
    $cardnumber = $this->unique_id(16);
    $row1 = array (
      'card_number' => $cardnumber,
      'valid_until' => $validUntil,
      'is_approved' => 0,
      'PIN' => $PIN
    );
    
    $row2 = array (
      'card_number' => $cardnumber,
      'limit_of_card' => $limit,
      'statement_date' => $statementDay
      );
      
    $row3 = array( 
      'card_number' => $cardnumber,
      'cust_id' => $customerId
      );
    $this->db->insert('card',$row1);
    $this->db->insert('credit_card',$row2);
    $this->db->insert('credit_cards',$row3);
    
  }
}
