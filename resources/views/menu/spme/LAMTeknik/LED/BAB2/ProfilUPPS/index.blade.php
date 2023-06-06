@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ BAB II STRUKTUR LAPORAN EVALUASI DIRI | Profil UPPPS')

@push('css')
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
            <h1>LAM TEKNIK - Profil UPPS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</a></li>
              @if(auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="{{ url('/LAMTeknik/'.$unitKerja) }}">LAM Teknik</a></li>
              @else
                <li class="breadcrumb-item"><a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}">LAM Teknik</a></li>
              @endif
              <li class="breadcrumb-item">BAB II Struktur LED</li>
              <li class="breadcrumb-item active">Profil UPPS</li>
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
                        <h3 class="card-title">LAM Teknik - Profil UPPS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if($LAMTeknikLEDProfilUPPS == null)
                        <form action="{{ route('LAMTeknik_LED_ProfilUPPS.store') }}" method="post" class="f1">
                        @csrf
                            <center><h3>PROFIL UPPS</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                  <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                  <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <p>Bagian ini berisi deskripsi sejarah Unit Pengelola Program Studi (UPPS), VMTS, Organisasi dan tata kerja, mahasiswa dan lulusan, sumber daya manusia (dosen dan tenaga kependidikan), keuangan, sarana dan prasarana serta kinerja UPPS.</p>
                            <div class="form-group">
                              <textarea name="des" class="summernotes" rows="4">
                              </textarea>
                            </div>

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
                        <form action="{{ route('LAMTeknik_LED_ProfilUPPS.update', $LAMTeknikLEDProfilUPPS->id) }}" method="post" class="f1">
                        @csrf
                        @method('PUT')
                            <center><h3>PROFIL UPPS</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <div class="form-group">
                              <textarea name="des" class="summernotes" rows="4">
                                {{ $LAMTeknikLEDProfilUPPS->des }}
                              </textarea>
                            </div>

                            <div class="text-right">
                              @if(auth()->user()->role_id == 1)
                                <a href="{{ url('/LAMTeknik/'.$unitKerja) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @else
                                <a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @endif

                              <form onclick="return confirm('Apakah anda yakin reset data ini?');" action="{{ route('LAMTeknik_LED_ProfilUPPS.destroy', $LAMTeknikLEDProfilUPPS->id) }}" method="POST" class="is-inline">
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