 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customerAssistantHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('customerAssistant','',TRUE);
    }
    
    public function index()
    {	
		if (!isset($_POST['submit'])){
			if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				
				$uid=$session_data['username'];
				$customerAssistant=$this->user->iscustomerAssistant($uid);
				
				$data['username'] = $session_data['username'];
				$data['title'] = "The Bank of Isengard";
				$data['customerAssistant'] = $customerAssistant;
				$data['showlogout']=true;
				$data['type']='';		//Need this for future reference.
				$data['table'] = '';	//Need this for future reference.
				$this->load->view('templates/header',$data);
				$this->load->view('pages/customerAssistantHome',$data);
				$this->load->view('templates/footer',$data);
			}
			else
			{
				//If no session, redirect to login page
				redirect('login', 'refresh');
			}
        }else if($_POST['submit'] == 'Submit Info'){
			$name_first = $_POST['name_first'];
			$name_last = $_POST['name_last'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$pass = $_POST['pass'];
			$pass2 = $_POST['pass2'];
			
			$uid=$this->session->userdata('logged_in')['username'];
			
			$this->customerAssistant->changePersonal($name_first, 
				$name_last, 
				$address, 
				$phone, 
				$pass,
				$pass2,
				$uid
			);
		}else if($_POST['submit'] == 'Submit Customer'){
			if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && 
				!empty($_POST['address']) && !empty($_POST['birth']) &&
				!empty($_POST['pass']) && !empty($_POST['bName'])){
				
				
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$address = $_POST['address'];
				$birth = $_POST['birth'];
				$birth = substr($birth, 6, 4) . "-" . substr($birth, 0, 2) . "-" . substr($birth, 3, 2);
				$pass = $_POST['pass'];
				$bName = $_POST['bName'];
				
				$row = $this->customerAssistant->addCustomer($firstName, 
					$lastName, 
					$address, 
					$birth, 
					$bName, 
					$pass);
                                
				$data['title'] = "The Bank of Isengard";
				$data['showlogout']=true;
                                $data['newCustomer']=$row;
                                
				$this->load->view('templates/header',$data);
				$this->load->view('pages/customerAssistant/accountCreated',$data);
				$this->load->view('templates/footer',$data);
				
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('customerAssistantHome#cust', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Corp'){
			if (!empty($_POST['cName']) && !empty($_POST['iban'])){
				
				$cName = $_POST['cName'];
				$iban = $_POST['iban'];
				
				$this->customerAssistant->addCorp($cName, $iban);
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('customerAssistantHome#corp', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Business Account'){
			if (!empty($_POST['bName']) && !empty($_POST['iban']) && !empty($_POST['cid'])){
				
				$cid = $_POST['cid'];
				$bName = $_POST['bName'];
				$iban = $_POST['iban'];
				
				$this->customerAssistant->addBusinessAcc($cid, $bName, $iban);
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('customerAssistantHome#account', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Standard Account'){
			if (!empty($_POST['bName']) && !empty($_POST['iban']) && !empty($_POST['cid'])){
				
				$cid = $_POST['cid'];
				$bName = $_POST['bName'];
				$iban = $_POST['iban'];
				
				$this->customerAssistant->addStandardAcc($cid, $bName, $iban);
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('customerAssistantHome#account', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Savings Account'){
			if (!empty($_POST['bName']) && !empty($_POST['iban']) && !empty($_POST['cid']) && !empty($_POST['dateEnd'])){
				
				$cid = $_POST['cid'];
				$bName = $_POST['bName'];
				$iban = $_POST['iban'];
				$dateEnd = $_POST['dateEnd'];
				$dateEnd = substr($dateEnd, 6, 4) . "-" . substr($dateEnd, 0, 2) . "-" . substr($dateEnd, 3, 2);
				
				$this->customerAssistant->addSavingsAcc($cid, $bName, $iban, $dateEnd);
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('customerAssistantHome#account', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Criteria Request'){
			if (!empty($_POST['name_first']) || !empty($_POST['name_last'])){
				
				$name_first = $_POST['name_first'];
				$name_last = $_POST['name_last'];
				
				$session_data = $this->session->userdata('logged_in');
				
				$uid=$session_data['username'];
				$customerAssistant=$this->user->iscustomerAssistant($uid);
				$table = $this->customerAssistant->searchCard($name_first, $name_last);
				
				$data['table'] = $table;
				$data['type'] = 'criteria';
				$data['username'] = $session_data['username'];
				$data['title'] = "The Bank of Isengard";
				$data['customerAssistant'] = $customerAssistant;
				$data['showlogout']=true;
				
				$this->load->view('templates/header',$data);
				$this->load->view('pages/customerAssistantHome',$data);
				$this->load->view('templates/footer',$data);
			}else{
				echo "<script>
				alert('Please fill at least first or last name.');
				</script>";
				redirect('customerAssistantHome#cardReqs', 'refresh');
			}
		}else if($_POST['submit'] == 'Submit Loan Request'){
			if (!empty($_POST['name_first']) || !empty($_POST['name_last'])){
				$name_first = $_POST['name_first'];
				$name_last = $_POST['name_last'];
				
				$session_data = $this->session->userdata('logged_in');
				$uid=$session_data['username'];
				$customerAssistant=$this->user->iscustomerAssistant($uid);
				$table = $this->customerAssistant->searchLoan($name_first, $name_last);
				
				$data['table'] = $table;
				$data['type'] = 'loan';
				$data['username'] = $session_data['username'];
				$data['title'] = "The Bank of Isengard";
				$data['customerAssistant'] = $customerAssistant;
				$data['showlogout']=true;
				
				$this->load->view('templates/header',$data);
				$this->load->view('pages/customerAssistantHome',$data);
				$this->load->view('templates/footer',$data);
			}else{
				echo "<script>
				alert('Please fill at least first or last name.');
				</script>";
				redirect('customerAssistantHome#loanReqs', 'refresh');
			}
		}else if(strpos($_POST['submit'],'Approve Card') !== false){
			$cust_id = intval($_POST['cust_id']);
			$card_num = intval($_POST['card_num']);
			
			$this->customerAssistant->approveCard($card_num);
				
			$session_data = $this->session->userdata('logged_in');
			$uid=$session_data['username'];
			$customerAssistant=$this->user->iscustomerAssistant($uid);
			$table = $this->customerAssistant->searchCardWithID($cust_id);
			
			$data['table'] = $table;
			$data['type'] = 'criteria';
			$data['username'] = $session_data['username'];
			$data['title'] = "The Bank of Isengard";
			$data['customerAssistant'] = $customerAssistant;
			$data['showlogout']=true;
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/customerAssistantHome',$data);
			$this->load->view('templates/footer',$data);
		}else if(strpos($_POST['submit'],'Approve Loan') !== false){
			$cust_id = intval($_POST['cust_id']);
			$loan_id = intval($_POST['loan_id']);
			
			$this->customerAssistant->approveLoan($loan_id);
			
			$session_data = $this->session->userdata('logged_in');
			$uid=$session_data['username'];
			$customerAssistant=$this->user->iscustomerAssistant($uid);
			$table = $this->customerAssistant->searchLoanWithID($cust_id);
			
			$data['table'] = $table;
			$data['type'] = 'loan';
			$data['username'] = $session_data['username'];
			$data['title'] = "The Bank of Isengard";
			$data['customerAssistant'] = $customerAssistant;
			$data['showlogout']=true;
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/customerAssistantHome',$data);
			$this->load->view('templates/footer',$data);
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
        $this->load->view('pages/customerAssistant/account');
    }
	
    public function createCustomer(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customerAssistant/createCustomer');
    }
	
    public function createAccount(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customerAssistant/createAccount');
    }
	
    public function createCorporation(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customerAssistant/createCorporation');
    }
	
    public function cards(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customerAssistant/cards');
    }
	
    public function loans(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/customerAssistant/loans');
    }
}
