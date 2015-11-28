<script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
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
                        location.reload();
                    }
                }
            });
        }
    });
    
 });
</script>											
    <div class="centercontent left0">
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
               	    <label><?php echo lang('lbl_name'); ?></label>
                    <span class="field"><input type="text" id="nama" name="nama" autocomplete="off" class="longinput" value="<?php echo $profile->nama; ?>" /></span>
                </p>
           	    <p>
               	    <label><?php echo lang('lbl_photo_profile'); ?></label>
                    <span class="field"><button type="button" class="submit radius2" onclick="openBox('employee/photo/<?php echo $profile->id; ?>/change_picture',825,500);return false;"><?php echo lang('lbl_change_picture'); ?></button></span>
                </p>
                <p class="stdformbutton">
               	    <button class="submit radius2" id="btn-save"><?php echo lang('lbl_save'); ?></button>
                </p>
            </form>
        </div>
        <br clear="all" />
    </div>