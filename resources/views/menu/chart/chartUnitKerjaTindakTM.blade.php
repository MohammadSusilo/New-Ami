<div id="chartTindakTM"></div>

<script type="text/javascript">
        $(function () { 
            var dataAll = <?php echo json_encode($data) ?>;
            var dataSelesai = <?php echo json_encode($data_Selesai) ?>;
            var dataNonSelesai = <?php echo json_encode($data_NonSelesai) ?>;
            
            console.log(dataAll);

            $('#chartTindakTM').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Tindak Lanjut TM Selesai & Tidak Selesai'
                },
                xAxis: {
                    categories: ['Keseluruhan', 'Selesai', 'Tidak Selesai']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                series: [{
                    name: 'Data Keseluruhan',
                    data: dataAll
                },{
                    name: 'Data Selesai',
                    data: dataSelesai
                },{
                    name: 'Data Tidak Selesai',
                    data: dataNonSelesai
                }]
            });
        });
</script>