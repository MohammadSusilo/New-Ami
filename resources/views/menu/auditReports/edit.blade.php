@extends('layouts.myapp')
@section('title', 'Laporan Audit ~ Edit')

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
            <h1>Ubah Laporan Audit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">AMI</li>
              <li class="breadcrumb-item">Laporan Audit</li>
              <li class="breadcrumb-item active">Ubah Laporan Audit</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url('AMI') }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('auditReports.update', $auditReports->id) }}">
      @csrf
      @method('PUT')
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
                            <label for="exampleInputPassword1">Jadwal Periode Audit</label>
                            @if(auth()->user()->role_id == 1)
                            <select class="form-control select2bs4 @error('audit_id') is-invalid @enderror" name="audit_id" id="audit_id" data-placeholder="Select a Users" style="width: 100%;">(()
                              @foreach($audits as $audit)
                                <option value="{{ $auditReports->audit_id }}">
                                  Periode: {{ $audit->periode }} ({{ $audit->tahun }}) - @foreach($unitKerja as $UK) @if($UK->id == $audit->unitkerja_id) {{ $UK->name }} @endif @endforeach
                                </option>
                                <!-- <option 
                                    value="{{$audit->id}}"
                                    @if ($audit->id === $auditReports->audit_id)
                                        selected
                                    @endif
                                        >{{$audit->periode}}
                                </option> -->
                              @endforeach
                            </select>
                            @else
                            <input name="audit_id" type="hidden" value="{{ $auditReports->audit_id }}">
                            <select class="form-control select2bs4 @error('audit_id') is-invalid @enderror" disabled data-placeholder="Select a Users" style="width: 100%;">(()
                              @foreach($audits as $audit)
                                <option value="{{ $auditReports->audit_id }}">
                                  Periode: {{ $audit->periode }} ({{ $audit->tahun }}) - @foreach($unitKerja as $UK) @if($UK->id == $auditReports->jadwalAudit->unitkerja_id ) {{ $UK->name }} @endif @endforeach
                                </option>
                                <!-- <option 
                                    value="{{$audit->id}}"
                                    @if ($audit->id === $auditReports->audit_id)
                                        selected
                                    @endif
                                        >{{$audit->periode}}
                                </option> -->
                              @endforeach
                            </select>
                            @endif
                              
                              @error('audit_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Kode Standar</label>
                              <select class="form-control select2bs4 @error('standar_id') is-invalid @enderror" name="standar_id" data-placeholder="Select a Users" style="width: 100%;">
                                @foreach($standars as $value)
                                  <option 
                                      value="{{$value->id}}"
                                      @if ($value->id === $auditReports->standar_id)
                                          selected
                                      @endif
                                          > {{$value->kodeStandar}} - {{$value->namaStandar}}
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
                            <label>Kategori Temuan</label>
                            <select class="custom-select @error('kategoriTemuan') is-invalid @enderror" name="kategoriTemuan" id="kategoriTemuan">
                                @if($auditReports->kategoriTemuan == "OFI")
                                  <option value="OFI" selected>Opportunity for Improvement</option>
                                  <option value="AOC">Area of Concern</option>
                                  <option value="NC">Non-Conformity</option>
                                @elseif($auditReports->kategoriTemuan == "AOC")
                                  <option value="OFI">Opportunity for Improvement</option>
                                  <option value="AOC" selected>Area of Concern</option>
                                  <option value="NC">Non-Conformity</option>
                                @else
                                  <option value="OFI">Opportunity for Improvement</option>
                                  <option value="AOC">Area of Concern</option>
                                  <option value="NC" selected>Non-Conformity</option>
                                @endif
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
                            <label for="exampleInputEmail1">Uraian Temuan</label>
                                <!-- <textarea class="form-control @error('uraianTemuan') is-invalid @enderror" rows="3" name="uraianTemuan" placeholder="Enter Uraian Temuan">{{ $auditReports->uraianTemuan }}</textarea> -->
                                <!-- <input type="text" name="uraianTemuan" value="{{ $auditReports->uraianTemuan }}" class="form-control @error('uraianTemuan') is-invalid @enderror"  required/> -->
                                <textarea name="uraianTemuan">{{ $auditReports->uraianTemuan }}</textarea>

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
                                <!-- <textarea class="form-control @error('saranPerbaikan') is-invalid @enderror" rows="3" name="saranPerbaikan" placeholder="Enter Saran Perbaikan">{{ $auditReports->saranPerbaikan }}</textarea> -->
                                <!-- <input type="text" name="saranPerbaikan" value="{{ $auditReports->saranPerbaikan }}" class="form-control @error('saranPerbaikan') is-invalid @enderror"  required/> -->
                                <textarea name="saranPerbaikan">{{ $auditReports->saranPerbaikan }}</textarea>

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
                <button type="button" class="btn btn-primary" id="show-alert-change-box">
                    Submit
                </button>
                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateLaporanAudit" id="show-alert-change-box">-->
                <!--    Submit-->
                <!--</button>-->
              </div>

                <div class="modal fade" id="updateLaporanAudit">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Laporan Audit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Laporan Audit : {{ $auditReports->standar_id }} !!!</p>
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

    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#show-alert-change-box').click(function(event){
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: "Apakah anda akan mengubah data Laporan Audit?",
                    text: "Pastikan kembali data yang akan diubah",
                    icon: 'warning',
                    type: "warning",
                    buttons: ["Batal","Ya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
            
        });
        CKEDITOR.replace('uraianTemuan');
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['uraianTemuan'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Uraian Temuan Kosong, Tolong di Isikan' );
                e.preventDefault();
            }
        });

        CKEDITOR.replace('saranPerbaikan');
        
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renop').select2({
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