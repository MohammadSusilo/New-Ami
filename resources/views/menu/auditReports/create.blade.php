@extends('layouts.myapp')
@section('title', 'Laporan Audit ~ Create')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    
    <!-- daterange picker -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
    {{-- <script src="{{ asset('plugins/wickedpicker/wickedpicker.min.css') }}"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
@endpush()

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Audit Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">Laporan Audit</a></li>
              <li class="breadcrumb-item active">New Laporan Audit</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url('AMI') }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('auditReports.store') }}">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Laporan Audit</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputPassword1" class="required">Jadwal Periode Audit</label>
                                <?php if(Auth::user()->role_id == 1){ ?>
                                    <select class="form-control select2bs4 @error('audit_id') is-invalid @enderror" name="audit_id" id="audit_id" style="width: 100%;" required>
                                        <option disabled selected="selected" value="">Pilih Periode Audit...</option>
                                        <?php foreach($jadwalaudits as $audit){ ?>
                                            <option {{(old('audit_id') == $audit->id?'selected':'')}} value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                        <?php } ?>
                                    </select>
        
                                    @error('audit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <?php }else{ ?>
                                    <select class="form-control select2bs4 @error('audit_id') is-invalid @enderror" name="audit_id" id="audit_id" style="width: 100%;" required>
                                        <option selected="selected" disabled value="">Pilih Periode Audit...</option>
                                        <?php foreach($jadwalaudits as $key=>$audits){ ?>
                                            <?php foreach($audits as $audit){ ?>
                                                    <option {{(old('audit_id') == $audit->id?'selected':'')}} value="<?php echo $audit->id; ?>">Periode: <?php echo $audit->periode;?> (<?php echo $audit->tahun;?>) - <?php foreach($unitKerja as $UK){ if($UK->id == $audit->unitkerja_id){ echo $UK->name; } } ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
        
                                    @error('audit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <?php } ?>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Kode Standar</label>
                              <select class="form-control select2bs4 @error('standar_id') is-invalid @enderror" name="standar_id" style="width: 100%;" required>
                                  <option selected="selected" disabled value="">Pilih Kode Standar...</option>
                                  @foreach($standars as $value)
                                      <option {{(old('standar_id') == $value->id?'selected':'')}} value="<?php echo $value->id; ?>">
                                      {{ $value->kodeStandar }} - {{ $value->namaStandar }}
                                      </option>
                                  @endforeach
                              </select>

                              @error('standar_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label class="required">Kategori Temuan</label>
                            <select class="custom-select @error('kategoriTemuan') is-invalid @enderror" name="kategoriTemuan" placeholder="Enter Uraian Temuan" id="kategoriTemuan" required>
                                <option disabled selected="selected" value="">Select Kategori...</option>
                                <option value="OFI">Opportunity for Improvement</option>
                                <option value="AOC">Area of Concern</option>
                                <option value="NC">Non-Conformity</option>
                            </select>
                              
                              @error('kategoriTemuan')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Uraian Temuan</label>
                                <!-- <textarea class="form-control @error('uraianTemuan') is-invalid @enderror" rows="4" name="uraianTemuan" placeholder="Enter Uraian Temuan" required>{{ old('uraianTemuan') }}</textarea> -->
                                <textarea name="uraianTemuan"></textarea>
        
                                @error('uraianTemuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Saran Perbaikan</label>
                                <!-- <textarea class="form-control @error('saranPerbaikan') is-invalid @enderror" rows="4" name="saranPerbaikan" placeholder="Enter Saran Perbaikan">{{ old('saranPerbaikan') }}</textarea> -->
                                <textarea name="saranPerbaikan"></textarea>
        
                                @error('saranPerbaikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
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
        CKEDITOR.replace('uraianTemuan');
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['uraianTemuan'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Uraian Temuan Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });

        CKEDITOR.replace('saranPerbaikan');
        // Summernote
        $('#summernote_uraianTemuan').summernote({
            placeholder: 'Enter Uraian Temuan',
            tabsize: 2,
            height: 100
          });
        $('#summernote_saranPerbaikan').summernote({
            placeholder: 'Enter Saran Perbaikan',
            tabsize: 2,
            height: 100
          });
    
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renstra').select2({
        theme: 'bootstrap4'
      })

      $(function () {
        var kategoriTemuan = $('#kategoriTemuan > option[value={{ Request::old('kategoriTemuan') }}]');

        if (kategoriTemuan.length > 0) {
            kategoriTemuan.attr('selected', 'selected');
        }
        
        var audit_id = $('#audit_id > option[value={{ Request::old('audit_id') }}]');

        if (audit_id.length > 0) {
            audit_id.attr('selected', 'selected');
        }

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