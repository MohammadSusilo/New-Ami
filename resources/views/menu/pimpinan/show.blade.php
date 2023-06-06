@extends('layouts.myapp')
@section('title', 'Pimpinan ~ Show')

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
            <h1>Lihat Pimpinan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Pimpinan</li>
              <li class="breadcrumb-item active">Lihat Pimpinan</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('/PimpinanUnitKerja') }}" class="btn btn-app">
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
                <h3 class="card-title">Data Pimpinan</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $pimpinan->name }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>:</td>
                            <td>
                            @if ($pimpinan->status == "D0")
                              <span class="badge badge-pill badge-info">Direktur</span>
                            @elseif ($pimpinan->status == "WD1")
                              <span class="badge badge-pill badge-info">Wakil Direktur 1</span>
                            @elseif ($pimpinan->status == "WD2")
                              <span class="badge badge-pill badge-info">Wakil Direktur 2</span>
                            @elseif ($pimpinan->status == "WD3")
                              <span class="badge badge-pill badge-info">Wakil Direktur 3</span>
                            @else
                              <span class="badge badge-pill badge-info">Wakil Direktur 4</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                            <th>Pengelola</th>
                            <td>:</td>
                            <td>
                              @foreach($pimpinan->pengelola as $key=>$ans)
                                <span class="badge badge-pill badge-info">{{ $ans->name}}</span>
                              @endforeach
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