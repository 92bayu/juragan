<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_main extends CI_Model{
    function get_menu( $tabel="" , $tbl_menu="", $id = 0 , $id_modul = 0, $parent_id = 0 ){
		$query 	= $this->db->query( 'SELECT id_menu FROM '.$tabel.' WHERE id_level = '.$id.' AND act_view = 1' )->result_array();
		$get_id[] = 0;
		foreach( $query as $q ){
			$get_id[] = $q['id_menu'];
		}
		$this->db->where_in( 'id' , $get_id );		
		$this->db->where( 'parent_id' , $parent_id );
		$this->db->where( 'id_modul' , $id_modul );
        $this->db->where( 'status' , 1 );
		$this->db->order_by( 'urutan' , 'ASC' );
		return $this->db->get( $tbl_menu )->result_array();
	}
    function get_cek_akses( $tabel="" , $level = 0 , $menu = 0 ){
		return $this->db->query( 'SELECT * FROM '.$tabel.' WHERE id_level = '.$level.' AND id_menu = '.$menu.' AND act_view = 1' )->num_rows();
	}
	public function get_menu_name($tabel="",$id=""){
		$this->db->where('id',$id);
		$data = $this->db->get($tabel)->row();
        if(lang($data->target))
            $d['nama'] = lang($data->target);
        else
    		$d['nama'] = $data->nama;

        if(lang(strtolower(str_replace(' ','_',$data->keterangan))))
            $d['keterangan'] = lang(strtolower(str_replace(' ','_',$data->keterangan)));
        else
    		$d['keterangan'] = $data->keterangan;

        return $d;
	}
	public function get_modul_name($tabel="",$id){
		$this->db->where('id',$id);
		$data = $this->db->get($tabel)->row();
        if(lang(strtolower(str_replace(' ','_',$data->nama))))
            $nama = lang(strtolower(str_replace(' ','_',$data->nama)));
        else
    		$nama = $data->nama;
		return $nama;
	}
    function get_akses( $tabel = "" , $level = 0 , $menu = 0 ){
		return $this->db->query( 'SELECT * FROM '.$tabel.' WHERE id_level = '.$level.' AND id_menu = '.$menu )->result_array();
	}
}