@extends('layouts.myapp')
@section('title', 'Laporan Audit ~ Show')

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
            <h1>Lihat Laporan Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">Laporan Audit</li>
              <li class="breadcrumb-item active">Lihat Laporan Audit</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('AMI') }}" class="btn btn-app">
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
                <h3 class="card-title">Data Laporan Audit</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
						<table class="table table-bordered table-striped">
						<thead>
                        <tr>
                            <th>Jadwal Periode Audit</th>
                            <td>:</td>
                            <td>
                              <span class="badge badge-pill badge-info">
                                {{ $auditReports->jadwalAudit->periode }} ({{ $auditReports->jadwalAudit->tahun }}) - @foreach($unitKerja as $UK) @if($UK->id == $auditReports->jadwalAudit->unitkerja_id) {{ $UK->name }} @endif @endforeach
                              </span>
                            </td>
                        </tr>
						            <tr>
                            <th>Kode Standar</th>
                            <td>:</td>
                            <td>{{ $auditReports->standars->kodeStandar }} - {{ $auditReports->standars->namaStandar }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Temuan</th>
                            <td>:</td>
                            <td>
                              @if($auditReports->kategoriTemuan == "OFI")
                                <span class="badge badge-pill badge-info">Opportunity for Improvement</option>
                              @elseif($auditReports->kategoriTemuan == "AOC")
                                <span class="badge badge-pill badge-info">Area of Concern</option>
                              @else
                                <span class="badge badge-pill badge-info">Non-Conformity</option>
                              @endif
                              {{-- <span class="badge badge-pill badge-info">{{ $auditReports->kategoriTemuan }}</span> --}}
                            </td>
                        </tr>
                        <tr>
                            <th>Uraian Temuan</th>
                            <td>:</td>
                            <td>{!! $auditReports->uraianTemuan !!}</td>
                        </tr>
                        <tr>
                            <th>Saran Perbaikan</th>
                            <td>:</td>
                            <td>{!! $auditReports->saranPerbaikan !!}</td>
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