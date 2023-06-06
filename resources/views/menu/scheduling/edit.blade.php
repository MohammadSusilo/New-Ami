@extends('layouts.myapp')
@section('title', 'Jadwal Audit ~ Edit')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <!-- daterange picker -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.css') }}"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Jadwal Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">Jadwal Audit</li>
              <li class="breadcrumb-item active">Ubah Jadwal Audit</li>
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
      <form method="POST" action="{{ route('scheduling.update', $scheduling->id) }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Jadwal Audit</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleInputEmail1">Periode</label>
                                <input type="text" name="periode" value="{{ $scheduling->periode }}" class="form-control @error('$periode') is-invalid @enderror">
                            </div>
    
                                @error('periode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="col-6">
                                <label for="exampleInputEmail1">Tahun Audit</label>
                                <input type="text"  id="datepicker" name="tahun" value="{{ $scheduling->tahun }}" class="form-control @error('tahun') is-invalid @enderror">
                            </div>
                            
                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                  </div>
                  @php 
                    $date = explode("#", $scheduling->tglAudit);
                    $time = explode("#", $scheduling->waktu);
                  @endphp
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label for="exampleInputEmail1">Tanggal Mulai Audit</label>
                        <input type="text" name="startDate" value="{{ $date[0] }}" class="form-control dateAll @error('startDate') is-invalid @enderror">

                          @error('startDate')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-6">
                        <label for="exampleInputEmail1">Waktu Mulai Audit</label>
                        <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                          <input type="text" name="startTime" value="{{ $time[0] }}" class="form-control @error('startTime') is-invalid @enderror">
                        </div>

                          @error('startTime')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label for="exampleInputEmail1">Tanggal Selesai Audit</label>
                        <input type="text" name="finishDate" value="{{ $date[1] }}" class="form-control dateAll @error('finishDate') is-invalid @enderror">

                          @error('finishDate')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-6">
                        <label for="exampleInputEmail1">Waktu  Selesai Audit</label>
                        <div class="input-group timepicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                          <input type="text" name="finishTime" value="{{ $time[1] }}" class="form-control @error('finishTime') is-invalid @enderror">
                        </div>

                          @error('finishTime')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Unit Kerja</label>
                    <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" name="unitkerja_id" id="unitkerja_id" data-placeholder="Select a Users" style="width: 100%;">
                      @foreach($unitKerja as $UK)
                        <option 
                            value="{{$UK->id}}"
                            @if ($UK->id == $scheduling->unitkerja_id)
                                selected
                            @endif
                                >{{$UK->name}}
                        </option>
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
                    <select class="form-control select2bs4 @error('users') is-invalid @enderror" name="user_id" id="4" data-placeholder="Select a Users" style="width: 100%;">
                      @foreach($users as $user)
                        <option 
                            value="{{$user->id}}"
                            @if ($user->id === $scheduling->user_id)
                                selected
                            @endif
                                >{{$user->name}}
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
                    <label for="exampleInputPassword1">Auditor</label>
                    <select class="select2 @error('users') is-invalid @enderror" name="users[]" id="users" multiple="multiple" data-placeholder="Pilih User..." style="width: 100%;">
                        @foreach($users as $user)
                          <option {{ in_array($user->id, $send) ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
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
                    @if($scheduling->status == "aktif")
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
                    @else
                    <div class="icheck-success">
                      <input type="radio" id="radioPrimary1" name="status" value="aktif">
                      <label for="radioPrimary1">
                        Aktif
                      </label>
                    </div>
                    <div class="icheck-danger d-inline">
                      <input type="radio" id="radioPrimary2" name="status" value="nonaktif" checked>
                      <label for="radioPrimary2">
                        Tidak Aktif
                      </label>
                    </div>
                    @endif

                  <!-- <div class="form-group">
                    <label>Status</label>
                    <select class="custom-select @error('status') is-invalid @enderror" name="status""  name="status" id="status">
                        @if($scheduling->status == "aktif")
                          <option value="aktif">Aktif</option>
                        @else
                          <option value="nonaktif">Non Aktif</option>
                        @endif
                    </select> -->
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateJadwalAudit">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateJadwalAudit">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Jadwal Audit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Jadwal Audit : {{ $scheduling->periode }} ({{ $scheduling->tahun }}) !!!</p>
                        <center>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-success">Iya</button>
                        </center>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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