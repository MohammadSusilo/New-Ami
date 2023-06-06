@extends('layouts.myapp')
@section('title', 'Standar ~ Create')

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
            <h1>Ubah Standar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Standar</li>
              <li class="breadcrumb-item active">Ubah Standar</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('standar.update', $standar->id) }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Standar</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Standar</label>
                    <input type="text" class="form-control @error('kodeStandar') is-invalid @enderror" name="kodeStandar" value="{{ $standar->kodeStandar }}" required>

                      @error('kodeStandar')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label>Nama Standar</label>
                    <input type="text" class="form-control @error('namaStandar') is-invalid @enderror" name="namaStandar" value="{{ $standar->namaStandar }}" required>

                      @error('namaStandar')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pengelola Unit Kerja</label>
                      <select class="form-control select2bs4 @error('kriteria') is-invalid @enderror" name="kriteria" style="width: 100%;" required>
                        @if($standar->kriteria == "Akademik")
                          <option value="Akademik" selected>STANDAR AKADEMIK</option>
                          <option value="NonAkademik">STANDAR NON AKADEMIK</option>
                          <option value="Penelitian">STANDAR PENELITIAN</option>
                          <option value="Pendidikan">STANDAR PENDIDIKAN</option>
                          <option value="PengabdianMasyarakat">STANDAR PENGABDIAN KEPADA MASYARAKAT</option>
                        @elseif($standar->kriteria == "NonAkademik")
                          <option value="Akademik">STANDAR AKADEMIK</option>
                          <option value="NonAkademik" selected>STANDAR NON AKADEMIK</option>
                          <option value="Penelitian">STANDAR PENELITIAN</option>
                          <option value="Pendidikan">STANDAR PENDIDIKAN</option>
                          <option value="PengabdianMasyarakat">STANDAR PENGABDIAN KEPADA MASYARAKAT</option>
                        @elseif($standar->kriteria == "Penelitian")
                          <option value="Akademik">STANDAR AKADEMIK</option>
                          <option value="NonAkademik">STANDAR NON AKADEMIK</option>
                          <option value="Penelitian" selected>STANDAR PENELITIAN</option>
                          <option value="Pendidikan">STANDAR PENDIDIKAN</option>
                          <option value="PengabdianMasyarakat">STANDAR PENGABDIAN KEPADA MASYARAKAT</option>
                        @elseif($standar->kriteria == "Pendidikan")
                          <option value="Akademik">STANDAR AKADEMIK</option>
                          <option value="NonAkademik">STANDAR NON AKADEMIK</option>
                          <option value="Penelitian">STANDAR PENELITIAN</option>
                          <option value="Pendidikan" selected>STANDAR PENDIDIKAN</option>
                          <option value="PengabdianMasyarakat">STANDAR PENGABDIAN KEPADA MASYARAKAT</option>
                        @else
                          <option value="Akademik">STANDAR AKADEMIK</option>
                          <option value="NonAkademik">STANDAR NON AKADEMIK</option>
                          <option value="Penelitian">STANDAR PENELITIAN</option>
                          <option value="Pendidikan">STANDAR PENDIDIKAN</option>
                          <option value="PengabdianMasyarakat" selected>STANDAR PENGABDIAN KEPADA MASYARAKAT</option>
                        @endif
                      </select>
                      
                      @error('kriteria')
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

    <script>
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    </script>

@endpush()