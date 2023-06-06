@extends('layouts.myapp')
@section('title', 'History CAR')

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
            <h1>History CAR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('ami.index') }}">AMI</a></li>
              <li class="breadcrumb-item active">History CAR</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url('AMI') }}" class="btn btn-app">
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
                <h3 class="card-title">History CAR</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyCAR" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Periode (Tahun)</th>
                          <th>Unit Kerja</th>
                          <th>Kode Standar</th>
                          <th>Nama Standar</th>
                          <th>Analisis Penyebab Masalah</th>
                          <th>Tindakan Penyelesaian</th>
                          <th>Hasil Pemeriksaan</th>
                          <th>Status</th>                
                          <th>ACC</th>           
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($CARs as $key=>$CAR)
                      <tr> 
                          <td>{{ ++ $key }}</td>
                          <td>{{$CAR->periode }} ({{$CAR->tahun }})</td>
                          <td>
                              @foreach($UnitKerja as $UK)
                                @if($UK->id == $CAR->unitkerja_id)
                                    {{ $UK->name }}
                                @endif
                              @endforeach
                          </td>
                          <td>
                            @foreach($standars as $value)
                                @if($value->id == $CAR->standar_id)
                                    {{ $value->kodeStandar }}
                                @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach($standars as $value)
                                @if($value->id == $CAR->standar_id)
                                    {{ $value->namaStandar }}
                                @endif
                            @endforeach
                          </td>
                          <td>{{ $CAR->analisiPenyebabMasalah	 }}</td>
                          <td>{{ $CAR->tindakanPenyelesaian }}</td>
                          <td>
                              @if($CAR->hasilPemeriksaan == "sesuai")
                                  <span class="badge badge-pill badge-success">Sesuai</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                              @endif
                          </td>
                          <td>
                            @if($CAR->status == "open")
                              <span class="badge badge-pill badge-info">Open Check</span>
                            @elseif($CAR->status == "process")
                              <span class="badge badge-pill badge-warning">Process Check</span>
                            @else
                              <span class="badge badge-pill badge-success">Closed Check</span>
                            @endif
                          </td>
                          <td>
                            @foreach($users as $user)
                              @if($user->id == $CAR->acc)
                                {{ $user->name }}
                              @endif
                            @endforeach
                          </td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('CarReports.show', $CAR->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  @if(auth()->user()->role_id == 1)
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('CarReports.edit', $CAR->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('CarReports.destroy', $CAR->id) }}" method="POST" class="is-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                      </form>
                                  </div>
                                  @endif
                              </div>
                          </td>
                      </tr>
                  @endforeach
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
        $('#historyCAR').DataTable( {
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