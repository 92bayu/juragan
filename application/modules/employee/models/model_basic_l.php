<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_basic_l extends CI_Model{
    function query($query){
        return $this->db->query($query);
    }
	
    
    function get_data($select="*",$table="",$where_array=array(),$sort_by="",$sort="ASC",$group_by="",$limit=0,$field="",$where_in=array()){
        $this->db->select($select);
        if(count($where_in)!=0 && $field!="")
            $this->db->where_in($field,$where_in);
        if($sort == "")
            $sort = "ASC";
        if($sort_by != "")
            $this->db->order_by($sort_by,$sort);
        if($group_by != "")
            $this->db->group_by($group_by);
        if($limit > 0)
            $this->db->limit($limit);
        if(count($where_array)==0)
            $data = $this->db->get($table);
        else
            $data = $this->db->get_where($table,$where_array);
            
        return $data;
    }

    
     function insert_all($table,$data) {
        $this->load->database('default',TRUE);
        if(!$this->db->insert($table,$data))
            return FALSE;
        $data["id"] = $this->db->insert_id();
        return (object)$data;
    }
    
    function insert_data($table="",$data=array()){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function update_data($table="",$data=array(),$column="",$where=""){
        $this->db->where($column,$where);
        return $this->db->update($table,$data);
    }

    function delete_data($table="",$column="",$where=""){
        $this->db->where($column,$where);
        $this->db->delete($table);
    }
    
    #other
    
    function update_data_multi_where($table="",$data=array(),$column=array(),$where=array()){
        for($i=0;$i<count($column);$i++){
            if(isset($column[$i]) && isset($where[$i]))
                $this->db->where($column[$i],$where[$i]);
        }
        return $this->db->update($table,$data);
    }
    
//     luthfi

    function get_menu($id_modul=array(),$parent_id=0){
    	$this->db->where_in('id_modul',$id_modul);
    	$this->db->where('parent_id',$parent_id);
    	return $this->db->get('tbl_menu')->result_array();
    }
    
    function get_modul_name($id_modul=0){
    	$this->db->select('nama');
    	$this->db->where_in('id',$id_modul);
    	return $this->db->get('tbl_modul')->result_array();
    }
    
}