<div class="row" id="all">
    <div class="col-6" id="chart1">
        <div id="Auditchart"></div>
    </div>
    <div class="col-6" id="chart2">
        <div id="AMIUKchart"></div>
    </div>
</div>


<script type="text/javascript">
        $(function () { 
            var dataSesuai = <?php echo json_encode($data_Sesuai) ?>;
            var dataNonSesuai = <?php echo json_encode($data_NonSesuai) ?>;
            var dataOpen = <?php echo json_encode($data_Open) ?>;
            var dataProcess = <?php echo json_encode($data_Process) ?>;
            var yearNow = <?php echo json_encode($yearnow) ?>;
            
            console.log(dataSesuai);

            $('#Auditchart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Keseluruhan AMI ' + yearNow
                },
                xAxis: {
                    categories: ['Data AMI Sesuai, Tidak Sesuai, Baru, Diproses']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                plotOptions: {
                    series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                        click: function() {
                            // $.ajax({
                            //     url : "{{ url('chartSelectAMIget') }}",
                            //     type : "get",
                            //     data : "name=" + this.options.key,
                            // });
                            location.href = '/chartSelectAMIget/' +
                            this.options.key;
                        }
                        }
                    }
                    }
                },
                series: [{
                    name: 'Data Sesuai',
                    data: [{
                        y: dataSesuai,
                        key: 'Sesuai'
                    }],
                    // key: 'Indonesia'
                },{
                    name: 'Data Tidak Sesuai',
                    data: [{
                        y: dataNonSesuai,
                        key: 'NonSesuai'
                    }],
                },{
                    name: 'Data Baru',
                    data: [{
                        y: dataOpen,
                        key: 'Open'
                    }],
                },{
                    name: 'Data Diproses',
                    data: [{
                        y: dataProcess,
                        key: 'Process'
                    }],
                }]
                // series: [{
                //     name: 'Data Selesai',
                //     data: dataSelesai,
                //     key: 'Indonesia'
                // },{
                //     name: 'Data Tidak Selesai',
                //     data: dataNonSelesai,
                //     key: 'Malaysia'
                // }]
            });
        });

        var dataSesuai = <?php echo json_encode($Sesuailine) ?>;
        var dataNonSesuai = <?php echo json_encode($NonSesuailine) ?>;
        new Highcharts.chart('AMIUKchart', {
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