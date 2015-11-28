    <div class="contentwrapper padding10">
    	<div class="errorwrapper error404">
        	<div class="errorcontent">
                <h1>404 <?php echo lang('lbl_page_not_found'); ?></h1>
                <h3><?php echo lang('lbl_we_couldnt_find_that_page'); ?>.</h3>
                <p><?php echo lang('lbl_the_page_you_are_looking_for_is_not_found').'. '.lang("lbl_this_could_be_for_several_reasons"); ?></p>
                <ul>
                    <li><?php echo lang("lbl_it_never_existed"); ?></li>
                    <li><?php echo lang("lbl_it_got_deleted_for_some_reason"); ?></li>
                    <li><?php echo lang("lbl_it_was_in_maintenance"); ?></li>
                </ul>
                <br />
                <button class="stdbtn btn_black" onclick="history.back()"><?php echo lang("lbl_go_back_to_previous_page"); ?></button> &nbsp; 
                <?php if($user_nama != "No Name"){ ?>
                <button onclick="location.href='dashboard'" class="stdbtn btn_orange"><?php echo lang("lbl_go_back_to_dashboard"); ?></button>
                <?php } ?>
            </div><!--errorcontent-->
        </div><!--errorwrapper-->
    </div>