@foreach($data as $key=>$bahanTM)
    @foreach($data1 as $cars)
        @if($cars->id == $bahanTM->car_id)
        <div class="card card-default">
          <!-- Start card-body -->
          <div class="card-body">

            <!-- Start row 1 -->
            <div class="row">
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label>Subjek</label>
                  <input type="text"  id="subjek" name="addmore[{{ $key }}][subjek]" value="{{ $cars->laporanTemuan }}" class="form-control @error('subjek') is-invalid @enderror">

                  @error('addmore.0.subjek')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label>Uraian</label>
                  <textarea class="form-control @error('uraian') is-invalid @enderror" rows="3" name="addmore[{{ $key }}][uraian]">{{ $cars->analisiPenyebabMasalah }}</textarea>

                  @error('addmore.0.uraian')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label class="required">Hasil Pembahasan</label>
                  <textarea class="form-control @error('hasilPembahasan') is-invalid @enderror" rows="3" name="addmore[{{ $key }}][hasilPembahasan]" placeholder="Enter Hasil Pembahasan">{{ old('hasilPembahasan') }}</textarea>

                  @error('addmore.0.hasilPembahasan')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>
            <!-- End row 1 -->

            <!-- Start row 2 -->
            <div class="row">
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label class="required">Jumlah Hadir</label>
                  <input type="number"  id="hadir" name="addmore[{{ $key }}][hadir]" value="{{ old('hadir') }}" class="form-control @error('hadir') is-invalid @enderror" placeholder="Enter Hadir">

                  @error('addmore.0.hadir')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label class="required">Jumlah Tidak Hadir</label>
                  <input type="number"  id="tidakHadir" name="addmore[{{ $key }}][tidakHadir]" value="{{ old('tidakHadir') }}" class="form-control @error('tidakHadir') is-invalid @enderror" placeholder="Enter Tidak Hadir">

                  @error('addmore.0.tidakHadir')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="form-group">
                  <label class="required">Status</label>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <div class="icheck-primary">
                          <input type="radio" id="selecthasiTM1" name="addmore[{{ $key }}][status]" value="aktif" checked>
                          <label for="selecthasiTM1">
                              Aktif
                          </label>
                      </div>
                      <div class="icheck-danger d-inline">
                          <input type="radio" id="selecthasiTM2" name="addmore[{{ $key }}][status]" value="nonaktif">
                          <label for="selecthasiTM2">
                              Non Aktif
                          </label>
                      </div>
                  </div>

                  @error('addmore.0.status')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>
            <!-- End row 2 -->

          </div>
          <!-- End card-body  -->
        </div>
        @endif
  @endforeach
@endforeach