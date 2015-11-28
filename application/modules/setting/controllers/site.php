<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->cek_akses($data['user_level'],$this->id_site);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_site);
	}
	
	public function index(){
        $data = $this->data;
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_modul)==1){
    		redirect($this->modul_setting.'/'.$this->controller_site.'/'.$this->method_modul);
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_menu)==1){
    		redirect($this->modul_setting.'/'.$this->controller_site.'/'.$this->method_menu);
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_info)==1){
    		redirect($this->modul_setting.'/'.$this->controller_site.'/'.$this->method_info);
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_language)==1){
    		redirect($this->modul_setting.'/'.$this->controller_site.'/'.$this->method_language);
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_company)==1){
    		redirect($this->modul_setting.'/'.$this->controller_site.'/'.$this->method_company);
            die;
        }
        redirect($this->controller_dashboard);
	}
    
    // MODUL
    function modul(){        
        $data                       = $this->data;
        $this->cek_akses($data['user_level'],$this->id_modul);
                
        $data['this_modul']         = $this->modul_setting;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_modul);
        $data['controller']         = $this->controller_site;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_modul);
        $data['menu_name']['nama']  = $this->translate('modul');
        $data['datatable']          = $this->modul_setting.'/'.$this->controller_site.'/data_'.$this->method_modul;
        $data['method']             = $this->method_modul;
        $data['current_id']         = $this->id_site;
        $data['this_menu']          = $this->id_modul;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablequick" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width' => '10px'),lang('lbl_module'),lang('lbl_target'),array('data'=>'#','width'=>'30px'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'70px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->modul_setting.'/'.$this->controller_site.'/'.$this->method_modul,
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_modul(){
        $data   = $this->data;
        $akses  = $this->get_akses($data['user_level'],$this->id_modul);
        $delete = "true";
        $edit   = "true";
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";

        $this->datatables->select('id,nama,target,urutan,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_setting,$this->controller_site,$this->method_modul,$edit,$delete),'id')
        ->from($this->tbl_modul);
        
        echo $this->datatables->generate();
    }
    
    function form_modul($method="add",$id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_modul);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id'))
            $id     = $this->input->get('id');
        
        $data["form"]["data"] = array(
            0   => array(
                'name'      => 'nama',
                'type'      => 'text',
                'label'     => lang('lbl_module'),
                'class'     => 'longinput',
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            1   => array(
                'name'      => 'target',
                'type'      => 'text',
                'label'     => lang('lbl_target'),
                'class'     => 'longinput',
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            2   => array(
                'name'      => 'icon',
                'type'      => 'photo',
                'label'     => lang('lbl_icon'),
                'location'  => 'userdata/module-icon/',
                'width'     => 64,
                'height'    => 64,
            ),
            3   => array(
                'name'      => 'urutan',
                'type'      => 'text',
                'label'     => lang('lbl_order'),
                'class'     => 'smallinput',
                'validation'=> array(
                    'message'   => lang('lbl_number_only'),
                    'number'    => TRUE
                )
            ),
            4   => array(
                'name'      => 'status',
                'type'      => 'radio',
                'label'     => lang('lbl_status'),
                'chose'     => array(
                    0   => array(
                        'label'     => lang('lbl_active'),
                        'value'     => 1,
                        'checked'   => TRUE
                    ),
                    1   => array(
                        'label'     => lang('lbl_inactive'),
                        'value'     => 0
                    )
                )
            )
        );
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_modul);
        $data['menu_name']['nama']  = $this->translate('modul');
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
            $data['get_data']       = $this->modul_setting.'/'.$this->controller_site.'/get_data_'.$this->method_modul;
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['datatable']  = $this->modul_setting.'/'.$this->controller_site.'/data_'.$this->method_modul;
        $data['method']     = $method;
        $data['id']         = $id;
        $data['action']     = $this->modul_setting.'/'.$this->controller_site.'/save_'.$this->method_modul;
        $this->load->view('template/form',$data);
    }

    function get_data_modul(){
        $id = $this->input->post('id');
        $attr = array(
            'where_array'   => array('id'=>$id)
        );
        $data = $this->model_basic->get_data($this->tbl_modul,$attr)->row();
        $this->returnJson($data);
    }
    
    function save_modul(){
        $usr        = $this->data;
        $id         = $this->input->post('id');
        $icon       = $this->input->post('icon');
        $icon_old   = $this->input->post('old_icon');
        
        $data       = _input($this->input->post());
        if($data['nama']){
            if($icon){
                $ico = basename($icon);
                if(!is_dir(FCPATH . "userdata/module-icon/"))
				    mkdir(FCPATH . "userdata/module-icon/");
                $dest = "userdata/module-icon/".$ico;
                if(!@copy($icon,$dest))
                    $ico = $icon_old;
                else{
                    $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                    if( $icon_old != 'default.png' )
                        @unlink('userdata/module-icon/'.$icon_old);
                }
            }else 
                $ico = $icon_old;
                
            $data['icon'] = $ico;

            if($id){
                $data['update_by']      = $usr['user_id'];
                $data['update_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->update_data($this->tbl_modul,$data,'id',$id);
            }else{
                $data['create_by']      = $usr['user_id'];
                $data['create_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->insert_data($this->tbl_modul,$data);
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }

    function delete_modul($id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_modul);

        if($akses['delete']==1){
            $get_modul = $this->model_basic->get_data($this->tbl_modul,array('where_array'=>array('id'=>$id)));
            if($get_modul->num_rows() > 0){
                $modul           = $get_modul->row();
                $delete_modul    = $this->model_basic->delete_data($this->tbl_modul,'id',$modul->id);
                if($modul->icon != 'default.png')
                    @unlink('userdata/module-icon/'.$modul->icon);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
    // MENU
    function menu($id_modul=0){
        if($this->input->get('id_modul')) $id_modul = $this->input->get('id_modul');
        
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_menu);
        
        $data['data_modul']         = $this->model_basic->get_data($this->tbl_modul,array('sort_by'=>'urutan'))->result();
        
        if($id_modul == 0)
            $id_modul = $data['data_modul'][0]->id;
            
        $data['this_modul']         = $this->modul_setting;
        $data['id_modul']           = $id_modul;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_menu);
        $data['controller']         = $this->controller_site;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_menu);
        $data['menu_name']['nama']  = $this->translate('menu');
        $data['datatable']          = "";
        $data['method']             = $this->method_menu.'/'.$id_modul;
        $data['current_id']         = $this->id_site;
        $data['this_menu']          = $this->id_menu;
        $attr                       = array(
            'where_array'           => array(
                'parent_id'         => 0,
                'id_modul'          => $id_modul
            ),
            'sort_by'               => 'urutan'
        );
        $data['rs']                 = $this->model_basic->get_data($this->tbl_menu,$attr)->result();
        foreach($data['rs'] as $r){
            $attr                       = array(
                'where_array'           => array(
                    'parent_id'         => $r->id
                ),
                'sort_by'               => 'urutan'
            );
            $data['rs_detail'][$r->id]  = $this->model_basic->get_data($this->tbl_menu,$attr)->result();
        }
        
        $data['table']              = $this->table->generate();
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->modul_setting.'/'.$this->controller_site.'/'.$this->method_menu,
                'nama'      => $data['menu_name']['nama']
            )
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('site/view_menu');
        $this->load->view('template/footer');
    }

    function form_menu($id_modul=0,$method="add",$id=0){
        $data           = $this->data;
        $akses          = $this->get_akses($data['user_level'],$this->id_menu);
        if($this->input->get('method'))
            $method     = $this->input->get('method');
        if($this->input->get('id')){
            $id         = $this->input->get('id');
            $get_menu   = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('id'=>$id)))->row();
            $id_modul   = $get_menu->id_modul;
        }
        
        $par            = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('parent_id'=>0,'id_modul'=>$id_modul)))->result();
        $parent[0]      = new stdClass();
        $parent[0]->id  = 0;
        $parent[0]->nama= "";
        $i=1;
        foreach($par as $p){
            $parent[$i]         = new stdClass();
            $parent[$i]->id     = $p->id;
            $parent[$i]->nama   = $p->nama;
            $i++;
        } 
        $data["form"]["data"] = array(
            0   => array(
                'name'      => 'parent_id',
                'type'      => 'select',
                'label'     => lang('lbl_parent'),
                'class'     => 'mediuminput',
                'data'      => $parent,
                'opt_value' => 'id',
                'opt_label' => 'nama'
            ),
            1   => array(
                'name'      => 'nama',
                'type'      => 'text',
                'label'     => lang('lbl_menu'),
                'class'     => 'longinput',
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            2   => array(
                'name'      => 'target',
                'type'      => 'text',
                'label'     => lang('lbl_target'),
                'class'     => 'longinput',
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            3   => array(
                'name'      => 'keterangan',
                'type'      => 'textarea',
                'label'     => lang('lbl_description'),
                'class'     => 'longinput'
            ),
            4   => array(
                'name'      => 'icon',
                'type'      => 'photo',
                'label'     => lang('lbl_icon'),
                'location'  => 'userdata/menu-icon/',
                'width'     => 64,
                'height'    => 64,
            ),
            5   => array(
                'name'      => 'urutan',
                'type'      => 'text',
                'label'     => lang('lbl_order'),
                'class'     => 'smallinput',
                'validation'=> array(
                    'message'   => lang('lbl_number_only'),
                    'number'    => TRUE
                )
            ),
            6   => array(
                'name'      => 'akses',
                'type'      => 'checkbox',
                'label'     => lang('lbl_access'),
                'chose'     => array(
                    0   => array(
                        'label'     => lang('lbl_view'),
                        'value'     => 1,
                        'checked'   => TRUE,
                        'disabled'  => TRUE,
                        'name'      => 'akses_view'
                    ),
                    1   => array(
                        'label'     => lang('lbl_input'),
                        'value'     => 1,
                        'name'      => 'akses_input'
                    ),
                    2   => array(
                        'label'     => lang('lbl_edit'),
                        'value'     => 1,
                        'name'      => 'akses_edit'
                    ),
                    3   => array(
                        'label'     => lang('lbl_delete'),
                        'value'     => 1,
                        'name'      => 'akses_delete'
                    ),
                )
            ),
            7   => array(
                'name'      => 'status',
                'type'      => 'radio',
                'label'     => lang('lbl_status'),
                'chose'     => array(
                    0   => array(
                        'label'     => lang('lbl_active'),
                        'value'     => 1,
                        'checked'   => TRUE
                    ),
                    1   => array(
                        'label'     => lang('lbl_inactive'),
                        'value'     => 0
                    )
                )
            )
        );
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_menu);
        $data['menu_name']['nama']  = $this->translate('menu');
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
            $data['get_data']       = $this->modul_setting.'/'.$this->controller_site.'/get_data_'.$this->method_menu;
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['datatable']  = "";
        $data['method']     = $method;
        $data['id']         = $id;
        $data['action']     = $this->modul_setting.'/'.$this->controller_site.'/save_'.$this->method_menu.'/'.$id_modul;
        $this->load->view('template/form',$data);
    }
    
    function get_data_menu(){
        $id = $this->input->post('id');
        $data = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('id'=>$id)))->row();
        $this->returnJson($data);
    }
    
    function save_menu($id_modul=0){
        $usr                = $this->data;
        $id                 = $this->input->post('id');
        $akses_input        = $this->input->post('akses_input');
        $akses_edit         = $this->input->post('akses_edit');
        $akses_delete       = $this->input->post('akses_delete');
        $icon               = $this->input->post('icon');
        $icon_old           = $this->input->post('old_icon');
        
        $data               = _input($this->input->post());
        $data['akses_view'] = 1;
        if(!$akses_input) $data['akses_input'] = 0;
        if(!$akses_edit) $data['akses_edit'] = 0;
        if(!$akses_delete) $data['akses_delete'] = 0;
        $data['id_modul']   = $id_modul;

        if($data['nama'] && $data['target']){
            if($icon){
                $ico = basename($icon);
                if(!is_dir(FCPATH . "userdata/menu-icon/"))
		 	        mkdir(FCPATH . "userdata/menu-icon/");
                $dest = "userdata/menu-icon/".$ico;
                if(!@copy($icon,$dest))
				    $ico = $icon_old;
                else{
                    $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                    if( $icon_old != 'default.png' )
    		 		   @unlink('userdata/menu-icon/'.$icon_old);
                }
            }else 
                $ico = $icon_old;
                
            $data['icon']   = $ico;
        
            if($id){
                $data['update_by']      = $usr['user_id'];
                $data['update_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->update_data($this->tbl_menu,$data,'id',$id);
            }else{
                $data['create_by']      = $usr['user_id'];
                $data['create_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->insert_data($this->tbl_menu,$data);
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }
    
    function delete_menu($id_modul=0,$id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_menu);
        if($akses['delete']==1){
            $get_menu = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('id'=>$id)));
            $sub_menu = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('parent_id'=>$id)))->result();
            if($get_menu->num_rows() > 0){
                $menu           = $get_menu->row();
                $delete_menu    = $this->model_basic->delete_data($this->tbl_menu,'id',$menu->id);
                $delete_akses   = $this->model_basic->delete_data($this->tbl_user_akses,'id_menu',$menu->id);
                if($menu->icon!='default.png')
                    @unlink('userdata/menu-icon/'.$menu->icon);
                foreach($sub_menu as $sm){
                    $delete_submenu = $this->model_basic->delete_data($this->tbl_menu,'id',$sm->id);
                    $delete_akses   = $this->model_basic->delete_data($this->tbl_user_akses,'id_menu',$sm->id);
                    if($sm->icon!='default.png')
                        @unlink('userdata/menu-icon/'.$sm->icon);
                }
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}

    function info(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_info);
        
        $data['this_modul']         = $this->modul_setting;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_info);
        $data['controller']         = $this->controller_site;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_info);
        $data['menu_name']['nama']  = $this->translate('info');
        $data['method']             = $this->method_info;
        $data['datatable']          = "";
        $data['current_id']         = $this->id_site;
        $data['this_menu']          = $this->id_info;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->controller_site.'/'.$this->method_info,
                'nama'      => $data['menu_name']['nama']
            )
        );
        $attr = array(
            'where_array'   => array(
                'id'    => 1
            )
        );
        $data['action']         = $this->modul_setting.'/'.$this->controller_site.'/save_info';
        $data['info']           = $this->model_basic->get_data($this->tbl_profile_site,$attr)->row();
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('site/form_info');
        $this->load->view('template/footer');
    }
    
    function save_info(){
        $icon           = $this->input->post('icon');
        $icon_old       = $this->input->post('old_icon');
        $icon2          = $this->input->post('icon2');
        $icon_old2      = $this->input->post('old_icon2');
		
        $data           = _input($this->input->post());
        
		if($data['perusahaan'] && $data['judul']){
            if($icon){
                $ico = basename($icon);
                if(!is_dir(FCPATH . "userdata/profile_site/"))
				    mkdir(FCPATH . "userdata/profile_site/");
                $dest = "userdata/profile_site/".$ico;
                if(!@copy($icon,$dest))
		 		   $ico = $icon_old;
                else{
                    $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                    @unlink('userdata/profile_site/'.$icon_old);
                }
            }else 
                $ico = $icon_old;

            if($icon2){
                $ico2 = basename($icon2);
                if(!is_dir(FCPATH . "userdata/profile_site/"))
				    mkdir(FCPATH . "userdata/profile_site/");
                $dest2 = "userdata/profile_site/".$ico2;
                if(!@copy($icon2,$dest2))
		 		   $ico2 = $icon_old2;
                else{
                    $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder2'));
                    @unlink('userdata/profile_site/'.$icon_old2);
                }
            }else 
                $ico2 = $icon_old2;
                
            $data['logo']       = $ico;
            $data['logo_depan'] = $ico2;
            unset($data['icon2']);
            unset($data['old_icon2']);

            $save = $this->model_basic->update_data($this->tbl_profile_site,$data,'id',1);
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }
    
    // LANGUAGE
    function language(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_language);

        $data['this_modul']         = $this->modul_setting;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_language);
        $data['controller']         = $this->controller_site;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_language);
        $data['menu_name']['nama']  = $this->translate('language');
        $data['datatable']          = "";
        $data['method']             = $this->method_language;
        $data['current_id']         = $this->id_site;
        $data['this_menu']          = $this->id_language;
        $data['rs']                 = $this->get_language();
        
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->modul_setting.'/'.$this->controller_site.'/'.$this->method_language,
                'nama'      => $data['menu_name']['nama']
            )
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('site/view_language');
        $this->load->view('template/footer');
    }
    
    function add_language(){
        $data           = $this->data;
        $akses          = $this->get_akses($data['user_level'],$this->id_menu);
        
        if($akses['input']==0){
            redirect('errors/forbidden');
            exit();
        }
        
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_language);
        $data['menu_name']['nama']  = $this->translate('language');
        $data['title']              = lang('lbl_insert').' '.$data['menu_name']['nama'];
        $data['datatable']          = "";
        $data['action']             = $this->modul_setting.'/'.$this->controller_site.'/save_add_'.$this->method_language;
        $this->load->view('site/add_language',$data);
    }

    function edit_language($language="english"){
        if($this->input->get('lang'))
            $language = $this->input->get('lang');
            
        $data           = $this->data;
        $akses          = $this->get_akses($data['user_level'],$this->id_language);
        
        if($akses['edit']==0){
            redirect('errors/forbidden');
            exit();
        }
        
		$file_location		= 'application/language/'.$language.'/'.$this->language_select;
		$isi_file			= file_get_contents($file_location);
		$filter				= str_replace('<?php', '', $isi_file);
		$filter2			= str_replace('?>', '', $filter);
		$pecah				= explode(';',$filter2);
		$i = 1;
		foreach ($pecah as $p){
			$pecah2 = explode('=',$p);
			if(count($pecah2) > 1){
				$pecah3 			= explode('"',$pecah2[0]);
				$pecah4 			= explode('"',$pecah2[1]);

				$data['attr'][$i] 	= $pecah3[1];
				$data['lbl'][$i]	= ucfirst( str_replace('_', ' ', $data['attr'][$i]) );
				$data['val'][$i] 	= $pecah4[1];
				$i++;
			}
		}
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_language);
        $data['menu_name']['nama']  = $this->translate('language');
        $data['title']              = lang('lbl_update').' '.$data['menu_name']['nama'].' ('.$language.')';
        $data['datatable']          = "";
        $data['action']             = $this->modul_setting.'/'.$this->controller_site.'/save_edit_'.$this->method_language.'/'.$language;
        $this->load->view('site/edit_language',$data);
    }

	function save_add_language(){
		$language = strtolower($this->input->post('language'));
		$this->load->helper('directory');
		
		$srcdir=rtrim(getcwd().'\application\language\english','/');
		$dstdir=rtrim(getcwd().'\application\language/'.$language,'/');
		
		if(!is_dir($dstdir))mkdir($dstdir, 0777, true);
		
		$dir_map=directory_map($srcdir);
		
		foreach($dir_map as $object_key=>$object_value){
			if(is_numeric($object_key))
				copy($srcdir.'/'.$object_value,$dstdir.'/'.$object_value);
			else
				copy($srcdir.'/'.$object_key,$dstdir.'/'.$object_key);
		}
		
		if($language)
            $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
	}

	function save_edit_language($language=""){
		$attr 	= $this->input->post('attr');
		$val 	= $this->input->post('val');
		$i 		= 1;
		$string	= "<?php " . PHP_EOL;
		foreach($attr as $a){
			$string .= '$lang["'.$a.'"] = "'.$val[$i].'";' . PHP_EOL;
			$i++;
		}
		$string .= " ?>";
		$namafile = 'application/language/'.$language.'/'.$this->language_select;
		$handle = fopen ($namafile, "w");
		if($handle) {
			fwrite ( $handle, $string );
		}
		fclose($handle);
        
        $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
	}

	function delete_language($language = ""){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_language);
        if($akses['delete']==1){
    		if($language != "english"){
    			$this->deleteDir(FCPATH . "application/language/".$language);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else
            echo lang('msg_you_cannot_access_to_delete_this_data');
	}
    
}