<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->load->model('employee/model_basic_l');
        $this->cek_akses($data['user_level'],$this->id_report_k);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_m_report);
	}
	
	public function index(){
		$data = $this->data;
		if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_m_report)==1){
			redirect($this->modul_employee.'/'.$this->controller_report.'/'.$this->method_report_khusus);
			die;
		}
		
		redirect($this->controller_master);
	}
	
	function khusus($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_report_k);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_report_k);
		$data['controller']         = $this->controller_report;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_report_k);
		$data['datatable']          = "";
		$data['method']             = $this->method_report_khusus;
		$data['current_id']         = $this->id_report_k;
		$data['this_menu']          = $this->id_report_k;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
	
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
						'nama'      => 'Report Khusus'
				)
		);
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('report/detail_report');
		$this->load->view('template/footer');
	}
	
	function umum($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_report_u);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_report_u);
		$data['controller']         = $this->controller_report;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_report_u);
		$data['datatable']          = "";
		$data['method']             = $this->method_report_khusus;
		$data['current_id']         = $this->id_report_u;
		$data['this_menu']          = $this->id_report_u;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
	
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_umum,
						'nama'      => 'Report Umum'
				)
		);
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('template/coming_soon');
		$this->load->view('template/footer');
	}
	
	function detil_report($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_report_u);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_report_u);
		$data['controller']         = $this->controller_report;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_report_u);
		$data['datatable']          = "";
		$data['method']             = $this->method_report_khusus;
		$data['current_id']         = $this->id_report_u;
		$data['this_menu']          = $this->id_report_u;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
		if($id==1){
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
						'nama'      => 'Report Khusus'
				),
				3   => array(
						'target'    => "",
						'nama'      => 'Report Khusus Supervisor'
				)
		);
		}else{
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
							'nama'      => 'Report Khusus'
					),
					3   => array(
							'target'    => "",
							'nama'      => 'Report Khusus Staff'
					)
			);
		}
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/report/detail_report');
		$this->load->view('template/footer');
	}
	
	function detail_report_user($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_report_u);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_report_u);
		$data['controller']         = $this->controller_report;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_report_u);
		$data['datatable']          = "";
		$data['method']             = $this->method_report_khusus;
		$data['current_id']         = $this->id_report_u;
		$data['this_menu']          = $this->id_report_u;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
		if($id==1){
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
							'nama'      => 'Report Khusus'
					),
					3   => array(
							'target'    => "#",
							'nama'      => 'Report Khusus Supervisor'
					)
			);
		}else{
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
							'nama'      => 'Report Khusus'
					),
					3   => array(
							'target'    => "#",
							'nama'      => 'Report Khusus Staff'
					)
			);
		}
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/report/employee_detail');
		$this->load->view('template/footer');
	}
	
	function form_khusus($method="add",$id=0){
		$data       = $this->data;
		$id_ques	= $this->input->get('id_ques');
		$akses      = $this->get_akses($data['user_level'],$this->id_question);
		if($this->input->get('method'))
			$method = $this->input->get('method');
		if($this->input->get('id'))
			$id     = $this->input->get('id');
	
	
		$data['menu_name'] = $this->model_main->get_menu_name($this->tbl_menu,$this->id_question);
	
		if($method == "add"){
			if($akses['input']==0){
				redirect('errors/forbidden');
				exit();
			}
			$data['title']          = lang('lbl_insert').' '.$data['menu_name']['nama'];
		}else{
			if($akses['edit']==0){
				redirect('errors/forbidden');
				exit();
			}
			$data['get_data']       = $this->modul_employee.'/'.$this->controller_master.'/get_detail_question';
			$data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
		}
		$data['datatable']  = $this->modul_employee.'/'.$this->controller_master.'/data_question';
		$data['method']     = $method;
		$data['id']         = $id;
		$data['action']     = $this->modul_employee.'/'.$this->controller_master.'/save_detail_question/'.$id_ques;
		$this->load->view('employee/report/form_report',$data);
	}
	
	function coming_soon($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_report_u);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_report_u);
		$data['controller']         = $this->controller_report;
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_report_u);
		$data['datatable']          = "";
		$data['method']             = $this->method_report_khusus;
		$data['current_id']         = $this->id_report_u;
		$data['this_menu']          = $this->id_report_u;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
		if($id==1){
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
							'nama'      => 'Report Khusus'
					),
					3   => array(
							'target'    => "",
							'nama'      => 'Report Khusus Supervisor'
					)
			);
		}else{
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_report . '/' . $this->method_report_khusus,
							'nama'      => 'Report Khusus'
					),
					3   => array(
							'target'    => "",
							'nama'      => 'Report Khusus Staff'
					)
			);
		}
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('template/coming_soon');
		$this->load->view('template/footer');
	}
	
}