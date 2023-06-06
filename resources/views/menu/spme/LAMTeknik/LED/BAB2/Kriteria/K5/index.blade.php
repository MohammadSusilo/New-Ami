@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ KRITERIA | Keuangan, Sarana dan Prasarana')

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
            <h1>LAM TEKNIK - KRITERIA | Keuangan, Sarana dan Prasarana</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item"><a href="{{ url('LAMTeknik') }}">LAM Teknik</a></li>
              <li class="breadcrumb-item">BAB II Struktur LED</li>
              <li class="breadcrumb-item active">Kriteria | Keuangan, Sarana dan Prasarana</li>
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
                        <h3 class="card-title">LAM Teknik - Kriteria | Keuangan, Sarana dan Prasarana</h3>
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
                                                <p>Bagian ini mencakup latar belakang, tujuan, dan rasional penentuan strategi pencapaian standar pendidikan tinggi yang ditetapkan perguruan tinggi terkait dengan keuangan dan fasilitas.</p>
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
                                                <p>Bagian ini berisi deskripsi dokumen formal tentang pengelolaan dan pengelolaan sarana dan prasarana.Bagian ini berisi deskripsi dokumen formal tentang pengelolaan dan pengelolaan sarana dan prasarana.</p>
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
                                                <p>Bagian ini mencakup strategi UPPS dalam pencapaian standar pendidikan tinggi yang ditetapkan perguruan tinggi terkait dengan keuangan dan fasilitas pendidikan maupun penunjang pendidikan.</p>
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
                                            <p>Data keuangan, sarana dan prasarana disajikan dengan teknik representasi yang relevan  dan komprehensif, dan disimpulkan kecenderungannya. Data dan analisis yang disampaikan meliputi aspek:</p>
                                            <div class="form-group">
                                                <h5>a.	Keuangan</h5>
                                                <p>Bagian ini menjelaskan alokasi dan penggunaan dana untuk biaya operasional pendidikan. Penggunaan dana untuk kegiatan penelitian dosen tetap: rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir. Penggunaan dana untuk kegiatan PkM dosen tetap: rata-rata dana PkM DTPS/tahun dalam 3 tahun terakhir. Penggunaan dana untuk investasi (SDM, sarana dan prasarana) dalam 3 tahun terakhir.</p>
                                                <textarea id="summernote3_1">
                                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <h5>b.	Fasilitas</h5>
                                                <p>Bagian ini menjelaskan kecukupan dan aksesibilitas fasilitas pendidikan. Kecukupan sarana terlihat dari ketersediaan, kepemilikan, kemutakhiran, dan kesiapgunaan fasilitas dan peralatan untuk pembelajaran maupun kegiatan penelitian dan PkM. Ketersediaan prasarana dan peralatan utama laboratorium yang digunakan oleh PS. Kecukupan dan aksesibilitas sarana teknologi informasi dan komunikasi.</p>
                                                <textarea id="summernote3_2">
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
                                                <p>Bagian ini menjelaskan indikator kinerja tambahan keuangan, sarana dan prasarana yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi untuk melampaui SN-DIKTI.</p>
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
                                                <p>Bagian ini berisi ringkasan dari pemosisian, masalah dan akar masalah, serta rencana perbaikan dan pengembangan yang akan dilakukan UPPS terkait keuangan, sarana dan prasarana pada program studi yang diakreditasi.</p>
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
        $('#summernote4').summernote()
        $('#summernote5').summernote()
        $('#summernote6').summernote()

        window.stepper1 = new Stepper(document.querySelector('#stepper1'))

      });
    </script>

@endpush()