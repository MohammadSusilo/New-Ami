    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
    <a href="{{ route('CarReports.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> TAMBAH
    </a>
    <!-- <a href="#" id="MultiCarReportsRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalCAR">
        <i class="fas fa-plus-circle"></i> TAMBAH BANYAK
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    @endif
    <!-- <a href="#" id="ExportCARplus" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->
    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalExportCAR">
        <i class="fas fa-file-pdf"></i> EXPORT
    </button>
    @else
        <form method="POST" target="_blank" action="{{ route('CarReports.selectExportPDF') }}" enctype="multipart/form-data">
        @csrf
            <button type="submit" class="btn btn-app">
                <i class="fas fa-file-pdf"></i> EXPORT
            </button>
            <input type="hidden" name="unitkerja_id" value="{{ auth()->user()->unitkerja_id }}">
        </form>
    @endif
    <!-- <a href="#" id="ExportWordCARplus" class="btn btn-app">
      <i class="fas fa-file-word"></i> Export Bahan TM
    </a> -->

    <p align="right">
        <a href="{{ url('CAR/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi CAR Reports -->
    <div class="modal fade" id="modalCAR">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple CAR Reports</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('CarReports.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <div class="row g-2">
                                <div class="col">
                                    <button type="button" name="add" id="addCAR" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="CarReportsMultiTable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-default" id="cols">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="required">Kode Standar</label>
                                                        <?php if(Auth::user()->role_id == 1){ ?>
                                                            <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="addmore[0][laporanaudit_id]" id="selectKodeStandar0" data-placeholder="Pilih Kode Standar..." style="width: 100%;" required>
                                                                <option disabled selected="selected" value="">Pilih Kode Standar...</option>
                                                                <?php foreach($laporanaudits as $Audits){ ?>
                                                                    <?php foreach($Audits as $Audit){ ?>
                                                                    <option value="<?php echo $Audit->id; ?>">
                                                                        @foreach($standars as $value)
                                                                            @if($value->id == $Audit->standar_id)
                                                                                <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                                            @endif
                                                                        @endforeach
                                                                        |
                                                                        @foreach($unitKerja as $UK)
                                                                            @if($UK->id == $Audit->unitkerja_id)
                                                                                {{ $UK->name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                            @error('addmore[0][laporanaudit_id]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <?php }else{ ?>
                                                            <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="addmore[0][laporanaudit_id]" id="selectKodeStandar0" data-placeholder="Pilih Kode Standar..." style="width: 100%;" required>
                                                                <option disabled selected="selected" value="">Pilih Kode Standar...</option>
                                                                <?php foreach($laporanaudits as $Audits){ ?>
                                                                    <?php foreach($Audits as $Audit){ ?>
                                                                        <option value="<?php echo $Audit->id; ?>">
                                                                            @foreach($standars as $value)
                                                                                @if($value->id == $Audit->standar_id)
                                                                                    <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                                                @endif
                                                                            @endforeach
                                                                            | 
                                                                            @foreach($unitKerja as $UK)
                                                                                @if($UK->id == $Audit->unitkerja_id)
                                                                                    {{ $UK->name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                            @error('addmore[0][laporanaudit_id]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="read"></div>
                                                <!-- <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required">Nama Standar</label></br>
                                                        <input type="text"  id="laporanTemuan" name="addmore[0][laporanTemuan]" value="{{ old('laporanTemuan') }}" class="form-control @error('laporanTemuan') is-invalid @enderror" placeholder="Masukkan Nama Standar" required>
                                                        <textarea class="form-control @error('laporanTemuan') is-invalid @enderror" rows="3" name="addmore[0][laporanTemuan]" placeholder="Masukkan Nama Standar">{{ old('laporanTemuan') }}</textarea>
                                                        
                                                        @error('addmore[0][laporanTemuan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> -->
                                            </div>
                                            <?php if(auth()->user()->role_id == 1){ ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="required">Analisis Penyebab Masalah</label>
                                                        <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" name="addmore[0][analisiPenyebabMasalah]" placeholder="Masukkan Analisis Penyebab Masalah" required>{{ old('analisiPenyebabMasalah') }}</textarea>

                                                        @error('addmore[0][analisiPenyebabMasalah]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="required">Tindakan Penyelesaian</label>
                                                        <textarea class="form-control @error('tindakanPenyelesaian') is-invalid @enderror" rows="3" name="addmore[0][tindakanPenyelesaian]" placeholder="Masukkan Tindakan Penyelesaian" required>{{ old('tindakanPenyelesaian') }}</textarea>
                                                        
                                                        @error('addmore[0][tindakanPenyelesaian]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>    
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="required">Tindakan Pencegahan</label>
                                                        <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" name="addmore[0][tindakanPencegahan]" placeholder="Masukkan Tindakan Pencegahan" required>{{ old('tindakanPencegahan') }}</textarea>
                                                        
                                                        @error('addmore[0][tindakanPencegahan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label class="required">Hasil Pemeriksaan</label>
                                                        <div class="form-group @error('hasilPemeriksaan') is-invalid @enderror">
                                                            <div class="icheck-success">
                                                                <input type="radio" id="choice-yes[0]" name="addmore[0][hasilPemeriksaan]" value="sesuai">
                                                                <label for="choice-yes[0]">Sesuai</label>
                                                            </div>
                                                            <div class="icheck-danger">
                                                                <input type="radio" id="choice-no[0]" name="addmore[0][hasilPemeriksaan]" value="nonsesuai" checked>
                                                                <label for="choice-no[0]">Tidak Sesuai</label>
                                                            </div>
                                                            
                                                            @error('addmore[0][hasilPemeriksaan]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label>Rekomendasi</label>
                                                        <textarea class="form-control @error('rekomendasi') is-invalid @enderror" rows="3" name="addmore[0][rekomendasi]" placeholder="Masukkan Rekomendasi">{{ old('rekomendasi') }}</textarea>
                                                        
                                                        @error('addmore[0][rekomendasi]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div> 
                                                </div>

                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label class="filepicture">File Bukti Dukung</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="addmore[0][file]" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Pilih file</label>
                                                            
                                                            @error('addmore[0][file]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="row">
                                                <!--<div class="col-5">-->
                                                <!--    <div class="form-group">-->
                                                <!--        <label>Analisis Penyebab Masalah</label>-->
                                                <!--        <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" name="addmore[0][analisiPenyebabMasalah]" placeholder="Masukkan Analisis Penyebab Masalah">{{ old('analisiPenyebabMasalah') }}</textarea>-->

                                                <!--        @error('addmore[0][analisiPenyebabMasalah]')-->
                                                <!--            <span class="invalid-feedback" role="alert">-->
                                                <!--                <strong>{{ $message }}</strong>-->
                                                <!--            </span>-->
                                                <!--        @enderror-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label class="required">Hasil Pemeriksaan</label>
                                                        <div class="form-group @error('hasilPemeriksaan') is-invalid @enderror">
                                                            <div class="icheck-success">
                                                                <input type="radio" id="choice-yes[0]" name="addmore[0][hasilPemeriksaan]" value="sesuai">
                                                                <label for="choice-yes[0]">Sesuai</label>
                                                            </div>
                                                            <div class="icheck-danger">
                                                                <input type="radio" id="choice-no[0]" name="addmore[0][hasilPemeriksaan]" value="nonsesuai" checked>
                                                                <label for="choice-no[0]">Tidak Sesuai</label>
                                                            </div>
                                                            
                                                            @error('addmore[0][hasilPemeriksaan]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="form-group">
                                                        <label>Rekomendasi</label>
                                                        <textarea class="form-control @error('rekomendasi') is-invalid @enderror" rows="3" name="addmore[0][rekomendasi]" placeholder="Masukkan Rekomendasi">{{ old('rekomendasi') }}</textarea>
                                                        
                                                        @error('addmore[0][rekomendasi]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div> 
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            <div class="row">
                                                <div style="display: flex; justify-content: flex-end">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger remove-tr float-right"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalExportCAR">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Export CAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" target="_blank" action="{{ route('CarReports.selectExportPDF') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            @if(auth()->user()->role_id == 1)
                                <div class="card-header">
                                    <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                </div>
    
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                    <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                    @foreach ($unitKerja as $unitKerjas)
                                                        <option value="{{ $unitKerjas->id }}">
                                                            {{ $unitKerjas->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif(auth()->user()->role_id == 2)
                                <div class="card-header">
                                    <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                </div>
    
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                    <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                    @foreach ($unitKerja as $unitKerjas)
                                                        @foreach ($scheduling as $S)
                                                        @if($S->unitkerja_id == $unitKerjas->id)
                                                        <option value="{{ $unitKerjas->id }}">
                                                            {{ $unitKerjas->name}}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="unitkerja_id" value="{{ auth()->user()->unitkerja_id }}">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="row">
        <div class="col-12">
            <div class="card" id="ExportCARshow" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Export Laporan Audit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('CarReports.selectExportPDF')}}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped">  
                            <tr>
                                <th class="required">Standar Laporan Audit</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="laporanaudit_id" id="laporanaudit_id" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                        <option disabled selected="selected">Pilih Standar...</option> 
                                        @foreach ($auditReports as $report)
                                            <option value="{{ $report->id }}">
                                                {{ $report->standar_id}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>  
                            </tr>  
                        </table> 
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card" id="ExportWordCARshow" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Export Bahan TM</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('CarReports.selectExportWord')}}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped">  
                            <tr>
                                <th class="required">Standar Laporan Audit</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="laporanaudit_id" id="laporanaudit_id" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                        <option disabled selected="selected">Pilih Standar...</option> 
                                        @foreach ($exportBahanTM as $bahanTM)
                                            <option value="{{ $bahanTM->id }}">
                                                {{ $bahanTM->standar_id}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>  
                            </tr>  
                        </table> 
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Table CAR Reports Table -->
        <table id="CarReportsTable" class="table table-bordered table-striped display">
        <!--<table id="CarReportsTable" class="table table-bordered table-striped display" cellspacing="0" width="100%">-->
            <thead>
                <tr>
                    <th>No</th>
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <th>Unit Kerja</th>
                    @endif
                    <th>Kode Standar</th>
                    <th>Nama Standar</th>
                    <th>Analisis Penyebab Masalah</th>
                    <th>Tindakan Penyelesaian</th>
                    <th>Hasil Pemeriksaan</th>
                    <th>Status</th>                
                    <th>ACC</th>           
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($CARs as $key=>$CAR)
                <tr> 
                    <td>{{ ++ $key }}</td>
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <td>@foreach($unitKerja as $UK) @if($UK->id == $CAR->unitkerja_id) {{ $UK->name }} @endif @endforeach</td>
                    @endif
                    <td>
                        @foreach($standars as $value)
                            @if($value->id == $CAR->standar_id)
                                {{ $value->kodeStandar }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($standars as $value)
                            @if($value->id == $CAR->standar_id)
                                {{ $value->namaStandar }}
                            @endif
                        @endforeach
                    </td>
                    <td>{!! $CAR->analisiPenyebabMasalah !!}</td>
                    <td>{!! $CAR->tindakanPenyelesaian !!}</td>
                    <td>
                        @if($CAR->hasilPemeriksaan == "sesuai")
                            <span class="badge badge-pill badge-success">Sesuai</span>
                        @else
                            <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                        @endif
                    </td>
                    <td>
                      @if($CAR->status == "open")
                        <span class="badge badge-pill badge-info">Open Check</span>
                      @elseif($CAR->status == "process")
                        <span class="badge badge-pill badge-warning">Process Check</span>
                      @else
                        <span class="badge badge-pill badge-success">Closed Check</span>
                      @endif
                    </td>
                    <td>
                      @foreach($users as $user)
                        @if($user->id == $CAR->acc)
                          {{ $user->name }}
                        @endif
                      @endforeach
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('CarReports.show', $CAR->id) }}">
                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i> LIHAT</button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('CarReports.edit', $CAR->id) }}">
                                    <button class="button btn btn-xl btn-outline-warning is-small is-warning" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i> UBAH</button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <form method="POST" action="{{ route('CarReports.destroy', $CAR->id) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xl btn-outline-danger is-small is-info show-alert-delete-box">
                                        <i class="fa fa-times"></i> HAPUS
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

@push('jsCAR')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.show-alert-delete-box').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda yakin hapus data?",
                    text: "Pastikan kembali data yang akan dihapus",
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

            $("#selectKodeStandar0").change(function(){
                var strcari = $("#selectKodeStandar0").val();
                console.log(strcari);
                if(strcari !=""){
                    $("#read").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                    $.ajax({
                        url : "{{ url('CARget') }}",
                        type : "get",
                        data : "name=" + strcari,
                        success: function(data)
                        {
                            console.log(data);
                            $("#read").html(data);
                        }
                    });
                }
            });
        });

        // DataTable

        // Hide/Show Audit Export
        $("#ExportCARplus").click(function(){
            // show hide paragraph on button click
            $("#ExportCARshow").toggle("slow", function(){});
        });
        $("#ExportWordCARplus").click(function(){
            // show hide paragraph on button click
            $("#ExportWordCARshow").toggle("slow", function(){});
        });

        // Multi Record
            // Hide/Show Multi Record
            $("#MultiCarReportsRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultiCarReportsRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addCAR").click(function(){
                ++i;
                $("#selectKodeStandar["+i+"]").on("change", function(){
                    console.log("TRUE");
                });
                let htmlCAR = `
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default" id="cols">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="required">Kode Standar</label>
                                                <?php if(Auth::user()->role_id == 1){ ?>
                                                    <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="addmore[`+i+`][laporanaudit_id]" id="selectKodeStandar`+i+`" data-placeholder="Pilih Kode Standar..." style="width: 100%;" required>
                                                        <option disabled selected="selected" value="">Pilih Kode Standar...</option>
                                                        <?php foreach($laporanaudits as $Audits){ ?>
                                                            <?php foreach($Audits as $Audit){ ?>
                                                                <option value="<?php echo $Audit->id; ?>">
                                                                    @foreach($standars as $value)
                                                                        @if($value->id == $Audit->standar_id)
                                                                            <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    |
                                                                    <?php foreach($unitKerja as $UK){ ?>
                                                                        <?php if($UK->id == $Audit->unitkerja_id){ ?>
                                                                            <?php echo $UK->name; ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    @error('addmore.[+i+].laporanaudit_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <?php }else{ ?>
                                                    <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="addmore[`+i+`][laporanaudit_id]" id="selectKodeStandar`+i+`" data-placeholder="Pilih Kode Standar..." style="width: 100%;" required>
                                                        <option disabled selected="selected" value="">Pilih Kode Standar...</option>
                                                        <?php foreach($laporanaudits as $Audits){ ?>
                                                            <?php foreach($Audits as $Audit){ ?>
                                                                <option value="<?php echo $Audit->id; ?>">
                                                                    @foreach($standars as $value)
                                                                        @if($value->id == $Audit->standar_id)
                                                                            <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    |
                                                                    <?php foreach($unitKerja as $UK){ ?>
                                                                        <?php if($UK->id == $Audit->unitkerja_id){ ?>
                                                                            <?php echo $UK->name; ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    @error('addmore.[+i+].laporanaudit_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-12" id="read`+i+`"></div>
                                    </div>
                                    <?php if(auth()->user()->role_id == 1){ ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required">Analisis Penyebab Masalah</label>
                                                <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" name="addmore[`+i+`][analisiPenyebabMasalah]" placeholder="Masukkan Analisis Penyebab Masalah" required>{{ old('analisiPenyebabMasalah') }}</textarea>

                                                @error('analisiPenyebabMasalah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required">Tindakan Penyelesaian</label>
                                                <textarea class="form-control @error('tindakanPenyelesaian') is-invalid @enderror" rows="3" name="addmore[`+i+`][tindakanPenyelesaian]" placeholder="Masukkan Tindakan Penyelesaian" required>{{ old('tindakanPenyelesaian') }}</textarea>
                                                
                                                @error('addmore.[+i+].tindakanPenyelesaian')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="required">Tindakan Pencegahan</label>
                                                <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" name="addmore[`+i+`][tindakanPencegahan]" placeholder="Masukkan Tindakan Pencegahan" required>{{ old('tindakanPencegahan') }}</textarea>
                                                
                                                @error('addmore.[+i+].tindakanPencegahan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="required">Hasil Pemeriksaan</label>
                                                <div class="form-group @error('hasilPemeriksaan') is-invalid @enderror">
                                                    <div class="icheck-success">
                                                        <input type="radio" id="choice-yes[`+i+`]" name="addmore[`+i+`][hasilPemeriksaan]" value="sesuai">
                                                        <label for="choice-yes[`+i+`]">Sesuai</label>
                                                    </div>
                                                    <div class="icheck-danger">
                                                        <input type="radio" id="choice-no[`+i+`]" name="addmore[`+i+`][hasilPemeriksaan]" value="nonsesuai" checked>
                                                        <label for="choice-no[`+i+`]">Tidak Sesuai</label>
                                                    </div>
                                                    
                                                    @error('hasilPemeriksaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Rekomendasi</label>
                                                <textarea class="form-control @error('rekomendasi') is-invalid @enderror" rows="3" name="addmore[`+i+`][rekomendasi]" placeholder="Masukkan Rekomendasi">{{ old('rekomendasi') }}</textarea>
                                                
                                                @error('addmore.[+i+].rekomendasi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> 
                                        </div>

                                        <div class="col-5">
                                            <div class="form-group">
                                                <label class="filepicture">File Bukti Dukung</label>
                                                <div class="custom-file">
                                                    <input type="file" name="addmore[`+i+`][file]" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                                    
                                                    @error('addmore.0.file')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="required">Hasil Pemeriksaan</label>
                                                <div class="form-group @error('hasilPemeriksaan') is-invalid @enderror">
                                                    <div class="icheck-success">
                                                        <input type="radio" id="choice-yes[`+i+`]" name="addmore[`+i+`][hasilPemeriksaan]" value="sesuai">
                                                        <label for="choice-yes[`+i+`]">Sesuai</label>
                                                    </div>
                                                    <div class="icheck-danger">
                                                        <input type="radio" id="choice-no[`+i+`]" name="addmore[`+i+`][hasilPemeriksaan]" value="nonsesuai" checked>
                                                        <label for="choice-no[`+i+`]">Tidak Sesuai</label>
                                                    </div>
                                                    
                                                    @error('hasilPemeriksaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label>Rekomendasi</label>
                                                <textarea class="form-control @error('rekomendasi') is-invalid @enderror" rows="3" name="addmore[`+i+`][rekomendasi]" placeholder="Masukkan Rekomendasi">{{ old('rekomendasi') }}</textarea>
                                                
                                                @error('addmore.[+i+].rekomendasi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> 
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="row">
                                        <div style="display: flex; justify-content: flex-end">
                                            <div class="col">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger remove-tr float-right"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $("#CarReportsMultiTable").append(htmlCAR);

                $("#selectKodeStandar"+i+"").change(function(){
                    var strcari = $("#selectKodeStandar"+i+"").val();
                    console.log(strcari);
                    if(strcari !=""){
                        $("#read"+i+"").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                        $.ajax({
                            url : "{{ url('CARget') }}",
                            type : "get",
                            data : "name=" + strcari,
                            success: function(data)
                            {
                                console.log(data);
                                $("#read"+i+"").html(data);
                            }
                        });
                    }
                });
            });


            // $(document).on('click', '#selectLaporanAudit', function(){  
            //     optionText = {!! json_encode($Audits->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectLaporanAudit').append( '<option value="'+el.id+'">'+'Option '+el.standar+'</option>' );
            //     });
            // });



            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            $(document).on('click', '.select2bs4', function(){  
                $(this).select2({
                    theme: 'bootstrap4',
                    // dropdownParent: $("#modalCAR")
                })
            });

            
                // $(document).ready(function(){
                //     for(var a = -1; a < 10000; a++){
                //         $("#selectKodeStandar["+a+"]").change(function(){
                //             var strcari = $("#selectKodeStandar["+a+"]").val();
                //             console.log(strcari);
                //         });
                //     }
                // });
                // $(document).on('change', "#selectKodeStandar["+a+"]", function(){  
                //     console.log("TRUE");
                //     // $(this).select2({
                //     //     theme: 'bootstrap4',
                //     //     // dropdownParent: $("#modalCAR")
                //     // })
                // });
                // $("#selectKodeStandar["+a+"]").on("click", function(){
                //     console.log("TRUE");
                // });
            

            $(document).on('focus', '.dateYear', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });     
            
            $(document).on('focus', '.dateAll', function(){  
                $(this).datepicker({
                    format: "yyyy-mm-dd",
                    viewMode: "date", 
                    minViewMode: "date"
                });
            });     
            
            $(document).on('focus', '.input1', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });     
            
            $(document).on('focus', '.input2', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });     

            $(document).on('focus', '.timepicker', function(){  
                $(this).clockpicker()
                    .find('input').change(function(){
                        console.log(this.value);
                    });
                    var input = $('#single-input').clockpicker({
                        placement: 'bottom',
                        align: 'left',
                        autoclose: true,
                        'default': 'now'
                    });
            });      

            $(document).on('click', '.remove-tr', function(){  
                $(this).closest("#cols").remove();
                    // $(this).parents('tr').remove();
            });
            

    </script>
@endpush