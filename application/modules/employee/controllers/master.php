<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->load->model('employee/model_basic_l');
        $this->cek_akses($data['user_level'],$this->id_master_emp);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_master_emp);
	}
	
	public function index(){
		$data = $this->data;
		if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_khusus)==1){
			redirect($this->modul_employee.'/'.$this->controller_master.'/'.$this->method_standard_question);
			die;
		}
		
		redirect($this->controller_master);
	}
	
	function standard_question($id=1){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_question);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_tipe']			= $id;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_khusus);
		$data['controller']         = $this->controller_master;
		$data['controller_name']    = $this->controller_name;
		if($id==1){
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_khusus);
		}else{
			$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_umum);
		}
		$data['datatable']          = "";
		$data['method']             = $this->method_standard_question;
		$data['current_id']         = $this->id_khusus;
		$data['this_menu']          = $this->id_question;
	
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
						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_standard_question,
						'nama'      => $data['menu_name']['nama']
				)
		);
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/question/question_khusus');
		$this->load->view('template/footer');
	}
	
	function question($id_posisi=0,$tipe=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_question);
	
		$data['this_modul']         = $this->modul_employee;
		$data['id_posisi']			= $id_posisi;
		$data['id_tipe']			= $tipe;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_question);
		$data['controller']         = $this->controller_master;
		$data['controller_name']    = $this->controller_name;
		if($tipe==1){
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_khusus);
		}elseif($tipe==2){
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_umum);
		}
		$data['datatable']          = $this->modul_employee . '/' . $this->controller_master . '/data_' . $this->method_question.'/'.$id_posisi.'/'.$tipe;
		$data['method']             = $this->method_question;
		$data['current_id']         = $this->id_master_emp;
		$data['this_menu']          = $this->id_question;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_question'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
		if($id_posisi==1 && $tipe==1){
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_standard_question.'/1',
						'nama'      => $data['menu_name']['nama']
				),
				3   => array(
						'target'    => "",
						'nama'      => "Penilaian Khusus Supervisor"
				)
		);
		}elseif($id_posisi==2 && $tipe==1){
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_standard_question.'/1',
							'nama'      => $data['menu_name']['nama']
					),
					3   => array(
							'target'    => "",
							'nama'      => "Penilaian Khusus Staff"
					)
			);
		}elseif($id_posisi==1 && $tipe==2){
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_standard_question.'/2',
						'nama'      => $data['menu_name']['nama']
				),
				3   => array(
						'target'    => "",
						'nama'      => "Penilaian Umum Supervisor"
				)
		);
		}elseif($id_posisi==2 && $tipe==2){
			$data['breadcrumbs']        = array(
					1   => array(
							'target'    => $this->modul_employee,
							'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
					),
					2   => array(
							'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_standard_question.'/2',
							'nama'      => $data['menu_name']['nama']
					),
					3   => array(
							'target'    => "",
							'nama'      => "Penilaian Umum Staff"
					)
			);
		}
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/question/content_khusus');
		$this->load->view('template/footer');
	}
	
	function data_question($id_posisi=0,$id_tipe=0){
		$data   = $this->data;
		$akses  = $this->get_akses($data['user_level'],$this->id_question);
		$delete = "true";
		$edit   = "true";
		//$detail = "employee/master/detail_question/";
		if($akses['edit']==0) $edit = "false";
		if($akses['delete']==0) $delete = "false";
	
		$this->datatables->select('id,soal,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
		->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_employee,$this->controller_master,$this->method_question,$edit,$delete),'id')
		->where('id_posisi',$id_posisi)
		->where('tipe',$id_tipe)
		->from($this->tbl_question);
	
		echo $this->datatables->generate();
	}
	
	function form_question($method="add",$id=0){
		$data       = $this->data;
		$akses      = $this->get_akses($data['user_level'],$this->id_question);
		if($this->input->get('method'))
			$method = $this->input->get('method');
		if($this->input->get('id'))
			$id     = $this->input->get('id');
		if($this->input->get('id_posisi'))
			$id_posisi     = $this->input->get('id_posisi');
		if($this->input->get('id_tipe'))
			$id_tipe     = $this->input->get('id_tipe');
		
	
		
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
			$data['get_data']       = $this->modul_employee.'/'.$this->controller_master.'/get_data_question';
			$data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
		}
		$data['datatable']  = $this->modul_employee.'/'.$this->controller_master.'/data_question';
		$data['method']     = $method;
		$data['id']         = $id;
		if(isset($id_posisi) && isset($id_tipe)){
		$data['action']     = $this->modul_employee.'/'.$this->controller_master.'/save_question/'.$id_posisi.'/'.$id_tipe;
		}else{
			$data['action']     = $this->modul_employee.'/'.$this->controller_master.'/save_question';
		}
		$this->load->view('employee/question/form_question',$data);
	}
	
	function get_data_question(){
		$id = $this->input->post('id');
		$data = $this->model_basic->get_data($this->tbl_question,array('where_array'=>array('id'=>$id)))->row();
		$this->returnJson($data);
	}
	
	function save_question($id_posisi=0,$id_tipe=0){
		$usr        = $this->data;
		$id         = $this->input->post('id');
			
		$data           	= _input($this->input->post());
		$data['soal'] 		= str_replace('|and|','&',$data['soal']);
		if(!$this->input->post('tipe') && !$this->input->post('id_posisi')){
		$data['id_posisi']	= $id_posisi;
		$data['tipe']		= $id_tipe;
		}
		
		if($data['soal']){
			if($id){
				$save = $this->model_basic->update_data($this->tbl_question,$data,'id',$id);
			}else{
				$save = $this->model_basic->insert_data($this->tbl_question,$data);
			}
			if($save)
				$this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
			else
				$this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
		}else
			$this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
	}
	
	function delete_question($id=""){
		$data       = $this->data;
		$akses      = $this->get_akses($data['user_level'],$this->id_question);
		if($akses['delete']==1){
			$get_question = $this->model_basic->get_data($this->tbl_question,array('where_array'=>array('id'=>$id)));
			if($get_question->num_rows() > 0){
				$question         	= $get_question->row();
				$delete_user_group  = $this->model_basic->delete_data($this->tbl_question,'id',$question->id);
				echo lang('msg_delete_success');
			}else{
				echo lang('msg_delete_failed');
			}
		}else{
			echo lang('msg_you_cannot_access_to_delete_this_data');
		}
	}
	
	function detail_question($id=0){
		$data                       = $this->data;
	
		$this->cek_akses($data['user_level'],$this->id_question);
	
		$data['this_modul']         = $this->modul_employee;
		$data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_employee);
		$data['id_ques']			= $id;
		$data['akses']              = $this->get_akses($data['user_level'],$this->id_question);
		$data['controller']         = $this->controller_master;
		$data['question']			= $this->model_basic_l->get_data('*',$this->tbl_question,array('id' => $id))->row();
		$data['controller_name']    = $this->controller_name;
		$data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_question);
		$data['datatable']          = $this->modul_employee . '/' . $this->controller_master . '/data_' . $this->method_detail_question.'/'.$id;
		$data['method']             = $this->method_detail_question;
		$data['current_id']         = $this->id_master_emp;
		$data['this_menu']          = $this->id_question;
	
		$tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_answer'),lang('lbl_score'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
		$this->table->set_footing(array('data'=>lang('lbl_no'),'width' => '10px'),lang('lbl_answer'),lang('lbl_score'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'80px'));
	
		$data['table']              = $this->table->generate();
	
		$data['breadcrumbs']        = array(
				1   => array(
						'target'    => $this->modul_employee,
						'nama'      => $this->model_main->get_modul_name($this->tbl_modul,$this->id_modul_employee)
				),
				2   => array(
						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_question,
						'nama'      => $data['menu_name']['nama']
				),
				3  => array(
						'target'    => $this->modul_employee . '/' . $this->controller_master . '/' . $this->method_detail_question,
						'nama'      => "Detail Question"
				)
		);
		$this->load->view('template/header',$data);
		$this->load->view('template/menu');
		$this->load->view('employee/question/detail_question');
		$this->load->view('template/footer');
	}
	
	function data_detail_question($id=0){
		$data   = $this->data;
		$akses  = $this->get_akses($data['user_level'],$this->id_question);
		$delete = "true";
		$edit   = "true";
		if($akses['edit']==0) $edit = "false";
		if($akses['delete']==0) $delete = "false";
	
		$this->datatables->select('id,jawaban,skor,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
		->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_employee,$this->controller_master,$this->method_detail_question,$edit,$delete),'id')
		->where('id_soal',$id)
		->from($this->tbl_answer);
		
	
		echo $this->datatables->generate();
	}
	
	function form_detail_question($method="add",$id=0){
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
		$this->load->view('employee/question/form_detail_question',$data);
	}
	
	function save_detail_question($id_ques=0){
		$usr        = $this->data;
		$id         = $this->input->post('id');
	
	
		$data           = _input($this->input->post());
		$data['jawaban']= str_replace('|and|','&',$data['jawaban']);
 		
 		if(!$this->input->post('id_soal')){
 			$data['id_soal']= $id_ques;
 		}

		if($data['jawaban']){
			if($id){
				$save = $this->model_basic->update_data($this->tbl_answer,$data,'id',$id);
			}else{
				$save = $this->model_basic->insert_data($this->tbl_answer,$data);
			}
			if($save)
				$this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
			else
				$this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
		}else
			$this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
	}
	
	function get_detail_question(){
		$id = $this->input->post('id');
		$data = $this->model_basic->get_data($this->tbl_answer,array('where_array'=>array('id'=>$id)))->row();
		$this->returnJson($data);
	}
	
	function delete_detail_question($id=""){
		$data       = $this->data;
		$akses      = $this->get_akses($data['user_level'],$this->id_question);
		if($akses['delete']==1){
			$get_answer = $this->model_basic->get_data($this->tbl_answer,array('where_array'=>array('id'=>$id)));
			if($get_answer->num_rows() > 0){
				$answer         	= $get_answer->row();
				$delete_answer  = $this->model_basic->delete_data($this->tbl_answer,'id',$answer->id);
				echo lang('msg_delete_success');
			}else{
				echo lang('msg_delete_failed');
			}
		}else{
			echo lang('msg_you_cannot_access_to_delete_this_data');
		}
	}
	

}