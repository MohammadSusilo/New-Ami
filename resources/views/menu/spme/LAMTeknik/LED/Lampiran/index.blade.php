@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ LAMPIRAN')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAM TEKNIK - LAMPIRAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item active">Lampiran</li>
            </ol>
          </div>   
          <div class="col-sm-4">

          </div>    
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LAM Teknik - LAMPIRAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form onSubmit="return false">
                            <center><h3>LAMPIRAN</h3></center>
                            <p>Deskripsi yang memuat kesimpulan akhir dari Laporan Evaluasi Diri.</p>
                            <textarea id="summernote">
                              Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                        </form>
                       
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

    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote()
      });
    </script>

@endpush()