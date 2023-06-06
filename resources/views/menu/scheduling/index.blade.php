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
            <h1>Histori Jadwal Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">Jadwal Audit</li>
              <li class="breadcrumb-item active">Histori Jadwal Audit</li>
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
                <h3 class="card-title">Scheduling</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive pad">
                <!-- Table Jadwal Audit -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Unit Kerja</th>
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
                            <td>{{ ++ $key }}</td>
                            <td>{{$sch->periode }}</td>
                            <td>{{$sch->tahun }}</td>
                            <td>
                            @foreach ($unitKerja as $unitKerjas)
                                @if($unitKerjas->id == $sch->unitkerja_id)
                                {{ $unitKerjas->name }}
                                @endif
                            @endforeach
                            </td>
                            <td>
                                @if(auth()->user()->role_id == 1)
                                    @foreach($sch->users as $user)
                                        @if($user->role_id =="2")
                                            <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($selectUserpivot as $userPivot)
                                        @if($userPivot->role_id == "2" && $userPivot->jadwal_id == $sch->jadwal_id)
                                            <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->role_id == 1)
                                    @foreach($sch->users as $user)
                                        @if($user->role_id =="3")
                                        <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($selectUserpivot as $userPivot)
                                        @if($userPivot->role_id == "3" && $userPivot->jadwal_id == $sch->jadwal_id)
                                            <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ date('d F Y', strtotime($sch->tglAudit))  }}</td>
                            <td>
                                @if($sch->status == "aktif")
                                    <span class="badge badge-pill badge-info">Aktif</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Non Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <div style="margin:5px">
                                        <!-- Show -->
                                        <a href="{{ route('scheduling.show', $sch->id) }}">
                                            <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </div>
                                    @if(auth()->user()->role_id == 1)
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
                                    <!-- <div style="margin:5px">
                                    <a href="{{ route('jadwalTM.new', $sch->id) }}">
                                        <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Jadwal TM</button>
                                    </a>
                                    </div> -->
                                        <!-- @if(isset($TM))
                                            @if(count($TM)>0)
                                                @foreach($TM as $TMJ)
                                                    @if($sch->id == $TMJ->audit_id)
                                                    
                                                    @else
                                                    <div style="margin:5px">
                                                        <a href="{{ route('jadwalTM.new', $sch->id) }}">
                                                            <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Jadwal TM</button>
                                                        </a>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div style="margin:5px">
                                                    <a href="{{ route('jadwalTM.new', $sch->id) }}">
                                                        <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Jadwal TM</button>
                                                    </a>
                                                </div>
                                            @endif
                                        @endif -->
                                            <!-- <div style="margin:5px">-->
                                            <!--  <a href="{{ route('jadwalTM.newMulti', $sch->id) }}">-->
                                            <!--      <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Jadwal TM Multiple</button>-->
                                            <!--  </a>-->
                                            <!--</div>-->
                                    @endif
                                    <!-- Surat -->
                                    <!-- <div style="margin:5px">
                                        <a href="{{ route('scheduling.selectExportSuratPDF', $sch->id) }}">
                                            <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fas fa-file-pdf"></i> Export Surat Pemberitahuan</button>
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