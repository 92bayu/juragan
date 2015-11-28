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
                    $('#keterangan').val(response.keterangan);
                    if(response.status == "1")
                        $('#status1').prop('checked',true);
                    else
                        $('#status2').prop('checked',true);
                    
                    $.each(response.akses, function(i, data){
                        $('[type="hidden"][name="id_user_akses['+data.id_menu+']"]').val(data.id);
                        if(data.act_view == 1)
                            $('[type="checkbox"][name="view['+data.id_menu+']"]').prop('checked',true);
                        if(data.act_input == 1)
                            $('[type="checkbox"][name="input['+data.id_menu+']"]').prop('checked',true);
                        if(data.act_edit == 1)
                            $('[type="checkbox"][name="edit['+data.id_menu+']"]').prop('checked',true);
                        if(data.act_delete == 1)
                            $('[type="checkbox"][name="delete['+data.id_menu+']"]').prop('checked',true);
    				});
                    $.uniform.update();
                }
            });
        }
        <?php } ?>
        $(document).ready(function(){
            <?php if($method=="edit"){ ?>
            get_data('<?php echo $id; ?>');
            <?php } ?>
            
            $('#form').validate({
                rules: {
                    nama: {required: true}
                },
                messages: {
                    nama: "<?php echo lang('lbl_required'); ?>"
                },
                submitHandler: function(form){
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
                                closeBox();
                            }
                        }
                    });
                }
            });
        });
        function closeBox(){
            parent.RefreshTable('#dyntable2','<?php echo $datatable; ?>');
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
            <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
            <br class="fix-header">
            <span class="pagedesc"><?php echo $title; ?></span>
            <ul class="hornav">
                <li class="current"><a href="#info"><?php echo lang('lbl_info'); ?></a></li>
                <?php foreach($modul as $md){ ?>
                <li><a href="#modul<?php echo $md->id; ?>"><?php if(lang('con_'.$md->target)) echo lang('con_'.$md->target); else echo $md->nama; ?></a></li>
                <?php } ?>
            </ul>            
        </div><!--pageheader-->
        <div id="contentwrapper" class="contentwrapper">
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
                <div id="info" class="subcontent">
                    <p>
                        <label><?php echo lang('lbl_name'); ?></label>
                        <span class="field">
                            <input type="hidden" name="id" id="id" value="" />
                            <input type="text" id="nama" name="nama" value="" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_description'); ?></label>
                        <span class="field">
                            <textarea id="keterangan" name="keterangan" class="longinput"></textarea>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_status'); ?></label>
                        <span class="field">
                            <input type="radio" id="status1" name="status" value="1" checked="checked" /> <?php echo lang('lbl_active'); ?> &nbsp; &nbsp;
                            <input type="radio" id="status2" name="status" value="0" /> <?php echo lang('lbl_inactive'); ?> &nbsp; &nbsp;
                        </span>
                    </p>
                </div>
                <?php foreach($modul as $md){ ?>
                <div id="modul<?php echo $md->id; ?>" class="subcontent" style="display:none;">
                    <?php foreach($menu[$md->id] as $mn){ ?>
                    <p>
                        <label><?php echo $mn->nama; ?></label>
                        <span class="field">
                            <input type="hidden" name="id_menu[]" value="<?php echo $mn->id; ?>" />
                            <input type="hidden" name="id_user_akses[<?php echo $mn->id; ?>]" />
                            <input type="checkbox" name="view[<?php echo $mn->id; ?>]" value="1"<?php if($mn->akses_view==0) echo ' disabled="disabled"'; ?> /><span<?php if($mn->akses_view==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_view'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="input[<?php echo $mn->id; ?>]" value="1"<?php if($mn->akses_input==0) echo ' disabled="disabled"'; ?> /><span<?php if($mn->akses_input==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_input'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="edit[<?php echo $mn->id; ?>]" value="1"<?php if($mn->akses_edit==0) echo ' disabled="disabled"'; ?> /><span<?php if($mn->akses_edit==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_edit'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="delete[<?php echo $mn->id; ?>]" value="1"<?php if($mn->akses_delete==0) echo ' disabled="disabled"'; ?> /><span<?php if($mn->akses_delete==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_delete'); ?> &nbsp; &nbsp;</span>
                        </span>
                    </p>
                    <?php foreach($submenu[$mn->id] as $sm){ ?>
                    <p>
                        <label><i> &nbsp; &nbsp; - <?php echo $sm->nama; ?></i></label>
                        <span class="field">
                            <input type="hidden" name="id_menu[]" value="<?php echo $sm->id; ?>" />
                            <input type="hidden" name="id_user_akses[<?php echo $sm->id; ?>]" />
                            <input type="checkbox" name="view[<?php echo $sm->id; ?>]" value="1"<?php if($sm->akses_view==0) echo ' disabled="disabled"'; ?> /><span<?php if($sm->akses_view==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_view'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="input[<?php echo $sm->id; ?>]" value="1"<?php if($sm->akses_input==0) echo ' disabled="disabled"'; ?> /><span<?php if($sm->akses_input==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_input'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="edit[<?php echo $sm->id; ?>]" value="1"<?php if($sm->akses_edit==0) echo ' disabled="disabled"'; ?> /><span<?php if($sm->akses_edit==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_edit'); ?> &nbsp; &nbsp;</span>
                            <input type="checkbox" name="delete[<?php echo $sm->id; ?>]" value="1"<?php if($sm->akses_delete==0) echo ' disabled="disabled"'; ?> /><span<?php if($sm->akses_delete==0) echo ' style="color: #ccc"'; ?>> <?php echo lang('lbl_delete'); ?> &nbsp; &nbsp;</span>
                        </span>
                    </p>
                    <?php }} ?>
                </div>
                <?php } ?>
                <p class="stdformbutton">
                    <input type="submit" class="submit radius2" name="btnSimpan" value="<?php echo lang('lbl_save'); ?>" />
                    <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                </p>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>