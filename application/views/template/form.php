<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/jquery.timepicker.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/jquery.autocomplete.css" type="text/css" />
    <?php foreach($form['data'] as $f){ 
        if(isset($f['class']) && $f['class']=="fa-select"){
        ?>
        <link rel="stylesheet" href="assets/fa/css/font-awesome.min.css" type="text/css" />
        <style>
        .fa-select {
        	font-family: sans-serif, 'FontAwesome';
            font-size : 30px;
    	}
	   </style>
    <?php }} ?>
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="assets/js/jquery.timepicker.min.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <?php for($i=0;$i<count($form['data']);$i++){
        if($form['data'][$i]['type']=="autocomplete_custom"){ ?>
    <script type="text/javascript" src="assets/js/jquery.autocomplete.custom.js"></script>
    <?php }}
         for($i=0;$i<count($form['data']);$i++){
        if($form['data'][$i]['type']=="autocomplete"){ ?>
    <script type="text/javascript" src="assets/js/jquery.autocomplete.js"></script>
    <?php }} ?>    
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    <?php $editor="false"; foreach($form['data'] as $f){ 
        if($f['type']=='textarea' && isset($f['editor'])){
            $editor     = 'true';
            $id_editor  = $f['name'];
        ?>
        <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
                $(function(){
                    CKEDITOR.replace( '<?php echo $f['name']; ?>', {
                        toolbar: [
                        	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                        	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                        	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                        	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                        	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                        	{ name: 'styles', items: [ 'Styles', 'Format' ] },
                        	{ name: 'tools', items: [ 'Maximize' ] },
                        	{ name: 'others', items: [ '-' ] }
                        ]
                    });
                });
        </script>
    <?php }} ?>
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
                    <?php if(isset($form['relation']) && count($form['relation']) > 0){ 
                        foreach($form['relation'] as $fr){
                        ?>
                        $('#<?php echo $fr['foreign']; ?>').html(response.opt_<?php echo $fr['primary']; ?>);
                    <?php }} ?>
                    <?php foreach($form['data'] as $f){ 
                        if($f['type']=='text' || $f['type']=='textarea'){
                        ?>
                        $('#<?php echo $f['name']; ?>').val(response.<?php echo $f['name']; ?>);
                        <?php }elseif($f['type']=='autocomplete' || $f['type']=="autocomplete_custom"){ ?>
                        $('#<?php echo $f['name']; ?>').val(response.<?php echo $f['name']; ?>);
                        $('#id_<?php echo $f['name']; ?>').val(response.id_<?php echo $f['name']; ?>);
                        <?php }elseif($f['type']=='select'){ 
                            if(!isset($f['multiple'])){ ?>
                        $('#<?php echo $f['name']; ?>').val(response.<?php echo $f['name']; ?>);
                            <?php }else{ ?>
                        var <?php echo $f['name']; ?> = response.<?php echo $f['name']; ?>;
                        $.each(<?php echo $f['name']; ?>, function( index, value ) {
                            $('#<?php echo $f['name']; ?> option[value="'+value+'"]').prop('selected',true);
                        });	
                        <?php }}elseif($f['type']=='radio'){ 
                            $i=1; foreach($f['chose'] as $c){ 
                                if($i==1){ ?>
                                if(response.<?php echo $f['name']; ?> == "<?php echo $c['value']; ?>")
                                <?php }else{ ?>
                                else if(response.<?php echo $f['name']; ?> == "<?php echo $c['value']; ?>")
                                <?php } ?>
                                $('#<?php echo $f['name'].$i; ?>').prop('checked',true);
                        <?php $i++; }}elseif($f['type']=='checkbox'){ 
                            foreach($f['chose'] as $c){ ?>
                                if(response.<?php echo $c['name']; ?> == "<?php echo $c['value']; ?>")
                                $('#<?php echo $c['name']; ?>').prop('checked',true);
                        <?php }}elseif($f['type']=='photo'){ ?>
                        $('#icon-old').val(response.<?php echo $f['name']; ?>);
                        $('#upload-icon-img').attr('src','<?php echo $f['location']; ?>'+response.<?php echo $f['name']; ?>);
                        <?php }elseif($f['type']=='file'){ ?>
                        if(response.<?php echo $f['name']; ?> != ""){
                            $('#dokumen-file').val(response.<?php echo $f['name']; ?>);
                            $('#old_dokumen').val(response.<?php echo $f['name']; ?>);
                            $('.file-name').html('<a href="<?php echo 'download/download_file/'; ?>'+response.<?php echo $f['name']; ?>+'/<?php echo $f['folder']; ?>">'+response.<?php echo $f['name']; ?>+'</a>');
                            $('.file-image span').text('<?php $pecah = explode('.',$f['name']); echo $pecah[count($pecah)-1]; ?>');
                            $('.file-box').show();
                        }
                    <?php }} ?>
                    $.uniform.update();
                }
            });
        }
        <?php } ?>                                
        
        $(document).ready(function(){
            <?php if($method=="edit"){ ?>
            get_data(<?php echo $id; ?>);
            <?php } 
            for($i=0;$i<count($form['data']);$i++){
                if($form['data'][$i]['type']=="photo"){ ?>
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
            <?php }}
            
            for($i=0;$i<count($form['data']);$i++){
                if($form['data'][$i]['type']=="file"){ ?>
            $("#file-upload2").fileupload({
        		dataType: 'text',
                autoUpload: false,
                <?php if(isset($form['data'][$i]['filter'])){ ?>
                acceptFileTypes: /(\.|\/)(<?php echo str_replace(',','|',$form['data'][$i]['filter']); ?>)$/i,
                <?php } ?>
                maxFileSize: 10000000000000 // 1 GB
            }).on('fileuploadadd', function(e, data) {
                data.process();
            }).on('fileuploadprocessalways', function (e, data) {
                if (data.files.error) {
                    data.abort();
                    alert('File must be<?php if(isset($form['data'][$i]['filter'])) echo ' '.$form['data'][$i]['filter'].' with'; ?> less than 1GB');
                } else {
                    data.submit();
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
    			$('#btn-upload.btn-file').text(progress + "%").attr('disabled',true);
            }).on('fileuploaddone', function (e, data) {
                $('#btn-upload.btn-file').text("<?php echo lang('lbl_upload'); ?>").removeAttr('disabled');
                $('#dokumen').val(data.result);
                var base = new String(data.result).substring(data.result.lastIndexOf('/') + 1); 
                if(base.lastIndexOf("__") != -1)
                    base = base.substring(base.lastIndexOf("__") + 1);
                var ext = base.split('.');
                $('.file-name').html('<a href="<?php echo 'download/download_temp?temp='; ?>'+data.result+'">'+base+'</a>');
                $('.file-image span').text(ext[1]);
                $('.file-box').show();
            }).on('fileuploadfail', function (e, data) {
                alert('File upload failed.');
            }).on('fileuploadalways', function() {
            });
            <?php }}
            
            for($i=0;$i<count($form['data']);$i++){
                if($form['data'][$i]['type']=="autocomplete" || $form['data'][$i]['type']=="autocomplete_custom"){ ?>
                $('#<?php echo $form['data'][$i]['name']; ?>').autocomplete<?php if($form['data'][$i]['type']=="autocomplete") echo 2; ?>({
            		serviceUrl: '<?php echo $form['data'][$i]['target']; ?>',
                    onSelect: function (suggestion) {
                        $('#id_<?php echo $form['data'][$i]['name']; ?>').val(suggestion.data);
                        $("#<?php echo $form['data'][$i]['name']; ?>").css({'background':'#fff'});
    	           }
                });	
            <?php }} ?>
            
            $(document).on('focus','.datepicker',function(){
                $( this ).datepicker({dateFormat : 'dd-mm-yy'});
            });

            $(document).on('focus','.timeformat',function(){
                $( this ).timepicker({timeFormat : 'HH:mm:ss'});
            });
                        
            <?php if(isset($form['relation']) && count($form['relation']) > 0){ 
                foreach($form['relation'] as $fr){
                ?>
                $('#<?php echo $fr['primary']; ?>').change(function(){
                    $.ajax({
                        url : '<?php echo $fr['url_ajax']; ?>' + $(this).val(),
                        success : function(msg){
                            $('#<?php echo $fr['foreign']; ?>').html(msg);
                        }
                    });
                });
            <?php }} ?>
            
            $('#form').validate({
                rules: {
                    <?php for($i=0;$i<count($form['data']);$i++){
                        if(isset($form['data'][$i]['validation'])){ 
                            echo $form['data'][$i]['name'].' :{ required: true,';
                            if(isset($form['data'][$i]['validation']['email'])){
                                echo 'email: true,';
                            }
                            if(isset($form['data'][$i]['validation']['number'])){
                                echo 'number: true,';
                            }
                            echo '},';
                        }} ?>
                },
                messages: {
                    <?php for($i=0;$i<count($form['data']);$i++){
                        if(isset($form['data'][$i]['validation'])){ 
                           if(isset($form['data'][$i]['validation']['message'])){
                                echo $form['data'][$i]['name'] . ' : "' . $form['data'][$i]['validation']['message'] . '",';
                            } 
                        }} ?>
                },
                submitHandler: function(form){
                    $('.msginfo').hide();
                    $('.msgerror').hide();
                    $('.msgalert').show();
                    $('.msgalert p').text('<?php echo lang('msg_please_wait'); ?>');
                    <?php if($editor == 'true'){ ?>
                    var value = CKEDITOR.instances['<?php echo $id_editor; ?>'].getData();
                    var value = value.replace(/\&/g,'|and|');
                    <?php } ?>
                    $.ajax({
                        url : $(form).attr('action'),
                        data : $(form).serialize()<?php if($editor == 'true'){ echo '+"&'.$id_editor.'="+value'; } ?>,
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
                                <?php if(isset($next_page)){ ?>
                                window.location = response.href;
                                <?php }else{ ?>
                                closeBox();
                                <?php } ?>
                            }
                        }
                    });
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
                <br class="fix-header" />
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
                <?php foreach($form['data'] as $f){ ?>
                <p>
               	    <label><?php echo $f['label']; ?></label>
                    <span class="field">
                        <?php if($f['type']=='text' || $f['type']=='password'){ ?>
                        <input type="<?php echo $f['type']; ?>" name="<?php echo $f['name']; ?>" id="<?php echo $f['name']; ?>" value="<?php if(isset($f['date'])) echo date('d-m-Y') ; else{ if(isset($f['value'])) echo $f['value']; } ?>" class="<?php if(isset($f['class'])) echo $f['class']; else echo 'mediuminput' ?><?php if(isset($f['date'])) echo ' datepicker'; ?><?php if(isset($f['time'])) echo ' timeformat'; ?>"<?php if(isset($f['disabled'])) echo ' disabled="disabled"';if(isset($f['placeholder'])) echo ' placeholder="'.$f['placeholder'].'"';if(isset($f['readonly'])) echo ' readonly="readonly"'; ?> autocomplete="off" />
                        <?php }elseif($f['type']=='autocomplete' || $f['type']=='autocomplete_custom'){ ?>
                        <input type="text" name="<?php echo $f['name']; ?>" id="<?php echo $f['name']; ?>" class="<?php if(isset($f['class'])) echo $f['class']; else echo 'mediuminput' ?>" autocomplete="off" placeholder="<?php echo lang('lbl_type_autocomplete'); ?>" />
                        <input type="hidden" name="id_<?php echo $f['name']; ?>" id="id_<?php echo $f['name']; ?>" />
                        <?php }elseif($f['type']=="textarea"){ ?>
                        <textarea name="<?php echo $f['name']; ?>" id="<?php echo $f['name']; ?>" class="<?php if(isset($f['class'])) echo $f['class']; else echo 'mediuminput' ?>"<?php if(isset($f['disabled'])) echo ' disabled="disabled"'; ?>><?php if(isset($f['value'])) echo $f['value']; ?></textarea>
                        <?php }elseif($f['type']=="select"){ ?>
                        <select name="<?php echo $f['name']; ?><?php if(isset($f['multiple'])) echo '[]'; ?>" id="<?php echo $f['name']; ?>" class="<?php if(isset($f['class'])) echo $f['class']; else echo 'mediuminput' ?>"<?php if(isset($f['multiple'])) echo ' multiple="multiple"'; if(isset($f['disabled'])) echo ' disabled="disabled"'; ?>>
                            <?php foreach($f['data'] as $dt){ ?>
                            <option value="<?php echo $dt->$f['opt_value']; ?>"<?php if(isset($f['value']) && $dt->$f['opt_value'] == $f['value']) echo ' selected="selected"'; ?>><?php echo $dt->$f['opt_label']; ?></option>
                            <?php } ?>                                                        
                        </select>
                        <?php }elseif($f['type']=="file"){ ?>
                            <span class="file-box">
                                <span class="file-image">
                                    <span>rar</span>
                                </span>
                                <span class="file-name">
                                    default.rar
                                </span>
                            </span>
                            <label for="upload-file" class="submit radius2 btn-upload btn-file" id="btn-upload" style="margin: 0; margin-left: 18px;"><?php echo lang('lbl_upload'); ?></label>
                            <input type="hidden" name="file" id="dokumen" class="form-control" />
                            <input type="hidden" name="old_file" id="old_dokumen" class="form-control" />
                        <?php }elseif($f['type']=="photo"){ ?>
                        <img class="thumbnail" src="<?php echo $f['location']; ?>default.png" id="upload-icon-img" />
                        <label for="upload-icon" class="submit radius2 btn-upload" id="btn-upload"><?php echo lang('lbl_upload'); ?></label>
                        <input type="hidden" name="icon" id="icon" value="" />
                        <input type="hidden" name="old_icon" id="icon-old" value="default.png" />
                        <?php }elseif($f['type']=="checkbox"){
                            foreach($f['chose'] as $c){
                            ?>
                            <input type="checkbox" name="<?php echo $c['name']; ?>" id="<?php echo $c['name']; ?>" value="<?php echo $c['value']; ?>"<?php if(isset($c['checked'])&&$c['checked']===TRUE) echo ' checked="checked"'; ?><?php if(isset($c['disabled'])&&$c['disabled']===TRUE) echo ' disabled="disabled"'; ?>/> <?php echo $c['label']; ?> &nbsp; &nbsp;
                            <?php } ?>
                        <?php }elseif($f['type']=="radio"){ 
                            $i=1;
                            foreach($f['chose'] as $c){
                            ?>
                        <input type="radio" name="<?php echo $f['name']; ?>" id="<?php echo $f['name'].$i; ?>" value="<?php echo $c['value']; ?>"<?php if(isset($c['checked'])&&$c['checked']===TRUE) echo ' checked="checked"'; ?>/>
                        <?php echo $c['label']; ?> &nbsp; &nbsp;
                        <?php $i++;}} ?>
                    </span>
                </p>
                <?php } ?>
                <p class="stdformbutton">
                    <input type="hidden" name="id" id="id" />
                    <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                    <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                </p>
            </form>
            <?php for($i=0;$i<count($form['data']);$i++){
                if($form['data'][$i]['type']=="photo"){ ?>
            <form id="file-upload" action="upload" method="POST" enctype="multipart/form-data" style="visibility: hidden;">
                <input type="hidden" name="file" value="temp_folder">
                <input type="hidden" name="image_width" value="<?php echo $form['data'][$i]['width']; ?>"/>
                <input type="hidden" name="image_height" value="<?php echo $form['data'][$i]['height']; ?>"/>
                <input type="file" name="image" id="upload-icon"/>
            </form>
            <?php }} 
            for($i=0;$i<count($form['data']);$i++){
                if($form['data'][$i]['type']=="file"){ ?>
            <form id="file-upload2" action="upload/upload_file" method="POST" enctype="multipart/form-data" style="visibility: hidden;">
                <input type="file" name="file" id="upload-file" />
                <input type="hidden" name="dokumen" value="dokumen"/>
            </form>
            <?php }} ?>
        </div>
        <br clear="all" />
    </div>
</body>
</html>