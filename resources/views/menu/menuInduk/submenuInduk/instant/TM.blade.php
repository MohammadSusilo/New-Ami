<div class="page-content" style="background-image: url('plugins/stepper/images/wizard-v1.jpg')">
    <div class="wizard-v1-content">
        <div class="wizard-form">
            <form class="form-register" id="form-register" action="#" method="post">
                <div id="form-total">
                    <!-- Bahan TM -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-contract"></i></span>
                        <span class="step-number">Step 1</span>
                        <span class="step-text">Bahan Rapat TM</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="jadwalBahanTM">Jadwal TM</label>
                                <select class="form-control select2bs4 @error('jadwalBahanTM') is-invalid @enderror auto-save" name="jadwalBahanTM" id="multistepTM_jadwalBahanTM" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Jadwal...</option>    
                                    @foreach ($jadwalTM as $jadwal)
                                        <option value="{{ $jadwal->id }}">
                                            {{ $jadwal->tglTM}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('jadwalBahanTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="deskripsiBahanTM">Deskripsi</label>
                                <textarea class="form-control @error('deskripsiBahanTM') is-invalid @enderror auto-save" id="multistepTM_deskripsiBahanTM" rows="3" name="deskripsiBahanTM" placeholder="Enter Deskripsi">{{ old('deskripsiBahanTM') }}</textarea>
                                              
                                @error('deskripsiBahanTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="statusBahanTM">Status</label>
                                <select class="@error('statusBahanTM') is-invalid @enderror auto-save" name="statusBahanTM" id="multistepTM_statusBahanTM">
                                    <option>-- Select Status --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>
                                  
                                  @error('statusBahanTM')
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


                    <!-- Hasil TM -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-sticky-note"></i></span>
                        <span class="step-number">Step 2</span>
                        <span class="step-text">Hasil Rapat TM</span>
                      </h2>
                      <section>
                        <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="jadwalHasilTM">Jadwal TM</label>
                                <select class="form-control select2bs4 @error('jadwalHasilTM') is-invalid @enderror auto-save" name="jadwalHasilTM" id="multistepTM_jadwalHasilTM" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Jadwal...</option>    
                                    @foreach ($jadwalTM as $jadwal)
                                        <option value="{{ $jadwal->id }}">
                                            {{ $jadwal->tglTM}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('jadwalHasilTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="subjekHasilTM">Subjek</label>
                                <input type="text" id="multistepTM_subjekHasilTM" name="subjekHasilTM" value="{{ old('subjekHasilTM') }}" class="form-control @error('subjekHasilTM') is-invalid @enderror auto-save" placeholder="Enter Subjek">
                                    
                                  @error('subjekHasilTM')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="uraianHasilTM">Uraian</label>
                                <textarea class="form-control @error('uraianHasilTM') is-invalid @enderror auto-save" id="multistepTM_uraianHasilTM" rows="3" name="uraianHasilTM" placeholder="Enter Uraian">{{ old('uraianHasilTM') }}</textarea>

                                  @error('uraianHasilTM')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="pembahasanHasilTM">Hasil Pembahasan</label>
                                <textarea class="form-control @error('pembahasanHasilTM') is-invalid @enderror auto-save" id="multistepTM_pembahasanHasilTM" rows="3" name="pembahasanHasilTM" placeholder="Enter Pembahasan">{{ old('pembahasanHasilTM') }}</textarea>

                                  @error('pembahasanHasilTM')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="hadirHasilTM">Hadir</label>
                                <input type="number" class="form-control @error('hadirHasilTM') is-invalid @enderror auto-save" id="multistepTM_hadirHasilTM" name="hadirHasilTM" value="{{ old('hadirHasilTM') }}" placeholder="Enter Hadir">

                                  @error('hadirHasilTM')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tidakhadirHasilTM">Tidak Hadir</label>
                                <input type="number" class="form-control @error('tidakhadirHasilTM') is-invalid @enderror auto-save" id="multistepTM_tidakhadirHasilTM" name="tidakhadirHasilTM" value="{{ old('tidakhadirHasilTM') }}" placeholder="Enter Tidak Hadir">

                                  @error('tidakhadirHasilTM')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="statusHasilTM">Status</label>
                                <select class="@error('statusHasilTM') is-invalid @enderror auto-save" name="statusHasilTM" id="multistepTM_statusHasilTM">
                                    <option>-- Select Status --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>
                                                
                                  @error('statusHasilTM')
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

                    <!-- Tindak Lanjut TM -->
                      <h2>
                        <span class="step-icon"><i class="fas fa-file-medical-alt"></i></span>
                        <span class="step-number">Step 3</span>
                        <span class="step-text">Tindak Lanjut TM</span>
                      </h2>
                      <section>
                          <div class="inner">
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="hasilTindakTM" class="required">Hasil TM</label>
                                <select class="form-control select2bs4 @error('hasilTindakTM') is-invalid @enderror" name="hasilTindakTM" id="multistepTM_hasilTindakTM"style="width: 100%;">
                                    <option disabled selected="selected">Pilih Hasil...</option>         
                                    @foreach ($hasilTM as $hasil)
                                        <option value="{{ $hasil->id }}">
                                            {{ $hasil->subjek}}
                                        </option>
                                    @endforeach
                                </select>
                                
                                @error('hasilTindakTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="tindaklanjutTindakTM">Tindak Lanjut</label>
                                <textarea class="form-control @error('tindaklanjutTindakTM') is-invalid @enderror auto-save" id="multistepTM_tindaklanjutTindakTM" rows="3" name="tindaklanjutTindakTM" placeholder="Enter Tindak Lanjut">{{ old('tindaklanjutTindakTM') }}</textarea>

                                @error('tindaklanjutTindakTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="PICTindakTM">PIC</label>
                                <select class="form-control select2bs4 @error('PICTindakTM') is-invalid @enderror auto-save" name="PICTindakTM[]" id="multistepTM_PICTindakTM" multiple="multiple" data-placeholder="Pilih PIC..." style="width: 100%;">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name}}
                                    </option>
                                    @endforeach
                                </select>

                                @error('PICTindakTM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-holder form-holder-2">
                                <label for="statusTindakTM">Status</label>
                                <select class="@error('statusTindakTM') is-invalid @enderror auto-save" name="statusTindakTM" id="multistepTM_statusTindakTM">
                                    <option>-- Select Status --</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="nonselesai">Non Selesai</option>
                                </select>
                                                
                                  @error('statusTindakTM')
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