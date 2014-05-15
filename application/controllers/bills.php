 
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
        $bill = $this->bill->get($id);
        if($bill)
            echo $bill[0]->amount;
        else echo "";
    }
    
    public function pay( $id, $accountid ) {
        $bill = $this->bill->get($id);
        $session_data = $this->session->userdata('logged_in');
        
        if($bill && $session_data){
            //$uid=$session_data['username'];
            //$accounts = $this->account->getCustomerAccounts($uid);
            if($this->bill->pay($id,$accountid)) 
                echo "success";
            else echo "error";
        }else echo "error";
    }
    
}
