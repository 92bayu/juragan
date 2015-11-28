<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
	function __construct(){
		parent::__construct();
        $data = $this->data;
        $this->cek_login();
        $this->cek_akses($data['user_level'],$this->id_inv_report);
        $this->controller_name  = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_report);
	}
	
    function index(){
        $data = $this->data;
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_inv_report_stock)==1){
    		redirect($this->modul_inventory.'/'.$this->controller_report.'/stock_in');
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_inv_report_stock_in)==1){
    		redirect($this->modul_inventory.'/'.$this->controller_report.'/stock_in');
            die;
        }
        if($this->model_main->get_cek_akses($this->tbl_user_akses,$data['user_level'],$this->id_inv_report_stock_out)==1){
    		redirect($this->modul_inventory.'/'.$this->controller_report.'/stock_out');
            die;
        }
        redirect($this->modul_inventory);
    }
    
	function stock(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_report_stock);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_report_stock);
        $data['controller']         = $this->controller_report;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_report_stock);
        $data['menu_name']['nama']  = $this->translate('Stok');
        $data['datatable']          = "";
        $data['method']             = "stock";
        $data['current_id']         = $this->id_inv_report;
        $data['this_menu']          = $this->id_inv_report_stock;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('Inventory')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_report.'/stock',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/coming_soon');
        $this->load->view('template/footer');
    }

	function stock_in(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_report_stock_in);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_report_stock_in);
        $data['controller']         = $this->controller_report;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_report_stock_in);
        $data['menu_name']['nama']  = $this->translate('Stok In');
        $data['datatable']          = "";
        $data['method']             = "stock_in";
        $data['current_id']         = $this->id_inv_report;
        $data['this_menu']          = $this->id_inv_report_stock_in;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('Inventory')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_report.'/stock_in',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/coming_soon');
        $this->load->view('template/footer');
    }

	function stock_out(){
        $data                       = $this->data;
        
        $this->cek_akses($data['user_level'],$this->id_inv_report_stock_out);
        
        $data['this_modul']         = $this->modul_inventory;
        $data['menu']               = $this->get_menu($data['user_level'],$this->id_modul_inventory);
        $data['akses']              = $this->get_akses($data['user_level'],$this->id_inv_report_stock_out);
        $data['controller']         = $this->controller_report;
        $data['controller_name']    = $this->controller_name;
        $data['menu_name']          = $this->model_main->get_menu_name($this->tbl_menu,$this->id_inv_report_stock_out);
        $data['menu_name']['nama']  = $this->translate('Stok Out');
        $data['datatable']          = "";
        $data['method']             = "stock_out";
        $data['current_id']         = $this->id_inv_report;
        $data['this_menu']          = $this->id_inv_report_stock_out;
                
        $data['breadcrumbs']        = array(
            1   => array(
                'target'    => $this->modul_inventory,
                'nama'      => $this->translate('Inventory')
            ),
            2   => array(
                'target'    => $this->modul_inventory.'/'.$this->controller_report.'/stock_out',
                'nama'      => $data['menu_name']['nama']
            )
        );
        $this->load->view('template/header',$data);
        $this->load->view('template/menu');
        $this->load->view('template/coming_soon');
        $this->load->view('template/footer');
    }
    
}