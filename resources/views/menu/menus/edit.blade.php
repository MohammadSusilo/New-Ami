@extends('layouts.myapp')
@section('title', 'Menu ~ Edit')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Apps</li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">Ubah Menu</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label class="required">Judul</label>
                    <input type="text" name="name" value="{{ $menu->name }}" class="form-control @error('name') is-invalid @enderror"/>

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Level</label>
                    <input type="text" name="level" value="{{ $menu->level }}" class="form-control @error('level') is-invalid @enderror"/>

                      @error('level')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Master</label>
                    @if($menu->master == "0")
                      <div class="icheck-primary">
                        <input type="radio" id="radioPrimary1" name="master" value="0" checked>
                        <label for="radioPrimary1">
                          Main Menu
                        </label>
                      </div>
                      <div class="icheck-info d-inline">
                        <input type="radio" id="radioPrimary2" name="master" value="1">
                        <label for="radioPrimary2">
                          Sub Main Menu
                        </label>
                      </div>
                    @else
                      <div class="icheck-primary">
                        <input type="radio" id="radioPrimary1" name="master" value="0">
                        <label for="radioPrimary1">
                          Main Menu
                        </label>
                      </div>
                      <div class="icheck-info d-inline">
                        <input type="radio" id="radioPrimary2" name="master" value="1" checked>
                        <label for="radioPrimary2">
                          Sub Main Menu
                        </label>
                      </div>
                    @endif

                      @error('master')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">URL</label>
                    <input type="text" name="url" value="{{ $menu->url }}" class="form-control @error('url') is-invalid @enderror"/>

                      @error('url')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Icon</label>
                    <input type="text" name="icon" value="{{ $menu->icon }}" class="form-control @error('icon') is-invalid @enderror"/>

                      @error('icon')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Role</label>

                      <select class="form-control select2bs4 @error('role_id') is-invalid @enderror" name="role_id[]" id="role_id" multiple="multiple" data-placeholder="Select a Users" style="width: 100%;">

                        @foreach($roles as $key=>$role)
                          <option {{ in_array($role->id, $tes) ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                      </select>

                        @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Sorting</label>
                    <input type="text" name="sorting" value="{{ $menu->sorting }}" class="form-control @error('sorting') is-invalid @enderror"/>

                      @error('sorting')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
                      @if($menu->status == "aktif")
                        <div class="icheck-primary">
                          <input type="radio" id="radioPrimary3" name="status" value="aktif" checked>
                          <label for="radioPrimary3">
                          Aktif
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" id="radioPrimary4" name="status" value="nonaktif">
                          <label for="radioPrimary4">
                            Tidak Aktif
                          </label>
                        </div>
                      @else
                        <div class="icheck-primary">
                          <input type="radio" id="radioPrimary3" name="status" value="aktif">
                          <label for="radioPrimary3">
                          Aktif
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" id="radioPrimary4" name="status" value="nonaktif" checked>
                          <label for="radioPrimary4">
                            Tidak Aktif
                          </label>
                        </div>
                      @endif
                    
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </form>
        <!-- form finish -->
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renstra').select2({
        theme: 'bootstrap4'
      })
      
      bsCustomFileInput.init();

      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
        
        $("#datepicker1").datepicker({
            format: "yyyy-mm-dd",
            viewMode: "date", 
            minViewMode: "date"
        });

        $('.timepicker').clockpicker()
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
    </script>

@endpush()