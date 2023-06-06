@extends('layouts.myapp')
@section('title', 'History Tindak Lanjut TM')

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
            <h1>History Tindak Lanjut TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tinjauanManajemen.index') }}">Tinjauan Manajemen</a></li>
              <li class="breadcrumb-item active">History Tindak Lanjut TM</li>
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
                <h3 class="card-title">History Tindak Lanjut TM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="historyTindakTM" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Hasil TM</th>
                          <th>Tindak Lanjut</th>
                          <th>PIC</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  @foreach($tindakTM as $key=>$tindak)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>
                            @foreach ($hasilTM as $HA)
                              @if($HA->id == $tindak->hslrpt_id)
                                {{ $HA->subjek }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $tindak->tindakLanjut }}</td>
                          <td>
                              @foreach($users as $user)
                                  @foreach(explode(',', $tindak->PIC) as $info) 
                                      @if($user->id == $info )    
                                          <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                      @endif
                                  @endforeach
                              @endforeach
                          </td>
                          <td>
                              @if($tindak->status == "selesai")
                                  <span class="badge badge-pill badge-success">Selesai</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Belum Selesai</span>
                              @endif
                          </td>
                          <td>
                              <div class="btn-group">
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('tindakLanjutTM.show', $tindak->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                      </a>
                                  </div>
                                  @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                  <div style="margin:5px">
                                      <!-- Edit -->
                                      <a href="{{ route('tindakLanjutTM.edit', $tindak->id) }}">
                                          <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                      </a>
                                  </div>
                                  @endif
                                  @if(auth()->user()->role_id == 1)
                                  <div style="margin:5px">
                                      <!-- Destroy -->
                                      <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('tindakLanjutTM.destroy', $tindak->id) }}" method="POST" class="is-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                      </form>
                                  </div>
                                  @endif
                                  <div style="margin:5px">
                                      <!-- Show -->
                                      <a href="{{ route('tindakLanjutTM.selectExportPenyelesaianPDF', $tindak->id) }}">
                                          <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fas fa-file-pdf"></i> Export Penyelesaian TM</button>
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
        $('#historyTindakTM').DataTable( {
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