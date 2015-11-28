<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url(); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form1').submit(function(){
                $('#submit1 input').hide();
                $('#submit1 img').show();
                $.ajax({
                    url : $(this).attr('action'),
                    data : $(this).serialize(),
                    type : 'POST',
                    dataType : 'json',
                    success : function(response){
                        if(response.status=='ok'){
                            $('#question').text(response.question + '.');
                            $('#form1').slideUp();
                            $('#form2').slideDown();
                        }else{
                            $('#submit1 input').show();
                            $('#submit1 img').hide();
                            $('#username').addClass('error');
                            $('#username').parent().append('<label for="username" class="error" id="username-error"><?php echo lang('msg_username_invalid'); ?></label>');
                        }
                    }
                });
                return false;
            });
            $('#form2').submit(function(){
                $('#submit2 input').hide();
                $('#submit2 img').show();
                $.ajax({
                    url : $(this).attr('action'),
                    data : {'username':$('#username').val(),'jawaban':$('#jawaban').val()},
                    type : 'POST',
                    dataType : 'json',
                    success : function(response){
                        if(response.status=='ok'){
                            $('#question').text(response.question + '.');
                            $('#form2').slideUp();
                            $('#form3').slideDown();
                        }else{
                            $('#submit2 input').show();
                            $('#submit2 img').hide();
                            $('#jawaban').addClass('error');
                            $('#jawaban').parent().append('<label for="jawaban" class="error" id="jawaban-error"><?php echo lang('msg_answer_incorrect'); ?></label>');
                        }
                    }
                });
                return false;
            });
            $('#form3').validate({
                rules: {
                    password: {required: true}
                },
                messages: {
                    password: "<?php echo lang('lbl_required'); ?>"
                },
                submitHandler: function(form){
                    if($('#password').val()===$('#confirm').val()){
                        $('.msginfo').hide();
                        $('.msgerror').hide();
                        $('.msgalert').show();
                        $('.msgalert p').text('<?php echo lang('msg_please_wait'); ?>');
                        $.ajax({
                            url : $(form).attr('action'),
                            data : {'username':$('#username').val(),'password':$('#password').val()},
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
                                    parent.tiny.box.hide();
                                }
                            }
                        });
                    }else{
                        $('#confirm').addClass('error');
                        $('#confirm').parent().append('<label for="confirm" class="error" id="confirm-error"><?php echo lang('lbl_confirm_password_incorrect'); ?></label>');
                        return false;
                    }
                }
            });            
            $('#username').keyup(function(){
                $(this).removeClass('error');
                $(this).parent().children('#username-error').remove();
            });
            $('#jawaban').keyup(function(){
                $(this).removeClass('error');
                $(this).parent().children('#jawaban-error').remove();
            });
        });
    </script> 
    <noscript>
        <link rel="stylesheet" href="assets/css/no_js.css" type="text/css" />    
    </noscript>
</head>
<!-- 1 -->
<body>
    <div class="no_js">
        <div class="no_js-overlay"></div>
        <div class="no_js-box">
            <div class="message"><?php echo lang('lbl_javascript_must_be_enabled'); ?></div>
        </div>
    </div>
    <div class="bodywrapper">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo lang('lbl_forgot_your_password'); ?></h1>
                <span class="pagedesc"></span>
            </div>
        </div><!--pageheader-->
        <div id="contentwrapper" class="contentwrapper elements">
            <form id="form1" method="post" class="stdform stdform2" action="<?php echo $controller.'/check_username'; ?>">
                <div id="general" class="subcontent">					
                    <p>
                        <label><?php echo lang('lbl_username'); ?></label>
                        <span class="field">
                            <input type="text" id="username" name="username" value="" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p class="stdformbutton" id="submit1">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_check_username'); ?>" />
                        <img src="assets/images/loader.gif" class="hidden" />
                    </p>
                </div>
            </form>
            <form id="form2" method="post" class="stdform stdform2 hidden" action="<?php echo $controller.'/check_answer'; ?>">
                <i class="notification-form"><?php echo lang('lbl_please_answer_for_recovery_your_password'); ?></i>
                <div id="general" class="subcontent">					
                    <p>
                        <label><?php echo lang('lbl_question'); ?></label>
                        <span class="field" id="question">
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_answer'); ?></label>
                        <span class="field">
                            <input type="text" id="jawaban" name="jawaban" value="" class="longinput" autocomplete="off" />
                        </span>
                    </p>
                    <p class="stdformbutton" id="submit2">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_answer'); ?>" />
                        <img src="assets/images/loader.gif" class="hidden" />
                    </p>
                </div>
            </form>
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
            <form id="form3" method="post" class="stdform stdform2 hidden" action="<?php echo $controller.'/reset_password'; ?>">
                <div id="general" class="subcontent">					
                    <p>
                        <label><?php echo lang('lbl_password'); ?></label>
                        <span class="field">
                            <input type="password" id="password" name="password" value="" class="longinput" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_confirm'); ?></label>
                        <span class="field">
                            <input type="password" id="confirm" value="" class="longinput" />
                        </span>
                    </p>
                    <p class="stdformbutton" id="submit3">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_reset_password'); ?>" />
                        <img src="assets/images/loader.gif" class="hidden" />
                    </p>
                </div>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>