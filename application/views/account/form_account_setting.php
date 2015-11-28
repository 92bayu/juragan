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
               	    <label><?php echo lang('lbl_language'); ?></label>
                    <span class="field">
                        <select name="language" id="language" class="mediuminput">
                            <?php foreach($language as $l){ ?>
                                <option value="<?php echo $l; ?>"<?php if($l == $setting->language) echo ' selected="selected"'; ?>><?php echo ucfirst($l); ?></option>
                            <?php } ?>
                        </select>
                    </span>
                </p>
                <br />
                <i class="notification-form"><?php echo lang('msg_for_security_your_account').', '.lang('msg_fill_in_the_form_below').'. <b>'.lang('msg_this_form_can_only_be_inputted_one_time').'.</b>'; ?></i>
           	    <p class="top">
               	    <label><?php echo lang('lbl_question'); ?></label>
                    <span class="field"><textarea name="pertanyaan" id="pertanyaan" class="longinput"<?php if(strlen($setting->pertanyaan) > 0) echo ' disabled="disabled"'; ?>><?php echo $setting->pertanyaan; ?></textarea></span>
                </p>
           	    <p>
               	    <label><?php echo lang('lbl_answer'); ?></label>
                    <span class="field"><input type="password" name="jawaban" id="jawaban" class="longinput"<?php if(strlen($setting->jawaban) > 0) echo ' disabled="disabled"'; ?> value="<?php for($i=0;$i<strlen($setting->jawaban);$i++){echo 'x';}; ?>" /></span>
                </p>
                <p class="stdformbutton">
               	    <button class="submit radius2" id="btn-save"><?php echo lang('lbl_save'); ?></button>
                </p>
            </form>
        </div>
        <br clear="all" />
    </div>