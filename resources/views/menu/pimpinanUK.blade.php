@extends('layouts.myapp')
@section('title', 'Pimpinan & Unit Kerja')
@push('css')
    <!-- This page plugins -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
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
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pimpinan & Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Pimpinan & Unit Kerja</li>
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
                  @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                  <li class="nav-item">
                    <a class="nav-link active" id="pimpinan-tab" data-toggle="pill" href="#pimpinan" role="tab" aria-controls="pimpinan" aria-selected="true">Pimpinan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pengelolaUK-tab" data-toggle="pill" href="#pengelolaUK" role="tab" aria-controls="pengelolaUK" aria-selected="true">Pengelola Unit Kerja</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="unitKerja-tab" data-toggle="pill" href="#unitKerja" role="tab" aria-controls="unitKerja" aria-selected="false">Unit Kerja</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" id="dokChecklist-tab" data-toggle="pill" href="#dokChecklist" role="tab" aria-controls="dokChecklist" aria-selected="false">Dokumen Checklist</a>
                  </li> -->
                  @endif
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                  <!-- Pimpinan -->
                  <div class="tab-pane fade show active" id="pimpinan" role="tabpanel" aria-labelledby="pimpinan-tab">
                    @include('menu.menuInduk.submenuInduk.pimpinan')
                  </div>

                  <!-- Pengelola Unit Kerja -->
                  <div class="tab-pane fade" id="pengelolaUK" role="tabpanel" aria-labelledby="pengelolaUK-tab">
                    @include('menu.menuInduk.submenuInduk.pengelola')
                  </div>

                  <!-- Unit Kerja -->
                  <div class="tab-pane fade" id="unitKerja" role="tabpanel" aria-labelledby="unitKerja-tab">
                    @include('menu.menuInduk.submenuInduk.unitKerja')
                  </div>
                  @endif

                  <!-- @if(auth()->user()->role_id == 1 && auth()->user()->role_id == 3) -->
                  <!-- Dokumen Checklist -->
                  <!-- <div class="tab-pane fade" id="dokChecklist" role="tabpanel" aria-labelledby="dokChecklist-tab">
                    @include('menu.menuInduk.submenuInduk.dokChecklist')
                  </div>
                  @endif -->
 
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
    <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>

    <!-- Form Wizard -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('plugins/stepper/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('plugins/stepper/js/main.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    @stack('jspimpinan')
    @stack('jspengelolaUK')
    @stack('jsunitKerja')
    @stack('jsdokChecklist')
    
    <script>
      $(function () {
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        $(".dateYear").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
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