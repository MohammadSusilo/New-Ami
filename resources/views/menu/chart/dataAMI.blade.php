@extends('layouts.myapp')
@section('title', 'AMI')

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
            <h1>AMI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">AMI</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url('chart/create') }}" class="btn btn-app">
                <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">AMI</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="AMI" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th></th>
                          <th>No</th>
                          <th>Tanggal Audit</th>
                          <th>Unit Kerja</th>
                          <th>Standar Laporan Audit</th>
                          <th>Kategori Temuan</th>
                          <th>Uraian Temuan</th>
                          <th>Saran Perbaikan</th>
                          <th>Laporan Temuan</th>
                          <th>Analisis Penyebab Masalah</th>
                          <th>Tindakan Penyelesaian</th>
                          <th>Tindakan Pencegahan</th>
                          <th>Hasil Pemeriksaan</th>
                          <th>Rekomendasi</th>
                          <th>Status</th>   
                      </tr>
                  </thead>
                  <tbody>
                      
                  @if(!empty($Sesuai) || count($Sesuai) >0)
                    @foreach($Sesuai as $key=>$AMI)
                        <tr> 
                            <td></td>
                            <td>{{ ++ $key }}</td>
                            <td>
                              @php $tgl = explode("#", $AMI->tglAudit); @endphp
                                {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                            </td>
                            <td>
                                @foreach($unitKerja as $unitKerjas)
                                    @if($unitKerjas->id == $AMI->unitkerja_id)
                                        {{ $unitKerjas->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $AMI->standar }}</td>
                            <td>{{ $AMI->kategoriTemuan }}</td>
                            <td>{{ $AMI->uraianTemuan }}</td>
                            <td>{{ $AMI->saranPerbaikan }}</td>
                            <td>{{ $AMI->laporanTemuan }}</td>
                            <td>{{ $AMI->analisiPenyebabMasalah }}</td>
                            <td>{{ $AMI->tindakanPenyelesaian }}</td>
                            <td>{{ $AMI->tindakanPencegahan }}</td>
                            <td>
                                @if($AMI->hasilPemeriksaan == "sesuai")
                                    <span class="badge badge-pill badge-info">Sesuai</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                @endif
                            </td>
                            <td>{{ $AMI->rekomendasi }}</td>
                            <td>
                                @if($AMI->status == "open")
                                    <span class="badge badge-pill badge-info">Open Check</span>
                                @elseif($AMI->status == "process")
                                    <span class="badge badge-pill badge-warning">Process Check</span>
                                @else
                                    <span class="badge badge-pill badge-success">Closed Check</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  @elseif(!empty($NonSesuai) || count($NonSesuai) >0)
                    @foreach($NonSesuai as $key=>$AMI)
                          <tr> 
                              <td></td>
                              <td>{{ ++ $key }}</td>
                              <td>
                                @php $tgl = explode("#", $AMI->tglAudit); @endphp
                                  {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                              </td>
                              <td>
                                  @foreach($unitKerja as $unitKerjas)
                                      @if($unitKerjas->id == $AMI->unitkerja_id)
                                          {{ $unitKerjas->name }}
                                      @endif
                                  @endforeach
                              </td>
                              <td>{{ $AMI->standar }}</td>
                              <td>{{ $AMI->kategoriTemuan }}</td>
                              <td>{{ $AMI->uraianTemuan }}</td>
                              <td>{{ $AMI->saranPerbaikan }}</td>
                              <td>{{ $AMI->laporanTemuan }}</td>
                              <td>{{ $AMI->analisiPenyebabMasalah }}</td>
                              <td>{{ $AMI->tindakanPenyelesaian }}</td>
                              <td>{{ $AMI->tindakanPencegahan }}</td>
                              <td>
                                  @if($AMI->hasilPemeriksaan == "sesuai")
                                      <span class="badge badge-pill badge-info">Sesuai</span>
                                  @else
                                      <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                  @endif
                              </td>
                              <td>{{ $AMI->rekomendasi }}</td>
                              <td>
                                  @if($AMI->status == "open")
                                      <span class="badge badge-pill badge-info">Open Check</span>
                                  @elseif($AMI->status == "process")
                                      <span class="badge badge-pill badge-warning">Process Check</span>
                                  @else
                                      <span class="badge badge-pill badge-success">Closed Check</span>
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  @elseif(!empty($Open) || count($Open) >0)
                      @foreach($Open as $key=>$AMI)
                          <tr> 
                              <td></td>
                              <td>{{ ++ $key }}</td>
                              <td>
                                @php $tgl = explode("#", $AMI->tglAudit); @endphp
                                  {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                              </td>
                              <td>
                                  @foreach($unitKerja as $unitKerjas)
                                      @if($unitKerjas->id == $AMI->unitkerja_id)
                                          {{ $unitKerjas->name }}
                                      @endif
                                  @endforeach
                              </td>
                              <td>{{ $AMI->standar }}</td>
                              <td>{{ $AMI->kategoriTemuan }}</td>
                              <td>{{ $AMI->uraianTemuan }}</td>
                              <td>{{ $AMI->saranPerbaikan }}</td>
                              <td>{{ $AMI->laporanTemuan }}</td>
                              <td>{{ $AMI->analisiPenyebabMasalah }}</td>
                              <td>{{ $AMI->tindakanPenyelesaian }}</td>
                              <td>{{ $AMI->tindakanPencegahan }}</td>
                              <td>
                                  @if($AMI->hasilPemeriksaan == "sesuai")
                                      <span class="badge badge-pill badge-info">Sesuai</span>
                                  @else
                                      <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                  @endif
                              </td>
                              <td>{{ $AMI->rekomendasi }}</td>
                              <td>
                                  @if($AMI->status == "open")
                                      <span class="badge badge-pill badge-info">Open Check</span>
                                  @elseif($AMI->status == "process")
                                      <span class="badge badge-pill badge-warning">Process Check</span>
                                  @else
                                      <span class="badge badge-pill badge-success">Closed Check</span>
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  @else
                      @foreach($Process as $key=>$AMI)
                          <tr> 
                              <td></td>
                              <td>{{ ++ $key }}</td>
                              <td>
                                @php $tgl = explode("#", $AMI->tglAudit); @endphp
                                  {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                              </td>
                              <td>
                                  @foreach($unitKerja as $unitKerjas)
                                      @if($unitKerjas->id == $AMI->unitkerja_id)
                                          {{ $unitKerjas->name }}
                                      @endif
                                  @endforeach
                              </td>
                              <td>{{ $AMI->standar }}</td>
                              <td>{{ $AMI->kategoriTemuan }}</td>
                              <td>{{ $AMI->uraianTemuan }}</td>
                              <td>{{ $AMI->saranPerbaikan }}</td>
                              <td>{{ $AMI->laporanTemuan }}</td>
                              <td>{{ $AMI->analisiPenyebabMasalah }}</td>
                              <td>{{ $AMI->tindakanPenyelesaian }}</td>
                              <td>{{ $AMI->tindakanPencegahan }}</td>
                              <td>
                                  @if($AMI->hasilPemeriksaan == "sesuai")
                                      <span class="badge badge-pill badge-info">Sesuai</span>
                                  @else
                                      <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                  @endif
                              </td>
                              <td>{{ $AMI->rekomendasi }}</td>
                              <td>
                                  @if($AMI->status == "open")
                                      <span class="badge badge-pill badge-info">Open Check</span>
                                  @elseif($AMI->status == "process")
                                      <span class="badge badge-pill badge-warning">Process Check</span>
                                  @else
                                      <span class="badge badge-pill badge-success">Closed Check</span>
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  @endif
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
        $('#AMI').DataTable( {
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