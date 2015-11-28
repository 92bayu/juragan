<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    <script type="text/javascript">
        <?php if($method=="edit"){ ?>
        function get_data(id){
            $.ajax({
                url : '<?php echo $get_data; ?>',
                data : {'id':id},
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    $('#id').val(id);
                    $('#nama').val(response.nama);
                    $('#username').val(response.username);
                    $('#id_group').val(response.id_group);
                    $('#language').val(response.language);
                    if(response.status == "1")
                        $('#status1').prop('checked',true);
                    else
                        $('#status2').prop('checked',true);
                    $.uniform.update();
                }
            });
        }
        <?php } ?>
        $(document).ready(function(){
            <?php if($method=="edit"){ ?>
            get_data(<?php echo $id; ?>);
            <?php } ?>

            $('#form').validate({
                rules: {
                    username: {required: true},
                    nama: {required: true}
                },
                messages: {
                    username: "<?php echo lang('lbl_required'); ?>",
                    nama: "<?php echo lang('lbl_required'); ?>"
                },
                submitHandler: function(form){
                    if($('#password').val() === $('#confirm').val()){
                        $('.msginfo').hide();
                        $('.msgerror').hide();
                        $('.msgalert').show();
                        $('.msgalert p').text('<?php echo lang('msg_please_wait'); ?>');
                        $.ajax({
                            url : $(form).attr('action'),
                            data : $(form).serialize(),
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
                    }else{
                        $('#confirm').addClass('error');
                        $('#confirm').parent().append('<label for="confirm" class="error" id="confirm-error"><?php echo lang('lbl_confirm_password_incorrect'); ?></label>');
                        return false;
                    }
                }
            });
            
            $('#confirm').keyup(function(){
                $(this).removeClass('error');
                $(this).parent().children('#confirm-error').remove();
            });
            
        });
        function closeBox(){
            <?php if($datatable != ""){ ?>
            parent.RefreshTable('#dyntable2','<?php echo $datatable; ?>');
            <?php }else{ ?>
            parent.reload_halaman();
            <?php } ?>
            parent.tiny.box.hide();
        }
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
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <br class="fix-header">
                <span class="pagedesc"><?php echo $title; ?></span>
            </div>
        </div><!--pageheader-->
        <div id="contentwrapper" class="contentwrapper elements">
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
            <form id="form" method="post" class="stdform stdform2" action="<?php echo $action; ?>">
                <div id="general" class="subcontent">					
                    <p>
                        <label><?php echo lang('lbl_name'); ?></label>
                        <span class="field">
                            <input type="hidden" id="id" name="id" value="" />
                            <input type="text" value="" class="longinput" autocomplete="off" autocomplete="off" name="nama" id="nama" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_username'); ?></label>
                        <span class="field">
                            <input type="text" id="username" name="username" value="" class="longinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_password'); ?></label>
                        <span class="field">
                            <input type="password" id="password" name="password" value="" class="longinput" placeholder="<?php echo lang('lbl_empty_if_not_change'); ?>" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_confirm'); ?></label>
                        <span class="field">
                            <input type="password" id="confirm" value="" class="longinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_user_group'); ?></label>
                        <span class="field">
                            <select class="mediuminput" id="id_group" name="id_group">
                                <?php foreach($user_group as $ug){ ?>
                                <option value="<?php echo $ug->id; ?>"><?php echo $ug->nama; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_language'); ?></label>
                        <span class="field">
                            <select class="mediuminput" id="language" name="language">
                                <?php foreach($language as $l){ ?>
                                <option value="<?php echo $l; ?>"><?php echo ucfirst($l); ?></option>
                                <?php } ?>
                            </select>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_status'); ?></label>
                        <span class="field">
                            <input type="radio" id="status1" name="status" value="1" checked="checked" /> <?php echo lang('lbl_active'); ?> &nbsp; &nbsp;
                            <input type="radio" id="status2" name="status" value="0" /> <?php echo lang('lbl_inactive'); ?>
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                        <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                    </p>
                </div>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>