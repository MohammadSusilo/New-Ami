@extends('layouts.myapp')
@section('title', 'Dokumen Induk ~ Edit')

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
            <h1>Ubah Dokumen Induk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">Ubah Dokumen Induk</li>
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
      <form method="POST" action="{{ route('dokumen.induk.update', $dokInduk->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $dokInduk->name }}">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Nomor</label>
                    <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{ $dokInduk->nomor }}">

                      @error('nomor')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Revisi</label>
                    <input type="text" class="form-control @error('revisi') is-invalid @enderror" name="revisi" value="{{ $dokInduk->revisi }}">

                      @error('revisi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tahun Aktif</label>
                    <input type="text"  id="datepicker1" name="tahun_aktif" value="{{ $dokInduk->tahun_aktif }}" class="form-control @error('tahun_aktif') is-invalid @enderror">

                      @error('tahun_aktif')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun Selesai</label>
                    <input type="text"  id="datepicker2" name="tahun_selesai" value="{{ $dokInduk->tahun_selesai }}" class="form-control @error('tahun_selesai') is-invalid @enderror">

                      @error('tahun_selesai')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <label>Status</label>
                      @if($dokInduk->status == "aktif")
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

                      @else

                      <div class="icheck-success">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif">
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="status" value="nonaktif" checked>
                        <label for="radioPrimary2">
                          Non Aktif
                        </label>
                      </div>
                      @endif
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('sifatDokumen') is-invalid @enderror">
                      <label>Sifat Dokumen</label>
                      @if($dokInduk->sifatDokumen == "private")
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

                      @else

                      <div class="icheck-warning">
                        <input type="radio" id="radioPrimarys1" name="sifatDokumen" value="private">
                        <label for="radioPrimarys1">
                          Private
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimarys2" name="sifatDokumen" value="public" checked>
                        <label for="radioPrimarys2">
                          Public
                        </label>
                      </div>
                      @endif
                      
                      @error('sifatDokumen')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <label class="requiredfile">File</label>
                  <div class="custom-file">
                    <input type="file" name="lokasi" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">{{ $dokInduk->lokasi }}</label>
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateDokInduk">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateDokInduk">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Dokumen Induk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Dokumen Induk : {{ $dokInduk->name }} !!!</p>
                        <center>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-success">Iya</button>
                        </center>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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
      });

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
    </script>

@endpush()