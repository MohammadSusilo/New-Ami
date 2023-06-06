<div id="chartLaporanAudit"></div>

<script type="text/javascript">
        $(function () { 
            var dataSelesai = <?php echo json_encode($data_Selesai) ?>;
            var dataNonSelesai = <?php echo json_encode($data_NonSelesai) ?>;
            
            console.log(dataSelesai);

            $('#chartLaporanAudit').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Laporan Audit Selesai - Tidak Selesai'
                },
                xAxis: {
                    categories: ['Selesai', 'Tidak Selesai']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                series: [{
                    name: 'Data Selesai',
                    data: dataSelesai
                },{
                    name: 'Data Tidak Selesai',
                    data: dataNonSelesai
                }]
            });
        });
</script>