@extends('layouts.myapp')
@section('title', 'Renstra')

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
            <h1>Renstra</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Renstra</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
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
                <h3 class="card-title">Renstra</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive pad">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Renop</th>
                            <th>Deskripsi</th>
                            <th>Unit Capaian</th>
                            <th>Nilai Capaian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($kinerja as $key=>$kinerjas)
                        <tr data-href='{{ route('buktiKinerja.list', $kinerjas->id) }}'>
                        <!-- <tr> -->
                            <td>{{ ++$key }}</td>
                            <td>
                                @foreach ($renop as $RN)
                                  @if($RN->id == $kinerjas->renop_id)
                                    {{ $RN->kode }}
                                  @endif
                                @endforeach
                            </td>
                            <td>{{ $kinerjas->deskripsi }}</td>
                            <td>{{ $kinerjas->unitCapaian }}</td>
                            <td>{{ $kinerjas->nilaiCapaian }}</td>
                            <td>
                                @if($kinerjas->status == "aktif")
                                    <span class="badge badge-pill badge-info">Aktif</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Non Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <div style="margin:5px">
                                        <!-- Show -->
                                        <a href="{{ route('kinerjaUnit.show', $kinerjas->id) }}">
                                            <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </div>
                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3 )
                                    <div style="margin:5px">
                                        <!-- Edit -->
                                        <a href="{{ route('kinerjaUnit.edit', $kinerjas->id) }}">
                                            <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                        </a>
                                    </div>
                                    <div style="margin:5px">
                                        <!-- Destroy -->
                                        <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('kinerjaUnit.destroy', $kinerjas->id) }}" method="POST" class="is-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                    <div style="margin:5px">
                                        <a href="{{ route('buktiKinerja.list', $kinerjas->id) }}">
                                            <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Bukti"><i class="fas fa-eye"></i> Show List bukti</button>
                                        </a>
                                    </div>
                                    <div style="margin:5px">
                                        <a href="{{ route('buktiKinerja.new', $kinerjas->id) }}">
                                            <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Bukti</button>
                                        </a>
                                    </div>
                                    <div style="margin:5px">
                                        <!-- <a href="#" id="MultibuktiKinerjaRecordplus{{$kinerjas->id}}"> -->
                                        <a href="{{ route('buktiKinerja.newMulti', $kinerjas->id) }}">
                                            <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Multiple Bukti</button>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach                        
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