<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upload extends MY_Controller {
	function __construct(){
		parent::__construct();

	}
	public function index(){
		$image_width = $this->input->post('image_width');
		$image_height = $this->input->post('image_height');
		$file_target = $this->input->post('file');
		if($this->session->userdata($file_target) != FALSE)
			$temp_folder = $this->session->userdata($file_target);
		else {
			$folder = uniqid();
			$this->session->set_userdata($file_target,$folder);
			$temp_folder = $this->session->userdata($file_target);
		}
		if(!is_dir(FCPATH . "userdata/temp/".$temp_folder))
			mkdir(FCPATH . "userdata/temp/".$temp_folder);
		$files = glob(FCPATH . "userdata/temp/".$temp_folder."/{,.}*", GLOB_BRACE);
		foreach($files as $file){ 
			if(is_file($file))
				@unlink($file);
		}
		
        $config['upload_path'] = FCPATH . "userdata/temp/$temp_folder/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '5000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . md5(date('YmdHis')) . $ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "userdata/temp/$temp_folder/$neworig";
            
            $config['image_library']    = 'gd2';
            $config['source_image']     = $uploaded;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = $image_width;
            $config['height']           = $image_height;

            $this->load->library('image_lib', $config); 
            $this->image_lib->resize();
            echo $uploaded;
        } else {
            echo "assets/images/nopohoto.png";
        }
	}
    
	public function upload_image_wm(){
		$image_width = $this->input->post('image_width');
		$image_height = $this->input->post('image_height');
		$file_target = $this->input->post('file');
		if($this->session->userdata($file_target) != FALSE)
			$temp_folder = $this->session->userdata($file_target);
		else {
			$folder = uniqid();
			$this->session->set_userdata($file_target,$folder);
			$temp_folder = $this->session->userdata($file_target);
		}
		if(!is_dir(FCPATH . "userdata/temp/".$temp_folder))
			mkdir(FCPATH . "userdata/temp/".$temp_folder);
		$files = glob(FCPATH . "userdata/temp/".$temp_folder."/{,.}*", GLOB_BRACE);
		foreach($files as $file){ 
			if(is_file($file))
				@unlink($file);
		}
		
        $config['upload_path'] = FCPATH . "userdata/temp/$temp_folder/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '5000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . md5(date('YmdHis')) . $ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "userdata/temp/$temp_folder/$neworig";

            $this->load->library('image_lib'); 
            
            $config['image_library']    = 'gd2';
            $config['source_image']     = $uploaded;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = $image_width;
            $config['height']           = $image_height;
            
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $config_wm['source_image']      = $uploaded;
            if(file_exists(FCPATH . 'assets/watermark/overlay.png')){
                $config_wm['image_library']     = 'gd2';
                $config_wm['wm_type']           = 'overlay';
                $config_wm['wm_overlay_path']   = 'assets/watermark/overlay.png';
                $config_wm['wm_opacity']        = 50;
                $config_wm['wm_hor_alignment']  = 'right';
            }else{
                $config_wm['wm_type']           = 'text';
                $config_wm['wm_text']           = $_SERVER['SERVER_NAME'];
                $config_wm['wm_font_path']      = 'assets/watermark/Roboto-BlackItalic-webfont.ttf';
                $config_wm['wm_font_size']      = 10;
                $config_wm['wm_font_color']     = 'ffffff';
                $config_wm['wm_padding']        = 0;
                $config_wm['wm_hor_alignment']  = 'left';
            }
            $config_wm['wm_vrt_alignment']  = 'bottom';
            $this->image_lib->initialize($config_wm);
            $this->image_lib->watermark();

            echo $uploaded;
        } else {
            echo "assets/images/nopohoto.png";
        }
	}
    
    public function upload_file(){
        $folder_file = $this->input->post('dokumen');
		if($this->session->userdata($folder_file) != FALSE)
			$temp_folder_file = $this->session->userdata($folder_file);
		else {
			$folder = uniqid();
			$this->session->set_userdata($folder_file,$folder);
			$temp_folder_file = $this->session->userdata($folder_file);
		}
		if(!is_dir(FCPATH . "userdata/temp/".$temp_folder_file))
			mkdir(FCPATH . "userdata/temp/".$temp_folder_file);
		$files = glob(FCPATH . "userdata/temp/".$temp_folder_file."/{,.}*", GLOB_BRACE);
		foreach($files as $file){ 
			if(is_file($file))
				@unlink($file);
		}
		
        $config['upload_path'] = FCPATH . "userdata/temp/$temp_folder_file/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '100000000000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $neworig = uniqid().'__'.$this->upload->file_name;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "userdata/temp/$temp_folder_file/$neworig";
            echo $uploaded;
        } else {
            echo "error";
        }
	}
}