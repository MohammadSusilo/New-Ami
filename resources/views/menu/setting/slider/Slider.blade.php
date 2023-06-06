    <!-- <a href="{{ route('slider.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a> -->
    <a href="#" id="MultiSliderRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a>

    <!-- Multi Record Slider -->
    <div class="row">
        <div class="col-12" id="MultiSliderRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple Slider</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('slider.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="SliderMultiTable">  
                            <tr>
                                <th class="required">Judul</th>
                                <th>Deskripsi</th>
                                <th class="requiredfilepicture">File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <input type="hidden" name="frontend_id" value="{{ $setting->id }}">
                                <td>
                                    <input type="text" name="addmore[0][name]" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Judul">

                                    @error('addmore.0.name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td> 
                                <td>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>

                                    @error('addmore.0.deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <div class="custom-file">
                                        <input type="file" name="addmore[0][file]" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        @error('addmore.0.file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </td>  
                                <td>
                                    <div class="form-group clearfix @error('status') is-invalid @enderror">
                                        <div class="icheck-primary">
                                            <input type="radio" id="selectbahanTM1" name="addmore[0][status]" value="aktif" checked>
                                            <label for="selectbahanTM1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="selectbahanTM2" name="addmore[0][status]" value="nonaktif">
                                            <label for="selectbahanTM2">
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
                                    <button type="button" name="add" id="addSlider" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </td>  
                            </tr>  
                        </table> 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Table Bahan TM -->
        <table id="sliderTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($banners as $key=>$banner)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->deskripsi }}</td>
                    <td>
                        @if($banner->status == "aktif")
                            <span class="badge badge-pill badge-info">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('slider.show', $banner->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('slider.edit', $banner->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('slider.destroy', $banner->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

@push('jsSlider')
    <script>
        // DataTable
        $("#sliderTable").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        

        // Multi Record
            // Hide/Show Multi Record
            $("#MultiSliderRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultiSliderRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addSlider").click(function(){
                ++i;
                $("#SliderMultiTable").append(
                    '<tr>'+
                        '<td>'+
                            '<div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">'+
                                '<input type="text" name="addmore['+i+'][name]" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Judul">'+
                                '@error('addmore.[+i+].name')'+
                                    '<span class="invalid-feedback" role="alert">'+
                                        '<strong>{{ $message }}</strong>'+
                                    '</span>'+
                                '@enderror'+
                            '</div>'+
                        '</td>'+
                        '<td><textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore['+i+'][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>'+
                            '@error('addmore.[+i+].deskripsi')'+
                                '<span class="invalid-feedback" role="alert">'+
                                    '<strong>{{ $message }}</strong>'+
                                '</span>'+
                            '@enderror'+
                        '</td>'+
                        '<td>'+
                            '<div class="custom-file">'+
                                '<input type="file" name="addmore['+i+'][file]" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">'+
                                '<label class="custom-file-label" for="customFile">Choose file</label>'+
                                '@error('addmore.0.file')'+
                                    '<span class="invalid-feedback" role="alert">'+
                                        '<strong>{{ $message }}</strong>'+
                                    '</span>'+
                                '@enderror'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="form-group @error('status') is-invalid @enderror">'+
                                '<div class="icheck-primary">'+
                                    '<input type="radio" id="aktif['+i+']" name="addmore['+i+'][status]" value="aktif" checked>'+
                                    '<label for="aktif['+i+']">Aktif</label>'+
                                '</div>'+
                                '<div class="icheck-danger">'+
                                    '<input type="radio" id="nonaktif['+i+']" name="addmore['+i+'][status]" value="nonaktif">'+
                                    '<label for="nonaktif['+i+']">Non Aktif</label>'+
                                '</div>'+
                                        
                                '@error('addmore.[+i+].status')'+
                                    '<span class="invalid-feedback" role="alert">'+
                                        '<strong>{{ $message }}</strong>'+
                                    '</span>'+
                                '@enderror'+
                            '</div>'+
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