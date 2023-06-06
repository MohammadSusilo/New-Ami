@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ BAB II STRUKTUR LAPORAN EVALUASI DIRI | Struktur Tim Penyusun dan Mekanisme Kerja')

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
            <h1>LAM TEKNIK - Struktur Tim Penyusun dan Mekanisme Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</a></li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item">BAB II Struktur LED</li>
              <li class="breadcrumb-item active">Struktur Tim Penyusun dan Mekanisme Kerja</li>
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
                        <h3 class="card-title">LAM Teknik - Struktur Tim Penyusun dan Mekanisme Kerja</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form onSubmit="return false">
                            <center><h3>STRUKTUR LAPORAN EVALUASI DIRI</h3></center>
                            <p>Bagian ini berisikan tim penyusun LEDPS beserta deskripsi tugasnya termasuk di dalamnya keterlibatan berbagai uenit dan para pemangku kepentingan.</p>
                            <center><p>Tim Penyusun LED PS</p></center>
                                <!-- Bordered Table -->
                                <div class="body table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <thead>
                                            <tr>
                                                <th width="" class="text-center">Nama Dosen</th>
                                                <th width="" class="text-center">Jabatan/Dosen</th>
                                                <th width="" class="text-center">Deskripsi Kerja</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody id="AddCover"> -->
                                        <tbody id="AddCoverLED">
                                            <tr>
                                                <td><input name="jenis_upps[]" class="form-control form-control-sm"/></td>
                                                <td><input name="nama_upps[]" class="form-control form-control-sm" /></td>
                                                <td><input name="status_upps[]" class="form-control form-control-sm" /></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr >
                                                <td colspan="3">                                                                    
                                                    <button class="btn btn-small btn-success" onclick="additemcoverled(); return false"><i class="fas fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- #END# Bordered Table -->
                            <center><p>Tim Penyusun LED PS</p></center>
                                <!-- Bordered Table -->
                                <div class="body table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <thead>
                                            <tr>
                                                <th width="" class="text-center">Nama Tenaga Kependidikan</th>
                                                <th width="" class="text-center">Jabatan/Tenaga Kependidikan</th>
                                                <th width="" class="text-center">Deskripsi Kerja</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody id="AddCover"> -->
                                        <tbody id="AddCoverLED">
                                            <tr>
                                                <td><input name="jenis_upps[]" class="form-control form-control-sm"/></td>
                                                <td><input name="nama_upps[]" class="form-control form-control-sm" /></td>
                                                <td><input name="status_upps[]" class="form-control form-control-sm" /></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr >
                                                <td colspan="3">                                                                    
                                                    <button class="btn btn-small btn-success" onclick="additemcoverled(); return false"><i class="fas fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- #END# Bordered Table -->
                            <p>Bagian ini memuat mekanisme pengumpulan data dan informasi, verifikasi dan validasi data, pengecekan konsistensi data, analisis data dan identifikasi akar masalah.</p>
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