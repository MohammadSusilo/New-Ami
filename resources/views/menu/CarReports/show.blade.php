@extends('layouts.myapp')
@section('title', 'CAR Reports ~ Show')

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
            <h1>Lihat CAR Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">CAR Reports</li>
              <li class="breadcrumb-item active">Lihat CAR Reports</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('/AMI') }}" class="btn btn-app">
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
                <h3 class="card-title">Data CAR Reports</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
                        <tr>
                            <th>Kode Standar</th>
                            <td>:</td>
                            <td>
                              <span class="badge badge-pill badge-info">{{ $CARs->laporanAudit->standars->kodeStandar }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Standar</th>
                            <td>:</td>
                            <td>{{ $CARs->laporanAudit->standars->namaStandar }}</td>
                        </tr>
                        <tr>
                            <th>Uraian Temuan</th>
                            <td>:</td>
                            <td>{!! $CARs->laporanAudit->uraianTemuan !!}</td>
                        </tr>
						            <tr>
                            <th>Analisis Penyebab Masalah</th>
                            <td>:</td>
                            <td>{!! $CARs->analisiPenyebabMasalah !!}</td>
                        </tr>
                        <tr>
                            <th>Tindakan Penyelesaian</th>
                            <td>:</td>
                            <td>{!! $CARs->tindakanPenyelesaian !!}</td>
                        </tr>
                        <tr>
                            <th>Tindakan Pencegahan</th>
                            <td>:</td>
                            <td>{!! $CARs->tindakanPencegahan !!}</td>
                        </tr>
                        <tr>
                            <th>Hasil Pemeriksaan</th>
                            <td>:</td>
                            <td>
                                @if($CARs->hasilPemeriksaan == "sesuai")
                                    <span class="badge badge-pill badge-success">Sesuai</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rekomendasi</th>
                            <td>:</td>
                            <td>{{ $CARs->rekomendasi }}</td>
                        </tr>
                        <tr>
                            <th>File</th>
                            <td>:</td>
                            <td><a href="{{ asset($CARs->file) }}" target="_blank" target="pdf-frame">{{ asset($CARs->file) }}</a></td>
                        </tr>
                        <tr>
                            <th>ACC</th>
                            <td>:</td>
                            <td>
                                @foreach ($users as $user)
                                   @if($user->id == $CARs->acc)
                                    {{$user->name}}
                                   @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($CARs->status == "open")
                                <span class="badge badge-pill badge-info">Open Check</span>
                              @elseif($CARs->status == "process")
                                <span class="badge badge-pill badge-warning">Process Check</span>
                              @else
                                <span class="badge badge-pill badge-success">Closed Check</span>
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