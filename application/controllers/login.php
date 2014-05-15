<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 

class Login extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
    $data['title'] = "The Bank of Isengard";
    //This method will have the credentials validation
    if($this->check_database() == FALSE)
    {
        $this->load->view('templates/header',$data);
        //Field validation failed.  User redirected to login page
        $this->load->view('pages/home');
        $this->load->view('templates/footer',$data);
        echo "Error: Username or password is wrong";
    }
    else
    {
        $usertype="normal";
        if(isset($_POST["usertype"]))
            $usertype=$_POST["usertype"];
        if($usertype=='manager'){
            redirect('managerHome', 'refresh');
        }else if($usertype=='clerk'){
            redirect('clerkHome', 'refresh');
        }else if($usertype=='customerAssistant'){
            redirect('customerAssistantHome', 'refresh');
        }else if($usertype=='business'){
            redirect('businessHome', 'refresh');
        }else{
            redirect('customerHome', 'refresh');
        }
        
   }
    //

 }

 function check_database()
 {
   //Field validation succeeded.  Validate against database
   if( ! (isset($_POST['userid'])&&isset($_POST['password']) ) ){
        return false;
    }
   $username = $_POST['userid'];
   $password = $_POST['password'];

   //query the database
   $result = $this->user->login($username, $password);
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     return false;
   }
 }
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
