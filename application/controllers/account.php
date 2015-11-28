<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
	}
	
	public function index(){
		redirect($this->controller_master.'/view_icon');
	}

    // EDIT PROFILE
    function edit_profile(){
        $data                       = $this->data;
        
        $data['menu_name']['nama']          = lang('lbl_account');
        $data['menu_name']['keterangan']    = lang('lbl_edit_profile');
        
        $data['datatable']          = "";
        $data['method']             = $this->method_master;
        $data['no_left_menu']       = TRUE;
        $data['this_modul']         = FALSE;
        $data['controller']         = $this->controller_account;
        $data['action']             = $this->controller_account.'/save_edit_profile';
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->controller_account.'/edit_profile',
                'nama'      => $data['menu_name']['keterangan']
            )
        );
        $data['profile']            = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$data['user_id'])))->row();
        if(count($data['modul']) > 0 )
            $this->load->view('template/header',$data);
        else
            $this->load->view('template/dashboard_header',$data);
        $this->load->view('account/form_edit_profile');
        $this->load->view('template/footer');
    }
    
    function save_edit_profile(){
        $data       = $this->data;
        $nama       = $this->input->post('nama');
        
        $update     = $this->model_basic->update_data($this->tbl_user,array('nama'=>$nama),'id',$data['user_id']);
        if($update)
            $this->returnJson(array('message'=>lang('msg_edit_profile_success'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_edit_profile_failed'),'status'=>'error'));
    }

    // ACCOUNT SETTING
    function account_setting(){
        $data                       = $this->data;
        
        $data['menu_name']['nama']          = lang('lbl_account');
        $data['menu_name']['keterangan']    = lang('lbl_account_settings');
        
        $data['datatable']          = "";
        $data['method']             = $this->method_master;
        $data['no_left_menu']       = TRUE;
        $data['this_modul']         = FALSE;
        $data['controller']         = $this->controller_account;
        $data['action']             = $this->controller_account.'/save_account_setting';
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->controller_account.'/account_setting',
                'nama'      => $data['menu_name']['keterangan']
            )
        );
        $data['language']           = $this->get_language();
        $data['setting']            = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$data['user_id'])))->row();
        if(count($data['modul']) > 0 )
            $this->load->view('template/header',$data);
        else
            $this->load->view('template/dashboard_header',$data);
        $this->load->view('account/form_account_setting');
        $this->load->view('template/footer');
    }
    
    function save_account_setting(){
        $data       = $this->data;
        $user       = $this->input->post();
        
        $update     = $this->model_basic->update_data($this->tbl_user,$user,'id',$data['user_id']);
        if($update)
            $this->returnJson(array('message'=>lang('msg_account_setting_success'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_account_setting_failed'),'status'=>'error'));
    }
    
    // CHANGE PASSWORD
    function change_password(){
        $data                       = $this->data;
        
        $data['menu_name']['nama']          = lang('lbl_account');
        $data['menu_name']['keterangan']    = lang('lbl_change_password');
        
        $data['datatable']          = "";
        $data['method']             = $this->method_master;
        $data['no_left_menu']       = TRUE;
        $data['this_modul']         = FALSE;
        $data['controller']         = $this->controller_account;
        $data['action']             = $this->controller_account.'/save_change_password';
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->controller_account.'/change_password',
                'nama'      => $data['menu_name']['keterangan']
            )
        );
        if(count($data['modul']) > 0 )
            $this->load->view('template/header',$data);
        else
            $this->load->view('template/dashboard_header',$data);
        $this->load->view('account/form_change_password');
        $this->load->view('template/footer');
    }
    
    function check_password(){
        $data       = $this->data;
        $password   = $this->input->post('password');
        
        $check      = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$data['user_id'],'password'=>md5($password))))->num_rows();
        if($check > 0)
            echo 'ok';
        else
            echo 'error';
    }
    
    function save_change_password(){
        $data       = $this->data;
        $password   = md5($this->input->post('password'));
        
        $update     = $this->model_basic->update_data($this->tbl_user,array('password'=>$password),'id',$data['user_id']);
        if($update)
            $this->returnJson(array('message'=>lang('msg_change_password_success'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_change_password_failed'),'status'=>'error'));
    }

}