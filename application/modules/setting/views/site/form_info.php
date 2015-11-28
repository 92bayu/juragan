<script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="templates/js/plugins/colorpicker.js"></script>
<script type="text/javascript" src="assets/js/fileupload.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    jQuery('#colorpickerholder').ColorPicker({
		flat: true,
		onChange: function (hsb, hex, rgb) {
			jQuery('#color').val('#'+hex);
		}
	});
    $('#form').validate({
        rules: {
            judul: {required: true},
            perusahaan: {required: true},
            inisial_perusahaan: {required: true},
            alamat: {required: true}
        },
        messages: {
            judul: "<?php echo lang('lbl_required'); ?>",
            perusahaan: "<?php echo lang('lbl_required'); ?>",
            inisial_perusahaan: "<?php echo lang('lbl_required'); ?>",
            alamat: "<?php echo lang('lbl_required'); ?>",
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
                        location.reload();
                    }
                }
            });
        }
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
        $('#btn-save').attr('disabled',true);
    }).on('fileuploaddone', function (e, data) {
        $('#btn-upload').text("<?php echo lang('lbl_upload'); ?>").removeAttr('disabled');
        $('#upload-icon-img').attr('src',data.result);
        $('#icon').val(data.result);
        $('#btn-save').removeAttr('disabled');
    }).on('fileuploadfail', function (e, data) {
        alert('File upload failed.');
    }).on('fileuploadalways', function() {
    });                

 });
</script>											
    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
        </div><!--pageheader-->
        <div id="contentwrapper" class="contentwrapper elements">
            <ul class="breadcrumbs">
                <?php foreach($breadcrumbs as $bc){ ?>
                <li>
                    <a href="<?php echo $bc['target']; ?>"><?php echo $bc['nama']; ?></a>
                </li>
                <?php } ?>
            </ul>
            <br />
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
            <form id="form" class="stdform stdform2" method="post" action="<?php echo $action; ?>">
           	    <p>
               	    <label><?php echo lang('lbl_title'); ?></label>
                    <span class="field"><input type="text" name="judul" id="judul" class="mediuminput" autocomplete="off" value="<?php echo $info->judul; ?>" /></span>
                </p>
                <p>
               	    <label><?php echo lang('lbl_company_name'); ?></label>
                    <span class="field"><input type="text" name="perusahaan" id="perusahaan" class="longinput" autocomplete="off" value="<?php echo $info->perusahaan; ?>" /></span>
                </p>
                <p>
               	    <label><?php echo lang('lbl_abbreviation'); ?></label>
                    <span class="field"><input type="text" name="inisial_perusahaan" id="inisial_perusahaan" class="smallinput" autocomplete="off" value="<?php echo $info->inisial_perusahaan; ?>" /></span>
                </p>
                <p>
               	    <label><?php echo lang('lbl_company_address'); ?></label>
                    <span class="field"><textarea cols="80" rows="5" name="alamat" id="alamat" class="longinput"><?php echo $info->alamat; ?></textarea></span>
                </p>        
                <p>
               	    <label><?php echo lang('lbl_logo'); ?></label>
                    <span class="field">
                        <img class="thumbnail" src="userdata/profile_site/<?php echo $info->logo; ?>" id="upload-icon-img" />
                        <label for="upload-icon" class="submit radius2 btn-upload" id="btn-upload"><?php echo lang('lbl_upload'); ?></label>
                        <input type="hidden" name="icon" id="icon" value="" />
                        <input type="hidden" name="old_icon" id="icon-old" value="<?php echo $info->logo; ?>" />
                    </span>
                </p>
                <p class="stdformbutton">
               	    <button class="submit radius2" id="btn-save"><?php echo lang('lbl_save'); ?></button>
                </p>
            </form>
            <form id="file-upload" action="upload" method="POST" enctype="multipart/form-data" style="visibility: hidden;">
                <input type="hidden" name="file" value="temp_folder">
                <input type="hidden" name="image_width" value="100">
                <input type="hidden" name="image_height" value="100">
                <input type="file" name="image" id="upload-icon"/>
            </form>
        </div>
        <br clear="all" />
    </div>