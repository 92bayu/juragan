<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
    public function index(){
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('company');
        delete_cookie('id');
        delete_cookie('email');
        delete_cookie('company');
        $this->load->database('default',TRUE);
		redirect('login');
    }
}