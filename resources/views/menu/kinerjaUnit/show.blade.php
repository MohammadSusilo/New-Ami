@extends('layouts.myapp')
@section('title', 'Kinerja Unit ~ Show')

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
            <h1>Lihat Kinerja Unit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Renop</li>
              <li class="breadcrumb-item">Kinerja Unit</li>
              <li class="breadcrumb-item active">Lihat Kinerja Unit</li>
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
      {{-- <form method="POST" action="{{ route('kinerjaUnit.store') }}">
      @csrf --}}
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Data Kinerja Unit</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Nilai Capaian</th>
                            <td>:</td>
                            <td>{{ $kinerjaUnit->nilaiCapaian }}</td>
                        </tr>
                        <tr>
                            <th>Unit Capaian</th>
                            <td>:</td>
                            <td>{{ $kinerjaUnit->unitCapaian }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>:</td>
                            <td>{{ $kinerjaUnit->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>:</td>
                            <td>{{ $kinerjaUnit->tahun }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>:</td>
                            <td>
                              @foreach ($unitKerja as $UK)
                                @if($UK->id == $kinerjaUnit->unitkerja_id)
                                  {{ $UK->name }}
                                @endif
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Renop</th>
                            <td>:</td>
                            <td>
                              @foreach ($renop as $RN)
                                @if($RN->id == $kinerjaUnit->renop_id)
                                  {{ $RN->kode }}
                                @endif
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($kinerjaUnit->status == "aktif")
                                <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                              @endif
                            </td>
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