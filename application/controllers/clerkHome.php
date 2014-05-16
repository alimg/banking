 
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
		$this->load->model('loan','',TRUE);
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
			$data['customerName'] = "";
			
            $this->load->view('pages/clerk/clerk_home',$data);
           
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
			
			$data['customerName'] = "";
			
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
			$data['customer'] = "";
			
			
            $this->load->view('pages/clerk/transaction_management');
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	}
	public function trans_search($id){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');   
            $uid=$session_data['username'];
            $data['showlogout']=true;
			$loan = $this->loan->getLoanList($id);
			$data['loan_list'] = $loan;
			$data['customer'] = $id;
			
			$result=$this->transaction->searchTransaction($id);
			$accs=$this->account->getCustomerAccounts($id);
			$customerRes=$this->user->getUserInfo($id);	
			
			$data['result']=$result;
			$data['accounts']=$accs;
			
            $this->load->view('pages/clerk/transaction_management', $data);
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	
	}
	public function exe_transaction($id, $account_id, $amount,$type){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');   
            $uid=$session_data['username'];
            $data['showlogout']=true;
			//$loan = $this->loan->getLoanList($id);
			//$data['loan_list'] = $loan;
			$data['customer'] = $id;
			$loan = $this->loan->getLoanList($id);
			$data['loan_list'] = $loan;
			$data['customer'] = $id;
		    if($type == "withdraw"){
				$result = $this->transaction->withdrawMoney($id,$account_id,$amount);
				if($result == false){
					echo '<script> alert("Current account does not have enough amount of money")</script>';
				}
				else{
					echo '<script> alert("Success!")</script>';
				
				}
			
			}else if ( $type == "deposit"){
				$result = $this->transaction->depositMoney($id,$account_id,$amount);
			
			
			}  
			echo "id $id, aid $account_id, amount $amount type $type";
			
			
			
            $this->load->view('pages/clerk/transaction_management', $data);
           
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	
	}
	
}

?>
