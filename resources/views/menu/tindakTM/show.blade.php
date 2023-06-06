@extends('layouts.myapp')
@section('title', 'Tindak Lanjut TM ~ Show')

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
            <h1>Lihat Tindak Lanjut TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Renop</li>
              <li class="breadcrumb-item">Tinjauan Manajemen</li>
              <li class="breadcrumb-item active">Lihat Tindak Lanjut TM</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('/TinjauanManajemen') }}" class="btn btn-app">
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
                <h3 class="card-title">Data Tindak Lanjut TM</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Jadwal TM</th>
                            <td>:</td>
                            <td>
                              @foreach ($hasilTM as $HA)
                                @if($HA->id == $tindakTM->hslrpt_id)
                                  {{ $HA->subjek }}
                                @endif
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Tindak Lanjut</th>
                            <td>:</td>
                            <td>{{ $tindakTM->tindakLanjut }}</td>
                        </tr>
                        <tr>
                            <th>PIC</th>
                            <td>:</td>
                            <td>
                              @foreach($users as $user)
                                  @foreach(explode(',', $tindakTM->PIC) as $info) 
                                      @if($user->id == $info )    
                                          <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                      @endif
                                  @endforeach
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($tindakTM->status == "selesai")
                                <span class="badge badge-pill badge-success">Selesai</span>
                              @else
                                <span class="badge badge-pill badge-danger">Belum Selesai</span>
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