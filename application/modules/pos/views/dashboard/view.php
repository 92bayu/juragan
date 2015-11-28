    <script type="text/javascript" src="assets/chart/FusionCharts.js"></script>
    <script type="text/javascript" src="assets/chart/FusionCharts.lib.js" ></script>
    
    <div class="centercontent">
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
            <div class="contenttitle2">
                <h3>Grafik Pendapatan Tahun Ini</h3>
            </div>
            <div class="overviewhead">
                <div id="divStatus4" class="grafik"></div>
                <script type="text/javascript">
                    var dataStatus = '<chart exportEnabled="1" caption="Grafik Pendapatan Tahun Ini" xAxisName="Bulan" yAxisName="Jumlah" showValues="1" numberPrefix="" useRoundEdges="1" legendBorderAlpha="100" showBorder="0" bgColor="FFFFFF"><categories><category label="Januari" /><category label="Februari" /><category label="Maret" /><category label="April" /><category label="Mei" /><category label="Juni" /><category label="Juli" /><category label="Agustus" /><category label="September" /><category label="Oktober" /><category label="Nopember" /><category label="Desember" /></categories><dataset seriesname="Pendapatan"><set value="35000000" /><set value="50000000" /><set value="40000000" /><set value="36000000" /><set value="45000000" /><set value="34000000" /><set value="54000000" /><set value="14000000" /><set value="94000000" /><set value="34000000" /><set value="84000000" /><set value="44000000" /></dataset></chart>';				
                    FusionCharts.setCurrentRenderer("javascript");
                    var chart = new FusionCharts("msline", "chartStatus4", "100%", "295", "0", "0");
                    chart.setXMLData(dataStatus);
                    chart.render("divStatus4");
                </script>
            </div>
            <div class="one_half dashboard_left">
                <div class="contenttitle2">
                    <h3>Transaksi Berdasarkan Pendapatan</h3>
                </div>
                <div class="overviewhead">
                    <div id="divStatusw" class="grafik"></div>
                    <script type="text/javascript">
                        var dataStatus = '<chart caption="Transaksi berdasarkan pendapatan" exportEnabled="1" showValues="1" showLabels="1" showLegend="0" pieSliceDepth="30" startingAngle="120"><set label="Produk 1" isSliced="0" value="200000000" /><set label="Produk 2" isSliced="0" value="80000000" /><set label="Produk 3" isSliced="0" value="100000000" /></chart>';
                        FusionCharts.setCurrentRenderer("javascript");
                        var chart = new FusionCharts("Pie3D", "chartStatusw", "100%", "250", "0", "0");
                        chart.setXMLData(dataStatus);
                        chart.render("divStatusw");
                    </script>
                </div>
            </div>
            <div class="one_half dashboard_right last">
                <div class="contenttitle2">
                    <h3>Transaksi Berdasarkan Jumlah</h3>
                </div>
                <div class="overviewhead">
                    <div id="divStatus1" class="grafik"></div>
                    <script type="text/javascript">
                        var dataStatus = '<chart caption="Transaksi Berdasarkan Jumlah" exportEnabled="1" showValues="1" showLabels="1" showLegend="0" pieSliceDepth="30" startingAngle="120"><set label="Produk 1" isSliced="0" value="150" /><set label="Produk 2" isSliced="0" value="200" /><set label="Produk 3" isSliced="0" value="300" /></chart>';
                        FusionCharts.setCurrentRenderer("javascript");
                        var chart = new FusionCharts("Pie3D", "chartStatus1", "100%", "250", "0", "0");
                        chart.setXMLData(dataStatus);
                        chart.render("divStatus1");
                    </script>
                </div>
            </div>
        </div>
        <br clear="all" />
    </div>