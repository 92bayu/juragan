<script type="text/javascript" src="assets/chart/FusionCharts.js"></script>
<script type="text/javascript" src="assets/chart/FusionCharts.lib.js" ></script>
<div class="bodywrapper">
   
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Employee Detail</h1>
            <span class="pagedesc">Showing Your Employee Performance</span>
            <?php if($akses['input']==1){ ?>
            <div id="pos_r">
                <?php if($popup_insert==TRUE){ ?>
                <a class="btn btn1 btn_pencil" onclick="openBox('<?php echo $this_modul . '/' . $controller . '/form_' . $method . '?method=add&';if(isset($get_spesifik)) echo $get_spesifik; ?>',825,500);return false;" href="#add">
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
            <br/>
            <?php if($id_tipe == 1) { ?>
            <fieldset>
                <legend>Employee Profile</legend>
                <dl>		
                    <dt>Name</dt>
                    <dd>Idris</dd>
                    <dt>Position</dt>
                    <dd>Supervisor</dd>
                    <dt>Jobdesc</dt>
                    <dd>Coordinating & Administration</dd>
                </dl>
                
            </fieldset>
            <?php } ?>
            <?php if($id_tipe == 2) { ?>
            <fieldset>
                <legend>Employee Profile</legend>
                <dl>		
                    <dt>Name</dt>
                    <dd>Dede</dd>
                    <dt>Position</dt>
                    <dd>Staf</dd>
                    <dt>Jobdesc</dt>
                    <dd>Productional & Operational</dd>
                </dl>
                
            </fieldset>
            <?php } ?>
            
            <br/>
            <div class="contenttitle2">
                    <h3>Report Per Day</h3>
                </div><!--contenttitle-->
                <table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" style="width: 4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head1">Date</th>
                            <th class="head0">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head1">Date</th>
                            <th class="head0">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    	<tr>
                        	<td align="center">1</td>
                            <td>24-11-2015</td>
                            <td class="center"><span><a href="employee/report/coming_soon/1" class="edit"><img src="http://webdev/compro/assets/images/detail.png"></a></span></td>
                        </tr>
                       
                    </tbody>
                </table>
        </div>
        <br clear="all" />
    </div>
    	</div>    
                
                <br /><br />
        </div><!--contentwrapper-->
	</div><!-- centercontent -->
</div><!--bodywrapper-->
</body>
</html>
