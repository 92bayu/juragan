<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_email extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
    public function index($type="general",$url=""){
        if($this->input->get('url')) $url = $this->input->get('url');
        if($this->input->get('type')) $type = $this->input->get('type'); 
        
        $pesan       = '<div style="background-color:#e5e5e5;margin:20px 0;padding: 10px 0;">';
        $pesan      .= '<br>';
        $pesan      .= '<div style="margin:2%">';
        $pesan      .= '<div style="direction:ltr;text-align:left;font-family:\'Open sans\',\'Arial\',sans-serif;color:#444;background-color:white;padding:1.5em;border-radius:1em;max-width:580px;margin:2% auto 0 auto">';
        $pesan      .= '<table style="background:white;width:100%">';
        $pesan      .= '<tbody>';
        $pesan      .= '<tr>';
        $pesan      .= '<td>';
        $pesan      .= '<div style="width:315px;min-height:54px;margin:10px auto">';
        $pesan      .= '<img class="CToWUd" width="315" height="100" alt="Munjalindra" src="http://software.munjalindra.com/wp-content/uploads/2015/01/logo-munjalindra-software-2.gif">';
        $pesan      .= '</div>';
        $pesan      .= '<div style="width:90%;padding-bottom:10px;padding-left:15px">';
        $pesan      .= '<p><span style="font-family:\'Open sans\',\'Arial\',sans-serif;font-size:2.08em">Hai Team</span></p>';
        $pesan      .= '</div>';
        $pesan      .= '<p></p>';
        $pesan      .= '<div style="clear:both;float:left;padding:0px 5px 10px 10px;vertical-align:top">';
        if($type == 'db')        
            $pesan      .= '<img class="CToWUd" width="129" height="129" src="http://icons.iconarchive.com/icons/gakuseisean/ivista-2/256/Misc-Delete-Database-icon.png" style="border:0" alt="Bug">';
        else
            $pesan      .= '<img class="CToWUd" width="129" height="129" src="http://s23.postimg.org/aweque7gb/bug.png" style="border:0" alt="Bug">';
        $pesan      .= '</div>';
        $pesan      .= '<div style="float:left;vertical-align:middle;padding:10px;max-width:398px;float:left">';
        $pesan      .= '<table style="vertical-align:middle">';
        $pesan      .= '<tbody>';
        $pesan      .= '<tr>';
        $pesan      .= '<td style="font-family:\'Open sans\',\'Arial\',sans-serif">';
        $pesan      .= '<span style="font-size:20px">Informasi Bug</span>';
        $pesan      .= '<br><br>';
        $pesan      .= '<span style="font-size:small;line-height:1.4em">';
        $pesan      .= 'Ada informasi bug ni! Tolong cek ';
        $pesan      .= '<a target="_blank" style="text-decoration:none;color:#15c" href="'.$url.'">disini</a>. ';
        $pesan      .= 'Jika memang ada bug mohon diperbaiki.';
        $pesan      .= '</span>';
        $pesan      .= '</td>';
        $pesan      .= '</tr>';
        $pesan      .= '</tbody>';
        $pesan      .= '</table>';
        $pesan      .= '</div>';
        $pesan      .= '</td>';
        $pesan      .= '</tr>';
        $pesan      .= '</tbody>';
        $pesan      .= '</table>';
        $pesan      .= '</div>';
        $pesan      .= '</div>';
        $pesan      .= '</div>';      
        
        //$pesan  = 'Tolong dicek ada kesalahan pada URL ini : '.$url;
        
        $config = Array(
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_port'     => 465,
            'smtp_user'     => 'info.munjalindra@gmail.com',
            'smtp_pass'     => 'smartcity',
            'mailtype'      => 'html',
            'charset'       => 'iso-8859-1',
            'wordwrap'      => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('client.munjalindra.com');
        $this->email->to('team.munjalindra@gmail.com'); //email tujuan. Isikan dengan emailmu!
        $this->email->subject("INFORMASI BUG ".date('d/m/Y'));
        $this->email->message($pesan);
        if($this->email->send()){
            echo lang('lbl_report_has_been_sent');
        }else{
          print_r($this->email->print_debugger());
        }
	}
    
    
    public function registration(){
        $email          = $this->input->post('reg_email');
        $password       = $this->input->post('reg_password');
        $company        = $this->input->post('company_limit');
        $user           = $this->input->post('user_limit');
        $masa_aktif     = $this->input->post('masa_aktif');
        $serial_number  = $this->serial_number($email,$company,$user,$masa_aktif);
        $url            = base_url().$this->controller_login.'/verifikasi_registrasi?e='.$this->enkripsi($email);

        if(file_exists(FCPATH . "assets/registered/".$email.".ini") || is_dir(FCPATH . "assets/config/".$email)){
            $this->returnJson(array('status' => 'error','message' => lang('msg_email_has_been_registered')));
        }else{
            $pesan       = '<div style="background-color:#e5e5e5;margin:20px 0;padding: 10px 0;">';
            $pesan      .= '<br>';
            $pesan      .= '<div style="margin:2%">';
            $pesan      .= '<div style="direction:ltr;text-align:left;font-family:\'Open sans\',\'Arial\',sans-serif;color:#444;background-color:white;padding:1.5em;border-radius:1em;max-width:580px;margin:2% auto 0 auto">';
            $pesan      .= '<table style="background:white;width:100%">';
            $pesan      .= '<tbody>';
            $pesan      .= '<tr>';
            $pesan      .= '<td>';
            $pesan      .= '<div style="width:315px;min-height:54px;margin:10px auto">';
            $pesan      .= '<img class="CToWUd" width="315" height="100" alt="Munjalindra" src="http://software.munjalindra.com/wp-content/uploads/2015/01/logo-munjalindra-software-2.gif">';
            $pesan      .= '</div>';
            $pesan      .= '<div style="width:90%;padding-bottom:10px;padding-left:15px">';
            $pesan      .= '<p><span style="font-family:\'Open sans\',\'Arial\',sans-serif;font-size:2.08em">Hallo</span></p>';
            $pesan      .= '</div>';
            $pesan      .= '<p></p>';
            $pesan      .= '<div style="clear:both;float:left;padding:0px 5px 10px 10px;vertical-align:top">';
            $pesan      .= '<img class="CToWUd" width="129" height="129" src="https://cdn4.iconfinder.com/data/icons/REALVISTA/mail_icons/png/400/confirmation.png" style="border:0" alt="Konfirmasi">';
            $pesan      .= '</div>';
            $pesan      .= '<div style="float:left;vertical-align:middle;padding:10px;max-width:398px;float:left">';
            $pesan      .= '<table style="vertical-align:middle">';
            $pesan      .= '<tbody>';
            $pesan      .= '<tr>';
            $pesan      .= '<td style="font-family:\'Open sans\',\'Arial\',sans-serif">';
            $pesan      .= '<span style="font-size:20px">Konfirmasi Pendaftaran</span>';
            $pesan      .= '<br><br>';
            $pesan      .= '<span style="font-size:small;line-height:1.4em">';
            $pesan      .= 'Kode Aktivasi email anda adalah '.$serial_number.'. ';
            $pesan      .= 'Silahkan klik <a target="_blank" style="text-decoration:none;color:#15c" href="'.$url.'">disini</a> untuk melanjutkan.';
            $pesan      .= '</span>';
            $pesan      .= '</td>';
            $pesan      .= '</tr>';
            $pesan      .= '</tbody>';
            $pesan      .= '</table>';
            $pesan      .= '</div>';
            $pesan      .= '</td>';
            $pesan      .= '</tr>';
            $pesan      .= '</tbody>';
            $pesan      .= '</table>';
            $pesan      .= '</div>';
            $pesan      .= '</div>';
            $pesan      .= '</div>';
            
            $config = Array(
                'protocol'      => 'smtp',
                'smtp_host'     => 'ssl://smtp.googlemail.com',
                'smtp_port'     => 465,
                'smtp_user'     => 'info.munjalindra@gmail.com',
                'smtp_pass'     => 'smartcity',
                'mailtype'      => 'html',
                'charset'       => 'iso-8859-1',
                'wordwrap'      => TRUE
            );
    
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('team.munjalindra@gmail.com');
            $this->email->to($email);
            $this->email->subject("KONFIRMASI ".date('d/m/Y'));
            $this->email->message($pesan);
            if($this->email->send()){
                $file       = FCPATH . "assets/config/new.ini";
                $new_file   = FCPATH . "assets/registered/".$email.".ini";
                if(!@copy($file,$new_file)){
                    $this->returnJson(array('status' => 'error','message' => lang('msg_registration_failed')));
                }else{
                    $handle = fopen ($new_file, "w");
                    if($handle) {
                        fwrite ( $handle, md5($password) );
                    }
                    fclose($handle);
                    $this->returnJson(array('status' => 'ok','message' => lang('msg_registration_success'),'href' => $this->controller_login.'/registrasi_sukses'));
                }
            }else{
                $this->returnJson(array('status' => 'error','message' => lang('msg_can_not_access_this_email')));
            }
        }
    }
    
    
    // APLIKASI UNTUK IMAP || MEMBACA EMAIL MASUK
    /*
    public function tes(){
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'team.munjalindra@gmail.com';
        $password = 'smartcity';
        
        $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to server: ' . imap_last_error());
        
        $emails = imap_search($inbox,'ALL');
        
        if($emails) {
            $output = '';
            rsort($emails);
        
            foreach($emails as $email_number) {
                $overview = imap_fetch_overview($inbox,$email_number,0);
                $structure = imap_fetchstructure($inbox, $email_number);
        
                if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
                    $part = $structure->parts[1];
                    $message = imap_fetchbody($inbox,$email_number,2);
        
                    if($part->encoding == 3) {
                        $message = imap_base64($message);
                    } else if($part->encoding == 1) {
                        $message = imap_8bit($message);
                    } else {
                        $message = imap_qprint($message);
                    }
                }
        
                $output.= '<div class="toggle'.($overview[0]->seen ? 'read' : 'unread').'">';
                $output.= '<span class="from">From: '.utf8_decode(imap_utf8($overview[0]->from)).'</span>';
                $output.= '<span class="date">on '.utf8_decode(imap_utf8($overview[0]->date)).'</span>';
                $output.= '<br /><span class="subject">Subject('.$part->encoding.'): '.utf8_decode(imap_utf8($overview[0]->subject)).'</span> ';
                $output.= '</div>';
        
                $output.= '<div class="body">'.$message.'</div><hr />';
            }
        
            echo $output;
        }
        
        imap_close($inbox);
    }
    */
}