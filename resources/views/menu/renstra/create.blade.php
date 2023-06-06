@extends('layouts.myapp')
@section('title', 'Dokumen Acuan ~ Create')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

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
            <h1>Dokumen Acuan Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Dokumen Acuan</li>
              <li class="breadcrumb-item active">Dokumen Acuan Baru</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('/RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('renstra.store') }}">
      @csrf
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
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}" autofocus placeholder="Enter kode">

                      @error('kode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus placeholder="Enter deskripsi"> -->

                      @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Target</label>
                    <input type="number" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ old('target') }}" placeholder="Enter target">

                      @error('target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Unit Target</label>
                    <input type="text" class="form-control @error('unit_target') is-invalid @enderror" name="unit_target" value="{{ old('unit_target') }}" placeholder="Enter Unit Target">

                      @error('unit_target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tipe Indikator</label>
                    <input type="text" class="form-control @error('tipe_indikator') is-invalid @enderror" name="tipe_indikator" value="{{ old('tipe_indikator') }}" placeholder="Enter Tipe Indikator">

                      @error('tipe_indikator')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror" placeholder="Enter Tahun"/>

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
                          <option value="{{$dokInd->id}}">{{$dokInd->name}}</option>  
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
                          <option disabled selected="selected">Jenis Dokumen...</option>
                          <option value="renstra">Renstra</option>  
                          <option value="PK">PK</option>  
                      </select>

                      @error('jenis')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Referensi</label>
                    <input type="text" class="form-control @error('referensi') is-invalid @enderror" name="referensi" value="{{ old('referensi') }}" placeholder="Enter Referensi">

                      @error('referensi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputPassword1">Renop</label>
                    <select class="select2 @error('renop') is-invalid @enderror" name="renop[]" id="renop" multiple="multiple" data-placeholder="Select a Renop" style="width: 100%;">
                        <option disabled selected="selected">Pilih Renop...</option>
                        @foreach ($renop as $renp)
                        <option value="{{ $renp->id }}">
                            {{ $renp->kode}}
                        </option>
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
                      
                      @error('status')
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

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