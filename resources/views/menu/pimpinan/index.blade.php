@extends('layouts.myapp')
@section('title', 'Pimpinan')

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
            <h1>Pimpinan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Pimpinan</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ route('pimpinan.create')}}" class="btn btn-app">
              <i class="fas fa-plus"></i> New
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
                <h3 class="card-title">Data Pimpinan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama </th>
                    <th>Jabatan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $j = 0;
                      ?>
                    @foreach($pimpinan as $p)
                      <tr> 
                        <td>{{ ++$j }}</td>
                        <td>{{ $p->name }}</td>
                        <td>
                          <form method="POST" id="search{{$p->id}}" action="{{ url('pimpinanchange') }}">
                            <input name="id" type="hidden" value="{{$p->id}}">
                            @csrf
                            <div class="form-group form-float">
                                <select name="status" id="id" class="form-control show-tick"
                                {{-- onChange="doSomething(document.getElementById('search{{$p->id}}').options[document.getElementById('search{{$p->id}}').selectedIndex].value).submit();"> --}}
                                onChange="document.getElementById('search{{$p->id}}').submit();">
                                {{-- onclick="document.getElementById('search{{$p->id}}').submit();"> --}}
                                    @if ($p->status == "D0")
                                        <option value="D0">Direktur</option>
                                        <option value="WD1">Wakil Direktur 1</option>
                                        <option value="WD2">Wakil Direktur 2</option>
                                        <option value="WD3">Wakil Direktur 3</option>
                                        <option value="WD4">Wakil Direktur 4</option>
                                    @elseif ($p->status == "WD1")
                                        <option value="WD1">Wakil Direktur 1</option>
                                        <option value="WD2">Wakil Direktur 2</option>
                                        <option value="WD3">Wakil Direktur 3</option>
                                        <option value="WD4">Wakil Direktur 4</option>
                                        <option value="D0">Direktur</option>
                                    @elseif ($p->status == "WD2")
                                        <option value="WD2">Wakil Direktur 2</option>
                                        <option value="WD3">Wakil Direktur 3</option>
                                        <option value="WD4">Wakil Direktur 4</option>
                                        <option value="D0">Direktur</option>
                                        <option value="WD1">Wakil Direktur 1</option>
                                    @elseif ($p->status == "WD3")
                                        <option value="WD3">Wakil Direktur 3</option>
                                        <option value="WD4">Wakil Direktur 4</option>
                                        <option value="D0">Direktur</option>
                                        <option value="WD1">Wakil Direktur 1</option>
                                        <option value="WD2">Wakil Direktur 2</option>
                                    @else
                                        <option value="WD4">Wakil Direktur 4</option>
                                        <option value="D0">Direktur</option>
                                        <option value="WD1">Wakil Direktur 1</option>
                                        <option value="WD2">Wakil Direktur 2</option>
                                        <option value="WD3">Wakil Direktur 3</option>
                                    @endif
                                </select>
                            </div>
                          </form>
                        </td>
                        <td>
                          <div class="btn-group">
                            <div style="margin:5px">
                            <!-- Show -->
                            <a href="{{ route('pimpinan.show', $p->id) }}">
                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Edit -->
                            <a href="{{ route('pimpinan.edit', $p->id) }}">
                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Destroy -->
                            <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('pimpinan.destroy', $p->id) }}" method="POST" class="is-inline">
                                @csrf
                                @method('DELETE')
                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                            </form>
                            </div>
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