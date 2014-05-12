<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banking extends CI_Controller {

	public function index()
	{
      $data['title'] = "The Bank of Isengard";
      $this->load->view('templates/header',$data);
		  $this->load->view('pages/home');
      $this->load->view('templates/footer',$data);
	}
}
