@extends('layouts.myapp')
@section('title', 'CAR Reports ~ Edit')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <!-- daterange picker -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.css') }}"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <style>
        .rcorners2 {
          border-radius: 25px;
          border: 2px solid #CFD1DA;
          padding: 20px; 
          width: auto;
          height: auto;  
        }
        #analisiPenyebabMasalah_AuditeeDisabled {
          border-radius: 25px;
          border: 2px solid #CFD1DA;
          padding: 20px; 
          width: auto;
          height: auto;  
        }
        #tindakanPencegahan_AuditeeDisabled {
          border-radius: 25px;
          border: 2px solid #CFD1DA;
          padding: 20px; 
          width: auto;
          height: auto;  
        }
        #tindakanPenyelesaian_AuditeeDisabled {
          border-radius: 25px;
          border: 2px solid #CFD1DA;
          padding: 20px; 
          width: auto;
          height: auto;  
        }
        
    </style>
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah CAR Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">CAR Reports</li>
              <li class="breadcrumb-item active">Ubah CAR Reports</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('AMI') }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('CarReports.update', $CARs->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            
            <!-- AUDITOR & AUDITEE -->
            @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
              @if(auth()->user()->role_id == 3)
                  <input name="status" type="hidden" value="process">
              @endif
              <div class="card card-primary card-tabs">
                <div class="card-header p-0">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    @if(auth()->user()->role_id == 2)
                    <li class="nav-item">
                      <a class="nav-link active" id="Auditor-tab" data-toggle="pill" href="#Auditor" role="tab" aria-controls="Auditor" aria-selected="true">Auditor</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="Auditee-tab" data-toggle="pill" href="#Auditee" role="tab" aria-controls="Auditee" aria-selected="true">Auditee</a>
                    </li>
                    @else
                    <li class="nav-item">
                      <a class="nav-link" id="Auditor-tab" data-toggle="pill" href="#Auditor" role="tab" aria-controls="Auditor" aria-selected="true">Auditor</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="Auditee-tab" data-toggle="pill" href="#Auditee" role="tab" aria-controls="Auditee" aria-selected="true">Auditee</a>
                    </li>
                    @endif
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <!-- AUDITOR -->
                    @if(auth()->user()->role_id == 2)
                      <!-- Auditor -->
                      <div class="tab-pane fade show active" id="Auditor" role="tabpanel" aria-labelledby="Auditor-tab">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputPassword1" class="required">Kode Standar</label>
                            <input name="laporanaudit_id" type="hidden" value="{{ $CARs->laporanaudit_id }}">
                            <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="laporanaudit_id" disabled id="laporanaudit_id" data-placeholder="Select a Users" style="width: 100%;">
                                  @foreach ($Audits as $Audit)
                                      @foreach ($Audit as $Au)
                                          <option value="{{ $Au->id }}"
                                              @if ($Au->id === $CARs->laporanaudit_id)
                                                  selected
                                              @endif
                                                  >
                                              @foreach($standars as $value)
                                                @if($value->id == $Au->standar_id)
                                                  <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                @endif
                                              @endforeach
                                              |
                                              @foreach($unitkerja as $UK)
                                                  @if($UK->id == $Au->unitkerja_id)
                                                      {{ $UK->name }}
                                                  @endif
                                              @endforeach
                                          </option>
                                      @endforeach
                                  @endforeach
                            </select>
                              
                              @error('laporanaudit_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Nama Standar</label>
                            <!-- <input type="text" disabled value="{{ $CARs->laporanAudit->standars->namaStandar }}" class="form-control @error('laporanTemuan') is-invalid @enderror"> -->
                            <h5 class="rcorners2">{{ $CARs->laporanAudit->standars->namaStandar }}</h5>
                          </div> 
                          <div class="form-group">
                              <label for="exampleInputEmail1" class="required">Uraian Temuan</label>
                              <h5 class="rcorners2">
                                  @foreach ($Audits as $Audit)
                                      @foreach ($Audit as $Au)
                                          @if ($Au->id === $CARs->laporanaudit_id)
                                            {!! $Au->uraianTemuan !!}
                                          @endif
                                      @endforeach
                                  @endforeach
                              </h5>
                          </div> 
                          <div class="form-group">
                            <label  class="required">Hasil Pemeriksaan</label>
                            @if($CARs->hasilPemeriksaan == "sesuai")
                              <div class="icheck-success">
                                <input type="radio" id="HP1" name="hasilPemeriksaan" value="sesuai" checked>
                                <label for="HP1">
                                  Sesuai
                                </label>
                              </div>
                              <div class="icheck-danger">
                                <input type="radio" id="HP2" name="hasilPemeriksaan" value="nonsesuai">
                                <label for="HP2">
                                  Tidak Sesuai
                                </label>
                              </div>
                            @else
                              <div class="icheck-success">
                                <input type="radio" id="HP1" name="hasilPemeriksaan" value="sesuai">
                                <label for="HP1">
                                  Sesuai
                                </label>
                              </div>
                              <div class="icheck-danger">
                                <input type="radio" id="HP2" name="hasilPemeriksaan" value="nonsesuai" checked>
                                <label for="HP2">
                                  Tidak Sesuai
                                </label>
                              </div>
                            @endif
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputEmail1">Rekomendasi</label>
                              <!-- <input type="text"  id="rekomendasi" name="rekomendasi" value="{{ $CARs->rekomendasi }}" class="form-control @error('rekomendasi') is-invalid @enderror"/> -->
                              <textarea id="rekomendasi" name="rekomendasi" rows="3" class="form-control @error('rekomendasi') is-invalid @enderror">{{ $CARs->rekomendasi }}</textarea>

                              @error('rekomendasi')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="form-group clearfix @error('status') is-invalid @enderror">
                            <label class="required">Status</label>
                              @if($CARs->status == "open")
                                <div class="icheck-primary">
                                  <input type="radio" id="radioPrimary1" name="status" value="open" checked>
                                  <label for="radioPrimary1">
                                    Open Check
                                  </label>
                                </div>
                                <div class="icheck-warning d-inline">
                                  <input type="radio" id="radioPrimary2" name="status" value="process">
                                  <label for="radioPrimary2">
                                    Process Check
                                  </label>
                                </div>
                                <div class="icheck-success">
                                  <input type="radio" id="radioPrimary3" name="status" value="closed">
                                  <label for="radioPrimary3">
                                    Closed Check
                                  </label>
                                </div>
                              @elseif($CARs->status == "process")
                                <div class="icheck-primary">
                                  <input type="radio" id="radioPrimary1" name="status" value="open">
                                  <label for="radioPrimary1">
                                    Open Check
                                  </label>
                                </div>
                                <div class="icheck-warning d-inline">
                                  <input type="radio" id="radioPrimary2" name="status" value="process" checked>
                                  <label for="radioPrimary2">
                                    Process Check
                                  </label>
                                </div>
                                <div class="icheck-success">
                                  <input type="radio" id="radioPrimary3" name="status" value="closed">
                                  <label for="radioPrimary3">
                                    Closed Check
                                  </label>
                                </div>
                              @else
                                <div class="icheck-primary">
                                  <input type="radio" id="radioPrimary1" name="status" value="open">
                                  <label for="radioPrimary1">
                                    Open Check
                                  </label>
                                </div>
                                <div class="icheck-warning d-inline">
                                  <input type="radio" id="radioPrimary2" name="status" value="process">
                                  <label for="radioPrimary2">
                                    Process Check
                                  </label>
                                </div>
                                <div class="icheck-success">
                                  <input type="radio" id="radioPrimary3" name="status" value="closed" checked>
                                  <label for="radioPrimary3">
                                    Closed Check
                                  </label>
                                </div>
                              @endif
                            
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                        </div>
                        <div class="card-footer">
                          <button type="button" class="btn btn-primary show-alert-change-boxs">
                              Submit
                          </button>
                        </div>
                      </div>
                      <!-- Auditee -->
                      <div class="tab-pane fade" id="Auditee" role="tabpanel" aria-labelledby="Auditee-tab">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Analisis Penyebab Masalah</label>
                              <!-- <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" disabled placeholder="Enter Analisis Penyebab Masalah">{{ $CARs->analisiPenyebabMasalah }}</textarea> -->
                              <!-- <textarea name="analisiPenyebabMasalah_disabled" disabled>{{ $CARs->analisiPenyebabMasalah }}</textarea> -->
                              <!-- <textarea class="form-control" rows="3" disabled>{!! $CARs->analisiPenyebabMasalah !!}</textarea> -->
                              <h5 class="rcorners2">{!! $CARs->analisiPenyebabMasalah !!}</h5>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Penyelesaian</label>
                              <!-- <textarea class="form-control @error('tindakanPenyelesaian') is-invalid @enderror" rows="3" disabled placeholder="Enter Tindakan Penyelesaian">{{ $CARs->tindakanPenyelesaian }}</textarea> -->
                              <!-- <textarea name="tindakanPenyelesaian_disabled" disabled>{{ $CARs->tindakanPenyelesaian }}</textarea> -->
                              <!-- <textarea class="form-control" rows="3" disabled>{!! $CARs->tindakanPenyelesaian !!}</textarea> -->
                              <!-- <p class="rcorners2">{{ strip_tags($CARs->tindakanPenyelesaian) }}</p> -->
                              <h5 class="rcorners2">{!! $CARs->tindakanPenyelesaian !!}</h5>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Pencegahan</label>
                              <!-- <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" disabled placeholder="Enter Tindakan Pencegahan">{{ $CARs->tindakanPencegahan }}</textarea> -->
                              <!-- <textarea name="tindakanPencegahan_disabled" disabled>{{ $CARs->tindakanPencegahan }}</textarea> -->
                              <!-- <textarea class="form-control" rows="3" disabled>{!! $CARs->tindakanPencegahan !!}</textarea> -->
                              <h5 class="rcorners2">{{ strip_tags($CARs->tindakanPencegahan) }}</h5>
                          </div>

                          <label>File Bukti Dukung</label>
                          <div class="custom-file">
                              <a href="{{ asset($CARs->file) }}" target="_blank" target="pdf-frame">{{ asset($CARs->file) }}</a>
                          </div>

                        </div>
                      </div>

                    <!-- AUDITEE -->
                    @else
                      <!-- Auditor -->
                      <div class="tab-pane fade" id="Auditor" role="tabpanel" aria-labelledby="Auditor-tab">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputPassword1">Kode Standar</label>
                            <select class="form-control select2bs4" id="laporanaudit_id" data-placeholder="Select a Users" disabled style="width: 100%;">
                                  @foreach ($Audits as $Audit)
                                      @foreach ($Audit as $Au)
                                          <option value="{{ $Au->id }}"
                                              @if ($Au->id === $CARs->laporanaudit_id)
                                                  selected
                                              @endif
                                                  >
                                              @foreach($standars as $value)
                                                @if($value->id == $Au->standar_id)
                                                  <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                @endif
                                              @endforeach
                                              |
                                              @foreach($unitkerja as $UK)
                                                  @if($UK->id == $Au->unitkerja_id)
                                                      {{ $UK->name }}
                                                  @endif
                                              @endforeach
                                          </option>
                                      @endforeach
                                  @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Nama Standar</label>
                            <!-- <input type="text" disabled value="{{ $CARs->laporanAudit->standars->namaStandar }}" class="form-control @error('laporanTemuan') is-invalid @enderror"> -->
                            <h5 class="rcorners2">{{ $CARs->laporanAudit->standars->namaStandar }}</h5>
                          </div> 
                          <div class="form-group">
                              <label for="exampleInputEmail1">Uraian Temuan</label>
                              <h5 class="rcorners2">
                                  @foreach ($Audits as $Audit)
                                      @foreach ($Audit as $Au)
                                          @if ($Au->id === $CARs->laporanaudit_id)
                                            {{ $Au->uraianTemuan }}
                                          @endif
                                      @endforeach
                                  @endforeach
                              </h5>
                          </div> 

                          <div class="form-group">
                                <label>Hasil Pemeriksaan</label>
                                @if($CARs->hasilPemeriksaan == "sesuai")
                                <div class="icheck-success">
                                  <input type="radio" id="radioPrimary1" disabled checked>
                                  <label for="radioPrimary1">
                                    Sesuai
                                  </label>
                                </div>
                                <div class="icheck-danger">
                                  <input type="radio" id="radioPrimary2" disabled>
                                  <label for="radioPrimary2">
                                    Tidak Sesuai
                                  </label>
                                </div>
                                @else
                                <div class="icheck-success">
                                  <input type="radio" id="radioPrimary1" disabled>
                                  <label for="radioPrimary1">
                                    Sesuai
                                  </label>
                                </div>
                                <div class="icheck-danger">
                                  <input type="radio" id="radioPrimary2" disabled checked>
                                  <label for="radioPrimary2">
                                    Tidak Sesuai
                                  </label>
                                </div>
                                @endif
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Rekomendasi</label>
                              <input type="text"  id="rekomendasi" disabled value="{{ $CARs->rekomendasi }}" class="form-control @error('rekomendasi') is-invalid @enderror"/>
                          </div>

                          <div class="form-group clearfix @error('status') is-invalid @enderror">
                              @if($CARs->status == "open")
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" disabled checked>
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" disabled>
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" disabled>
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @elseif($CARs->status == "process")
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" disabled>
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" disabled checked>
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" disabled>
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @else
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" disabled>
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" disabled>
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" disabled checked>
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @endif
                          </div>

                        </div>
                      </div>
                      <!-- Auditee -->
                      <div class="tab-pane fade show active" id="Auditee" role="tabpanel" aria-labelledby="Auditee-tab">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Analisis Penyebab Masalah</label>
                              <!-- <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" name="analisiPenyebabMasalah" placeholder="Enter Analisis Penyebab Masalah">{{ $CARs->analisiPenyebabMasalah }}</textarea> -->
                              <textarea name="analisiPenyebabMasalah">{{ $CARs->analisiPenyebabMasalah }}</textarea>

                              @error('analisiPenyebabMasalah')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Penyelesaian</label>
                              <!-- <textarea class="form-control @error('tindakanPenyelesaian') is-invalid @enderror" rows="3" name="tindakanPenyelesaian" placeholder="Enter Tindakan Penyelesaian">{{ $CARs->tindakanPenyelesaian }}</textarea> -->
                              <textarea name="tindakanPenyelesaian">{{ $CARs->tindakanPenyelesaian }}</textarea>

                              @error('tindakanPenyelesaian')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Pencegahan</label>
                              <!-- <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" name="tindakanPencegahan" placeholder="Enter Tindakan Pencegahan">{{ $CARs->tindakanPencegahan }}</textarea> -->
                              <textarea name="tindakanPencegahan">{{ $CARs->tindakanPencegahan }}</textarea>

                              @error('tindakanPencegahan')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <label class="filepicture">File Bukti Dukung</label>
                          <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">{{ $CARs->file }}</label>
                            @error('file')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>

                        </div>

                        <div class="card-footer">
                          <button type="button" class="btn btn-primary show-alert-change-boxs">
                              Submit
                          </button>
                        </div>
                      </div>
                    @endif
                  </div>
                  <!-- /.card body -->    
                </div>


              </div>
              <!-- /.card -->

            <!-- ADMIN -->
            @else
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data CAR</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="exampleInputPassword1" class="required">Kode Standar</label>
                            <input name="laporanaudit_id" type="hidden" value="{{ $CARs->laporanaudit_id }}">
                            <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" disabled name="laporanaudit_id" id="laporanaudit_id" data-placeholder="Select a Users" style="width: 100%;">
                                @foreach ($Audits as $Audit)
                                  <option value="{{ $Audit->id }}"
                                    @if ($Audit->id === $CARs->laporanaudit_id)
                                        selected
                                    @endif
                                        >
                                        @foreach($standars as $value)
                                          @if($value->id == $Audit->standar_id)
                                            <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                          @endif
                                        @endforeach
                                        |
                                        @foreach($unitkerja as $UK)
                                            @if($UK->id == $Audit->jadwalAudit->unitkerja_id)
                                                {{ $UK->name }}
                                            @endif
                                        @endforeach
                                  </option>
                                @endforeach
                            </select>
                                
                            @error('laporanaudit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Nama Standar</label>
                            <!-- <input type="text" disabled value="{{ $CARs->laporanAudit->standars->namaStandar }}" class="form-control @error('laporanTemuan') is-invalid @enderror"> -->
                            <h5 class="rcorners2">{{ $CARs->laporanAudit->standars->namaStandar }}</h5>
                          </div> 
                        </div> 
                        <div class="col-12">
                          <div class="form-group">
                              <label for="exampleInputEmail1" class="required">Uraian Temuan</label>
                              <h5 class="rcorners2">
                                  @foreach ($Audits as $Audit)
                                          @if ($Audit->id === $CARs->laporanaudit_id)
                                            {!! $Audit->uraianTemuan !!}
                                          @endif
                                  @endforeach
                              </h5>
                          </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Analisis Penyebab Masalah</label>
                            <textarea name="analisiPenyebabMasalah">{{ $CARs->analisiPenyebabMasalah }}</textarea>

                            @error('analisiPenyebabMasalah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Penyelesaian</label>
                            <textarea name="tindakanPenyelesaian">{{ $CARs->tindakanPenyelesaian }}</textarea>

                            @error('tindakanPenyelesaian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Tindakan Pencegahan</label>
                            <!-- <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" name="tindakanPencegahan" placeholder="Enter Tindakan Pencegahan">{{ $CARs->tindakanPencegahan }}</textarea> -->
                            <textarea name="tindakanPencegahan">{{ $CARs->tindakanPencegahan }}</textarea>

                            @error('tindakanPencegahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Hasil Pemeriksaan</label>
                              @if($CARs->hasilPemeriksaan == "sesuai")
                                <div class="icheck-success">
                                  <input type="radio" id="HP1" name="hasilPemeriksaan" value="sesuai" checked>
                                  <label for="HP1">
                                    Sesuai
                                  </label>
                                </div>
                                <div class="icheck-danger">
                                  <input type="radio" id="HP2" name="hasilPemeriksaan" value="nonsesuai">
                                  <label for="HP2">
                                    Tidak Sesuai
                                  </label>
                                </div>
                              @else
                                <div class="icheck-success">
                                  <input type="radio" id="HP1" name="hasilPemeriksaan" value="sesuai">
                                  <label for="HP1">
                                    Sesuai
                                  </label>
                                </div>
                                <div class="icheck-danger">
                                  <input type="radio" id="HP2" name="hasilPemeriksaan" value="nonsesuai" checked>
                                  <label for="HP2">
                                    Tidak Sesuai
                                  </label>
                                </div>
                              @endif
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Rekomendasi</label>
                            <input type="text"  id="rekomendasi" name="rekomendasi" value="{{ $CARs->rekomendasi }}" class="form-control @error('rekomendasi') is-invalid @enderror"/>

                            @error('rekomendasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="requiredfile">File Bukti Dukung</label>
                            <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                              <label class="custom-file-label" for="customFile">{{ $CARs->file }}</label>
                              @error('file')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label class="requiredacc">Ganti auditor ACC</label>
                            @if($CARs->acc == null)
                                <select class="form-control select2bs4 @error('acc') is-invalid @enderror" name="acc" id="acc" data-placeholder="Select a Users" style="width: 100%;">
                                    <option disabled selected>Pilih Auditor...</option>
                                    @foreach ($users as $user)
                                      <option value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('acc')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            @else
                                <select class="form-control select2bs4 @error('acc') is-invalid @enderror" name="acc" id="acc" data-placeholder="Select a Users" style="width: 100%;">
                                    @foreach ($users as $user)
                                      <option value="{{ $user->id }}"
                                        @if ($user->id === $CARs->acc)
                                            selected
                                        @endif
                                            >{{$user->name}}
                                      </option>
                                    @endforeach
                                </select>
                                
                                @error('acc')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            @endif
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="required">Status</label>
                            @if($CARs->status == "open")
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" name="status" value="open" checked>
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" name="status" value="process">
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" name="status" value="closed">
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @elseif($CARs->status == "process")
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" name="status" value="open">
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" name="status" value="process" checked>
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" name="status" value="closed">
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @else
                              <div class="icheck-primary">
                                <input type="radio" id="radioPrimary1" name="status" value="open">
                                <label for="radioPrimary1">
                                  Open Check
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="radioPrimary2" name="status" value="process">
                                <label for="radioPrimary2">
                                  Process Check
                                </label>
                              </div>
                              <div class="icheck-success">
                                <input type="radio" id="radioPrimary3" name="status" value="closed" checked>
                                <label for="radioPrimary3">
                                  Closed Check
                                </label>
                              </div>
                            @endif
                              
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                    </div>
              </div>                  
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" id="show-alert-change-box">
                    Submit
                </button>
              </div>

            </div>
            <!-- /.card -->

            @endif

            <!-- <div class="card-footer">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateCAR">
                 Submit
              </button>
            </div> -->

              <div class="modal fade" id="updateCAR">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah CAR</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center;">Apakah anda akan mengubah data CAR : {{ $CARs->laporanTemuan }} !!!</p>
                      <center>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success">Iya</button>
                      </center>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </form>
        <!-- form finish -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    
    <!-- date-range-picker -->
    {{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}

    {{-- <script src="{{ asset('plugins/timepicker/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renop').select2({
        theme: 'bootstrap4'
      })

      bsCustomFileInput.init();

      @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
      CKEDITOR.replace('tindakanPenyelesaian');
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['tindakanPenyelesaian'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Tindakan Penyelesaian Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });

      CKEDITOR.replace('analisiPenyebabMasalah');
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['analisiPenyebabMasalah'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Analisis Penyebab Masalah Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });

      CKEDITOR.replace('tindakanPencegahan');
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['tindakanPencegahan'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Tindakan Pencegahan Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });
      @endif

        $(document).ready(function(){
            
            $('#show-alert-change-box').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda akan mengubah data CAR?",
                    text: "Pastikan kembali data yang akan diubah",
                    icon: 'warning',
                    type: "warning",
                    buttons: ["Batal","Ya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });

            $('.show-alert-change-boxs').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda akan mengubah data CAR?",
                    text: "Pastikan kembali data yang akan diubah",
                    icon: 'warning',
                    type: "warning",
                    buttons: ["Batal","Ya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
            
        });

        // CKEDITOR.replace('tindakanPenyelesaian_disabled');
        // CKEDITOR.replace('analisiPenyebabMasalah_disabled');
        // CKEDITOR.replace('tindakanPencegahan_disabled');
      
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

        $("#datepicker1").datepicker({
            format: "yyyy-mm-dd",
            viewMode: "date", 
            minViewMode: "date"
        });
        //$('.timepicker').timepicker({
        //  showInputs: false
        //});
        //$('#datepicker2').wickedpicker({twentyFour: true});
        $('.timepicker').clockpicker()
          .find('input').change(function(){
            console.log(this.value);
          });
        var input = $('#single-input').clockpicker({
          placement: 'bottom',
          align: 'left',
          autoclose: true,
          'default': 'now'
        });

        //Date range picker with time picker
        $('#rangedate').daterangepicker({
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
        });

        $('#input1').datepicker({
              format: "yyyy",
              autoclose: true,
                minViewMode: "years"
        })    .on('changeDate', function(selected){
                startDate =  $("#input1").val();
                $('#to').datepicker('setStartDate', startDate);
            }); 
        ;


        $('#input2').datepicker({
              format: "yyyy",
              autoclose: true,
                minViewMode: "years"
        });
      });
    </script>

@endpush()