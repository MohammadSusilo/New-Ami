@extends('layouts.myapp')
@section('title', 'CAR Reports ~ Create')

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
            <h1>New CAR Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">CAR Reports</a></li>
              <li class="breadcrumb-item active">New CAR Reports</li>
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
      <form method="POST" action="{{ route('CarReports.store') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data CAR Reports</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <!--@if(auth()->user()->role_id == 1)-->
                  <!--<div class="form-group">-->
                  <!--  <label for="exampleInputPassword1" class="required">Unit Kerja</label>-->
                  <!--  <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" name="unitkerja_id" id="unitkerja_id" data-placeholder="Select a Users" style="width: 100%;">-->
                  <!--      <option disabled selected="selected">Pilih Unit Kerja...</option>    -->
                  <!--      @foreach ($unitkerja as $UK)-->
                  <!--        <option value="{{ $UK->id }}">-->
                  <!--            {{ $UK->name}}-->
                  <!--        </option>-->
                  <!--      @endforeach-->
                  <!--  </select>-->
                      
                  <!--    @error('unitkerja_id')-->
                  <!--        <span class="invalid-feedback" role="alert">-->
                  <!--            <strong>{{ $message }}</strong>-->
                  <!--        </span>-->
                  <!--    @enderror-->
                  <!--</div>-->
                  <!--@endif-->
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Kode Standar</label>
                    <select class="form-control select2bs4 @error('laporanaudit_id') is-invalid @enderror" name="laporanaudit_id" id="selectKodeStandar" data-placeholder="Select a Users" style="width: 100%;">
                        <option disabled selected="selected">Pilih Kode Standar...</option>
                        @if(Auth::user()->role_id == 1)
                            <?php foreach($laporanaudits as $Audits){ ?>
                                <?php foreach($Audits as $Audit){ ?>
                                    <option value="<?php echo $Audit->id; ?>">
                                        @foreach($standars as $value)
                                            @if($value->id == $Audit->standar_id)
                                                <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                            @endif
                                        @endforeach
                                        |  
                                        @foreach($unitkerja as $UK)
                                            @if($UK->id == $Audit->unitkerja_id)
                                                {{ $UK->name }}
                                            @endif
                                        @endforeach
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        @else
                            <?php foreach($laporanaudits as $Audits){ ?>
                                <?php foreach($Audits as $Audit){ ?>
                                    <option value="<?php echo $Audit->id; ?>">
                                        @foreach($standars as $value)
                                            @if($value->id == $Audit->standar_id)
                                                <?php echo $value->kodeStandar; ?> - <?php echo $value->namaStandar; ?>
                                            @endif
                                        @endforeach
                                        | 
                                        @foreach($unitkerja as $UK)
                                            @if($UK->id == $Audit->unitkerja_id)
                                                {{ $UK->name }}
                                            @endif
                                        @endforeach
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        @endif
                    </select>
                      
                      @error('laporanaudit_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div id="read"></div>
                  @if(auth()->user()->role_id == 1)
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Analisis Penyebab Masalah</label>
                      <textarea class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror" rows="3" name="analisiPenyebabMasalah" placeholder="Enter Analisis Penyebab Masalah">{{ old('analisiPenyebabMasalah') }}</textarea>
                      <!-- <input type="text"  id="analisiPenyebabMasalah" name="analisiPenyebabMasalah" value="{{ old('analisiPenyebabMasalah') }}" class="form-control @error('analisiPenyebabMasalah') is-invalid @enderror"  required/> -->

                      @error('analisiPenyebabMasalah')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tindakan Penyelesaian</label>
                      <textarea class="form-control @error('tindakanPenyelesaian') is-invalid @enderror" rows="3" name="tindakanPenyelesaian" placeholder="Masukkan Tindakan Penyelesaian">{{ old('tindakanPenyelesaian') }}</textarea>
                      <!-- <input type="text"  id="tindakanPenyelesaian" name="tindakanPenyelesaian" value="{{ old('tindakanPenyelesaian') }}" class="form-control @error('tindakanPenyelesaian') is-invalid @enderror"  required/> -->

                      @error('tindakanPenyelesaian')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tindakan Pencegahan</label>
                      <textarea class="form-control @error('tindakanPencegahan') is-invalid @enderror" rows="3" name="tindakanPencegahan" placeholder="Masukkan Tindakan Pencegahan">{{ old('tindakanPencegahan') }}</textarea>
                      <!-- <input type="text"  id="tindakanPencegahan" name="tindakanPencegahan" value="{{ old('tindakanPencegahan') }}" class="form-control @error('tindakanPencegahan') is-invalid @enderror"  required/> -->

                      @error('tindakanPencegahan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  @endif
                      <div class="form-group">
                        <!--<label for="exampleInputEmail1">Hasil Pemeriksaan</label>-->
                        <!--  <textarea id="hasilPemeriksaan" name="hasilPemeriksaan" value="{{ old('hasilPemeriksaan') }}" class="form-control @error('hasilPemeriksaan') is-invalid @enderror" placeholder="Enter Hasil Pemeriksaan">{{ old('hasilPemeriksaan') }}</textarea>-->
    
                        <!--  @error('hasilPemeriksaan')-->
                        <!--      <span class="invalid-feedback" role="alert">-->
                        <!--          <strong>{{ $message }}</strong>-->
                        <!--      </span>-->
                        <!--  @enderror-->
                        <label>Hasil Pemeriksaan</label>
                        <div class="icheck-success">
                          <input type="radio" id="radioPrimary1" name="hasilPemeriksaan" value="sesuai">
                          <label for="radioPrimary1">
                            Sesuai
                          </label>
                        </div>
                        <div class="icheck-danger">
                          <input type="radio" id="radioPrimary2" name="hasilPemeriksaan" value="nonsesuai" checked>
                          <label for="radioPrimary2">
                            Tidak Sesuai
                          </label>
                        </div>
                          
                          @error('hasilPemeriksaan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Rekomendasi</label>
                          <textarea id="rekomendasi" name="rekomendasi" rows="3" class="form-control @error('rekomendasi') is-invalid @enderror" placeholder="Masukkan Rekomendasi">{{ old('rekomendasi') }}</textarea>
    
                          @error('rekomendasi')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  @if(auth()->user()->role_id == 1)
                  <label class="requiredfile">File Bukti Dukung</label>
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    @error('file')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  @endif
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Pemeriksaan</label>
                      <input type="text"  id="hasilPemeriksaan" name="hasilPemeriksaan" value="{{ old('hasilPemeriksaan') }}" class="form-control @error('hasilPemeriksaan') is-invalid @enderror"  required/>

                      @error('hasilPemeriksaan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Rekomendasi</label>
                      <input type="text"  id="rekomendasi" name="rekomendasi" value="{{ old('rekomendasi') }}" class="form-control @error('rekomendasi') is-invalid @enderror"  required/>

                      @error('rekomendasi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> -->
                  <!-- <div class="form-group">
                    <label>Status</label>
                    <select class="custom-select @error('status') is-invalid @enderror" name="status"  name="status" id="status">
                        <option>Select Status...</option>
                        <option value="open">Sesuai</option>
                        <option value="nonsesuai">Tidak Sesuai</option>
                    </select>
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div> -->
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

      $(document).ready(function(){
        $("#selectKodeStandar").change(function(){
            var strcari = $("#selectKodeStandar").val();
            console.log(strcari);
            if(strcari !=""){
                $("#read").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
                $.ajax({
                    url : "{{ url('CARget') }}",
                    type : "get",
                    data : "name=" + strcari,
                    success: function(data)
                    {
                        console.log(data);
                        $("#read").html(data);
                    }
                });
            }
        });
      });

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