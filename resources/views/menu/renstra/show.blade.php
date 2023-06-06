@extends('layouts.myapp')
@section('title', 'Dokumen Acuan ~ Show')

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
            <h1>Lihat Dokumen Acuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Dokumen Acuan</li>
              <li class="breadcrumb-item active">Lihat Dokumen Acuan</li>
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
      {{-- <form method="POST" action="{{ route('roles.store') }}">
      @csrf --}}
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Data Dokumen Acuan</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td>{{ $renstra->kode }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>:</td>
                            <td>{{ $renstra->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Target</th>
                            <td>:</td>
                            <td>{{ $renstra->target }}</td>
                        </tr>
                        <tr>
                            <th>Unit Target</th>
                            <td>:</td>
                            <td>{{ $renstra->unit_target }}</td>
                        </tr>
                        <tr>
                            <th>tahun</th>
                            <td>:</td>
                            <td>{{ $renstra->tahun }}</td>
                        </tr>    
                        <tr>
                            <th>Renop</th>
                            <td>:</td>
                            <td>
                              @foreach($renstra->renop as $key=>$ans)
                                <span class="badge badge-pill badge-info">{{ $ans->kode}}</span>
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen Induk</th>
                            <td>:</td>
                            <td>
                              @foreach($dokumenInduk as $dok)
                                @if($dok == $renstra->dokumenInduk)
                                  <span class="badge badge-pill badge-info">{{ $dok->name}}</span>
                                @endif
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($renstra->status == "aktif")
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