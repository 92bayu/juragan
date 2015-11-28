<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function _input( $value = array() ){
    $data = array();
    foreach($value as $key => $val){
        if( $key != 'id' && $key != 'icon' && $key != 'old_icon' && $key != 'file' && $key != 'old_file' && !is_array($val)){
            if($key == "password"){
                if($val)
                    $data[$key] = md5($val);
            }else
                $data[$key] = $val;
        }
    }
    return $data;
}
