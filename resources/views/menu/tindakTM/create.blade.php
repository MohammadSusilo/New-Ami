@extends('layouts.myapp')
@section('title', 'Tindak Lanjut TM ~ Create')

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
            <h1>New Tindak Lanjut TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">Tinjauan Manajemen</a></li>
              <li class="breadcrumb-item active">New Tindak Lanjut TM</li>
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
      <form method="POST" action="{{ route('tindakLanjutTM.store') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Tindak Lanjut TM</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Hasil TM</label>
                    <select class="form-control select2bs4 @error('hslrpt_id') is-invalid @enderror" name="hslrpt_id" id="hslrpt_id" data-placeholder="Select a Users" style="width: 100%;">
                        <option disabled selected="selected">Pilih Hasil...</option>        
                        @foreach ($hasilTM as $hasil)
                          @foreach ($unitKerja as $UK)
                            @if($UK->id == $hasil->tinjauanManajemen->jadwalAudit->unitkerja_id)
                              <option value="{{ $hasil->id }}">
                                  {{ $UK->name }} | {{ $hasil->subjek }} | {{ $hasil->hasilPembahasan }}
                              </option>
                            @endif
                          @endforeach
                        @endforeach
                    </select>
                      
                      @error('hslrpt_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tindak Lanjut</label>
                      <textarea class="form-control @error('tindakLanjut') is-invalid @enderror" rows="3" name="tindakLanjut" placeholder="Enter Tindak Lanjut">{{ old('tindakLanjut') }}</textarea>
                      <!-- <input type="text"  id="tindakLanjut" name="tindakLanjut" value="{{ old('tindakLanjut') }}" class="form-control @error('tindakLanjut') is-invalid @enderror"  required/> -->

                      @error('tindakLanjut')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">PIC</label>
                      <select class="form-control select2bs4 @error('PIC') is-invalid @enderror" name="PIC[]" id="PIC" multiple="multiple" data-placeholder="Pilih PIC..." style="width: 100%;">
                          @foreach ($users as $user)
                          <option value="{{ $user->id }}">
                              {{ $user->name}}
                          </option>
                          @endforeach
                      </select>

                      @error('PIC')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
                    <div class="icheck-success">
                      <input type="radio" id="radioPrimary1" name="status" value="selesai">
                      <label for="radioPrimary1">
                        Selesai
                      </label>
                    </div>
                    <div class="icheck-danger d-inline">
                      <input type="radio" id="radioPrimary2" name="status" value="nonselesai" checked>
                      <label for="radioPrimary2">
                        Belum Selesai
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