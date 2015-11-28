<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
    
    function index(){
        $data   = $this->data;
        $this->redirect_menu( $this->id_modul_pos , $data['user_level'] );
        redirect('errors/forbidden');
    }
    
}