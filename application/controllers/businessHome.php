 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BusinessHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('business','',TRUE);
    }
    
    public function index()
    {	
		if (!isset($_POST['submit'])){
			if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				
				$uid=$session_data['username'];
				$business=$this->user->isBusinessAccount($uid);
				
				$data['username'] = $session_data['username'];
				$data['title'] = "The Bank of Isengard";
				$data['business'] = $business;
				$data['showlogout']=true;
				$this->load->view('templates/header',$data);
				$this->load->view('pages/businessHome',$data);
				$this->load->view('templates/footer',$data);
			}
			else
			{
				//If no session, redirect to login page
				redirect('login', 'refresh');
			}
        }else if ($_POST['submit'] == 'Accept'){
			if (!empty($_POST['card_num']) && !empty($_POST['tot_amount']) && !empty($_POST['installment'])){
				
				$card_num = $_POST['card_num'];
				$tot_amount = $_POST['tot_amount'];
				$installment = $_POST['installment'];
				
				$uid = $this->session->userdata('logged_in')['username'];
				$this->business->makeInstallment($card_num, $tot_amount, $installment, $uid);
			}else{
				echo "<script>
				alert('Please fill ALL the areas!');
				</script>";
				redirect('businessHome', 'refresh');
			}
		}
	}
       
	public function home(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('pages/business/home');
    }
}