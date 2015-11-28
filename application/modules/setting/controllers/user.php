<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->cek_akses($data['user_level'],$this->id_user);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user);
	}
	
	public function index(){
        $data = $this->data;
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_user_list)==1){
    		redirect($this->modul_setting.'/'.$this->controller_user.'/'.$this->method_user_list);
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_user_group)==1){
    		redirect($this->controller_user.'/'.$this->method_user_group);
            die;
        }
        redirect($this->controller_site);
	}
    
    // USER LIST
    function user_list(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_user_list);
        
        $data['this_modul']         = $this->modul_setting;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_user_list);
        $data['controller']         = $this->controller_user;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user_list);
        $data['menu_name']['nama']  = $this->translate('user_list');
        $data['datatable']          = $this->modul_setting . '/' . $this->controller_user . '/data_' . $this->method_user_list;
        $data['method']             = $this->method_user_list;
        $data['current_id']         = $this->id_user;
        $data['this_menu']          = $this->id_user_list;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width' => '10px'),lang('lbl_name'),lang('lbl_username'),lang('lbl_group'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'70px'));
        $this->table->set_footing(array('data'=>lang('lbl_number'),'width' => '10px'),lang('lbl_name'),lang('lbl_username'),lang('lbl_group'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'70px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->modul_setting . '/' . $this->controller_user . '/' . $this->method_user_list,
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_user_list(){
        $data   = $this->data;
        $akses  = $this->get_akses($data['user_level'],$this->id_user_list);
        $delete = "true";
        $edit   = "true";
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";

        $this->datatables->select('id,nama,username,(SELECT nama FROM '.$this->tbl_user_group.' WHERE id=id_group),(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_setting,$this->controller_user,$this->method_user_list,$edit,$delete),'id')
        ->from($this->tbl_user);
        
        echo $this->datatables->generate();
    }
    
    function form_user_list($method="add",$id=""){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_user_list);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id'))
            $id     = $this->input->get('id');
        
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user_list);
        $data['menu_name']['nama']  = $this->translate('user_list');
        if($method == "add"){
            if($akses['input']==0){
                redirect('errors/forbidden');
                exit();
            }
            $data['title']              = lang('lbl_insert') . ' ' . $data['menu_name']['nama'];
        }else{
            if($akses['edit']==0){
                redirect('errors/forbidden');
                exit();
            }
            $data['get_data']           = $this->modul_setting . '/' . $this->controller_user . '/get_data_' . $this->method_user_list;
            $data['title']              = lang('lbl_update') . ' ' . $data['menu_name']['nama'];
        }
        $data['language']               = $this->get_language();
        $data['datatable']              = $this->modul_setting . '/' . $this->controller_user . '/data_' . $this->method_user_list;
        $data['user_group']             = $this->model_basic->get_data($this->tbl_user_group,array('where_array'=>array('status'=>1)))->result();
        $user                           = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$id)))->row();
        $data['method']                 = $method;
        $data['controller']             = $this->controller_user;
        $data['id']                     = $id;
        $data['action']                 = $this->modul_setting . '/' . $this->controller_user . '/save_' . $this->method_user_list;
        $this->load->view('user/form_user_list',$data);
    }

    function get_data_user_list(){
        $id = $this->input->post('id');
        $data = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$id)))->row();
        $this->returnJson($data);
    }
    
    function save_user_list(){
        $usr            = $this->data;
        $id             = $this->input->post('id');
        
        $data           = _input($this->input->post());
        
        if($data['username'] && $data['nama']){
            $check = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('username'=>$data['username'])))->row();
            if($id){
                if($check && $check->id != $id){
                    $this->returnJson(array('message'=>lang('msg_username_invalid'),'status'=>'error'));
                    die;
                }
                $data['update_by']      = $usr['user_id'];
                $data['update_date']    = date('Y-m-d');
                $save = $this->model_basic->update_data($this->tbl_user,$data,'id',$id);
                if($save) $save = $id;
            }else{
                if($check){
                    $this->returnJson(array('message'=>lang('msg_username_invalid'),'status'=>'error'));
                    die;
                }
                $data['create_by']      = $usr['user_id'];
                $data['create_date']    = date('Y-m-d');
                $save = $this->model_basic->update_data($this->tbl_user,$data);                
            }
            if($save)
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok','href'=>$this->modul_setting.'/'.$this->controller_user.'/photo/'.$save));
            else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }
    
    function photo($id=0,$page=""){
        $data               = $this->data;
        $akses              = $this->get_akses($data['user_level'],$this->id_user_list);
        $data['menu_name']  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user_list);
        $data['title']      = lang('lbl_photo_profile');
        if($page=="")
            $data['datatable']  = $this->modul_setting.'/'.$this->controller_user.'/data_user_list';
        else
            $data['datatable']  = "";
        $data['action']     = $this->modul_setting.'/'.$this->controller_user.'/save_photo';
        $data['get_data']   = $this->modul_setting.'/'.$this->controller_user.'/get_data_user_list';
        $data['id']         = $id;
        
        if($akses['input']==0 || $akses['edit']==0){
            redirect('errors/forbidden');
            exit();
        }
        
        $this->load->view('user/foto_profile',$data);
    }
    
    function save_photo(){
        $id         = $this->input->post('id');
        $icon       = $this->input->post('icon');
        $icon_old   = $this->input->post('old_icon');
        $thumb_old  = $this->input->post('old_thumb');
  		$origw = $this->input->post('origwidth');
		$origh = $this->input->post('origheight');
		$fakew = $this->input->post('fakewidth');
		$fakeh = $this->input->post('fakeheight');
        if($fakew==0) $n = 0;
        else $n = $origw / $fakew;
		$x = $this->input->post('x') * $n;
		$y = $this->input->post('y') * $n;
		$w = $this->input->post('w') * $n;
		$h = $this->input->post('h') * $n;
        if($w==0) $w = 95;
        if($h==0) $h = 95;
		$targ_w = 95;
		$targ_h = 95;
		$jpeg_quality = 90;
        
        if($icon){
            $ico = basename($icon);
            if(!is_dir(FCPATH . "userdata/user/photo/"))
                mkdir(FCPATH . "userdata/user/photo/");
            $dest = "userdata/user/photo/".$ico;
            if(!@copy($icon,$dest))
                $ico = $icon_old;
            else{
                $this->deleteDir(FCPATH . "userdata/temp/".$this->session->userdata('temp_folder'));
                if( $icon_old != 'default.png' )
                    @unlink('userdata/user/photo/'.$icon_old);
            }
        }else 
            $ico    = $icon_old;
        
        if($n){
            $src = FCPATH."userdata/user/photo/".$ico;
                
            if(!is_dir(FCPATH.'userdata/user/thumb/'))
                mkdir(FCPATH.'userdata/user/thumb/');

            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'jepg' || $ext == 'JPG' || $ext == 'JPEG')
                $img_r = imagecreatefromjpeg($src);
            if($ext == 'png' || $ext == 'PNG')
                $img_r = imagecreatefrompng($src);
            if($ext == 'gif' || $ext == 'GIF')
                $img_r = imagecreatefromgif($src);
            
            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

            $path_img_crop = realpath(FCPATH . 'userdata/user/thumb/');
            $img_name_crop = uniqid(). '-thumb.jpg';
            imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
            imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
            if($thumb_old != 'default.png')
                @unlink('userdata/user/thumb/'.$thumb_old);
        }else
            $img_name_crop = $thumb_old;
            
        $update_photo = array(
            'foto'  => $ico,
            'thumb' => $img_name_crop
        );
        
        $save   = $this->model_basic->update_data($this->tbl_user,$update_photo,'id',$id);
        if($save)
            $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
        else
            $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        
    }

    function delete_user_list($id=""){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_user_list);
        if($akses['delete']==1){
            $get_user = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$id)));
            if($get_user->num_rows() > 0){
                $user            = $get_user->row();
                $delete_user     = $this->model_basic->delete_data($this->tbl_user,'username',$user->username);
                if($user->foto!="default.png")
                    @unlink('userdata/user/photo/'.$user->photo);
                if($user->thumb!="default.png")
                    @unlink('userdata/user/thumb/'.$user->thumb);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
    // USER GROUP
    function user_groups(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_user_group);
        
        $data['this_modul']         = $this->modul_setting;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_setting);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_user_group);
        $data['controller']         = $this->controller_user;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user_group);
        $data['menu_name']['nama']  = $this->translate('user_groups');
        $data['datatable']          = $this->modul_setting . '/' . $this->controller_user.'/data_'.$this->method_user_group;
        $data['method']             = $this->method_user_group;
        $data['current_id']         = $this->id_user;
        $data['this_menu']          = $this->id_user_group;
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablequick" id="dyntable2">' );
        $this->table->set_template($tmpl);
        $this->table->set_heading(array('data'=>lang('lbl_number'),'width' => '10px'),lang('lbl_name'),lang('lbl_description'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'70px'));
        $this->table->set_footing(array('data'=>lang('lbl_number'),'width' => '10px'),lang('lbl_name'),lang('lbl_description'),array('data'=>lang('lbl_status'),'width'=>'70px'),array('data'=>lang('lbl_action'),'width'=>'70px'));

        $data['table']              = $this->table->generate();
        
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_setting,
                'nama'      => $this->translate('setting')
            ),
            2   => array(
                'target'    => $this->modul_setting . '/' . $this->controller_user . '/' . $this->method_user_group,
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/content');
        $this->load->view('template/footer');
    }
    
    function data_user_group(){
        $data   = $this->data;
        $akses  = $this->get_akses($data['user_level'],$this->id_user_group);
        $delete = "true";
        $edit   = "true";
        if($akses['edit']==0) $edit = "false";
        if($akses['delete']==0) $delete = "false";

        $this->datatables->select('id,nama,keterangan,(CASE WHEN (status = 1) THEN "<img src=\"assets/images/active.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" ELSE "<img src=\"assets/images/inactive.png\" style=\"display: block;margin-left:auto;margin-right:auto;\" />" END) AS status')
        #->unset_column('id')
        ->add_column(lang('lbl_action'), get_buttons('$1',$this->modul_setting,$this->controller_user,$this->method_user_group,$edit,$delete),'id')
        ->from($this->tbl_user_group);
        
        echo $this->datatables->generate();
    }

    function form_user_group($method="add",$id=""){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_user_group);
        if($this->input->get('method'))
            $method = $this->input->get('method');
        if($this->input->get('id'))
            $id     = $this->input->get('id');

        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_user_group);
        $data['menu_name']['nama']  = $this->translate('user_groups');
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
            $data['get_data']       = $this->modul_setting . '/' . $this->controller_user . '/get_data_' . $this->method_user_group;
            $data['title']          = lang('lbl_update').' '.$data['menu_name']['nama'];
        }
        $data['datatable']              = $this->modul_setting . '/' . $this->controller_user . '/data_' . $this->method_user_group;
        $data['method']                 = $method;
        $data['controller']             = $this->controller_user;
        $data['id']                     = $id;
        $data['action']                 = $this->modul_setting . '/' . $this->controller_user . '/save_' . $this->method_user_group;
        $data['modul']                  = $this->model_basic->get_data($this->tbl_modul,array('where_array'=>array('status'=>1),'sort_by'=>'urutan'))->result();
        foreach($data['modul'] as $md){
            $data['menu'][$md->id]  = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('id_modul'=>$md->id,'parent_id'=>0,'status'=>1)))->result();
            foreach($data['menu'][$md->id] as $mn){
                $data['submenu'][$mn->id]   = $this->model_basic->get_data($this->tbl_menu,array('where_array'=>array('parent_id'=>$mn->id,'status'=>1)))->result();
            }
        }
        $this->load->view('user/form_user_group',$data);
    }

    function get_data_user_group(){
        $id             = $this->input->post('id');
        $data           = $this->model_basic->get_data($this->tbl_user_group,array('where_array'=>array('id'=>$id)))->row();
        $data->akses    = $this->model_basic->get_data($this->tbl_user_akses,array('where_array'=>array('id_level'=>$id)))->result();
        $this->returnJson($data);
    }
    
    function save_user_group(){
        $id             = $this->input->post('id');
        $nama           = $this->input->post('nama');
        $keterangan     = $this->input->post('keterangan');
        $id_menu        = $this->input->post('id_menu');
        $id_user_akses  = $this->input->post('id_user_akses');
        $status         = $this->input->post('status');
        $view           = $this->input->post('view');
        $input          = $this->input->post('input');
        $edit           = $this->input->post('edit');
        $delete         = $this->input->post('delete');
        
        $data = array(
            'nama'          => $nama,
            'status'        => $status,
            'keterangan'    => $keterangan
        );
        if($nama){
            if($id)
                $this->model_basic->update_data($this->tbl_user_group,$data,'id',$id);
            else
                $id = $this->model_basic->insert_data($this->tbl_user_group,$data);

            if($id){
                foreach($id_menu as $im){
                    $act_view   = 0;
                    $act_input  = 0;
                    $act_edit   = 0;
                    $act_delete = 0;
                    if(isset($view[$im])) $act_view = $view[$im];
                    if(isset($input[$im])) $act_input = $input[$im];
                    if(isset($edit[$im])) $act_edit = $edit[$im];
                    if(isset($delete[$im])) $act_delete = $delete[$im];
                    $data2 = array(
                        'id_level'  => $id,
                        'id_menu'   => $im,
                        'act_view'  => $act_view,
                        'act_input' => $act_input,
                        'act_edit'  => $act_edit,
                        'act_delete'=> $act_delete
                    );
                    if(isset($id_user_akses[$im]) && $id_user_akses[$im] > 0)
                        $this->model_basic->update_data($this->tbl_user_akses,$data2,'id',$id_user_akses[$im]);
                    else
                        $this->model_basic->insert_data($this->tbl_user_akses,$data2);
                }
                $this->returnJson(array('message'=>lang('msg_data_has_been_saved'),'status'=>'ok'));
            }else
                $this->returnJson(array('message'=>lang('msg_data_not_saved'),'status'=>'error'));
        }else
            $this->returnJson(array('message'=>lang('msg_insert_not_completed'),'status'=>'error'));
    }
    
    function delete_user_group($id=""){
        $data       = $this->data;
        $akses      = $this->get_akses($data['user_level'],$this->id_user_group);
        if($akses['delete']==1){
            $get_user_group = $this->model_basic->get_data($this->tbl_user_group,array('where_array'=>array('id'=>$id)));
            if($get_user_group->num_rows() > 0){
                $user_group         = $get_user_group->row();
                $delete_user_group  = $this->model_basic->delete_data($this->tbl_user_group,'id',$user_group->id);
                $delete_user_akses  = $this->model_basic->delete_data($this->tbl_user_akses,'id_level',$user_group->id);
                echo lang('msg_delete_success');
            }else{
                echo lang('msg_delete_failed');
            }
        }else{
            echo lang('msg_you_cannot_access_to_delete_this_data');
        }
	}
    
}