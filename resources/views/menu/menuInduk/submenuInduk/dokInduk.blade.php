    <a href="{{ route('dokumen.induk') }}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultidokIndukRecordplus" class="btn btn-app ">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalDokumenInduk">
        <i class="fas fa-plus"></i> New Multiple
    </button>

    <p align="right">
        <a href="{{ url('dokIndukhistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <div class="row">
        <!-- Multi Dokumen -->
        <div class="modal fade" id="modalDokumenInduk">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Multiple Dokumen Induk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{ route('dokumen.induk.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="adddokInduk" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="dokIndukMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="addmore[0][name]" placeholder="Enter Nama" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus autocomplete='off'>
                                                            @error('addmore.0.name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Nomor</label></br>
                                                            <input type="text" name="addmore[0][nomor]" placeholder="Enter Nomor" class="form-control @error('addmore.0.nomor') is-invalid @enderror" autocomplete='off'>
                                                            @error('addmore.0.nomor')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Revisi</label></br>
                                                            <input type="text" name="addmore[0][revisi]" placeholder="Enter Revisi" class="form-control @error('addmore.0.revisi') is-invalid @enderror" autocomplete='off'>
                                                            @error('addmore.0.revisi')
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
                                                            <label>Tahun Aktif</label>
                                                            <input type="text" name="addmore[0][tahun_aktif]" placeholder="Enter Tahun Aktif" class="form-control dateYear @error('addmore.0.tahun_aktif') is-invalid @enderror" autocomplete='off'>
                                                            @error('addmore.0.tahun_aktif')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Tahun Selesai</label>
                                                            <input type="text" name="addmore[0][tahun_selesai]" placeholder="Enter Tahun Selesai" class="form-control dateYear @error('addmore.0.tahun_selesai') is-invalid @enderror" autocomplete='off'>
                                                            @error('addmore.0.tahun_selesai')
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
                                                            <label>Status</label>
                                                            <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                                <div class="icheck-success">
                                                                    <input type="radio" id="selectAktifInduk0" name="addmore[0][status]" value="aktif" checked>
                                                                    <label for="selectAktifInduk0">
                                                                        Aktif
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="radio" id="selectNonAktifInduk0" name="addmore[0][status]" value="nonaktif">
                                                                    <label for="selectNonAktifInduk0">
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
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Sifat Dokumen</label>
                                                            <div class="form-group clearfix @error('addmore.0.sifatDokumen') is-invalid @enderror">
                                                                <div class="icheck-warning">
                                                                    <input type="radio" id="selectPrivateInduk0" name="addmore[0][sifatDokumen]" value="private" checked>
                                                                    <label for="selectPrivateInduk0">
                                                                        Private
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="radio" id="selectPublicInduk0" name="addmore[0][sifatDokumen]" value="public">
                                                                    <label for="selectPublicInduk0">
                                                                        Public
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            @error('addmore.0.sifatDokumen')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>File</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="addmore[0][lokasi]" class="custom-file-input @error('addmore.0.lokasi') is-invalid @enderror" id="customFile">
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
        
        <!-- MultiRecord Dokumen Induk -->
        <div class="col-12 " id="MultidokIndukRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple Dokumen Induk</h3>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('dokumen.induk.saveMulti') }}" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-bordered table-striped" id="dokIndukMultiTable">  
                                <tr>
                                    <th class="required">Nama</th>
                                    <th class="required">Nomor</th>
                                    <th class="required">Revisi</th>
                                    <th class="required">Tahun Aktif</th>
                                    <th>Tahun Selesai</th>
                                    <th>Status</th>
                                    <th>Sifat Dokumen</th>
                                    <th class="requiredfile">File</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="addmore[0][name]" placeholder="Enter Nama" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus autocomplete='off'>
                                        @error('addmore.0.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <input type="text" name="addmore[0][nomor]" placeholder="Enter Nomor" class="form-control @error('addmore.0.nomor') is-invalid @enderror" autocomplete='off'>
                                        @error('addmore.0.nomor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <input type="text" name="addmore[0][revisi]" placeholder="Enter Revisi" class="form-control @error('addmore.0.revisi') is-invalid @enderror" autocomplete='off'>
                                        @error('addmore.0.revisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <input type="text" name="addmore[0][tahun_aktif]" placeholder="Enter Tahun Aktif" class="form-control dateYear @error('addmore.0.tahun_aktif') is-invalid @enderror" autocomplete='off'>
                                        @error('addmore.0.tahun_aktif')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <input type="text" name="addmore[0][tahun_selesai]" placeholder="Enter Tahun Selesai" class="form-control dateYear @error('addmore.0.tahun_selesai') is-invalid @enderror" autocomplete='off'>
                                        @error('addmore.0.tahun_selesai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                            <div class="icheck-success">
                                                <input type="radio" id="selectinduk1" name="addmore[0][status]" value="aktif" checked>
                                                <label for="selectinduk1">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" id="selectinduk2" name="addmore[0][status]" value="nonaktif">
                                                <label for="selectinduk2">
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
                                        <div class="form-group clearfix @error('addmore.0.sifatDokumen') is-invalid @enderror">
                                            <div class="icheck-warning">
                                                <input type="radio" id="selectinduks1" name="addmore[0][sifatDokumen]" value="private" checked>
                                                <label for="selectinduks1">
                                                    Private
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="selectinduks2" name="addmore[0][sifatDokumen]" value="public">
                                                <label for="selectinduks2">
                                                    Public
                                                </label>
                                            </div>
                                        </div>

                                        @error('addmore.0.sifatDokumen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" name="addmore[0][lokasi]" class="custom-file-input @error('addmore.0.lokasi') is-invalid @enderror" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>

                                        @error('addmore.0.lokasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>  
                                    <td>
                                        <button type="button" name="add" id="adddokInduk" class="btn btn-success"><i class="fas fa-plus"></i></button>
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

        <!-- Table Dokumen Induk -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Dokumen Induk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dokIndukTable" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi Berkas</th>
                                <th>Sifat Dokumen</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokInduk as $key=> $dokInd)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $dokInd->name }}</td>
                                <td>
                                    <a href="{{ asset($dokInd->lokasi) }}" target="_blank" target="pdf-frame">{{ $dokInd->lokasi }}</a>
                                </td>
                                <td>
                                    @if($dokInd->sifatDokumen == "private")
                                        <span class="badge badge-pill badge-warning">Private</span>
                                    @else
                                        <span class="badge badge-pill badge-primary">Public</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dokInd->status == "aktif")
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('dokumen.induk.edit', $dokInd->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('dokumen.induk.destroy', $dokInd->id) }}" method="POST" class="is-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                            </form> -->
                                            <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteDokInduk{{$dokInd->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>

                                            <div class="modal fade" id="deleteDokInduk{{$dokInd->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Dokumen Induk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('dokumen.induk.destroy', $dokInd->id) }}" method="POST" class="is-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p style="text-align: center;">Apakah anda yakin hapus data Dokumen Induk : {{ $dokInd->name }} !!!</p>
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
                </div>
            </div>
        </div>

        <!-- FileManager Dokumen Induk -->
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dokumen Induk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <iframe src="filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

@push('jsdokInduk')
    <script>
        // DataTable
        // $('#dokIndukTable').DataTable( {
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
            $("#MultidokIndukRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultidokIndukRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#adddokInduk").click(function(){
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
                                                <input type="text" name="addmore[`+i+`][name]" placeholder="Enter Nama" class="form-control @error('addmore.0.name') is-invalid @enderror" autofocus autocomplete='off'>
                                                @error('addmore.0.name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Nomor</label></br>
                                                <input type="text" name="addmore[`+i+`][nomor]" placeholder="Enter Nomor" class="form-control @error('addmore.0.nomor') is-invalid @enderror" autocomplete='off'>
                                                @error('addmore.0.nomor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Revisi</label></br>
                                                <input type="text" name="addmore[`+i+`][revisi]" placeholder="Enter Revisi" class="form-control @error('addmore.0.revisi') is-invalid @enderror" autocomplete='off'>
                                                @error('addmore.0.revisi')
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
                                                <label>Tahun Aktif</label>
                                                <input type="text" name="addmore[`+i+`][tahun_aktif]" placeholder="Enter Tahun Aktif" class="form-control dateYear @error('addmore.0.tahun_aktif') is-invalid @enderror" autocomplete='off'>
                                                @error('addmore.0.tahun_aktif')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Tahun Selesai</label>
                                                <input type="text" name="addmore[`+i+`][tahun_selesai]" placeholder="Enter Tahun Selesai" class="form-control dateYear @error('addmore.0.tahun_selesai') is-invalid @enderror" autocomplete='off'>
                                                @error('addmore.0.tahun_selesai')
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
                                                <label>Status</label>
                                                <div class="form-group clearfix @error('addmore.0.status') is-invalid @enderror">
                                                    <div class="icheck-success">
                                                        <input type="radio" id="selectAktifInduk[`+i+`]" name="addmore[`+i+`][status]" value="aktif" checked>
                                                        <label for="selectAktifInduk[`+i+`]">
                                                            Aktif
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" id="selectNonAktifInduk[`+i+`]" name="addmore[`+i+`][status]" value="nonaktif">
                                                        <label for="selectNonAktifInduk[`+i+`]">
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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Sifat Dokumen</label>
                                                <div class="form-group clearfix @error('addmore.0.sifatDokumen') is-invalid @enderror">
                                                    <div class="icheck-warning">
                                                        <input type="radio" id="selectPrivateInduk[`+i+`]" name="addmore[`+i+`][sifatDokumen]" value="private" checked>
                                                        <label for="selectPrivateInduk[`+i+`]">
                                                            Private
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="selectPublicInduk[`+i+`]" name="addmore[`+i+`][sifatDokumen]" value="public">
                                                        <label for="selectPublicInduk[`+i+`]">
                                                            Public
                                                        </label>
                                                    </div>
                                                </div>

                                                @error('addmore.0.sifatDokumen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>File</label>
                                                <div class="custom-file">
                                                    <input type="file" name="addmore[`+i+`][lokasi]" class="custom-file-input @error('addmore.0.lokasi') is-invalid @enderror" id="customFile">
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
                $("#dokIndukMultiTable").append(html);
            });

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