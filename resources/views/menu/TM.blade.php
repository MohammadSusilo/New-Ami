@extends('layouts.myapp')
@section('title', 'Tinjauan Manajemen')
@push('css')
    <!-- This page plugins -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- File Manager -->
    {{-- <style>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}</style> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" /> --}}

    <!-- Form Wizard -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/stepper/css/raleway-font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/stepper/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/stepper/css/style.css') }}">

    <!-- Date Picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <!-- Clock Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">

    @stack('cssbahanTM')
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tinjauan Manajemen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tinjauan Manajemen</li>
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
                    <!--<a class="nav-link active" id="jadwalTM-tab" data-toggle="pill" href="#jadwalTM" role="tab" aria-controls="jadwalTM" aria-selected="true">Jadwal TM</a>-->
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#jadwalTM" data-target="#jadwalTM" aria-controls="jadwalTM" aria-selected="true">Jadwal TM</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="bahanTM-tab" data-toggle="pill" href="#bahanTM" role="tab" aria-controls="bahanTM" aria-selected="true">Bahan TM</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#bahanTM" data-target="#bahanTM" aria-controls="bahanTM" aria-selected="true">Bahan TM</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="hasilTM-tab" data-toggle="pill" href="#hasilTM" role="tab" aria-controls="hasilTM" aria-selected="false">Hasil TM</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#hasilTM" data-target="#hasilTM" aria-controls="hasilTM" aria-selected="true">Hasil TM</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="tindakLanjutTM-tab" data-toggle="pill" href="#tindakLanjutTM" role="tab" aria-controls="tindakLanjutTM" aria-selected="false">Tindak Lanjut TM</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#tindakLanjutTM" data-target="#tindakLanjutTM" aria-controls="tindakLanjutTM" aria-selected="true">Tindak Lanjut TM</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!-- Instant Create -->

                  <!-- Jadwal TM -->
                  <div id="jadwalTM" class="tab-pane fade show active" role="tabpanel">
                  <!--<div class="tab-pane fade show active" id="jadwalTM" role="tabpanel" aria-labelledby="jadwalTM-tab">-->
                    @include('menu.menuInduk.submenuInduk.jadwalTM')
                  </div>

                  <!-- Bahan TM -->
                  <div id="bahanTM" class="tab-pane fade in" role="tabpanel">
                  <!--<div class="tab-pane fade" id="bahanTM" role="tabpanel" aria-labelledby="bahanTM-tab">-->
                    @include('menu.menuInduk.submenuInduk.bahanTM')
                  </div>

                  <!-- Hasil TM -->
                  <div id="hasilTM" class="tab-pane fade in" role="tabpanel">
                  <!--<div class="tab-pane fade" id="hasilTM" role="tabpanel" aria-labelledby="hasilTM-tab">-->
                    @include('menu.menuInduk.submenuInduk.hasilTM')
                  </div>

                  <!-- Tindak Lanjut TM -->
                  <div id="tindakLanjutTM" class="tab-pane fade in" role="tabpanel">
                  <!--<div class="tab-pane fade" id="tindakLanjutTM" role="tabpanel" aria-labelledby="tindakLanjutTM-tab">-->
                    @include('menu.menuInduk.submenuInduk.tindakTM')
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

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- File Manager -->
    <!-- <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script> -->

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

    @stack('jsInstantTM')
    @stack('jsjadwalTM')
    @stack('jsbahanTM')
    @stack('jshasilTM')
    @stack('jstindakTM')
    
    <script>
        $(document).ready(function () {
            $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
            $("#jadwalTMTable, #bahanTMTable, #hasilTMTable, #tindakLanjutTMTable").dataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        
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

        bsCustomFileInput.init();

        //Dokumen Induk
        // $("#dokIndukTable").DataTable({
        //   "responsive": true, "lengthChange": true, "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('tr').css('cursor','pointer');
        
      });
    </script>

@endpush()