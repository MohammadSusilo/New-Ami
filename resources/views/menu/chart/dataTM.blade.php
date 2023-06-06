@extends('layouts.myapp')
@section('title', 'TM')

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
            <h1>TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">TM</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url('chart/create') }}" class="btn btn-app">
                <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="TM" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th></th>
                          <th>No</th>
                          <th>Tanggal TM</th>
                          <th>Unit Kerja</th>
                          <th>Subjek</th>
                          <th>UraianTemuan</th>
                          <th>Hasil Pembahasan</th>
                          <th>Hadir</th>
                          <th>Tidak Hadir</th>
                          <th>Tindak Lanjut</th>
                          <th>PIC</th>
                          <th>Status</th>   
                      </tr>
                  </thead>
                  <tbody>
                  @if(!empty($Selesai) || count($Selesai) >0)
                    @foreach($Selesai as $key=>$AMI)
                        <tr> 
                            <td></td>
                            <td>{{ ++ $key }}</td>
                            <td>
                                {{ date('d F Y', strtotime($AMI->tglTM)) }}
                            </td>
                            <td>
                                @foreach($unitKerja as $unitKerjas)
                                    @if($unitKerjas->id == $AMI->unitkerja_id)
                                        {{ $unitKerjas->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $AMI->subjek }}</td>
                            <td>{{ $AMI->uraian }}</td>
                            <td>{{ $AMI->hasilPembahasan }}</td>
                            <td>{{ $AMI->hadir }}</td>
                            <td>{{ $AMI->tidakHadir }}</td>
                            <td>{{ $AMI->tindakLanjut }}</td>
                            <td>
                                @foreach($users as $user)
                                    @foreach(explode(',', $AMI->PIC) as $info) 
                                        @if($user->id == $info )    
                                            <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @if($AMI->status == "selesai")
                                    <span class="badge badge-pill badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  @else
                    @foreach($NonSelesai as $key=>$AMI)
                        <tr> 
                            <td></td>
                            <td>{{ ++ $key }}</td>
                            <td>
                                {{ date('d F Y', strtotime($AMI->tglTM)) }}
                            </td>
                            <td>
                                @foreach($unitKerja as $unitKerjas)
                                    @if($unitKerjas->id == $AMI->unitkerja_id)
                                        {{ $unitKerjas->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $AMI->subjek }}</td>
                            <td>{{ $AMI->uraian }}</td>
                            <td>{{ $AMI->hasilPembahasan }}</td>
                            <td>{{ $AMI->hadir }}</td>
                            <td>{{ $AMI->tidakHadir }}</td>
                            <td>{{ $AMI->tindakLanjut }}</td>
                            <td>
                                @foreach($users as $user)
                                    @foreach(explode(',', $AMI->PIC) as $info) 
                                        @if($user->id == $info )    
                                            <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @if($AMI->status == "selesai")
                                    <span class="badge badge-pill badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                @endif
                            </td>
                        </tr>
                      @endforeach
                  @endif
                  </tbody>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <script>
      $(function () {
        $('#TM').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
      });
    </script>

@endpush()