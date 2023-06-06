@extends('layouts.myapp')
@section('title', 'History Jadwal TM')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>History Jadwal TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tinjauanManajemen.index') }}">Tinjauan Manajemen</a></li>
              <li class="breadcrumb-item active">History Jadwal TM</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('TinjauanManajemen') }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">History Jadwal TM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyJadwalTM" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Jadwal Audit</th>
                          <th>Tanggal TM</th>
                          <th>Tahun</th>
                          <th>Status</th>
                          @if(auth()->user()->role_id == 1)
                          <th>Action</th>
                          @endif
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($jadwalTM as $key=>$jadwal)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>
                            @foreach ($jadwalAudit as $JA)
                              @if($JA->id == $jadwal->audit_id)
                                @php $tgl = explode("#", $JA->tglAudit); @endphp
                                {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                              @endif
                            @endforeach
                          </td>
                          <!-- <td>{{ $jadwal->waktuTM }}</td> -->
                          <td>{{ date('d F Y', strtotime($jadwal->tglTM))  }}</td>
                          <td>{{ $jadwal->tahun }}</td>
                          <td>
                              @if($jadwal->status == "aktif")
                                  <span class="badge badge-pill badge-info">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Non Aktif</span>
                              @endif
                          </td>
                          @if(auth()->user()->role_id == 1)
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('jadwalTM.show', $jadwal->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('jadwalTM.edit', $jadwal->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('jadwalTM.destroy', $jadwal->id) }}" method="POST" class="is-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                      </form>
                                  </div>
                              </div>
                          </td>
                          @endif
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
        $('#historyJadwalTM').DataTable( {
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