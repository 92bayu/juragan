    <div class="contentwrapper padding10">
    	<div class="errorwrapper error403">
        	<div class="errorcontent">
                <h1>403 <?php echo lang('lbl_forbidden'); ?></h1>
                <h3><?php echo lang('lbl_your_dont_have_permission_to_access_this_page'); ?>.</h3>
                <p><?php echo lang('lbl_this_is_likely_to_be_caused_by_one_of_the_following'); ?></p>
                <ul>
                    <li><?php echo lang("lbl_you_are_prohibited_manage_this_page"); ?></li>
                    <li><?php echo lang("lbl_you_cant_to_see_the_content_of_this_page"); ?></li>
                </ul>
                <br />
                <button class="stdbtn btn_black" onclick="history.back()"><?php echo lang("lbl_go_back_to_previous_page"); ?></button> &nbsp; 
                <button onclick="location.href='dashboard'" class="stdbtn btn_orange"><?php echo lang("lbl_go_back_to_dashboard"); ?></button>
            </div><!--errorcontent-->
        </div><!--errorwrapper-->
    </div>