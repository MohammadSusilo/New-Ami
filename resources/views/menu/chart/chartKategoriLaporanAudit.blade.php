<div id="chartLaporanAudit"></div>

<script type="text/javascript">
        $(function () { 
            var dataAll = <?php echo json_encode($data) ?>;
            
            console.log(dataSelesai);

            $('#chartLaporanAudit').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Laporan Audit'
                },
                xAxis: {
                    categories: ['Keseluruhan']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                series: [{
                    name: 'Data Keseluruhan',
                    data: dataAll
                }]
            });
        });
</script>