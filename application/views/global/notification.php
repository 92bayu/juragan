    <?php if(count($notif) == 20){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var busy = false;
            var limit = 20;
            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() > $('#messages').height() && !busy) {
				    busy = true;
                    setTimeout(function() {
                        var offset = parseInt($('#offset').text());
                        var check = offset % 20;
                        if( check == 0){
                            $('#loader').show();
            				$.ajax({
            				    url : '<?php echo $controller.'/add_notification'; ?>',
                                data : {'offset':offset,'limit':limit},
                                type : 'POST',
                                dataType : 'json',
                                success : function(response){
                                    $('#offset').text(response.offset);
                                    $('.msglist').append(response.data);
                                    if(response.data != ""){
                                        busy = false;
                                    }
                                    $('#loader').hide();
                                }
            				});
                        }
				    }, 1000);
				}	
            });
        });
    </script>
    <?php } ?>
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
            <?php if(count($notif) == 0){ ?>
            <div id="messages">
                <ul class="msglist">
                    <li>
                        <span class="no-notification"><?php echo lang('lbl_no_notification'); ?></span>
                    </li>
                </ul>
            </div>
            <?php }else{ ?>
            <div id="messages">
                <span class="hidden" id="offset">20</span>
                <ul class="msglist">
                    <?php foreach($notif as $n){
                        if($n->aksi==1){ ?>
                    <li class="read">
                    <?php }else{ ?>
                    <li>
                    <?php } ?>
                        <a href="<?php echo $n->target; ?>">
                            <span class="thumb"><img src="userdata/user/thumb/<?php echo $peg[$n->id]->thumb; ?>" alt="" width="50" /></span>
                            <span class="msgdetails">
                                <span class="name"><?php echo $peg[$n->id]->nama; ?></span>
                                <span class="msg"><?php echo $n->keterangan; ?></span>
                                <span class="time"><?php echo $waktu[$n->id]; ?></span>
                            </span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="loader-notification hidden" id="loader"><img src="assets/images/loader_horizontal.gif" /></div>
            </div>
            <?php } ?>
        </div>
        <br clear="all" />
    </div>