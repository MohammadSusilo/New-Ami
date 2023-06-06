@extends('layouts.myapp')
@section('title', 'Dokumen')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    {{-- <style>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}</style> --}}
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dokumen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Dokumen</li>
            </ol>
          </div>   
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="dokumenInduk-tab" data-toggle="pill" href="#dokumenInduk" role="tab" aria-controls="dokumenInduk" aria-selected="true">Dokumen Induk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="dokumenChecklist-tab" data-toggle="pill" href="#dokumenChecklist" role="tab" aria-controls="dokumenChecklist" aria-selected="false">Dokumen Checklist</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="dokumenInduk" role="tabpanel" aria-labelledby="dokumenInduk-tab">
                    <table id="dokinduk" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Nomor</th>
                          <th>Revisi</th>
                          <th>Tahun</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dokInduk as $key=> $dokInd)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $dokInd->name }}</td>
                          <td>{{ $dokInd->nomor }}</td>
                          <td>{{ $dokInd->revisi }}</td>
                          <td>{{ $dokInd->tahun_aktif }} - {{ $dokInd->tahun_selesai }}</td>
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
                              <a href="{{ asset($dokInd->lokasi) }}" target="_blank" target="pdf-frame">
                                  <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-eye"></i></button>
                              </a>
                            </div>
                          </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="dokumenChecklist" role="tabpanel" aria-labelledby="dokumenChecklist-tab">
                    <table id="dokcheck" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Unit Kerja</th>
                          <th>Tahun</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($dokCheck as $key=> $dokChk)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $dokChk->name }}</td>
                          <td>
                            @foreach($UK as $key => $value)
                              @if($value->id == $dokChk->unitkerja_id)
                                {{ $value->name }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $dokChk->tahun }}</td>
                          <td>
                            @if($dokChk->status == "aktif")
                                <span class="badge badge-pill badge-info">Aktif</span>
                            @else
                                <span class="badge badge-pill badge-danger">Non Aktif</span>
                            @endif
                          </td>
                          <td>
                          <div class="btn-group">
                            <div style="margin:5px">
                              <!-- Edit -->
                              <a href="{{ asset($dokChk->lokasi) }}" target="_blank" target="pdf-frame">
                                  <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-eye"></i></button>
                              </a>
                            </div>
                          </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card content -->    
                </div>
                <!-- /.card body -->    
              </div>
              <!-- /.card -->
            </div>
          </div>
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

    <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>

    <script>
      $(function () {
        $("#dokinduk").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        $('#dokcheck').DataTable({
          "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "responsive": true,
        });
      });
    </script>

@endpush()