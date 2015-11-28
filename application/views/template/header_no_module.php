<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $company_initial.' | '.$title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/style.blueline.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom-template.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript">
    </script> 
    <noscript>
        <link rel="stylesheet" href="assets/css/no_js.css" type="text/css" />    
    </noscript>
</head>

<body<?php if(isset($no_left_menu)) echo ' class="novernav"'; ?>>
<div class="no_js">
    <div class="no_js-overlay"></div>
    <div class="no_js-box">
        <div class="message"><?php echo lang('lbl_javascript_must_be_enabled'); ?></div>
    </div>
</div>
<div class="bodywrapper">
    <div class="topheader orangeborderbottom5">
        <div class="left">
            <h1 class="logo"><img src="assets/images/logo.png" height="30px" style="position: absolute; margin-top: -5px;" /><span>&nbsp;</span></h1>
            <span class="slogan" style="margin-left: 175px;"><?php echo $title_site; ?></span>
            
            <br clear="all" />
            
        </div><!--left-->
        <?php if($user_nama != "No Name"){ ?>
        <div class="right">
        	<div class="notification">
                <a class="count" href="notification"><span><?php echo $notification; ?></span></a>
        	</div>
            <div class="userinfo">
            	<img src="<?php echo $user_foto; ?>" alt="" />
                <span><?php echo $user_nama; ?></span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
                <div class="avatar">
                	<a><img src="<?php echo $user_foto; ?>" alt="" /></a>
                </div><!--avatar-->
                <div class="userdata">
                	<h4><?php echo $user_nama; ?></h4>
                    <span class="email"><?php echo $user_nip; ?></span>
                    <ul>
                    	<li><a href="account/edit_profile"><?php echo lang('lbl_edit_profile'); ?></a></li>
                        <li><a href="account/account_setting"><?php echo lang('lbl_account_settings'); ?></a></li>
                        <li><a href="account/change_password"><?php echo lang('lbl_change_password'); ?></a></li>
                        <li><a href="logout"><?php echo lang('lbl_sign_out'); ?></a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
        
        <?php } ?>
    </div><!--topheader-->
