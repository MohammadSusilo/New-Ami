    <a href="{{ route('pimpinan.create') }}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a>
    <div class="row">
        <!-- Table Pimpinan -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pimpinan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pimpinanTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama </th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pimpinan as $key=> $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <form method="POST" id="search{{$value->id}}" action="{{ url('pimpinanchange') }}">
                                        <input name="id" type="hidden" value="{{$value->id}}">
                                        @csrf
                                        <div class="form-group form-float">
                                            <select name="status" id="id" class="form-control show-tick"
                                            {{-- onChange="doSomething(document.getElementById('search{{$value->id}}').options[document.getElementById('search{{$value->id}}').selectedIndex].value).submit();"> --}}
                                            onChange="document.getElementById('search{{$value->id}}').submit();">
                                            {{-- onclick="document.getElementById('search{{$value->id}}').submit();"> --}}
                                                @if ($value->status == "D0")
                                                    <option value="D0">Direktur</option>
                                                    <option value="WD1">Wakil Direktur 1</option>
                                                    <option value="WD2">Wakil Direktur 2</option>
                                                    <option value="WD3">Wakil Direktur 3</option>
                                                    <option value="WD4">Wakil Direktur 4</option>
                                                @elseif ($value->status == "WD1")
                                                    <option value="WD1">Wakil Direktur 1</option>
                                                    <option value="WD2">Wakil Direktur 2</option>
                                                    <option value="WD3">Wakil Direktur 3</option>
                                                    <option value="WD4">Wakil Direktur 4</option>
                                                    <option value="D0">Direktur</option>
                                                @elseif ($value->status == "WD2")
                                                    <option value="WD2">Wakil Direktur 2</option>
                                                    <option value="WD3">Wakil Direktur 3</option>
                                                    <option value="WD4">Wakil Direktur 4</option>
                                                    <option value="D0">Direktur</option>
                                                    <option value="WD1">Wakil Direktur 1</option>
                                                @elseif ($value->status == "WD3")
                                                    <option value="WD3">Wakil Direktur 3</option>
                                                    <option value="WD4">Wakil Direktur 4</option>
                                                    <option value="D0">Direktur</option>
                                                    <option value="WD1">Wakil Direktur 1</option>
                                                    <option value="WD2">Wakil Direktur 2</option>
                                                @else
                                                    <option value="WD4">Wakil Direktur 4</option>
                                                    <option value="D0">Direktur</option>
                                                    <option value="WD1">Wakil Direktur 1</option>
                                                    <option value="WD2">Wakil Direktur 2</option>
                                                    <option value="WD3">Wakil Direktur 3</option>
                                                @endif
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div style="margin:5px">
                                            <!-- Show -->
                                            <a href="{{ route('pimpinan.show', $value->id) }}">
                                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Edit -->
                                            <a href="{{ route('pimpinan.edit', $value->id) }}">
                                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                        <div style="margin:5px">
                                            <!-- Destroy -->
                                            <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('pimpinan.destroy', $value->id) }}" method="POST" class="is-inline">
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

@push('jspimpinan')
    <script>
        // DataTable
        $("#pimpinanTable").DataTable({
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