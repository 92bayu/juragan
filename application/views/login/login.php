<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $company_initial.' | '.$title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/plugins/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/plugins/animate.delay.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/login-style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form-login").submit(function(){
                $('.msginfo').hide();
                $('.msgerror').hide();
                $('.msgalert').show();
                $('.msgalert p').text('<?php echo lang('msg_please_wait'); ?>');
                $.ajax({
                    url : $(this).attr('action'),
                    data : $(this).serialize(),
                    type : 'POST',
                    dataType : 'json',
                    success : function(response){
                        $('.msgalert').hide();
                        if(response.status == 'error'){
                            $('.msgerror').show();
                            $('.msgerror p').text(response.message);
                        }else{
                            $('.msginfo').show();
                            $('.msginfo p').text(response.message);
                            window.location = response.href;
                        }
                    }
                });
                return false;
            });
            
        });
    </script>
    <noscript>
        <link rel="stylesheet" href="assets/css/no_js.css" type="text/css" />    
    </noscript>
</head>
<!-- 1 -->
<body class="function-login">
    <div class="no_js">
        <div class="no_js-overlay"></div>
        <div class="no_js-box">
            <div class="message"><?php echo lang('lbl_javascript_must_be_enabled'); ?></div>
        </div>
    </div>
    <div class="loginbox">
        <div class="loginboxinner">
            <div class="logo animate0 bounceInDown">
                <table>
                    <tr>
                        <td rowspan="2" align="center"><img src="assets/images/logo.png" style="width: 80%;" /></td>
                    </tr>
                </table>
            </div>
            <div class="notibar msginfo hidden">
                <a class="close"></a>
                <p>This is an information message.</p>
            </div>
            <div class="notibar msgalert hidden">
                <a class="close"></a>
                <p>This is an information message.</p>
            </div>
            <div class="notibar msgerror hidden">
                <a class="close"></a>
                <p>This is an information message.</p>
            </div>
            <form id="form-login" method="post" action="<?php echo $controller.'/do_login'; ?>">
                <div class="username animate1 bounceInDown">
                    <div class="usernameinner">
                        <input type="text" id="username" name="username" placeholder="<?php echo lang('lbl_username'); ?>" autocomplete="off" />
                    </div>
                </div>
                <div class="password animate2 bounceInDown">
                    <div class="passwordinner">
                        <input type="password" id="password" name="password" placeholder="<?php echo lang('lbl_password'); ?>" autocomplete="off" />
                    </div>
                </div>
                <div class="formwrapper animate3 bounceInDown">
                    <input type="checkbox" id="remember-me" name="remember" />
                    <label for="remember-me"><?php echo lang('lbl_remember_me'); ?></label>
                </div>
                <div class="formbutton animate4 bounceInDown">
                    <input type="submit" class="btn btn-blue" value="<?php echo lang('lbl_sign_in'); ?>" />
                    <a class="forgot" href="#" onclick="openBox('<?php echo $controller.'/forgot_password'; ?>',825,500);return false;"><?php echo lang('lbl_forgot_your_password'); ?>?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>