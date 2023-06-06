@extends('layouts.myapp')
@section('title', 'Pimpinan ~ Edit')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Pimpinan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Pimpinan</li>
              <li class="breadcrumb-item active">Ubah Pimpinan</li>
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
      <form method="POST" action="{{ route('pimpinan.update', $pimpinan->id) }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pimpinan</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pimpinan->name }}" required autocomplete="name" autofocus placeholder="Enter name">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jabatan</label>
                    <select class="custom-select @error('status') is-invalid @enderror" name="status""  name="status" id="status">
                      @if ($pimpinan->status == "D0")
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                      @elseif ($pimpinan->status == "WD1")
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                          <option value="D0">Direktur</option>
                      @elseif ($pimpinan->status == "WD2")
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                      @elseif ($pimpinan->status == "WD3")
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                      @else
                          <option value="WD4">Wakil Direktur 4</option>
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                      @endif
                    </select>
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pengelola</label>
                    <select class="select2 @error('pengelola') is-invalid @enderror" name="pengelola[]" id="pengelola" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">                        
                        @foreach($pengelola as $pim)
                          <option {{ in_array($pim->id, $send) ? 'selected' : ''}} value="{{$pim->id}}">{{$pim->name}}</option>
                        @endforeach
                    </select>
                      
                      @error('pengelola')
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

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
      $(function () {
        $('.select2').select2()

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
      });
    </script>

@endpush()