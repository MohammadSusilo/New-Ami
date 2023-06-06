@extends('layouts.myapp')
@section('title', 'Pengguna')

@push('css')

@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ route('users.create')}}" class="btn btn-app">
              <i class="fas fa-plus"></i> New
            </a>
            <!-- <a href="#" id="UsersRecordplus" class="btn btn-app">
              <i class="fas fa-plus"></i> New Multiple
            </a> -->
            <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalUsers">
                <i class="fas fa-plus"></i> New Multiple
            </button>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Multi Record Users -->
      <div class="modal fade" id="modalUsers">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Multiple CAR Reports</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('users.saveMulti') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">                      
                        <div class="card-body" id="UsersMultiTable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-default" id="cols">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="addmore[0][name]" value="{{ old('name') }}" autofocus placeholder="Enter Nama">
                                                        @error('addmore[0][laporanaudit_id]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Email</label></br>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="addmore[0][email]" value="{{ old('email') }}" placeholder="Enter Email">

                                                        @error('addmore[0][laporanTemuan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Roles</label>
                                                        <select class="custom-select select2bs4" name="addmore[0][role_id]" id="roles0">
                                                            <option>Pilih Roles...</option>
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('addmore[0][analisiPenyebabMasalah]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="parsingData0"></div>
                                                <div class="col-4" style="display: none;" id="is_unitKerjaPusat0">
                                                    <div class="form-group">
                                                        <label>Unit Kerja</label>
                                                        <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="addmore[0][unitkerja_id]" id="unitkerja_idPusat0" style="width: 100%;">
                                                          <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                          <option value="">Pusat/Pimpinan</option>
                                                          @foreach($unitKerja as $UK)
                                                            <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                          @endforeach
                                                        </select>

                                                        @error('addmore[0][tindakanPencegahan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>    
                                                </div>
                                                <div class="col-4" style="display: none;" id="is_unitKerja0">
                                                    <div class="form-group">
                                                        <label>Unit Kerja</label>
                                                        <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="addmore[0][unitkerja_id]" style="width: 100%;">
                                                          <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                          @foreach($unitKerja as $UK)
                                                            <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                          @endforeach
                                                        </select>

                                                        @error('addmore[0][tindakanPencegahan]')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>    
                                                </div>
                                                <div class="col-4" style="display: none;" id="is_pimpinan0">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <select class="form-control select2bs4 @error('is_pimpinan') is-invalid @enderror" value="{{ old('is_pimpinan') }}" name="addmore[0][is_pimpinan]" style="width: 100%;">
                                                          <option disabled selected="selected">Pilih Jabatan...</option>
                                                          <option value="D0">Direktur</option>
                                                          <option value="WD1">Wakil Direktur 1</option>
                                                          <option value="WD2">Wakil Direktur 2</option>
                                                          <option value="WD3">Wakil Direktur 3</option>
                                                          <option value="WD4">Wakil Direktur 4</option>
                                                        </select> 

                                                        @error('addmore[0][tindakanPencegahan]')
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

                        <div class="card-footer">
                            <div class="row g-2">
                                <div class="col">
                                    <button type="button" name="add" id="addUsers" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="UsersTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Unit Kerja</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                       @foreach($users as $key=>$user) 
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{$user->name}}</td> 
                          <td>{{$user->email}}</td> 
                          @if($user->unitkerja_id != null)
                            <td>{{$user->unitKerja->name}}</td> 
                          @else
                            <td>Pusat/Pimpinan</td> 
                          @endif
                          <td>
                            @foreach ($roles as $r)
                              @if($r->id == $user->role_id)
                                    {{ $r->name}}
                              @endif
                            @endforeach
                          </td>
                          <td>
                          @php
                            $role = auth()->user()->role_id;
                            $status = auth()->user()->status;
                          @endphp
                          @if($user->role_id == 1)
                            @if($status == "nonaktif")
                                <i class="fa fa-toggle-off"></i> {{ __('Tidak Aktif') }}
                            @else
                                <i class="fa fa-toggle-on"></i> {{ __('Aktif') }}
                            @endif
                          @else
                            @php
                              $id = auth()->user()->id;
                            @endphp
                            <form method="POST" id="search{{$user->id}}" action="{{ url('userschange') }}">
                              <input name="id" type="hidden" value="{{$user->id}}">
                              @csrf
                                @if($user->status == "nonaktif")
                                    <input name="status" type="hidden" value="aktif">
                                    <a href="#" onclick="document.getElementById('search{{$user->id}}').submit();">
                                      <i class="fa fa-toggle-off"></i> {{ __('Tidak Aktif') }}
                                    </a>
                                @else
                                    <input name="status" type="hidden" value="nonaktif">
                                    <a href="#" onclick="document.getElementById('search{{$user->id}}').submit();">
                                      <i class="fa fa-toggle-on"></i> {{ __('Aktif') }}
                                    </a>
                                @endif
                            </form>

                          @endif
                          </td>
                          <td>
                            <div class="btn-group">
                                <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('users.show', $user->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('users.destroy', $user->id) }}" method="POST" class="is-inline">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <script type="text/javascript">
      $(function () {
        $('#UsersTable').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
      });

      $('.select2bs4').select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modalUsers")
      })

      // Multi Record
        // Hide/Show Multi Record
        $("#UsersRecordplus").click(function(){
            // show hide paragraph on button click
            $("#UsersRecord").toggle("slow", function(){});
        });


        // Add Row Multi Record
        var i = 0;
        $('#roles0').change(function(){
          var strcari = $('#roles0').val();
          console.log(strcari);

            if(strcari == 1){
              $('#is_pimpinan0').hide();
              $('#is_unitKerja0').hide();
              $('#is_unitKerjaPusat0').hide();
              $('#parsingData0').append('<input type="hidden" name="addmore[0][unitkerja_id]" value="" class="form-control">');
            }else if(strcari == 2 || strcari == 3){
              $('#is_unitKerja0').fadeIn();
              $('#is_unitKerjaPusat0').hide();
              $('#is_pimpinan0').hide();
            }else{
              $('#is_unitKerjaPusat0').fadeIn()
              $('#is_unitKerja0').hide();;
              $('#unitkerja_idPusat0').change(function(){
                  var strcari = $('#unitkerja_idPusat0').val();
                  console.log(strcari);
                    if(strcari !=""){
                      $('#is_pimpinan0').fadeOut();
                    }else{
                      $('#is_pimpinan0').fadeIn();
                    }
              });
            }
        });
        $("#addUsers").click(function(){
            ++i;
            let htmlUsers = `
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default" id="cols">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="addmore[`+i+`][name]" value="{{ old('name') }}" placeholder="Enter Nama">
                                                @error('addmore[0][laporanaudit_id]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Email</label></br>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="addmore[`+i+`][email]" value="{{ old('email') }}" placeholder="Enter Email">

                                                @error('addmore[0][laporanTemuan]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Roles</label>
                                                <select class="custom-select select2bs4" name="addmore[`+i+`][role_id]" id="rolesmulti`+i+`">
                                                    <option>Pilih Roles...</option>
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">
                                                        {{ $role->name}}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                @error('addmore[0][analisiPenyebabMasalah]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="parsingDatamulti`+i+`"></div>
                                        <div class="col-4" style="display: none;" id="is_unitKerjaPusatmulti`+i+`">
                                            <div class="form-group">
                                                <label>Unit Kerja</label>
                                                <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="addmore[`+i+`][unitkerja_id]" id="unitkerja_idPusatmulti`+i+`" style="width: 100%;">
                                                  <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                  <option value="">Pusat/Pimpinan</option>
                                                  @foreach($unitKerja as $UK)
                                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                  @endforeach
                                                </select>

                                                @error('addmore[0][tindakanPencegahan]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-4" style="display: none;" id="is_unitKerjamulti`+i+`">
                                            <div class="form-group">
                                                <label>Unit Kerja</label>
                                                <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="addmore[`+i+`][unitkerja_id]" style="width: 100%;">
                                                  <option disabled selected="selected">Pilih Unit Kerja...</option>
                                                  @foreach($unitKerja as $UK)
                                                    <option value="{{$UK->id}}">{{$UK->name}}</option>  
                                                  @endforeach
                                                </select>

                                                @error('addmore[0][tindakanPencegahan]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-4" style="display: none;" id="is_pimpinanmulti`+i+`">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <select class="form-control select2bs4 @error('is_pimpinan') is-invalid @enderror" value="{{ old('is_pimpinan') }}" name="addmore[`+i+`][is_pimpinan]" style="width: 100%;">
                                                  <option disabled selected="selected">Pilih Jabatan...</option>
                                                  <option value="D0">Direktur</option>
                                                  <option value="WD1">Wakil Direktur 1</option>
                                                  <option value="WD2">Wakil Direktur 2</option>
                                                  <option value="WD3">Wakil Direktur 3</option>
                                                  <option value="WD4">Wakil Direktur 4</option>
                                                </select> 

                                                @error('addmore[0][tindakanPencegahan]')
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
                `;
            $("#UsersMultiTable").append(htmlUsers);

            $('#rolesmulti'+[i]).change(function(){
              var strcari = $('#rolesmulti'+[i]).val();
              console.log(strcari);

                if(strcari == 1){
                  $('#is_pimpinanmulti'+[i]).hide();
                  $('#is_unitKerjamulti'+[i]).hide();
                  $('#is_unitKerjaPusatmulti'+[i]).hide();
                  $('#parsingDatamulti'+[i]).append('<input type="hidden" name="addmore"'+[i]+'"[unitkerja_id]" value="" class="form-control">');
                }else if(strcari == 2 || strcari == 3){
                  $('#is_unitKerjamulti'+[i]).fadeIn();
                  $('#is_unitKerjaPusatmulti'+[i]).hide();
                  $('#is_pimpinanmulti'+[i]).hide();
                }else{
                  $('#is_unitKerjaPusatmulti'+[i]).fadeIn()
                  $('#is_unitKerjamulti'+[i]).hide();;
                  $('#unitkerja_idPusatmulti'+[i]).change(function(){
                      var strcari = $('#unitkerja_idPusatmulti'+[i]).val();
                      console.log(strcari);
                        if(strcari !=""){
                          $('#is_pimpinanmulti'+[i]).fadeOut();
                        }else{
                          $('#is_pimpinanmulti'+[i]).fadeIn();
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
            $(this).parents('#cols').remove();
        });    
    </script>

@endpush()