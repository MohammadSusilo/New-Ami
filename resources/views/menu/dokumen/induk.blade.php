@extends('layouts.myapp')
@section('title', 'Dokumen Induk ~ Create')

@push('css')

@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dokumen Induk Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">Dokumen Induk Baru</li>
            </ol>
          </div>   
          <div class="col-sm-4">
            <a href="{{ url('RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Back
            </a>
          </div>    
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('dokumen.induk.save') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Dokumen Induk</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus autocomplete='off' placeholder="Enter Nama">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Nomor</label>
                    <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{ old('nomor') }}" autocomplete='off' placeholder="Enter Nomor">

                      @error('nomor')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Revisi</label>
                    <input type="text" class="form-control @error('revisi') is-invalid @enderror" name="revisi" value="{{ old('revisi') }}" autocomplete='off' placeholder="Enter Revisi">

                      @error('revisi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tahun Aktif</label>
                    <input type="text"  id="datepicker1" name="tahun_aktif" value="{{ old('tahun_aktif') }}" class="form-control @error('tahun_aktif') is-invalid @enderror" autocomplete='off' placeholder="Enter Tahun Aktif">

                      @error('tahun_aktif')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun Selesai</label>
                    <input type="text"  id="datepicker2" name="tahun_selesai" value="{{ old('tahun_selesai') }}" class="form-control @error('tahun_selesai') is-invalid @enderror" autocomplete='off' placeholder="Enter Tahun Selesai">

                      @error('tahun_selesai')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
                    <div class="icheck-success">
                      <input type="radio" id="radioPrimary1" name="status" value="aktif" checked>
                      <label for="radioPrimary1">
                        Aktif
                      </label>
                    </div>
                    <div class="icheck-danger d-inline">
                      <input type="radio" id="radioPrimary2" name="status" value="nonaktif">
                      <label for="radioPrimary2">
                        Non Aktif
                      </label>
                    </div>
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('sifatDokumen') is-invalid @enderror">
                    <label>Sifat Dokumen</label>
                    <div class="icheck-warning">
                      <input type="radio" id="radioPrimarys1" name="sifatDokumen" value="private" checked>
                      <label for="radioPrimarys1">
                        Private
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimarys2" name="sifatDokumen" value="public">
                      <label for="radioPrimarys2">
                        Public
                      </label>
                    </div>
                      
                      @error('sifatDokumen')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <label class="requiredfile">File</label>
                  <div class="custom-file">
                    <input type="file" name="lokasi" class="custom-file-input @error('lokasi') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    @error('lokasi')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
        </form>
        <!-- form finish -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>
      $(function () {

        bsCustomFileInput.init();

        $("#datepicker1").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

        $("#datepicker2").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
      });
    </script>

@endpush()