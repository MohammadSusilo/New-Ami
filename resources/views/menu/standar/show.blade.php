@extends('layouts.myapp')
@section('title', 'Standar ~ Show')

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
            <h1>Lihat Standar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Standar</li>
              <li class="breadcrumb-item active">Lihat Standar</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('standar') }}" class="btn btn-app">
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
      {{-- <form method="POST" action="{{ route('roles.store') }}">
      @csrf --}}
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Data Standar</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Kode Standar</th>
                            <td>:</td>
                            <td>{{ $standar->kodeStandar }}</td>
                        </tr>
                        <tr>
                            <th>Nama Standar</th>
                            <td>:</td>
                            <td>{{ $standar->namaStandar }}</td>
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <td>:</td>
                            <td>
                              <span class="badge badge-pill badge-info">
                                @if($standar->kriteria == "Akademik")
                                  STANDAR AKADEMIK
                                @elseif($standar->kriteria == "NonAkademik")
                                  STANDAR NON AKADEMIK
                                @elseif($standar->kriteria == "Penelitian")
                                  STANDAR PENELITIAN
                                @elseif($standar->kriteria == "Pendidikan")
                                  STANDAR PENDIDIKAN
                                @else
                                  STANDAR PENGABDIAN KEPADA MASYARAKAT
                                @endif
                              </span>
                            </td>
                        </tr>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->

        </div><!-- /.row -->
        {{-- </form> --}}
        <!-- form finish -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

@endpush()