@extends('layouts.myapp')
@section('title', 'Rule')

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
            <h1>Rule</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item active">Rule</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ route('roles.create')}}" class="btn btn-app">
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
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Data Rule</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="rule" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $key=>$rule)
                      <tr> 
                        <td>{{ ++ $key }}</td>
                        <td>{{$rule->name}}</td>
                        <td>{{$rule->desc}}</td>
                        <td>
                            @if($rule->status == "aktif")
                              <span class="badge badge-pill badge-success">Aktif</span>
                            @else
                              <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('roles.show', $rule->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Rule"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('roles.edit', $rule->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Rule"><i class="fa fa-edit"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('roles.destroy', $rule->id) }}" method="POST" class="is-inline">
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

    <script>
      $(function () {
        $('#rule').DataTable( {
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