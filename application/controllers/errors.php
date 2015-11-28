<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
    public function index(){
        $data                       = $this->data;
        $this->load->view('template/header_no_module',$data);
        $this->load->view('error/not_found');
        $this->load->view('template/footer');
    }
    
    public function forbidden(){
        $data                       = $this->data;
        $this->load->view('template/header_no_module',$data);
        $this->load->view('error/forbidden');
        $this->load->view('template/footer');
    }

    public function no_access(){
        $data                       = $this->data;
        $this->load->view('template/header_no_module',$data);
        $this->load->view('error/no_access');
        $this->load->view('template/footer');
    }
   
}