@extends('layouts.myapp')
@section('title', 'New Bukti Kinerja')
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
            <h1>New Bukti Kinerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">Renop</a></li>
              <li class="breadcrumb-item"><a href="#">Bukti Kinerja</a></li>
              <li class="breadcrumb-item active">New Bukti Kinerja</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('/RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('buktiKinerja.store') }}"  enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Bukti Kinerja</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Renop</label>
                      <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror"  name="renop_id" style="width: 100%;">
                        <option disabled selected="selected">Pilih Renop...</option>
                        @foreach($renop as $renops)
                          <option value="{{$renops->id}}">{{$renops->kode}}</option>
                        @endforeach
                      </select>
                      
                      @error('renop_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> -->
                  <input name="kinerjaUnit_id" type="hidden" value="{{$idKU}}">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Nama Bukti</label>
                    <input type="text" class="form-control @error('namaBukti') is-invalid @enderror" name="namaBukti" value="{{ old('namaBukti') }}" autofocus placeholder="Enter Nama Bukti">

                      @error('namaBukti')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus placeholder="Enter deskripsi"> -->

                      @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">

                      @error('tahun')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <label class="requiredfile">File</label>
                  <div class="custom-file">
                    <input type="file" name="lokDokBukti" class="custom-file-input @error('lokDokBukti') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    @error('lokDokBukti')
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
                    <div class="icheck-danger">
                        <input type="radio" id="radioPrimary3" name="status" value="nonaktif">
                        <label for="radioPrimary3">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renstra').select2({
        theme: 'bootstrap4'
      })
      
      bsCustomFileInput.init();

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