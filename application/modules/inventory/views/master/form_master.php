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
                    $('#kode').val(response.kode);
                    $('#kategori').val(response.kategori);
                    $('#keterangan').val(response.keterangan);
                    $('#urutan').val(response.urutan);
                    $('#kode_prefix').val(response.kode_prefix);
                    $('#jumlah_digit').val(response.jumlah_digit);
                    $('#target').val(response.target);
                    if(response.status == "1")
                        $('#status1').prop('checked',true);
                    else
                        $('#status2').prop('checked',true);
                    if(response.spesifik == "1"){
                        $('#spesifik').prop('checked',true);
                        $('#p-target').show();
                        $('#target').show();
                    }
                    $('#icon-old').val(response.icon);
                    $('#upload-icon-img').attr('src','userdata/master-icon/'+response.icon);
                    $.uniform.update();
                }
            });
        }
        <?php } ?>
        $(document).ready(function(){
            <?php if($method=="edit"){ ?>
            get_data(<?php echo $id; ?>);
            <?php } ?>
            $('#btn-upload').click(function(){
                $('#upload-icon').click();
            });
            $("#file-upload").fileupload({
                dataType: 'text',
                autoUpload: false,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                maxFileSize: 500000 // 5 MB
            }).on('fileuploadadd', function(e, data) {
                data.process();
            }).on('fileuploadprocessalways', function (e, data) {
                if (data.files.error) {
                    data.abort();
                    alert('Image file must be jpeg/jpg, png or gif with less than 5MB');
                } else {
                    data.submit();
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#btn-upload').text(progress + "%").attr('disabled',true);
            }).on('fileuploaddone', function (e, data) {
                $('#btn-upload').text("<?php echo lang('lbl_upload'); ?>").removeAttr('disabled');
                $('#upload-icon-img').attr('src',data.result);
                $('#icon').val(data.result);
            }).on('fileuploadfail', function (e, data) {
                alert('File upload failed.');
            }).on('fileuploadalways', function() {
            });
            
            $('#form').validate({
                rules: {
                    kode: {required: true},
                    kategori: {required: true},
                    urutan: {required: true, number: true},
                    jumlah_digit: {required: true, number: true}
                },
                messages: {
                    kode: "<?php echo lang('lbl_required'); ?>",
                    kategori: "<?php echo lang('lbl_required'); ?>",
                    urutan: "<?php echo lang('lbl_number_only'); ?>",
                    jumlah_digit: "<?php echo lang('lbl_number_only'); ?>"
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
            $('#spesifik').click(function(){
                if($(this).is(':checked')){
                    $('#p-target').show();
                    $('#target').show();
                }else{
                    $('#p-target').hide();
                    $('#target').hide();
                }
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
                        <label><?php echo lang('lbl_code'); ?></label>
                        <span class="field">
                            <input type="hidden" id="id" name="id" value="" />
                            <input type="text" id="kode" name="kode" value="<?php echo $kode; ?>" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_master'); ?></label>
                        <span class="field">
                            <input type="text" id="kategori" name="kategori" value="" class="longinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_description'); ?></label>
                        <span class="field">
                            <textarea id="keterangan" name="keterangan" class="longinput"></textarea>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_icon'); ?></label>
                        <span class="field">
                            <img class="thumbnail" src="userdata/master-icon/default.png" id="upload-icon-img" width="64px" height="64px" />
                            <label for="upload-icon" class="submit radius2 btn-upload" id="btn-upload"><?php echo lang('lbl_upload'); ?></label>
                            <input type="hidden" name="icon" id="icon" value="" />
                            <input type="hidden" name="old_icon" id="icon-old" value="default.png" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_default_code_prefix'); ?></label>
                        <span class="field">
                            <input type="text" id="kode_prefix" name="kode_prefix" value="" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_number_of_digits_after_prefix'); ?></label>
                        <span class="field">
                            <input type="text" id="jumlah_digit" name="jumlah_digit" value="0" class="smallinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_order'); ?></label>
                        <span class="field">
                            <input type="text" id="urutan" name="urutan" value="0" class="smallinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_status'); ?></label>
                        <span class="field">
                            <input type="radio" id="status1" name="status" value="1" checked="checked" /> <?php echo lang('lbl_active'); ?> &nbsp; &nbsp;
                            <input type="radio" id="status2" name="status" value="0" /> <?php echo lang('lbl_inactive'); ?>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_spesific'); ?></label>
                        <span class="field">
                            <input type="checkbox" id="spesifik" name="spesifik" value="1" /> &nbsp;
                        </span>
                    </p>
                    <p id="p-target" style="display: none;">
                        <label><?php echo lang('lbl_target'); ?></label>
                        <span class="field">
                            <input type="text" id="target" name="target" value="" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                        <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                    </p>
                </div>
            </form>
            <form id="file-upload" action="upload" method="POST" enctype="multipart/form-data" style="visibility: hidden;">
                <input type="hidden" name="file" value="temp_folder">
                <input type="hidden" name="image_width" value="64">
                <input type="hidden" name="image_height" value="64">
                <input type="file" name="image" id="upload-icon"/>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>