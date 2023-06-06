@extends('layouts.myapp')
@section('title', 'Menu ~ Create')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    
    <!-- daterange picker -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.css') }}"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <style>
    
    </style>
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Apps</a></li>
              <li class="breadcrumb-item"><a href="#">Menu</a></li>
              <li class="breadcrumb-item active">New Menu</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Back
            </a>
          </div>    
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Judul</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
                      
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Level</label>
                    <input type="text" name="level" class="form-control @error('level') is-invalid @enderror"/>

                      @error('level')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Master</label>
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

                      @error('master')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">URL</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"/>

                      @error('url')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="required">Icon</label>
                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"/>

                      @error('icon')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Role</label>
                      <select class="form-control select2bs4 @error('role_id') is-invalid @enderror" name="role_id[]" id="role_id" multiple="multiple" data-placeholder="Pilih Role..." style="width: 100%;">
                          @foreach ($roles as $role)
                          <option value="{{ $role->id }}">
                              {{ $role->name}}
                          </option>
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
                    <input type="text" name="sorting" class="form-control @error('sorting') is-invalid @enderror"/>

                      @error('sorting')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
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
    
    <!-- date-range-picker -->
    {{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}

    {{-- <script src="{{ asset('plugins/timepicker/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
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
        //$('.timepicker').timepicker({
        //  showInputs: false
        //});
        //$('#datepicker2').wickedpicker({twentyFour: true});
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

        //Date range picker with time picker
        $('#rangedate').daterangepicker({
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
        });

        $('#input1').datepicker({
              format: "yyyy",
              autoclose: true,
                minViewMode: "years"
        })    .on('changeDate', function(selected){
                startDate =  $("#input1").val();
                $('#to').datepicker('setStartDate', startDate);
            }); 
        ;


        $('#input2').datepicker({
              format: "yyyy",
              autoclose: true,
                minViewMode: "years"
        });
      });
    </script>

@endpush()