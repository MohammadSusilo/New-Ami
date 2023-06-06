    <!-- <a href="{{ route('renstra.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a> -->
    <!-- <a href="#" id="MultijadwalTMRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-pdf"></i> Export-->
    <!--</a>-->
    @if(auth()->user()->role_id == 1)
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalJadwalTM">
        <i class="fas fa-plus"></i> New Multiple
    </button>
    @endif
    <a href="{{ route('jadwalTM.selectExportPDF')}}" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a>

    <p align="right">
        <a href="{{ url('jadwalTinjauanManajemen/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Record Jadwal TM -->
    <div class="modal fade" id="modalJadwalTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple Jadwal Audit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('jadwalTM.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <div class="row g-2">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="exampleInputEmail1" class="required">Tanggal TM</label>
                                                <input type="text" name="date" class="form-control dateAll @error('date') is-invalid @enderror" placeholder="Enter Tanggal TM" autocomplete="off">
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="exampleInputEmail1" class="required">Waktu TM</label>
                                                <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                                    <input type="text" name="time" class="form-control @error('time') is-invalid @enderror" placeholder="Enter Waktu TM" autocomplete="off">
                                                </div>
                                                @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" name="add" id="addJadwalTM" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card-header">
                            <div class="form-group">
                                <button type="button" name="add" id="addJadwalTM" class="btn btn-success"><i class="fas fa-plus"></i></button>
                            </div>
                        </div> -->

                        <div class="card-body" id="tableJadwalTM"></div>
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


        <!-- Table Jadwal TM -->
        <table id="jadwalTMTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Periode (Tahun)</th>
                    <th>Unit Kerja</th>
                    <th>Jadwal Audit</th>
                    <th>Tanggal TM</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    @if(auth()->user()->role_id == 1)
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($jadwalTM as $key=>$jadwal)
                <tr>
                    <td>{{ ++$key }}</td>
                    @foreach($jadwalAudit as $audit)
                        @if($audit->id == $jadwal->audit_id)
                            <td>
                                {{ $audit->periode }} ({{ $audit->tahun }})
                            </td>
                            <td>
                                @foreach ($unitKerja as $unitKerjas)
                                    @if($unitKerjas->id == $audit->unitkerja_id)
                                        {{ $unitKerjas->name }}
                                    @endif
                                @endforeach
                            </td>
                        @endif
                    @endforeach
                    <td>
                        @foreach ($jadwalAudit as $getjadwal)
                            @if($getjadwal->id == $jadwal->audit_id)
                                @php $tgl = explode("#", $getjadwal->tglAudit); @endphp
                                {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ date('d F Y', strtotime($jadwal->tglTM))  }}</td>
                    <td>{{ $jadwal->tahun }}</td>
                    <td>
                        @if($jadwal->status == "aktif")
                            <span class="badge badge-pill badge-success">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    @if(auth()->user()->role_id == 1)
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('jadwalTM.show', $jadwal->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('jadwalTM.edit', $jadwal->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('jadwalTM.destroy', $jadwal->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form> -->

                                <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteJadwalTM{{$jadwal->id}}">
                                    <i class="fa fa-times"></i>
                                </button>

                                <div class="modal fade" id="deleteJadwalTM{{$jadwal->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Jadwal TM</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('jadwalTM.destroy', $jadwal->id) }}" method="POST" class="is-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p style="text-align: center;">Apakah anda yakin hapus data Jadwal TM : {{ date('d F Y', strtotime($jadwal->tglTM))  }} | 
                                                        @foreach($jadwalAudit as $audit)
                                                            @if($audit->id == $jadwal->audit_id)
                                                                @foreach ($unitKerja as $unitKerjas)
                                                                    @if($unitKerjas->id == $audit->unitkerja_id)
                                                                        {{ $unitKerjas->name }}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach !!!
                                                    </p>
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

@push('jsjadwalTM')
    <script>
        // DataTable
        // $('#jadwalTMTable').DataTable( {
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
            $("#MultijadwalTMRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultijadwalTMRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addJadwalTM").click(function(){
                ++i;
                let html = `
                    <div class="row">
                        <div class="col-12">
                        <?php foreach($jadwalAuditAdd as $key=>$JA){ 
                            
                            $TM = DB::table('tinjauan_manajemen')->where('audit_id', $JA->id)->first();
                            if($TM == null){?>
                            <div class="card card-default" id="cols">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Jadwal Audit</label>
                                                <input type="text" class="form-control" placeholder="{{ $JA->periode }} ({{ $JA->tahun }})" disabled>
                                                <input type="hidden" name="addmore[{{ $key }}][audit_id]" value="{{ $JA->id }}">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label>Unit Kerja</label></br>
                                                <?php foreach($unitKerja as $unitKerjas){
                                                    if($unitKerjas->id == $JA->unitkerja_id){ ?>
                                                        {{ $unitKerjas->name }}
                                                    <?php }
                                                } ?>
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
                            <?php }
                        } ?>
                        </div>
                    </div>
                `;
                $("#tableJadwalTM").append(html);
                $("#addJadwalTM").hide();
            });

            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            $(document).on('click', '.select2bs4', function(){  
                $(this).select2({
                    theme: 'bootstrap4'
                })
            });

            $(document).on('focus', '.dateAll', function(){  
                $(this).datepicker({
                    format: "yyyy-mm-dd",
                    viewMode: "date", 
                    minViewMode: "date"
                });
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