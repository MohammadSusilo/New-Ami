@extends('layouts.myapp')
@section('title', 'Dokumens & Rencana Operasional')
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
            <h1>Dokumens & Rencana Operasional</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Dokumens & Rencana Operasional</li>
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
                    <!--<a class="nav-link active" id="dokumenInduk-tab" data-toggle="pill" href="#dokumenInduk" role="tab" aria-controls="dokumenInduk" aria-selected="true">Dokumen Induk</a>-->
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#dokumenInduk" data-target="#dokumenInduk" aria-controls="dokumenInduk" aria-selected="true">Dokumen Induk</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="dokChecklist-tab" data-toggle="pill" href="#dokChecklist" role="tab" aria-controls="dokChecklist" aria-selected="false">Dokumen Checklist</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#dokChecklist" data-target="#dokChecklist" aria-controls="dokChecklist" aria-selected="true">Dokumen Checklist</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="renstra-tab" data-toggle="pill" href="#renstra" role="tab" aria-controls="renstra" aria-selected="true">Dokumen Acuan</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#renstra" data-target="#renstra" aria-controls="renstra" aria-selected="true">Dokumen Acuan</a>
                  </li>
                  @endif
                  @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                  <li class="nav-item">
                    <!--<a class="nav-link active" id="dokChecklist-tab" data-toggle="pill" href="#dokChecklist" role="tab" aria-controls="dokChecklist" aria-selected="false">Dokumen Checklist</a>-->
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#dokChecklist" data-target="#dokChecklist" aria-controls="dokChecklist" aria-selected="true">Dokumen Checklist</a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <!--<a class="nav-link" id="tabrenop-tab" data-toggle="pill" href="#tabrenop" role="tab" aria-controls="tabrenop" aria-selected="false">Renop</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#renop" data-target="#renop" aria-controls="renop" aria-selected="true">Renop</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="kinerjaUnit-tab" data-toggle="pill" href="#kinerjaUnit" role="tab" aria-controls="kinerjaUnit" aria-selected="false">Kinerja Unit</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#kinerjaUnit" data-target="#kinerjaUnit" aria-controls="kinerjaUnit" aria-selected="true">Kinerja UnitTM</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link" id="buktiKinerja-tab" data-toggle="pill" href="#buktiKinerja" role="tab" aria-controls="buktiKinerja" aria-selected="false">Bukti Kinerja</a>-->
                    <a class="nav-link" data-toggle="tab" role="tab" href="#buktiKinerja" data-target="#buktiKinerja" aria-controls="buktiKinerja" aria-selected="true">Bukti Kinerja</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!-- Instant Create -->

                  @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                  <!-- Dokumen Induk -->
                  <div id="dokumenInduk" class="tab-pane fade show active" role="tabpanel">
                  <!--<div class="tab-pane fade show active" id="dokumenInduk" role="tabpanel" aria-labelledby="dokumenInduk-tab">-->
                    @include('menu.menuInduk.submenuInduk.dokInduk')
                  </div>

                  <!-- Dokumen Checklist -->
                  <div id="dokChecklist" class="tab-pane fade show" role="tabpanel">
                  <!--<div class="tab-pane fade" id="dokChecklist" role="tabpanel" aria-labelledby="dokChecklist-tab">-->
                    @include('menu.menuInduk.submenuInduk.dokChecklist')
                  </div>

                  <!-- Renstra -->
                  <div id="renstra" class="tab-pane fade show" role="tabpanel">
                  <!--<div class="tab-pane fade" id="renstra" role="tabpanel" aria-labelledby="renstra-tab">-->
                    @include('menu.menuInduk.submenuInduk.renstra')
                  </div>
                  @endif

                  @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                  <!-- Dokumen Checklist -->
                  <div id="dokChecklist" class="tab-pane fade show active" role="tabpanel">
                  <!--<div class="tab-pane fade show active" id="dokChecklist" role="tabpanel" aria-labelledby="dokChecklist-tab">-->
                    @include('menu.menuInduk.submenuInduk.dokChecklist')
                  </div>
                  @endif

                  <!-- Renop -->
                  <div id="renop" class="tab-pane fade show" role="tabpanel">
                  <!--<div class="tab-pane fade" id="tabrenop" role="tabpanel" aria-labelledby="tabrenop-tab">-->
                    @include('menu.menuInduk.submenuInduk.renop')
                  </div>

                  <!-- Kinerja Unit -->
                  <div id="kinerjaUnit" class="tab-pane fade show" role="tabpanel">
                  <!--<div class="tab-pane fade" id="kinerjaUnit" role="tabpanel" aria-labelledby="kinerjaUnit-tab">-->
                    @include('menu.menuInduk.submenuInduk.kinerjaUnit')
                  </div>

                  <!-- Bukti Kinerja -->
                  <div id="buktiKinerja" class="tab-pane fade show" role="tabpanel">
                  <!--<div class="tab-pane fade" id="buktiKinerja" role="tabpanel" aria-labelledby="buktiKinerja-tab">-->
                    @include('menu.menuInduk.submenuInduk.buktiKinerja')
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
    <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>


    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('js/savy.js') }}"></script>

    @stack('jsInstantRenstraRenop')
    @stack('jsdokInduk')
    @stack('jsdokChecklist')
    @stack('jsrenstra')
    @stack('jsrenop')
    @stack('jskinerjaUnit')
    @stack('jsbuktiKinerja')
    
    <script>
        $(document).ready(function () {
            $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
            $("#dokIndukTable, #dokChecklistTable, #renstraTable, #kinerjaUnitTable, #BuktiKUTable").dataTable({
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
        $(".datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

        bsCustomFileInput.init();

        $('tr').css('cursor','pointer');
        
      });
    </script>

@endpush()