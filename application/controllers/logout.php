<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 
class Logout extends CI_Controller {
 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
     
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();
    redirect('banking');
 }

}
