    @if(auth()->user()->role_id == 1)
    <a href="{{ route('tindakLanjutTM.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultitindakLanjutTMRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalTindakTM">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    @endif
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    <!-- <a href="#" id="ExportTindakTMplus" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalExportTindakTM">
        <i class="fas fa-file-pdf"></i> Export
    </button>

    <p align="right">
        <a href="{{ url('tindakLanjutTinjauanManajemen/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Record Tindak Lanjut TM -->
    <div class="modal fade" id="modalTindakTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple Tindak Lanjut TM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('tindakLanjutTM.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <div class="form-group">
                                <button type="button" name="add" id="addtindakLanjutTM" class="btn btn-success"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="card-body" id="tindakLanjutTMMultiTable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-default" id="cols">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Hasil TM</label>
                                                        <select class="form-control select2bs4 @error('hslrpt_id') is-invalid @enderror" name="addmore[0][hslrpt_id]" data-placeholder="Pilih Hasil..." style="width: 100%;">
                                                            <option disabled selected="selected">Pilih Hasil...</option>
                                                            <?php foreach($hasilTM as $hasil){ ?>
                                                                @foreach($unitKerja as $UK)
                                                                    @if($UK->id == $hasil->unitkerja_id)
                                                                        <option value="<?php echo $hasil->id; ?>">{{ $UK->name }} | {{ $hasil->subjek }} | {{ $hasil->hasilPembahasan }}</option>
                                                                    @endif
                                                                @endforeach
                                                            <?php } ?>
                                                        </select>

                                                        @error('addmore[0][hslrpt_id]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Tindak Lanjut</label></br>
                                                        <textarea class="form-control @error('tindakLanjut') is-invalid @enderror" rows="3" name="addmore[0][tindakLanjut]" placeholder="Enter Tindak Lanjut">{{ old('tindakLanjut') }}</textarea>
                                                        
                                                        @error('addmore[0][tindakLanjut]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label>PIC</label>
                                                        <select class="form-control select2bs4 @error('PIC') is-invalid @enderror" name="addmore[0][PIC][]" multiple="multiple" data-placeholder="Pilih PIC..." style="width: 100%;">
                                                            <?php foreach($users as $user){ ?>
                                                                <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                        @error('addmore[0][PIC]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <div class="form-group @error('status') is-invalid @enderror">
                                                            <div class="icheck-success">
                                                                <input type="radio" id="terbaik[0]" name="addmore[0][status]" value="selesai">
                                                                <label for="terbaik[0]">Selesai</label>
                                                            </div>
                                                            <div class="icheck-danger">
                                                                <input type="radio" id="normal[0]" name="addmore[0][status]" value="nonselesai" checked>
                                                                <label for="normal[0]">Belum Selesai</label>
                                                            </div>
                                                                    
                                                            @error('addmore[0][status]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label>Action</label></br>
                                                        <button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- <table class="table table-bordered table-striped" id="tindakLanjutTMMultiTable">  
                            <tr>
                                <th class="required">Hasil TM</th>
                                <th class="required">Tindak Lanjut</th>
                                <th class="required">PIC</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('hslrpt_id') is-invalid @enderror" name="addmore[0][hslrpt_id]" id="hslrpt_id" data-placeholder="Select a Users" style="width: 100%;">
                                        <option disabled selected="selected">Pilih Hasil...</option>         
                                        @foreach ($hasilTM as $hasil)
                                            <option value="{{ $hasil->id }}">
                                                {{ $hasil->subjek}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('addmore.0.hslrpt_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <textarea class="form-control @error('tindakLanjut') is-invalid @enderror" rows="3" name="addmore[0][tindakLanjut]" placeholder="Enter Tindak Lanjut">{{ old('tindakLanjut') }}</textarea>

                                    @error('addmore.0.tindakLanjut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control select2bs4 @error('PIC') is-invalid @enderror" name="addmore[0][PIC][]" id="PIC" multiple="multiple" data-placeholder="Pilih PIC..." style="width: 100%;">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name}}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('addmore.0.PIC')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="form-group clearfix @error('status') is-invalid @enderror">
                                        <div class="icheck-primary">
                                            <input type="radio" id="selecttindakTM1" name="addmore[0][status]" value="aktif" checked>
                                            <label for="selecttindakTM1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="selecttindakTM2" name="addmore[0][status]" value="nonaktif">
                                            <label for="selecttindakTM2">
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
                                    <button type="button" name="add" id="addtindakLanjutTM" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </td>  
                            </tr>  
                        </table>  -->
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

    <!-- Export Tindak Lanjut TM -->
    <div class="modal fade" id="modalExportTindakTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Tindak Lanjut TM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('tindakLanjutTM.selectExportPenyelesaianPDF') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <h5 class="modal-title">Silahkan Generate Tindak Lanjut TM</h5>
                        </div>

                        <div class="card-body">
                            <center>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-success">Generate</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->

          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export Notulen Rapat TM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('hasilTM.selectExportNotulenPDF') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <h5 class="modal-title">Silahkan Generate Notulen Rapat TM</h5>
                        </div>

                        <div class="card-body">
                            <center>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-success">Generate</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Catatan Status TM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('hasilTM.selectExportCatatanPDF') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <h5 class="modal-title">Silahkan Generate Catatan Status TM</h5>
                        </div>

                        <div class="card-body">
                            <center>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-success">Generate</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

        <!-- Table Tindak Lanjut TM -->
        <table id="tindakLanjutTMTable" class="table table-bordered table-stripe display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hasil TM</th>
                    <th>Tindak Lanjut</th>
                    <th>PIC</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($tindakTM as $key=>$tindak)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                      @foreach ($hasilTM as $HA)
                        @if($HA->id == $tindak->hslrpt_id)
                          {{ $HA->subjek }}
                        @endif
                      @endforeach
                    </td>
                    <td>{{ $tindak->tindakLanjut }}</td>
                    <td>
                        @foreach($users as $user)
                            @foreach(explode(',', $tindak->PIC) as $info) 
                                @if($user->id == $info )    
                                    <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        @if($tindak->status == "selesai")
                            <span class="badge badge-pill badge-success">Selesai</span>
                        @else
                            <span class="badge badge-pill badge-danger">Belum Selesai</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('tindakLanjutTM.show', $tindak->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('tindakLanjutTM.edit', $tindak->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            @endif
                            @if(auth()->user()->role_id == 1)
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('tindakLanjutTM.destroy', $tindak->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form> -->
                                <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteTindakTM{{$tindak->id}}">
                                    <i class="fa fa-times"></i>
                                </button>

                                <div class="modal fade" id="deleteTindakTM{{$tindak->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Tindak Lanjut TM</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('tindakLanjutTM.destroy', $tindak->id) }}" method="POST" class="is-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p style="text-align: center;">Apakah anda yakin hapus data Tindak Lanjut TM : {{ $tindak->tindakLanjut }} !!!</p>
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
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

@push('jstindakTM')
    <script>
        // DataTable
        // $('#tindakLanjutTMTable').DataTable( {
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
            $("#MultitindakLanjutTMRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultitindakLanjutTMRecord").toggle("slow", function(){});
            });
        
            $(document).ready(function() {
                $('.select2bs4').select2();
            });
            
            // Add Row Multi Record
            var i = 0;
            $("#addtindakLanjutTM").click(function(){
                ++i;
                $(document).ready(function() {
                    $('.select2bs4multi').select2();
                });
                let htmlTindakTM = `
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default" id="cols">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Hasil TM</label>
                                                <select class="form-control select2bs4 @error('hslrpt_id') is-invalid @enderror" name="addmore[`+i+`][hslrpt_id]" data-placeholder="Pilih Hasil..." style="width: 100%;">
                                                    <option disabled selected="selected">Pilih Hasil...</option>
                                                    <?php foreach($hasilTM as $hasil){ ?>
                                                        <?php foreach($unitKerja as $UK){ ?>
                                                            <?php if($UK->id == $hasil->unitkerja_id){ ?>
                                                                <option value="<?php echo $hasil->id; ?>"><?php echo $UK->name; ?> | <?php echo $hasil->subjek; ?> | <?php echo $hasil->hasilPembahasan; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>

                                                @error('addmore[`+i+`][hslrpt_id]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Tindak Lanjut</label></br>
                                                <textarea class="form-control @error('tindakLanjut') is-invalid @enderror" rows="3" name="addmore[`+i+`][tindakLanjut]" placeholder="Enter Tindak Lanjut">{{ old('tindakLanjut') }}</textarea>
                                                
                                                @error('addmore[`+i+`][tindakLanjut]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label>PIC</label>
                                                <select class="form-control select2bs4multi @error('PIC') is-invalid @enderror" name="addmore[`+i+`][PIC][]" id="selectPIC[`+i+`]" multiple="multiple" data-placeholder="Pilih PIC..." style="width: 100%;">
                                                    <?php foreach($users as $user){ ?>
                                                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                    <?php } ?>
                                                </select>

                                                @error('addmore[`+i+`][PIC]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="form-group @error('status') is-invalid @enderror">
                                                    <div class="icheck-success">
                                                        <input type="radio" id="terbaik[`+i+`]" name="addmore[`+i+`][status]" value="selesai">
                                                        <label for="terbaik[`+i+`]">Selesai</label>
                                                    </div>
                                                    <div class="icheck-danger">
                                                        <input type="radio" id="normal[`+i+`]" name="addmore[`+i+`][status]" value="nonselesai" checked>
                                                        <label for="normal[`+i+`]">Belum Selesai</label>
                                                    </div>
                                                            
                                                    @error('addmore[`+i+`][status]')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Action</label></br>
                                                <button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $("#tindakLanjutTMMultiTable").append(htmlTindakTM); 

                $(document).on('click', '#selectPIC['+i+']', function(){  
                    $(this).select2({
                        theme: 'bootstrap4'
                    })
                });                                  
                                   
            });

            $(document).ready(function() {
                $('.select2bs4').select2();
            });

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
            
            $(document).on('focus', '.timepicker', function(){  
                $(this).clockpicker()
                    .find('input').change(function(){
                        console.log(this.value);
                    });
                    var input = $('#single-input').clockpicker({
                        placement: 'bottom',
                        align: 'left',
                        autoclose: true,
                        'default': 'now'
                    });
            });     

            $(document).on('click', '.remove-tr', function(){
                $(this).closest("#cols").remove();  
                    // $(this).parents('tr').remove();
            });     
    </script>
@endpush