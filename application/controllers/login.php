<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
    
	public function index(){
		$site = $this->model_basic->get_data($this->tbl_profile_site)->row();
        $data = array(
            'title_site'		=> $site->judul,
		    'company_site'		=> $site->perusahaan,
            'company_initial'   => $site->inisial_perusahaan,
            'logo_site'         => $site->logo,
		);
        $data['controller']     = $this->controller_login;
		$this->load->view('login/login',$data);
	}
	
	function do_login(){
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $remember       = $this->input->post('remember');
        $data           = false;
		if($username && $password){
            $attr = array(
                'where_array'   => array(
                    'username'  => $username,
                    'status'    => 1
                )
            );
			$user = $this->model_basic->get_data($this->tbl_user,$attr)->row();
			if($user){
				if($user->password == (md5($password))){
                    $data = array(
                        'id'            => $user->id
                    );
                    if($remember){
                        $cookie1 = array(
        					'name'   => 'id',
		          			'value'  => $user->id,
				        	'expire' => '86500'
            			);
                        set_cookie( $cookie1 );
                    }
				}
                $this->model_basic->update_data($this->tbl_user,array('last_login'=>date('Y-m-d H:i:s')),'id',$user->id);
				if($data){
					$this->session->set_userdata($data);
                    $this->load->database('default',TRUE);
					$this->returnJson(array('status' => 'ok', 'message' => lang('msg_login_success'), 'href' => $this->controller_home));
				}else{
					$this->returnJson(array('status' => 'error', 'message' => lang('msg_wrong_password')));
                    $this->load->database('default',TRUE);
                }
			}else{
				$this->returnJson(array('status' => 'error', 'message' => lang('msg_wrong_username')));
                $this->load->database('default',TRUE);
            }
		}
		else
			$this->returnJson(array('status' => 'error','message' => lang('msg_username_password_empty')));
	}
    
    function forgot_password(){
        if($this->session->userdata('id')){
			redirect('dashboard/forbidden');
			exit();
		}else {
            $get_data = array(
                'where_array'   => array('id'=>1)
            );
			$site = $this->model_basic->get_data($this->tbl_profile_site,$get_data)->row();
			$data = array(
				'title_site'		=> $site->judul,
				'company_site'		=> $site->perusahaan,
                'company_initial'   => $site->inisial_perusahaan,
                'logo_site'         => $site->logo,
			);
            $data['controller']     = $this->controller_login;
			$this->load->view('login/form_forgot_password',$data);
		}
    }
    
    function check_username(){
        $username   = $this->input->post('username');
        $check      = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('username'=>$username)))->row();
        if($check){
            $data['status']     = "ok";
            $data['question']   = $check->pertanyaan;
        }else{
            $data['status']     = "error";
        }
        $this->returnJson($data);
    }

    function check_answer(){
        $username   = $this->input->post('username');
        $jawaban    = $this->input->post('jawaban');
        $check      = $this->model_basic->get_data($this->tbl_user,array('where_array'=>array('username'=>$username,'jawaban'=>$jawaban)))->row();
        if($check){
            $data['status']     = "ok";
        }else{
            $data['status']     = "error";
        }
        $this->returnJson($data);
    }
    
    function reset_password(){
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        
        $save       = $this->model_basic->update_data($this->tbl_user,array('password'=>md5($password)),'username',$username);
        if($save)
            $data['status']     = "ok";
        else
            $data['status']     = "error";
        $this->returnJson($data);
    }    
}