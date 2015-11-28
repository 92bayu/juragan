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
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.min.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.Jcrop.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    <script type="text/javascript">
        function get_data(id){
            $.ajax({
                url : '<?php echo $get_data; ?>',
                data : {'id':id},
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    $('#id').val(id);
                    $('#icon-old').val(response.foto);
                    $('#thumb-old').val(response.thumb);
                    $('#upload-icon-img').attr('src','userdata/master-icon/'+response.icon);
                    $('.preview-photo').html('<img class="thumbnail" src="userdata/user/photo/' + response.foto + '" id="upload-icon-img" />')
                    $('.preview-container').html('<img id="preview" alt="Preview" src="userdata/user/thumb/' + response.thumb + '" />')
                    origImageVal();
                    $('#upload-icon-img').Jcrop({
                        onChange: showPreview,
                        onSelect: showPreview,
                        aspectRatio: 1
                    });
                }
            });
        }
        
        
        function origImageVal(){
      		var origImg = new Image();
            origImg.src = $('#upload-icon-img').attr('src');
            origImg.onload = function() {
                var origheight = origImg.height;
                var origwidth = origImg.width;
                $('#origheight').val(origheight);
                $('#origwidth').val(origwidth);
                $('#fakeheight').val(origheight);
                $('#fakewidth').val(origwidth);
            }
        }
          
        function showPreview(coords){
            var image_asli = $('#upload-icon-img').attr('src');
            var imgwidth = $('#upload-icon-img').width();
            var imgheight = $('#upload-icon-img').height();
            var rx = 100 / coords.w;
            var ry = 100 / coords.h;
                
            $('#preview').attr('src',image_asli).css({
                width: Math.round(rx * imgwidth) + 'px',
                height: Math.round(ry * imgheight) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
                
            $('#x').val(coords.x);
            $('#y').val(coords.y);
            $('#w').val(coords.w);
            $('#h').val(coords.h);
        }

        $(document).ready(function(){

            get_data(<?php echo $id; ?>);

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
                $('.preview-photo').html('<img class="thumbnail" src="' + data.result + '" id="upload-icon-img" />')
                $('.preview-container').html('<img id="preview" alt="Preview" src="' + data.result + '" />')
                origImageVal();
    			$('#upload-icon-img').Jcrop({
                    onChange: showPreview,
                    onSelect: showPreview,
                    aspectRatio: 1
                });
                $('#icon').val(data.result);
            }).on('fileuploadfail', function (e, data) {
                alert('File upload failed.');
            }).on('fileuploadalways', function() {
            });
            
            $('#form').submit(function(){
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
                            closeBox();
                        }
                    }
                });
                return false;
            });
            
            $('#upload-icon-img').Jcrop({
    			onChange: showPreview,
                onSelect: showPreview,
                aspectRatio: 1
            });
            
        });
        function closeBox(){
            <?php if($datatable != ""){ ?>
            parent.RefreshTable('#dyntable2','<?php echo $datatable; ?>');
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
                        <label><?php echo lang('lbl_thumbnail'); ?></label>
                        <span class="field">
                            <span id="preview-pane">
                                <span class="preview-container">
                                    <img id="preview" alt="Preview" src="userdata/user/thumb/default.png" />
                                </span>
                            </span>
                        </span>
                    </p>				
                    <p>
                        <label><?php echo lang('lbl_photo'); ?></label>
                        <span class="field">
                            <span class="preview-photo">
                                <img class="thumbnail" src="userdata/user/photo/default.png" id="upload-icon-img" />
                            </span>
                            <label for="upload-icon" class="submit radius2 btn-upload" id="btn-upload"><?php echo lang('lbl_upload'); ?></label>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="icon" id="icon" value="" />
                            <input type="hidden" name="old_icon" id="icon-old" value="default.png" />
                            <input type="hidden" name="old_thumb" id="thumb-old" value="default.png" />
                            <input type="hidden" name="x" id="x" />
							<input type="hidden" name="y" id="y" />
							<input type="hidden" name="w" id="w" />
							<input type="hidden" name="h" id="h" />
							<input type="hidden" name="origwidth" id="origwidth" />
							<input type="hidden" name="origheight" id="origheight" />
							<input type="hidden" name="fakewidth" id="fakewidth" />
							<input type="hidden" name="fakeheight" id="fakeheight" />
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
                <input type="hidden" name="image_width" value="200">
                <input type="hidden" name="image_height" value="200">
                <input type="file" name="image" id="upload-icon"/>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>