    <div class="contentwrapper padding10">
    	<div class="errorwrapper error404">
        	<div class="errorcontent">
                <h1><?php echo lang('lbl_no_access'); ?></h1>
                <h3><?php echo lang('lbl_your_account_cant_access_this_website'); ?>.</h3>
                <p><?php echo lang('lbl_this_is_likely_to_be_caused_by_one_of_the_following'); ?></p>
                <ul>
                    <li><?php echo lang("lbl_your_account_is_not_allowed_to_access_any_content_on_this_website"); ?></li>
                    <li><?php echo lang("lbl_your_account_is_bloked_by_administrator"); ?></li>
                </ul>
                <br />
                <button class="stdbtn btn_black" onclick="window.location='logout'"><?php echo lang("lbl_sign_out"); ?></button> &nbsp; 
            </div><!--errorcontent-->
        </div><!--errorwrapper-->
    </div>