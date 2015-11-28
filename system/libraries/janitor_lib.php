<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class janitor_lib {

	function cek_akses($id_group,$menu){
		$CI = &get_instance();
		$CI->db->where('id_group',$id_group);
		$CI->db->where('menu',$menu);
		$query = $CI->db->get('tbl_user_akses')->result();
		foreach( $query as $query ){
			$akses['view'] = $query->view;
			$akses['input'] = $query->input;
			$akses['edit'] = $query->edit;
			$akses['delete'] = $query->delete;
		}
		return $akses;
	}
	
	function get_menu($id_group){
		$CI = &get_instance();
		$query = $CI->db->query('SELECT `menu` FROM `tbl_user_akses` WHERE `id_group` = '.$id_group.' AND ( `view` = 1 OR `input` = 1 OR `edit` = 1 OR `delete` = 1 )');
		$data = array();
		foreach( $query->result() as $q ){
			$data[] = $q->menu;
		}
		if( $query->num_rows() == 0 ){
			$data[] = 0;
		}
		$CI = &get_instance();
		$CI->db->where_in('id',$data);
		$CI->db->order_by('urut','ASC');
		$result = $CI->db->get('tbl_menu')->result();
		$i = 1;
		$menu = array();
		foreach( $result as $r ){
			$menu['menu'][$i] = $r->menu;
			$menu['target'][$i] = $r->target;
			$menu['id_menu'][$i] = $r->id;
			$i++;
		}
		return $menu;
	}
	
}