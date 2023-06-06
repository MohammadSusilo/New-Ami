@extends('layouts.myapp')
@section('title', 'History Dokumen Checklist')

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
            <h1>History Dokumen Checklist</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">History Dokumen Checklist</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div>      
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
                <h3 class="card-title">History Dokumen Checklist</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyDokCheck" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Lokasi Berkas</th>
                          @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                              <th>Unit Kerja</th>
                          @endif
                          <th>Status</th>
                          @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                              <th>Action</th>
                          @endif
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($dokCheck as $key=> $dokChk)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $dokChk->name }}</td>
                          <td>{{ $dokChk->lokasi }}</td>
                          @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                              <td>
                                  @foreach($unitKerja as $key => $value)
                                      @if($value->id == $dokChk->unitkerja_id)
                                          {{ $value->name }}
                                      @endif
                                  @endforeach
                              </td>
                          @endif
                          <td>
                              @if($dokChk->status == "aktif")
                                  <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                              @endif
                          </td>
                          @if(auth()->user()->role_id == 1)
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('dokumen.checklist.edit', $dokChk->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('dokumen.checklist.destroy', $dokChk->id) }}" method="POST" class="is-inline">
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
        $('#historyDokCheck').DataTable( {
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