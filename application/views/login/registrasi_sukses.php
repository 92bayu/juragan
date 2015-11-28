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
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
</head>

<body class="novernav login-reg">
    <div class="topheader orangeborderbottom5">
        <div class="left">
            <h1 class="logo"><span><?php echo $company_initial; ?></span></h1>
            <span class="slogan"><?php echo $title_site; ?></span>
            
            <br clear="all" />
            
        </div><!--left-->
    </div>
    <div class="contentwrapper padding10">
    	<div class="errorwrapper">
        	<div class="errorcontent">
                <h1><?php echo lang('lbl_registration'); ?></h1>
                <h3><?php echo lang('msg_registration_success'); ?></h3>
                <p><?php echo lang('lbl_please_check_your_email'); ?></p>
            </div><!--errorcontent-->
        </div><!--errorwrapper-->
    </div>
</body>
</html>