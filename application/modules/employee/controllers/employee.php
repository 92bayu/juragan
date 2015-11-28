<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
    
    function index(){
        $data   = $this->data;
        $this->redirect_menu( $this->id_modul_employee , $data['user_level'] );
        redirect('errors/forbidden');
    }
    
    
    
}