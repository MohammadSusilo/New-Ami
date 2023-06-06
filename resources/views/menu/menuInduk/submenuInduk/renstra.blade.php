    <a href="{{ route('renstra.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultirenstraRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalDokumenAcuan">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-pdf"></i> Export-->
    <!--</a>-->

    <p align="right">
        <a href="{{ url('dokAcuanhistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Dokumen -->
    <div class="modal fade" id="modalDokumenAcuan">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Multiple Dokumen Acuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{ route('renstra.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="addRenstra" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="renstraMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Kode</label>
                                                            <input type="text" name="addmore[0][kode]" placeholder="Enter Kode" class="form-control" autofocus>
                                                            
                                                            @error('addmore.0.kode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Deskripsi</label></br>
                                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                                            @error('addmore.0.deskripsi')
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
                                                            <label>Target</label>
                                                            <input type="number" name="addmore[0][target]" placeholder="Enter Target" class="form-control" />

                                                            @error('addmore.0.target')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Target</label>
                                                            <input type="text" name="addmore[0][unit_target]" placeholder="Enter Unit Target" class="form-control" />

                                                            @error('addmore.0.unit_target')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Tipe Indikator</label>
                                                            <input type="text" name="addmore[0][tipe_indikator]" placeholder="Enter Tipe Indikator" class="form-control" />

                                                            @error('addmore.0.tipe_indikator')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>File Dokumen</label>
                                                            <select class="form-control select2bs4 @error('dokumen_id') is-invalid @enderror" name="addmore[0][dokumen_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Dokumen...</option>
                                                                @foreach($dokInduk as $dokInd)
                                                                    <option value="{{$dokInd->id}}">{{$dokInd->name}}</option>  
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.dokumen_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Jenis Dokumen</label>
                                                            <select class="form-control select2bs4 @error('jenis') is-invalid @enderror" name="addmore[0][jenis]" style="width: 100%;">
                                                                <option disabled selected="selected">Jenis Dokumen...</option>
                                                                <option value="renstra">Renstra</option>  
                                                                <option value="PK">PK</option>  
                                                            </select>

                                                            @error('addmore.0.jenis')
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
                                                            <label>Referensi</label>
                                                            <input type="text" name="addmore[0][referensi]" placeholder="Enter Referensi" class="form-control" />

                                                            @error('addmore.0.referensi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Tahun</label>
                                                            <input type="text" name="addmore[0][tahun]" placeholder="Enter Tahun" class="form-control dateYear" />

                                                            @error('addmore.0.tahun')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                            <div class="icheck-success">
                                                                <input type="radio" id="selectAktifRenstra0" name="addmore[0][status]" value="aktif" checked>
                                                                <label for="selectAktifRenstra0">
                                                                    Aktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-danger d-inline">
                                                                <input type="radio" id="selectNonAktifRenstra0" name="addmore[0][status]" value="nonaktif">
                                                                <label for="selectNonAktifRenstra0">
                                                                    Tidak Aktif
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

    <!-- Multi Record Renstra -->
    <div class="row">
        <div class="col-12" id="MultirenstraRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple Renstra</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('renstra.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="renstraMultiTable">  
                            <tr>
                                <th class="required">Kode</th>
                                <th>Deskripsi</th>
                                <th class="required">Target</th>
                                <th class="required">Unit Target</th>
                                <th class="required">Tipe Indikator</th>
                                <th>Tahun</th>
                                <th class="required">File Dokumen</th>
                                <th class="required">Jenis Dokumen</th>
                                <th>Referensi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addmore[0][kode]" placeholder="Enter Kode" class="form-control" autofocus>
                                    
                                    @error('addmore.0.kode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                                    <!-- <input type="text" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi" class="form-control" /> -->

                                    @error('addmore.0.deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="number" name="addmore[0][target]" placeholder="Enter Target" class="form-control" />

                                    @error('addmore.0.target')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="number" name="addmore[0][unit_target]" placeholder="Enter Unit Target" class="form-control" />

                                    @error('addmore.0.unit_target')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="text" name="addmore[0][tipe_indikator]" placeholder="Enter Tipe Indikator" class="form-control" />

                                    @error('addmore.0.tipe_indikator')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="text" name="addmore[0][tahun]" placeholder="Enter Tahun" class="form-control dateYear" />

                                    @error('addmore.0.tahun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <select class="form-control select2bs4 @error('dokumen_id') is-invalid @enderror" name="addmore[0][dokumen_id]" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Dokumen...</option>
                                    @foreach($dokInduk as $dokInd)
                                        <option value="{{$dokInd->id}}">{{$dokInd->name}}</option>  
                                    @endforeach
                                    </select>

                                    @error('addmore.0.dokumen_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control select2bs4 @error('jenis') is-invalid @enderror" name="addmore[0][jenis]" style="width: 100%;">
                                        <option disabled selected="selected">Jenis Dokumen...</option>
                                        <option value="renstra">Renstra</option>  
                                        <option value="PK">PK</option>  
                                    </select>

                                    @error('addmore.0.jenis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="text" name="addmore[0][referensi]" placeholder="Enter Referensi" class="form-control" />

                                    @error('addmore.0.referensi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                        <div class="icheck-primary">
                                            <input type="radio" id="selectrenstra1" name="addmore[0][status]" value="aktif" checked>
                                            <label for="selectrenstra1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="selectrenstra2" name="addmore[0][status]" value="nonaktif">
                                            <label for="selectrenstra2">
                                                Non Aktif
                                            </label>
                                        </div>
                                    </div>

                                    @error('addmore.0.status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <button type="button" name="add" id="addRenstra" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </td>  
                            </tr>  
                        </table> 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Table Renstra -->
        <table id="renstraTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Periode</th>
                    <th>Target</th>
                    <th>Unit Target</th>
                    <th>Jenis Dokumen</th>
                    <th>Renop</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($renstra as $key=> $rens)
                <tr> 
                    <td>{{ ++ $key }}</td>
                    <td>{{ $rens->kode }}</td>
                    <td>{{ $rens->tahun }}</td>
                    <td>{{ $rens->target }}</td>
                    <td>{{ $rens->unit_target }}</td>
                    <td>{{ $rens->jenis }}</td>
                    <td>
                        @foreach ($rens->renop as $renops)
                            <span class="badge badge-pill badge-info">{{ $renops->kode }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($rens->status == "aktif")
                            <span class="badge badge-pill badge-success">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Tidak Aktif<span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('renstra.show', $rens->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('renstra.edit', $rens->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('renstra.destroy', $rens->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form> -->
                                <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteDokAcuan{{$rens->id}}">
                                    <i class="fa fa-times"></i>
                                </button>

                                <div class="modal fade" id="deleteDokAcuan{{$rens->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Dokumen Acuan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('renstra.destroy', $rens->id) }}" method="POST" class="is-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p style="text-align: center;">Apakah anda yakin hapus data Dokumen Acuan : {{ $rens->kode }} !!!</p>
                                                    <center>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-success">Iya</button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                            </div>
                        </div>
                    </td>
              </tr>
            @endforeach
            </tbody>
        </table>

@push('jsrenstra')
    <script>
        // DataTable
        // $('#renstraTable').DataTable( {
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });

        // Multi Record
            // Hide/Show Multi Record
            $("#MultirenstraRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultirenstraRecord").toggle("slow", function(){});
            });
        
            // $(document).on('click', '#selectDokumen', function(){  
            //     optionText = {!! json_encode($dokInduk->toArray()) !!};
            //     // var newOption = new Option(optionText.name, optionText.id, false, false);
            //     console.log(optionText);
            //     // $('#selectDokumen').append( '<option value="'+optionText.id+'">'+'Option '+optionText.name+'</option>' );
            //     // jQuery.each(optionText,function(i, el) {
            //     //     // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //     //     // console.log(optionValue);
            //     //     $('#selectDokumen').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     // });
            //     // $('#selectDokumen').append( '<option value="'+optionText.id+'">'+'Option '+optionText.name+'</option>' );
            // });



            // Add Row Multi Record
            var i = 0;
            $("#addRenstra").click(function(){
                ++i;
                let html = `
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Kode</label>
                                                            <input type="text" name="addmore[`+i+`][kode]" placeholder="Enter Kode" class="form-control" autofocus>
                                                            
                                                            @error('addmore.0.kode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Deskripsi</label></br>
                                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[`+i+`][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                                            @error('addmore.0.deskripsi')
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
                                                            <label>Target</label>
                                                            <input type="number" name="addmore[`+i+`][target]" placeholder="Enter Target" class="form-control" />

                                                            @error('addmore.0.target')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Target</label>
                                                            <input type="text" name="addmore[`+i+`][unit_target]" placeholder="Enter Unit Target" class="form-control" />

                                                            @error('addmore.0.unit_target')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Tipe Indikator</label>
                                                            <input type="text" name="addmore[`+i+`][tipe_indikator]" placeholder="Enter Tipe Indikator" class="form-control" />

                                                            @error('addmore.0.tipe_indikator')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>File Dokumen</label>
                                                            <select class="form-control select2bs4 @error('dokumen_id') is-invalid @enderror" name="addmore[`+i+`][dokumen_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Dokumen...</option>
                                                                @foreach($dokInduk as $dokInd)
                                                                    <option value="{{$dokInd->id}}">{{$dokInd->name}}</option>  
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.dokumen_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Jenis Dokumen</label>
                                                            <select class="form-control select2bs4 @error('jenis') is-invalid @enderror" name="addmore[`+i+`][jenis]" style="width: 100%;">
                                                                <option disabled selected="selected">Jenis Dokumen...</option>
                                                                <option value="renstra">Renstra</option>  
                                                                <option value="PK">PK</option>  
                                                            </select>

                                                            @error('addmore.0.jenis')
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
                                                            <label>Referensi</label>
                                                            <input type="text" name="addmore[`+i+`][referensi]" placeholder="Enter Referensi" class="form-control" />

                                                            @error('addmore.0.referensi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Tahun</label>
                                                            <input type="text" name="addmore[`+i+`][tahun]" placeholder="Enter Tahun" class="form-control dateYear" />

                                                            @error('addmore.0.tahun')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                            <div class="icheck-success">
                                                                <input type="radio" id="selectAktifRenstra[`+i+`]" name="addmore[`+i+`][status]" value="aktif" checked>
                                                                <label for="selectAktifRenstra[`+i+`]">
                                                                    Aktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-danger d-inline">
                                                                <input type="radio" id="selectNonAktifRenstra[`+i+`]" name="addmore[`+i+`][status]" value="nonaktif">
                                                                <label for="selectNonAktifRenstra[`+i+`]">
                                                                    Tidak Aktif
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
                $("#renstraMultiTable").append(html);
            });



            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            $(document).on('click', '.select2bs4', function(){  
                $(this).select2({
                    theme: 'bootstrap4'
                });
            });

            $(document).on('focus', '.dateYear', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });      

            $(document).on('click', '.remove-tr', function(){  
                    $(this).parents('tr').remove();
            });     
    </script>
@endpush