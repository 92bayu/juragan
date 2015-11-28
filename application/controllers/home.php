<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
		parent::__construct();
        $this->cek_login();
	}
	
    public function index(){
        $data = $this->data;
        foreach($data['modul'] as $m){
            $this->redirect_menu( $m->id , $data['user_level'] );
        }
        redirect('errors/no_access');
        exit;
	}
    
}