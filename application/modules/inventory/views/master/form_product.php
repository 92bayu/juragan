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
                    $('#jenis_barang').val(response.jenis_barang);
                    $('#min_stok').val(response.min_stok);
                    var color   = response.warna.split(',');
                    var size    = response.ukuran.split(',');
                    for(var i = 0; i < color.length; i++){
                        $('input[type="checkbox"][name="warna['+color[i]+']"]').prop('checked',true);
                    }
                    for(var i = 0; i < size.length; i++){
                        $('input[type="checkbox"][name="ukuran['+size[i]+']"]').prop('checked',true);
                    }
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
                    kode: {required: true},
                    jenis_barang: {required: true},
                    min_stok: {required: true, number: true}
                },
                messages: {
                    kode: "<?php echo lang('lbl_required'); ?>",
                    jenis_barang: "<?php echo lang('lbl_required'); ?>",
                    min_stok: "<?php echo lang('lbl_number_only'); ?>"
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
                <div id="general" class="subcontent">					
                    <p>
                        <label><?php echo lang('lbl_code'); ?></label>
                        <span class="field">
                            <input type="hidden" id="id" name="id" value="" />
                            <input type="text" id="kode" name="kode" value="" class="tinyinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_product_type'); ?></label>
                        <span class="field">
                            <input type="text" id="jenis_barang" name="jenis_barang" value="" class="longinput" autocomplete="off" />
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_color'); ?></label>
                        <span class="field">
                            <?php foreach($color as $c){ ?>
                            <span class="chk-150"><input type="checkbox" name="warna[<?php echo $c->id; ?>]" value="<?php echo $c->id; ?>" /> <?php echo $c->kategori; ?></span>
                            <?php } ?>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_size'); ?></label>
                        <span class="field">
                            <?php foreach($size as $s){ ?>
                            <span class="chk-150"><input type="checkbox" name="ukuran[<?php echo $s->id; ?>]" value="<?php echo $s->id; ?>" /> <?php echo $s->kategori; ?></span>
                            <?php } ?>
                        </span>
                    </p>
                    <p>
                        <label><?php echo lang('lbl_minimum_stock'); ?></label>
                        <span class="field">
                            <input type="text" id="min_stok" name="min_stok" value="" class="tinyinput" autocomplete="off" />
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