    <?php if(isset($relasi)){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php $i=1;foreach($relasi as $r){ ?>
            $('#d<?php echo $i; ?>').change(function(){
                var page_relasi = '<?php echo $this_modul.'/'.$controller.'/'.$method; ?>';
                <?php $j=1;foreach($relasi as $s){ 
                    if($j==1){ ?>
                    page_relasi += '?d<?php echo $j; ?>='+$('#d<?php echo $j; ?>').val();
                    <?php }else{ ?>
                    page_relasi += '&d<?php echo $j; ?>='+$('#d<?php echo $j; ?>').val();
                    <?php } ?>
                <?php $j++; } ?>
                window.location = page_relasi;
            });
            <?php $i++; } ?>
        });
    </script>
    <?php } ?>

    <div class="centercontent">
        <div class="pageheader notab">
            <div>
                <h1 class="pagetitle"><?php echo $menu_name['nama']; ?></h1>
                <span class="pagedesc"><?php echo $menu_name['keterangan']; ?></span>
            </div>
            <?php if($akses['input']==1){ ?>
            <div id="pos_r">
                <?php if($popup_insert==TRUE){ ?>
                <a class="btn btn1 btn_pencil" onclick="openBox('<?php echo $this_modul . '/' . $controller . '/form_' . $method . '?method=add'.'&id_ques='.$id_ques;if(isset($get_spesifik)) echo $get_spesifik; ?>',825,500);return false;" href="#add">
                <?php }else{ ?>
                <a class="btn btn1 btn_pencil" href="<?php echo $this_modul . '/' . $controller . '/form_' . $method . '?method=add';if(isset($get_spesifik)) echo $get_spesifik; ?>">
                <?php } ?>
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
            <fieldset>
                <legend>Question</legend>
               
                <dl>
                    <?php echo $question->soal; ?>
                </dl>
            </fieldset>
            <br />
            <?php  if(isset($relasi)){ ?>
            <div class="tableoptions">
            <?php $i=1;foreach($relasi as $r){ 
                echo $r['label'];
                ?> :
            <select id="d<?php echo $i; ?>">
                <?php foreach($r['data'] as $s){ ?>
                <option value="<?php if(isset($r['opt_value'])) echo $s->$r['opt_value'];else echo $s; ?>"<?php if(isset($r['opt_value'])){if($s->$r['opt_value']==$r['current']) echo ' selected="selected"';}else{if($s==$r['current']) echo ' selected="selected"';}; ?>><?php if(isset($r['opt_label'])) echo $s->$r['opt_label'];else echo $s; ?></option>
                <?php } ?>
            </select> &nbsp; 
            <?php $i++;} ?>
            </div>
            <?php } ?>
            
            <?php echo $table; ?>
        </div>
        <br clear="all" />
    </div>