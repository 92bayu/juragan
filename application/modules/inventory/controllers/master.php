<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
	}
	
	public function index(){
		redirect($this->modul_inventory.'/'.$this->controller_master.'/view_icon');
	}
    
    // MASTER
    function view_icon(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_master);
        $data['controller']         = $this->controller_master;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate('master');
        $data['datatable']          = "";
        $data['method']             = $this->method_master;
        $data['master_general']     = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('parent_id'=>0,'status'=>1,'spesifik'=>0),'sort_by'=>'urutan'))->result();
        $data['master_spesifik']    = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('parent_id'=>0,'status'=>1,'spesifik'=>1),'sort_by'=>'urutan'))->result();
        $data['current_id']         = $this->id_inv_master;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('cms')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/view_icon',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('master/view_icon');
        $this->load->view('template/footer');
    }
    
    function view_list(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_master);
        $data['controller']         = $this->controller_master;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate('master');
        $data['datatable']          = $this->modul_inventory.'/'.$this->controller_master.'/data_'.$this->method_master;
        $data['method']             = $this->method_master;
        $data['current_id']         = $this->id_inv_master;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_master'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'100px'));
        $this->table->set_footing(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_master'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'100px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('cms')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/view_list',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('master/view_list');
        $this->load->view('template/footer');
    }
    
    function data_master(){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        $delete     = "true";
        $edit       = "true";
        $detail_url = $this->modul_inventory.'/'.$this->controller_master.'/submaster?parent_id=';
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";

        $this->datatables->select('id,kode,kategori,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
        ->where('parent_id',0)
        #->unset_column('id')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_inventory,$this->controller_master,$this->method_master,$edit,$delete,$detail_url),'id')
        ->from($this->inv_master);
        
        echo $this->datatables->generate();
    }
    
    function form_master($method="add",$id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id'))
            $id     = $this->input->get('id');
        
        $data['datatable']  = $this->modul_inventory.'/'.$this->controller_master.'/data_'.$this->method_master;
        $check              = $this->model_basic->get_data($this->inv_kode_default,array('where_array'=>array('id'=>1)))->row();
        if($check){
            $kode_prefix    = $check->kode_prefix;
            $jumlah_digit   = $check->jumlah_digit;
        }else{
            $kode_prefix    = "";
            $jumlah_digit   = 0;
        }
        $data['kode']       = $this->codeGenerator($this->inv_master,$kode_prefix,$jumlah_digit,array('parent_id'=>0));
        if($method == "add_"){
            $method = "add";
            $data['datatable'] = "";
        }

        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate('master');
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
            $data['get_data']       = $this->modul_inventory.'/'.$this->controller_master.'/get_data_'.$this->method_master;
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['method']     = $method;
        $data['id']         = $id;
        $data['action']     = $this->modul_inventory.'/'.$this->controller_master.'/save_'.$this->method_master;
        $this->load->view('master/form_master',$data);
    }
    
    function get_data_master(){
        $id = $this->input->post('id');
        $data = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$id)))->row();
        $this->returnJson($data);
    }
    
    function save_master(){
        $usr        = $this->data;
        $id         = $this->input->post('id');
        $icon       = $this->input->post('icon');
        $icon_old   = $this->input->post('old_icon');
        $spesifik   = $this->input->post('spesifik');
        
        $data       = _input($this->input->post());
        if(!$spesifik) $data['spesifik'] = 0;
        if($data['kategori'] && $data['kode']){
            $check = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('kode'=>$data['kode'],'parent_id'=>0)))->row();
            if($id){
                if($check && $check->id != $id){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                if($icon){
                    $ico = basename($icon);
                    if(!is_dir(FCPATH . "userdata/master-icon/"))
				        mkdir(FCPATH . "userdata/master-icon/");
                    $dest = "userdata/master-icon/".$ico;
                    if(!@copy($icon,$dest))
				        $ico = $icon_old;
                    else{
                        $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                        if( $icon_old != 'default.png' )
                            @unlink('userdata/master-icon/'.$icon_old);
                    }
                }else 
                    $ico = $icon_old;
                
                $data['icon']           = $ico;
                $data['update_by']      = $usr['user_id'];
                $data['update_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->update_data($this->inv_master,$data,'id',$id);
            }else{
                if($check){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                if($icon){
                    $ico = basename($icon);
                    if(!is_dir(FCPATH . "userdata/master-icon/"))
				        mkdir(FCPATH . "userdata/master-icon/");
                    $dest = "userdata/master-icon/".$ico;
                    if(!@copy($icon,$dest))
				        $ico = $icon_old;
                    else{
                        $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                        if( $icon_old != 'default.png' )
                            @unlink('userdata/master-icon/'.$icon_old);
                    }
                }else 
                    $ico = $icon_old;
                
                $data['icon']           = $ico;
                $data['create_by']      = $usr['user_id'];
                $data['create_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->insert_data($this->inv_master,$data);
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }

    function delete_master($id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($akses['delete']==1){
            $get_master = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$id)));
            if($get_master->num_rows() > 0){
                $master           = $get_master->row();
                $delete_master    = $this->model_basic->delete_data($this->inv_master,'id',$master->id);
                $delete_submaster = $this->model_basic->delete_data($this->inv_master,'parent_id',$master->id);
                if($master->icon != 'default.png')
                    @unlink('userdata/master-icon/'.$master->icon);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
    // submaster
    public function submaster($parent_id=0){
        if($this->input->get('parent_id')) $parent_id = $this->input->get('parent_id');
                
        $check  = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$parent_id)))->row();
        if($check){
            if($check->spesifik == 1){
                redirect($this->modul_inventory.'/'.$this->controller_master.'/'.$check->target);
                die;
            }
            if($check->status == 0){
                redirect($this->modul_inventory.'/'.$this->controller_master.'/view_icon');
                die;
            }
        }else{
            redirect($this->modul_inventory.'/'.$this->controller_master.'/view_icon');
            die;
        }
        
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_master);
        $data['controller']         = $this->controller_master;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']['nama']  = $this->translate($check->kategori);
        $data['menu_name']['keterangan']    = $check->keterangan;
        $data['datatable']          = $this->modul_inventory.'/'.$this->controller_master.'/data_submaster?parent_id='.$parent_id;
        $data['method']             = 'submaster/'.$parent_id;
        $data['current_id']         = $this->id_inv_master;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data' => lang('lbl_number'), 'width'=>"10px"),lang('lbl_code'),$check->kategori,array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'100px'));
        $this->table->set_footing(array('data' => lang('lbl_number'), 'width'=>"10px"),lang('lbl_code'),$check->kategori,array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'100px'));

        $data['table']              = $this->table->generate();
        $menu_name                  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('cms')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/view_icon',
                'nama'      => $this->translate('master')
            ),
            3   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/submenu?parent_id='.$parent_id,
                'nama'      => $data['menu_name']['nama']
            )
        );
        
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_submaster($parent_id=0){
        if($this->input->get('parent_id')) $parent_id = $this->input->get('parent_id');
        $data   = $this->data;
        $akses  = $this->get_akses($data['user_level'],$this->id_inv_master);
        $delete = "true";
        $edit   = "true";
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";
		
        $this->datatables->select('id,kode,kategori,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
        ->where('parent_id',$parent_id)
       # ->unset_column('id')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_inventory,$this->controller_master,'submaster',$edit,$delete),'id')
        ->from($this->inv_master);
        
        echo $this->datatables->generate();
    }
    
    function form_submaster($parent_id=0,$method="add",$id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id')){
            $id         = $this->input->get('id');
            $cek        = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$id)))->row();
            $parent_id  = $cek->parent_id;
        }
        
        $check  = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$parent_id)))->row();
        if($check){
            if($check->spesifik == 1){
                redirect($this->modul_inventory.'/'.$this->controller_master.'/'.$check->target);
                die;
            }
            if($check->status == 0){
                redirect($this->modul_inventory.'/'.$this->controller_master.'/view_icon');
                die;
            }
        }else{
            redirect($this->modul_inventory.'/'.$this->controller_master.'/view_icon');
            die;
        }
        
        $kode   = $this->codeGenerator($this->inv_master,$check->kode_prefix,$check->jumlah_digit,array('parent_id'=>$parent_id));

        $data["form"]["data"] = array(
            0   => array(
                'name'      => 'kode',
                'type'      => 'text',
                'label'     => lang('lbl_code'),
                'class'     => 'mediuminput',
                'value'     => $kode,
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            1   => array(
                'name'      => 'kategori',
                'type'      => 'text',
                'label'     => $this->translate($check->kategori),
                'class'     => 'longinput',
                'validation'=> array(
                    'message'   => lang('lbl_required')
                )
            ),
            2   => array(
                'name'      => 'keterangan',
                'type'      => 'textarea',
                'label'     => lang('lbl_description'),
                'class'     => 'longinput'
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

        $data['datatable']          = $this->modul_inventory.'/'.$this->controller_master.'/data_submaster?parent_id='.$parent_id;
        $data['menu_name']['nama']  = $this->translate($check->kategori);
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
            $data['get_data']       = $this->modul_inventory.'/'.$this->controller_master.'/get_data_'.$this->method_master;
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['method']     = $method;
        $data['id']         = $id;
        $data['action']     = $this->modul_inventory.'/'.$this->controller_master.'/save_submaster/'.$parent_id;
        $this->load->view('template/form',$data);
    }
        
    function save_submaster($parent_id=0){
        $usr        = $this->data;
        $id         = $this->input->post('id');
        
        $data       = _input($this->input->post());
        if($data['kategori'] && $data['kode']){
            $check = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('kode'=>$data['kode'],'parent_id'=>$parent_id)))->row();
            if($id){
                if($check && $check->id != $id){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                $data['update_by']      = $usr['user_id'];
                $data['update_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->update_data($this->inv_master,$data,'id',$id);
            }else{
                if($check){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                $data['parent_id']      = $parent_id;
                $data['create_by']      = $usr['user_id'];
                $data['create_date']    = date('Y-m-d H:i:s');
                $save = $this->model_basic->insert_data($this->inv_master,$data);
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }
    
    function delete_submaster($id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($akses['delete']==1){
            $get_master = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$id)));
            if($get_master->num_rows() > 0){
                $master           = $get_master->row();
                $delete_master    = $this->model_basic->delete_data($this->inv_master,'id',$master->id);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
    function setting_master(){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        
        if($akses['input']==0 || $akses['edit']==0){
            redirect('errors/forbidden');
            exit();
        }

        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate('master');
        $data['controller']         = $this->controller_master;
        $data['master']             = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('parent_id'=>0,'status'=>1,'spesifik'=>0),'sort_by'=>'urutan'))->result();
        $data['setting']            = $this->model_basic->get_data($this->inv_setting_master)->result();
        $data['title']              = lang('lbl_setting').' '.$this->translate($data['menu_name']['nama']);
        $data['action']             = $this->modul_inventory.'/'.$this->controller_master.'/save_setting_master';
        $this->load->view('master/form_setting',$data);
    }
    
    function save_setting_master(){
        $id         = $this->input->post('id');
        $content    = $this->input->post('content');

        $error      = 0;
        foreach($id as $i){
            $update = $this->model_basic->update_data($this->inv_setting_master,array('content'=>$content[$i]),'id',$i);
            if(!$update)
                $error++;
        }
        if($error == 0)
            $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
    }
    
    #Product
    function product(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        $master                     = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('target'=>'product')))->row();
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_master);
        $data['controller']         = $this->controller_master;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate($master->kategori);
        $data['datatable']          = $this->modul_inventory.'/'.$this->controller_master.'/data_product';
        $data['method']             = 'product';
        $data['current_id']         = $this->id_inv_master;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_product_type'),lang('lbl_minimum_stock'),array('data'=>lang('lbl_action'),'width'=>'100px'));
        $this->table->set_footing(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_product_type'),lang('lbl_minimum_stock'),array('data'=>lang('lbl_action'),'width'=>'100px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('cms')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/view_list',
                'nama'      => $this->translate('master')
            ),
            3   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/product',
                'nama'      => $this->translate('product')
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_product(){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        $delete     = "true";
        $edit       = "true";
        $detail_url = $this->modul_inventory.'/'.$this->controller_master.'/product_detail?id=';
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";

        $this->datatables->select('id,kode,jenis_barang,min_stok')
        #->unset_column('id')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_inventory,$this->controller_master,'product',$edit,$delete,$detail_url),'id')
        ->from($this->inv_product_type);
        
        echo $this->datatables->generate();
    }
    
    function form_product($method="add",$id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id'))
            $id     = $this->input->get('id');

        $master             = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('target'=>'product')))->row();
        $data['datatable']  = $this->modul_inventory.'/'.$this->controller_master.'/data_product';

        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $this->translate($master->kategori);
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
            $data['get_data']       = $this->modul_inventory.'/'.$this->controller_master.'/get_data_product';
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['method']     = $method;
        $data['id']         = $id;
        $data['action']     = $this->modul_inventory.'/'.$this->controller_master.'/save_product';
        $data['color']      = $this->model_basic->get_dropdown($this->inv_setting_master,$this->inv_master,1);
        $data['size']       = $this->model_basic->get_dropdown($this->inv_setting_master,$this->inv_master,2);
        $this->load->view('master/form_product',$data);
    }
    
    function get_data_product(){
        $id = $this->input->post('id');
        $data = $this->model_basic->get_data($this->inv_product_type,array('where_array'=>array('id'=>$id)))->row();
        $this->returnJson($data);
    }
    
    function save_product(){
        $usr            = $this->data;
        $id             = $this->input->post('id');
        $kode           = $this->input->post('kode');
        $jenis_barang   = $this->input->post('jenis_barang');
        $min_stok       = $this->input->post('min_stok');
        $warna          = $this->input->post('warna');
        $ukuran         = $this->input->post('ukuran');
        
        if($kode && $jenis_barang && $min_stok){
            if(is_array($warna)) $col = implode(',',$warna); else $col = "";
            if(is_array($ukuran)) $siz = implode(',',$ukuran); else $siz = "";
            $data       = array(
                'kode'          => $kode,
                'jenis_barang'  => $jenis_barang,
                'min_stok'      => $min_stok,
                'warna'         => $col,
                'ukuran'        => $siz
            );
            $check = $this->model_basic->get_data($this->inv_product_type,array('where_array'=>array('kode'=>$data['kode'])))->row();
            if($id){
                if($check && $check->id != $id){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                $save = $this->model_basic->update_data($this->inv_product_type,$data,'id',$id);
                if($save){
                    $details    = $this->model_basic->get_data($this->inv_product,array('where_array'=>array('id_jenis_barang'=>$id)))->result();
                    $id_details = array(0);
                    $s          = array(0);
                    foreach($details as $d){
                        $id_details[] = $d->id;
                    }
                    $save       = $id;
                    if(is_array($ukuran)){
                        foreach($ukuran as $u){
                            $size   = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$u)))->row();
                            if(is_array($warna)){
                                foreach($warna as $w){
                                    $color   = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$w)))->row();
                                    $rs = array(
                                        'kode'              => $kode.$size->kode.$color->kode,
                                        'id_jenis_barang'   => $save,
                                        'id_warna'          => $w,
                                        'id_ukuran'         => $u,
                                        'min_stok'          => $min_stok
                                    );
                                    $check = $this->model_basic->get_data($this->inv_product,array('where_array'=>array('id_jenis_barang'=>$save,'id_warna'=>$w,'id_ukuran'=>$u)))->row();
                                    if(isset($check->id)){
                                        $this->model_basic->update_data($this->inv_product,$rs,'id',$check->id);
                                        $s[]    = $check->id;
                                    }else
                                        $s[]    = $this->model_basic->insert_data($this->inv_product,$rs);
                                }
                            }
                        }
                    }
                    $id_remove  = array_diff($id_details,$s);
                    if(count($id_remove) > 0)
                        $this->model_basic->delete_data($this->inv_product,'id',$id_remove);
                }
            }else{
                if($check){
                    $this->returnJson(array('message'=>lang('msg_code_invalid'),'status'=>'error'));
                    die;
                }
                $save = $this->model_basic->insert_data($this->inv_product_type,$data);
                if($save){
                    if(is_array($ukuran)){
                        foreach($ukuran as $u){
                            $size   = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$u)))->row();
                            if(is_array($warna)){
                                foreach($warna as $w){
                                    $color   = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('id'=>$w)))->row();
                                    $rs = array(
                                        'kode'              => $kode.$size->kode.$color->kode,
                                        'id_jenis_barang'   => $save,
                                        'id_warna'          => $w,
                                        'id_ukuran'         => $u,
                                        'min_stok'          => $min_stok
                                    );
                                    $this->model_basic->insert_data($this->inv_product,$rs);
                                }
                            }
                        }
                    }
                }
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }

    function delete_product($id=0){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_inv_master);
        if($akses['delete']==1){
            $get_master = $this->model_basic->get_data($this->inv_product_type,array('where_array'=>array('id'=>$id)));
            if($get_master->num_rows() > 0){
                $master           = $get_master->row();
                $delete_master    = $this->model_basic->delete_data($this->inv_product_type,'id',$master->id);
                $delete_submaster = $this->model_basic->delete_data($this->inv_product,'id_jenis_barang',$master->id);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
    function product_detail($id=0){
        if($this->input->get('id')) $id = $this->input->get('id');
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_master);
        $master                     = $this->model_basic->get_data($this->inv_master,array('where_array'=>array('target'=>'product')))->row();
        $product                    = $this->model_basic->get_data($this->inv_product_type,array('where_array'=>array('id'=>$id)))->row();
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_master);
        $data['akses']['input']     = 0;
        $data['controller']         = $this->controller_master;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_master);
        $data['menu_name']['nama']  = $product->jenis_barang;
        $data['datatable']          = $this->modul_inventory.'/'.$this->controller_master.'/data_product_detail/'.$id;
        $data['method']             = 'product_detail';
        $data['current_id']         = $this->id_inv_master;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_color'),lang('lbl_size'),array('data'=>lang('lbl_barcode'),'width'=>'100px'),array('data'=>lang('lbl_qrcode'),'width'=>'100px'));
        $this->table->set_footing(array('data'=>lang('lbl_number'),'width'=>"10px"),lang('lbl_code'),lang('lbl_color'),lang('lbl_size'),array('data'=>lang('lbl_barcode'),'width'=>'100px'),array('data'=>lang('lbl_qrcode'),'width'=>'100px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('cms')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/view_list',
                'nama'      => $this->translate('master')
            ),
            3   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/product',
                'nama'      => $this->translate('product')
            ),
            4   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_master.'/product_detail?id='.$id,
                'nama'      => $product->jenis_barang
            )
        );
        $data['page_info']          = array(
            'title'                 => lang('lbl_information'),
            'data'                  => array(
                0                   => array(
                    'label'         => lang('lbl_code'),
                    'value'         => $product->kode
                ),
                1                   => array(
                    'label'         => lang('lbl_product_type'),
                    'value'         => $product->jenis_barang
                )
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_product_detail($id=0){
        $this->datatables->select('id,kode,(SELECT kategori FROM '.$this->inv_master.' WHERE id=id_warna),(SELECT kategori FROM '.$this->inv_master.' WHERE id=id_ukuran)')
        #->unset_column('id')
        ->add_column(lang('lbl_barcode'), '<img src="code/barcode/$1" height="100px" />','kode')
        ->add_column(lang('lbl_qrcode'), '<img src="code/qrcode/$1" height="100px" />','kode')
        ->where('id_jenis_barang',$id)
        ->from($this->inv_product);
        
        echo $this->datatables->generate();
    }
}