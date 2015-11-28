<script type="text/javascript" src="templates/js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}
$(document).ready(function(){
    $('#form').validate({
        rules: {
            old_password: {required: true},
            password: {required: true}
        },
        messages: {
            old_password: "<?php echo lang('lbl_required'); ?>",
            password: "<?php echo lang('lbl_required'); ?>"
        },
        submitHandler: function(form){
            if($('#new_password').val()===$('#confirm').val()){
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
            }else{
                $('#confirm').addClass('error');
                $('#confirm').parent().append('<label for="confirm" class="error" id="confirm-error"><?php echo lang('lbl_confirm_password_incorrect'); ?></label>');
                return false;
            }
        }
    });
    
    $('#confirm').keyup(function(){
        $(this).removeClass('error');
        $(this).parent().children('#confirm-error').remove();
    });
    
    $('#old_password').keyup(function(){
        $(this).parent().children('#old_pass_error').remove();
    });
            
    $('#old_password').change(function(){
        $(this).parent().children('#old_pass_error').remove();
        if($(this).val() != ""){
            $.ajax({
                url: '<?php echo $controller; ?>/check_password',
                data: {'password':$(this).val()},
                type: 'POST',
                success: function(response){
                    if(response == 'ok'){
                        $('#new_password').removeAttr('readonly');
                        $('#confirm').removeAttr('readonly');
                        $('#old_password').removeClass('error');
                    }else{
                        $('#new_password').attr('readonly',true);
                        $('#confirm').attr('readonly',true);
                        $('#new_password').val('');
                        $('#confirm').val('');
                        $('#old_password').addClass('error');
                        $('#old_password').parent().append('<label for="confirm" class="error" id="old_pass_error"><?php echo lang('msg_old_password_invalid'); ?></label>');
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
               	    <label><?php echo lang('lbl_old_password'); ?></label>
                    <span class="field"><input type="password" id="old_password" name="old_password" class="longinput" value="" /></span>
                </p>
           	    <p>
               	    <label><?php echo lang('lbl_new_password'); ?></label>
                    <span class="field"><input type="password" id="new_password" name="password" class="longinput" readonly="readonly" value="" /></span>
                </p>
           	    <p>
               	    <label><?php echo lang('lbl_confirm'); ?></label>
                    <span class="field"><input type="password" id="confirm" class="longinput" value="" readonly="readonly" /></span>
                </p>
                <p class="stdformbutton">
               	    <button class="submit radius2" id="btn-save"><?php echo lang('lbl_save'); ?></button>
                </p>
            </form>
        </div>
        <br clear="all" />
    </div>