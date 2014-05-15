<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user','',TRUE);
    $this->load->model('card','',TRUE);
    $this->load->model('loan','',TRUE);
    $this->load->model('bank','',TRUE);
  }
	public function index()
	{
    
	}
  
  public function creditcard(){
    $session_data = $this->session->userdata('logged_in');
    if(!$session_data){
      echo "login required";
      return;
    }
    $uid=$session_data['username'];
    if(!$this->user->isCustomer($uid)){
      echo "please.";
      return;
    }
    $PIN = $_POST['PIN'];
    $limit = $_POST['limit'];
    $stmtDate = $_POST['statement'];
    $dateValid =  date('Y-m-d H:i:s', time()+(3*365 * 24 * 60 * 60));
    $this->card->newCreditCard($uid,$dateValid,$PIN,$limit,$stmtDate);
    
    echo "Your request has been registered. <a href='/customerHome'>Go home</a>";
    //redirect('customerHome', 'refresh');
  }
  
  public function loanRequest(){
    $session_data = $this->session->userdata('logged_in');
    if(!$session_data){
      echo "login required";
      return;
    }
    $uid=$session_data['username'];
    if(!$this->user->isCustomer($uid)){
      echo "please.";
      return;
    }
    $amount = (int) $_POST['amount'];
    $dueDate = $_POST['ddate'];
    $branchName = $_POST['branch'];
    $bankId = $this->bank->get()[0]->bank_id;
    
    $interest = $this->loan->calculate($amount);
    
    $this->loan->loanRequest($amount,$dueDate,$interest,$uid,$branchName,$bankId);
    echo "Your request has been registered. <a href='/customerHome'>Go home</a>";
  
  }
  
  public function loanAccept(){
     $session_data = $this->session->userdata('logged_in');
    if(!$session_data){
      echo "login required";
      return;
    }
    $uid=$session_data['username'];
    if(!$this->user->isCustomer($uid)){
      echo "please.";
      return;
    }
    $amount = $_POST['amount'];
    $dueDate = $_POST['dDate'];
    echo "Your request has been registered. <a href='/customerHome'>Go home</a>";
  }
  
  
}
