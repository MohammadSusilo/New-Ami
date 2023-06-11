    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
    <a href="{{ route('dokumenPolines.create') }}" class="btn btn-app">
        <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultidokPolinesRecordplus" class="btn btn-app ">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalDokumenPolines">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    @endif

    <!-- Histori -->
    <!-- <p align="right">
        <a href="{{ url('dokPolineshistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p> -->


    <!-- Multi Dokumen -->
    <div class="modal fade" id="modalDokumenPolines">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Multiple Dokumen Polines</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('dokumenPolines.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <button type="button" name="add" id="adddokPolines" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="dokPolinesMultiTable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default" id="cols">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-12">
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
        <!-- MultiRecord Dokumen Polines -->
        <div class="col-12 " id="MultidokPolinesRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Multiple Dokumen Polines</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('dokumenPolines.saveMulti') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="container">
                                <div class="card-header">
                                    <div class="row g-2">
                                        <div class="col">
                                            <button type="button" name="add" id="adddokPolines" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body" id="dokPolinesMultiTable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-default" id="cols">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-12">
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
            </div>
        </div>

        <!-- Table Dokumen Polines -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dokumen Polines</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dokPolinesTable" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <th>Unit Kerja</th>
                                @endif
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokPolines as $key=> $dokPolines)
                            <tr>
                                <td>{{ ++$key }}</td>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <td>
                                    {{ $dokPolines->unitkerja->name }}
                                </td>
                                @endif
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('dokumenPolines.edit', $dokPolines->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteDokPolines{{$dokPolines->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>

                                            <div class="modal fade" id="deleteDokPolines{{$dokPolines->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Dokumen Polines</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('dokumenPolines.destroy', $dokPolines->id) }}" method="POST" class="is-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p style="text-align: center;">Apakah anda yakin hapus data Dokumen Polines : {{ $dokPolines->id }} !!!</p>
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

        <!-- FileManager Dokumen Polines -->
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dokumen Polines</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <iframe src="filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    @push('jsdokPolines')
    <script>
        // DataTable
        // $('#dokPolinesTable').DataTable( {
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
        $("#MultidokPolinesRecordplus").click(function() {
            // show hide paragraph on button click
            $("#MultidokPolinesRecord").toggle("slow", function() {});
        });

        // Add Row Multi Record
        var i = 0;
        $("#adddokPolines").click(function() {
            ++i;
            let html = `
            <div class="col-12">
                                            <div class="card card-default" id="cols">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-12">
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
                `;
            $("#dokPolinesMultiTable").append(html);

        });

        // $(document).on('click', '#selectUK', function(){  
        //     optionText = {!! json_encode($unitKerja->toArray()) !!};
        //     jQuery.each(optionText,function(i, el) {
        //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
        //         // console.log(optionValue);
        //         $('#selectUK').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
        //     });
        // });

        $(document).on('click', '.custom-file', function() {
            bsCustomFileInput.init();
        });

        $(document).on('click', '.select2bs4', function() {
            $(this).select2({
                theme: 'bootstrap4'
            })
        });

        $(document).on('focus', '.dateYear', function() {
            $(this).datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).closest("#cols").remove();
            // $(this).parents('tr').remove();
        });
    </script>
    @endpush