 
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
						$id = $this->unique_id();
						$this->atm->add($id,$address,$balance,$branch_name, $this->bank->get()[0]->bank_id );
						

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
	public function add_Employee(){
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
				$this->load->view('pages/manager/add_employee', $data);
				if (isset($_POST['submit'])){
				
					if (!(empty($_POST['salary'])) && !(empty($_POST['name']) )&&  !empty($_POST['surname']) ){
						$salary = $_POST['salary'];
						$name = $_POST['name'];
						$surname = $_POST['surname'];
						$phone_number = $_POST['phone_number'];
						$address = $_POST['address'];
						$password = $_POST['password'];
						$branch_name = $_POST['branch_name'];
						$id = $this->unique_id();
						$this->staff->add($id,$salary,$name,$surname, $phone_number,$address, $password, $this->bank->get()[0]->bank_id, $branch_name );
						$is_admin = $_POST['is_admin'];
						$type = $_POST['employee_type'];
						//echo "typeee  $type";
						//echo "is admin : $is_admin";
		
						if($type == "new_manager"){
							/*if($is_admin == "admin"){
								$admin = 1;
							}else if ($is_admin == "not_admin"){
								$admin = 0;
							}*/
							$admin = 0;
							$this->staff->addManager($id,$admin);
						}
						if($type =="new_clerk" ){
							$title = $_POST['title'];
							$this->staff->addClerk($id,$title);
						}
						if($type == "new_assistant"){
							$this->staff->addAssistant($id);
						}
						
						
						redirect('managerHome#home', 'refresh');
						
					
					}
					
					else{
						echo "<script>
						alert('Please enter fill all text fields!');
						</script>";
					}
					
				}
				
				 
				
			}
			else
			{
				//If no session, redirect to login page
				redirect('login', 'refresh');
			}
	
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////reports
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function reports(){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
			
			
            $this->load->view('pages/manager/reports');
            
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	public function manager_update_info(){
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            
            $uid=$session_data['username'];
            $manager=$this->manager->isManager($uid);
            
            $data['username'] = $session_data['username'];
            $data['title'] = $this->bank->get()[0]->name;
            $data['manager'] = $manager;
            $data['showlogout']=true;
            $this->load->view('pages/manager/manager_update_info');
			if (isset($_POST['submit'])){
			
				$salary = $_POST['salary'];
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$phone_number = $_POST['phone_number'];
				$address = $_POST['address'];
				$password = $_POST['password'];
				
				$this->staff->updateInfo($uid,$salary,$name,$surname, $phone_number,$address, $password);
				redirect('managerHome#home', 'refresh');
			}
				

				
							
		}
		else
		{
            //If no session, redirect to login page
            redirect('login', 'refresh');
		}
	
	}
	
	
	
	function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}
	
	
}

?>
