    @if(auth()->user()->role_id == 1)
    <a href="{{ route('hasilTM.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalHasilTM">
        <i class="fas fa-plus"></i> New Multiple
    </button> -->
    <a href="#" id="addImport" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a>
    @endif
    <!-- <a href="#" id="ExportHasilTMplus" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalExportHasilTM">
        <i class="fas fa-file-pdf"></i> Export
    </button>

    <p align="right">
        <a href="{{ url('hasilTinjauanManajemen/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Record Hasil TM -->
    <div class="modal fade" id="importHasilTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple CAR Reports</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('hasilTM.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row align-items-center" id="rolesechasil"></div>  
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
    
    <div class="modal fade" id="modalHasilTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple Hasil TM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('hasilTM.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <!-- <div class="card-header">
                            <div class="row g-2">
                                <div class="col">
                                    <label class="required">Jadwal TM</label>
                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="tm_id" id="tm_idHasilTM" data-placeholder="Select a Users" style="width: 100%;">
                                        <option disabled selected="selected">Pilih Jadwal...</option>        
                                        @foreach ($jadwalTM as $jadwal)
                                            @php $getUKonAudit = DB::table('jadwal_audit')->where('id', $jadwal->audit_id)->first(); @endphp
                                            <option value="{{ $jadwal->id }}">
                                                @foreach($unitKerja as $unitkerjas)
                                                    @if($unitkerjas->id == $getUKonAudit->unitkerja_id)
                                                        {{ $jadwal->tglTM }} ( {{ $unitkerjas->name }} )
                                                    @endif
                                                @endforeach
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="read"></div> -->
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

        <!-- Export Tindak Lanjut TM -->
        <div class="modal fade" id="modalExportHasilTM">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Export Hasil Rapat TM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('hasilTM.selectExportPDF') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="container">
                                <div class="card-header">
                                    <h5 class="modal-title">Silahkan Generate Hasil Rapat TM</h5>
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

    <!-- Export Hasil TM -->
    <div class="row">
        <div class="col-12">
            <div class="card ExportHasilTMshow" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Export Notulen Rapat TM</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('hasilTM.selectExportNotulenPDF')}}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="auditReportsMultiTable">  
                            <tr>
                                <th class="required">Jadwal TM</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="tm_id" id="tm_id" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                        <option disabled selected="selected">Pilih Jadwal TM...</option> 
                                        @foreach ($jadwalTM as $TM)
                                            <option value="{{ $TM->id }}">
                                                {{ $TM->tglTM}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>  
                            </tr>  
                        </table> 
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form><br>
                </div>
            </div>

            <div class="card ExportHasilTMshow" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Export Catatan Status TM</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('hasilTM.selectExportCatatanPDF')}}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="auditReportsMultiTable">  
                            <tr>
                                <th class="required">Jadwal TM</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="tm_id" id="tm_id" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                        <option disabled selected="selected">Pilih Jadwal TM...</option> 
                                        @foreach ($jadwalTM as $TM)
                                            <option value="{{ $TM->id }}">
                                                {{ $TM->tglTM}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>  
                            </tr>  
                        </table> 
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form><br>
                </div>
            </div>

        </div>
    </div>

        <!-- Table Hasil TM -->
        <table id="hasilTMTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jadwal TM</th>
                    <th>Subjek</th>
                    <th>Hasil Pembahasan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($hasilTM as $key=>$hasil)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                      @foreach ($jadwalTM as $JA)
                        @if($JA->id == $hasil->tm_id)
                            {{ date('d F Y', strtotime($JA->tglTM))  }}
                        @endif
                      @endforeach
                    </td>
                    <td>{{ $hasil->subjek }}</td>
                    <td>{{ $hasil->hasilPembahasan }}</td>
                    <td>
                        @if($hasil->status == "aktif")
                            <span class="badge badge-pill badge-info">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('hasilTM.show', $hasil->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('hasilTM.edit', $hasil->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('hasilTM.destroy', $hasil->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form> -->

                                <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteHasilTM{{$hasil->id}}">
                                    <i class="fa fa-times"></i>
                                </button>

                                <div class="modal fade" id="deleteHasilTM{{$hasil->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Hasil TM</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('hasilTM.destroy', $hasil->id) }}" method="POST" class="is-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p style="text-align: center;">Apakah anda yakin hapus data Hasil TM : {{ $hasil->subjek }} !!!</p>
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

@push('jshasilTM')
    <script>
        // DataTable
        // $('#hasilTMTable').DataTable( {
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
        // Hide/Show Hasil TMExport
        $("#ExportHasilTMplus").click(function(){
            // show hide paragraph on button click
            $(".ExportHasilTMshow").toggle("slow", function(){});
        });

        $(document).on("click", "#addImport", function() {
            // Delete User Modal
            $("#importHasilTM").modal("show");
            // user_id = sanitizeHTML($(this).attr("id"));

            // Show Roles

            $.ajax({
                url: "gethasilTM",
                type: "GET",
                dataType: "html"
            }).done(function(response) {
                console.log(response);
                $("#importHasilTM")
                    .find("#rolesechasil")
                    .html(response);
            });
        });

        // Multi Record
            $(document).ready(function(){
                $("#tm_idHasilTM").change(function(){
                    var strcari = $("#tm_idHasilTM").val();
                    // console.log(strcari);
                    if(strcari !=""){
                        $("#read").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                        $.ajax({
                            url : "{{ url('hasilTMget') }}",
                            type : "get",
                            data : "tm_id=" + strcari,
                            success: function(data)
                            {
                                console.log(data);
                                $("#read").html(data);
                            }
                        });
                    }
                });
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