<div id="AMIchart"></div>

<script type="text/javascript">
        var dataSesuai = <?php echo json_encode($Sesuailine) ?>;
        var dataNonSesuai = <?php echo json_encode($NonSesuailine) ?>;
        new Highcharts.chart('AMIchart', {
            title: {
                text: 'Data Keseluruhan AMI'
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
                    name: 'Data Sesuai',
                    data: dataSesuai
                },{
                    name: 'Data Tidak Sesuai',
                    data: dataNonSesuai
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