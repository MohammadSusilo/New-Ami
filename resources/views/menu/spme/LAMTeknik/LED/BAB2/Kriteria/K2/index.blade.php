@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ KRITERIA | Tata Pamong, Tata Kelola dan Kerja sama')

@push('css')
    {{-- BS-Stepper --}}
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .customcontainer {
            overflow-x: auto;
            white-space: nowrap;
        }
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
            <h1>LAM TEKNIK - KRITERIA | Tata Pamong, Tata Kelola dan Kerja sama</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item">BAB II Struktur LED</li>
              <li class="breadcrumb-item active">Kriteria | Tata Pamong, Tata Kelola dan Kerja sama</li>
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
                        <h3 class="card-title">LAM Teknik - Kriteria | Tata Pamong, Tata Kelola dan Kerja sama</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="customcontainer">

                            <div id="stepper1" class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#test-l-1">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Latar Belakang</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-2">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Kebijakan</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-3">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Strategi Pencapaian Standar</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-4">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Indikator Kinerja Utama</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-5">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger5" aria-controls="test-l-5">
                                            <span class="bs-stepper-circle">5</span>
                                            <span class="bs-stepper-label">Indikator Kinerja Tambahan</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-6">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger6" aria-controls="test-l-6">
                                            <span class="bs-stepper-circle">6</span>
                                            <span class="bs-stepper-label">Evaluasi Capaian Kinerja</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-7">
                                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger7" aria-controls="test-l-7">
                                            <span class="bs-stepper-circle">7</span>
                                            <span class="bs-stepper-label">Kesimpulan Hasil Evaluasi dan Tindak lanjut</span>
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
                                                <p>Bagian ini mencakup latar belakang, tujuan, dan rasional penentuan strategi pencapaian standar pendidikan tinggi yang ditetapkan perguruan tinggi terkait manajemen, kepemimpinan akademik dan Kerja sama.</p>
                                                <textarea id="summernote">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                            <div class="form-group">
                                                <p>Bagian ini berisi deskripsi dokumen formal kebijakan pengembangan tata kelola dan tata pamong, legalitas organisasi dan tata kerja yang ditetapkan oleh perguruan  tinggi, sistem pengelolaan, sistem penjaminan mutu, dan kerja sama yang diacu oleh UPPS</p>
                                                <textarea id="summernote1">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                                            <div class="form-group">
                                                <p>Bagian ini mencakup strategi UPPS dalam pencapaian standar pendidikan tinggi yang ditetapkan perguruan tinggi terkait tata pamong, tata kelola, dan kerja sama serta sumber daya yang dialokasikan untuk mencapai standar yang telah ditetapkan dan  mekanisme kontrol ketercapaian.</p>
                                                <textarea id="summernote2">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                                            <div class="form-group">
                                                <h5>a.	Sistem Tata Pamong</h5>
                                                <p>Bagian ini berisi memuat ketersediaan dokumen formal tata pamong dan tata kelola serta bukti yang sahih implementasi. Ketersediaan dokumen formal struktur organisasi dan tata kerja UPPS beserta tugas pokok dan fungsinya.</p>
                                                <textarea id="summernote3_1">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <h5>b.	Kepemimpinan dan kemampuan manajerial</h5>
                                                <p>Bagian ini mendeskripsikan komitmen pimpinan UPPS yang berisi ketersediaan bukti yang sahih tentang efektivitas kepemimpinan di UPPS dan program studi yang diakreditasi. Kapabilitas Pimpinan UPPS yang berisi dokumen formal dan bukti keberfungsian sistem pengelolaan fungsional dan operasional di tingkat UPPS.</p>
                                                <textarea id="summernote3_2">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <h5>c.	Kerjasama</h5>
                                                <p>Bagian ini memuat mutu, manfaat, kepuasan dan keberlanjutan kerja sama UPPS yang relevan dengan program studi yang diakreditasi serta  memiliki bukti sahih pelaksanaan kerjasama untuk memberikan peningkatan kinerja tridharma perguruan tinggi dan fasilitas pendukung, memberikan manfaat dan kepuasan kepada mitra, dan menjamin keberlanjutan kerjasama dan hasilnya.</p>
                                                <textarea id="summernote3_3">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                                            <div class="form-group">
                                                <p>Bagian ini memuat indikator kinerja tambahan tata kelola, tata pamong, dan kerja sama yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi untuk melampaui SN-DIKTI.</p>
                                                <textarea id="summernote4">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-6" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger6">
                                            <div class="form-group">
                                                <p>Bagian ini berisi deskripsi dan analisis keberhasilan dan/atau ketidakberhasilan atas ketercapaian indikator kinerja yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi.</p>
                                                <textarea id="summernote5">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="test-l-7" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger7">
                                            <div class="form-group">
                                                <p>Berisi ringkasan dari pemosisian, masalah dan akar masalah, serta rencana perbaikan dan pengembangan yang akan dilakukan UPPS terkait tata pamong, tata kelola, dan kerja sama pada program studi yang diakreditasi.</p>
                                                <textarea id="summernote6">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
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
        $('#summernote2').summernote()
        $('#summernote3_1').summernote()
        $('#summernote3_2').summernote()
        $('#summernote3_3').summernote()
        $('#summernote4').summernote()
        $('#summernote5').summernote()
        $('#summernote6').summernote()

        window.stepper1 = new Stepper(document.querySelector('#stepper1'))

      });
    </script>

@endpush()