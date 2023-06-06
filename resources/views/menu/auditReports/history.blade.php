@extends('layouts.myapp')
@section('title', 'History Laporan Audit')

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
            <h1>History Laporan Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('ami.index') }}">AMI</a></li>
              <li class="breadcrumb-item active">History Laporan Audit</li>
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
                <h3 class="card-title">History Laporan Audit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyAuditReports" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <th>Periode</th>
                          @endif
                          <th>Standar</th>
                          <th>Uraian Temuan</th>
                          <th>Kategori Temuan</th>
                          <th>Saran Perbaikan</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($auditReports as $key=>$auditReport)
                      <tr> 
                          <td>{{ ++ $key }}</td>
                          @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <td>{{ $auditReport->periode }} ({{ $auditReport->tahun }}) - @foreach($unitKerja as $UK) @if($UK->id == $auditReport->unitkerja_id) {{ $UK->name }} @endif @endforeach</td>
                          @endif
                          <td>{{ $auditReport->standar }}</td>
                          <td>{{ $auditReport->uraianTemuan }}</td>
                          <td>{{ $auditReport->kategoriTemuan }}</td>
                          <td>{{ $auditReport->saranPerbaikan }}</td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('auditReports.show', $auditReport->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  @if(auth()->user()->role_id == 1)
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('auditReports.edit', $auditReport->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('auditReports.destroy', $auditReport->id) }}" method="POST" class="is-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                      </form>
                                  </div>
                                  @endif
                                  <!-- <div style="margin:5px">
                                      <a href="{{ route('auditReports.exportPDF', $auditReport->id)}}">
                                          <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-file-pdf"></i></button>
                                      </a>
                                  </div> -->
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
        $('#historyAuditReports').DataTable( {
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