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
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="assets/js/jquery.timepicker.min.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    
        <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
                $(function(){
                    CKEDITOR.replace( 'jawaban', {
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
    <script type="text/javascript">
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
    $(document).ready(function(){
    $('#form').submit(function() {
    	for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'json',
            success: function(response) {
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
    });
    <?php if ($method == "edit") { ?>      
    function get_data() {
        var id = getUrlParameter('id');
        $.ajax({
            url: '<?php echo $get_data; ?>',
            data: {
                'id': id
            },
            type: 'POST',
            dataType: 'json',
            success: function(response) { 
                $('#id').val(response.id);
                $('#jawaban').text(response.jawaban);
                $('#skor').val(response.skor);
                $('#id_soal').val(response.id_soal);
                
                if (response.status == "1") {
                    $('#status1').prop('checked', true);
                } else {
                    $('#status2').prop('checked', true);
                }
                $.uniform.update();
            }
        });
	}
	<?php }?>           
	   
    <?php if ($method == "edit") { ?>
    	get_data();
   	<?php } ?>    
       
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
                <h1 class="pagetitle">Answer</h1>
                <br class="fix-header" />
                <span class="pagedesc">Insert Answer Option</span>
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
                 <p>
               	    <label>Answer</label>
                    <span class="field">
                    	<textarea name="jawaban" id="jawaban" ></textarea>                            
                    </span>
                </p>
                 <p>
               	    <label>Score</label>
                    <span class="field">
                    	<input type="text" name="skor" id="skor" />                            
                    </span>
                </p>
                 <p>
                	<label>Status</label>
	                <span class="field">
	                    	<input type="radio" id="status1" name="status" value="1" checked="true"/> <?php echo lang('lbl_active'); ?> &nbsp; &nbsp;
	                        <input type="radio" id="status2" name="status" value="0" /> <?php echo lang('lbl_inactive'); ?>
	                 </span>
                 </p>
                <p class="stdformbutton">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="id_soal" id="id_soal" />               
                    <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                    <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                </p>
            </form>
            
        </div>
        <br clear="all" />
    </div>
</body>
</html>