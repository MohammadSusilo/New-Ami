@extends('layouts.myapp')
@section('title', 'History Dokumen Acuan')

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
            <h1>History Dokumen Acuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">History Dokumen Acuan</li>
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
                <h3 class="card-title">History Dokumen Acuan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive pad">
                <table id="historyDokAcuan" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode</th>
                          <th>Periode</th>
                          <th>Target</th>
                          <th>Unit Target</th>
                          <th>Jenis Dokumen</th>
                          <th>Renop</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($renstra as $key=> $rens)
                      <tr> 
                          <td>{{ ++ $key }}</td>
                          <td>{{ $rens->kode }}</td>
                          <td>{{ $rens->tahun }}</td>
                          <td>{{ $rens->target }}</td>
                          <td>{{ $rens->unit_target }}</td>
                          <td>{{ $rens->jenis }}</td>
                          <td>
                              @foreach ($rens->renop as $renops)
                                  <span class="badge badge-pill badge-info">{{ $renops->kode }}</span>
                              @endforeach
                          </td>
                          <td>
                              @if($rens->status == "aktif")
                                  <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Aktif<span>
                              @endif
                          </td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('renstra.show', $rens->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('renstra.edit', $rens->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('renstra.destroy', $rens->id) }}" method="POST" class="is-inline">
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
        $('#historyDokAcuan').DataTable( {
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