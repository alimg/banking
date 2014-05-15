 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clerkHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
		$this->load->model('clerk','',TRUE);
        $this->load->model('account','',TRUE);
        $this->load->model('transaction','',TRUE);
		//$this->load->model('atm','',TRUE);
		//$this->load->model('staff','',TRUE);
		
    }
    
    public function index(){
		if($this->session->userdata('logged_in'))
        {
		   $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $clerk=$this->clerk->isClerk($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['clerk'] = $clerk;
            $data['showlogout']=true;
			
            $this->load->view('templates/header',$data);
            $this->load->view('pages/clerkHome');
            $this->load->view('templates/footer',$data);
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
		
	}
	public function clerk_home(){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');   
            $uid=$session_data['username'];
            $data['showlogout']=true;
			
			$data['customer']="";
			
            $this->load->view('pages/clerk/clerk_home');
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
		
	}
	public function searchCustomer($id){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');   
            $uid=$session_data['username'];
            $data['showlogout']=true;
			
			$result=$this->transaction->searchTransaction($id);
			$accs=$this->account->getCustomerAccounts($id);
			$customerRes=$this->user->getUserInfo($id);
			
			if($customerRes){
				$data['customerName']=$customerRes[0]->name_first." ".$customerRes[0]->name_last;
			}
			$data['result']=$result;
			$data['accounts']=$accs;
			$data['customer']=$id;
            $this->load->view('pages/clerk/clerk_home',$data);
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
		
	}
	public function clerk_transaction_management(){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');   
            $uid=$session_data['username'];
            $data['showlogout']=true;
			
			
            $this->load->view('pages/transaction_management');
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	
	
	}
	
	
}

?>
