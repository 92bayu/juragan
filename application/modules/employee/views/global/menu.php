    <div class="vernav2 iconmenu">
        <ul>
            <?php foreach($menu as $m){ ?>
            <li<?php if($m['id']==$current_id) echo ' class="current"'; ?>>
                <?php if(isset($m['submenu'])){ ?>
                <a href="#<?php echo $m['id']; ?>">
                <?php }else{ ?>
                <a href="<?php echo $this_modul . '/' . $m['target']?>">
                <?php } ?>
                    <img src="userdata/menu-icon/<?php echo $m['icon']; ?>" style="float:left; margin-right:5px;" width="20" height="20" />
                    <span><?php if(lang($m['target'])) echo lang($m['target']); else echo $m['menu']; ?></span>
                </a>
                <?php if(isset($m['submenu'])){ ?>
                <span class="arrow"></span>
                <ul id="<?php echo $m['id']; ?>">
                    <?php foreach($m['submenu'] as $sm){ ?>
                    <li<?php if(isset($this_menu) && $sm['id']==$this_menu) echo ' class="current"' ?>>
                        <a href="<?php echo $this_modul . '/' . $m['target'] . '/' . $sm['target']; ?>">
                            <img src="userdata/menu-icon/<?php echo $sm['icon']; ?>" style="float:left; margin-left:5px; margin-right:5px;" width="20" height="20" /><?php if(lang($sm['target'])) echo lang($sm['target']); else echo $sm['menu']; ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </li>
            <?php } ?>
            <a class="togglemenu"></a>
        </ul>
    </div>