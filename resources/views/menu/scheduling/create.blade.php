@extends('layouts.myapp')
@section('title', 'Scheduling ~ Create')

@push('css')
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
            <h1>New Schedulling</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">Schedulling</a></li>
              <li class="breadcrumb-item active">New Schedulling</li>
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
      <form method="POST" action="{{ route('scheduling.store') }}">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Scheduling</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Periode</label>
                      {{-- <input type="text"  id="rangedate" name="tahun" value="{{ old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror"> --}}
                      <div class="row">
                        <div class="col-6">
                          <input type="text"  id="input1" name="from" value="{{ old('from') }}" class="form-control @error('from') is-invalid @enderror" placeholder="Enter Tahun Mulai" autofocus>
                        </div>
                        
                        <div class="col-6">
                          <input type="text"  id="input2" name="to" value="{{ old('to') }}" class="form-control @error('to') is-invalid @enderror" placeholder="Enter Tahun Selesai">
                        </div>
                      </div>

                      @error('from')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      @error('to')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> -->
                  <!-- <div class="form-group">  
                    <label for="exampleInputEmail1" class="required">Tahun Audit</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">

                    @error('tahun')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tanggal Audit</label>
                      <input type="text"  id="datepicker1" name="tglAudit" value="{{ old('tglAudit') }}" class="form-control @error('tglAudit') is-invalid @enderror" placeholder="Enter Tanggal">

                        @error('tglAudit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Waktu Audit</label>
                      {{-- <input type="text"  id="datepicker2" name="waktu" value="{{ old('waktu') }}" class="form-control timepicker @error('waktu') is-invalid @enderror"> --}}
                      <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true"><input type="text" name="waktu" value="{{ old('waktu') }}" class="form-control @error('waktu') is-invalid @enderror" placeholder="Enter Waktu"></div>

                        @error('waktu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div> -->
                  <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="required">Tanggal Mulai Audit</label>
                            <input type="text" name="startDate" class="form-control dateAll @error('startDate') is-invalid @enderror" placeholder="Enter Tanggal Mulai Audit" autocomplete="off">

                            @error('addmore.0.startDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="required">Waktu Mulai Audit</label>
                            <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                <input type="text" name="startTime" class="form-control @error('startTime') is-invalid @enderror" placeholder="Enter Waktu Mulai Audit" autocomplete="off">

                                    @error('addmore.0.startTime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleInputEmail1" class="required">Tanggal Selesai Audit</label>
                                <input type="text" name="finishDate" class="form-control dateAll @error('finishDate') is-invalid @enderror" placeholder="Enter Tanggal Selesai Audit" autocomplete="off">

                                @error('addmore.0.finishDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="exampleInputEmail1" class="required">Waktu Selesai Audit</label>
                                <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                                  <input type="text" name="finishTime" class="form-control @error('finishTime') is-invalid @enderror" placeholder="Enter Waktu Selesai Audit" autocomplete="off">

                                  @error('addmore.0.finishTime')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Unit Kerja</label>
                      <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="unitkerja_id" style="width: 100%;">
                        <option disabled selected="selected">Pilih Unit Kerja...</option>
                        @foreach($unitKerja as $UK)
                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                        @endforeach
                      </select>
                      
                      @error('unitkerja_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <!-- @if(auth()->user()->unitkerja_id == null) -->
                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Users</label>
                    <select class="form-control select2bs4 @error('users') is-invalid @enderror" name="user_id" id="users" data-placeholder="Select a Users" style="width: 100%;">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name}}
                        </option>
                        @endforeach
                    </select>
                      
                      @error('user_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> -->
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Users</label>
                    <select class="form-control select2 @error('users') is-invalid @enderror" name="users[]" id="users" multiple="multiple" data-placeholder="Pilih Users..." style="width: 100%;">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name}}
                        </option>
                        @endforeach
                    </select>
                      
                      @error('users')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <!-- @endif -->

                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
                    <div class="icheck-success">
                      <input type="radio" id="radioPrimary1" name="status" value="aktif" checked>
                      <label for="radioPrimary1">
                        Aktif
                      </label>
                    </div>
                    <div class="icheck-danger d-inline">
                      <input type="radio" id="radioPrimary2" name="status" value="nonaktif">
                      <label for="radioPrimary2">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    
    <!-- date-range-picker -->
    {{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}

    {{-- <script src="{{ asset('plugins/timepicker/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#users').select2({
        theme: 'bootstrap4'
      })

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
        $(".dateAll").datepicker({
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