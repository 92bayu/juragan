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
    <script type="text/javascript" src="templates/js/plugins/jquery.alerts.js"></script>
    <script type="text/javascript" src="assets/js/jquery.timepicker.min.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/fileupload.min.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    
        <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
        
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
    	jAlert('Coming Soon');
    	
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
                $('#id_posisi').val(response.id_posisi);
                $('#tipe').val(response.tipe);
                $('#soal').text(response.soal);
                
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
                <h1 class="pagetitle">Daily Report</h1>
                <br class="fix-header" />
                <span class="pagedesc">Insert Daily Report</span>
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
            <form id="form" method="post" class="stdform stdform2" action="">
                 <p>
                	<label style="padding:10px;">Kesesuaian laporan pembukuan biaya dan pendapatan</label>
	                <span class="field">
	                    	<input type="radio" id="status1" name="status1" value="1" checked="true"/>Good&nbsp; &nbsp;
	                        <input type="radio" id="status2" name="status1" value="0" />Bad
	                 </span>
                 </p>
                 <p>
                	<label style="padding:10px;">Menjamin berjalannya dengan baik kinerja karyawan lain</label>
	                <span class="field">
	                    	<input type="radio" id="status3" name="status2" value="1" checked="true"/>Good&nbsp; &nbsp;
	                        <input type="radio" id="status4" name="status2" value="0" />Bad
	                 </span>
                 </p>
                 <p>
                	<label style="padding:10px;">Update informasi Medsos </label>
	                <span class="field">
	                    	<input type="radio" id="status5" name="status3" value="1" checked="true"/>Good&nbsp; &nbsp;
	                        <input type="radio" id="status6" name="status3" value="0" />Bad
	                 </span>
                 </p>
                 <p>
                	<label style="padding:10px;">Menjamin Order Yang Masuk Ditangani Tanpa Kesalahan</label>
	                <span class="field">
	                    	<input type="radio" id="status7" name="status4" value="1" checked="true"/>Good&nbsp; &nbsp;
	                        <input type="radio" id="status8" name="status4" value="0" />Bad
	                 </span>
                 </p>
                <p class="stdformbutton">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="id_posisi" id="id_posisi" />
                    <input type="hidden" name="tipe" id="tipe" />
                    <input type="submit" class="submit radius2" value="<?php echo lang('lbl_save'); ?>" />
                    <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                </p>
            </form>
            
        </div>
        <br clear="all" />
    </div>
</body>
</html>