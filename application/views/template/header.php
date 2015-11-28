<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $company_initial.' | '.$title_site; ?></title>
	<link href="userdata/profile_site/<?php echo $logo_site; ?>" rel="shortcut icon" />  
    <link rel="stylesheet" href="templates/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="assets/fa/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/style.blueline.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/custom-template.css" type="text/css" />
    
    <script type="text/javascript" src="templates/js/plugins/jquery.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.smartWizard-2.0.min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jquery.alerts.js"></script>
    <script type="text/javascript" src="templates/js/plugins/jCookie.js"></script>
    <script type="text/javascript" src="templates/js/plugins/colorpicker.js"></script>
    <script type="text/javascript" src="assets/js/tinybox.js"></script>
    <script type="text/javascript" src="templates/js/custom/general.js"></script>
    <script type="text/javascript" src="templates/js/custom/tables.js"></script>
    <script type="text/javascript" src="templates/js/custom/elements.js"></script>
    <script type="text/javascript">
    
	jQuery(document).ready(function(){
		// Smart Wizard 	
  		jQuery('#wizard').smartWizard({onFinish: onFinishCallback});
      	jQuery('#wizard2').smartWizard({onFinish: onFinishCallback});
		jQuery('#wizard3').smartWizard({onFinish: onFinishCallback});
		jQuery('#wizard4').smartWizard({onFinish: onFinishCallback});
		
		function onFinishCallback(){
			jAlert('Thank You For Your Participate');
		} 
		
		jQuery(".inline").colorbox({inline:true, width: '60%', height: '500px'});
		
		jQuery('select, input:checkbox').uniform();
	});
</script>
    <script type="text/javascript">
    
        function RefreshTable(tableId, urlData){
            $.getJSON(urlData, null, function( json ){
                table = $(tableId).dataTable();
                oSettings = table.fnSettings();
                table.fnClearTable(this);
        
                for (var i=0; i<json.aaData.length; i++){
                    table.oApi._fnAddData(oSettings, json.aaData[i]);
                }
                
                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                table.aoColumnDefs = [ { "bSortable": false, "aTargets": [ 0 ] } ];
                table.fnDraw();
            });
        }
        $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings ){
            return {
                "iStart":         oSettings._iDisplayStart,
                "iEnd":           oSettings.fnDisplayEnd(),
                "iLength":        oSettings._iDisplayLength,
                "iTotal":         oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
                "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
            };
        };
        function reload_halaman(){
            location.reload();
        }
        $(document).ready(function(){
            var oTable = $('#dyntable2').dataTable({
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": '<?php echo $datatable; ?>',
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ":20,
                "fnInitComplete": function() {
                    //oTable.fnAdjustColumnSizing();
                },
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "&laquo;",
                        "sPrevious": "&lsaquo;",
                        "sLast": "&raquo;",
                        "sNext": "&rsaquo;"
                    }
                },
                "fnDrawCallback": function ( oSettings ) {
                    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                    {
                        var page = this.fnPagingInfo().iPage;
                        var perpage = this.fnPagingInfo().iLength;
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i + ( ( page * perpage ) + 1 ) );
                    }
                },
                'fnServerData': function(sSource, aoData, fnCallback){
                    $.ajax({
                        'dataType': 'json',
                        'type'    : 'POST',
                        'url'     : sSource,
                        'data'    : aoData,
                        'success' : fnCallback
                    });
                },
                "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] } ],
                "aaSorting": [[ 1, 'asc' ]]
                
                
            });
            
            //setInterval(function(){RefreshTable('#dyntable','<?php echo $datatable; ?>')}, 3000);
            
            $(document).on('click','#deleteData',function(){
                var href = $(this).attr('href');
                jConfirm('<?php echo lang('lbl_are_you_sure_to_delete_this_data'); ?>?', '<?php echo lang('lbl_confirmation'); ?>', function(r) {
                    if(r===true){
                        $.ajax({
                            url: href,
                            success : function(response){
                                jAlert(response, '<?php echo lang('lbl_result'); ?>');
                                RefreshTable('#dyntable2','<?php echo $datatable; ?>');
                            }
                        });
                    }
        		});
                return false;
            });

            $(document).on('click','#deleteReloadData',function(){
                var href = $(this).attr('href');
                jConfirm('<?php echo lang('lbl_are_you_sure_to_delete_this_data'); ?>?', '<?php echo lang('lbl_confirmation'); ?>', function(r) {
                    if(r===true){
                        $.ajax({
                            url: href,
                            success : function(response){
                                jAlert(response, '<?php echo lang('lbl_result'); ?>');
                                location.reload();
                            }
                        });
                    }
        		});
                return false;
            });
            
        });
                
    </script> 
    <noscript>
        <link rel="stylesheet" href="assets/css/no_js.css" type="text/css" />    
    </noscript>
</head>
<!-- 1 -->
<body class="<?php if(!isset($no_left_menu)) echo 'withvernav';else echo 'novernav'; ?>">
<div class="no_js">
    <div class="no_js-overlay"></div>
    <div class="no_js-box">
        <div class="message"><?php echo lang('lbl_javascript_must_be_enabled'); ?></div>
    </div>
</div>
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo"><img src="assets/images/logo.png" height="30px" style="position: absolute; margin-top: -5px;" /><span>&nbsp;</span></h1>
            <span class="slogan" style="margin-left: 175px;"><?php echo $title_site; ?></span>
            
            <br clear="all" />
            
        </div><!--left-->
        
        <div class="right">
        	<div class="notification">
                <a class="count" href="notification"><span><?php echo $notification; ?></span></a>
        	</div>
            <div class="userinfo">
            	<img src="<?php echo $user_foto; ?>" alt="" />
                <span><?php echo $user_nama; ?></span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
                <div class="avatar">
                	<a><img src="<?php echo $user_foto; ?>" alt="" /></a>
                </div><!--avatar-->
                <div class="userdata">
                	<h4><?php echo $user_nama; ?></h4>
                    <span class="email"><?php echo $user_nip; ?></span>
                    <ul>
                    	<li><a href="account/edit_profile"><?php echo lang('lbl_edit_profile'); ?></a></li>
                        <li><a href="account/account_setting"><?php echo lang('lbl_account_settings'); ?></a></li>
                        <li><a href="account/change_password"><?php echo lang('lbl_change_password'); ?></a></li>
                        <li><a href="logout"><?php echo lang('lbl_sign_out'); ?></a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
    
    
    <div class="header">
    	<ul class="headermenu">
            <?php foreach($modul as $m){ ?>
        	<li<?php if($this_modul==$m->target) echo ' class="current"'; ?>><a href="<?php echo $m->target; ?>"><span><img src="userdata/module-icon/<?php echo $m->icon; ?>" /></span><?php if(lang('con_'.strtolower(str_replace(' ','_',$m->nama)))) echo lang('con_'.strtolower(str_replace(' ','_',$m->nama)));else echo $m->nama; ?></a></li>
            <?php } ?>
        </ul>
        
        <div class="headerwidget">
        	<div class="earnings">
            	<div class="one_half">
                	<h4><?php echo lang('lbl_today'); ?></h4>
                    <h2 id="today-date">0/0/0000</h2>
                </div><!--one_half-->
                <div class="one_half last alignright">
                	<h4><?php echo lang('lbl_hour'); ?></h4>
                    <h2 id="today-hour">0:00:00</h2>
                </div><!--one_half last-->
            </div><!--earnings-->
        </div><!--headerwidget-->
        
    </div><!--header-->