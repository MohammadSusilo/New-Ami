@extends('layouts.myapp')
@section('title', 'Dokumen Induk ~History')

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
            <h1>History Dokumen Induk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">History Dokumen Induk</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
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
                <h3 class="card-title">History Dokumen Induk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyDokInduk" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Lokasi Berkas</th>
                            <th>Sifat Dokumen</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokInduk as $key=> $dokInd)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $dokInd->name }}</td>
                            <td>{{ $dokInd->lokasi }}</td>
                            <td>
                                @if($dokInd->sifatDokumen == "private")
                                    <span class="badge badge-pill badge-info">Private</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Public</span>
                                @endif
                            </td>
                            <td>
                                @if($dokInd->status == "aktif")
                                    <span class="badge badge-pill badge-info">Aktif</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Non Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <div style="margin:5px">
                                        <!-- Edit -->
                                        <a href="{{ route('dokumen.induk.edit', $dokInd->id) }}">
                                            <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                        </a>
                                    </div>
                                    <div style="margin:5px">
                                        <!-- Destroy -->
                                        <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('dokumen.induk.destroy', $dokInd->id) }}" method="POST" class="is-inline">
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
        $('#historyDokInduk').DataTable( {
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