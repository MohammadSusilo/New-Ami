@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ BAB IV PROGRAM PENGEMBANGAN BERKELANJUTAN')

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
            <h1>LAM TEKNIK - BAB IV PROGRAM PENGEMBANGAN BERKELANJUTAN</h1>
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
              <li class="breadcrumb-item active">BAB IV Program Pengembangan Berkelanjutan</li>
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
                        <h3 class="card-title">LAM Teknik - BAB IV PROGRAM PENGEMBANGAN BERKELANJUTAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if($LAMTeknikLEDPengembanganBerkelanjutan == null)
                        <form action="{{ route('LAMTeknik_LED_PengBer.store') }}" method="post">
                          @csrf
                            <center><h3>PROGRAM PENGEMBANGAN BERKELANJUTAN</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                  <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                  <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <p>Pada bagian ini, mendeskripsikan pengembangan program yang dapat digunakan sebagai rencana strategis sebagai dokumen formal UPPS dan PS untuk menjalankan program jangka pendek maupun jangka panjang. Strategi dan pengembangan berdasarkan analisis capaian kinerja yang disampaikan pada evaluasi setiap kriteria. Analisis dan pengembangan berkelanjutan yang disampaikan meliputi:</p>
                            <ol>
                              <li><b>Analisis SWOT</b></li>
                                <p>Keberadaan organ/fungsi pelaksana penjaminan mutu internal yang berlaku pada UPPS yang didukung dokumen formal pembentukannya.</p>
                                <textarea name="swot" class="summernotes" rows="4">
                                </textarea>
                              <li><b>Tujuan Strategi Pengembangan</b></li>
                                <p>Deskripsi tujuan strategi yang sesuai dengan Visi, Misi dan Tujuan UPPS. Tujuan strategis dijadikan sebagai arah pengembangan jangka pendek dan menengah yang dijalankan secara efektif. Penentuan tujuan strategis perlu menyesuaikan perkembangan lingkungan eksternal dengan meninjau ulang kelebihan dan kelemahan UPPS dan PS yang diakreditasi.</p>
                                <textarea name="tujuan" class="summernotes" rows="4">
                                </textarea>
                              <li><b>Program Pengembangan Keberlanjutan</b></li>
                                <p>Menjelaskan program pengembangan keberlanjutan yang disusun sesuai kebutuhan dan tujuan strategis yang telah ditetapkan. Program tersebut bersifat rasional dengan mempertimbangkan sumber daya yang dimiliki serta dapat diukur ketercapaian program yang disusun.</p>
                                <textarea name="keberlanjutan" class="summernotes" rows="4">
                                </textarea>
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
                        <form action="{{ route('LAMTeknik_LED_PengBer.update', $LAMTeknikLEDPengembanganBerkelanjutan->id) }}" method="post" class="f1">
                          @csrf
                          @method('PUT')
                            <center><h3>PROGRAM PENGEMBANGAN BERKELANJUTAN</h3></center>
                            <div class="form-group">
                              @if(auth()->user()->role_id == 1)
                                  <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                              @else
                                  <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                              @endif
                            </div>
                            <p>Pada bagian ini, mendeskripsikan pengembangan program yang dapat digunakan sebagai rencana strategis sebagai dokumen formal UPPS dan PS untuk menjalankan program jangka pendek maupun jangka panjang. Strategi dan pengembangan berdasarkan analisis capaian kinerja yang disampaikan pada evaluasi setiap kriteria. Analisis dan pengembangan berkelanjutan yang disampaikan meliputi:</p>
                            <ol>
                              <li><b>Analisis SWOT</b></li>
                                <p>Keberadaan organ/fungsi pelaksana penjaminan mutu internal yang berlaku pada UPPS yang didukung dokumen formal pembentukannya.</p>
                                <textarea name="swot" class="summernotes" rows="4">
                                  {{ $LAMTeknikLEDPengembanganBerkelanjutan->swot }}
                                </textarea>
                              <li><b>Tujuan Strategi Pengembangan</b></li>
                                <p>Deskripsi tujuan strategi yang sesuai dengan Visi, Misi dan Tujuan UPPS. Tujuan strategis dijadikan sebagai arah pengembangan jangka pendek dan menengah yang dijalankan secara efektif. Penentuan tujuan strategis perlu menyesuaikan perkembangan lingkungan eksternal dengan meninjau ulang kelebihan dan kelemahan UPPS dan PS yang diakreditasi.</p>
                                <textarea name="tujuan" class="summernotes" rows="4">
                                  {{ $LAMTeknikLEDPengembanganBerkelanjutan->tujuan }}
                                </textarea>
                              <li><b>Program Pengembangan Keberlanjutan</b></li>
                                <p>Menjelaskan program pengembangan keberlanjutan yang disusun sesuai kebutuhan dan tujuan strategis yang telah ditetapkan. Program tersebut bersifat rasional dengan mempertimbangkan sumber daya yang dimiliki serta dapat diukur ketercapaian program yang disusun.</p>
                                <textarea name="keberlanjutan" class="summernotes" rows="4">
                                  {{ $LAMTeknikLEDPengembanganBerkelanjutan->keberlanjutan }}
                                </textarea>
                            </ol>
                            <div class="text-right">
                              @if(auth()->user()->role_id == 1)
                                <a href="{{ url('/LAMTeknik/'.$unitKerja) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @else
                                <a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                              @endif

                              <form onclick="return confirm('Apakah anda yakin reset data ini?');" action="{{ route('LAMTeknik_LED_PengBer.destroy', $LAMTeknikLEDPengembanganBerkelanjutan->id) }}" method="POST" class="is-inline">
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