    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
    <a href="{{ route('auditReports.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> TAMBAH
    </a>
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalLaporanAudit">
        <i class="fas fa-plus-circle"></i> TAMBAH BANYAK
    </button>
    <!--<a href="#" class="btn btn-app">-->
    <!--  <i class="fas fa-file-excel"></i> Import-->
    <!--</a>-->
    @endif
        
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalExportDaftarPeriksa">
        <i class="fas fa-file-pdf"></i> EXPORT DAFTAR PERIKSA
    </button>
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalExportLaporanAudit">
        <i class="fas fa-file-pdf"></i> EXPORT LAPORAN AUDIT
    </button>

    <p align="right">
        <a href="{{ url('laporanAudit/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <!-- Multi Laporan Audit -->
    <div class="modal fade" id="modalLaporanAudit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple Laporan Audit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('auditReports.saveMulti') }}" enctype="multipart/form-data" id="laporanAuditMulti">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="card-header">
                            <div class="row g-2">
                                <div class="col">
                                    <button type="button" name="add" id="addLaporanAudit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        
                        <div class="card-body" id="auditReportsMultiTable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-default" id="cols">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label  class="required">Jadwal Periode Audit</label>
                                                        <?php if(Auth::user()->role_id == 1){ ?>
                                                            <!--<select class="form-control select2bs4 @error('audit_id') is-invalid @enderror" name="addmore[0][audit_id]" id="selectPeriode" data-placeholder="Pilih Periode Audit..." style="width: 100%;">-->
                                                            <select class="form-control select2bs45 @error('addmore[0][audit_id]') is-invalid @enderror" name="addmore[0][audit_id]" id="selectPeriode0" data-placeholder="Pilih Kode Standar..." style="width: 100%;" required>
                                                                <option selected="selected" value="">Pilih Periode Audit...</option>
                                                                <?php foreach($jadwalaudits as $audit){ ?>
                                                                    <option {{(old('addmore[0][audit_id]') == $audit->id?'selected':'')}} value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                                                <?php } ?>
                                                            </select>

                                                            @error('addmore[0][audit_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <?php }else{ ?>
                                                            <select class="form-control select2bs45 @error('addmore[0][audit_id]') is-invalid @enderror" name="addmore[0][audit_id]" id="selectPeriode0" data-placeholder="Pilih Periode Audit..." style="width: 100%;" required>
                                                                <option selected="selected" value="">Pilih Periode Audit...</option>
                                                                <?php foreach($jadwalaudits as $audits){ ?>
                                                                    <?php foreach($audits as $audit){ ?>
                                                                        <option {{(old('addmore[0][audit_id]') == $audit->id?'selected':'')}} value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>

                                                            @error('addmore[0][audit_id]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="required">Kode Standar</label></br>
                                                        <!-- <input type="text" id="standar0" name="addmore[0][standar]" value="{{ old('addmore[0][standar]') }}" class="form-control @error('addmore[0][standar]') is-invalid @enderror" placeholder="Masukkan Standar" required> -->
                                                        <select class="form-control select2bs45 @error('addmore[0][standar_id]') is-invalid @enderror" name="addmore[0][standar_id]" id="selectPeriode0" data-placeholder="Pilih Periode Audit..." style="width: 100%;" required>
                                                            <option selected="selected" value="">Pilih Standar...</option>
                                                            @foreach($standars as $value)
                                                                <option {{(old('addmore[0][standar_id]') == $value->id?'selected':'')}} value="<?php echo $value->id; ?>">
                                                                {{ $value->kodeStandar }} - {{ $value->namaStandar }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('addmore[0][standar_id]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="required">Kategori Temuan</label></br>
                                                        <select class="custom-select @error('kategoriTemuan') is-invalid @enderror" name="addmore[0][kategoriTemuan]" id="kategoriTemuan0" required>
                                                            <option value="">Pilih Kategori...</option>
                                                            <option value="OFI" @if (old('addmore[0][kategoriTemuan]') == "OFI") {{ 'selected' }} @endif>Opportunity for Improvement</option>
                                                            <option value="AOC" @if (old('addmore[0][kategoriTemuan]') == "AOC") {{ 'selected' }} @endif>Area of Concern</option>
                                                            <option value="NC" @if (old('addmore[0][kategoriTemuan]') == "NC") {{ 'selected' }} @endif>Non-Conformity</option>
                                                        </select>

                                                        @error('addmore[0][kategoriTemuan]')
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
                                                        <label class="required">Uraian Temuan</label>
                                                        <!-- <textarea class="form-control @error('addmore[0][uraianTemuan]') is-invalid @enderror" rows="3" name="addmore[0][uraianTemuan]" placeholder="Masukkan Uraian Temuan" required>{{ old('addmore[0][uraianTemuan]') }}</textarea> -->
                                                        <!-- <textarea class="form-control summernote_uraianTemuan @error('addmore[0][uraianTemuan]') is-invalid @enderror" name="addmore[0][uraianTemuan]" id="uraianTemuan0" data-parsley-summernote-required="" data-parsley-errors-container="#myErrors">{{ old('addmore[0][uraianTemuan]') }}</textarea>
                                                        <div id="myErrors"></div> -->

                                                        <textarea name="addmore[0][uraianTemuan]"></textarea>

                                                        @error('addmore[0][uraianTemuan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Saran Perbaikan</label>
                                                        <!-- <textarea class="form-control @error('addmore[0][saranPerbaikan]') is-invalid @enderror" rows="3" name="addmore[0][saranPerbaikan]" placeholder="Masukkan Saran Perbaikan">{{ old('addmore[0][saranPerbaikan]') }}</textarea> -->
                                                        <!-- <textarea class="form-control summernote_saranPerbaikan @error('addmore[0][saranPerbaikan]') is-invalid @enderror" id="saranPerbaikan0" name="addmore[0][saranPerbaikan]">{{ old('addmore[0][saranPerbaikan]') }}</textarea> -->
                                                        
                                                        <textarea name="addmore[0][saranPerbaikan]"></textarea>

                                                        @error('addmore[0][saranPerbaikan]')
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
                    <button type="submit" class="btn btn-primary" id="saveMulti">Save changes</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Export Daftar Periksa -->
    <div class="modal fade" id="modalExportDaftarPeriksa">
        <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Export Daftar Periksa Audit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST" target="_blank" action="{{ route('auditReports.selectExportDaftarPDF') }}" enctype="multipart/form-data" id="formLaporanAudit">
                        @csrf
                        <div class="modal-body">
                            <div class="container">
                                @if(auth()->user()->role_id == 1)
                                    <div class="card-header">
                                        <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                    </div>
    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                        <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                        @foreach ($unitKerja as $unitKerjas)
                                                            <option value="{{ $unitKerjas->id }}">
                                                                {{ $unitKerjas->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(auth()->user()->role_id == 2)
                                    <div class="card-header">
                                        <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                    </div>
        
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                        <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                        @foreach ($unitKerja as $unitKerjas)
                                                            @foreach ($scheduling as $S)
                                                            @if($S->unitkerja_id == $unitKerjas->id)
                                                            <option value="{{ $unitKerjas->id }}">
                                                                {{ $unitKerjas->name}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="unitkerja_id" value="{{ auth()->user()->unitkerja_id }}">
                                    <center>
                                        <button type="submit" class="btn btn-primary">EXPORT</button>
                                    </center>
                                @endif
                            </div>
                        </div>
                        @if(auth()->user()->role_id != 3)
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">EXPORT</button>
                        </div>
                        @endif
                    </form>
                </div>
                <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Export Laporan Audit -->
    <div class="modal fade" id="modalExportLaporanAudit">
        <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Export Laporan Audit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST" target="_blank" action="{{ route('auditReports.selectExportPDF') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="container">
                                @if(auth()->user()->role_id == 1)
                                    <div class="card-header">
                                        <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                    </div>
    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                        <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                        @foreach ($unitKerja as $unitKerjas)
                                                            <option value="{{ $unitKerjas->id }}">
                                                                {{ $unitKerjas->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(auth()->user()->role_id == 2)
                                    <div class="card-header">
                                        <h5 class="modal-title">Silahkan pilih Unit Kerja</h5>
                                    </div>
        
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4 @error('tm_id') is-invalid @enderror" name="unitkerja_id" data-placeholder="Pilih Unit Kerja..." style="width: 100%;" autofocus>
                                                        <option disabled selected="selected">Pilih Unit Kerja...</option> 
                                                        @foreach ($unitKerja as $unitKerjas)
                                                            @foreach ($scheduling as $S)
                                                            @if($S->unitkerja_id == $unitKerjas->id)
                                                            <option value="{{ $unitKerjas->id }}">
                                                                {{ $unitKerjas->name}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="unitkerja_id" value="{{ auth()->user()->unitkerja_id }}">
                                    <center>
                                        <button type="submit" class="btn btn-primary">EXPORT</button>
                                    </center>
                                @endif
                            </div>
                        </div>
                        @if(auth()->user()->role_id != 3)
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">EXPORT</button>
                        </div>
                        @endif
                    </form>
                </div>
                <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    

        <!-- Table Laporan Audit -->
        <table id="auditReportsTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>No</th>
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <th>Periode</th>
                    @endif
                    <th>Kode Standar</th>
                    <th>Uraian Temuan</th>
                    <th>Kategori Temuan</th>
                    <th>Saran Perbaikan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($auditReports as $key=>$auditReport)
                <tr> 
                    <td>{{ ++ $key }}</td>
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <td>{{ $auditReport->periode }} ({{ $auditReport->tahun }}) - @foreach($unitKerja as $UK) @if($UK->id == $auditReport->unitkerja_id) {{ $UK->name }} @endif @endforeach</td>
                    @endif
                    <td>
                        @foreach($standars as $value)
                            @if($value->id == $auditReport->standar_id)
                                {{ $value->kodeStandar }} - {{ $value->namaStandar }}
                            @endif
                        @endforeach
                    </td>
                    <td>{!! $auditReport->uraianTemuan !!}</td>
                    <td>{{ $auditReport->kategoriTemuan }}</td>
                    <td>{!! $auditReport->saranPerbaikan !!}</td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('auditReports.show', $auditReport->id) }}">
                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i> LIHAT
                                    </button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('auditReports.edit', $auditReport->id) }}">
                                    <button class="button btn btn-xl btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i> UBAH
                                    </button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <form method="POST" action="{{ route('auditReports.destroy', $auditReport->id) }}">
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

@push('jslaporanAudit')
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
            
        });

        CKEDITOR.replace('addmore[0][uraianTemuan]');
        $("#laporanAuditMulti").submit( function(e) {
            var messageLength = CKEDITOR.instances['addmore[0][uraianTemuan]'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Uraian Temuan Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });

        CKEDITOR.replace('addmore[0][saranPerbaikan]');

        // $('#formLaporanAudit').on('submit', function(e) {
        //     if($('#uraianTemuan0').summernote('isEmpty')) {
        //         $('#uraianTemuan0').next('#saranPerbaikan0').find('#saranPerbaikan0').html('')
        //          alert('editor content is empty');
        //          console.log('contents is empty, fill it!');
        //          // cancel submit
        //          event.preventDefault()
        //     }
        //     else {
        //         // do action
        //     }
        // });

        // DataTable
        // $('#auditReportsTable').DataTable( {
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
        // $('#modalLaporanAudit').on('shown.bs.modal', function (e) {
        //     $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        // });
        // $('#modalLaporanAudit').on('shown.bs.collapse', function () {
        //   $($.fn.dataTable.tables(true)).DataTable()
        //       .columns.adjust();
        // });
        
        // Hide/Show Audit Export
        $("#ExportLaporanAuditplus").click(function(){
            // show hide paragraph on button click
            $(".ExportLaporanAuditshow").toggle("slow", function(){});
        });
        
        // Multi Record
            // Add Row Multi Record
            var i = 0;
            $("#addLaporanAudit").click(function(){
                ++i;
                console.log(i);
                let html = `
                <div class="row">
                    <div class="col-12">
                        <div class="card card-default" id="cols">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="required">Jadwal Periode Audit</label>
                                            <?php if(Auth::user()->role_id == 1){ ?>
                                                <select class="form-control select2bs45 @error('audit_id') is-invalid @enderror" name="addmore[`+i+`][audit_id]" id="selectPeriode`+i+`" data-placeholder="Pilih Periode Audit..." style="width: 100%;" required>
                                                    <option disabled selected="selected" value="">Pilih Periode Audit...</option>
                                                    <?php foreach($jadwalaudits as $audit){ ?>
                                                        <option value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                                    <?php } ?>
                                                </select>

                                                @error('addmore.[`+i+`].audit_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            <?php }else{ ?>
                                                <select class="form-control select2bs45 @error('audit_id') is-invalid @enderror" name="addmore[`+i+`][audit_id]" id="selectPeriode`+i+`" data-placeholder="Pilih Periode Audit..." style="width: 100%;" required>
                                                    <option disabled selected="selected" value="">Pilih Periode Audit...</option>
                                                    <?php foreach($jadwalaudits as $audits){ ?>
                                                        <?php foreach($audits as $audit){ ?>
                                                            <option value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>

                                                @error('addmore.[`+i+`].audit_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="required">Standar</label></br>
                                            <select class="form-control select2bs45 @error('addmore[`+i+`][standar_id]') is-invalid @enderror" name="addmore[`+i+`][standar_id]" id="selectPeriode0" data-placeholder="Pilih Periode Audit..." style="width: 100%;" required>
                                            <option selected="selected" value="">Pilih Standar...</option>
                                                @foreach($standars as $value)
                                                    <option {{(old('addmore[`+i+`][standar_id]') == $value->id?'selected':'')}} value="<?php echo $value->id; ?>">
                                                        {{ $value->kodeStandar }} - {{ $value->namaStandar }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('addmore.[`+i+`].standar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="required">Kategori Temuan</label></br>
                                            <select class="custom-select @error('addmore[`+i+`][kategoriTemuan]') is-invalid @enderror" name="addmore[`+i+`][kategoriTemuan]" id="kategoriTemuan`+i+`" required>
                                                <option value="">Pilih Kategori...</option>
                                                <option value="OFI">Opportunity for Improvement</option>
                                                <option value="AOC">Area of Concern</option>
                                                <option value="NC">Non-Conformity</option>
                                            </select>

                                            @error('addmore.[`+i+`].kategoriTemuan')
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
                                            <label class="required">Uraian Temuan</label>
                                            <textarea name="addmore[`+i+`][uraianTemuan]"></textarea>

                                            @error('addmore.[`+i+`].uraianTemuan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Saran Perbaikan</label>
                                            <textarea name="addmore[`+i+`][saranPerbaikan]"></textarea>

                                            @error('addmore.[`+i+`].saranPerbaikan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
            
                $("#auditReportsMultiTable").append(html);   
                
                // $("#uraianTemuan"+i+"").summernote({
                //     placeholder: 'Enter Uraian Temuan',
                //     tabsize: 2,
                //     height: 100,
                //     toolbar: [
                //         ['style', ['style']],
                //         ['font', ['bold', 'underline', 'clear']],
                //         ['fontname', ['fontname']],
                //         ['color', ['color']],
                //         ['para', ['ul', 'ol', 'paragraph']],
                //         ['table', ['table']],
                //         ['view', ['fullscreen', 'codeview', 'help']],
                //     ],
                // });
                // $("#saranPerbaikan"+i+"").summernote({
                //     placeholder: 'Enter Saran Perbaikan',
                //     tabsize: 2,
                //     height: 100,
                //     toolbar: [
                //         ['style', ['style']],
                //         ['font', ['bold', 'underline', 'clear']],
                //         ['fontname', ['fontname']],
                //         ['color', ['color']],
                //         ['para', ['ul', 'ol', 'paragraph']],
                //         ['table', ['table']],
                //         ['view', ['fullscreen', 'codeview', 'help']],
                //     ],
                // });

                CKEDITOR.replace('addmore['+i+'][uraianTemuan]');
                $("#laporanAuditMulti").submit( function(e) {
                    var messageLength = CKEDITOR.instances['addmore['+i+'][uraianTemuan]'].getData().replace(/<[^>]*>/gi, '').length;
                    if( !messageLength ) {
                        alert( 'Uraian Temuan Kosong, Tolong di Isikan' );
                        e.preventDefault();
                    }
                });

                CKEDITOR.replace('addmore['+i+'][saranPerbaikan]');
 
            });

            // $(document).on('click', '#selectPeriode', function(){  
            //     optionText = {!! json_encode($audits->toArray()) !!};
            //     jQuery.each(optionText,function(i, el) {
            //         // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
            //         // console.log(optionValue);
            //         $('#selectPeriode').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
            //     });
            // });
            
            // $(document).on('click', '#saveMulti', function(){  
            //     var i = -1;
            //     ++i;
            //     if ($("#uraianTemuan"+i).summernote('isEmpty'))
            //     {
            //         var form =  $(this).closest("form");
            //         var name = $(this).data("name");
            //         event.preventDefault();
            //         swal({
            //             title: "Uraian Temuan Kosong",
            //             text: "Pastikan cek kembali data",
            //             icon: 'warning',
            //             type: "warning",
            //         });
            //     }
            // });
            
            $(document).on('click', '.custom-file', function(){  
                bsCustomFileInput.init();
            });
       
            $(document).on('click', '.select2bs45', function(){  
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
                $(this).closest("#cols").remove();
                    // $(this).parents('tr').remove();
            });     
    </script>
@endpush