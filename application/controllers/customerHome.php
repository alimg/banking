 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
        $this->load->model('account','',TRUE);
    }
    
    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $customer=$this->user->isCustomer($uid);
            
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
        $data['username'] = $session_data['username'];
        $uid=$session_data['username'];
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
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customer/bills');
    }
    
    
    public function requests(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customer/requests');
    }
    
    
    public function transfer(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customer/transfer');
    }
    
    
    public function updateinfo(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customer/userinfo');
    }
}
