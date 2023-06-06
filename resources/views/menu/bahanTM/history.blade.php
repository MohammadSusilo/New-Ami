@extends('layouts.myapp')
@section('title', 'History Bahan TM')

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
            <h1>History Bahan TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tinjauanManajemen.index') }}">Tinjauan Manajemen</a></li>
              <li class="breadcrumb-item active">History Bahan TM</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('TinjauanManajemen') }}" class="btn btn-app">
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
                <h3 class="card-title">History Bahan TM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyBahanTM" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Jadwal TM</th>
                          <th>Deskripsi</th>
                          <th>Lokasi</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($bahanTM as $key=>$bahan)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>
                            {{ date('d F Y', strtotime($bahan->tglTM))  }}
                          </td>
                          <td>{{ $bahan->deskripsi }}</td>
                          <td>
                              @php $fileCARs = DB::table('car')->where('car.id', '=', $bahan->car_id)->first(); @endphp
                              <a href="{{ asset($fileCARs->file) }}" target="_blank" target="pdf-frame">{{ asset($fileCARs->file) }}</a>
                          </td>
                          <td>
                              @if($bahan->status == "aktif")
                                  <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                              @endif
                          </td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('bahanTM.show', $bahan->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  @if(auth()->user()->role_id == 1)
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('bahanTM.edit', $bahan->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('bahanTM.destroy', $bahan->id) }}" method="POST" class="is-inline">
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
    <script>
      $(function () {
        $('#historyBahanTM').DataTable( {
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