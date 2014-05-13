<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->load->model('bill','',TRUE);
        //$this->load->model('bank','',TRUE);
        $this->load->model('account','',TRUE);
    }
    
    public function index()
    {
       
        
	}
    
    public function listAccounts( ) {
        $session_data = $this->session->userdata('logged_in');
        
        echo"[";
        if($session_data){
            
            $uid= $session_data['username'];
            $accounts = $this-> account->getCustomerAccounts($uid);
            if($accounts){
                $f=0;
                foreach($accounts as $r){
                    if($f)
                        echo",";
                    $f=1;
                    echo "\"$r->id\"";
               }
           }
        }
        echo "]";
            
    }
    
    
    
}
