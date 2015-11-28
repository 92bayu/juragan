<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_basic extends CI_Model{
    function query($query){
        return $this->db->query($query);
    }
    function get_dropdown($setting_table,$table,$id){
        $this->db->where('id',$id);
        $setting = $this->db->get($setting_table)->row();
        
        $this->db->where('parent_id',$setting->content);
        $this->db->where('status',1);
        return $this->db->get($table)->result();
    }
    function get_amount_data($table="",$field="",$where_array=array()){
        $this->db->select_sum($field);
        if(count($where_array)==0)
            $data = $this->db->get($table);
        else
            $data = $this->db->get_where($table,$where_array);
        $d = $data->row();
        return $d->$field;
    }
    function get_data($table="",$data=array()){
        if(isset($data['select']))
            $this->db->select($data['select'],false);
        if(isset($data['select_max']))
            $this->db->select_max($data['select_max']);
        if(isset($data['select_sum']))
            $this->db->select_sum($data['select_sum']);
        if(isset($data['array_in']) && count($data['array_in'])!=0 && isset($data['field_in']))
            $this->db->where_in($data['field_in'],$data['array_in']);
        if(isset($data['array_not_in']) && count($data['array_not_in'])!=0 && isset($data['field_not_in']))
            $this->db->where_not_in($data['field_not_in'],$data['array_not_in']);
        if(isset($data['sort']))
            $sort = $data['sort'];
        else
            $sort = 'ASC';
        if(isset($data['sort_by']))
            $this->db->order_by($data['sort_by'],$sort);
        if(isset($data['where_field'])){
            if(isset($data['where']))
                $this->db->where($data['where_field'],$data['where']);
            else
                $this->db->where($data['where_field']);
        }
        if(isset($data['where_or_field'])){
            if(isset($data['where_or']))
                $this->db->or_where($data['where_or_field'],$data['where_or']);
            else
                $this->db->or_where($data['where_or_field']);
        }
        if(isset($data['group_by']))
            $this->db->group_by($data['group_by']);
        if(isset($data['limit']) && $data['limit'] > 0){
            if(isset($data['offset']))
                $this->db->limit($data['limit'],$data['offset']);
            else
                $this->db->limit($data['limit']);
        }
        if(isset($data['join']) && isset($data['join_on'])){
            if(isset($data['join_type']))
                $this->db->join($data['join'],$data['join_on'],$data['join_type']);
            else
                $this->db->join($data['join'],$data['join_on']);
        }
        if(isset($data['field_like']) && isset($data['like']))
            $this->db->like($data['field_like'],$data['like']);
        if(isset($data['field_or_like']) && isset($data['or_like']))
            $this->db->or_like($data['field_or_like'],$data['or_like']);
        if(isset($data['where_array']) && count($data['where_array'])>0)
            $data = $this->db->get_where($table,$data['where_array']);
        else
            $data = $this->db->get($table);
            
        return $data;
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
        if(is_array($column)){
            foreach($column as $col => $val){
                $this->db->where($col,$val);
            }
        }else{
            if(is_array($where))
                $this->db->where_in($column,$where);
            else
                $this->db->where($column,$where);
        }
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
        
}