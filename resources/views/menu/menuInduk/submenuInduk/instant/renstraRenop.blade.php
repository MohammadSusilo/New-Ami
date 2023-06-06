<div class="page-content" style="background-image: url('plugins/stepper/images/wizard-v1.jpg')">
    <div class="wizard-v1-content">
        <div class="wizard-form">
            <form class="form-register" id="form-register" action="#" method="post">
                <div id="form-total">
                    <!-- Dokumen Acuan -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-invoice"></i></span>
                        <span class="step-number">Step 1</span>
                        <span class="step-text">Dokumen Acuan</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror auto-save" id="multistepRensNop_kodeacuan" name="kode" value="{{ old('kode') }}" autofocus placeholder="Enter kode">

                                @error('kode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror auto-save" id="multistepRensNop_deskripsiacuan" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                                              
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Target</label>
                                <input type="number" class="form-control @error('target') is-invalid @enderror auto-save" name="target" value="{{ old('target') }}" id="multistepRensNop_targetacuan" placeholder="Enter target">

                                  @error('target')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Unit Target</label>
                                <input type="number" class="form-control @error('unit_target') is-invalid @enderror auto-save" name="unit_target" value="{{ old('unit_target') }}" id="multistepRensNop_unit_targetacuan" placeholder="Enter Unit target">

                                  @error('unit_target')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Tipe Indikator</label>
                                <input type="text" class="form-control @error('tipe_indikator') is-invalid @enderror auto-save" name="tipe_indikator" value="{{ old('tipe_indikator') }}" id="multistepRensNop_tipe_indikator" placeholder="Tipe Indikator">

                                  @error('tipe_indikator')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="text" id="multistepRensNop_tahunacuan" name="tahun" value="{{ old('tahun') }}" class="form-control datepicker @error('tahun') is-invalid @enderror auto-save">

                                  @error('tahun')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">File Dokumen</label>
                                <select class="form-control select2bs4 @error('dokumen_id') is-invalid @enderror auto-save" id="multistepRensNop_dokumen_id" name="dokumen_id" style="width: 100%;">
                                  <option disabled selected="selected">Pilih Dokumen...</option>
                                  @foreach($dokInduk as $dokInd)
                                    <option value="{{$dokInd->id}}">{{$dokInd->name}}</option>  
                                  @endforeach
                                </select>
                                              
                                @error('dokumen_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Jenis Dokumen</label>
                                <select class="form-control select2bs4 @error('jenis') is-invalid @enderror auto-save" id="multistepRensNop_jenis" name="jenis" style="width: 100%;">
                                    <option disabled selected="selected">Jenis Dokumen...</option>
                                    <option value="renstra">Renstra</option>  
                                    <option value="PK">PK</option>  
                                </select>

                               @error('jenis')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Referensi</label>
                                <input type="text" class="form-control @error('referensi') is-invalid @enderror auto-save" name="referensi" value="{{ old('referensi') }}" id="multistepRensNop_referensi" placeholder="Enter Referensi">

                                  @error('referensi')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>Status</label>
                                <select class="@error('status') is-invalid @enderror auto-save" name="status" id="multistepRensNop_statusacuan">
                                    <option>-- Select Status --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>
                                  
                                  @error('status')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <button type="submit" id="hapus" class="btn btn-danger hapus">
                              <i class="fa fa-trash"></i>  Hapus History
                            </button>
                        </div>
                      </section>


                    <!-- Renop -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file"></i></span>
                        <span class="step-number">Step 2</span>
                        <span class="step-text">Rencana Operasional</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror auto-save" id="multistepRensNop_koderenop" name="kode" value="{{ old('kode') }}" autofocus placeholder="Enter kode">

                                  @error('kode')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror auto-save" id="multistepRensNop_deskripsirenop" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                  @error('deskripsi')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Target</label>
                                <input type="number" class="form-control @error('target') is-invalid @enderror auto-save" id="multistepRensNop_targetrenop" name="target" value="{{ old('target') }}" placeholder="Enter target">

                                  @error('target')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Unit Target</label>
                                <input type="text" class="form-control @error('unit_target') is-invalid @enderror auto-save" id="multistepRensNop_unit_targetrenop" name="unit_target" value="{{ old('unit_target') }}" placeholder="Enter Unit target">

                                  @error('unit_target')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="text" id="multistepRensNop_tahunrenop" name="tahun" value="{{ old('tahun') }}" class="form-control datepicker @error('tahun') is-invalid @enderror auto-save">

                                  @error('tahun')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Unit Kerja</label>
                                <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror auto-save"  id="multistepRensNop_unitkerja_id" name="unitkerja_id" style="width: 100%;">
                                  <option disabled selected="selected">Pilih Unit Kerja...</option>
                                  @foreach($unitKerja as $UK)
                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                  @endforeach
                                </select>
                                
                                @error('unitkerja_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputPassword1">Dokumen Acuan</label>
                                <select class="form-control select2bs4 @error('renstra') is-invalid @enderror auto-save" id="multistepRensNop_renstraRenop" name="renstra[]" multiple="multiple" data-placeholder="Select a Dokumen Acuan" style="width: 100%;">
                                    @foreach ($renstra as $rens)
                                    <option value="{{ $rens->id }}">
                                        {{ $rens->kode}}
                                    </option>
                                    @endforeach
                                </select>
                                                
                                  @error('renstra')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>Status</label>
                                <select class="@error('status') is-invalid @enderror auto-save" name="status" id="multistepRensNop_statusrenop">
                                    <option>-- Select Status --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>
                                                
                                  @error('status')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <button type="submit" id="hapus" class="btn btn-danger hapus">
                              <i class="fa fa-trash"></i>  Hapus History
                            </button>
                        </div>
                      </section>

                    <!-- Kinerja Unit -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="step-number">Step 3</span>
                        <span class="step-text">Kinerja Unit</span>
                      </h2>
                      <section>
                          <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1" class="required">Renop</label>
                                <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror auto-save" id="multistepRensNop_renop_id" autofocus name="renop_id" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Renop...</option>
                                    @foreach($renop as $renops)
                                    <option value="{{$renops->id}}">{{$renops->kode}}</option>
                                    @endforeach
                                </select>
                                
                                @error('renop_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror auto-save" id="multistepRensNop_deskripsikinerja" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1" class="required">Nilai Capaian</label>
                                <input type="number" class="form-control @error('nilaiCapaian') is-invalid @enderror auto-save" id="multistepRensNop_nilaiCapaian" name="nilaiCapaian" value="{{ old('nilaiCapaian') }}" placeholder="Enter Nilai Capaian">

                                @error('nilaiCapaian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1" class="required">Unit Capaian</label>
                                <input type="number" class="form-control @error('unitCapaian') is-invalid @enderror auto-save" id="multistepRensNop_unitCapaian" name="unitCapaian" value="{{ old('unitCapaian') }}" placeholder="Enter Unit Capaian">

                                @error('unitCapaian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="text" id="multistepRensNop_tahunkinerja" name="tahun" value="{{ old('tahun') }}" class="form-control datepicker @error('tahun') is-invalid @enderror auto-save" placeholder="Enter Tahun">

                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>Status</label>
                                <select class="@error('status') is-invalid @enderror auto-save" name="status" id="multistepRensNop_statuskinerja">
                                    <option>-- Select Status --</option>
                                    <option value="terbaik">Terbaik</option>
                                    <option value="normal">Normal</option>
                                    <option value="terjelek">Terburuk</option>
                                </select>
                                                
                                  @error('status')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <button type="submit" id="hapus" class="btn btn-danger hapus">
                              <i class="fa fa-trash"></i>  Hapus History
                            </button>
                          </div>
                      </section>

                    <!-- Bukti Kinerja Unit -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-archive"></i></span>
                        <span class="step-number">Step 4</span>
                        <span class="step-text">Bukti Kinerja Unit</span>
                      </h2>
                      <section>
                          <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1" class="required">Nama Bukti</label>
                                <input type="text" class="form-control @error('namaBukti') is-invalid @enderror auto-save" id="multistepRensNop_namaBukti" name="namaBukti" value="{{ old('namaBukti') }}" autofocus placeholder="Enter Nama Bukti">

                                @error('namaBukti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1" class="required">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror auto-save" id="multistepRensNop_deskripsibukti" rows="3" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="text" id="multistepRensNop_tahunbukti" name="tahun" value="{{ old('tahun') }}" class="form-control datepicker @error('tahun') is-invalid @enderror auto-save" placeholder="Enter Tahun">

                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>File Bukti Kinerja</label>
                                <div class="custom-file">
                                    <input type="file" name="lokDokBukti" class="custom-file-input @error('lokDokBukti') is-invalid @enderror auto-save" id="multistepRensNop_customFilebukti">
                                    <label class="custom-file-label" for="customFilebukti">Choose file</label>

                                    @error('lokDokBukti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>Status</label>
                                <select class="@error('status') is-invalid @enderror auto-save" name="status" id="multistepRensNop_statusbukti">
                                    <option>-- Select Status --</option>
                                    <option value="terbaik">Terbaik</option>
                                    <option value="normal">Normal</option>
                                    <option value="terjelek">Terburuk</option>
                                </select>
                                                
                                  @error('status')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <button type="submit" id="hapus" class="btn btn-danger hapus">
                              <i class="fa fa-trash"></i>  Hapus History
                            </button>
                          </div>
                          <div align="right">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      </section>
                </div>
            </form>
        </div>
    </div>
</div>

@push('jsInstantRenstraRenop')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('plugins/stepper/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('plugins/stepper/js/main.js') }}"></script>
    <script src="{{ asset('js/savy.js') }}"></script>
    <script>
        $(document).ready(function(){
        $('.auto-save').savy('load');
            $(".hapus" ).click(function() {
                $('.auto-save').savy('destroy');
                location.reload();
            });
        });
    </script>
@endpush()