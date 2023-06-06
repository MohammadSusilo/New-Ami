<div id="TMchart"></div>

<script type="text/javascript">
        var dataSelesai = <?php echo json_encode($Selesailine) ?>;
        var dataNonSelesai = <?php echo json_encode($NonSelesailine) ?>;
        new Highcharts.chart('TMchart', {
            title: {
                text: 'Data Keseluruhan TM'
            },
            xAxis: {
                categories: <?php echo json_encode($label) ?>
            },
            yAxis: {
                title: {
                    text: 'Total'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [
                {
                    name: 'Data Selesai',
                    data: dataSelesai
                },{
                    name: 'Data Tidak Selesai',
                    data: dataNonSelesai
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
</script>