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
}
?>
