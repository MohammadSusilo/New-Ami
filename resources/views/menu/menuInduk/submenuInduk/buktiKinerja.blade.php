    <!-- <a href="#" class="btn btn-app">
        <i class="fas fa-plus"></i> New
    </a>
    <a href="#" id="MultibuktiKinerjaRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a>
    <a href="#" class="btn btn-app">
      <i class="fas fa-file-excel"></i> Import
    </a>
    <a href="#" class="btn btn-app">
      <i class="fas fa-file-pdf"></i> Export
    </a> -->

    <p align="right">
        <a href="{{ url('buktiUnithistory/history')}}">
            <button class="button btn btn-link btn-outline-default is-small is-danger" data-toggle="tooltip" data-original-title="Ubah Pengguna">
                <i class="fa fa-history"></i> History
            </button>
        </a>
    </p>

    <div class="row">
        <!-- Multi Record Renop -->
        <!-- <div class="col-12" id="MultibuktiKinerjaRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Multiple Bukti Kinerja </h3>
                </div> -->
                <!-- /.card-header -->
                <!-- <div class="card-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-responsive table-bordered table-striped" id="buktiKinerjaMultiTable">  

                        </table> 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- Table Renop -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bukti Kinerja</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="BuktiKUTable" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bukti</th>
                                <th>Renop</th>
                                <th>Kinerja Unit</th>
                                <th>Berkas Pendukung</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($bukti as $key=>$buktis)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $buktis->namaBukti }}</td>
                                <td>
                                    @foreach ($dadakanrenop as $RN)
                                      @if($RN->id == $buktis->renop_id)
                                        {{ $RN->kode }}
                                      @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($dadakankinerja as $KU)
                                    @if($KU->id == $buktis->kinerjaUnit_id)
                                        {{ $KU->deskripsi }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ asset($buktis->lokDokBukti) }}" target="_blank" target="pdf-frame">
                                        @php $lokDokBukti = explode("/", $buktis->lokDokBukti); @endphp
                                            {{ $lokDokBukti[7] }}
                                    </a>
                                </td>
                                <td>{{ $buktis->tahun }}</td>
                                <td>
                                    @if($buktis->status == "aktif")
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                             <!--Show -->
                                            <a href="{{ route('buktiKinerja.show', $buktis->id) }}">
                                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div>
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3 )
                                        <div style="margin:5px">
                                             <!--Edit -->
                                            <a href="{{ route('buktiKinerja.edit', $buktis->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">

                                            <button type="button" class="btn btn-link btn-outline-danger is-small is-info" data-toggle="modal" data-target="#deleteBuktiKinerja{{$buktis->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            
                                            <div class="modal fade" id="deleteBuktiKinerja{{$buktis->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Bukti Kinerja Unit</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('buktiKinerja.destroy', $buktis->id) }}" method="POST" class="is-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p style="text-align: center;">Apakah anda yakin hapus data Bukti Kinerja Unit : {{ $buktis->namaBukti }} !!!</p>
                                                                <center>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                                                    <button type="submit" class="btn btn-success">Iya</button>
                                                                </center>
                                                            </form>
                                                        </div>
                                                    </div>
                                                     <!--/.modal-content -->
                                                </div>
                                                 <!--/.modal-dialog -->
                                            </div>
                                             <!--/.modal -->
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
                    
    </div>
    <!-- /.row -->

@push('jsbuktiKinerja')
    <script>
        // DataTable
        // $('#BuktiKUTable').DataTable( {
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // } );
        
        // $('#BuktiKUTable').DataTable( {
        //     "paging": true,
        //     "lengthChange": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });

        // Multi Record
            // // Hide/Show Multi Record
            // $("#MultibuktiKinerjaRecordplus").click(function(){
            //     // show hide paragraph on button click
            //     $("#MultikinerjaUnitRMultibuktiKinerjaRecordecord").toggle("slow", function(){});
            // });
        
            // Add Row Multi Record
            // var i = 0;
            // $("#addBukti").click(function(){
            //     ++i;
            //     $("#buktiMultiTable").append('<tr>'+
            //     '<td><input type="text" name="addmore['+i+'][kode]" placeholder="Enter Kode" class="form-control" /></td>'+
            //     '<td><input type="text" name="addmore['+i+'][deskripsi]" placeholder="Enter Deskripsi" class="form-control" /></td>'+
            //     '<td><input type="number" name="addmore['+i+'][target]" placeholder="Enter Target" class="form-control" /></td>'+
            //     '<td><input type="number" name="addmore['+i+'][unit_target]" placeholder="Enter Unit Target" class="form-control" /></td>'+
            //     '<td><input type="text" name="addmore['+i+'][tahun]" placeholder="Enter Tahun" class="form-control dateYear" /></td>'+
            //     '<td><select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" id="selectUK" name="addmore['+i+'][unitkerja_id]" style="width: 100%;"><option disabled selected="selected">Pilih Unit Kerja...</option></select></td>'+
            //     '<td><select class="form-control select2bs4 @error('renstra') is-invalid @enderror" name="addmore['+i+'][renstra[]]" id="selectRenstra" multiple="multiple" data-placeholder="Select a Renstra" style="width: 100%;"></select></td>'+
            //     '<td><select class="custom-select @error('status') is-invalid @enderror" name="addmore['+i+'][status]" id="status"><option>-- Select Status --</option><option value="aktif">Aktif</option><option value="nonaktif">Non Aktif</option></select></td>'+
            //     '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td></tr>');
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


            // $(document).on('click', '.custom-file', function(){  
            //     bsCustomFileInput.init();
            // });
       
            // $(document).on('click', '.select2bs4', function(){  
            //     $(this).select2({
            //         theme: 'bootstrap4'
            //     })
            // });

            // $(document).on('focus', '.dateYear', function(){  
            //     $(this).datepicker({
            //         format: "yyyy",
            //         viewMode: "years", 
            //         minViewMode: "years"
            //     });
            // });      

            // $(document).on('click', '.remove-tr', function(){  
            //         $(this).parents('tr').remove();
            // });     
    </script>
@endpush