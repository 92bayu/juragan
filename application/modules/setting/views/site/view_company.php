    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
            <?php if($akses['input']==1){ ?>
            <div id="pos_r">
                <a class="btn btn1 btn_pencil" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=add'; ?>',825,500);return false;" href="#add">
                    <span><?php echo lang('lbl_add_new'); ?></span>
                </a>
            </div>
            <?php } ?>
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
            <table class="stdtable stdtablecb" cellspacing="0" cellpadding="0" border="0">
                <colgroup>
                    <col class="con0"/>
                    <col class="con1"/>
                    <col class="con0"/>
                    <col class="con1"/>
                    <col class="con0"/>
                    <col class="con1"/>
                </colgroup>
                <thead>
                    <tr>
                        <th width="10px" class="head0"><?php echo lang('lbl_no'); ?></th>
                        <th class="head1"><?php echo lang('lbl_company'); ?></th>
                        <th class="head0"><?php echo lang('lbl_hostname'); ?></th>
                        <th class="head1"><?php echo lang('lbl_username'); ?></th>
                        <th class="head0"><?php echo lang('lbl_database'); ?></th>
                        <th width="70px" class="head1"><?php echo lang('lbl_action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach($rs as $r){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo ucfirst($r); ?></td>
                        <td><?php echo $detail_rs[$r]['hostname']; ?></td>
                        <td><?php echo $detail_rs[$r]['username']; ?></td>
                        <td><?php echo $detail_rs[$r]['database']; ?></td>
                        <td>
                            <span class="actions">
                                <?php if($akses['edit']==1){ ?>
                                <a title="<?php echo lang('lbl_edit'); ?>" href="#Edit" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=edit&company='.$r; ?>',825,500);return false;">
                                    <img src="assets/images/edit.png">
                                </a>
                                <?php }if($akses['delete']==1){ ?>
                                <a id="deleteReloadData" title="Hapus" href="<?php echo $this_modul.'/'.$controller.'/delete_'.$method.'/'.$r; ?>">
                                    <img src="assets/images/delete.png">
                                </a>
                                <?php } ?>
                            </span>
                        </td>
                    </tr>
                    <?php $i++;} ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="10px" class="head0"><?php echo lang('lbl_no'); ?></th>
                        <th class="head1"><?php echo lang('lbl_company'); ?></th>
                        <th class="head0"><?php echo lang('lbl_hostname'); ?></th>
                        <th class="head1"><?php echo lang('lbl_username'); ?></th>
                        <th class="head0"><?php echo lang('lbl_database'); ?></th>
                        <th width="70px" class="head1"><?php echo lang('lbl_action'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br clear="all" />
    </div>