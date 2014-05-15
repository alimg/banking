 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
        $this->load->model('account','',TRUE);
        $this->load->model('branch','',TRUE);
    }
    
    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $customer=$this->user->isCustomer($uid);
            if(!$customer){
                echo"yuo not custmoer";
                return;
            }
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['customer'] = $customer;
            $data['showlogout']=true;
            $this->load->view('templates/header',$data);
            $this->load->view('pages/customerHome',$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        
	}
    
    public function account(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid=$data['username'] = $session_data['username'];
        $data['accounts'] = $this->account->getCustomerAccounts($uid);
        $this->load->view('pages/customer/account',$data);
    }
    
    
    
    public function bills(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid=$data['username'] = $session_data['username'];
        $data['accounts'] = $this->account->getCustomerAccounts($uid);
        $this->load->view('pages/customer/bills',$data);
    }
    
    
    public function requests(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['branches'] = $this->branch->getBranchList($this->bank->get()[0]->bank_id);
        $this->load->view('pages/customer/requests',$data);
    }
    
    
    public function transfer(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid=$data['username'] = $session_data['username'];
        $data['accounts'] = $this->account->getCustomerAccounts($uid);
        $this->load->view('pages/customer/transfer',$data);
    }
    
    
    public function updateinfo(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid=$data['username'] = $session_data['username'];
        
        $result = $this->user->getUserInfo($uid)[0];
        $data['fname']=$result->name_first;
        $data['lname']=$result->name_last;
        $data['address']=$result->address;
        $data['bdate']=explode(" ",$result->birthdate)[0];
        $this->load->view('pages/customer/userinfo',$data);
    }
}
