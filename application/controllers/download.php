<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MY_Controller {
	function __construct(){
		parent::__construct();
        $this->cek_login();
	}
	
    function download_file($file="",$folder=""){
        $pecah      = explode('.',$file);
        $ext        = $pecah[count($pecah)-1];
        $content    = 'userdata/'.$folder.'/'.$ext.'/'.$file;
        $this->download($file,$content);
    }
    
    function download_temp($temp=""){
        if($this->input->get('temp')) $temp = $this->input->get('temp');
        $pecah      = explode('/',$temp);
        $file       = $pecah[count($pecah)-1];
        $this->download($file,$temp);
    }
    
}