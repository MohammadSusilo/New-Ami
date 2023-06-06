<div class="page-content" style="background-image: url('plugins/stepper/images/wizard-v1.jpg')">
    <div class="wizard-v1-content">
        <div class="wizard-form">
            <form class="form-register" id="form-register" action="#" method="post">
                <div id="form-total">
                    <!-- Jadwal Audit -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-calendar-week"></i></span>
                        <span class="step-number">Step 1</span>
                        <span class="step-text">Jadwal Audit Mutu</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tahunJadwalAudit">Tahun Audit</label>
                                <input type="text" class="form-control dateYear @error('tahunJadwalAudit') is-invalid @enderror auto-save" id="multistepAMI_tahunJadwalAudit" name="tahunJadwalAudit" value="{{ old('tahunJadwalAudit') }}" autofocus placeholder="Enter Tahun Audit">

                                @error('tahunJadwalAudit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tglJadwalAudit">Tanggal Audit</label>
                                <input type="text" class="form-control dateAll @error('tglJadwalAudit') is-invalid @enderror auto-save" id="multistepAMI_tglJadwalAudit" name="tglJadwalAudit" value="{{ old('tglJadwalAudit') }}" autofocus placeholder="Enter Tanggal Audit">
                                              
                                @error('tglJadwalAudit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="waktuJadwalAudit">Waktu Audit</label>
                                <div class="input-group dateTime pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                  <input type="text" name="waktuJadwalAudit" id="multistepAMI_waktuJadwalAudit" value="{{ old('waktuJadwalAudit') }}" class="form-control @error('waktuJadwalAudit') is-invalid @enderror auto-save" placeholder="Enter Waktu Audit">
                                
                                
                                  @error('waktuJadwalAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="unitKerjaJadwalAudit">Unit Kerja</label>
                                <select class="form-control select2bs4 @error('unitKerjaJadwalAudit') is-invalid @enderror auto-save" id="multistepAMI_unitKerjaJadwalAudit" name="unitKerjaJadwalAudit" style="width: 100%;">
                                  <option disabled selected="selected">Pilih Unit Kerja...</option>
                                  @foreach($unitKerja as $UK)
                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                  @endforeach
                                </select>

                                  @error('unitKerjaJadwalAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="usersJadwalAudit">Users</label>
                                <select class="form-control select2bs4 @error('usersJadwalAudit') is-invalid @enderror auto-save" name="usersJadwalAudit[]" id="multistepAMI_usersJadwalAudit" multiple="multiple" data-placeholder="Pilih Users..." style="width: 100%;">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name}}
                                    </option>
                                    @endforeach
                                </select>

                                  @error('usersJadwalAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="statusJadwalAudit">Status</label>
                                <select class="@error('statusJadwalAudit') is-invalid @enderror auto-save" name="statusJadwalAudit" id="multistepAMI_statusJadwalAudit">
                                    <option>-- Select Status --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>

                                  @error('statusJadwalAudit')
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

                    <!-- Laporan Audit -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-archive"></i></span>
                        <span class="step-number">Step 2</span>
                        <span class="step-text">Laporan Audit Mutu</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="periodeLaporanAudit">Jadwal Periode Audit</label>
                                <select class="form-control select2bs4 @error('periodeLaporanAudit') is-invalid @enderror auto-save" name="periodeLaporanAudit" id="multistepAMI_periodeLaporanAudit" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                    <option disabled selected="selected">Pilih Jadwal...</option>    
                                    @foreach ($audits as $audit)
                                      <option value="{{ $audit->id }}">
                                        Periode: {{ $audit->periode }} ({{ $audit->tahun }})
                                      </option>
                                    @endforeach
                                </select>

                                  @error('periodeLaporanAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="standarLaporanAudit">Standar</label>
                                <input type="text"  id="multistepAMI_standarLaporanAudit" name="standarLaporanAudit" value="{{ old('standarLaporanAudit') }}" class="form-control @error('standarLaporanAudit') is-invalid @enderror auto-save" placeholder="Enter Standar">

                                  @error('standarLaporanAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="kategoriTemuanLaporanAudit">Kategori Temuan</label>
                                <select class="@error('kategoriTemuanLaporanAudit') is-invalid @enderror auto-save" name="kategoriTemuanLaporanAudit" placeholder="Enter Uraian Temuan" id="multistepAMI_kategoriTemuanLaporanAudit">
                                    <option>Select Kategori...</option>
                                    <option value="OFI">Opportunity for Improvement</option>
                                    <option value="AOC">Area of Concern</option>
                                    <option value="NC">Non-Conformity</option>
                                </select>

                                  @error('kategoriTemuanLaporanAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="uraianTemuanLaporanAudit">Uraian Temuan</label>
                                <textarea class="form-control @error('uraianTemuanLaporanAudit') is-invalid @enderror  auto-save" rows="3" name="uraianTemuanLaporanAudit" id="multistepAMI_uraianTemuanLaporanAudit" placeholder="Enter Uraian Temuan">{{ old('uraianTemuanLaporanAudit') }}</textarea>

                                  @error('uraianTemuanLaporanAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="saranPerbaikanLaporanAudit">Saran Perbaikan</label>
                                <textarea class="form-control @error('saranPerbaikanLaporanAudit') is-invalid @enderror auto-save" rows="3" name="saranPerbaikanLaporanAudit" id="multistepAMI_saranPerbaikanLaporanAudit" placeholder="Enter Saran Perbaikan">{{ old('saranPerbaikanLaporanAudit') }}</textarea>

                                  @error('saranPerbaikanLaporanAudit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="statusLaporanAudit">Status</label>
                                <select class="@error('statusLaporanAudit') is-invalid @enderror auto-save" name="statusLaporanAudit" id="multistepAMI_statusLaporanAudit">
                                    <option>-- Select Status --</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="nonselesai">Non Selesai</option>
                                </select>
                                                
                                  @error('statusLaporanAudit')
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

                    <!-- CAR -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-signature"></i></span>
                        <span class="step-number">Step 3</span>
                        <span class="step-text">CAR Audit Mutu</span>
                      </h2>
                      <section>
                          <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="laporanAuditCAR" class="required">Laporan Audit</label>
                                <select class="form-control select2bs4 @error('laporanAuditCAR') is-invalid @enderror auto-save" name="laporanAuditCAR" id="multistepAMI_laporanAuditCAR" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Laporan Audit...</option>    
                                    @foreach ($Audits as $Audit)
                                      <option value="{{ $Audit->id }}">
                                          {{ $Audit->standar}}
                                      </option>
                                    @endforeach
                                </select>

                                @error('laporanAuditCAR')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="analisisPenyebabCAR" class="required">Analisis Penyebab Masalah</label>
                                <textarea class="form-control @error('analisisPenyebabCAR') is-invalid @enderror auto-save" id="multistepAMI_analisisPenyebabCAR" rows="3" name="analisisPenyebabCAR" placeholder="Enter Analisis">{{ old('analisisPenyebabCAR') }}</textarea>

                                @error('analisisPenyebabCAR')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tindakanPenyelesaianCAR">Tindakan Penyelesaian</label>
                                <textarea class="form-control @error('tindakanPenyelesaianCAR') is-invalid @enderror auto-save" id="multistepAMI_tindakanPenyelesaianCAR" rows="3" name="tindakanPenyelesaianCAR" placeholder="Enter Penyelesaian">{{ old('tindakanPenyelesaianCAR') }}</textarea>
                               
                                @error('tindakanPenyelesaianCAR')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tindakanPencegahanCAR">Tindakan Pencegahan</label>
                                <textarea class="form-control @error('tindakanPencegahanCAR') is-invalid @enderror auto-save" id="multistepAMI_tindakanPencegahanCAR" rows="3" name="tindakanPencegahanCAR" placeholder="Enter Pencegahan">{{ old('tindakanPencegahanCAR') }}</textarea>

                                @error('tindakanPencegahanCAR')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label>File Bukti CAR</label>
                                <div class="custom-file">
                                    <input type="file" name="fileCAR" class="custom-file-input @error('fileCAR') is-invalid @enderror auto-save" id="multistepAMI_customFilebukti">
                                    <label class="custom-file-label" for="customFilebukti">Choose file</label>

                                    @error('fileCAR')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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

                    <!-- CAR -->
                      <!-- <h2>
                        <span class="step-icon"><i class="zmdi zmdi-CARs"></i></span>
                        <span class="step-number">Step 4</span>
                        <span class="step-text">CARs</span>
                      </h2>
                      <section>
                      </section> -->
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