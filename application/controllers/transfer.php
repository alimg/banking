 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {

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
            
            $account_source = $_POST['account'];
            $IBAN = $_POST['IBAN'];
            $account_target = $_POST['target_account'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $target = $this->account->getByIBAN($IBAN);
            if(!$target){
                $target=$this->account->get($account_target);
            }
            if(!$target){
                echo "target account not found <a href=\"javascript:history.back()\">back</a>";
                return;
            }
            $target=$target[0];
            $data['account_source']=$account_source;
            $data['account_target']=$target;
            $data['amount']=$amount;
            $data['description']=$description;
            $data['account_target_owner']=$this->account->getOwner($target->id);
            $this->load->view('templates/header',$data);
            $this->load->view('pages/customer/transferConfirm',$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        
	}
    public function confirm(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $customer=$this->user->isCustomer($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['customer'] = $customer;
            $data['showlogout']=true;
            
            $account_source = $_POST['account'];
            $account_target = $_POST['target_account'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $date = date('Y-m-d H:i:s');
            $result = $this->account->transfer($account_source,$account_target,$uid, $amount, $date, $description);
            $data['result']=$result;
            $this->load->view('templates/header',$data);
            $this->load->view('pages/customer/transferDone',$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
}
