@extends('layouts.myapp')
@section('title', 'Scheduling')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush()

@section('content')
  @php
    $role = auth()->user()->role_id;
  @endphp
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Scheduling</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item active">Scheduling</li>
            </ol>
          </div>
          <div class="col-sm-4">
          <a href="{{ route('scheduling.create')}}" class="btn btn-app">
            {{-- <a href="{{ route('scheduling.create')}}" class="btn btn-app"> --}}
              <i class="fas fa-plus"></i> New
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
                <h3 class="card-title">Scheduling</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive pad">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Periode</th>
                    {{-- <th>Kode Audit</th> --}}
                    <th>UK</th>
                    <th>Auditor</th>
                    <th>Auditee</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($scheduling as $key=>$sch)
                      <tr> 
                        <td>{{ ++$key }}</td>
                        <td>{{$sch->periode }}</td>
                        <td>
                          @foreach ($unitKerja as $unitKerjas)
                            @if($unitKerjas->id == $sch->unitkerja_id)
                              {{ $unitKerjas->name }}
                            @endif
                          @endforeach
                        </td>
                        <td>
                          @foreach ($users as $user)
                            @if($user->id == $sch->user_id)
                              @if($user->role_id == "4")
                                {{ $user->name }}
                              @endif
                            @endif
                          @endforeach
                        </td>
                        <td>
                          @foreach($sch->users as $user)
                              {{$user->name}}
                          @endforeach
                        </td>
                        <td>{{$sch->tglAudit }}</td>
                        <td>{{$sch->status }}</td>
                        <td>
                          <div class="btn-group">
                              <div style="margin:5px">
                              <!-- Show -->
                              <a href="{{ route('scheduling.show', $sch->id) }}">
                                  <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                              </a>
                              </div>
                              <div style="margin:5px">
                              <!-- Edit -->
                              <a href="{{ route('scheduling.edit', $sch->id) }}">
                                  <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                              </a>
                              </div>
                              <div style="margin:5px">
                              <!-- Destroy -->
                              <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('scheduling.destroy', $sch->id) }}" method="POST" class="is-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                              </form>
                              </div>
                              @foreach($TM as $TMJ)
                                  @if($sch->id != $TMJ->audit_id)
                                  <div style="margin:5px">
                                    <a href="{{ route('jadwalTM.new', $sch->id) }}">
                                        <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Jadwal TM</button>
                                    </a>
                                  </div>
                                  @endif
                              @endforeach
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