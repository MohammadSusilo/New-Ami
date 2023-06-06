@extends('layouts.myapp')
@section('title', 'Pengguna ~ Show')

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
            <h1>Lihat Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item">Pengguna</li>
              <li class="breadcrumb-item active">Lihat Pengguna</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ route('users.index') }}" class="btn btn-app">
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
                <h3 class="card-title">Data Pengguna</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $users->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $users->email }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>:</td>
                            <td>
                              @if(!empty($users->unitKerja->name))
                                {{ $users->unitKerja->name }}
                              @else
                                NULL
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rule</th>
                            <td>:</td>
                            <td>
                              @if(!empty($users->roles->name))
                                {{ $users->roles->name }}
                              @else
                                NULL
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($users->status == "aktif")
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