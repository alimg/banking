 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bills extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('bill','',TRUE);
        //$this->load->model('bank','',TRUE);
        $this->load->model('account','',TRUE);
    }
    
    public function index()
    {
       
        
	}
    
    public function get( $id ) {
        $bill = $this->bill->getWithCompany($id);
        if($bill)
            echo "{\"status\":\"success\",\"amount\":\"{$bill[0]->amount}\",\"company\":\"{$bill[0]->name}\"}";
        else echo '{"status":"error"}';
    }
    
    public function pay( $id, $accountid ) {
        $bill = $this->bill->get($id);
        $session_data = $this->session->userdata('logged_in');
        
        if($bill && $session_data){
            if(!$this->bill->isPaid($id)){
                $uid=$session_data['username'];
                if($this->bill->pay($uid,$id,$accountid)) 
                    echo "success";
                else echo "Error: Transaction incomplete";
            } else echo "Error: This bill is already paid.";
        }else echo "Error: No such item";
    }
    
}
