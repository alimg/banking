 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VirtualAtm extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
        $this->load->model('account','',TRUE);
        $this->load->model('branch','',TRUE);
        $this->load->model('transaction','',TRUE);
    }
    
    public function index(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $customer=$this->user->isCustomer($uid);
            if(!$customer){
                echo "You are not a customer";
                return;
            }
            $data['username'] = $session_data['username'];
            $bankId=$this->bank->get()[0]->bank_id;
            $data['title'] = $this->bank->get()[0]->name;
            $data['customer'] = $customer;
            $data['showlogout']=true;
            
            $data['accounts'] = $this->account->getCustomerAccounts($uid);
            $data['atms'] = $this->atm->getAtmList($bankId);
            
            $this->load->view('templates/header',$data);
            $this->load->view('pages/virtualAtm',$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function transaction(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $customer=$this->user->isCustomer($uid);
            if(!$customer){
                echo "You are not a customer";
                return;
            }
            $uid = $session_data['username'];
            $bankId=$this->bank->get()[0]->bank_id;
            $account  = $_POST['account'];
            $atm  = $_POST['atm'];
            $type  = $_POST['type'];
            $amount  = $_POST['amount'];
            
            
            redirect('customerHome', 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
}
