    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
            <?php if($akses['input']==1){ ?>
            <div id="pos_r">
                <a class="btn btn1 btn_pencil" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=add';if(isset($get_spesifik)) echo $get_spesifik; ?>',825,500);return false;" href="#add">
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
            <div class="tableoptions">
                <?php echo lang('lbl_module'); ?> : 
                <select class="radius3" onchange="window.location='<?php echo $this_modul.'/'.$controller; ?>/menu?id_modul='+this.options[this.selectedIndex].value;">
                    <?php foreach($data_modul as $dm){ ?>
                    <option value="<?php echo $dm->id; ?>"<?php if($dm->id == $id_modul) echo ' selected="selected"'; ?>><?php echo $dm->nama; ?></option>
                    <?php } ?>
                </select>
            </div>                                    
            <table class="stdtable stdtablecb" cellspacing="0" cellpadding="0" border="0">
                <colgroup>
                    <col class="con0"/>
                    <col class="con1"/>
                    <col class="con0"/>
                    <col class="con1"/>
                    <col class="con0"/>
                    <col class="con1"/>
                    <col class="con0"/>
                </colgroup>
                <thead>
                    <tr>
                        <th width="10px" class="head0"><?php echo lang('lbl_number'); ?></th>
                        <th class="head1"><?php echo lang('lbl_menu'); ?></th>
                        <th class="head0"><?php echo lang('lbl_target'); ?></th>
                        <th width="20px" class="head1"><?php echo lang('lbl_id'); ?></th>
                        <th width="20px" class="head0">#</th>
                        <th width="70px" class="head1"><?php echo lang('lbl_status'); ?></th>
                        <th width="70px" class="head0"><?php echo lang('lbl_action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach($rs as $r){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $r->nama; ?></td>
                        <td><?php echo $r->target; ?></td>
                        <td><?php echo $r->id; ?></td>
                        <td style="color: #088;"><?php echo $r->urutan; ?></td>
                        <td>
                            <?php if($r->status==0){ ?>
                            <img style="display: block;margin-left:auto;margin-right:auto;" src="assets/images/inactive.png" />
                            <?php }else{ ?>
                            <img style="display: block;margin-left:auto;margin-right:auto;" src="assets/images/active.png" />
                            <?php } ?>
                        </td>
                        <td>
                            <span class="actions">
                                <?php if($akses['edit']==1){ ?>
                                <a title="<?php echo lang('lbl_edit'); ?>" href="#Edit" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=edit&id='.$r->id; ?>',825,500);return false;">
                                    <img src="assets/images/edit.png">
                                </a> 
                                <?php }if($akses['delete']==1){ ?>
                                <a id="deleteReloadData" title="Hapus" href="<?php echo $this_modul.'/'.$controller.'/delete_'.$method.'/'.$r->id; ?>">
                                    <img src="assets/images/delete.png">
                                </a>
                                <?php } ?>
                            </span>
                        </td>
                    </tr>
                    <?php $i++;foreach($rs_detail[$r->id] as $s){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td> &nbsp; - <?php echo $s->nama; ?></td>
                        <td><?php echo $s->target; ?></td>
                        <td><?php echo $s->id; ?></td>
                        <td style="color: #f00;"><?php echo $s->urutan; ?></td>
                        <td>
                            <?php if($s->status==0){ ?>
                            <img style="display: block;margin-left:auto;margin-right:auto;" src="assets/images/inactive.png" />
                            <?php }else{ ?>
                            <img style="display: block;margin-left:auto;margin-right:auto;" src="assets/images/active.png" />
                            <?php } ?>
                        </td>
                        <td>
                            <span class="actions">
                                <?php if($akses['edit']==1){ ?>
                                <a title="<?php echo lang('lbl_edit'); ?>" href="#Edit" onclick="openBox('<?php echo $this_modul.'/'.$controller.'/form_'.$method.'?method=edit&id='.$s->id; ?>',825,500);return false;">
                                    <img src="assets/images/edit.png">
                                </a> 
                                <?php }if($akses['delete']==1){ ?>
                                <a id="deleteReloadData" title="Hapus" href="<?php echo $this_modul.'/'.$controller.'/delete_'.$method.'/'.$s->id; ?>">
                                    <img src="assets/images/delete.png">
                                </a>
                                <?php } ?>
                            </span>
                        </td>
                    </tr>
                    <?php $i++;}}if(isset($rs) && count($rs)==0){ ?>
                    <tr>
                        <td colspan="6"><?php echo lang('lbl_data_not_found'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="10px" class="head0"><?php echo lang('lbl_number'); ?></th>
                        <th class="head1"><?php echo lang('lbl_menu'); ?></th>
                        <th class="head0"><?php echo lang('lbl_target'); ?></th>
                        <th width="20px" class="head1"><?php echo lang('lbl_id'); ?></th>
                        <th width="20px" class="head1">#</th>
                        <th width="70px" class="head0"><?php echo lang('lbl_status'); ?></th>
                        <th width="70px" class="head1"><?php echo lang('lbl_action'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br clear="all" />
    </div>
