    @if(auth()->user()->role_id == 1)
    <a href="{{ route('renop.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultirenopRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalRenop">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    @endif
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-pdf"></i> Export-->
    <!--</a>-->
    <a href="#" onclick="location.reload();" class="button btn btn-app">
      <i class="fas fa-sync"></i> Refresh
    </a>

    <p align="right">
        <a href="{{ url('Renophistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Dokumen -->
    <div class="modal fade" id="modalRenop">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Multiple Renop</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{ route('renop.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="addRenop" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="renopMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
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
                                                    <div class="col-4">
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
                                                    @if(auth()->user()->role_id != 3)
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Kerja</label></br>
                                                            <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="addmore[0][unitkerja_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                                @foreach($unitKerja as $UK)
                                                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.unitkerja_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
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
                                                    <div class="col-6">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Dokumen Acuan</label>
                                                            <select class="form-control selectAcuan @error('renstra') is-invalid @enderror" name="addmore[0][renstra][]" id="select2bs4multi" multiple="multiple" data-placeholder="Pilih Dokumen Acuan..." style="width: 100%;">
                                                                @foreach ($dokAcuans as $dokAcuan)
                                                                <option value="{{ $dokAcuan->id }}">
                                                                    {{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.renstra')
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
                                                            <div class="form-group clearfix @error('status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectAktifRenop0" name="addmore[0][status]" value="aktif" checked>
                                                                    <label for="selectAktifRenop0">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectNonAktifRenop0" name="addmore[0][status]" value="nonaktif">
                                                                    <label for="selectNonAktifRenop0">
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

    <div class="row">
        <!-- Multi Record Renop -->
        <div class="col-12" id="MultirenopRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Multiple Renop</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('renop.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="renopMultiTable">  
                            <tr>
                                <th class="required">Kode</th>
                                <th>Deskripsi</th>
                                <th class="required">Target</th>
                                <th class="required">Unit Target</th>
                                <th>Tahun</th>
                                @if(auth()->user()->role_id != 3)
                                <th class="required">Unit Kerja</th>
                                @endif
                                <th class="required">Dokumen Acuan</th>
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
                                    <input type="text" name="addmore[0][unit_target]" placeholder="Enter Unit Target" class="form-control" />

                                    @error('addmore.0.unit_target')
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
                                @if(auth()->user()->role_id != 3)
                                <td>
                                    <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="addmore[0][unitkerja_id]" style="width: 100%;">
                                      <option disabled selected="selected">Pilih Unit Kerja...</option>
                                      @foreach($unitKerja as $UK)
                                        <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                      @endforeach
                                    </select>

                                    @error('addmore.0.unitkerja_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                @endif
                                <td>
                                    <select class="form-control select2bs4 @error('renstra') is-invalid @enderror" name="addmore[0][renstra][]" id="renstra" multiple="multiple" data-placeholder="Pilih Dokumen Acuan..." style="width: 100%;">
                                        @foreach ($dokAcuans as $dokAcuan)
                                        <option value="{{ $dokAcuan->id }}">
                                            {{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('addmore.0.renstra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <div class="form-group clearfix @error('status') is-invalid @enderror">
                                        <div class="icheck-primary">
                                            <input type="radio" id="selectrenop1" name="addmore[0][status]" value="aktif" checked>
                                            <label for="selectrenop1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="selectrenop2" name="addmore[0][status]" value="nonaktif">
                                            <label for="selectrenop2">
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
                                    <button type="button" name="add" id="addRenop" class="btn btn-success"><i class="fas fa-plus"></i></button>
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

        <!-- Select Renstra -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dokumen Acuan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('renop.store') }}" class="subscribe" id="form1">
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dokumen Acuan</label>
                            <select class="form-control select2bs4 @error('renstra') is-invalid @enderror" id="inputRenstraSelect" name="renstra" style="width: 100%;">
                                <option disabled selected="selected">Pilih Dokumen Acuan...</option>
                                @foreach($dokAcuans as $dokAcuan)
                                    <option value="{{$dokAcuan->id}}">
                                      {{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})
                                    </option>  
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- Table Renop -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Renop</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="renopTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Unit Target</th>
                                <th>Target</th>
                                <th>Tahun</th>
                                <th>Jenis Dokumen</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="read">
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
                    
    </div>
    <!-- /.row -->

@push('jsrenop')
    <script>
        // DataTable
        $('#renopTable').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Multi Record
            // Hide/Show Multi Record
            $("#MultirenopRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultirenopRecord").toggle("slow", function(){});
            });

            $(document).ready(function() {
                $('.selectAcuan').select2();
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addRenop").click(function(){
                ++i;
                $(document).ready(function() {
                    $('.select2bs4multi').select2();
                });
                let html = `
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
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
                                                    <div class="col-4">
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
                                                    @if(auth()->user()->role_id != 3)
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Kerja</label></br>
                                                            <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="addmore[`+i+`][unitkerja_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                                @foreach($unitKerja as $UK)
                                                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.unitkerja_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
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
                                                    <div class="col-6">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Dokumen Acuan</label>
                                                            <select class="form-control select2bs4multi @error('renstra') is-invalid @enderror" name="addmore[`+i+`][renstra][]" id="selectAcuan[`+i+`]" multiple="multiple" data-placeholder="Pilih Dokumen Acuan..." style="width: 100%;">
                                                                @foreach ($dokAcuans as $dokAcuan)
                                                                <option value="{{ $dokAcuan->id }}">
                                                                    {{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.renstra')
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
                                                            <div class="form-group clearfix @error('status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectAktifRenop[`+i+`]" name="addmore[`+i+`][status]" value="aktif" checked>
                                                                    <label for="selectAktifRenop[`+i+`]">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectNonAktifRenop[`+i+`]" name="addmore[`+i+`][status]" value="nonaktif">
                                                                    <label for="selectNonAktifRenop[`+i+`]">
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
                $("#renopMultiTable").append(html);
                $(document).on('click', '#selectAcuan['+i+']', function(){  
                    $(this).select2({
                        theme: 'bootstrap4'
                    })
                });  
            });

            // $(document).on('click', '#selectUK', function(){  
            //     optionText = {!! json_encode($unitKerja->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectUK').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });
            // $(document).on('click', '#selectRenstra', function(){  
            //     optionText = {!! json_encode($renstra->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectRenstra').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });




            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            // $(document).on('click', '.select2bs4', function(){  
            //     $(this).select2({
            //         theme: 'bootstrap4'
            //     })
            // });

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

    <!-- Get Renop -->
    <script type="text/javascript">
      $(document).ready(function(){
        readData();
        $("#inputRenstraSelect").change(function(){
            var strcari = $("#inputRenstraSelect").val();
            // console.log(strcari);
            if(strcari !=""){
              $("#read").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
              $.ajax({
                url : "{{ url('renopget') }}",
                type : "get",
                data : "name=" + strcari,
                success: function(data)
                {
                    console.log(data);
                    $("#read").html(data);
                    //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                    //jQuery($('#subject_id')).empty();
                    //jQuery.each(data, function(key,value){
                    //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                    //});
                }
              });
            }else{
                  readData();
            }
        });

      });

      function readData(){
        $.get("{{ url('renopread') }}", {}, function(data,status){
          $("#read").html(data);
        });
      }
    </script>
@endpush