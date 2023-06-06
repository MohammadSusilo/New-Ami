    <!-- <a href="{{ route('slider.create')}}" class="btn btn-app">
      <i class="fas fa-plus"></i> New
    </a> -->
    <a href="#" id="MultiFAQsRecordplus" class="btn btn-app">
      <i class="fas fa-plus"></i> New Multiple
    </a>

    <!-- Multi Record FAQs -->
    <div class="row">
        <div class="col-12" id="MultiFAQsRecord" style="display: none">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Multiple FAQs</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form method="POST" action="{{ route('faqs.saveMulti') }}" enctype="multipart/form-data">
                    @csrf
                        <table class="table table-bordered table-striped" id="FAQsMultiTable">  
                            <tr>
                                <th class="required">Judul</th>
                                <th>Deskripsi</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addmore[0][subjek]" value="{{ old('subjek') }}" class="form-control @error('subjek') is-invalid @enderror" placeholder="Enter Judul">

                                    @error('addmore.0.subjek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td> 
                                <td>
                                    <textarea class="form-control @error('uraian') is-invalid @enderror" rows="3" name="addmore[0][uraian]" placeholder="Enter Uraian">{{ old('uraian') }}</textarea>

                                    @error('addmore.0.uraian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>  
                                <td>
                                    <input type="number" name="addmore[0][urutan]" value="{{ old('urutan') }}" class="form-control @error('urutan') is-invalid @enderror" placeholder="Enter Urutan">

                                    @error('addmore.0.urutan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <button type="button" name="add" id="addFAQs" class="btn btn-success"><i class="fas fa-plus"></i></button>
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
        <table id="FAQsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($faqs as $key=>$faq)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $faq->subjek }}</td>
                    <td>{{ $faq->uraian }}</td>
                    <td>{{ $faq->urutan }}</td>
                    <td>
                        @if($faq->status == "aktif")
                            <span class="badge badge-pill badge-info">Aktif</span>
                        @else
                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('faqs.show', $faq->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                            </div>
                            @if(auth()->user()->role_id == 1)
                            <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('faqs.edit', $faq->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                            </div>
                            <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="is-inline">
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

@push('jsFAQs')
    <script>
        // DataTable
        $("#FAQsTable").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        

        // Multi Record
            // Hide/Show Multi Record
            $("#MultiFAQsRecordplus").click(function(){
                // show hide paragraph on button click
                $("#MultiFAQsRecord").toggle("slow", function(){});
            });
        
            // Add Row Multi Record
            var i = 0;
            $("#addFAQs").click(function(){
                ++i;
                $("#FAQsMultiTable").append(
                    '<tr>'+
                        '<td>'+
                            '<div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">'+
                                '<input type="text" name="addmore['+i+'][subjek]" class="form-control @error('subjek') is-invalid @enderror" placeholder="Enter Judul">'+
                                '@error('addmore.[+i+].subjek')'+
                                    '<span class="invalid-feedback" role="alert">'+
                                        '<strong>{{ $message }}</strong>'+
                                    '</span>'+
                                '@enderror'+
                            '</div>'+
                        '</td>'+
                        '<td><textarea class="form-control @error('uraian') is-invalid @enderror" rows="3" name="addmore['+i+'][uraian]" placeholder="Enter Uraian">{{ old('uraian') }}</textarea>'+
                            '@error('addmore.[+i+].uraian')'+
                                '<span class="invalid-feedback" role="alert">'+
                                    '<strong>{{ $message }}</strong>'+
                                '</span>'+
                            '@enderror'+
                        '</td>'+
                        '<td>'+
                            '<div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">'+
                                '<input type="number" name="addmore['+i+'][urutan]" class="form-control @error('urutan') is-invalid @enderror" placeholder="Enter Urutan">'+
                                '@error('addmore.[+i+].urutan')'+
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