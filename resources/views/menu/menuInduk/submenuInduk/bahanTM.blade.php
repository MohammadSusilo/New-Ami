    @if(auth()->user()->role_id == 1)
    <a href="{{ route('bahanTM.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <!-- <a href="#" id="MultibahanTMRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a> -->
    
    <!-- <a href="{{ route('bahanTM.import')}}" class="btn btn-app">
      <i class="fas fa-file-word"></i> Import CAR tidak sesuai
    </a> -->
    <a href="#" id="import" class="btn btn-app">
      <i class="fas fa-plus"></i> Import CAR tidak sesuai
    </a>
    @endif
    <a href="{{ route('bahanTM.selectExportPDF') }}" class="btn btn-app">
      <i class="fas fa-file-word"></i> Export Bahan TM
    </a>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    <!-- <a href="{{ route('bahanTM.selectExportPDF') }}" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->

    <p align="right">
        <a href="{{ url('bahanTinjauanManajemen/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>


    <!-- Multi Record Bahan TM -->
    <div class="modal fade" id="importBahanTM">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple CAR Reports</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('bahanTM.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h6 class="modal-title">CAR Sesuai</h6>
                    <div class="row align-items-center">
                        <button type="button" name="add" id="addbahanTM" class="btn btn-success"><i class="fas fa-plus"></i></button>
                        <table class="table table-bordered table-striped" id="bahanTMMultiTable">  
                            <tr>
                                <th class="required">Laporan Temuan</th>
                                <th>Action</th>
                            </tr>
                        </table> 
                    </div>  

                    <h6 class="modal-title">CAR Tidak Sesuai</h6>
                    <div class="row align-items-center" id="rolesec"></div>  
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


        <!-- Table Bahan TM -->
        <table id="bahanTMTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jadwal TM</th>
                    <th>Unit Kerja</th>
                    <th>Laporan Temuan</th>
                    <th>Hasil Pemeriksaan</th>
                    <th>Auditor</th>
                    <th>Auditee</th>
                    <th>Status</th>
                    <th>Update Hasil Pemeriksaan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @php
                $selectUserpivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->where('jadwal_audit.status', "aktif")
                        ->get();
            @endphp
            @foreach($bahanTM as $key=>$bahan)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                      {{ date('d F Y', strtotime($bahan->tglTM))  }}
                    </td>
                    <td>
                        @foreach($unitKerja as $UK)
                            @if($UK->id == $bahan->unitkerja_id)
                                {{ $UK->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $bahan->deskripsi }}</td>
                    <td>
                        @foreach ($allCAR as $allCARs) 
                            @if($bahan->car_id == $allCARs->id)
                                @if($allCARs->hasilPemeriksaan == "nonsesuai")
                                    <span class="badge badge-pill badge-danger">Tidak Sesuai</span>
                                @else
                                    <span class="badge badge-pill badge-info">Sesuai</span>
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($selectUserpivot as $userPivot)
                            @if($userPivot->role_id == "2" && $userPivot->jadwal_id == $bahan->audit_id)
                                <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($selectUserpivot as $userPivot)
                            @if($userPivot->role_id == "3" && $userPivot->jadwal_id == $bahan->audit_id)
                                <span class="badge badge-pill badge-primary">{{$userPivot->name}}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($bahan->status == "aktif")
                            <span class="badge badge-pill badge-success">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                        @endif
                    </td>
                    <td>
                            @php
                                $car = DB::table('car')->where('id', $bahan->car_id)->first();
                            @endphp
                            @if($car->hasilPemeriksaan == "nonsesuai")
                                <a href="#" id="changeHasilPemeriksaan" data-toggle="modal" data-target="#updateCars{{ $bahan->id }}">
                                    <i class="fas fa-toggle-off"></i> {{ __('Tidak Sesuai') }}
                                </a>

                                <div class="modal fade" id="updateCars{{ $bahan->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Hasil Pemeriksaan Audit</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="search{{$bahan->car_id}}" action="{{ url('carchange') }}">
                                                    @csrf
                                                    <p style="text-align: center;">Apakah anda yakin update data Audit : {{ $bahan->deskripsi }} !!!</p>
                                                    <input name="id" type="hidden" value="{{$bahan->car_id}}">
                                                    <input name="status" type="hidden" value="sesuai">
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
                            @else
                                <i class="fa fa-toggle-on"></i> {{ __('Sesuai') }}
                            @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('bahanTM.show', $bahan->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('bahanTM.edit', $bahan->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <!-- <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('bahanTM.destroy', $bahan->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form> -->

                                <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteBahanTM{{ $bahan->id }}">
                                    <i class="fa fa-times"></i>
                                </button>

                                <div class="modal fade" id="deleteBahanTM{{ $bahan->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Bahan TM</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('bahanTM.destroy', $bahan->id) }}" method="POST" class="is-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p style="text-align: center;">Apakah anda yakin hapus data Bahan TM : {{ $bahan->deskripsi }} !!!</p>
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

@push('jsbahanTM')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).on('click', '.custom-file', function(){  
            bsCustomFileInput.init();
        });
        $(document).on("click", "#import", function() {
            // Delete User Modal
            $("#importBahanTM").modal("show");
            // user_id = sanitizeHTML($(this).attr("id"));

            // Show Roles

            $.ajax({
                url: "getbahanTM",
                type: "GET",
                dataType: "html"
            }).done(function(response) {
                console.log(response);
                $("#importBahanTM")
                    .find("#rolesec")
                    .html(response);
            });
        });
    
        // DataTable
        // $('#sd').DataTable( {
        //     "scrollX": true
        // } );
        // $('#bahanTMTable').DataTable({
        //     paging: true,
        //     lengthChange: true,
        //     searching: true,
        //     ordering: true,
        //     info: true,
        //     autoWidth: true,
        //     responsive: true,
        // });
        // $("#s").DataTable();
        // $("#bahanTMTable").DataTable({
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
        $("#addCARNonSesuai").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        

        // Multi Record
            // Hide/Show Multi Record
            $("#MultibahanTMRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultibahanTMRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addbahanTM").click(function(){
                ++i;
                $("#bahanTMMultiTable").append(
                    '<tr>'+
                        '<td>'+
                            '<select class="form-control select2bs4 @error('deskripsi') is-invalid @enderror" name="addmore['+i+'][deskripsi]" id="selectBahanTM" data-placeholder="Pilih Laporan Temuan..." style="width: 100%;">'+
                                '<option disabled selected="selected">Pilih Laporan Temuan...</option>'+
                                <?php foreach($CARsesuai as $CARsesuais){ ?>+
                                    <?php foreach($unitKerja as $UK){ ?>+
                                        <?php if($UK->id == $CARsesuais->laporanAudit->jadwalAudit->unitkerja_id){ ?>+
                                            '<option disabled selected="selected">Pilih Laporan Temuan...</option>'+
                                            '<option value="<?php echo $CARsesuais->laporanTemuan; ?>|<?php echo $CARsesuais->id; ?>|<?php echo $CARsesuais->laporanaudit_id; ?>">(<?php echo $UK->name; ?>) | <?php echo $CARsesuais->laporanTemuan; ?></option>'+
                                            // '<input type="hidden" name="addmore['+i+'][car_id]" value="<?php echo $CARsesuais->id; ?>">'+
                                        <?php } ?>+
                                    <?php } ?>+
                                <?php } ?>+
                            '</select>'+
                            '@error('addmore.[+i+].tm_id')'+
                                '<span class="invalid-feedback" role="alert">'+
                                    '<strong>{{ $message }}</strong>'+
                                '</span>'+
                            '@enderror'+
                        '</td>'+
                        '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>'+
                    '</tr>');
                                   
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
                    $(this).parents('tr').remove();
            });     
    </script>
@endpush