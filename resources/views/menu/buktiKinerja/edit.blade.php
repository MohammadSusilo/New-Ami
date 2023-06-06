@extends('layouts.myapp')
@section('title', 'Bukti Kinerja ~ Edit')

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
            <h1>Ubah Bukti Kinerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Renop</li>
              <li class="breadcrumb-item">Bukti Kinerja</li>
              <li class="breadcrumb-item active">Ubah Bukti Kinerja</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ route('renop.index')}}" class="btn btn-app"> -->
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
      <form method="POST" action="{{ route('buktiKinerja.update', $buktiKinerja->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Bukti Kinerja</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Kinerja Unit</label>
                      <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror"  name="kinerjaUnit_id" style="width: 100%;">
                        @foreach($kinerjaUnit as $kinerjaUnits)
                          <option 
                              value="{{$kinerjaUnits->id}}"
                              @if ($kinerjaUnits->id === $buktiKinerja->kinerjaUnit_id)
                                  selected
                              @endif
                                  >{{$kinerjaUnits->deskripsi}}
                          </option>
                        @endforeach
                      </select>
                      
                      @error('renop_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1" class="required">Nama Bukti</label>
                    <input type="text" class="form-control @error('namaBukti') is-invalid @enderror" name="namaBukti" value="{{ $buktiKinerja->namaBukti }}">

                      @error('namaBukti')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{ $buktiKinerja->deskripsi }}</textarea>
                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ $buktiKinerja->deskripsi }}"> -->

                      @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ $buktiKinerja->tahun }}" class="form-control @error('tahun') is-invalid @enderror">

                      @error('tahun')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <label class="requiredfile">File</label>
                  <div class="custom-file">
                    <input type="file" name="lokDokBukti" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">{{ $buktiKinerja->lokDokBukti }}</label>
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <label>Status</label>
                      @if($buktiKinerja->status == "aktif")
                      <div class="icheck-primary">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif" checked>
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary3" name="status" value="nonaktif">
                        <label for="radioPrimary3">
                          Non Aktif
                        </label>
                      </div>
                      
                      @else
                      <div class="icheck-primary">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif">
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger">
                        <input type="radio" id="radioPrimary3" name="status" value="nonaktif" checked>
                        <label for="radioPrimary3">
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
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateBukti">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateBukti">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Bukti Kinerja Unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Bukti Kinerja Unit : {{ $buktiKinerja->namaBukti }} !!!</p>
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