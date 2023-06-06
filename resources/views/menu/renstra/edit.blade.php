@extends('layouts.myapp')
@section('title', 'Dokumen Acuan ~ Edit')

@push('css')
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
            <h1>Ubah Dokumen Acuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Dokumen Acuan</li>
              <li class="breadcrumb-item active">Ubah Dokumen Acuan</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('renstra.update', $renstra->id) }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Dokumen Acuan</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Kode</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $renstra->kode }}">

                      @error('kode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{ $renstra->deskripsi }}</textarea>
                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ $renstra->deskripsi }}"> -->

                      @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Target</label>
                    <input type="number" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ $renstra->target }}">

                      @error('target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Unit Target</label>
                    <input type="text" class="form-control @error('unit_target') is-invalid @enderror" name="unit_target" value="{{ $renstra->unit_target }}">

                      @error('unit_target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tipe Indikator</label>
                    <input type="text" class="form-control @error('tipe_indikator') is-invalid @enderror" name="tipe_indikator" value="{{ $renstra->tipe_indikator }}">

                      @error('tipe_indikator')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ $renstra->tahun }}" class="form-control @error('tahun') is-invalid @enderror">

                      @error('tahun')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">File Dokumen</label>
                      <select class="form-control select2bs4 @error('dokumen_id') is-invalid @enderror"  name="dokumen_id" style="width: 100%;">
                        <option disabled selected="selected">Pilih Dokumen...</option>
                        @foreach($dokumenInduk as $dokInd)
                            <option 
                                value="{{$dokInd->id}}"
                                @if ($dokInd->id === $renstra->dokumen_id)
                                    selected
                                @endif
                                    >{{$dokInd->name}}
                            </option>
                        @endforeach
                      </select>
                      
                      @error('dokumen_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Jenis Dokumen</label>
                      <select class="form-control select2bs4 @error('jenis') is-invalid @enderror" name="jenis" style="width: 100%;">
                          @if($renstra->jenis == "renstra")
                            <option value="renstra" selected="selected">Renstra</option>  
                            <option value="PK">PK</option>
                          @else
                            <option value="renstra">Renstra</option>  
                            <option value="PK" selected="selected">PK</option>
                          @endif
                      </select>

                      @error('jenis')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Referensi</label>
                    <input type="text" class="form-control @error('referensi') is-invalid @enderror" name="referensi" value="{{ $renstra->referensi }}">

                      @error('referensi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputPassword1">Renop</label>
                    <select class="select2 @error('renop') is-invalid @enderror" name="renop[]" id="renop" multiple="multiple" data-placeholder="Select a Renop" style="width: 100%;">
                        @foreach($renop as $ren)
                          <option {{ in_array($ren->id, $send) ? 'selected' : ''}} value="{{$ren->id}}">{{$ren->kode}}</option>
                        @endforeach
                    </select>
                      
                      @error('pimpinan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> --}}
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <label>Status</label>
                      @if($renstra->status == "aktif")
                      <div class="icheck-success">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif" checked>
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="status" value="nonaktif">
                        <label for="radioPrimary2">
                        Tidak Aktif
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
                          Tidak Aktif
                        </label>
                      </div>
                      @endif
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateDokAcuan">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateDokAcuan">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Dokumen Acuan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Dokumen Acuan : {{ $renstra->kode }} !!!</p>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renop').select2({
        theme: 'bootstrap4'
      })

      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
      });
    </script>

@endpush()