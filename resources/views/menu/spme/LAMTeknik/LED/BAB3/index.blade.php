@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ BAB III PENJAMINAN MUTU')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <style type="text/css">
      .note-group-select-from-files {
        display:none;
      }
      .note-insert .btn-group {
        display: none;
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
            <h1>LAM TEKNIK - BAB III PENJAMINAN MUTU</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              @if(auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="{{ url('/LAMTeknik/'.$unitKerja) }}">LAM Teknik</a></li>
              @else
                <li class="breadcrumb-item"><a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}">LAM Teknik</a></li>
              @endif
              <li class="breadcrumb-item active">BAB III Penjaminan Mutu</li>
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
                        <h3 class="card-title">LAM Teknik - BAB III PENJAMINAN MUTU</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if($LAMTeknikLEDPenjaminanMutu == null)
                        <form action="{{ route('LAMTeknik_LED_PenjaminanMutu.store') }}" method="post" class="f1">
                          @csrf
                            <center><h3>PENJAMINAN MUTU</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                  <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                  <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <p>Pada bagian ini, berisi deskripsi implementasi Sistem Penjaminan Mutu yang sesuai dengan kebijakan, organisasi, instrumen yang dikembangkan, serta monitoring dan evaluasi, pelaporan, dan tindak lanjut. Unsur-unsur yang perlu dijelaskan pada penjaminan mutu mencakup:</p>
                            <ol>
                              <li>
                                Keberadaan organ/fungsi pelaksana penjaminan mutu internal yang berlaku pada UPPS yang didukung dokumen formal pembentukannya.
                                <div class="form-group">
                                  <textarea name="ppmi_upps" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Dokumen yang dimiliki yaitu kebijakan SPMI, manual SPMI, Standar SPMI dan Formulir.
                                <div class="form-group">
                                  <textarea name="dok" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Keterlaksanaan penjaminan mutu UPPS dan PS sesuai dengan standar nasional pendidikan tinggi. Standar yang ditetapkan perguruan tinggi mencakup IKU dan IKT yang terdiri dari: 
                                <ol>
                                  <li>Tata Pamong, Tata Kelola dan Kerja sama</li>
                                  <li>Mahasiswa</li>
                                  <li>Sumber Daya Manusia</li>
                                  <li>Keuangan, Sarana dan Prasarana</li>
                                  <li>Pendidikan</li>
                                  <li>Penelitian</li>
                                  <li>Pengabdian kepada Masyarakat</li>
                                  <li>Luaran dan Capaian Tridharma Perguruan Tinggi</li>
                                </ol>
                                <div class="form-group">
                                  <textarea name="kpm_upps" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Pelaksanaan Audit Mutu Internal (AMI) dan ketersediaan bukti sahih efektivitas pelaksanaan penjaminan mutu sesuai dengan siklus penetapan, pelaksanaan, evaluasi, pengendalian, dan perbaikan berkelanjutan (PPEPP) oleh UPPS dan PS.
                                <div class="form-group">
                                  <textarea name="pelaksanaan_ami" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Pengakuan mutu dari lembaga audit eksternal, lembaga akreditasi, dan lembaga sertifikasi.
                                <div class="form-group">
                                  <textarea name="pengakuan" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Deskripsi pengukuran kepuasan pengguna terhadap layanan manajemen terhadap para pemangku kepentingan, layanan pengelolaan dan pengembangan SDM, layanan pengelolaan keuangan dan fasilitas, layanan dan pelaksanaan proses pendidikan, layanan dan pelaksanaan proses penelitian, layanan dan pelaksanaan PkM dan Kepuasan pengguna lulusan dan mitra kerja terhadap kinerja lulusan.
                                <div class="form-group">
                                  <textarea name="des_pkp" class="summernotes" rows="4">
                                  </textarea>
                                </div>
                              </li>
                            </ol>

                            <div class="text-right">
                              @if(auth()->user()->role_id == 1)
                                <a href="{{ url('/LAMTeknik/'.$unitKerja) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @else
                                <a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @endif
                              
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                      @else
                        <form action="{{ route('LAMTeknik_LED_PenjaminanMutu.update', $LAMTeknikLEDPenjaminanMutu->id) }}" method="post" class="f1">
                          @csrf
                          @method('PUT')
                            <center><h3>PENJAMINAN MUTU</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                  <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                  <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <p>Pada bagian ini, berisi deskripsi implementasi Sistem Penjaminan Mutu yang sesuai dengan kebijakan, organisasi, instrumen yang dikembangkan, serta monitoring dan evaluasi, pelaporan, dan tindak lanjut. Unsur-unsur yang perlu dijelaskan pada penjaminan mutu mencakup:</p>
                            <ol>
                              <li>
                                Keberadaan organ/fungsi pelaksana penjaminan mutu internal yang berlaku pada UPPS yang didukung dokumen formal pembentukannya.
                                <div class="form-group">
                                  <textarea name="ppmi_upps" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->ppmi_upps }}
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Dokumen yang dimiliki yaitu kebijakan SPMI, manual SPMI, Standar SPMI dan Formulir.
                                <div class="form-group">
                                  <textarea name="dok" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->dok }}
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Keterlaksanaan penjaminan mutu UPPS dan PS sesuai dengan standar nasional pendidikan tinggi. Standar yang ditetapkan perguruan tinggi mencakup IKU dan IKT yang terdiri dari: 
                                <ol>
                                  <li>Tata Pamong, Tata Kelola dan Kerja sama</li>
                                  <li>Mahasiswa</li>
                                  <li>Sumber Daya Manusia</li>
                                  <li>Keuangan, Sarana dan Prasarana</li>
                                  <li>Pendidikan</li>
                                  <li>Penelitian</li>
                                  <li>Pengabdian kepada Masyarakat</li>
                                  <li>Luaran dan Capaian Tridharma Perguruan Tinggi</li>
                                </ol>
                                <div class="form-group">
                                  <textarea name="kpm_upps" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->kpm_upps }}
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Pelaksanaan Audit Mutu Internal (AMI) dan ketersediaan bukti sahih efektivitas pelaksanaan penjaminan mutu sesuai dengan siklus penetapan, pelaksanaan, evaluasi, pengendalian, dan perbaikan berkelanjutan (PPEPP) oleh UPPS dan PS.
                                <div class="form-group">
                                  <textarea name="pelaksanaan_ami" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->pelaksanaan_ami }}
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Pengakuan mutu dari lembaga audit eksternal, lembaga akreditasi, dan lembaga sertifikasi.
                                <div class="form-group">
                                  <textarea name="pengakuan" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->pengakuan }}
                                  </textarea>
                                </div>
                              </li>
                              <li>
                                Deskripsi pengukuran kepuasan pengguna terhadap layanan manajemen terhadap para pemangku kepentingan, layanan pengelolaan dan pengembangan SDM, layanan pengelolaan keuangan dan fasilitas, layanan dan pelaksanaan proses pendidikan, layanan dan pelaksanaan proses penelitian, layanan dan pelaksanaan PkM dan Kepuasan pengguna lulusan dan mitra kerja terhadap kinerja lulusan.
                                <div class="form-group">
                                  <textarea name="des_pkp" class="summernotes" rows="4">
                                    {{ $LAMTeknikLEDPenjaminanMutu->des_pkp }}
                                  </textarea>
                                </div>
                              </li>
                            </ol>
                            <div class="text-right">
                              @if(auth()->user()->role_id == 1)
                                <a href="{{ url('/LAMTeknik/'.$unitKerja) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @else
                                <a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @endif

                              <form onclick="return confirm('Apakah anda yakin reset data ini?');" action="{{ route('LAMTeknik_LED_PenjaminanMutu.destroy', $LAMTeknikLEDPenjaminanMutu->id) }}" method="POST" class="is-inline">
                                @csrf
                                @method('DELETE')
                                  <button class="button btn btn-danger is-small is-info" data-toggle="tooltip" data- original-title="Reset Data"><i class="fa fa-times"></i> Reset</button>
                              </form>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                      @endif
                       
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

    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
      $(function () {
        // Summernote
        $(".summernotes").summernote({
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ['style', ['bold', 'italic', 'underline', 'clear']],
            ]
        });
      });
    </script>

@endpush()