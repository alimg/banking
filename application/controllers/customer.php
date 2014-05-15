 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
    }
    
    public function updateinfo(){
        if(!$this->session->userdata('logged_in')){
            //If no session, redirect to login page
            redirect('login', 'refresh');
            return;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid= $data['username'] = $session_data['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $bdate = $_POST['bdate'];
        $this->user->updateCustomerInfo($uid,$fname,$lname,$address,$bdate);
        echo "Your information is update <a href='/customerHome'>Go home</a>";
        //$this->load->view('pages/customer/userinfo');
    }
}
