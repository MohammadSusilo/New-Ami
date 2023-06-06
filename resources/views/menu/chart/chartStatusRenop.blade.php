<div id="chartRenop"></div>

<script type="text/javascript">
        $(function () { 
            var dataAktif = <?php echo json_encode($data_Aktif) ?>;
            var dataNonAktif = <?php echo json_encode($data_NonAktif) ?>;
            
            console.log(dataAktif);

            $('#chartRenop').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Renop Aktif & Tidak Aktif'
                },
                xAxis: {
                    categories: ['Aktif', 'Tidak Aktif']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                series: [{
                    name: 'Data Aktif',
                    data: dataAktif
                },{
                    name: 'Data Tidak Aktif',
                    data: dataNonAktif
                }]
            });
        });
</script>