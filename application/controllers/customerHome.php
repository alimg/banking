 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerHome extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['title'] = "The Bank of Isengard";
            $data['showlogout']=true;
            $this->load->view('templates/header',$data);
            $this->load->view('pages/customerHome');
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        
	}
}
