<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function debug($array=array()){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}