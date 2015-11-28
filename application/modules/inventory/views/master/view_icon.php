    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
            <div id="pos_r">
            <?php if($akses['input']==1){ ?>
                <a class="btn btn3 btn_list" title="<?php echo lang("lbl_mode_list"); ?>" href="<?php echo $this_modul.'/'.$controller.'/view_list'; ?>"></a>
                <?php if($akses['input']==1 && $akses['edit']==1){ ?>
                <a class="btn btn3 btn_settings3" title="<?php echo lang("lbl_setting"); ?>" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/setting_'.$method; ?>',825,500);return false;" href="#setting"></a>
                <?php } ?>
                <a class="btn btn3 btn_pencil" title="<?php echo lang("lbl_add_new"); ?>" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=add_';if(isset($get_spesifik)) echo $get_spesifik; ?>',825,500);return false;" href="#add">
                </a>
            <?php } ?>
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
            <?php if(count($master_general) == 0 && count($master_spesifik) == 0){ ?>
            <div class="notibar announcement">
                <a class="close"></a>
                <h3><?php echo lang('lbl_data_not_found'); ?></h3>
                <p><?php echo lang('lbl_to_add_data_click_the_pencil_icon_above'); ?>.</p>
            </div>
            <?php }if(count($master_general) > 0){ ?>
            <div class="contenttitle2">
                <h3><?php echo lang('lbl_general_master'); ?></h3>
            </div>
            <ul class="shortcuts">
                <?php foreach($master_general as $mg){ ?>
                <li>
                    <a href="<?php echo $this_modul.'/'.$controller.'/submaster?parent_id='.$mg->id; ?>">
                        <img src="userdata/master-icon/<?php echo $mg->icon; ?>" />
                        <span><?php if(lang('con_'.str_replace(' ','_',strtolower($mg->kategori))) != "") echo lang('con_'.str_replace(' ','_',strtolower($mg->kategori))) ; else echo $mg->kategori; ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php }if(count($master_spesifik) > 0){ ?>
            <br clear="all"  />
            <div class="contenttitle2">
                <h3><?php echo lang('lbl_spesific_master'); ?></h3>
            </div>
            <ul class="shortcuts">
                <?php foreach($master_spesifik as $mg){ ?>
                <li>
                    <a href="<?php echo $this_modul.'/'.$controller.'/'.$mg->target; ?>">
                        <img src="userdata/master-icon/<?php echo $mg->icon; ?>" />
                        <span><?php if(lang('con_'.str_replace(' ','_',strtolower($mg->kategori))) != "") echo lang('con_'.str_replace(' ','_',strtolower($mg->kategori))) ; else echo $mg->kategori; ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <br clear="all" />
    </div>