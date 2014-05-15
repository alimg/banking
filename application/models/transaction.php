<?php
Class Transaction extends CI_Model
{
 function transaction($cid, $aid, $atm_id, $amount,$date, $type )
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
?>
