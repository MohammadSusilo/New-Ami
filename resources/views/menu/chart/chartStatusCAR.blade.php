<div id="chartCAR"></div>

<script type="text/javascript">
        $(function () { 
            var dataOpen = <?php echo json_encode($data_Open) ?>;
            var dataProcess = <?php echo json_encode($data_Process) ?>;
            var dataClosed = <?php echo json_encode($data_Closed) ?>;
            
            console.log(dataOpen);

            $('#chartCAR').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data CAR Open, Process, & Closed'
                },
                xAxis: {
                    categories: ['Open', 'Process', 'Closed']
                },
                yAxis: {
                    title: {
                        text: 'Rate'
                    }
                },
                series: [{
                    name: 'Data Open',
                    data: dataOpen
                },{
                    name: 'Data Process',
                    data: dataProcess
                },{
                    name: 'Data Closed',
                    data: dataClosed
                }]
            });
        });
</script>