@extends('layouts.myapp')
@section('title', 'AMI')
@push('css')
    <!-- This page plugins -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- File Manager -->
    <!--{{-- <style>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}</style> --}}-->
    <!--{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> --}}-->
    <!--{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" /> --}}-->

    <!-- Form Wizard -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/stepper/css/raleway-font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/stepper/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/stepper/css/style.css') }}">

    <!-- Date Picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <!-- Clock Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    
    <!-- daterange picker -->
    <!--{{-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"> --}}-->
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    <!--{{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.css') }}"></script> --}}-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>

@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>AMI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">AMI</li>
            </ol>
          </div>   
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <!--<a class="nav-link active" id="jadwalAMI-tab" data-toggle="tab" href="#jadwalAMI" role="tab" aria-controls="jadwalAMI" aria-selected="true">Jadwal Audit</a>-->
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#jadwalAMI" data-target="#jadwalAMI" aria-controls="jadwalAMI" aria-selected="true">Jadwal Audit</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="laporanAMI-tab" data-toggle="tab" href="#laporanAMI" role="tab" aria-controls="laporanAMI" aria-selected="true">Laporan Audit</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#laporanAMI" data-target="#laporanAMI" aria-controls="laporanAMI" aria-selected="true">Laporan Audit</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="CAR-tab" data-toggle="tab" href="#CAR" role="tab" aria-controls="CAR" aria-selected="false">CAR</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#CAR" data-target="#CAR" aria-controls="CAR" aria-selected="true">CAR</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!-- Instant Create -->
                  <!-- Jadwal Audit -->
                  <div id="jadwalAMI" class="tab-pane fade show active" role="tabpanel">
                  <!--<div class="tab-pane fade show active" id="jadwalAMI" role="tabpanel" aria-labelledby="jadwalAMI-tab">-->
                    @include('menu.menuInduk.submenuInduk.jadwalAudit')
                  </div>

                  <!-- Laporan Audit -->
                  <div id="laporanAMI" class="tab-pane fade" role="tabpanel">
                  <!--<div class="tab-pane fade" id="laporanAMI" role="tabpanel" aria-labelledby="laporanAMI-tab">-->
                    @include('menu.menuInduk.submenuInduk.laporanAudit')
                  </div>

                  <!-- CAR -->
                  <div id="CAR" class="tab-pane fade" role="tabpanel">
                  <!--<div class="tab-pane fade" id="CAR" role="tabpanel" aria-labelledby="CAR-tab">-->
                    @include('menu.menuInduk.submenuInduk.CAR')
                  </div>
 
                </div>
                <!-- /.card body -->    
              </div>
              <!-- /.card -->
            </div>
          </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <!--This page plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- File Manager -->
    <!--<script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>-->

    <!-- Form Wizard -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('plugins/stepper/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('plugins/stepper/js/main.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- Clock Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

    <script src="{{ asset('js/savy.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    
    <!-- date-range-picker -->
    <!--{{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}-->

    <!--{{-- <script src="{{ asset('plugins/timepicker/jquery.min.js') }}"></script> --}}-->
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    <!--{{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.js') }}"></script> --}}-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://parsleyjs.org/dist/parsley.js"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script>

    @stack('jsInstantAMI')
    @stack('jsjadwalAudit')
    @stack('jslaporanAudit')
    @stack('jsCAR')
    
    <script>
        $(document).ready(function () {
            $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
                $("#jadwalAuditTables, #auditReportsTable, #CarReportsTable").dataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": false,
                    "scrollX": true,
                });
                
            // var url = document.location.toString();
            // $(url).load(function() {
            //     if ($('#jadwalAMI').hasClass("show active")) {
            //         $('#laporanAMI').removeClass('show active');
            //         $('#CAR').removeClass('show active');
            //     } else if ($('#laporanAMI').hasClass("show active")) {
            //         $('#jadwalAMI').removeClass('show active');
            //         $('#CAR').removeClass('show active');
            //     } else {
            //         $('#jadwalAMI').removeClass('show active');
            //         $('#laporanAMI').removeClass('show active');
            //         $('#CAR').hasClass('show active');
            //     }
            // });
        });
        // function activaTab(tab){
        //     // $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        //         if (url.match('#')) {
        //             console.log(url.split('#')[0]);
        //             $('a[href="#'+url.split('#')[1]+'"]').parent().addClass('show active');
        //             $('#'+url.split('#')[1]).addClass('show active')
        //         }
        //         $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //             window.location.hash = e.target.hash;
        //         });
        // };
        
            // $(function()z
            
      $(function () {
            
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        $(".dateYear").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
        
        $(".dateAll").datepicker({
            format: "yyyy-mm-dd",
            viewMode: "date", 
            minViewMode: "date"
        });

        // $('.select2').select2({
        //   theme: 'bootstrap4'
        // })

        bsCustomFileInput.init();

        $('.dateTime').clockpicker()
          .find('input').change(function(){
            console.log(this.value);
          });
        var input = $('#single-input').clockpicker({
          placement: 'bottom',
          align: 'left',
          autoclose: true,
          'default': 'now'
        });


        //Dokumen Induk
        // $("#dokIndukTable").DataTable({
        //   "responsive": true, "lengthChange": true, "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('tr').css('cursor','pointer');
        
      });
    </script>

@endpush()