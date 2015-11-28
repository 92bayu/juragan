<script type="text/javascript" src="assets/chart/FusionCharts.js"></script>
<script type="text/javascript" src="assets/chart/FusionCharts.lib.js" ></script>
<div class="bodywrapper">
   
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Employee Detail</h1>
            <span class="pagedesc">Showing Your Employee Performance</span>
            
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
            <?php if($id_user == 1) { ?>
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
            <?php if($id_user == 2) { ?>
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
            <?php if($id_user == 3) { ?>
            <fieldset>
                <legend>Employee Profile</legend>
                <dl>		
                    <dt>Name</dt>
                    <dd>Agung</dd>
                    <dt>Position</dt>
                    <dd>Staf</dd>
                    <dt>Jobdesc</dt>
                    <dd>Sales & Inventory</dd>
                </dl>
                
            </fieldset>
            <?php } ?>
            <?php if($id_user == 4) { ?>
            <fieldset>
                <legend>Employee Profile</legend>
                <dl>		
                    <dt>Name</dt>
                    <dd>Devan</dd>
                    <dt>Position</dt>
                    <dd>Staf</dd>
                    <dt>Jobdesc</dt>
                    <dd>Sales & Inventory</dd>
                </dl>
                
            </fieldset>
            <?php } ?>
            <?php if($id_user == 5) { ?>
            <fieldset>
                <legend>Employee Profile</legend>
                <dl>		
                    <dt>Name</dt>
                    <dd>MIP</dd>
                    <dt>Position</dt>
                    <dd>Staf</dd>
                    <dt>Jobdesc</dt>
                    <dd>Sales & Inventory</dd>
                </dl>
                
            </fieldset>
            <?php } ?>
            <br/>
            <div class="contenttitle2">
                    <h3>Questionnaire Poin</h3>
                </div><!--contenttitle-->
                <br />
                <div class="progress">
                    <div class="bar2"><div class="value bluebar" style="width: 100%;">Good</div></div>
                </div><!--progress-->   
            <div class="contenttitle2">
                <h3>Penilaian Karyawan Per Bulan</h3>
            </div>
            <div class="overviewhead">
                <div id="divStatus4" class="grafik"></div>
                <script type="text/javascript">
                    var dataStatus = '<chart exportEnabled="1" caption="Penilaian Umum &amp; Penilaian Khusus Tahun Ini" xAxisName="Bulan" yAxisName="Jumlah" yaxismaxvalue="216" showValues="1" numberPrefix="" useRoundEdges="1" legendBorderAlpha="100" showBorder="0" bgColor="FFFFFF"><categories><category label="Januari" /><category label="Februari" /><category label="Maret" /><category label="April" /><category label="Mei" /><category label="Juni" /><category label="Juli" /><category label="Agustus" /><category label="September" /><category label="Oktober" /><category label="Nopember" /><category label="Desember" /></categories><dataset seriesname="Penilaian Umum"><set value="35" /><set value="50" /><set value="40" /><set value="36" /><set value="45" /><set value="34" /><set value="54" /><set value="14" /><set value="94" /><set value="34" /><set value="84" /><set value="44" /></dataset><dataset seriesname="Penilaian Khusus"><set value="20" /><set value="30" /><set value="40" /><set value="56" /><set value="50" /><set value="44" /><set value="24" /><set value="14" /><set value="94" /><set value="74" /><set value="30" /><set value="20" /></dataset><trendlines><line startvalue="50" color="#1aaf5d" valueonright="1" tooltext="Minimum Poin" displayvalue="Minimum Poin" /></trendlines><trendlines><line startvalue="200" color="#1aaf5d" valueonright="1" tooltext="Poin Untuk Mendapatkan Reward" displayvalue="Reward Poin" /></trendlines></chart>';				
                    FusionCharts.setCurrentRenderer("javascript");
                    var chart = new FusionCharts("ScrollColumn2D", "chartStatus4", "100%", "295", "0", "0");
                    chart.setXMLData(dataStatus);
                    chart.render("divStatus4");
                </script>
            </div> 
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
