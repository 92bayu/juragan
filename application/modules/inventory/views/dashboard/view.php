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
                <h3>Stok masuk &amp; Stok Keluar Tahun Ini</h3>
            </div>
            <div class="overviewhead">
                <div id="divStatus4" class="grafik"></div>
                <script type="text/javascript">
                    var dataStatus = '<chart exportEnabled="1" caption="Stok masuk &amp; Stok Keluar Tahun Ini" xAxisName="Bulan" yAxisName="Jumlah" showValues="1" numberPrefix="" useRoundEdges="1" legendBorderAlpha="100" showBorder="0" bgColor="FFFFFF"><categories><category label="Januari" /><category label="Februari" /><category label="Maret" /><category label="April" /><category label="Mei" /><category label="Juni" /><category label="Juli" /><category label="Agustus" /><category label="September" /><category label="Oktober" /><category label="Nopember" /><category label="Desember" /></categories><dataset seriesname="Stok Masuk"><set value="35" /><set value="50" /><set value="40" /><set value="36" /><set value="45" /><set value="34" /><set value="54" /><set value="14" /><set value="94" /><set value="34" /><set value="84" /><set value="44" /></dataset><dataset seriesname="Stok Keluar"><set value="20" /><set value="30" /><set value="40" /><set value="56" /><set value="50" /><set value="44" /><set value="24" /><set value="14" /><set value="94" /><set value="74" /><set value="30" /><set value="20" /></dataset></chart>';				
                    FusionCharts.setCurrentRenderer("javascript");
                    var chart = new FusionCharts("ScrollColumn2D", "chartStatus4", "100%", "295", "0", "0");
                    chart.setXMLData(dataStatus);
                    chart.render("divStatus4");
                </script>
            </div>
            <div class="one_half dashboard_left">
                <div class="contenttitle2">
                    <h3>Produk dengan Stok minim</h3>
                </div>
                <table class="stdtable stdtablecb overviewtable2" cellspacing="0" cellpadding="0" border="0">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head1">Produk</th>
                            <th class="head0">Stok<br />(Jumlah)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Produk 1</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Produk 2</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>Produk 3</td>
                            <td>10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="one_half dashboard_right last">
                <div class="contenttitle2">
                    <h3>Jumlah Stok Produk</h3>
                </div>
                <div class="overviewhead">
                    <div id="divStatus1" class="grafik"></div>
                    <script type="text/javascript">
                        var dataStatus = '<chart caption="Jumlah Stok Produk" exportEnabled="1" showValues="1" showLabels="1" showLegend="0" pieSliceDepth="30" startingAngle="120"><set label="Produk 1" isSliced="0" value="20" /><set label="Produk 2" isSliced="0" value="10" /><set label="Produk 3" isSliced="0" value="10" /></chart>';
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