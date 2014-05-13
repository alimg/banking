 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class managerHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user','',TRUE);
        $this->load->model('bank','',TRUE);
		$this->load->model('manager','',TRUE);
        $this->load->model('branch','',TRUE);
		$this->load->model('atm','',TRUE);
    }
    
    public function index(){
		if($this->session->userdata('logged_in'))
        {
		   $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
			
			$data['branch_list'] = $this->branch->getBranchList($this->bank->get()[0]->bank_id);
			$data['atm_list'] = $this->atm->getAtmList($this->bank->get()[0]->bank_id);
            $this->load->view('templates/header',$data);
            $this->load->view('pages/managerHome');
            $this->load->view('templates/footer',$data);
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
		
		
}
	public function man_home(){
		 if($this->session->userdata('logged_in'))
        {
		   $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
			
			$data['branch_list'] = $this->branch->getBranchList($this->bank->get()[0]->bank_id);
			$data['atm_list'] = $this->atm->getAtmList($this->bank->get()[0]->bank_id);
           
            $this->load->view('pages/manager/man_home', $data);
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	public function atm_management(){
		if($this->session->userdata('logged_in'))
        {
		   $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
			
			$data['branch_list'] = $this->branch->getBranchList($this->bank->get()[0]->bank_id);
			$data['atm_list'] = $this->atm->getAtmList($this->bank->get()[0]->bank_id);
           
            $this->load->view('pages/manager/atm_management', $data);
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
}

?>
