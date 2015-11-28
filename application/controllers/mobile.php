<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
    function load_data(){
        $zona                                   = $this->model_basic->get_data($this->tbl_master_zona,array('sort_by'=>'zona','where_array'=>array('status'=>1)))->result();
        $product1                               = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>1,'status'=>1)))->result();
        $product_baby_care1                     = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>1,'kategori'=>'Baby Care','status'=>1)))->result();
        $product_feminim_care1                  = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>1,'kategori'=>'Feminim Care','status'=>1)))->result();
        $product_health_care1                   = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>1,'kategori'=>'Health Care','status'=>1)))->result();
        $product_baby_wipes1                    = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>1,'kategori'=>'Baby Wipes','status'=>1)))->result();
        $product2                               = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>2,'status'=>1)))->result();
        $product_baby_care2                     = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>2,'kategori'=>'Baby Care','status'=>1)))->result();
        $product_feminim_care2                  = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>2,'kategori'=>'Feminim Care','status'=>1)))->result();
        $product_health_care2                   = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>2,'kategori'=>'Health Care','status'=>1)))->result();
        $product_baby_wipes2                    = $this->model_basic->get_data($this->tbl_master_product,array('sort_by'=>'nama','where_array'=>array('k'=>2,'kategori'=>'Baby Wipes','status'=>1)))->result();
        $competitor_baby_care                   = $this->model_basic->get_data($this->tbl_master_competitor,array('sort_by'=>'nama','where_array'=>array('kategori'=>'Baby Care','status'=>1)))->result();
        $competitor_feminim_care                = $this->model_basic->get_data($this->tbl_master_competitor,array('sort_by'=>'nama','where_array'=>array('kategori'=>'Feminim Care','status'=>1)))->result();
        $competitor_health_care                 = $this->model_basic->get_data($this->tbl_master_competitor,array('sort_by'=>'nama','where_array'=>array('kategori'=>'Health Care','status'=>1)))->result();
        $competitor_baby_wipes                  = $this->model_basic->get_data($this->tbl_master_competitor,array('sort_by'=>'nama','where_array'=>array('kategori'=>'Baby Wipes','status'=>1)))->result();
        $facing_share_1                         = $this->model_basic->get_data($this->tbl_master_facing_share,array('sort_by'=>'id','where_array'=>array('kategori'=>1,'status'=>1)))->result();
        $facing_share_2                         = $this->model_basic->get_data($this->tbl_master_facing_share,array('sort_by'=>'id','where_array'=>array('kategori'=>2,'status'=>1)))->result();
        $facing_share_3                         = $this->model_basic->get_data($this->tbl_master_facing_share,array('sort_by'=>'id','where_array'=>array('kategori'=>3,'status'=>1)))->result();
        $facing_share_4                         = $this->model_basic->get_data($this->tbl_master_facing_share,array('sort_by'=>'id','where_array'=>array('kategori'=>4,'status'=>1)))->result();
        $jenis_promo                            = $this->model_basic->get_dropdown($this->tbl_setting_master,$this->tbl_master,1);
        $range                                  = $this->model_basic->get_dropdown($this->tbl_setting_master,$this->tbl_master,2);
        $call                                   = $this->model_basic->get_dropdown($this->tbl_setting_master,$this->tbl_master,3);
        $komentar_tamu                          = $this->model_basic->get_dropdown($this->tbl_setting_master,$this->tbl_master,4);
        $data['opt_zona']                       = '<option value="">Zona :</option>';
        $data['opt_product1']                   = '<option value="">Produk :</option>';
        $data['opt_product_baby_care1']         = '<option value="">Produk Baby Care :</option>';
        $data['opt_product_feminim_care1']      = '<option value="">Produk Feminim Care :</option>';
        $data['opt_product_health_care1']       = '<option value="">Produk Health Care :</option>';
        $data['opt_product_baby_wipes1']        = '<option value="">Produk Baby Wipes :</option>';
        $data['opt_product2']                   = '<option value="">Produk :</option>';
        $data['opt_product_baby_care2']         = '<option value="">Produk Baby Care :</option>';
        $data['opt_product_feminim_care2']      = '<option value="">Produk Feminim Care :</option>';
        $data['opt_product_health_care2']       = '<option value="">Produk Health Care :</option>';
        $data['opt_product_baby_wipes2']        = '<option value="">Produk Baby Wipes :</option>';
        $data['opt_competitor_baby_care']       = '<option value="">Produk Baby Care :</option>';
        $data['opt_competitor_feminim_care']    = '<option value="">Produk Feminim Care :</option>';
        $data['opt_competitor_health_care']     = '<option value="">Produk Health Care :</option>';
        $data['opt_competitor_baby_wipes']      = '<option value="">Produk Baby Wipes :</option>';
        $data['opt_jenis_promo']                = '<option value="">Jenis Promo :</option>';
        $data['opt_range']                      = '<option value="">Range :</option>';
        $data['opt_call']                       = '<option value="">Call :</option>';
        $data['opt_komentar_tamu']              = '<option value="">Komentar Tamu :</option>';
        $data['opt_facing_share_1']             = '<option value="">Baby Care :</option>';
        $data['opt_facing_share_2']             = '<option value="">Feminim Care :</option>';
        $data['opt_facing_share_3']             = '<option value="">Health Care :</option>';
        $data['opt_facing_share_4']             = '<option value="">Baby Wipes :</option>';
        foreach($zona as $z){
            $data['opt_zona']                   .= '<option value="'.$z->id.'">'.$z->zona.'</option>';
        }
        foreach($product1 as $p){
            $data['opt_product1']               .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_baby_care1 as $p){
            $data['opt_product_baby_care1']     .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_feminim_care1 as $p){
            $data['opt_product_feminim_care1']  .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_health_care1 as $p){
            $data['opt_product_health_care1']   .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_baby_wipes1 as $p){
            $data['opt_product_baby_wipes1']    .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product2 as $p){
            $data['opt_product2']               .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_baby_care2 as $p){
            $data['opt_product_baby_care2']     .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_feminim_care2 as $p){
            $data['opt_product_feminim_care2']  .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_health_care2 as $p){
            $data['opt_product_health_care2']   .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($product_baby_wipes2 as $p){
            $data['opt_product_baby_wipes2']    .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($competitor_baby_care as $p){
            $data['opt_competitor_baby_care']   .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($competitor_feminim_care as $p){
            $data['opt_competitor_feminim_care'].= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($competitor_health_care as $p){
            $data['opt_competitor_health_care'] .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($competitor_baby_wipes as $p){
            $data['opt_competitor_baby_wipes']  .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($jenis_promo as $p){
            $data['opt_jenis_promo']            .= '<option value="'.$p->kategori.'">'.$p->kategori.'</option>';
        }
        foreach($call as $p){
            $data['opt_call']                   .= '<option value="'.$p->kategori.'">'.$p->kategori.'</option>';
        }
        foreach($range as $p){
            $data['opt_range']                  .= '<option value="'.$p->kategori.'">'.$p->kategori.'</option>';
        }
        foreach($komentar_tamu as $p){
            $data['opt_komentar_tamu']          .= '<option value="'.$p->kategori.'">'.$p->kategori.'</option>';
        }
        foreach($facing_share_1 as $p){
            $data['opt_facing_share_1']         .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($facing_share_2 as $p){
            $data['opt_facing_share_2']         .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($facing_share_3 as $p){
            $data['opt_facing_share_3']         .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        foreach($facing_share_4 as $p){
            $data['opt_facing_share_4']         .= '<option value="'.$p->nama.'">'.$p->nama.'</option>';
        }
        $this->returnJson($data);
    }
    
    function get_area($id_zona=0){
        $area           = $this->model_basic->get_data($this->tbl_master_area,array('sort_by'=>'area','where_array'=>array('status'=>1,'id_zona'=>$id_zona)))->result();
        echo '<option value="">Area - Leader :</option>';
        foreach($area as $a){
            echo '<option value="'.$a->id.'">'.$a->area.' - '.$a->team_leader.'</option>';
        }
    }
    
    function get_profile($id=0){
        $data   = $this->model_basic->get_data($this->tbl_employee,array('where_array'=>array('id'=>$id)))->row();
        $sales  = $this->model_basic->get_data($this->tbl_employee,array('sort_by'=>'nama','where_array'=>array('id_zona'=>$data->id_zona,'id_area'=>$data->id_area,'jabatan'=>'Sales Promotion')))->result();
        $md     = $this->model_basic->get_data($this->tbl_employee,array('sort_by'=>'nama','where_array'=>array('id_zona'=>$data->id_zona,'id_area'=>$data->id_area,'jabatan'=>'MD')))->result();
        $opt    = '<option value="">Sales/MD *</option>';
        //$opt    .= '<optgroup label="Sales Promotion" />';
        foreach($sales as $s){
            $opt    .= '<option value="'.$s->nama.'">'.$s->nama.'</option>';
        }
        //$opt    .= '<optgroup label="MD" />';
        foreach($md as $s){
            $opt    .= '<option value="'.$s->nama.'">'.$s->nama.'</option>';
        }
        $data->opt_employee = $opt;
        $this->returnJson($data);
    }

    function check_login(){
        $arr    = array(
            'where_array'   => array(
                'id_zona'   => $this->input->post('id_zona'),
                'id_area'   => $this->input->post('id_area'),
                'username'  => $this->input->post('username'),
                'password'  => md5($this->input->post('password')),
                'status'    => 1
            )
        );
        $check  = $this->model_basic->get_data($this->tbl_employee,$arr)->row();
        if(isset($check->id)){
            $data['status'] = 'ok';
            $data['id']     = $check->id;
        }else{
            $data['status'] = 'error';
        }
        $this->returnJson($data);
    }
    
    function check_old_password($id=0){
        $arr    = array(
            'where_array'   => array(
                'id'        => $id,
                'password'  => md5($this->input->post('password'))
            )
        );
        $check  = $this->model_basic->get_data($this->tbl_employee,$arr)->num_rows();
        if($check == 1) echo 'ok';
        else echo 'error';
    }
    
    function change_password($id=0){
        $data['password']   = md5($this->input->post('password'));
        $save               = $this->model_basic->update_data($this->tbl_employee,$data,'id',$id);
        if($save) echo 'ok';
        else echo 'error';
    }
    
    function save_team_leader($id_employee=0){
        $employee           = $this->model_basic->get_data($this->tbl_employee,array('where_array'=>array('id'=>$id_employee)))->row();
        $data               = _input($this->input->post());
        $data['id_user']    = $employee->id;
        $data['id_zona']    = $employee->id_zona;
        $data['id_area']    = $employee->id_area;
        $data['tanggal']    = date('d F Y');
        $data['jam']        = date('H:i:s');
        $data['jabatan']    = $employee->jabatan;
        $data['create_date']= date('Y-m-d H:i:s');
        
        $save               = $this->model_basic->insert_data($this->tbl_team_leader,$data);
        if($save){
            $rs['status']   = 'ok';
            $rs['id']       = $save;
        }else{
            $rs['status']   = 'error';
        }
        $this->returnJson($rs);
    }
    
    function save_merchandiser($id_employee=0){
        $employee                       = $this->model_basic->get_data($this->tbl_employee,array('where_array'=>array('id'=>$id_employee)))->row();
        $data['id_user']                = $employee->id;
        $data['id_zona']                = $employee->id_zona;
        $data['id_area']                = $employee->id_area;
        $data['tanggal']                = date('d F Y');
        $data['jam']                    = date('H:i:s');
        $data['jabatan']                = $employee->jabatan;
        $data['create_date']            = date('Y-m-d H:i:s');
        $data['lokasi']                 = $this->input->post('lokasi');
        $data['call']                   = $this->input->post('call');
        $data['nama_toko']              = $this->input->post('nama_toko');
        $data['kode_toko']              = $this->input->post('kode_toko');
        $data['alamat_toko']            = $this->input->post('alamat_toko');
        $data['kesimpulan']             = $this->input->post('kesimpulan');
        $data['baby_care']              = $this->input->post('baby_care');
        $data['feminim_care']           = $this->input->post('feminim_care');
        $data['health_care']            = $this->input->post('health_care');
        $data['baby_wipes']             = $this->input->post('baby_wipes');
        $data['selling_in']             = $this->input->post('selling_in');
        $data['selling_out']            = $this->input->post('selling_out');
        
        $osa_produk                     = $this->input->post('osa_produk');
        $osa_range                      = $this->input->post('osa_range');
        
        $oos_produk                     = $this->input->post('oos_produk');
        $oos_periode                    = $this->input->post('oos_periode');
        $oos_keterangan                 = $this->input->post('oos_keterangan');
        
        $promo_own_jenis                = $this->input->post('promo_own_jenis');
        $promo_own_baby_care            = $this->input->post('promo_own_baby_care');
        $promo_own_feminim_care         = $this->input->post('promo_own_feminim_care');
        $promo_own_health_care          = $this->input->post('promo_own_health_care');
        $promo_own_baby_wipes           = $this->input->post('promo_own_baby_wipes');
        $promo_own_periode              = $this->input->post('promo_own_periode');
        $promo_own_harga_normal         = $this->input->post('promo_own_harga_normal');
        $promo_own_harga_promo          = $this->input->post('promo_own_harga_promo');
        $promo_own_keterangan           = $this->input->post('promo_own_keterangan');
        
        $promo_competitor_jenis         = $this->input->post('promo_competitor_jenis');
        $promo_competitor_baby_care     = $this->input->post('promo_competitor_baby_care');
        $promo_competitor_feminim_care  = $this->input->post('promo_competitor_feminim_care');
        $promo_competitor_health_care   = $this->input->post('promo_competitor_health_care');
        $promo_competitor_baby_wipes    = $this->input->post('promo_competitor_baby_wipes');
        $promo_competitor_periode       = $this->input->post('promo_competitor_periode');
        $promo_competitor_harga_normal  = $this->input->post('promo_competitor_harga_normal');
        $promo_competitor_harga_promo   = $this->input->post('promo_competitor_harga_promo');
        $promo_competitor_keterangan    = $this->input->post('promo_competitor_keterangan');
        
        $osa    = array();
        for($i=0; $i<count($osa_produk); $i++){
            if($osa_produk[$i] && $osa_range[$i]){
                $osa[]  = $osa_produk[$i].'=='.$osa_range[$i];
            }
        }
        $data['osa']                    = implode('||',$osa);

        $oos    = array();
        for($i=0; $i<count($oos_produk); $i++){
            if($oos_produk[$i] && $oos_periode[$i]){
                $oos[]  = $oos_produk[$i].'=='.$oos_periode[$i].'=='.$oos_keterangan[$i];
            }
        }
        $data['oos']                    = implode('||',$oos);
        
        $promo_own  = array();
        for($i=0; $i<count($promo_own_jenis); $i++){
            if($promo_own_baby_care[$i] || $promo_own_feminim_care[$i] || $promo_own_health_care[$i] || $promo_own_baby_wipes[$i]){
                $promo_own[]    = $promo_own_jenis[$i].'=='.$promo_own_baby_care[$i].'=='.$promo_own_feminim_care[$i].'=='.$promo_own_health_care[$i].'=='.$promo_own_baby_wipes[$i].'=='.$promo_own_periode[$i].'=='.$promo_own_harga_normal[$i].'=='.$promo_own_harga_promo[$i].'=='.$promo_own_keterangan[$i];
            }
        }
        $data['promo_own']              = implode('||',$promo_own);
        
        $promo_competitor  = array();
        for($i=0; $i<count($promo_competitor_jenis); $i++){
            if($promo_competitor_baby_care[$i] || $promo_competitor_feminim_care[$i] || $promo_competitor_health_care[$i] || $promo_competitor_baby_wipes[$i]){
                $promo_competitor[] = $promo_competitor_jenis[$i].'=='.$promo_competitor_baby_care[$i].'=='.$promo_competitor_feminim_care[$i].'=='.$promo_competitor_health_care[$i].'=='.$promo_competitor_baby_wipes[$i].'=='.$promo_competitor_periode[$i].'=='.$promo_competitor_harga_normal[$i].'=='.$promo_competitor_harga_promo[$i].'=='.$promo_competitor_keterangan[$i];
            }
        }
        $data['promo_competitor']       = implode('||',$promo_competitor);
        
        $save               = $this->model_basic->insert_data($this->tbl_merchandise,$data);
        if($save){
            $rs['status']   = 'ok';
            $rs['id']       = $save;
        }else{
            $rs['status']   = 'error';
        }
        $this->returnJson($rs);
    }
    
    function save_sales($id_employee=0){
        $employee                       = $this->model_basic->get_data($this->tbl_employee,array('where_array'=>array('id'=>$id_employee)))->row();
        $data['id_user']                = $employee->id;
        $data['id_zona']                = $employee->id_zona;
        $data['id_area']                = $employee->id_area;
        $data['tanggal']                = date('d F Y');
        $data['jam']                    = date('H:i:s');
        $data['jabatan']                = $employee->jabatan;
        $data['create_date']            = date('Y-m-d H:i:s');
        $data['lokasi']                 = $this->input->post('lokasi');
        $data['nama_toko']              = $this->input->post('nama_toko');
        $data['kode_toko']              = $this->input->post('kode_toko');
        $data['alamat_toko']            = $this->input->post('alamat_toko');
        $data['kesimpulan']             = $this->input->post('kesimpulan');
        $data['baby_care']              = $this->input->post('baby_care');
        $data['feminim_care']           = $this->input->post('feminim_care');
        $data['health_care']            = $this->input->post('health_care');
        $data['baby_wipes']             = $this->input->post('baby_wipes');
        $data['selling_in']             = $this->input->post('selling_in');
        $data['selling_out']            = $this->input->post('selling_out');
        
        $osa_produk                     = $this->input->post('osa_produk');
        $osa_range                      = $this->input->post('osa_range');
        
        $oos_produk                     = $this->input->post('oos_produk');
        $oos_periode                    = $this->input->post('oos_periode');
        $oos_keterangan                 = $this->input->post('oos_keterangan');
        
        $promo_own_jenis                = $this->input->post('promo_own_jenis');
        $promo_own_baby_care            = $this->input->post('promo_own_baby_care');
        $promo_own_feminim_care         = $this->input->post('promo_own_feminim_care');
        $promo_own_health_care          = $this->input->post('promo_own_health_care');
        $promo_own_baby_wipes           = $this->input->post('promo_own_baby_wipes');
        $promo_own_periode              = $this->input->post('promo_own_periode');
        $promo_own_harga_normal         = $this->input->post('promo_own_harga_normal');
        $promo_own_harga_promo          = $this->input->post('promo_own_harga_promo');
        $promo_own_keterangan           = $this->input->post('promo_own_keterangan');
        
        $promo_competitor_jenis         = $this->input->post('promo_competitor_jenis');
        $promo_competitor_baby_care     = $this->input->post('promo_competitor_baby_care');
        $promo_competitor_feminim_care  = $this->input->post('promo_competitor_feminim_care');
        $promo_competitor_health_care   = $this->input->post('promo_competitor_health_care');
        $promo_competitor_baby_wipes    = $this->input->post('promo_competitor_baby_wipes');
        $promo_competitor_periode       = $this->input->post('promo_competitor_periode');
        $promo_competitor_harga_normal  = $this->input->post('promo_competitor_harga_normal');
        $promo_competitor_harga_promo   = $this->input->post('promo_competitor_harga_promo');
        $promo_competitor_keterangan    = $this->input->post('promo_competitor_keterangan');
        
        $osa    = array();
        for($i=0; $i<count($osa_produk); $i++){
            if($osa_produk[$i] && $osa_range[$i]){
                $osa[]  = $osa_produk[$i].'=='.$osa_range[$i];
            }
        }
        $data['osa']                    = implode('||',$osa);

        $oos    = array();
        for($i=0; $i<count($oos_produk); $i++){
            if($oos_produk[$i] && $oos_periode[$i]){
                $oos[]  = $oos_produk[$i].'=='.$oos_periode[$i].'=='.$oos_keterangan[$i];
            }
        }
        $data['oos']                    = implode('||',$oos);
        
        $promo_own  = array();
        for($i=0; $i<count($promo_own_jenis); $i++){
            if($promo_own_baby_care[$i] || $promo_own_feminim_care[$i] || $promo_own_health_care[$i] || $promo_own_baby_wipes[$i]){
                $promo_own[]    = $promo_own_jenis[$i].'=='.$promo_own_baby_care[$i].'=='.$promo_own_feminim_care[$i].'=='.$promo_own_health_care[$i].'=='.$promo_own_baby_wipes[$i].'=='.$promo_own_periode[$i].'=='.$promo_own_harga_normal[$i].'=='.$promo_own_harga_promo[$i].'=='.$promo_own_keterangan[$i];
            }
        }
        $data['promo_own']              = implode('||',$promo_own);
        
        $promo_competitor  = array();
        for($i=0; $i<count($promo_competitor_jenis); $i++){
            if($promo_competitor_baby_care[$i] || $promo_competitor_feminim_care[$i] || $promo_competitor_health_care[$i] || $promo_competitor_baby_wipes[$i]){
                $promo_competitor[] = $promo_competitor_jenis[$i].'=='.$promo_competitor_baby_care[$i].'=='.$promo_competitor_feminim_care[$i].'=='.$promo_competitor_health_care[$i].'=='.$promo_competitor_baby_wipes[$i].'=='.$promo_competitor_periode[$i].'=='.$promo_competitor_harga_normal[$i].'=='.$promo_competitor_harga_promo[$i].'=='.$promo_competitor_keterangan[$i];
            }
        }
        $data['promo_competitor']       = implode('||',$promo_competitor);
        
        $save               = $this->model_basic->insert_data($this->tbl_sales_promotion,$data);
        if($save){
            $rs['status']   = 'ok';
            $rs['id']       = $save;
        }else{
            $rs['status']   = 'error';
        }
        $this->returnJson($rs);
    }
    
    function upload_image($type="",$id=0,$index=0,$tanggal=""){
        if($type == 'team_leader') $tabel = $this->tbl_team_leader;
        else if($type == 'sales_promotion') $tabel = $this->tbl_sales_promotion;
        else $tabel = $this->tbl_merchandise;
        
        $config['upload_path'] = FCPATH . "userdata/".$type."/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '10000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = $id.'_'.$tanggal.'_'.$index;
            $neworig = $newname.$ext;
            rename($upload['full_path'], $path . $neworig);
            
            $lapor = $this->model_basic->get_data($tabel,array('where_array'=>array('id'=>$id)))->row();
            if($lapor->foto == "") $new_foto    = $neworig;
            else $new_foto  = $lapor->foto.'||'.$neworig;
            
            $data   = array(
                'foto'          => $new_foto
            );
            $this->model_basic->update_data($tabel,$data,'id',$id);
            return $neworig;
        }
    }
    
}