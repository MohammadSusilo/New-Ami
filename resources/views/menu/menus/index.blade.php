@extends('layouts.myapp')
@section('title', 'Menu')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Apps</li>
              <li class="breadcrumb-item active">Menu</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ route('menu.create')}}" class="btn btn-app">
              <i class="fas fa-plus"></i> New
            </a>
            <a href="#" id="MenuRecordplus" class="btn btn-app">
              <i class="fas fa-plus"></i> New Multiple
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Multi Record Menu -->
        <div class="row">
            <div class="col-12" id="MenuRecord" style="display: none">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Add Multiple Menu</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <form method="POST" action="{{ route('menu.saveMulti') }}" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-bordered table-striped" id="MenuMultiTable">  
                                <tr>
                                  <th class="required">Judul</th>
                                  <th class="required">Level</th>
                                  <th class="required">Master</th>
                                  <th class="required">URL</th>
                                  <th class="required">Icon</th>
                                  <th class="required">Role</th>
                                  <th class="required">sorting</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                <tr>
                                  <td>
                                      <input type="text" name="addmore[0][name]" class="form-control @error('name') is-invalid @enderror"/>

                                      @error('addmore.0.name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <input type="text" name="addmore[0][level]" class="form-control @error('level') is-invalid @enderror"/>

                                      @error('addmore.0.level')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <div class="icheck-primary">
                                        <input type="radio" id="selecthasiTM1" name="addmore[0][master]" value="0" checked>
                                        <label for="selecthasiTM1">
                                          Main Menu
                                        </label>
                                      </div>
                                      <div class="icheck-info d-inline">
                                        <input type="radio" id="selecthasiTM2" name="addmore[0][master]" value="1">
                                        <label for="selecthasiTM2">
                                          Sub Main Menu
                                        </label>
                                      </div>

                                      @error('addmore.0.master')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <input type="text" name="addmore[0][url]" class="form-control @error('url') is-invalid @enderror"/>

                                      @error('addmore.0.url')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <input type="text" name="addmore[0][icon]" class="form-control @error('icon') is-invalid @enderror"/>

                                      @error('addmore.0.icon')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <select class="form-control select2bs4 @error('role_id') is-invalid @enderror" name="addmore[0][role_id][]" id="selectPIC[0]" multiple="multiple" data-placeholder="Pilih role_id..." style="width: 100%;">
                                          @foreach ($roles as $role)
                                          <option value="{{ $role->id }}">
                                              {{ $role->name}}
                                          </option>
                                          @endforeach
                                      </select>

                                      @error('addmore.0.role_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <input type="text" name="addmore[0][sorting]" class="form-control @error('sorting') is-invalid @enderror"/>

                                      @error('addmore.0.sorting')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </td>
                                  <td>
                                      <div class="form-group clearfix @error('status') is-invalid @enderror">
                                          <div class="icheck-primary">
                                              <input type="radio" id="selecthasiTM3" name="addmore[0][status]" value="aktif" checked>
                                              <label for="selecthasiTM3">
                                                  Aktif
                                              </label>
                                          </div>
                                          <div class="icheck-danger d-inline">
                                              <input type="radio" id="selecthasiTM4" name="addmore[0][status]" value="nonaktif">
                                              <label for="selecthasiTM4">
                                                  Tidak Aktif
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
                                      <button type="button" name="add" id="addMenu" class="btn btn-success"><i class="fas fa-plus"></i></button>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="MenuTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Level</th>
                    <th>Url</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                       @foreach($menus as $key=>$menu) 
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{$menu->name}}</td> 
                          <td>{{$menu->level}}</td> 
                          <td>{{$menu->url}}</td>
                          <td>
                            @foreach($roles as $role)
                                @foreach(explode(',', $menu->role_id) as $info) 
                                    @if($role->id == $info )    
                                        <span class="badge badge-pill badge-primary">{{$role->name}}</span>
                                    @endif
                                @endforeach
                            @endforeach
                          </td>
                          <td>
                              @if($menu->status == "aktif")
                                  <span class="badge badge-pill badge-info">Aktif</span>
                              @else
                                  <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                              @endif
                          </td>
                          <td>
                            <div class="btn-group">
                                <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('menu.show', $menu->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('menu.edit', $menu->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="is-inline">
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

    <!--This page plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
      $(function () {
        $("#MenuTable").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      // Multi Record
        // Hide/Show Multi Record
        $("#MenuRecordplus").click(function(){
            // show hide paragraph on button click
            $("#MenuRecord").toggle("slow", function(){});
        });


        // Add Row Multi Record
        var i = 0;
        $("#addMenu").click(function(){
            ++i;
            $("#MenuMultiTable").append(
                '<tr>'+
                  '<td>'+
                      '<input type="text" name="addmore['+i+'][name]" class="form-control @error('name') is-invalid @enderror"/>'+

                      '@error('addmore.[+i+].name')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<input type="text" name="addmore['+i+'][level]" class="form-control @error('level') is-invalid @enderror"/>'+

                      '@error('addmore.[+i+].level')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<div class="icheck-primary">'+
                        '<input type="radio" id="main['+i+']" name="addmore['+i+'][master]" value="0" checked>'+
                        '<label for="main['+i+']">'+
                          'Main Menu'+
                        '</label>'+
                      '</div>'+
                      '<div class="icheck-info d-inline">'+
                        '<input type="radio" id="subMain['+i+']" name="addmore['+i+'][master]" value="1">'+
                        '<label for="subMain['+i+']">'+
                          'Sub Main Menu'+
                        '</label>'+
                      '</div>'+

                      '@error('addmore.[+i+].master')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<input type="text" name="addmore['+i+'][url]" class="form-control @error('url') is-invalid @enderror"/>'+

                      '@error('addmore.[+i+].url')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<input type="text" name="addmore['+i+'][icon]" class="form-control @error('icon') is-invalid @enderror"/>'+

                      '@error('addmore.[+i+].icon')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<select class="form-control select2bs4 @error('role_id') is-invalid @enderror" name="addmore['+i+'][role_id][]" id="selectPIC['+i+']" multiple="multiple" data-placeholder="Pilih role_id..." style="width: 100%;">'+
                          '@foreach ($roles as $role)'+
                          '<option value="{{ $role->id }}">'+
                              '{{ $role->name}}'+
                          '</option>'+
                          '@endforeach'+
                      '</select>'+

                      '@error('addmore.[+i+].role_id')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<input type="text" name="addmore['+i+'][sorting]" class="form-control @error('sorting') is-invalid @enderror"/>'+

                      '@error('addmore.[+i+].sorting')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<div class="form-group clearfix @error('status') is-invalid @enderror">'+
                          '<div class="icheck-primary">'+
                              '<input type="radio" id="aktif['+i+']" name="addmore['+i+'][status]" value="aktif" checked>'+
                              '<label for="aktif['+i+']">'+
                                  'Aktif'+
                              '</label>'+
                          '</div>'+
                          '<div class="icheck-danger d-inline">'+
                              '<input type="radio" id="nonAktif['+i+']" name="addmore['+i+'][status]" value="nonaktif">'+
                              '<label for="nonAktif['+i+']">'+
                                  'Tidak Aktif'+
                              '</label>'+
                          '</div>'+
                      '</div>'+
                      '@error('addmore.[+i+].status')'+
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

@endpush()