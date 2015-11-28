<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {
	function __construct(){
		parent::__construct();
        $this->cek_login();
	}
	
    public function index(){
        $data = $this->data;
        $notification = $this->model_basic->get_data($this->tbl_notifikasi,array('where_array'=>array('id_group'=>$data['user_level']),'limit'=>5,'sort_by'=>'id','sort'=>'DESC'))->result();
        if(count($notification) == 0){
            $view   = '<div id="messages"><ul class="msglist"><li><span class="no-notification">'.lang('lbl_no_notification').'</span></li></ul></div>';
        }else{
            $view   = '<div id="messages"><ul class="msglist">';
            foreach($notification as $n){
                $user   = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$n->id_user)))->row();
                $peg    = $this->model_basic->get_data($this->tbl_pegawai,array('where_array'=>array('id'=>$user->id_pegawai)))->row();
                $waktu  = explode(' ',$n->tanggal);
                if($n->aksi==1)
                    $view   .= '<li class="read">';
                else
                    $view   .= '<li>';
                $view   .= '<a href="'.$n->target.'">';
                $view   .= '<span class="thumb"><img src="userdata/user/thumb/'.$peg->thumb.'" alt="" width="50" /></span>';
                $view   .= '<span class="msgdetails">';
                $view   .= '<span class="name">'.$peg->nama.'</span>';
                $view   .= '<span class="msg">'.$n->keterangan.'</span>';
                $view   .= '<span class="time">'.$this->mydate($waktu[0]).' '.$waktu[1].'</span>';
                $view   .= '</span>';
                $view   .= '</a>';
                $view   .= '</li>';
            }
            $view   .= '</ul>';
            $view   .= '<div class="msgbutton"><a href="notification/all_notification">'.lang('lbl_view_all').'</a></div>';
            $view   .= '</div>';
        }
        echo $view;
	}
    
    public function all_notification(){
        $data                       = $this->data;
        
        $data['menu_name']['nama']          = lang('lbl_notification');
        $data['menu_name']['keterangan']    = lang('lbl_all_notification');
        
        $data['datatable']          = "";
        $data['method']             = $this->method_master;
        $data['no_left_menu']       = TRUE;
        $data['this_modul']         = FALSE;
        $data['controller']         = $this->controller_notification;
        $data['notif']              = $this->model_basic->get_data($this->tbl_notifikasi,array('where_array'=>array('id_group'=>$data['user_level']),'limit'=>20,'sort_by'=>'id','sort'=>'DESC'))->result();
        foreach($data['notif'] as $n){
            $user                   = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$n->id_user)))->row();
            $data['peg'][$n->id]    = $this->model_basic->get_data($this->tbl_pegawai,array('where_array'=>array('id'=>$user->id_pegawai)))->row();
            $waktu                  = explode(' ',$n->tanggal);
            $data['waktu'][$n->id]  = $this->mydate($waktu[0]).' '.$waktu[1];
        }
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->controller_notification.'/all_notification',
                'nama'      => $data['menu_name']['nama']
            )
        );
        if(count($data['modul']) > 0 )
            $this->load->view('template/header',$data);
        else
            $this->load->view('template/header_no_module',$data);
        $this->load->view('global/notification');
        $this->load->view('template/footer');
    }
    
    public function add_notification(){
        $data   = $this->data;
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $notification = $this->model_basic->get_data($this->tbl_notifikasi,array('where_array'=>array('id_group'=>$data['user_level']),'limit'=>$limit,'offset'=>$offset,'sort_by'=>'id','sort'=>'DESC'))->result();
        if(count($notification) == 0){
            $notif['offset']     = $offset;
        }else{
            $view   = '';
            $i      = 0;
            foreach($notification as $n){
                $user   = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('id'=>$n->id_user)))->row();
                $peg    = $this->model_basic->get_data($this->tbl_pegawai,array('where_array'=>array('id'=>$user->id_pegawai)))->row();
                $waktu  = explode(' ',$n->tanggal);
                if($n->aksi==1)
                    $view   .= '<li class="read">';
                else
                    $view   .= '<li>';
                $view   .= '<a href="'.$n->target.'">';
                $view   .= '<span class="thumb"><img src="userdata/user/thumb/'.$peg->thumb.'" alt="" width="50" /></span>';
                $view   .= '<span class="msgdetails">';
                $view   .= '<span class="name">'.$peg->nama.'</span>';
                $view   .= '<span class="msg">'.$n->keterangan.'</span>';
                $view   .= '<span class="time">'.$this->mydate($waktu[0]).' '.$waktu[1].'</span>';
                $view   .= '</span>';
                $view   .= '</a>';
                $view   .= '</li>';
                $i++;
            }
            $notif['offset']     = $offset + $i;
            $notif['data']       = $view;
        }
        $this->returnJson($notif);
    }
}