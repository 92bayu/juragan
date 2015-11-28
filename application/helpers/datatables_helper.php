<?php 
/*
 * function that generate the action buttons edit, delete, detail
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id,$module="",$controller="",$method="",$edit="true",$delete="true",$detail="",$popup="t"){
    $ci= & get_instance();
    $html='<span class="actions">';
    if($detail){
        if(is_array($detail)){
            if(isset($detail['url'])){
                if(isset($detail['view'])){
                    if($detail['view'] == "blank")
                        $html .='<a href="'.  $detail['url'].$id.'" target="_blank" title="'.lang('lbl_view').' '.lang('lbl_detail').'"><img src="'.  base_url().'assets/images/detail.png"/></a>';
                    else if($detail['view'] == "popup")
                        $html .='<a onclick="openBox(\''.$detail['url'].$id.'\',825,500);return false;" href="#view" title="'.lang('lbl_view').' '.lang('lbl_detail').'"><img src="'.  base_url().'assets/images/detail.png"/></a>';
                    else
                        $html .='<a href="'.  $detail['url'].$id.'" title="'.lang('lbl_view').' '.lang('lbl_detail').'"><img src="'.  base_url().'assets/images/detail.png"/></a>';
                }else
                    $html .='<a href="'.  $detail['url'].$id.'" title="'.lang('lbl_view').' '.lang('lbl_detail').'"><img src="'.  base_url().'assets/images/detail.png"/></a>';
            }
        }else{
            $html .='<a href="'.  $detail.$id.'" title="'.lang('lbl_view').' '.lang('lbl_detail').'"><img src="'.  base_url().'assets/images/detail.png"/></a>';
        }
    }

    if($edit == "true"){
        if($popup == "t")
            $html .='<a onclick="openBox(\''. $module . '/' . $controller .'/form_'. $method .'?method=edit&id='.$id.'\',825,500);return false;" href="#Edit" title="'.lang('lbl_edit').'"><img src="'.  base_url().'assets/images/edit.png"/></a>';
        else
            $html .='<a href="'. $module . '/' . $controller .'/form_'. $method .'?method=edit&id='.$id.'" title="'.lang('lbl_edit').'"><img src="'.  base_url().'assets/images/edit.png"/></a>';
    }

    if($delete == "true")
        $html .='<a href="'. $module . '/' . $controller .'/delete_'. $method .'/'. $id .'" id="deleteData" title="'.lang('lbl_delete').'"><img src="assets/images/delete.png"/></a>';
    $html.='</span>';
    
    return $html;
}

function get_persetujuan_component($id,$status,$type="status",$controller="",$method="",$height=400){
    $ci= & get_instance();
    if($type=="status"){                
        $html = '<a onclick="openBox(\''.  $controller .'/form_'. $method .'?id='.$id.'\',825,'.$height.');return false;" href="#Edit" title="'.lang('lbl_approval').'"><img src="assets/images/stat'.$status.'.png" style="display: block;margin-left:auto;margin-right:auto;" /></a>';
    }else{
        $html = '<a href="'.$controller .'/surat_jalan?id='.$id.'" title="'.lang('lbl_permit').'" id="cetak-surat-jalan" index="'.$id.'"><img src="assets/images/cetak.png" style="width: '.$status.'pc;height: auto;display: block;margin-left:auto;margin-right:auto;" /></a>';
    }
    return $html;
}

function get_pelaksanaan_component($id,$status,$controller="",$method=""){
    $ci= & get_instance();
    return '<a onclick="openBox(\''.  $controller .'/form_'. $method .'?id='.$id.'\',825,550);return false;" href="#Edit" title="'.lang('lbl_implementation').'"><img src="assets/images/exam'.$status.'.png" style="display: block;margin-left:auto;margin-right:auto;" /></a>';
}

function get_btn_report($id,$controller="",$method=""){
    $ci= & get_instance();
    return '<a href="'.$controller .'/print_'.$method.'?id='.$id.'" title="'.lang('btn_print').'" target="_blank"><img src="assets/images/cetak.png" style="width: 16px;height: auto;display: block;margin-left:auto;margin-right:auto;" /></a>';
}
