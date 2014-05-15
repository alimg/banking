 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clerkHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
		$this->load->model('clerk','',TRUE);
        //$this->load->model('branch','',TRUE);
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
	
	
	
}

?>
