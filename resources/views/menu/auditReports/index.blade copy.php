@extends('layouts.myapp')
@section('title', 'Audit Reports')

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
            <h1>Audit Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Report</li>
              <li class="breadcrumb-item active">Audit Reports</li>
            </ol>
          </div>
          @if(auth()->user()->role_id != 3)
          <div class="col-sm-4">
            <a href="{{ route('auditReports.create')}}" class="btn btn-app">
              <i class="fas fa-plus"></i> New
            </a>
          </div>    
          @endif
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
                <h3 class="card-title">Audit Reports</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    @if (auth()->user()->role_id == 1)
                      <th>Periode</th>
                    @endif
                    <th>Kode Audit</th>
                    <th>Deskripsi Temuan</th>
                    @if (auth()->user()->role_id == 1)
                      <th>Status Temuan</th>
                    @endif
                    <th>Saran Perbaikan</th>
                    <th>Status Akhir</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($auditReports as $key=>$auditReport)
                      <tr> 
                        <td>{{ ++$key }}</td>
                        @if (auth()->user()->role_id == 1)
                          <td>{{ $auditReport->jadwalAudit->periode }}</td>
                        @endif
                        <td>{{ $auditReport->standar }}</td>
                        <td>{{ $auditReport->uraianTemuan }}</td>
                        @if (auth()->user()->role_id == 1)
                          <td>{{ $auditReport->kategoriTemuan }}</td>
                        @endif
                        <td>{{ $auditReport->saranPerbaikan }}</td>
                        <td>{{ $auditReport->status }}</td>
                        <td>
                          <div class="btn-group">
                            <div style="margin:5px">
                            <!-- Show -->
                            <a href="{{ route('auditReports.show', $auditReport->id) }}">
                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                            </a>
                            </div>
                            @if(auth()->user()->role_id != 3)
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

    <!--This page plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

@endpush()