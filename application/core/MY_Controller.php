<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data;
    public $data_fe;
    public $modul;
    public $notification;
    
    public $controller_login            = "login";
    public $controller_account          = "account";
    public $controller_home             = "home";
    public $controller_site             = "site";
    public $controller_user             = "user";
    public $controller_dashboard        = "dashboard";
    public $controller_stock            = "stock";
    public $controller_master           = "master";
    public $controller_employee         = "employee";
    public $controller_notification     = "notification";
    public $controller_report           = "report";
    public $controller_transaction      = "transaction";
    public $controller_test				= "test";
    public $controller_monitoring		= "monitoring";
    
    public $modul_setting               = "setting";
    public $modul_inventory             = "inventory";
    public $modul_pos                   = "pos";
    public $modul_employee				= "employee";

    public $method_modul                = "modul";
    public $method_menu                 = "menu";
    public $method_info                 = "info";
    public $method_language             = "language";
    public $method_user_list            = "user_list";
    public $method_user_group           = "user_group";
    public $method_master               = "master";
    public $method_company              = "company";
    public $method_question				= "question";
    public $method_detail_question	    = "detail_question";
    public $method_test					= "user_test";
    public $method_monitoring			= "user_monitoring";
    public $method_user_detail			= "user_detail";
    public $method_standard_question	= "standard_question";
    public $method_report				= "report";
    public $method_report_khusus		= "khusus";
    public $method_report_umum			= "umum";
    
    public $id_modul_setting            = 1;
    public $id_modul_inventory          = 2;
    public $id_modul_pos                = 3;
    public $id_modul_employee			= 4;
    
    public $id_user                     = 1;
    public $id_user_list                = 2;
    public $id_user_group               = 3;
    public $id_site                     = 4;
    public $id_modul                    = 5;
    public $id_menu                     = 6;
    public $id_info                     = 7;
    public $id_language                 = 8;
    
    public $id_inv_dashboard            = 9;
    public $id_inv_master               = 10;
    public $id_inv_stock                = 11;
    public $id_inv_stock_in             = 12;
    public $id_inv_stock_out            = 13;
    public $id_inv_report               = 14;
    public $id_inv_report_stock         = 15;
    public $id_inv_report_stock_in      = 16;
    public $id_inv_report_stock_out     = 17;
    
    public $id_pos_dashboard            = 18;
    public $id_pos_transaction          = 19;
    public $id_pos_report               = 20;
    
    #module employee
    public $id_master_emp				= 21;
    public $id_question					= 25;
    public $id_test						= 24;
    public $id_monitoring				= 25;
    public $id_khusus					= 22;
    public $id_umum						= 23;
    public $id_m_report					= 26;
    public $id_report_k					= 27;
    public $id_report_u					= 28;
    
    # TBL TEMPLATE
    public $tbl_modul                   = "tbl_modul";
    public $tbl_menu                    = "tbl_menu";
    public $tbl_profile_site            = "tbl_profile_site";
    public $tbl_user_group              = "tbl_user_group";
    public $tbl_user                    = "tbl_user";
    public $tbl_user_akses              = "tbl_user_akses";
    public $tbl_notifikasi              = "tbl_notifikasi";

    public $inv_kode_default            = "inv_kode_default";
    public $inv_master                  = "inv_master";
    public $inv_setting_master          = "inv_setting_master";
    public $inv_product_type            = "inv_jenis_barang";
    public $inv_product                 = "inv_barang";
    
    
    public $tbl_question				= "emp_question";
    public $tbl_answer					= "emp_answer";
        
    public $language_select             = "asset_lang.php";
		
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
            exit(0);
        }
        
		$this->load->model('model_basic');
		$this->load->model('model_main');
        $this->load->helper('text');
        if( $this->session->userdata('id')){
    		$userid           = $this->session->userdata('id');
        }else{
            $userid           = 0;
        }
        $get_user         = array(
            'where_array'   => array('id'=>$userid)
        );
		$user             = $this->model_basic->get_data($this->tbl_user,$get_user)->row();
        $site             = $this->model_basic->get_data($this->tbl_profile_site)->row();
        
        if($user){
            $lvl        = $this->model_basic->get_data($this->tbl_user_group,array('where_array'=>array('id'=>$user->id_group)))->row();
            $level_name = $lvl->nama;
            $level      = $user->id_group;
            $bahasa     = $user->language;
            $id_zona    = $user->id_zona;
            $id_area    = $user->id_area;
            $nama       = $user->nama;
            $thumb      = $user->thumb;
            if(!$thumb)
                $thumb   = 'default.png';
        }else{
            $nama       = 'No Name';
            $level_name = 'No Level';
            $level      = 0;
            $id_zona    = 0;
            $id_area    = 0;
            $employee_id= 0;            
            $bahasa     = 'english';
            $thumb      = 'default.png';
		}
		if( $this->session->userdata('id') ){
            $attr = array(
                'where_array'   => array(
                    'id_level'  =>$level,
                    'act_view'  =>1
                )
            );
            $akses = $this->model_basic->get_data($this->tbl_user_akses,$attr)->result();
            $id_menu = array(0);
            foreach($akses as $a){
                $id_menu[] = $a->id_menu;
            }
            $attr = array(
                'field_in'      => 'id',
                'array_in'      => $id_menu,
                'group_by'      => 'id_modul'
            );
            $menu = $this->model_basic->get_data($this->tbl_menu,$attr)->result();
            $id_modul = array(0);
            foreach($menu as $m){
                $id_modul[] = $m->id_modul;
            }
            $attr = array(
                'field_in'      => 'id',
                'array_in'      => $id_modul,
                'sort_by'       => 'urutan'
            );
            $this->modul = $this->model_basic->get_data($this->tbl_modul,$attr)->result();
            
            $this->notification = $this->model_basic->get_data($this->tbl_notifikasi,array('where_array'=>array('aksi'=>0,'id_group'=>$level)))->num_rows();
		}
		$array 	= array(
            'controller_user'       => 'user',
            'controller_dashboard'  => 'dashboard',
			'user_foto'			    => 'userdata/user/thumb/'.$thumb,
            'user_nip'              => $level_name,
			'user_nama'			    => $nama,
            'user_id'               => $userid,
            'user_id_zona'          => $id_zona,
            'user_id_area'          => $id_area,
            'user_level'		    => $level,
			'user_language'		    => $bahasa,
			'title_site'		    => $site->judul,
			'company_site'		    => $site->perusahaan,
            'company_address'       => $site->alamat,
            'company_initial'       => $site->inisial_perusahaan,
            'logo_site'             => $site->logo,
            'modul'                 => $this->modul,
            'notification'          => $this->notification,
            'popup_insert'          => TRUE,
		);
		$this->data = $array;
                
		$this->bahasa = $this->bahasa($bahasa);
		$this->load->library('fpdf');
        $this->load->library('Datatables');
        $this->load->library('table');
        if(!defined('FPDF_FONTPATH'))
    		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	}
    	
	public function bahasa($language=""){
		$this->load->language('asset',$language);
	}
    
    public function quick_link($id_modul,$id_level=""){
        $akses = $this->model_basic->get_data('*',$this->tbl_user_akses,array('id_level'=>$id_level,'act_view'=>1))->result();
        $id_menu = array(0);
        foreach($akses as $a){
            $id_menu[] = $a->id_menu;
        }
        $select = 't1.*,(SELECT t2.target FROM '.$this->tbl_menu.' t2 WHERE t2.id=t1.parent_id) AS target_induk';
        return $this->model_basic->get_data($select,$this->tbl_menu.' t1',array('id_modul'=>$id_modul,'parent_id !=' => 0),'','','',0,'id',$id_menu)->result();
    }
    
    public function get_menu($level=0,$id_modul=0){
        $menu            = $this->model_main->get_menu( $this->tbl_user_akses, $this->tbl_menu, $level, $id_modul );
        $get_menu        = array();
        $settimg_menu    = array();
        $i = 0;
        foreach( $menu as $m ){
            $get_menu[$i]['id'] 	= $m['id'];
            $get_menu[$i]['menu'] 	= $m['nama'];
            $get_menu[$i]['target']	= $m['target'];
            $get_menu[$i]['icon']   = $m['icon'];
            $submenu = $this->model_main->get_menu( $this->tbl_user_akses, $this->tbl_menu, $level, $id_modul, $m['id'] );
            $j = 0;
            foreach($submenu as $sm){
                $get_menu[$i]['submenu'][$j]['id']      = $sm['id'];
                $get_menu[$i]['submenu'][$j]['menu']    = $sm['nama'];
                $get_menu[$i]['submenu'][$j]['target']  = $sm['target'];
                $get_menu[$i]['submenu'][$j]['icon']    = $sm['icon'];
                $j++;
            }
            $i++;
	   }
        return $get_menu;
    }
    	
	public function cek_akses( $user = 0 , $menu = 0 ){
        $data = $this->data;
		$hak		= $this->model_main->get_cek_akses( $this->tbl_user_akses, $user , $menu );
		if( $hak == 0 ){
			redirect('errors/forbidden');
			exit();
			return "GAGAL";
		}else{
			return "SUKSES";
		}
	}

	public function cek_login(){
		if( $this->session->userdata('id')){
			return $this->session->userdata('id');
		}
		else{
			redirect('login');
		}
	}
		
	public function get_akses( $id_level = 0 , $id_menu = 0 ){
		$rs	= $this->model_main->get_akses( $this->tbl_user_akses, $id_level , $id_menu );
		$data['view'] 	= $rs[0]['act_view'];
		$data['input'] 	= $rs[0]['act_input'];
		$data['edit'] 	= $rs[0]['act_edit'];
		$data['delete'] = $rs[0]['act_delete'];
		return $data;
	}

	public function returnJson($message){
		echo json_encode($message);
		exit;
	}
	
	public function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				@unlink($file);
			}
		}
		@rmdir($dirPath);
	}
	
	public function get_list_menu(){
		$data_parent = $this->model_basic->select_where($this->menu_table,'parent_id',0)->result();
		$data_child = $this->model_basic->select_where($this->menu_table,'parent_id >','0')->result();
		$map = array();
		foreach ($data_parent as $dm) {
			$dm->child = array();
			$map[$dm->id] = $dm;
		}
		foreach ($data_child as $dc) {
			$map[$dc->parent_id]->child[] = $dc;
		}
		return $map;
	}
	
	function get_language( $folder = "" ){
		$dir    = getcwd().'/application/language'.$folder;
		$files 	= scandir($dir);
	
		$data = array();
		foreach( $files as $f ){
			if( ( $f != "." ) && ( $f != ".." ) && ( $f != "index.html" ) ) $data[] = $f;
		}
		return $data;
	}
    
    function download($name,$content){
        $this->load->helper('download'); 
        $data = file_get_contents($content);
        force_download($name,$data);
	}
    
    function mydate($date) {
        $arrayBulan = array(lang('lbl_january'), lang('lbl_february'), lang('lbl_march'), lang('lbl_april'), lang('lbl_may'), lang('lbl_june'), lang('lbl_july'), lang('lbl_august'), lang('lbl_september'), lang('lbl_october'), lang('lbl_november'), lang('lbl_december'));
        $tahun      = date('Y',strtotime($date));
        $bulan      = date('m',strtotime($date));
        $tgl        = date('d',strtotime($date));
        $result     = $tgl . " " . $arrayBulan[(int)$bulan-1] . " ". $tahun;
        return($result);
    }
    
    function redirect_menu($id_modul=0,$id_level=0){
        $menu = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('id_modul'=>$id_modul,'parent_id'=>0),'sort_by'=>'urutan'))->result();
        foreach($menu as $mn){
            $modul = $this->model_basic->get_data($this->tbl_modul,array('where_array'=>array('id'=>$mn->id_modul)))->row();
            $akses = $this->model_main->get_cek_akses( $this->tbl_user_akses, $id_level , $mn->id );
            if($akses > 0){
                $submenu = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('parent_id'=>$mn->id),'sort_by'=>'urutan'))->result();
                if(count($submenu) > 0){
                    foreach($submenu as $sm){
                        $akses = $this->model_main->get_cek_akses( $this->tbl_user_akses , $id_level , $sm->id );
                        if($akses > 0){
                            redirect($modul->target . '/' . $mn->target . '/' . $sm->target);
                            exit;
                        }
                    }
                }else{
                    redirect($modul->target . '/' . $mn->target);
                    exit;
                }
            }
        }
    }
    
    function codeGenerator($tabel="",$prefix="",$jumlah_digit=0,$where_array=array(),$field="kode"){
        if($jumlah_digit == 0)
            $jumlah_digit = 3;
        $attr   = array(
            'field_like'    => $field,
            'like'          => $prefix,
            'select_max'    => $field
        );
        if(count($where_array) > 0)
            $attr['where_array']    = $where_array;
        
        $result   = $this->model_basic->get_data($tabel,$attr)->row();

        $code_max   = $result->$field;
        $code       = (int) substr($code_max,strlen($prefix),$jumlah_digit);
        $new_code   = $code + 1;

        if($jumlah_digit == 1)
            return $prefix . $new_code;
        else
            return $prefix . sprintf("%0".$jumlah_digit."s",$new_code);
    }
    
    function get_company($folder=""){
		$dir    = getcwd().'/assets/config/'.$folder;
		$files 	= scandir($dir);
	
		$data = array();
		foreach( $files as $f ){
			if( ( $f != "." ) && ( $f != ".." ) && ( $f != "password.ini" ) && ( $f != "config.ini" ) ){
                $pecah  = explode('.',$f);
                $data[] = $pecah[0];
            }
		}
		return $data;
	}
    
    function get_file($folder=""){
		$dir    = getcwd().'/'.$folder;
		$files 	= scandir($dir);
	
		$data = array();
		foreach( $files as $f ){
			if( ( $f != "." ) && ( $f != ".." ) ){
                $data[] = $f;
            }
		}
		return $data;
	}
    
    public function get_config($folder="",$config=""){
        if($config!=""){
            $file		        = FCPATH . 'assets/config/'.$folder.'/'.$config.'.ini';
            if(file_exists($file)){
                $isi_file			= file_get_contents($file);
                $data               = json_decode($isi_file,true);
            }else{
                $data['group_db']   = "default";
            }
		}else{
            $data['group_db']   = "default";
		}
        return $data;
    }
    
    function generate_serial($email=""){
        $serial = 0; 
        for($i=0;$i<strlen($email);$i++){
            $serial += ord($email[$i]);
        }
        return $serial;
    }
    
	function serial_number($email="",$jml_company=1,$jml_user=1,$masa_aktif="bulan"){
        $serial = 0; 
        for($i=0;$i<strlen($email);$i++){
            $serial += ord($email[$i]);
        }
        $serial  += ( $jml_company * $jml_user );
        if($serial % 2 == 0){
            $key1   = $serial / 2;
            $key2   = $key1;
        }else{
            $key1   = ( $serial + 1 ) / 2;
            $key2   = $key1 - 1;
        }
        if(strlen($jml_company) == 1)
            $company = strrev(ord($jml_company)) + $key1;
        else
            $company = $jml_company + $serial;
        $user   = $key2 + $jml_user + $company;
        if($masa_aktif=="bulan")
            $satu_periode   = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
        else
            $satu_periode   = date('Y-m-d',strtotime('+1 year',strtotime(date('Y-m-d'))));
        $tanggal_expired    = date('Y-m-d',strtotime('-1 day',strtotime($satu_periode)));
        $exp    = strtotime($tanggal_expired) - $user;
        return $serial.'-'.$company.'-'.$user.'-'.$exp;
	}
    
    function view_serial($serial=""){
        $sub        = explode('-',$serial);
        if(count($sub) == 4){
            if($sub[0] % 2 == 0){
                $key1   = $sub[0] / 2;
                $key2   = $key1;
            }else{
                $key1   = ( $sub[0] + 1 ) / 2;
                $key2   = $key1 - 1;
            }
            $nil1       = strrev($sub[1] - $key1);
            if(strlen($nil1) == 1){
                $nil1   .= '0';
            }
            if(strlen($nil1) == 2)
                $company    = chr($nil1);
            else
                $company    = $sub[1] - $sub[0];
            $user       = $sub[2] - $sub[1] - $key2;
            $seri       = $sub[0] - ($company * $user);
            $data       = array(
                'serial'        => $seri,
                'company_limit' => $company,
                'user_limit'    => $user,
                'expired'       => date('d-m-Y',$sub[3]+$sub[2])
            );
        }else{
            $data       = array(
                'serial'        => 0,
                'company_limit' => 0,
                'user_limit'    => 0,
                'expired'       => 0
            );
        }
        return $data;
    }
    
    function enkripsi($input) {
        return strtr(base64_encode($input), '+/=', '-_|');
    }

    function dekripsi($input) {
        return base64_decode(strtr($input, '-_|', '+/='));
    }

    function readCSV($csvFile){
    	$file  = fopen($csvFile, 'r');
    	while (!feof($file) ) {
    		$data[] = fgetcsv($file, 1024);
    	}
    	fclose($file);
    	return $data;
    }
    
    function calculate_interest($amount=0,$interest=0,$long=0,$type=0,$date=""){
        # $type     => 0 : flat, 1 : aktif , 2 : anuitas
        
        $ending_balance             = $amount;
        $data['total_interest']     = 0;
        $data['total_payment']      = 0;
        if($type == 0){
            $primary                = round( $amount / $long );
            $interest_              = round( ( $amount * ( $interest / 100 ) ) / 12 );
            $installment_payment    = $primary + $interest_;
            for($i=1;$i<=$long;$i++){
                $date_              = date('Y-m-d',strtotime('+'.$i.' month',strtotime($date)));
                if($i == $long){
                    $primary        = $ending_balance;
                    $interest_      = $installment_payment - $primary;
                }
                $ending_balance    -= $primary;
                $data['detail'][$i]   = array(
                    'installment_payment'   => $installment_payment,
                    'primary'               => $primary,
                    'interest'              => $interest_,
                    'ending_balance'        => $ending_balance,
                    'date'                  => $date_
                );
                $data['total_interest'] += $interest_;
                $data['total_payment']  += $installment_payment;
            }
        }elseif($type == 1){
            $primary                = round( $amount / $long );
            for($i=1;$i<=$long;$i++){
                $date_              = date('Y-m-d',strtotime('+'.$i.' month',strtotime($date)));
                $interest_          = round( ( $amount - ( ( $i - 1 ) * $primary  ) ) * ( $interest / 100 ) / 12 );
                $installment_payment= $primary + $interest_;
                if($i == $long){
                    $primary        = $ending_balance;
                    $interest_      = $installment_payment - $primary;
                }
                $ending_balance    -= $primary;
                $data['detail'][$i]   = array(
                    'installment_payment'   => $installment_payment,
                    'primary'               => $primary,
                    'interest'              => $interest_,
                    'ending_balance'        => $ending_balance,
                    'date'                  => $date_
                );
                $data['total_interest'] += $interest_;
                $data['total_payment']  += $installment_payment;
            }
        }elseif($type == 2){
            $int                    = ( $interest / 100 ) / 12;
            $cal1                   = pow(( 1 + $int ),$long);
            $cal2                   = 1 / ( 1 - ( 1 / $cal1 ) );            
            $installment_payment    = round($amount * $int * $cal2);
            for($i=1;$i<=$long;$i++){
                $date_              = date('Y-m-d',strtotime('+'.$i.' month',strtotime($date)));
                $interest_          = round( ( $ending_balance * ( $interest / 100 ) ) / 12 );
                $primary            = $installment_payment - $interest_;
                if($i == $long){
                    $primary        = $ending_balance;
                    $interest_      = $installment_payment - $primary;
                }
                $ending_balance    -= $primary;
                $data['detail'][$i]   = array(
                    'installment_payment'   => $installment_payment,
                    'primary'               => $primary,
                    'interest'              => $interest_,
                    'ending_balance'        => $ending_balance,
                    'date'                  => $date_
                );
                $data['total_interest'] += $interest_;
                $data['total_payment']  += $installment_payment;
            }
        }
        
        return $data;
    }
    
    public function upload_gambar(){
        $config['upload_path'] = FCPATH . "uploads/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '5000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . "-original".$ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "userdata/temp/uploads/$neworig";

            return $neworig;
        }
	}
    
    function getTweets($hash_tag) {

        $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
        echo '<p>Connecting to <strong>'.$url.'</strong>&hellip;</p>';
        $ch = curl_init($url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $xml = curl_exec ($ch);
        curl_close ($ch);
    
        //If you want to see the response from Twitter, uncomment this next part out:
        echo '<p>Response:</p>';
        echo '<pre>'.htmlspecialchars($xml).'</pre>';
    
        $affected = 0;
        $twelement = new SimpleXMLElement($xml);
        foreach ($twelement->entry as $entry) {
            $text = trim($entry->title);
            $author = trim($entry->author->name);
            $time = strtotime($entry->published);
            $id = $entry->id;
            echo '<p>Tweet from '.htmlspecialchars($author).': <strong>'.htmlspecialchars($text).'</strong>  <em>Posted '.date('n/j/y g:i a',$time).'</em></p>';
        }
    
        return true ;
    }
    
    function translate($str=""){
        if(lang('con_'.str_replace(' ','_',strtolower($str))))
            return lang('con_'.str_replace(' ','_',strtolower($str)));
        else
            return ucwords($str);
    }
    
}