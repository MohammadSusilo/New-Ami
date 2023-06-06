@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ KRITERIA')

@push('css')
    {{-- BS-Stepper --}}
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAM TEKNIK - KRITERIA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item">BAB II Struktur LED</li>
              <li class="breadcrumb-item active">Kriteria</li>
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
                        <h3 class="card-title">LAM Teknik - Kriteria</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            
                        <div id="stepper1" class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#test-l-1">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">D.1	Visi, Misi, Tujuan, dan Strategi</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Tata Pamong, Tata Kelola dan Kerja sama</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-3">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Mahasiswa</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-4">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Sumber Daya Manusia</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-5">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger5" aria-controls="test-l-5">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Keuangan, Sarana dan Prasarana</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-6">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger6" aria-controls="test-l-6">
                                        <span class="bs-stepper-circle">6</span>
                                        <span class="bs-stepper-label">Pendidikan</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-7">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger7" aria-controls="test-l-7">
                                        <span class="bs-stepper-circle">7</span>
                                        <span class="bs-stepper-label">Penelitian</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-8">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger8" aria-controls="test-l-8">
                                        <span class="bs-stepper-circle">8</span>
                                        <span class="bs-stepper-label">Pengabdian kepada Masyarakat</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-9">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger9" aria-controls="test-l-9">
                                        <span class="bs-stepper-circle">9</span>
                                        <span class="bs-stepper-label">Luaran dan Capaian Tridharma Perguruan Tinggi</span>
                                    </button>
                                </div>
                                {{-- <div class="bs-stepper-line"></div> --}}
                                {{-- <div class="step" data-target="#test-l-6">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger6" aria-controls="test-l-6">
                                        <span class="bs-stepper-circle">6</span>
                                        <span class="bs-stepper-label">Validate</span>
                                    </button>
                                </div> --}}
                            </div>
                            <div class="bs-stepper-content">
                                <form onSubmit="return false">
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-6" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger6">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-7" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger7">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-8" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger8">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-9" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger9">
                                        <div class="form-group">
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    {{-- <div id="test-l-6" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger6">
                                      <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                                      <button type="submit" class="btn btn-primary mt-5">Submit</button>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                       
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
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote()
        $('#summernote1').summernote()


        // BS-Stepper Init
        window.stepper1 = new Stepper(document.querySelector('#stepper1'))
      });
    </script>

@endpush()