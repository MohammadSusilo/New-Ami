    @if(auth()->user()->role_id == 1)
    <a href="{{ route('scheduling.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> TAMBAH
    </a>
    <!-- <a href="#" id="MultijadwalAuditRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalJadwalAudit">
        <i class="fas fa-plus-circle"></i> TAMBAH BANYAK
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    @endif
    <a href="{{ route('scheduling.selectExportPDF')}}" target="_blank" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> EXPORT
    </a>
    <!-- <a href="#" id="ExportJadwalAuditplus" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->

    <p align="right">
        <a href="{{ url('jadwalAudit/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Jadwal Audit -->
    <div class="modal fade" id="modalJadwalAudit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple Jadwal Audit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('scheduling.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="container">
                            <div class="card-header">
                                <div class="row g-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="exampleInputEmail1" class="required">Tanggal Mulai Audit</label>
                                                    <input type="text" name="startDate" class="form-control dateAll @error('startDate') is-invalid @enderror" placeholder="Enter Tanggal Mulai Audit" autocomplete="off">

                                                    @error('addmore.0.startDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="exampleInputEmail1" class="required">Waktu Mulai Audit</label>
                                                    <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                                        <input type="text" name="startTime" class="form-control @error('startTime') is-invalid @enderror" placeholder="Enter Waktu Mulai Audit" autocomplete="off">

                                                        @error('addmore.0.startTime')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="exampleInputEmail1" class="required">Tanggal Selesai Audit</label>
                                                    <input type="text" name="finishDate" class="form-control dateAll @error('finishDate') is-invalid @enderror" placeholder="Enter Tanggal Selesai Audit" autocomplete="off">

                                                    @error('addmore.0.finishDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="exampleInputEmail1" class="required">Waktu Selesai Audit</label>
                                                    <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                                        <input type="text" name="finishTime" class="form-control @error('finishTime') is-invalid @enderror" placeholder="Enter Waktu Selesai Audit" autocomplete="off">

                                                        @error('addmore.0.finishTime')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="button" name="add" id="addJadwalAudit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="card-body" id="jadwalAuditMultiTable"></div> -->
                        </div>
                        <table class="table table-bordered table-striped" id="jadwalAuditMultiTable">  
                            <tr>
                                <th width="30%">Unit Kerja</th>
                                <th width="70%">Auditor</th>
                                <th>Action</th>
                            </tr>
                        </table>
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
        <div class="col-12">
            <div class="card" id="MultijadwalAuditRecord" style="display: none">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple Jadwal Audit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('scheduling.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <input type="text" name="tahun" class="form-control dateYear @error('tahun') is-invalid @enderror"  placeholder="Enter Tahun">
                                    
                            @error('addmore.0.tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="tglAudit" class="form-control dateAll @error('tglAudit') is-invalid @enderror" placeholder="Enter Tanggal">

                            @error('addmore.0.tglAudit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                <input type="text" name="waktu" class="form-control @error('waktu') is-invalid @enderror" placeholder="Enter Waktu">

                                @error('addmore.0.waktu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" name="add" id="addJadwalAudit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                        </div>

                        <table class="table table-bordered table-striped" id="jadwalAuditMultiTable">  
                            <tr>
                                <!-- <th class="required">Periode</th> -->
                                <th width="30%">Unit Kerja</th>
                                <th width="70%">Auditor</th>
                                <th>Action</th>
                            </tr>
                        </table> 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
            <div class="card ExportJadwalAuditshow" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Export Jadwal Audit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('scheduling.selectExportPDF')}}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped">  
                            <tr>
                                <th class="required">Periode</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control select2bs4 @error('periode') is-invalid @enderror" name="periode" id="periode" data-placeholder="Pilih Jadwal..." style="width: 100%;" autofocus>
                                        <option disabled selected="selected">Pilih Periode...</option> 
                                        @foreach ($scheduling as $UK)
                                            <option value="{{ $UK->periode }}">
                                                {{ $UK->periode}} ({{ $UK->tahun }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>  
                            </tr>  
                        </table> 
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

            <!-- Table Jadwal Audit -->
            <table id="jadwalAuditTables" class="table table-bordered table-striped display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode (Tahun)</th>
                        <th>Unit Kerja</th>
                        <th>Auditor</th>
                        <th>Auditee</th>
                        <th>Tanggal</th>
                        <th>Status</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($scheduling as $key=>$sch)
                    <tr> 
                        <td>{{ ++ $key }}</td>
                        <td>{{$sch->periode }} ({{$sch->tahun }})</td>
                        <td>
                            @foreach ($unitKerja as $unitKerjas)
                                @if($unitKerjas->id == $sch->unitkerja_id)
                                {{ $unitKerjas->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if(auth()->user()->role_id == 1)
                                @foreach($sch->users as $user)
                                    @if($user->role_id =="2")
                                        <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                    @endif
                                @endforeach
                            @else
                                @foreach($selectUserpivot as $userPivot)
                                    @if($userPivot->role_id == "2" && $userPivot->jadwal_id == $sch->jadwal_id)
                                        <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->role_id == 1)
                                @foreach($sch->users as $user)
                                    @if($user->role_id =="3")
                                    <span class="badge badge-pill badge-primary">{{$user->name}}</span>
                                    @endif
                                @endforeach
                            @else
                                @foreach($selectUserpivot as $userPivot)
                                    @if($userPivot->role_id == "3" && $userPivot->jadwal_id == $sch->jadwal_id)
                                        <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @php $tgl = explode("#", $sch->tglAudit); @endphp
                            {{ date('d F Y', strtotime($tgl[0])) }} - {{ date('d F Y', strtotime($tgl[1])) }}
                        </td>
                        <td>
                            @if($sch->status == "aktif")
                                <span class="badge badge-pill badge-success">Aktif</span>
                            @else
                                <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <div style="margin:5px">
                                    <!-- Show -->
                                    <a href="{{ route('scheduling.show', $sch->id) }}">
                                        <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i> LIHAT
                                        </button>
                                    </a>
                                </div>
                                @if(auth()->user()->role_id == 1)
                                    <div style="margin:5px">
                                        <!-- Edit -->
                                        <a href="{{ route('scheduling.edit', $sch->id) }}">
                                            <button class="button btn btn-xl btn-outline-warning is-small is-warning" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i> UBAH
                                            </button>
                                        </a>
                                    </div>
                                    <div style="margin:5px">
                                        <!-- Destroy -->
                                        <form method="POST" action="{{ route('scheduling.destroy', $sch->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-xl btn-outline-danger is-small is-info show-alert-delete-box">
                                                <i class="fa fa-times"></i> HAPUS
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
            <div></div>
            @if(auth()->user()->role_id == 1)
            <div style="display: flex; justify-content: flex-end">
                <form method="POST" action="{{ url('jadwalAudit/disabled') }}">
                    <input name="status" type="hidden" value="nonaktif">
                    @csrf
                    <button type="submit" class="btn btn-xl btn-outline-danger is-small is-info show-alert-disabled-box">
                        <i class="fa fa-times"></i> DISABLED ALL
                    </button>
                </form>
            </div>
            @endif

@push('jsjadwalAudit')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.show-alert-delete-box').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda yakin hapus data?",
                    text: "Pastikan kembali data yang akan dihapus",
                    icon: 'warning',
                    type: "warning",
                    buttons: ["Batal","Ya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
            
            $('.show-alert-disabled-box').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda yakin disabled data?",
                    text: "Pastikan kembali data yang akan di Disabled",
                    icon: 'warning',
                    type: "warning",
                    buttons: ["Batal","Ya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
        // DataTable


        // Hide/Show Audit Export
        $("#ExportJadwalAuditplus").click(function(){
            // show hide paragraph on button click
            $(".ExportJadwalAuditshow").toggle("slow", function(){});
        });

        // Multi Record
            // Hide/Show Multi Record
            $("#MultijadwalAuditRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultijadwalAuditRecord").toggle("slow", function(){});
            });
        
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            // Add Row Multi Record
            var i = 0;
            $("#addJadwalAudit").click(function(){
                $("#addJadwalAudit").hide();
                ++i;
                $(document).ready(function() {
                    $('.select2bs4').select2();
                });
                $("#jadwalAuditMultiTable").append(
                    //0. BAKPK
                    '<tr>'+
                    <?php foreach($unitKerja as $key=>$unitKerjas){ ?>+
                        '<tr>'+
                            '<td>'+
                                '<input type="hidden" name="addmore[{{ $key }}][unitkerja_id]" value="{{ $unitKerjas->id }}">'+
                                '{{$unitKerjas->name}}'+
                            '</td>'+
                            '<td>'+
                                '<select class="form-control select2bs4 @error('users') is-invalid @enderror" name="addmore[{{ $key }}][users][]" id="selectUsers{{ $key }}" multiple="multiple" data-placeholder="Pilih Auditor..." style="width: 100%;">'+
                                    <?php foreach($users as $user){ ?>+
                                        <?php if($user->role_id == 2) { ?>+
                                            '<option disabled selected="selected">Pilih User...</option>'+
                                            '<option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>'+
                                        <?php } ?>+
                                    <?php } ?>+
                                '</select>'+
                                '@error('addmore.[+i+].users')'+
                                    '<span class="invalid-feedback" role="alert">'+
                                        '<strong>{{ $message }}</strong>'+
                                    '</span>'+
                                '@enderror'+
                            '</td>'+
                            '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>'+
                        '</tr>'+
                    <?php } ?>+
                    '</tr>');
            });

            // $(document).on('click', '#selectUK', function(){  
            //     optionText = {!! json_encode($unitKerja->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectUK').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });

            // $(document).on('click', '#selectUsers', function(){  
            //     optionText = {!! json_encode($users->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectUsers').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });

            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
            // $(document).ready(function() {
            //     $('#selectUsers0').select2();
            // });
            // $(document).on('keyup','#selectUsers0',function(){  
            //     $(this).select2({
            //         theme: 'bootstrap4'
            //     })
            // });
            // $(document).on('click', '#selectUsers['+i+']', function(){  
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
            
            $(document).on('focus', '.dateAll', function(){  
                $(this).datepicker({
                    format: "yyyy-mm-dd",
                    viewMode: "date", 
                    minViewMode: "date"
                });
            });     
            
            $(document).on('focus', '.input1', function(){  
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years"
                });
            });     
            
            $(document).on('focus', '.input2', function(){  
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
                    $(this).parents('tr').remove();
            });     
    </script>
@endpush