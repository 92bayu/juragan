<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->load->model('employee/model_basic_l');
        $this->cek_akses($data['user_level'],$this->id_test);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_test);
	}
	
	public function index(){
		$data = $this->data;
		if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_test)==1){
			redirect($this->modul_employee.'/'.$this->controller_test.'/'.$this->method_test);
			die;
		}
		
		redirect($this->controller_master);
	}
	
	function user_test(){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_test);
	
		$data['this_modul']         = $this->modul_employee;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_test);
		$data['controller']         = $this->controller_test;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_test);
		$data['datatable']          = "";
		$data['method']             = $this->method_test;
		$data['current_id']         = $this->id_test;
		$data['this_menu']          = $this->id_test;
	
// 		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
// 		$this->table->set_template($tmpl);
// 		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
// 		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
// 		$data['table']              = $this->table->generate();
	
// 		$data['breadcrumbs']        = array(
// 				1   => array(
// 						'target'    => $this->modul_employee,
// 						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
// 				),
// 				2   => array(
// 						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_question,
// 						'nama'      => $data['menu_name']['nama']
// 				)
// 		);
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/test/test');
		$this->load->view('template/footer');
	}

}