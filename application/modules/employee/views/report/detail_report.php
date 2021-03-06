<div class="bodywrapper">
   
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Monitoring</h1>
            <span class="pagedesc">Monitoring Your Employee Performance</span>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        <ul class="breadcrumbs">
                <?php foreach($breadcrumbs as $bc){ ?>
                <li>
                    <a href="<?php echo $bc['target']; ?>"><?php echo $bc['nama']; ?></a>
                </li>
                <?php } ?>
            </ul>
            <br />
                <table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" style="width: 4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head1">Name</th>
                            <th class="head0">Position</th>
                            <th class="head1">Jobdesc</th>
                            <th class="head0">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head1">Name</th>
                            <th class="head0">Position</th>
                            <th class="head1">Jobdesc</th>
                            <th class="head0">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php if($id_tipe==1) { ?>
                    	<tr>
                        	<td align="center">1</td>
                            <td>Idris</td>
                            <td>Supervisor</td>
                            <td>Coordinating & Administration</td>
                            <td class="center"><span><a href="employee/report/detail_report_user/1" class="edit"><img src="http://webdev/compro/assets/images/detail.png"></a></span></td>
                        </tr>
                    <?php } else { ?>
                    	<tr>
                        	<td align="center">1</td>
                            <td>Dede</td>
                            <td>Staff</td>
                            <td>Sales & Inventory</td>
                            <td class="center"><span><a href="employee/report/detail_report_user/1" class="edit"><img src="http://webdev/compro/assets/images/detail.png"></a></span></td>
                        </tr>
                    <?php } ?>
                     
                    </tbody>
                </table>
                
                <br /><br />
        </div><!--contentwrapper-->
	</div><!-- centercontent -->
</div><!--bodywrapper-->
</body>
</html>
