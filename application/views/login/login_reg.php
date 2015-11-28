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
    <link rel="stylesheet" href="assets/css/puzzleCAPTCHA.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="assets/js/puzzleCAPTCHA.js"></script>
    <script type="text/javascript" src="assets/js/puzzleCAPTCHA.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnRegister').attr('disabled',true);
            $('#form-reg').validate({
                highlight: function(element, errorClass, validClass) {
                    $(element).parent().parent().addClass(errorClass);
                    $(element.form).find("label[for=" + element.id + "]")
                      .addClass(errorClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parent().parent().removeClass(errorClass);
                    $(element.form).find("label[for=" + element.id + "]")
                      .removeClass(errorClass);
                },
                rules: {
                    reg_email       : {required: true, email: true},
                    reg_password    : {required: true},
                    company_limit   : {required: true, number: true},
                    user_limit      : {required: true, number: true},
                },
                messages: {
                    reg_email       : '<?php echo lang("lbl_not_valid"); ?>',
                    reg_password    : '<?php echo lang("lbl_required"); ?>',
                    company_limit   : '<?php echo lang("lbl_number_only"); ?>',
                    user_limit      : '<?php echo lang("lbl_number_only"); ?>',
                },
                submitHandler: function(form){
                    if( $('#reg_password').val() != $('#confirm').val() ){
                        $('#confirm').parent().parent().addClass('error');
                        $('#confirm').parent().append('<label class="error" for="confirm"><?php echo lang('lbl_confirm_password_incorrect'); ?></label>');
                    }else{
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
                                    window.location = response.href;
                                }
                            }
                        });
                    }
                }
            });
            
            $('#btnCaptcha').click(function(){
                $('.btnCaptcha').hide();
                $('.i-captcha').css({'visibility':'visible'});
                setTimeout(function(){$('.captchaImage').css({'opacity':1,'position':'relative'});$('.i-captcha').css({'visibility':'hidden'});},1000);
                return false;
            });
            
            $('#confirm').keyup(function(){
                $('#confirm').parent().parent().removeClass('error');
                $('#confirm').parent().children('label.error').remove();
            });
            
            $("#form-login").submit(function(){
                $('#msginfo').hide();
                $('#msgerror').hide();
                $('#msgalert').show();
                $('#msgalert p').text('<?php echo lang('msg_please_wait'); ?>');
                $.ajax({
                    url : $(this).attr('action'),
                    data : $(this).serialize(),
                    type : 'POST',
                    dataType : 'json',
                    success : function(response){
                        $('.msgalert').hide();
                        if(response.status == 'error'){
                            $('#msgerror').show();
                            $('#msgerror p').text(response.message);
                        }else{
                            $('#msginfo').show();
                            $('#msginfo p').text(response.message);
                            window.location = response.href;
                        }
                    }
                });
                return false;
            });
            
            $("#captcha").PuzzleCAPTCHA({
				imageURL : 'assets/img_captcha/<?php echo $captcha_image; ?>',
				rows:4,
                columns:4,
				targetButton:'#btnRegister'
			});
            
            $('#change-image').click(function(){
                $('#captcha-img').attr('src','login/captcha?'+Math.random());
                return false;
            });
            
            $('#check').click(function(){
                var captcha_text = $('#captcha-text').val();
                $.ajax({
                    url : 'login/session_captcha',
                    success : function(msg){
                        if(msg == captcha_text){
                            $('#btnRegister').removeAttr('disabled');
                            $('#message-captcha').text('<?php echo lang('lbl_valid_captcha'); ?>');
                        }else{
                            $('#message-captcha').text('<?php echo lang('lbl_invalid_captcha'); ?>');
                            setTimeout(function(){ $('#message-captcha').text(''); },2000);
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
            <div class="two_third dashboard_left">
                <div class="smartcity-logo">
                    <img src="assets/images/smartcity.png" />
                </div>
                <div class="front-images">
                    <img src="assets/images/front-image.png" />
                </div>
            </div>
            <div class="one_third last dashboard_right">
                <ul class="tabs">
            		<li class="tab-link current" data-tab="tab-1"><?php echo lang('lbl_registration'); ?></li>
            		<li class="tab-link" data-tab="tab-2"><?php echo lang('lbl_login'); ?></li>
            	</ul>

            	<div id="tab-1" class="tab-content current">
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
                    <form id="form-reg" method="post" action="send_email/registration">
                        <div class="email input-logo">
                            <div class="emailinner">
                                <input type="text" id="reg_email" name="reg_email" autocomplete="off" placeholder="<?php echo lang('lbl_email'); ?>" />
                            </div>
                        </div>
                        <div class="password input-logo">
                            <div class="passwordinner">
                                <input type="password" id="reg_password" name="reg_password" placeholder="<?php echo lang('lbl_password'); ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="password input-logo">
                            <div class="passwordinner">
                                <input type="password" id="confirm" placeholder="<?php echo lang('lbl_confirm'); ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="users input-logo">
                            <div class="usersinner">
                               <input type="text" id="company_limit" name="company_limit" placeholder="<?php echo lang('lbl_company_limit'); ?>" class="width100" autocomplete="off" />
                            </div>
                        </div>
                        <div class="username input-logo">
                            <div class="usernameinner">
                               <input type="text" id="user_limit" name="user_limit" placeholder="<?php echo lang('lbl_user_limit'); ?>" class="width100" autocomplete="off" />
                            </div>
                        </div>
                        <div class="time">
                            <div class="timeinner">
                                <div class="radiobox">
                                    <input type="radio" name="masa_aktif" id="masa_aktif1" value="bulan" checked="checked" /> 1 <?php echo lang('lbl_month'); ?> &nbsp; &nbsp;
                                    <input type="radio" name="masa_aktif" id="masa_aktif2" value="tahun" /> 1 <?php echo lang('lbl_year'); ?> &nbsp; &nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="captcha">
                            <div class="captchainner">
                                <div class="l-captcha"><?php echo lang('lbl_are_you_human'); ?>?</div>
                                <div class="btnCaptcha"><a href="#" id="btnCaptcha"><?php echo lang('lbl_click_here'); ?></a></div>
                                <div class="i-captcha"><img src="assets/images/preload.gif" /></div>
                            </div>
                        </div>
                        <?php if($captcha_type == 1){ ?>
                        <div id="captcha" class="captchaImage"></div>
                        <?php }else{ ?>
                        <div class="captchaImage">
                            <span><?php echo lang('lbl_write_the_following_word'); ?></span>
                            <img src="login/captcha" id="captcha-img" /><br />
                            <?php echo lang('lbl_not_readable'); ?>? <a id="change-image" href="#"><?php echo lang('lbl_change_text'); ?></a><br />
                            <input type="text" id="captcha-text" autocomplete="off" />
                            <br clear="all" />
                            <br clear="all" />
                            <a class="stdbtn btn_lime" id="check"><?php echo lang('lbl_check'); ?></a>
                            <br clear="all" />
                            <br clear="all" />
                            <span id="message-captcha"></span>
                        </div>
                        <?php } ?>
                        <div class="formbutton animate3 bounceInDown">
                            <button type="submit" id="btnRegister" disabled="disabled"><?php echo lang('lbl_register'); ?></button>
                        </div>
                    </form>
            	</div>
            	<div id="tab-2" class="tab-content">
                    <div class="notibar msginfo hidden" id="msginfo">
                        <a class="close"></a>
                        <p>This is an information message.</p>
                    </div>
                    <div class="notibar msgalert hidden" id="msgalert">
                        <a class="close"></a>
                        <p>This is an information message.</p>
                    </div>
                    <div class="notibar msgerror hidden" id="msgerror">
                        <a class="close"></a>
                        <p>This is an information message.</p>
                    </div>
                    <form id="form-login" method="post" action="<?php echo $controller.'/email_login'; ?>">
                        <div class="email animate1 bounceInDown">
                            <div class="emailinner">
                                <input type="text" id="email" name="email" placeholder="<?php echo lang('lbl_email'); ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="password animate2 bounceInDown">
                            <div class="passwordinner">
                                <input type="password" id="password" name="password" placeholder="<?php echo lang('lbl_password'); ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="formbutton animate3 bounceInDown">
                            <button type="submit"><?php echo lang('lbl_sign_in'); ?></button>
                        </div>
                    </form>
            	</div>    
            </div>
        </div>
    </div>
</body>
</html>