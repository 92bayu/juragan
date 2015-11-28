<div class="bodywrapper">
   
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Master</h1>
            <span class="pagedesc"></span>
            
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
                        <col class="con0" style="width: 4%"/>
                    </colgroup>
                    <thead>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head1">Position</th>
                            <th class="head0">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head0">No</th>
                            <th class="head0">Position</th>
                            <th class="head0">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    	<tr>
                        	<td align="center">1</td>
                            <td>Supervisor</td>
                            <td class="center"><span><a href="employee/master/question/1/<?php echo $id_tipe; ?>" class="edit"><img src="http://webdev/compro/assets/images/detail.png"></a></span></td>
                        </tr>
                        <tr>
                        	<td align="center">2</td>
                            <td>Staf</td>
                            <td class="center"><span><a href="employee/master/question/2/<?php echo $id_tipe; ?>" class="edit"><img src="http://webdev/compro/assets/images/detail.png"></a></span></td>
                        </tr>
                        
                    </tbody>
                </table>
                
                <br /><br />
        </div><!--contentwrapper-->
	</div><!-- centercontent -->
</div><!--bodywrapper-->
</body>
</html>
