@extends('layouts.myapp')
@section('title', 'Documentation')
@push('css')
    <!-- This page plugins -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <style>
        .custom1 {
           margin-left: auto !important;
           margin-right: auto !important;
           margin: 20px;
           padding: 20px;
        }
        .custom2 {
          position: relative;
          height: 0;
          overflow: hidden;
          padding-bottom: 90%;
        }
        .custom2 iframe {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          padding: 0;
          margin: 0;
        }
        #tutorial-pdf-responsive {
          max-width: 900px;
          max-height: 700px;
          overflow: hidden;
        }
    </style>
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
              <li class="breadcrumb-item active">Documentation</li>
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
              <div class="card-body">
                    <!--<embed type="application/pdf" src="{{ asset('doc/Buku Petunjuk Pengunaan Aplikasi Audit Mutu Internal.pdf') }}" width="auto" height="720"></embed>-->
                    <!--<iframe src="{{ asset('doc/Buku Petunjuk Pengunaan Aplikasi Audit Mutu Internal.pdf') }}" width="auto" height="auto"></iframe>-->
                    <div id="tutorial-pdf-responsive" class="custom1">
                      <div class="custom2">
                         <iframe src="{{ asset('doc/Buku Petunjuk Pengunaan Aplikasi Audit Mutu Internal.pdf') }}"></iframe>
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

@endpush()