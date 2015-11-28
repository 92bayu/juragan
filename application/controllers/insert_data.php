<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_data extends MY_Controller {
    
    function __construct(){
        parent::__construct();
    }

	public function insert_laporan(){
        $data = array(
            "nama"          => $this->input->post('nama'),
            "laporan"       => $this->input->post('laporan'),
            "longitude"     => $this->input->post('longitude'),
            "tanggal"       => date('Y-m-d'),
            "latitude"      => $this->input->post('latitude')
        );
		$insert = $this->model_basic->insert_data('tbl_laporan',$data);
        if($insert)
            echo $insert;
        else
            echo 0;
	}
    public function insert_foto_laporan($id=0){
        $foto = $this->upload_gambar();
        if($foto){
            $data = array(
                'foto'      => $foto
            );
            $this->model_basic->update_data('tbl_laporan',$data,'id',$id);
        }
        echo 'success';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */