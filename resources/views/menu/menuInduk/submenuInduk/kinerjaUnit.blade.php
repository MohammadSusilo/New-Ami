    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3 )
    <a href="{{ route('kinerjaUnit.create') }}" class="btn btn-app">
        <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultikinerjaUnitRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalKinerjaUnit">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    @endif
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-pdf"></i> Export-->
    <!--</a>-->

    <p align="right">
        <a href="{{ url('kinerjaUnithistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Dokumen -->
    <div class="modal fade" id="modalKinerjaUnit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Multiple Kinerja Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{ route('kinerjaUnit.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="addkinerjaUnit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="kinerjaUnitMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Renop</label>
                                                            <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror" autofocus name="addmore[0][renop_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Renop...</option>
                                                                @foreach($renop as $renops)
                                                                    <option value="{{$renops->renop_id}}">{{$renops->kode}}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.renop_id')
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
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Nilai Capaian</label>
                                                            <input type="number" class="form-control @error('nilaiCapaian') is-invalid @enderror" name="addmore[0][nilaiCapaian]" value="{{ old('nilaiCapaian') }}" placeholder="Enter Nilai Capaian">
                                    
                                                            @error('addmore.0.nilaiCapaian')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Unit Capaian</label>
                                                            <input type="text" class="form-control @error('unitCapaian') is-invalid @enderror" name="addmore[0][unitCapaian]" value="{{ old('unitCapaian') }}" placeholder="Enter Unit Capaian">

                                                            @error('addmore.0.unitCapaian')
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
                                                            <label>Tahun</label>
                                                            <input type="text" name="addmore[0][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">

                                                            @error('addmore.0.tahun')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectAktifKinerjaUnit0" name="addmore[0][status]" value="aktif" checked>
                                                                    <label for="selectAktifKinerjaUnit0">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectNonAktifKinerjaUnit0" name="addmore[0][status]" value="nonaktif">
                                                                    <label for="selectNonAktifKinerjaUnit0">
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
        <!-- Multi Record Kinerja Unit -->
        <div class="col-12" id="MultikinerjaUnitRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Multiple Kinerja Unit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('kinerjaUnit.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="kinerjaUnitMultiTable">  
                            <tr>
                                <th class="required">Renop</th>
                                <th>Deskripsi</th>
                                <th class="required">Nilai Capaian</th>
                                <th class="required">Unit Capaian</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror" autofocus name="addmore[0][renop_id]" style="width: 100%;">
                                        <option disabled selected="selected">Pilih Renop...</option>
                                        @foreach($renop as $renops)
                                            <option value="{{$renops->id}}">{{$renops->kode}}</option>
                                        @endforeach
                                    </select>

                                    @error('addmore.0.renop_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="addmore[0][deskripsi]" value="{{ old('deskripsi') }}" placeholder="Enter deskripsi"> -->

                                    @error('addmore.0.deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="number" class="form-control @error('nilaiCapaian') is-invalid @enderror" name="addmore[0][nilaiCapaian]" value="{{ old('nilaiCapaian') }}" placeholder="Enter Nilai Capaian">
                                    
                                    @error('addmore.0.nilaiCapaian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="text" class="form-control @error('unitCapaian') is-invalid @enderror" name="addmore[0][unitCapaian]" value="{{ old('unitCapaian') }}" placeholder="Enter Unit Capaian">

                                    @error('addmore.0.unitCapaian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="text" name="addmore[0][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">

                                    @error('addmore.0.tahun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <div class="form-group clearfix @error('status') is-invalid @enderror">
                                        <div class="icheck-primary">
                                            <input type="radio" id="selectkinerjaUnit1" name="addmore[0][status]" value="aktif" checked>
                                            <label for="selectkinerjaUnit1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="selectkinerjaUnit3" name="addmore[0][status]" value="nonaktif">
                                            <label for="selectkinerjaUnit3">
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
                                    <button type="button" name="add" id="addkinerjaUnit" class="btn btn-success"><i class="fas fa-plus"></i></button>
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

        <!-- Table Kinerja Unit -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kinerja Unit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="kinerjaUnitTable" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Renop</th>
                                <th>Deskripsi</th>
                                <th>Unit Capaian</th>
                                <th>Nilai Capaian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($kinerja as $key=>$kinerjas)
                            <tr data-href='{{ route('buktiKinerja.list', $kinerjas->id) }}'>
                            <!-- <tr> -->
                                <td>{{ ++$key }}</td>
                                <td>
                                    @foreach ($renop as $RN)
                                      @if($RN->renop_id == $kinerjas->renop_id)
                                        {{ $RN->kode }}
                                      @endif
                                    @endforeach
                                </td>
                                <td>{{ $kinerjas->deskripsi }}</td>
                                <td>{{ $kinerjas->unitCapaian }}</td>
                                <td>{{ $kinerjas->nilaiCapaian }}</td>
                                <td>
                                    @if($kinerjas->status == "aktif")
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Show -->
                                            <a href="{{ route('kinerjaUnit.show', $kinerjas->id) }}">
                                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div>
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3 )
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('kinerjaUnit.edit', $kinerjas->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('kinerjaUnit.destroy', $kinerjas->id) }}" method="POST" class="is-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                            </form> -->

                                            <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteKinerja{{$kinerjas->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>

                                            <div class="modal fade" id="deleteKinerja{{$kinerjas->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Kinerja Unit</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('kinerjaUnit.destroy', $kinerjas->id) }}" method="POST" class="is-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p style="text-align: center;">Apakah anda yakin hapus data Kinerja Unit : {{ $kinerjas->deskripsi }} !!!</p>
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
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <a href="{{ route('buktiKinerja.list', $kinerjas->id) }}">
                                                <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Bukti"><i class="fas fa-eye"></i> Show List bukti</button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <a href="{{ route('buktiKinerja.new', $kinerjas->id) }}">
                                                <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Bukti</button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- <a href="#" id="MultibuktiKinerjaRecordplus{{$kinerjas->id}}"> -->
                                            <a href="{{ route('buktiKinerja.newMulti', $kinerjas->id) }}">
                                                <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> Multiple Bukti</button>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
                    
    </div>
    <!-- /.row -->

@push('jskinerjaUnit')
    <script>
        // DataTable
        // $('#kinerjaUnitTable').DataTable( {
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
            $("#MultikinerjaUnitRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultikinerjaUnitRecord").toggle("slow", function(){});
            });

       
            // Add Row Kinerja Multi Record
            var i = 0;
            $("#addkinerjaUnit").click(function(){
                ++i;
                let html =`
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Renop</label>
                                                            <select class="form-control select2bs4 @error('renop_id') is-invalid @enderror" autofocus name="addmore[`+i+`][renop_id]" style="width: 100%;">
                                                                <option disabled selected="selected">Pilih Renop...</option>
                                                                @foreach($renop as $renops)
                                                                    <option value="{{$renops->renop_id}}">{{$renops->kode}}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('addmore.0.renop_id')
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
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Nilai Capaian</label>
                                                            <input type="number" class="form-control @error('nilaiCapaian') is-invalid @enderror" name="addmore[`+i+`][nilaiCapaian]" value="{{ old('nilaiCapaian') }}" placeholder="Enter Nilai Capaian">
                                    
                                                            @error('addmore.0.nilaiCapaian')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Unit Capaian</label>
                                                            <input type="text" class="form-control @error('unitCapaian') is-invalid @enderror" name="addmore[`+i+`][unitCapaian]" value="{{ old('unitCapaian') }}" placeholder="Enter Unit Capaian">

                                                            @error('addmore.0.unitCapaian')
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
                                                            <label>Tahun</label>
                                                            <input type="text" name="addmore[`+i+`][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">

                                                            @error('addmore.0.tahun')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectAktifKinerja[`+i+`]" name="addmore[`+i+`][status]" value="aktif" checked>
                                                                    <label for="selectAktifKinerja[`+i+`]">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectNonAktifKinerja[`+i+`]" name="addmore[`+i+`][status]" value="nonaktif">
                                                                    <label for="selectNonAktifKinerja[`+i+`]">
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
                $("#kinerjaUnitMultiTable").append(html);
            });

            // // Add Row Bukti Multi Record
            // var i = 0;
            // $("#addBukti").click(function(){
            //     // var datasend = $('#input[name=datasend]');
            //     var datasend = $("#datasend").val();
            //     console.log(datasend);
            //     ++i;
            //     $("#buktiMultiTable").append(
            //         '<tr>'+
            //             '<td><input type="text" class="form-control @error('namaBukti') is-invalid @enderror" name="addmore['+i+'][namaBukti]" value="{{ old('namaBukti') }}" required autocomplete="kode" autofocus placeholder="Enter kode"></td>'+
            //             '<td><input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="addmore['+i+'][deskripsi]" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus placeholder="Enter deskripsi">'+
            //             '<td><input type="text" name="addmore['+i+'][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror"  required/></td>'+
            //             '<td><div class="custom-file"><input type="file" name="addmore['+i+'][lokDokBukti]" class="custom-file-input" id="customFile"><label class="custom-file-label" for="customFile">Choose file</label></div></td>'+
            //             '<td>'+
            //                 '<select class="custom-select @error('status') is-invalid @enderror" name="addmore['+i+'][status]" id="status">'+
            //                     '<option disabled selected="selected">Pilih Status...</option>'+
            //                     '<option value="terbaik">Terbaik</option>'+
            //                     '<option value="normal">Normal</option>'+
            //                     '<option value="terjelek">Terburuk</option>'+
            //                 '</select>'+
            //             '</td>'+
            //             '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>'+
            //         '</tr>');
                                        
            // });

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
                    $(this).parents('tr').remove();
            });     
    </script>
@endpush