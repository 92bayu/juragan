<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->cek_akses($data['user_level'],$this->id_pos_dashboard);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_pos_dashboard);
	}
	
	public function index(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_pos_dashboard);
        
        $data['this_modul']         = $this->modul_pos;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_pos);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_pos_dashboard);
        $data['controller']         = $this->controller_dashboard;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_pos_dashboard);
        $data['menu_name']['nama']  = $this->translate('dashboard');
        $data['datatable']          = "";
        $data['method']             = "dashboard";
        $data['current_id']         = $this->id_pos_dashboard;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_pos,
                'nama'      => $this->translate('Inventory')
            ),
            2   => array(
                'target'    => $this->modul_pos.'/'.$this->controller_dashboard.'/view_icon',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('dashboard/view');
        $this->load->view('template/footer');
    }
    
}