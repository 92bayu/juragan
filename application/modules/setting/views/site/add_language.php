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
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="assets/js/myform.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
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
                        if(response.status == "ok"){
                            $('.msginfo').show();
                            $('.msginfo p').text(response.message);
                            closeBox();
                        }
                    }
                });
                return false;
            });
        });

        function closeBox(){
            parent.reload_halaman();
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
                   	    <label><?php echo lang('lbl_language'); ?></label>
                        <span class="field">
                            <input type="text" id="language" name="language" value="" class="mediuminput" autocomplete="off" />
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <input type="submit" class="submit radius2" name="btnSimpan" value="<?php echo lang('lbl_save'); ?>" />
                        <input type="reset" class="reset radius2" value="<?php echo lang('lbl_cancel'); ?>" onclick="parent.tiny.box.hide();"/>
                    </p>
                </div>
            </form>
        </div>
        <br clear="all" />
    </div>
</body>
</html>