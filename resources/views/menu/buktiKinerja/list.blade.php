@extends('layouts.myapp')
@section('title', 'List Bukti Kinerja Unit')

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
            <h1>List Bukti Kinerja Unit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item"><a href="{{ route('renstraRenop.index') }}">Dokumens & Rencana Operasional</a></li>
              <li class="breadcrumb-item active">List Bukti Kinerja Unit</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('/RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
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
                <h3 class="card-title">List Bukti Kinerja Unit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="listBuktiKinerja" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Bukti</th>
                      <th>Kinerja Unit</th>
                      <th>Lokasi</th>
                      <th>Tahun</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($buktiKinerja as $key=>$buktis)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $buktis->namaBukti }}</td>
                      <td>
                        @foreach ($kinerjaUnit as $KU)
                          @if($KU->id == $buktis->kinerjaUnit_id)
                            {{ $KU->deskripsi }}
                          @endif
                        @endforeach
                      </td>
                      <td>
                        <a href="{{ asset($buktis->lokDokBukti) }}" target="_blank" target="pdf-frame">{{ asset($buktis->lokDokBukti) }}</a>
                      </td>
                      <td>{{ $buktis->tahun }}</td>
                      <td>{{ $buktis->status }}</td>
                      <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                            <!-- Show -->
                            <a href="{{ route('buktiKinerja.show', $buktis->id) }}">
                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Edit -->
                            <a href="{{ route('buktiKinerja.edit', $buktis->id) }}">
                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Destroy -->
                            <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('buktiKinerja.destroy', $buktis->id) }}" method="POST" class="is-inline">
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
        $('#listBuktiKinerja').DataTable( {
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