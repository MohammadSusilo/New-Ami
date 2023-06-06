    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
    <a href="{{ route('dokumen.checklist') }}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultidokChecklistRecordplus" class="btn btn-app ">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalDokumenChecklist">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    @endif

    <p align="right">
        <a href="{{ url('dokChecklisthistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

   
    <!-- Multi Dokumen -->
    <div class="modal fade" id="modalDokumenChecklist">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Multiple Dokumen Checklist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{ route('dokumen.checklist.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="adddokChecklist" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="dokChecklistMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="addmore[0][name]" placeholder="Enter Name" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus/>
                                                            @error('addmore.0.name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Tahun</label></br>
                                                            <input type="text" name="addmore[0][tahun]" placeholder="Enter Tahun" class="form-control dateYear @error('addmore.0.tahun') is-invalid @enderror" />
                                                            @error('addmore.0.tahun')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Kerja</label></br>
                                                            <select class="form-control select2bs4 @error('addmore.0.unitkerja_id') is-invalid @enderror" id="input" name="addmore[0][unitkerja_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                                @foreach($unitKerja as $unitKer)
                                                                    <option {{ ($unitKer->id) == old('unitkerja_id') ? 'selected' : '' }} value="{{$unitKer->id}}">{{$unitKer->name}}</option>  
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectcheck1" name="addmore[0][status]" value="aktif" checked>
                                                                    <label for="selectcheck1">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectcheck2" name="addmore[0][status]" value="nonaktif">
                                                                    <label for="selectcheck2">
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
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>File</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="addmore[0][lokasi]" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>

                                                            @error('addmore.0.lokasi')
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

    <div class="row">
        <!-- MultiRecord Dokumen Checklist -->
        <div class="col-12 " id="MultidokChecklistRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple Dokumen Checklist</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('dokumen.checklist.saveMulti') }}" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-bordered table-striped" id="dokChecklistMultiTable">  
                                <tr>
                                    <th class="required">Nama</th>
                                    <th>Tahun</th>
                                    <th class="required">Unit Kerja</th>
                                    <th>Status</th>
                                    <th class="requiredfile">File</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="addmore[0][name]" placeholder="Enter Name" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus/>
                                        @error('addmore.0.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <input type="text" name="addmore[0][tahun]" placeholder="Enter Tahun" class="form-control dateYear @error('addmore.0.tahun') is-invalid @enderror" />
                                        @error('addmore.0.tahun')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <select class="form-control select2bs4 @error('addmore.0.unitkerja_id') is-invalid @enderror" id="input" name="addmore[0][unitkerja_id]" style="width: 100%;">
                                            <option disabled selected="selected">Pilih Unit Kerja...</option>
                                            @foreach($unitKerja as $unitKer)
                                                <option {{ ($unitKer->id) == old('unitkerja_id') ? 'selected' : '' }} value="{{$unitKer->id}}">{{$unitKer->name}}</option>  
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                            <div class="icheck-primary">
                                                <input type="radio" id="selectAktifCheck0" name="addmore[0][status]" value="aktif" checked>
                                                <label for="selectAktifCheck0">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" id="selectNonAktifCheck0" name="addmore[0][status]" value="nonaktif">
                                                <label for="selectNonAktifCheck0">
                                                    Tidak Aktif
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
                                        <div class="custom-file">
                                            <input type="file" name="addmore[0][lokasi]" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>

                                        @error('addmore.0.lokasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <button type="button" name="add" id="adddokChecklist" class="btn btn-success"><i class="fas fa-plus"></i></button>
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

        <!-- Table Dokumen Checklist -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Dokumen Checklist</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dokChecklistTable" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi Berkas</th>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <th>Unit Kerja</th>
                                @endif
                                <th>Status</th>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokCheck as $key=> $dokChk)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $dokChk->name }}</td>
                                <td>
                                    <a href="{{ asset($dokChk->lokasi) }}" target="_blank" target="pdf-frame">{{ $dokChk->lokasi }}</a>
                                </td>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <td>
                                        @foreach($unitKerja as $key => $value)
                                            @if($value->id == $dokChk->unitkerja_id)
                                                {{ $value->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td>
                                    @if($dokChk->status == "aktif")
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('dokumen.checklist.edit', $dokChk->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('dokumen.checklist.destroy', $dokChk->id) }}" method="POST" class="is-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                            </form> -->
                                            <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteDokCheck{{$dokChk->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>

                                            <div class="modal fade" id="deleteDokCheck{{$dokChk->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Dokumen Checklist</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('dokumen.checklist.destroy', $dokChk->id) }}" method="POST" class="is-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p style="text-align: center;">Apakah anda yakin hapus data Dokumen Checklist : {{ $dokChk->name }} !!!</p>
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
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- FileManager Dokumen Checklist -->
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dokumen Checklist</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <iframe src="filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

@push('jsdokChecklist')
    <script>
        // DataTable
        // $('#dokChecklistTable').DataTable( {
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
            $("#MultidokChecklistRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultidokChecklistRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#adddokChecklist").click(function(){
                ++i;
                let html = `
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default" id="cols">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="addmore[`+i+`][name]" placeholder="Enter Name" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus/>
                                                @error('addmore.0.name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Tahun</label></br>
                                                <input type="text" name="addmore[`+i+`][tahun]" placeholder="Enter Tahun" class="form-control dateYear @error('addmore.0.tahun') is-invalid @enderror" />
                                                @error('addmore.0.tahun')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Unit Kerja</label></br>
                                                <select class="form-control select2bs4 @error('addmore.0.unitkerja_id') is-invalid @enderror" id="input" name="addmore[`+i+`][unitkerja_id]" style="width: 100%;">
                                                    <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                    @foreach($unitKerja as $unitKer)
                                                        <option {{ ($unitKer->id) == old('unitkerja_id') ? 'selected' : '' }} value="{{$unitKer->id}}">{{$unitKer->name}}</option>  
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                    <div class="icheck-success">
                                                        <input type="radio" id="selectAktifCheck[`+i+`]" name="addmore[`+i+`][status]" value="aktif" checked>
                                                        <label for="selectAktifCheck[`+i+`]">
                                                            Aktif
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" id="selectNonAktifCheck[`+i+`]" name="addmore[`+i+`][status]" value="nonaktif">
                                                        <label for="selectNonAktifCheck[`+i+`]">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>File</label>
                                                <div class="custom-file">
                                                    <input type="file" name="addmore[`+i+`][lokasi]" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>

                                                @error('addmore.0.lokasi')
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
                $("#dokChecklistMultiTable").append(html);
                                        
            });

            // $(document).on('click', '#selectUK', function(){  
            //     optionText = {!! json_encode($unitKerja->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectUK').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });

            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            $(document).on('click', '.select2bs4', function(){  
                $(this).select2({
                    theme: 'bootstrap4'
                })
            });

            $(document).on('focus', '.dateYear', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });      

            $(document).on('click', '.remove-tr', function(){  
                $(this).closest("#cols").remove();
                    // $(this).parents('tr').remove();
            });     
    </script>
@endpush