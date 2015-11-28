<?php
class Code extends MY_Controller{
    
    function __construct(){
        parent::__construct();
    }

    function barcode($kode=""){
		$this->load->library('zend');
        $this->zend->load('Zend/Barcode');
            
        Zend_Barcode::render('code128','image',array('text'=>$kode,'factor'=>3),array('imageType' => 'png'));
	}
    
    function qrcode($kode=""){
        $this->load->library('ciqrcode');
        
        if(!is_dir(FCPATH . "userdata/qrcode/"))
            mkdir(FCPATH . "userdata/qrcode/");
        
        $filename   = FCPATH . 'userdata/qrcode/' . $kode . '.png';
        if(!file_exists($filename)){
            $params['data'] = $kode;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = $filename;
            $this->ciqrcode->generate($params);
        }
        
        header('Content-Length: '.filesize($filename));
        header('Content-Type: image/png');
        header('Content-Disposition: inline; filename="'.$kode.'.png";');
        readfile($filename);
    }

}
