    <a href="{{ route('unitKerja.create') }}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <div class="row">
        <!-- Table Unit Kerja -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Unit Kerja</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="unitKerjaTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama UK</th>
                                <th>Pimpinan UK</th>
                                <th>Tipe UK</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unitKerja as $key=> $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->pengelolaunitkerja->name }}</td>
                                <td>
                                    <span class="badge badge-pill badge-info">{{ $value->status }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Show -->
                                            <a href="{{ route('unitKerja.show', $value->id) }}">
                                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('unitKerja.edit', $value->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('unitKerja.destroy', $value->id) }}" method="POST" class="is-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                            </form>
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


    </div>

@push('jsunitKerja')
    <script>
        // DataTable
        $("#unitKerjaTable").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Multi Record
            // Hide/Show Multi Record
            $("#MultidokChecklistRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultidokChecklistRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#adddokInduk").click(function(){
                ++i;
                $("#dokChecklistMultiTable").append('<tr>'+
                '<td><input type="text" name="addmore['+i+'][name]" placeholder="Enter Name" class="form-control" /></td>'+
                '<td><input type="text" name="addmore['+i+'][tahun]" placeholder="Enter Tahun" class="form-control dateYear" /></td>'+
                '<td><select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" id="selectUK" name="addmore['+i+'][unitkerja_id]" style="width: 100%;"><option disabled selected="selected">Pilih Unit Kerja...</option></select></td>'+
                '<td><select class="custom-select @error('status') is-invalid @enderror" name="addmore['+i+'][status]" id="status"><option>-- Select Status --</option><option value="aktif">Aktif</option><option value="nonaktif">Non Aktif</option></select></td>'+
                '<td><div class="custom-file"><input type="file" name="addmore['+i+'][lokasi]" class="custom-file-input" id="customFile"><label class="custom-file-label" for="customFile">Choose file</label></div></td>'+
                '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td></tr>');
                                        
            });

            $(document).on('click', '#selectUK', function(){  
                optionText = {!! json_encode($unitKerja->toArray()) !!};
                jQuery.each(optionText,function(i, el) {
                    // optionValue = '<option value="'+el.id+'">'+el.name+'</option>';
                    // console.log(optionValue);
                    $('#selectUK').append( '<option value="'+el.id+'">'+'Option '+el.name+'</option>' );
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

            $(document).on('click', '.remove-tr', function(){  
                    $(this).parents('tr').remove();
            });     
    </script>
@endpush