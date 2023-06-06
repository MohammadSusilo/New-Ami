@extends('layouts.myapp')
@section('title', 'Backup')

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
            <h1>Backup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item active">Backup</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <form action="{{ url('backup/create') }}" method="GET" class="add-new-backup" enctype="multipart/form-data" id="CreateBackupForm">
                {{ csrf_field() }}
                <button type="submit" name="submit" class="button btn btn-app" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fas fa-plus"></i> New</button>
                <!-- <input type="submit" name="submit" class="theme-button btn btn-app pull-right" style="margin-bottom:2em;" value="Create Database Backup">
                <i class="fas fa-plus"></i> New -->
            </form>
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
                <h3 class="card-title">Backup</h3>
              </div>
              <!-- /.card-header -->
              <!-- @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('success') }}
                </div>
                @endif

                @if ( Session::has('update') )
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('update') }}
                </div>
                @endif

                @if ( Session::has('delete') )
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('delete') }}
                </div>
             @endif -->
              <div class="card-body table-responsive pad">
                @if (count($backups))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File Name</th>
                            <th>File Size</th>
                            <th>Created Date</th>
                            <th>Created Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups as $key=>$backup)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $backup['file_name'] }}</td>
                                <td>{{ \App\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }}</td>
                                <td>
                                    {{ date('F jS, Y, g:ia (T)',$backup['last_modified']) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <a href="{{ url('backup/download/'.$backup['file_name']) }}">
                                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-download"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <a href="{{ url('backup/restore/'.$backup['file_name']) }}">
                                                <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-upload"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <a href="{{ url('backup/delete/'.$backup['file_name']) }}">
                                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-times"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="well">
                        <h4>No backups</h4>
                    </div>
                @endif
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
    <script type="text/javascript">
        $("#CreateBackupForm").on('submit',function(e){
            $('.theme-button').attr('disabled','disabled');
        });
    </script>

@endpush()