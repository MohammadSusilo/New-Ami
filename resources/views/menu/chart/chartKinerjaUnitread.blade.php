<div id="chartKinerjaUnit"></div>

<script type="text/javascript">
        $(function () { 
            var dataAll = <?php echo json_encode($data) ?>;
            var dataAktif = <?php echo json_encode($data_Aktif) ?>;
            var dataNonAktif = <?php echo json_encode($data_NonAktif) ?>;
            
            console.log(dataAll);

            $('#chartKinerjaUnit').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Unit Kerja Aktif & Tidak Aktif'
                },
                xAxis: {
                    categories: ['Keseluruhan', 'Aktif', 'Tidak Aktif']
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
                    name: 'Data Aktif',
                    data: dataAktif
                },{
                    name: 'Data Tidak Aktif',
                    data: dataNonAktif
                }]
            });
        });
</script>