@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ COVER')

@push('css')
    {{-- BS-Stepper --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Date Picker -->
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
            <h1>LAM TEKNIK - COVER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item active">Cover</li>
            </ol>
          </div>   
          <div class="col-sm-4">

          </div>    
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LAM Teknik - Cover</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h3>Halaman Muka/Cover</h3>
                        <fieldset>
                            <center><img src="http://ta.kinclongin.my.id/images/logopolines.jpg" alt="logopolines" width="20%" height="auto"  /></center><br>
                            <div>
                                <h1><p style="text-align:center"><b>LAPORAN EVALUASI DIRI</b></p></h1>
                            </div>
                            <div>
                                <h1><p style="text-align:center"><b>AKREDITASI PROGRAM STUDI</b></p></h1>
                            </div>
                            <center>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 ">
                                <select name="prodi" id="id" class="form-control show-tick">
                                    <option value="">-- Please Select Nama Prodi--</option>
                                    @foreach ($unitKerja as $UK)
                                        <option value="{{ $UK->id }}">{{ $UK->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </center>
                            <div class="col-sm-4"></div>
                            <br><br><br><br><br><br><br>
                            <div>
                                <center>
                                <div class="form-inline mx-auto">
                                    <input name="pt" type="text" class="form-control form-control-sm" id="pt" placeholder="Nama Perguruan Tinggi" >
                                </div>
                                </center>
                            </div>
                            <br><br>
                            <div>
                                <center>
                                <div class="form-inline mx-auto">
                                    <input name ="kota" type="text" class="form-control form-control-sm" id="kotapt" placeholder="Kota Perguruan Tinggi" >
                                </div>
                                </center>
                            </div>
                            <br>
                            <div>
                                <center>
                                <div class="form-inline mx-auto">
                                    <label for="formGroupExampleInput"><b>TAHUN</b></label>
                                    <input name="th" type="number" class="form-control form-control-sm" id="tahun" placeholder="Tahun">
                                </div>
                                </center>
                            </div>
                        </fieldset>
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

    {{-- BS-Stepper --}}
    {{-- <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote()
        $('#summernote1').summernote()


        // BS-Stepper Init
        window.stepper1 = new Stepper(document.querySelector('#stepper1'))

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(".datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

        const name = document.getElementById("namePT");
        console.log(name.value);
      });
    </script>

@endpush()