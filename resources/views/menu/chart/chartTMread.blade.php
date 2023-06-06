<div class="row">
    <div class="col-6">
        <div id="TMchart"></div>
    </div>
    <div class="col-6">
        <div id="TMLinechart"></div>
    </div>
</div>

<script type="text/javascript">
        $(function () { 
            var dataSelesai = <?php echo json_encode($data_Selesai) ?>;
            var dataNonSelesai = <?php echo json_encode($data_NonSelesai) ?>;
            var yearNow = <?php echo json_encode($yearnow) ?>;
            

            console.log(yearNow);

            $('#TMchart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Keseluruhan TM ' + yearNow
                },
                xAxis: {
                    categories: ['Data TM Selesai, Tidak Selesai']
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
                                    location.href = '/chartSelectTMget/' +
                                    this.options.key;
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: 'Data Selesai',
                    data: [{
                        y: dataSelesai,
                        key: 'Selesai'
                    }],
                },{
                    name: 'Data Tidak Selesai',
                    data: [{
                        y: dataNonSelesai,
                        key: 'NonSelesai'
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

        var dataSelesai = <?php echo json_encode($Selesailine) ?>;
        var dataNonSelesai = <?php echo json_encode($NonSelesailine) ?>;
        new Highcharts.chart('TMLinechart', {
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