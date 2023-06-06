@extends('layouts.myapp')
@section('title', 'Report ~ Chart Periode')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Date Picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chart Periode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Report</li>
              <li class="breadcrumb-item active">Chart Periode</li>
            </ol>
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
                <h3 class="card-title">Chart</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Dokumen, Dokumen Acuan, Renop, Kinerja Unit, Bukti Kinerja CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                      <h3 class="card-title">Dokumen, Dokumen Acuan, Renop, Kinerja Unit, Bukti Kinerja</h3>
                    @else
                      <h3 class="card-title">Dokumen, Renop, Kinerja Unit, Bukti Kinerja</h3>
                    @endif

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                  <div class="card card-primary card-tabs">
                      <div class="card-header p-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                          <li class="nav-item">
                            <a class="nav-link active" id="dokumenInduk-tab" data-toggle="pill" href="#dokumenInduk" role="tab" aria-controls="dokumenInduk" aria-selected="true">Dokumen Induk</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="dokumenChecklist-tab" data-toggle="pill" href="#dokumenChecklist" role="tab" aria-controls="dokumenChecklist" aria-selected="true">Dokumen Checklist</a>
                          </li>
                          @endif
                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null)
                          <li class="nav-item">
                            <a class="nav-link active" id="dokumenChecklist-tab" data-toggle="pill" href="#dokumenChecklist" role="tab" aria-controls="dokumenChecklist" aria-selected="true">Dokumen Checklist</a>
                          </li>
                          @endif
                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                          <li class="nav-item">
                            <a class="nav-link" id="dokumenAcuan-tab" data-toggle="pill" href="#dokumenAcuan" role="tab" aria-controls="dokumenAcuan" aria-selected="false">Dokumen Acuan</a>
                          </li>
                          @endif
                          <li class="nav-item">
                            <a class="nav-link" id="renop-tab" data-toggle="pill" href="#renop" role="tab" aria-controls="renop" aria-selected="false">Renop</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="kinerjaUnit-tab" data-toggle="pill" href="#kinerjaUnit" role="tab" aria-controls="kinerjaUnit" aria-selected="false">Kinerja Unit</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="buktiKinerja-tab" data-toggle="pill" href="#buktiKinerja" role="tab" aria-controls="buktiKinerja" aria-selected="false">Bukti Kinerja</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <a href="#" onclick="location.reload();" class="button btn btn-app">
                          <i class="fas fa-sync"></i> Refresh
                        </a>
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                          <!-- Dokumen Induk -->
                          <div class="tab-pane fade show active" id="dokumenInduk" role="tabpanel" aria-labelledby="dokumenInduk-tab">
                              <div class="row">
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiDokumenInduk" placeholder="Enter Tahun Mulai Dokumen" class="form-control dateYear dateTimeDokumenInduk">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiDokumenInduk" placeholder="Enter Tahun Selesai Dokumen" class="form-control dateYear dateTimeDokumenInduk">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectDokumenInduk @error('status') is-invalid @enderror" id="statusDokumenInduk" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>

                            <div id="dokumenIndukchart"></div>
                          </div>

                          <!-- Dokumen Checklist -->
                          <div class="tab-pane fade" id="dokumenChecklist" role="tabpanel" aria-labelledby="dokumenChecklist-tab">
                              <div class="row">
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectDokumenChecklist @error('unitkerja_id') is-invalid @enderror" id="unitKerjaDokumenChecklist" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiDokumenChecklist" placeholder="Enter Tahun Mulai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiDokumenChecklist" placeholder="Enter Tahun Selesai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectDokumenChecklist @error('status') is-invalid @enderror" id="statusDokumenChecklist" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>

                            <div id="dokumenChecklistchart"></div>
                          </div>
                          @endif

                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null)
                          <!-- Dokumen Checklist -->
                          <div class="tab-pane fade show active" id="dokumenChecklist" role="tabpanel" aria-labelledby="dokumenChecklist-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectDokumenChecklist @error('unitkerja_id') is-invalid @enderror" id="unitKerjaDokumenChecklist" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiDokumenChecklist" placeholder="Enter Tahun Mulai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiDokumenChecklist" placeholder="Enter Tahun Selesai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectDokumenChecklist @error('status') is-invalid @enderror" id="statusDokumenChecklist" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @else
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiDokumenChecklist" placeholder="Enter Tahun Mulai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiDokumenChecklist" placeholder="Enter Tahun Selesai Dokumen" class="form-control dateYear dateTimeDokumenChecklist">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectDokumenChecklist @error('status') is-invalid @enderror" id="statusDokumenChecklist" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                              </div>

                            <div id="dokumenChecklistchart"></div>
                          </div>
                          @endif

                          @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                          <!-- Dokumen Acuan -->
                          <div class="tab-pane fade" id="dokumenAcuan" role="tabpanel" aria-labelledby="dokumenAcuan-tab">
                              <div class="row">
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectDokumenAcuan @error('status') is-invalid @enderror" id="jenisDokumenAcuan" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Jenis Dokumen...</option>
                                      <option value="renstra">Renstra</option>  
                                      <option value="PK">PK</option>  
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiDokumenAcuan" placeholder="Enter Tahun Mulai Dokumen" class="form-control dateYear dateTimeDokumenAcuan">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiDokumenAcuan" placeholder="Enter Tahun Selesai Dokumen" class="form-control dateYear dateTimeDokumenAcuan">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectDokumenAcuan @error('status') is-invalid @enderror" id="statusDokumenAcuan" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>

                            <div id="dokumenAcuanchart"></div>
                          </div>
                          @endif

                          <!-- Renop -->
                          <div class="tab-pane fade" id="renop" role="tabpanel" aria-labelledby="renop-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectRenop @error('unitkerja_id') is-invalid @enderror" id="unitKerjaRenop" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiRenop" placeholder="Enter Tahun Mulai Renop" class="form-control dateYear dateTimeRenop">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiRenop" placeholder="Enter Tahun Selesai Renop" class="form-control dateYear dateTimeRenop">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectRenop @error('status') is-invalid @enderror" id="statusRenop" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @else
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiRenop" placeholder="Enter Tahun Mulai Renop" class="form-control dateYear dateTimeRenop">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiRenop" placeholder="Enter Tahun Selesai Renop" class="form-control dateYear dateTimeRenop">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectRenop @error('status') is-invalid @enderror" id="statusRenop" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                              </div>

                            <div id="renopchart"></div>
                          </div>
                          
                          <!-- Kinerja Unit -->
                          <div class="tab-pane fade" id="kinerjaUnit" role="tabpanel" aria-labelledby="kinerjaUnit-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectKinerjaUnit @error('unitkerja_id') is-invalid @enderror" id="unitKerjaKinerjaUnit" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiKinerjaUnit" placeholder="Enter Tahun Mulai KinerjaUnit" class="form-control dateYear dateTimeKinerjaUnit">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiKinerjaUnit" placeholder="Enter Tahun Selesai KinerjaUnit" class="form-control dateYear dateTimeKinerjaUnit">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectKinerjaUnit @error('status') is-invalid @enderror" id="statusKinerjaUnit" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @else
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiKinerjaUnit" placeholder="Enter Tahun Mulai KinerjaUnit" class="form-control dateYear dateTimeKinerjaUnit">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiKinerjaUnit" placeholder="Enter Tahun Selesai KinerjaUnit" class="form-control dateYear dateTimeKinerjaUnit">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectKinerjaUnit @error('status') is-invalid @enderror" id="statusKinerjaUnit" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                              </div>

                            <div id="kinerjaUnitchart"></div>
                          </div>

                          <!-- Bukti Kinerja -->
                          <div class="tab-pane fade" id="buktiKinerja" role="tabpanel" aria-labelledby="buktiKinerja-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectBuktiKinerja @error('unitkerja_id') is-invalid @enderror" id="unitKerjaBuktiKinerja" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiBuktiKinerja" placeholder="Enter Tahun Mulai BuktiKinerja" class="form-control dateYear dateTimeBuktiKinerja">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiBuktiKinerja" placeholder="Enter Tahun Selesai BuktiKinerja" class="form-control dateYear dateTimeBuktiKinerja">
                                </div>
                                <div class="form-group col-12">
                                  <select class="form-control selectBuktiKinerja @error('status') is-invalid @enderror" id="statusBuktiKinerja" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @else
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiBuktiKinerja" placeholder="Enter Tahun Mulai BuktiKinerja" class="form-control dateYear dateTimeBuktiKinerja">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiBuktiKinerja" placeholder="Enter Tahun Selesai BuktiKinerja" class="form-control dateYear dateTimeBuktiKinerja">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectBuktiKinerja @error('status') is-invalid @enderror" id="statusBuktiKinerja" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                              </div>

                            <div id="buktiKinerjachart"></div>
                          </div>

                        </div>
                        <!-- /.card body -->    
                      </div>
                      <!-- /.card -->
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- AMI CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">AMI Chart</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                        <!-- AMI -->
                          <a href="#" onclick="location.reload();" class="button btn btn-app">
                            <i class="fas fa-sync"></i> Refresh
                          </a>
                          <div><font color="red">Pilih salah satu antara select Unit Kerja atau select Tahun</font></div>
                          <div class="row">
                              @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-4">
                                  <select class="form-control select2bs4PR select @error('unitkerja_id') is-invalid @enderror" id="UKAMI" style="width: 100%;">
                                      <!-- <option disabled selected="selected">Pilih Unit Kerja...</option> -->
                                      <option selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-4">
                                  <input type="text" id="tglMulaiAudit" placeholder="Enter Tahun Mulai Audit" class="form-control dateYear dateTimeAudit">
                                </div>
                                <div class="form-group col-4">
                                  <input type="text" id="tglSelesaiAudit" placeholder="Enter Tahun Selesai Audit" class="form-control dateYear dateTimeAudit">
                                </div>
                              @else
                                <div class="form-group col-6">
                                  <input type="text" id="tglMulaiAudit" placeholder="Enter Tahun Mulai Audit" class="form-control dateYear dateTimeAudit">
                                </div>
                                <div class="form-group col-6">
                                  <input type="text" id="tglSelesaiAudit" placeholder="Enter Tahun Selesai Audit" class="form-control dateYear dateTimeAudit">
                                </div>
                              @endif
                            </div>

                            <div id="AMI"></div>

                          </div>
                        <!-- #END AMI -->

                    <!-- <div class="card card-primary card-tabs">
                      <div class="card-header p-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="jadwalAudit-tab" data-toggle="pill" href="#jadwalAudit" role="tab" aria-controls="jadwalAudit" aria-selected="true">Jadwal Audit</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="laporanAudit-tab" data-toggle="pill" href="#laporanAudit" role="tab" aria-controls="laporanAudit" aria-selected="true">Laporan Audit</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="CAR-tab" data-toggle="pill" href="#CAR" role="tab" aria-controls="CAR" aria-selected="false">CAR</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body"> -->
                        
                        <!-- <a href="#" onclick="location.reload();" class="button btn btn-app">
                          <i class="fas fa-sync"></i> Refresh
                        </a>
                        <div class="tab-content" id="custom-tabs-one-tabContent"> -->
                          <!-- Jadwal -->
                          <!-- <div class="tab-pane fade show active" id="jadwalAudit" role="tabpanel" aria-labelledby="jadwalAudit-tab">
                            <div class="row">
                              @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR select @error('unitkerja_id') is-invalid @enderror" id="unitKerjaJadwalAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Unit Kerja...</option>
                                    @foreach($unitKerja as $UK)
                                        <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR select @error('unitkerja_id') is-invalid @enderror" id="JadwalAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Periode...</option>
                                    @foreach($jadwalAudits as $audit)
                                        <option value="{{$audit->periode.','.$audit->tahun}}">Periode: {{ $audit->periode }} ({{ $audit->tahun }})</option>  
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control select @error('status') is-invalid @enderror" id="statusJadwalAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Status...</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Tidak Aktif</option>
                                </select>
                              </div>
                              @endif
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR select @error('unitkerja_id') is-invalid @enderror" id="JadwalAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Periode...</option>
                                    @foreach($jadwalAudits as $audit)
                                        <option value="{{$audit->periode.','.$audit->tahun}}">Periode: {{ $audit->periode }} ({{ $audit->tahun }})</option>  
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group col-6">
                                <select class="form-control select @error('status') is-invalid @enderror" id="statusJadwalAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Status...</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Tidak Aktif</option>
                                </select>
                              </div>
                            </div>
                            
                            <div id="jadwalAuditchart"></div>
                          </div> -->

                          <!-- Laporan -->
                          <!-- <div class="tab-pane fade" id="laporanAudit" role="tabpanel" aria-labelledby="laporanAudit-tab">
                            <div class="row">
                              @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="unitKerjaLaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Unit Kerja...</option>
                                    @foreach($unitKerja as $UK)
                                        <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="standarLaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Standar...</option>
                                    <option value="SPd">Standar Pendidikan</option>
                                    <option value="SLit">Standar Penelitian</option>
                                    <option value="SPkM">Standar Pengabdian Kepada Masyarakat</option>
                                    <option value="SAk">Standar Akademik</option>
                                    <option value="SNAk">Standar Non Akademik</option>
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="kategoriLaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Kategori...</option>
                                    <option value="OFI">Opportunity for Improvement</option>
                                    <option value="AOC">Area of Concern</option>
                                    <option value="NC">Non-Conformity</option>
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="LaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Periode...</option>
                                    @foreach($jadwalAudits as $audit)
                                        <option value="{{$audit->periode.','.$audit->tahun}}">Periode: {{ $audit->periode }} ({{ $audit->tahun }})</option>  
                                    @endforeach
                                </select>
                              </div>
                              @endif
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="standarLaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Standar...</option>
                                    <option value="SPd">Standar Pendidikan</option>
                                    <option value="SLit">Standar Penelitian</option>
                                    <option value="SPkM">Standar Pengabdian Kepada Masyarakat</option>
                                    <option value="SAk">Standar Akademik</option>
                                    <option value="SNAk">Standar Non Akademik</option>
                                </select>
                              </div>
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="kategoriLaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Kategori...</option>
                                    <option value="OFI">Opportunity for Improvement</option>
                                    <option value="AOC">Area of Concern</option>
                                    <option value="NC">Non-Conformity</option>
                                </select>
                              </div>
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectlaporan @error('unitkerja_id') is-invalid @enderror" id="LaporanAudit" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Periode...</option>
                                    @foreach($jadwalAudits as $audit)
                                        <option value="{{$audit->periode.','.$audit->tahun}}">Periode: {{ $audit->periode }} ({{ $audit->tahun }})</option>  
                                    @endforeach
                                </select>
                              </div>
                            </div>

                            <div id="laporanAuditchart"></div>
                          </div> -->

                          <!-- CAR -->
                          <!-- <div class="tab-pane fade" id="CAR" role="tabpanel" aria-labelledby="CAR-tab">
                            <div class="row">
                              @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR selectCAR @error('unitkerja_id') is-invalid @enderror" id="unitKerjaCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Unit Kerja...</option>
                                    @foreach($unitKerja as $UK)
                                        <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control select2bs4PR selectCAR @error('unitkerja_id') is-invalid @enderror" id="standarCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Standar...</option>
                                    <option value="SPd">Standar Pendidikan</option>
                                    <option value="SLit">Standar Penelitian</option>
                                    <option value="SPkM">Standar Pengabdian Kepada Masyarakat</option>
                                    <option value="SAk">Standar Akademik</option>
                                    <option value="SNAk">Standar Non Akademik</option>
                                </select>
                              </div>
                              <div class="form-group col-4">
                                <select class="form-control selectCAR @error('status') is-invalid @enderror" id="statusCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Status...</option>
                                    <option value="open">Open Check</option>
                                    <option value="process">Process Check</option>
                                    <option value="closed">Closed Check</option>
                                </select>
                              </div>
                              @endif
                              <div class="form-group col-6">
                                <select class="form-control select2bs4PR selectCAR @error('unitkerja_id') is-invalid @enderror" id="standarCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Standar...</option>
                                    <option value="SPd">Standar Pendidikan</option>
                                    <option value="SLit">Standar Penelitian</option>
                                    <option value="SPkM">Standar Pengabdian Kepada Masyarakat</option>
                                    <option value="SAk">Standar Akademik</option>
                                    <option value="SNAk">Standar Non Akademik</option>
                                </select>
                              </div>
                              <div class="form-group col-6">
                                <select class="form-control selectCAR @error('status') is-invalid @enderror" id="statusCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Status...</option>
                                    <option value="open">Open Check</option>
                                    <option value="process">Process Check</option>
                                    <option value="closed">Closed Check</option>
                                </select>
                              </div>
                            </div>

                            <div id="CARchart"></div>
                            CAR
                          </div> -->

                        <!-- </div> -->
                        <!-- /.card body -->    
                      <!-- </div> -->
                      <!-- /.card -->
                    <!-- </div> -->

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Tinjauan Manajemen CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Tinjauan Manajemen Chart</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                        <!-- TM -->
                        <a href="#" onclick="location.reload();" class="button btn btn-app">
                            <i class="fas fa-sync"></i> Refresh
                          </a>
                          <div><font color="red">Pilih salah satu antara select Unit Kerja atau select Tahun</font></div>
                          <div class="row">
                              @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1)
                                <div class="form-group col-4">
                                  <select class="form-control select2bs4PR select @error('unitkerja_id') is-invalid @enderror" id="UKTM" style="width: 100%;">
                                      <!-- <option disabled selected="selected">Pilih Unit Kerja...</option> -->
                                      <option selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-4">
                                  <input type="text" id="tglMulaiTM" placeholder="Enter Tahun Mulai TM" class="form-control dateYear dateTimeTM">
                                </div>
                                <div class="form-group col-4">
                                  <input type="text" id="tglSelesaiTM" placeholder="Enter Tahun Selesai TM" class="form-control dateYear dateTimeTM">
                                </div>
                              @else
                                <div class="form-group col-6">
                                  <input type="text" id="tglMulaiTM" placeholder="Enter Tahun Mulai TM" class="form-control dateYear dateTimeTM">
                                </div>
                                <div class="form-group col-6">
                                  <input type="text" id="tglSelesaiTM" placeholder="Enter Tahun Selesai TM" class="form-control dateYear dateTimeTM">
                                </div>
                              @endif
                            </div>

                            <div id="TM"></div>

                          </div>
                        <!-- #END TM -->

                    <!-- <div class="card card-primary card-tabs">
                      <div class="card-header p-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="jadwalTM-tab" data-toggle="pill" href="#jadwalTM" role="tab" aria-controls="jadwalTM" aria-selected="true">Jadwal TM</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="bahanTM-tab" data-toggle="pill" href="#bahanTM" role="tab" aria-controls="bahanTM" aria-selected="true">Bahan TM</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="hasilTM-tab" data-toggle="pill" href="#hasilTM" role="tab" aria-controls="hasilTM" aria-selected="false">Hasil TM</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="tindakTM-tab" data-toggle="pill" href="#tindakTM" role="tab" aria-controls="tindakTM" aria-selected="false">Tindak Lanjut TM</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <a href="#" onclick="location.reload();" class="button btn btn-app">
                          <i class="fas fa-sync"></i> Refresh
                        </a>
                        <div class="tab-content" id="custom-tabs-one-tabContent"> -->
                          <!-- Jadwal TM -->
                          <!-- <div class="tab-pane fade show active" id="jadwalTM" role="tabpanel" aria-labelledby="jadwalTM-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                                <div class="form-group col-4">
                                  <select class="form-control select2bs4PR selectjadwalTM @error('unitkerja_id') is-invalid @enderror" id="unitKerjaJadwalTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-2">
                                  <input type="text" id="tglMulaiJadwalTM" placeholder="Enter Tanggal Mulai TM" class="form-control dateAll dateTime">
                                </div>
                                <div class="form-group col-2">
                                  <input type="text" id="tglSelesaiJadwalTM" placeholder="Enter Tanggal Selesai TM" class="form-control dateAll dateTime">
                                </div>
                                <div class="form-group col-4">
                                  <select class="form-control selectjadwalTM @error('status') is-invalid @enderror" id="statusJadwalTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                                <div class="form-group col-3">
                                  <input type="text" id="tglMulaiJadwalTM" placeholder="Enter Tanggal Mulai TM" class="form-control dateAll dateTime">
                                </div>
                                <div class="form-group col-3">
                                  <input type="text" id="tglSelesaiJadwalTM" placeholder="Enter Tanggal Selesai TM" class="form-control dateAll dateTime">
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectjadwalTM @error('status') is-invalid @enderror" id="statusJadwalTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div id="jadwalTMchart"></div>
                          </div> -->

                          <!-- Bahan TM -->
                          <!-- <div class="tab-pane fade" id="bahanTM" role="tabpanel" aria-labelledby="bahanTM-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selectbahanTM @error('unitkerja_id') is-invalid @enderror" id="unitKerjaBahanTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-6">
                                  <select class="form-control selectbahanTM @error('status') is-invalid @enderror" id="statusBahanTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                                @endif
                              </div>
                              
                              <div id="bahanTMchart"></div>
                          </div> -->

                          <!-- Hasil TM -->
                          <!-- <div class="tab-pane fade" id="hasilTM" role="tabpanel" aria-labelledby="hasilTM-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selecthasilTM @error('unitkerja_id') is-invalid @enderror" id="unitKerjaHasilTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                @endif
                                <div class="form-group col-6">
                                  <select class="form-control selecthasilTM @error('status') is-invalid @enderror" id="statusHasilTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div id="hasilTMchart"></div>
                          </div> -->

                          <!-- Tindak Lanjut TM -->
                          <!-- <div class="tab-pane fade" id="tindakTM" role="tabpanel" aria-labelledby="tindakTM-tab">
                              <div class="row">
                                @if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
                                <div class="form-group col-6">
                                  <select class="form-control select2bs4PR selecttindakTM @error('unitkerja_id') is-invalid @enderror" id="unitKerjaTindakTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                  </select>
                                </div>
                                @endif
                                <div class="form-group col-6">
                                  <select class="form-control selecttindakTM @error('status') is-invalid @enderror" id="statusTindakTM" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Status...</option>
                                      <option value="aktif">Aktif</option>
                                      <option value="nonaktif">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div id="tindakTMchart"></div>
                          </div>

                        </div> -->
                        <!-- /.card body -->    
                      <!-- </div> -->
                      <!-- /.card -->
                    <!-- </div> -->

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

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
    {{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/chartJS.min.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://rawgit.com/mholt/PapaParse/master/papaparse.js"></script>

  <script>
      $(function () {
        $('.select2bs4PR').select2({
          theme: 'bootstrap4'
        })

        $(".dateAll").datepicker({
            format: "yyyy-mm-dd",
            viewMode: "date", 
            minViewMode: "date"
        });

        $(".dateYear").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
      });
  </script>
  <script type="text/javascript"> 
      //-------------------
      //- SELECTION CHART -
      //-------------------
          //Dokumen Induk
            var pervious;
            //Init onClick event
            readDataDokumenInduk();
            $(document).on('focus','.selectDokumenInduk', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectDokumenInduk', function(){
                  //Per STATUS
                  if( $("#statusDokumenInduk").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#dokumenIndukchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusDokumenIndukget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenIndukchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataDokumenInduk();
                  }
              })

              .on('change', '.dateTimeDokumenInduk', function(){
                if( $("#tglMulaiDokumenInduk").val() !='' && $("#tglSelesaiDokumenInduk").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiDokumenInduk").val();
                  selesai = $("#tglSelesaiDokumenInduk").val();

                  $("#dokumenIndukchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeDokumenIndukget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenIndukchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataDokumenInduk();
                }
              });

            function readDataDokumenInduk(){
              $.get("{{ url('dokumenIndukread') }}", {}, function(data,status){
                $("#dokumenIndukchart").html(data);
              });
            }
          //#END Dokumen Induk

          //Dokumen Checklist
            var pervious;
            //Init onClick event
            readDataDokumenChecklist();
            $(document).on('focus','.selectDokumenChecklist', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectDokumenChecklist', function(){
                  //Per UNIT KERJA
                  if( $("#unitKerjaDokumenChecklist").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#dokumenChecklistchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUnitKerjaDokumenChecklistget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenChecklistchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  //Per STATUS
                  }else if( $("#statusDokumenChecklist").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#dokumenChecklistchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusDokumenChecklistget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenChecklistchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataDokumenChecklist();
                  }
              })

              .on('change', '.dateTimeDokumenChecklist', function(){
                if( $("#tglMulaiDokumenChecklist").val() !='' && $("#tglSelesaiDokumenChecklist").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiDokumenChecklist").val();
                  selesai = $("#tglSelesaiDokumenChecklist").val();

                  $("#dokumenChecklistchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeDokumenChecklistget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenChecklistchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataDokumenChecklist();
                }
              });

            function readDataDokumenChecklist(){
              $.get("{{ url('dokumenChecklistread') }}", {}, function(data,status){
                $("#dokumenChecklistchart").html(data);
              });
            }
          //#END Dokumen Checklist

          //Dokumen Acuan
            var pervious;
            //Init onClick event
            readDataDokumenAcuan();
            $(document).on('focus','.selectDokumenAcuan', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectDokumenAcuan', function(){
                  //Per JENIS DOKUMEN
                  if( $("#jenisDokumenAcuan").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#dokumenAcuanchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartJenisDokumenAcuanget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenAcuanchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  //Per STATUS
                  }else if( $("#statusDokumenAcuan").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#dokumenAcuanchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusDokumenAcuanget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenAcuanchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataDokumenAcuan();
                  }
              })

              .on('change', '.dateTimeDokumenAcuan', function(){
                if( $("#tglMulaiDokumenAcuan").val() !='' && $("#tglSelesaiDokumenAcuan").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiDokumenAcuan").val();
                  selesai = $("#tglSelesaiDokumenAcuan").val();

                  $("#dokumenAcuanchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeDokumenAcuanget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#dokumenAcuanchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataDokumenAcuan();
                }
              });

            function readDataDokumenAcuan(){
              $.get("{{ url('dokumenAcuanread') }}", {}, function(data,status){
                $("#dokumenAcuanchart").html(data);
              });
            }
          //#END Dokumen Acuan

          //Renop
            var pervious;
            //Init onClick event
            readDataRenop();
            $(document).on('focus','.selectRenop', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectRenop', function(){
                  //Per UNIT KERJA
                  if( $("#unitKerjaRenop").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#renopchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUnitKerjaRenopget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#renopchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  //Per STATUS
                  }else if( $("#statusRenop").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#renopchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusRenopget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#renopchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataRenop();
                  }
              })

              .on('change', '.dateTimeRenop', function(){
                if( $("#tglMulaiRenop").val() !='' && $("#tglSelesaiRenop").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiRenop").val();
                  selesai = $("#tglSelesaiRenop").val();

                  $("#renopchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeRenopget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#renopchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataRenop();
                }
              });

            function readDataRenop(){
              $.get("{{ url('Renopread') }}", {}, function(data,status){
                $("#renopchart").html(data);
              });
            }
          //#END Renop

          //Kinerja Unit
            var pervious;
            //Init onClick event
            readDataKinerjaUnit();
            $(document).on('focus','.selectKinerjaUnit', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectKinerjaUnit', function(){
                  //Per UNIT KERJA
                  if( $("#unitKerjaKinerjaUnit").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#kinerjaUnitchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUnitKerjaKinerjaUnitget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#kinerjaUnitchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  //Per STATUS
                  }else if( $("#statusKinerjaUnit").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#kinerjaUnitchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusKinerjaUnitget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#kinerjaUnitchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataKinerjaUnit();
                  }
              })

              .on('change', '.dateTimeKinerjaUnit', function(){
                if( $("#tglMulaiKinerjaUnit").val() !='' && $("#tglSelesaiKinerjaUnit").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiKinerjaUnit").val();
                  selesai = $("#tglSelesaiKinerjaUnit").val();

                  $("#kinerjaUnitchart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeKinerjaUnitget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#kinerjaUnitchart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataKinerjaUnit();
                }
              });

            function readDataKinerjaUnit(){
              $.get("{{ url('kinerjaUnitread') }}", {}, function(data,status){
                $("#kinerjaUnitchart").html(data);
              });
            }
          //#END Kinerja Unit

          //Bukti Kinerja Unit
            var pervious;
            //Init onClick event
            readDataBuktiKinerja();
            $(document).on('focus','.selectBuktiKinerja', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.selectBuktiKinerja', function(){
                  //Per UNIT KERJA
                  if( $("#unitKerjaBuktiKinerja").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#buktiKinerjachart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUnitKerjaBuktiKinerjaget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#buktiKinerjachart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  //Per STATUS
                  }else if( $("#statusBuktiKinerja").val() ){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#buktiKinerjachart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartStatusBuktiKinerjaget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#buktiKinerjachart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                  } else{
                    console.log('no value')
                    readDataBuktiKinerja();
                  }
              })

              .on('change', '.dateTimeBuktiKinerja', function(){
                if( $("#tglMulaiBuktiKinerja").val() !='' && $("#tglSelesaiBuktiKinerja").val() !='' ){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiBuktiKinerja").val();
                  selesai = $("#tglSelesaiBuktiKinerja").val();

                  $("#buktiKinerjachart").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeBuktiKinerjaget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#buktiKinerjachart").html(data);
                          //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                          //jQuery($('#subject_id')).empty();
                          //jQuery.each(data, function(key,value){
                          //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                          //});
                      }
                    });
                } else{
                  console.log('no value')
                  readDataBuktiKinerja();
                }
              });

            function readDataBuktiKinerja(){
              $.get("{{ url('buktiKinerjaread') }}", {}, function(data,status){
                $("#buktiKinerjachart").html(data);
              });
            }
          //#END Bukti Kinerja Unit

          //AMI
            var pervious;
            //Init onClick event
            readData();
            $(document).on('focus','.select', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
                // .on('change', '.select, .dateTimeAudit', function(){
                //   if( $("#UKAMI").val() !='' ||  $("#tglMulaiAudit").val() =='' && $("#tglSelesaiAudit").val() ==''){
                //     // console.log( $(this).val() );
                //     // previous = this.value;
                //     uk = $("#UKAMI").val();
                    
                //     $("#AMI").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                //     $.ajax({
                //       url : "{{ url('chartUKAMIget') }}",
                //       type : "get",
                //       data : "name=" + uk,
                //       // data : "name=" + $(this).val(), 
                //       success: function(data)
                //       {
                //           // console.log(data);
                //           $("#AMI").html(data);
                //       }
                //     });
                //   }else if( $("#tglMulaiAudit").val() !='' && $("#tglSelesaiAudit").val() !='' || $("#UKAMI").val() ==''){
                //     // console.log( $(this).val() );
                //     mulai = $("#tglMulaiAudit").val();
                //     selesai = $("#tglSelesaiAudit").val();

                //     $("#AMI").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                //       $.ajax({
                //         url : "{{ url('chartDateTimeAMIget') }}",
                //         type : "get",
                //         data : {mulai, selesai}, 
                //         success: function(data)
                //         {
                //             // console.log(data);
                //             $("#AMI").html(data);
                //         }
                //       });
                //   }else if( $("#tglMulaiAudit").val() !='' && $("#tglSelesaiAudit").val() !='' && $("#UKAMI").val() !=''){
                //     console.log( $(this).val() );
                //     uk = $("#UKAMI").val();
                //     mulai = $("#tglMulaiAudit").val();
                //     selesai = $("#tglSelesaiAudit").val();

                //   } else{
                //     console.log('no value')
                //     readData();
                //   }
                // });


              .on('change', '.select', function(){
                  //Per UNIT KERJA
                  if( $("#UKAMI").val() !='' &&  $("#tglMulaiAudit").val() =='' && $("#tglSelesaiAudit").val() ==''){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#AMI").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUKAMIget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#AMI").html(data);
                      }
                    });

                  } else{
                    console.log('no value')
                    readData();
                  }
              })
              
              .on('change', '.dateTimeAudit', function(){
                if( $("#tglMulaiAudit").val() !='' && $("#tglSelesaiAudit").val() !=''){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiAudit").val();
                  selesai = $("#tglSelesaiAudit").val();

                  $("#AMI").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeAMIget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#AMI").html(data);
                      }
                    });
                } else{
                  console.log('no value')
                  readData();
                }
              });

            function readData(){
              $.get("{{ url('AMIread') }}", {}, function(data,status){
                console.log(data);
                $("#AMI").html(data);
              });
            }
          //#END AMI

          //TM
            var pervious;
            //Init onClick event
            readDataTM();
            $(document).on('focus','.select', function () {
                // Store the current value on focus and on change
                previous = this.value;
                
            })
              .on('change', '.select', function(){
                  //Per UNIT KERJA
                  if( $("#UKTM").val() !='' &&  $("#tglMulaiTM").val() =='' && $("#tglSelesaiTM").val() ==''){
                    console.log( $(this).val() );
                    // previous = this.value;
                    $("#TM").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartUKTMget') }}",
                      type : "get",
                      data : "name=" + $(this).val(), 
                      success: function(data)
                      {
                          console.log(data);
                          $("#TM").html(data);
                      }
                    });

                  } else{
                    console.log('no value')
                    readDataTM();
                  }
              })
              
              .on('change', '.dateTimeTM', function(){
                if( $("#tglMulaiTM").val() !='' && $("#tglSelesaiTM").val() !=''){
                  console.log( $(this).val() );
                  mulai = $("#tglMulaiTM").val();
                  selesai = $("#tglSelesaiTM").val();

                  $("#TM").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                      url : "{{ url('chartDateTimeTMget') }}",
                      type : "get",
                      data : {mulai, selesai}, 
                      success: function(data)
                      {
                          console.log(data);
                          $("#TM").html(data);
                      }
                    });
                } else{
                  console.log('no value')
                  readDataTM();
                }
              });

            function readDataTM(){
              $.get("{{ url('TMread') }}", {}, function(data,status){
                console.log(data);
                $("#TM").html(data);
              });
            }
          //#END TM



  </script>

@endpush()