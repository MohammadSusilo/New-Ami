@extends('layouts.myapp')
@section('title', 'History Hasil TM')

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
            <h1>History Hasil TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tinjauanManajemen.index') }}">Tinjauan Manajemen</a></li>
              <li class="breadcrumb-item active">History Hasil TM</li>
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
                <h3 class="card-title">History Hasil TM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyHasilTM" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Jadwal TM</th>
                          <th>Subjek</th>
                          <th>Hasil Pembahasan</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($hasilTM as $key=>$hasil)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>
                            @foreach ($jadwalTM as $JA)
                              @if($JA->id == $hasil->tm_id)
                                  {{ date('d F Y', strtotime($JA->tglTM))  }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $hasil->subjek }}</td>
                          <td>{{ $hasil->hasilPembahasan }}</td>
                          <td>
                              @if($hasil->status == "aktif")
                                  <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                              @endif
                          </td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('hasilTM.show', $hasil->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  @if(auth()->user()->role_id == 1)
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('hasilTM.edit', $hasil->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('hasilTM.destroy', $hasil->id) }}" method="POST" class="is-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                      </form>
                                  </div>
                                  @endif
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('hasilTM.selectExportPDF', $hasil->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fas fa-file-pdf"></i> Export Hasil Rapat</button>
                                      </a>
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
        $('#historyHasilTM').DataTable( {
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