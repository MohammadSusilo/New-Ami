@extends('layouts.myapp')
@section('title', 'Jadwal Audit ~ Show')

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
            <h1>Lihat Jadwal Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">Jadwal Audit</li>
              <li class="breadcrumb-item active">Lihat Jadwal Audit</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
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
                <h3 class="card-title">Data Jadwal Audit</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
						<tr>
                            <th>Periode</th>
                            <td>:</td>
                            <td>{{ $scheduling->periode }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Audit</th>
                            <td>:</td>
                            <td>{{ $scheduling->tahun }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Audit</th>
                            <td>:</td>
                            <td>
                                @php $tgl = explode("#", $scheduling->tglAudit); @endphp
                                {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Waktu Audit</th>
                            <td>:</td>
                            <td>
                              @php $waktu = explode("#", $scheduling->waktu); @endphp
                              {{ $waktu[0] }} - {{ $waktu[1] }}
                            </td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>:</td>
                            <td>
                              @foreach($unitKerja as $UK)
                                @if($UK->id == $scheduling->unitkerja_id)
                                  <span class="badge badge-pill badge-info">{{ $UK->name }}</span>
                                @endif
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Auditor</th>
                            <td>:</td>
                            <td>
                              @foreach($scheduling->users as $key=>$ans)
                                @if($ans->role_id == 2)
                                    <span class="badge badge-pill badge-info">{{ $ans->name }}</span>
                                @endif
                              @endforeach
                              <!-- @foreach($users as $user)
                                @if($user->id == $scheduling->user_id)
                                  <span class="badge badge-pill badge-info">{{ $user->name }}</span>
                                @endif
                              @endforeach -->
                            </td>
                        </tr>
                        <tr>
                            <th>Auditee</th>
                            <td>:</td>
                            <td>
                              @foreach($scheduling->users as $key=>$ans)
                                @if($ans->role_id == 3)
                                    <span class="badge badge-pill badge-info">{{ $ans->name }}</span>
                                @endif
                              @endforeach
                              <!-- @foreach($users as $user)
                                @if($user->id == $scheduling->user_id)
                                  <span class="badge badge-pill badge-info">{{ $user->name }}</span>
                                @endif
                              @endforeach -->
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($scheduling->status == "aktif")
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