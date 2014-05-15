<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user','',TRUE);
    $this->load->model('card','',TRUE);
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
}
