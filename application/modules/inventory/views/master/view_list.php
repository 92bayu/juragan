    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
            <div id="pos_r">
            <?php if($akses['input']==1){ ?>
                <a class="btn btn3 btn_help" title="<?php echo lang("lbl_mode_icon"); ?>" href="<?php echo $this_modul.'/'.$controller.'/view_icon'; ?>"></a>
                <?php if($akses['input']==1 && $akses['edit']==1){ ?>
                <a class="btn btn3 btn_settings3" title="<?php echo lang("lbl_setting"); ?>" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/setting_'.$method; ?>',825,500);return false;" href="#setting"></a>
                <?php } ?>
                <a class="btn btn3 btn_pencil" title="<?php echo lang("lbl_add_new"); ?>" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=add';if(isset($get_spesifik)) echo $get_spesifik; ?>',825,500);return false;" href="#add">
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
            <?php echo $table; ?>
        </div>
        <br clear="all" />
    </div>