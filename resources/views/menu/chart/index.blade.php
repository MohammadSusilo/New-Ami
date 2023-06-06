@extends('layouts.myapp')
@section('title', 'Report ~ Chart')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chart</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Report</li>
              <li class="breadcrumb-item active">Chart</li>
            </ol>
          </div>   
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Chart</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- ALL CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Data Perbandingan</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                        <!-- <i class="fas fa-minus"></i> -->
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <div class="row">
                        <div class="col-6 col-md-6 text-center">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Dokumen Induk, Checklist, Acuan
                          </h3>
                          <canvas id="dokChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Renop, Kinerja Unit, Bukti Kinerja
                          </h3>
                          <canvas id="renstraRenopChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            AMI
                          </h3>
                          <canvas id="amipieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Tinjauan Manajemen
                          </h3>
                          <canvas id="tmpieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!--  Dokumen Induk, Dokumen Checklist, Dokumen Acuan, Renop, Kinerja, Bukti Kinerja, Jadwal Audit, Laporan Audit, CAR, Jadwal TM, Bahan TM, Hasil TM, Tindak Lanjut TM CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title"> Dokumen Induk, Dokumen Checklist, Dokumen Acuan, Renop, Kinerja, Bukti Kinerja, Jadwal Audit, Laporan Audit, CAR, Jadwal TM, Bahan TM, Hasil TM, Tindak Lanjut TM</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="AllChart"></div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <!--This page plugins -->
    {{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/chartJS.min.js') }}"></script>

    <!--<script src="{{ asset('js/highchart.js') }}"></script>-->
    <!--<script src="{{ asset('js/papaparse.js') }}"></script>-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!--<script src="https://rawgit.com/mholt/PapaParse/master/papaparse.js"></script>-->

    <script>
      $(function () {
        //-------------
        //- PIE CHART -
        //-------------

              //DOKUMEN
                var dokumen        = {
                  labels: [
                      'Dokumen Induk',
                      'Dokumen Checklist',
                      'Dokumen Acuan',
                  ],
                  datasets: [
                    {
                      data: <?php echo json_encode($dokumen); ?>,
                      backgroundColor : ['#f56954', '#00c0ef'],
                    }
                  ]
                }

                //Dokumen
                  var pieChartCanvas = $('#dokChart').get(0).getContext('2d')
                  var pieData        = dokumen;
                  var pieOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                  }
                  //Create pie or douhnut chart
                  // You can switch between pie and douhnut using the method below.
                  new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                  })

              //Renop
                var renstraRenops        = {
                  labels: [
                      'Renop',
                      'Kinerja Unit',
                      'Bukti Kinerja',
                  ],
                  datasets: [
                    {
                      data: <?php echo json_encode($renstraRenop); ?>,
                      backgroundColor : ['#f56954', '#00c0ef', '#00a65a', '#f39c12'],
                    }
                  ]
                }

                //Renstra Renop
                  var pieChartCanvas = $('#renstraRenopChart').get(0).getContext('2d')
                  var pieData        = renstraRenops;
                  var pieOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                  }
                  //Create pie or douhnut chart
                  // You can switch between pie and douhnut using the method below.
                  new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                  })
                

              
              //AMI
                var ami        = {
                  labels: [
                      'Jadwal Audit',
                      'Laporan Audit',
                      'CAR',
                  ],
                  datasets: [
                    {
                      data: <?php echo json_encode($ami); ?>,
                      backgroundColor : ['#f56954', '#00c0ef', '#00a65a'],
                    }
                  ]
                }

                //AMI
                  var pieChartCanvas = $('#amipieChart').get(0).getContext('2d')
                  var pieData        = ami;
                  var pieOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                  }
                  //Create pie or douhnut chart
                  // You can switch between pie and douhnut using the method below.
                  new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                  })


              //TM
                var tm        = {
                  labels: [
                      'Jadwal TM',
                      'Bahan TM',
                      'Laporan TM',
                      'Tindak Lanjut TM',
                  ],
                  datasets: [
                    {
                      data: <?php echo json_encode($tm); ?>,
                      backgroundColor : ['#f56954', '#00c0ef', '#00a65a', '#f39c12'],
                    }
                  ]
                }

                //TM
                  var pieChartCanvas = $('#tmpieChart').get(0).getContext('2d')
                  var pieData        = tm;
                  var pieOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                  }
                  //Create pie or douhnut chart
                  // You can switch between pie and douhnut using the method below.
                  new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                  })

      });
  </script>

  <script type="text/javascript">
      //--------------
      //- AREA CHART -
      //--------------

          //Dokumen Acuan Renop
            var dokInduk = <?php echo json_encode($dokIndukline); ?>;
            var dokCheck = <?php echo json_encode($dokCheckline); ?>;
            var dokAcuan = <?php echo json_encode($renstraline); ?>;
            var renop = <?php echo json_encode($renopline); ?>;
            var kinerja = <?php echo json_encode($kinerjaline); ?>;
            var bukti = <?php echo json_encode($buktiline); ?>;
            var jadwalAudit = <?php echo json_encode($jadwalAuditline); ?>;
            var laporanAudit = <?php echo json_encode($laporanAuditline); ?>;
            var car = <?php echo json_encode($CARline); ?>;
            var jadwalTM = <?php echo json_encode($jadwalTMline); ?>;
            var bahanTM = <?php echo json_encode($bahanTMline); ?>;
            var hasilTM = <?php echo json_encode($hasilTMline); ?>;
            var tindakTM = <?php echo json_encode($tindakTMline); ?>;

            new Highcharts.chart('AllChart', {
                title: {
                    text: 'Data Keseluruhan Master Data, AMI, & Tinjauan Manajemen'
                },
                xAxis: {
                    categories: <?php echo json_encode($label); ?>
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
                        name: 'Dokumen Induk',
                        data: dokInduk
                    },{
                        name: 'Dokumen Checklist',
                        data: dokCheck
                    },{
                        name: 'Dokumen Acuan',
                        data: dokAcuan
                    },{
                        name: 'Renop',
                        data: renop
                    },{
                        name: 'Kinerja Unit',
                        data: kinerja
                    },{
                        name: 'Bukti Kinerja',
                        data: bukti
                    },{
                        name: 'Jadwal Audit',
                        data: jadwalAudit
                    },{
                        name: 'Laporan Audit',
                        data: laporanAudit
                    },{
                        name: 'CAR',
                        data: car
                    },{
                        name: 'Jadwal TM',
                        data: jadwalTM
                    },{
                        name: 'Bahan TM',
                        data: bahanTM
                    },{
                        name: 'Hasil TM',
                        data: hasilTM
                    },{
                        name: 'Tindak Lanjut TM',
                        data: tindakTM
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
@endpush()