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
        $(document).ready(function(){
            $('#form').submit(function(){
                $('.msginfo').hide();
                $('.msgerror').hide();
                $('.msgalert').show();
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
                            parent.tiny.box.hide();
                        }
                    }
                });
                return false;
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
                    <?php foreach($setting as $sm){ ?>				
                    <p>
                        <label><?php echo $sm->attr; ?></label>
                        <span class="field">
                            <input type="hidden" id="id<?php echo $sm->id; ?>" name="id[]" value="<?php echo $sm->id; ?>" />
                            <select id="content<?php echo $sm->id; ?>" name="content[<?php echo $sm->id; ?>]" class="mediuminput" style="width:300px;">
                                <?php foreach($master as $m){ ?>
                                <option value="<?php echo $m->id; ?>"<?php if($m->id==$sm->content) echo ' selected="selected"'; ?>><?php echo $m->kategori; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                    </p>
                    <?php } ?>
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