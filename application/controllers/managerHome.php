 
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
		$this->load->model('staff','',TRUE);
		
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
          // print_r($data['branch_list']);
            $this->load->view('pages/manager/atm_management', $data);
		
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	public function deleteAtm($atm_id){
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
			
			$data['atm_list'] = $this->atm->deleteAtm($atm_id);
            $this->load->view('pages/manager/atm_management', $data);
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	public function addAtm(){
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
			   
				//$this->load->view('pages/manager/atm_management', $data);
				if (isset($_POST['submit'])){
				
					if (!(empty($_POST['branch_name'])) && !(empty($_POST['balance']) )&&  !(empty($_POST['address']) )){
						$branch_name = $_POST['branch_name'];
						$balance = $_POST['balance'];
						$address = $_POST['address'];
						$this->atm->add("789",$address,$balance,$branch_name, $this->bank->get()[0]->bank_id );
					
					}
					
					else{
						echo "<script>
						alert('Please enter fill all text fields!');
						</script>";
					}
					
				}
				redirect('managerHome#addAtm', 'refresh');
				 
				
			}
			else
			{
				//If no session, redirect to login page
				redirect('login', 'refresh');
			}
	
	
	}
	public function employment_management(){
	if($this->session->userdata('logged_in'))
        {
		   $session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
			$data['employment_list'] = $this->staff->getEmploymentList($this->bank->get()[0]->bank_id);
			print_r($data['title']);
			
			$this->load->view('pages/manager/employment_management', $data);
			
			
       
            
            
		}
	else
	{
        //If no session, redirect to login page
        redirect('login', 'refresh');
	}
	
	
	}
	public function fireEmployee($id){
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
			echo "enter";
			$data['employment_list'] = $this->staff->fireEmployee($id);
			echo "exit";
            $this->load->view('pages/manager/employment_management', $data);
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	public function updateSalary(){
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
           
            //$this->load->view('pages/manager/atm_management', $data);
			if (!empty($_POST['salary']) ){
				$salary = $_POST['salary'];
				$id = $_POST['id'];
				$this->staff->updateSalary($id, $salary);
				
				}
				
				else{
					echo "<script>
					alert('Please enter fill all text fields!');
					</script>";
				}
				
			
			redirect('managerHome#addAtm', 'refresh');
			 
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	
	
	
	
}

?>
