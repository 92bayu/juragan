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
    <script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form-reg').validate({
                rules: {
                    company     : {required: true},
                    hostname    : {required: true},
                    username    : {required: true},
                    database    : {required: true},
                },
                messages: {
                    company     : '<?php echo lang("lbl_required"); ?>',
                    hostname    : '<?php echo lang("lbl_required"); ?>',
                    username    : '<?php echo lang("lbl_required"); ?>',
                    database    : '<?php echo lang("lbl_required"); ?>',
                },
                submitHandler: function(form){
                    $('#msginfo1').hide();
                    $('#msgerror1').hide();
                    $('#msgalert1').show();
                    $('#msgalert1 p').text('<?php echo lang('msg_please_wait'); ?>');
                    $.ajax({
                        url : $(form).attr('action'),
                        data : $(form).serialize(),
                        type : 'POST',
                        dataType : 'json',
                        success : function(response){
                            $('#msgalert1').hide();
                            if(response.status == 'error'){
                                $('#msgerror1').show();
                                $('#msgerror1 p').text(response.message);
                            }else{
                                $('#msginfo1').show();
                                $('#msginfo1 p').text(response.message);
                                location.reload();
                            }
                        }
                    });
                }
            });            
        });
    </script> 
    <noscript>
        <link rel="stylesheet" href="assets/css/no_js.css" type="text/css" />    
    </noscript>
</head>

<body class="novernav login-reg">
    <div class="no_js">
        <div class="no_js-overlay"></div>
        <div class="no_js-box">
            <div class="message"><?php echo lang('lbl_javascript_must_be_enabled'); ?></div>
        </div>
    </div>
    <div class="topheader orangeborderbottom5">
        <div class="left">
            <h1 class="logo"><span><?php echo $company_initial; ?></span></h1>
            <span class="slogan"><?php echo $title_site; ?></span>
            
            <br clear="all" />
            
        </div><!--left-->
    </div>
    <div class="contentwrapper padding10">
        <div class="login-reg-container">
            <div>
                <div class="contenttitle2 nomargintop">
                    <h3><?php echo lang('lbl_create_company'); ?></h3>
                </div>
                <div class="notibar msginfo hidden" id="msginfo1">
                    <a class="close"></a>
                    <p>This is an information message.</p>
                </div>
                <div class="notibar msgalert hidden" id="msgalert1">
                    <a class="close"></a>
                    <p>This is an information message.</p>
                </div>
                <div class="notibar msgerror hidden" id="msgerror1">
                    <a class="close"></a>
                    <p>This is an information message.</p>
                </div>
                <form id="form-reg" method="post" class="stdform stdform2" action="<?php echo $controller; ?>/add_company">
                    <p>
                        <label><?php echo lang('lbl_company'); ?></label>
                        <span class="field">
                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                            <input type="text" id="company" name="company" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_hostname'); ?></label>
                        <span class="field">
                            <input type="text" id="hostname" name="hostname" value="localhost" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_username'); ?></label>
                        <span class="field">
                            <input type="text" id="username" name="username" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_password'); ?></label>
                        <span class="field">
                            <input type="password" id="reg_password" name="reg_password" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_database'); ?></label>
                        <span class="field">
                            <input type="text" id="database" name="database" autocomplete="off" />
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>