@extends('layouts.myapp')
@section('title', 'LAM TEKNIK ~ COVER')

@push('css')
    {{-- BS-Stepper --}}
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    {{-- <link rel="stylesheet" href="https://johann-s.github.io/bs-stepper/dist/css/bs-stepper.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Date Picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    
    <style>
        .f1-steps { overflow: hidden; position: relative; margin-top: 20px; }

        .f1-progress { position: absolute; top: 24px; left: 0; width: 100%; height: 1px; background: #ddd; }
        .f1-progress-line { position: absolute; top: 0; left: 0; height: 1px; background: #338056; }

        .f1-step { position: relative; float: left; width: 20%; padding: 0 5px; }

        .f1-step-icon {
            display: inline-block; width: 40px; height: 40px; margin-top: 4px; background: #ddd;
            font-size: 16px; color: #fff; line-height: 40px;
            -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%;
        }
        .f1-step.activated .f1-step-icon {
            background: #fff; border: 1px solid #338056; color: #338056; line-height: 38px;
        }
        .f1-step.active .f1-step-icon {
            width: 48px; height: 48px; margin-top: 0; background: #338056; font-size: 22px; line-height: 48px;
        }

        .f1-step p { color: #ccc; }
        .f1-step.activated p { color: #338056; }
        .f1-step.active p { color: #338056; }

        .f1 fieldset { display: none; text-align: left; }

        .f1-buttons { text-align: right; }

        .f1 .input-error { border-color: #f35b3f; }
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
            <h1>LAM TEKNIK - COVER</h1>
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

                            <form action="{{ route('LAMTeknik_LED_Cover.store') }}" method="post" class="f1">
                            @csrf
                                <div class="f1-steps">
                                    <div class="f1-progress">
                                        <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4" style="width: 25%;"></div>
                                    </div>
                                    <div class="f1-step active">
                                        <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                                        <p>Home</p>
                                    </div>
                                    <div class="f1-step">
                                        <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                        <p>Identitas Pengusul</p>
                                    </div>
                                    <div class="f1-step">
                                        <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                                        <p>Identitas Tim Penyusun Laporan Evaluasi</p>
                                    </div>
                                    <div class="f1-step">
                                        <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                                        <p>Kata Pengantar</p>
                                    </div>
                                    <div class="f1-step">
                                        <div class="f1-step-icon"><i class="fa fa-file"></i></div>
                                        <p>Ringkasan Ekekutif</p>
                                    </div>
                                </div>
                                <!-- step 1 -->
                                <fieldset>
                                    <div class="form-group">
                                        <center><img src="http://ta.kinclongin.my.id/images/logopolines.jpg" enctype="multipart/form-data" alt="logopolines" width="20%" height="auto"  /></center><br>
                                        <div>
                                            <h1><p style="text-align:center"><b>LAPORAN EVALUASI DIRI PROGRAM STUDI</b></p></h1>
                                        </div>
                                        <div>
                                            <h2><p style="text-align:center"><b>AKREDITASI PROGRAM STUDI</b></p></h2>
                                            <input type="hidden" name="id" value="6"> <br/>
                                        </div>
                                        <center>
                                            <div class="col-sm-4">
                                                <label for="formGroupExampleInput"><b>PROGRAM DAN NAMA PROGRAM STUDI</b></label>
                                                @if(auth()->user()->role_id == 1)
                                                    @foreach($unitKerjas as $val)
                                                        @if($val->id == $unitKerja)
                                                            <input type="text" class="form-control form-control-sm" id="namePT" value="{{ $val->name }}" disabled>
                                                        @endif
                                                    @endforeach
                                                    <input type="text" name="uk_id" hidden value="{{ $unitKerja }}">
                                                @else
                                                    @foreach($unitKerjas as $val)
                                                        @if($val->id == auth()->user()->unitkerja_id)
                                                            <input type="text" class="form-control form-control-sm" id="namePT" value="{{ $val->name }}" disabled>
                                                        @endif
                                                    @endforeach
                                                    <input type="text" name="uk_id" hidden value="{{ auth()->user()->unitkerja_id }}">
                                                @endif
                                            </div>
                                        </center>
                                        <div class="col-sm-4"></div>
                                        <br><br><br><br><br><br><br>
                                        <center>
                                            <div class="col-sm-4">
                                                <label for="formGroupExampleInput"><b>UNIVERSITAS/ INSTITUT/ SEKOLAH TINGGI/ POLITEKNIK/ AKADEMI/ AKADEMI KOMUNITAS</b></label>
                                                <input type="text" class="form-control form-control-sm"value="POLITEKNIK NEGERI SEMARANG" disabled>
                                                <input name="namaPT" hidden type="text" class="form-control form-control-sm" id="namePT" value="POLITEKNIK NEGERI SEMARANG">
                                            </div>
                                        </center>
                                        <br><br>
                                        <center>
                                            <div class="col-sm-4">
                                                <label for="formGroupExampleInput"><b>NAMA KOTA KEDUDUKAN PERGURUAN TINGGI</b></label>
                                                <input type="text" class="form-control form-control-sm" value="KOTA SEMARANG" disabled>
                                                <input name="kotaPT" hidden type="text" class="form-control form-control-sm" id="kotaPT" value="KOTA SEMARANG">
                                            </div>
                                        </center>
                                        <br>
                                        <center>
                                            <div class="col-sm-4">
                                                <label for="formGroupExampleInput"><b>TAHUN</b></label>
                                                <input name="tahun" type="text" class="form-control datepicker" id="tahun" placeholder="Tahun">
                                            </div>
                                        </center>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </fieldset>
                                <!-- step 2 -->
                                <fieldset>
                                    <div class="form-group">
                                        <center><h3>Identitas Pengusul</h3></center>
                                        <br>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Perguruan Tinggi</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="namePTIP" value="POLITEKNIK NEGERI SEMARANG" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Unit Pengelola Program Studi</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="upps" type="text" class="form-control" id="upt" placeholder="Unit Pengelola Program Studi">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Jenis Program Studi</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="jenis_ps" type="text" class="form-control" id="jenis_ps" placeholder="Jenis Program Studi">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nama Program Studi</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                @if(auth()->user()->role_id == 1)
                                                    @foreach($unitKerjas as $val)
                                                        @if($val->id == $unitKerja)
                                                            <input type="text" class="form-control form-control-sm" id="namePT" value="{{ $val->name }}" disabled>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($unitKerjas as $val)
                                                        @if($val->id == auth()->user()->unitkerja_id)
                                                            <input type="text" class="form-control form-control-sm" id="namePT" value="{{ $val->name }}" disabled>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Alamat Program Studi</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <textarea rows="4" name="alamat" class="form-control no-resize" id="alamat_ps" placeholder="Alamat Program Studi"></textarea>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nomor Telepon</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="telp" type="text" class="form-control" id="telp" placeholder="Nomor Telepon">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Email & Website</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="email_web" type="text" class="form-control" id="email_web" placeholder="Email & Website">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nomor SK Pendirian PT</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="sk_pt" type="text" class="form-control" id="sk_pt" placeholder="Nomor SK Pendirian PT">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal SK Pendirian PT</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl_sk_pt" type="date" class="form-control" id="tgl_sk_pt" placeholder="Tanggal SK Pendirian PT">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Pejabat Penandatangan SK Pendirian PT</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="pp_sk_pt" type="text" class="form-control" id="sk_pt" placeholder="Pejabat Penandatangan SK Pendirian PT">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nomor SK Pembukaan PS</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="sk_ps" type="text" class="form-control" id="sk_ps" placeholder="Nomor SK Pembukaan PS">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal SK Pembukaan PS</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl_sk_ps" type="date" class="form-control" id="tgl_sk_ps" placeholder="Tanggal SK Pembukaan PS">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Pejabat Penandatangan SK Pendirian PS</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="pp_sk_ps" type="text" class="form-control" id="pp_sk_ps" placeholder="Pejabat Penandatangan SK Pendirian PS">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tahun Pertama Kali Menerima Mahasiswa</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="th_awal" type="text" class="form-control datepicker" id="th_awal" placeholder="Tahun Pertama Kali Menerima Mahasiswa">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Peringkat Terbaru Akreditasi PS</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="akre_ps" type="text" class="form-control" id="akre_ps" placeholder="Peringkat Terbaru Akreditasi PS">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nomor SK BAN-PT</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="sk_terakhir" type="text" class="form-control" id="sk_terakhir" placeholder="Nomor SK BAN-PT">
                                            </div>
                                        </div>

                                        <!-- Bordered Table -->
                                        <div class="body table-responsive">
                                            <p>Daftar Program Studi di Unit Pengelola Program Studi (UPPS)</p>
                                            <table class="table table-bordered" id="dynamic_field">
                                                <thead>
                                                    <tr>
                                                        <th width="" class="text-center">Jenis Program</th>
                                                        <th width="" class="text-center">Nama Program Studi</th>
                                                        <th width="" class="text-center">Status/Peringkat</th>
                                                        <th width="" class="text-center">No. & Tgl. SK</th>
                                                        <th width="" class="text-center">Tgl. Kadaluarsa</th>
                                                        <th width="" class="text-center">Jumlah Mahasiswa saat TS</th>
                                                    </tr>
                                                </thead>
                                                <!-- <tbody id="AddCover"> -->
                                                <tbody id="AddCoverLED">
                                                    {{-- <tr>
                                                        <td><input name="jenis_upps[]" class="form-control form-control-sm" value="D3"/></td>
                                                        <td><input name="nama_upps[]" class="form-control form-control-sm" value="Teknik Informatika"/></td>
                                                        <td><input name="status_upps[]" class="form-control form-control-sm" value="B"/></td>
                                                        <td><input name="sk_upps[]" class="form-control form-control-sm" value="1234567890"/></td>
                                                        <td><input name="tgl_upps[]" class="form-control form-control-sm" value="2020-08-26"/></td>
                                                        <td><input name="mhs_upps[]" class="form-control form-control-sm" value="125"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input name="jenis_upps[]" class="form-control form-control-sm" value="D3"/></td>
                                                        <td><input name="nama_upps[]" class="form-control form-control-sm" value="Teknik Informatika"/></td>
                                                        <td><input name="status_upps[]" class="form-control form-control-sm" value="B"/></td>
                                                        <td><input name="sk_upps[]" class="form-control form-control-sm" value="1234567890"/></td>
                                                        <td><input name="tgl_upps[]" class="form-control form-control-sm" value="2020-08-26"/></td>
                                                        <td><input name="mhs_upps[]" class="form-control form-control-sm" value="125"/></td>
                                                    </tr> --}}
                                                </tbody>
                                                <tfoot>
                                                    <tr >
                                                        <td colspan="7">                                                                    
                                                            <button class="btn btn-small btn-success" onclick="additemcoverled(); return false"><i class="fas fa-plus"></i></button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- #END# Bordered Table -->
                                        <p>Keterangan :
                                            <ol>
                                                <li>Lampirkan salinan Surat Keputusan Pendirian Perguruan Tinggi</li>
                                                <li>Lampirkan salinan Surat Keputusan Pembukaan Program Studi</li>
                                                <li>Lampirkan salinan Surat Keputusan Akreditasi Program Studi terbaru</li>
                                                <li>Diisi dengan jumlah mahasiswa aktif di masing-masing PS saat TS</li>
                                            </ol> 
                                        </p>
                                        <br>

                                        <p><b>DAFTAR FILE LAMPIRAN :</b><br></p>
                                            <div class="col-sm-4">
                                                <select name="lampiran[]" id="lampiran" class="select2bs4" multiple="multiple" data-placeholder="Pilih Dokumen..." style="width: 100%;">
                                                    @foreach ($dokchecklist as $CK)
                                                        <option value="{{ $CK->id }}">{{ $CK->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </fieldset>
                                <!-- step 3 -->
                                <fieldset>
                                    <div class="form-group">
                                        <center><h3>Identitas Tim Penyusun Laporan Evaluasi</h3></center>
                                        <br>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nama</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nama_pys1" type="text" class="form-control form-control-sm col-sm-6" id="nama_pys1" value="Sukamto, S.Kom., M.T.">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>NIDN</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nidn_pys1" type="text" class="form-control form-control-sm col-sm-6" id="nidn_pys1" value="17017103">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Jabatan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="jabatan_pys1" type="text" class="form-control form-control-sm col-sm-6" id="jabatan_pys1" value="Ketua PSTI">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal Pengisian</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl_pya1" type="date" class="form-control form-control-sm col-sm-6" id="tgl_pya1" value="2019-08-12">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanda Tangan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <textarea rows="4" name="ttd_pys1" class="form-control no-resize" id="ttd_pys1"></textarea>
                                                <!-- <img src="http://ta.kinclongin.my.id/data_file/file_coverled/Borang standar 1 Prodi TI 2017.pdf" alt="logopolines" width="20%" height="auto"  />
                                                <input type="file" name="ttd1"> -->
                                                
                                            </div>
                                        </div>
                                        <br><br><br>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nama</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nama2" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="Tri Rahardjo Yudantoro,S.Kom.M.Kom.">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>NIDN</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nidn2" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="17017103">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Jabatan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="jabatan2" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="koordinator penyusunan borang LKPS standar 2 & LED standar 2">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal Pengisian</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl2" type="date" class="form-control form-control-sm col-sm-6" id="pt" value="2019-08-12">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanda Tangan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <textarea rows="4" class="form-control no-resize" id="ttd1"></textarea>
                                                <!-- <img src="http://ta.kinclongin.my.id/data_file/file_coverled/Borang standar 2 Prodi TI  2017.pdf" alt="logopolines" width="20%" height="auto"  />
                                                <input type="file" name="ttd2" placeholder="Image"> -->
                                            </div>
                                        </div>
                                        <br><br><br>
                                        
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nama</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nama3" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="Wahyu Sulistiyo,S.kom.,M.Kom.">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>NIDN</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nidn3" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="1047705">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Jabatan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="jabatan3" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="koordinator penyusunan borang LKPS standar 3 & LED standar 3">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal Pengisian</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl3" type="date" class="form-control form-control-sm col-sm-6" id="pt" value="2019-08-12">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanda Tangan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <textarea rows="4" class="form-control no-resize" id="ttd1"></textarea>
                                                <!-- <img src="http://ta.kinclongin.my.id/data_file/file_coverled/Borang standar 3 Prodi TI 2017.pdf" alt="logopolines" width="20%" height="auto"  />
                                                <input type="file" name="ttd3" placeholder="Image"> -->
                                            </div>
                                        </div>
                                        <br><br><br>
                                        
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Nama</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nama4" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="Mardiyono,S.Kom.,M.Sc.">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>NIDN</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="nidn4" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="11037401">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Jabatan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="jabatan4" type="text" class="form-control form-control-sm col-sm-6" id="pt" value="koordinator penyusunan borang LKPS standar 4 & LED standar 4">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanggal Pengisian</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="tgl4" type="date" class="form-control form-control-sm col-sm-6" id="pt" value="2019-08-12">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <label for="formGroupExampleInput"><b>Tanda Tangan</b></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <textarea rows="4" class="form-control no-resize" id="ttd1"></textarea>
                                                <!-- <img src="http://ta.kinclongin.my.id/data_file/file_coverled/Borang standar 4 Prodi TI 2017.pdf" alt="logopolines" width="20%" height="auto"  />
                                                <input type="file" name="ttd4" placeholder="Image"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </fieldset>
                                <!-- step 4 -->
                                <fieldset>
                                    <div class="form-group">
                                        <center><h3>Kata Pengantar</h3></center>
                                        <textarea class="summernotes" rows="4">
                                        </textarea>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </fieldset>
                                <!-- step 5 -->
                                <fieldset>
                                    <div class="form-group">
                                        <center><h3>Ringkasan Ekekutif</h3></center>
                                        <textarea class="summernotes" rows="4">
                                        </textarea>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Submit</button>
                                    </div>
                                </fieldset>
                                @if(auth()->user()->role_id == 1)
                                    <a href="{{ url('/LAMTeknik/'.$unitKerja) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                                @else
                                    <a href="{{ url('/LAMTeknik/'.auth()->user()->unitkerja_id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                                @endif
                            </form>
                        
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
    {{-- <script src="https://johann-s.github.io/bs-stepper/dist/js/bs-stepper.min.js"></script> --}}
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote()
        $('#summernote1').summernote()
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


        // BS-Stepper Init
        // window.stepper1 = new Stepper(document.querySelector('#stepper1'))

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(".datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

        // const name = document.getElementById("namePT");
        // console.log(name.value);
      });
    </script>

    <script>
        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            if($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({scrollTop: scroll_to}, 0);
            }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if(direction == 'right') {
                new_value = now_value + ( 100 / number_of_steps );
            }
            else if(direction == 'left') {
                new_value = now_value - ( 100 / number_of_steps );
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        $(document).ready(function() {
            // Form
            $('.f1 fieldset:first').fadeIn('slow');
            
            // $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
            //     $(this).removeClass('input-error');
            // });
            
            // step selanjutnya (ketika klik tombol selanjutnya)
            $('.f1 .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');
                
                // validasi form
                // parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
                //     if( $(this).val() == "" ) {
                //         $(this).addClass('input-error');
                //         next_step = false;
                //     }
                //     else {
                //         $(this).removeClass('input-error');
                //     }
                // });
                
                if( next_step ) {
                    parent_fieldset.fadeOut(400, function() {
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class( $('.f1'), 20 );
                    });
                }
            });
            
            // step sbelumnya (ketika klik tombol sebelumnya)
            $('.f1 .btn-previous').on('click', function() {
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');
                
                $(this).parents('fieldset').fadeOut(400, function() {
                    // change icons
                    current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'left');
                    // show previous step
                    $(this).prev().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class( $('.f1'), 20 );
                });
            });
            
            // submit (ketika klik tombol submit diakhir wizard)
            // $('.f1').on('submit', function(e) {
            //     // validasi form
            //     $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
            //         if( $(this).val() == "" ) {
            //             e.preventDefault();
            //             $(this).addClass('input-error');
            //         }
            //         else {
            //             $(this).removeClass('input-error');
            //         }
            //     });
            // });
        });
    </script>

    <!--Add Cover LED-->
    <script>
        var i = 1;
        function additemcoverled() {
        //menentukan target append
            var itemlist = document.getElementById('AddCoverLED');
                        
        //membuat element
            var row = document.createElement('tr');
            // var no = document.createElement('td');
            var jenis_upps = document.createElement('td');
            var nama_upps = document.createElement('td');
            var status_upps = document.createElement('td');
            var sk_upps = document.createElement('td');
            var tgl_upps = document.createElement('td');
            var mhs_upps = document.createElement('td');
            var aksi = document.createElement('td');
        
        //meng append element
            itemlist.appendChild(row);
            // row.appendChild(no);
            row.appendChild(jenis_upps);
            row.appendChild(nama_upps);
            row.appendChild(status_upps);
            row.appendChild(sk_upps);
            row.appendChild(tgl_upps);
            row.appendChild(mhs_upps);
            row.appendChild(aksi);
        
        //membuat element input
            // var no_input = document.createElement('input');
            // no_input.setAttribute('name', 'no_input[' + i + ']');
            // no_input.setAttribute('class', 'form-control form-control-sm');
        
            var jenis_pro_input = document.createElement('input');
            jenis_pro_input.setAttribute('name', 'jenis_pro_input[' + i + ']');
            jenis_pro_input.setAttribute('class', 'form-control form-control-sm');

            var nama_pro_input = document.createElement('input');
            nama_pro_input.setAttribute('name', 'nama_pro_input[' + i + ']');
            nama_pro_input.setAttribute('class', 'form-control form-control-sm');

            var status_input = document.createElement('input');
            status_input.setAttribute('name', 'status_input[' + i + ']');
            status_input.setAttribute('class', 'form-control form-control-sm');

            var sk_input = document.createElement('input');
            sk_input.setAttribute('name', 'sk_input[' + i + ']');
            sk_input.setAttribute('class', 'form-control form-control-sm');

            var tgl_kadaluarsa_input = document.createElement('input');
            tgl_kadaluarsa_input.setAttribute('name', 'tgl_kadaluarsa_input[' + i + ']');
            tgl_kadaluarsa_input.setAttribute('class', 'form-control form-control-sm');
            tgl_kadaluarsa_input.setAttribute('type', 'date');

            var jum_mhs_input = document.createElement('input');
            jum_mhs_input.setAttribute('name', 'jum_mhs_input[' + i + ']');
            jum_mhs_input.setAttribute('class', 'form-control form-control-sm');
            jum_mhs_input.setAttribute('type', 'number');
        
            var hapus = document.createElement('span');
        
        //meng append element input
            // no.appendChild(no_input);
            jenis_upps.appendChild(jenis_pro_input);
            nama_upps.appendChild(nama_pro_input);
            status_upps.appendChild(status_input);
            sk_upps.appendChild(sk_input);
            tgl_upps.appendChild(tgl_kadaluarsa_input);
            mhs_upps.appendChild(jum_mhs_input);
            aksi.appendChild(hapus);
        
            hapus.innerHTML = '<button class="btn btn-small btn-danger"><i class="fa fa-trash"></i></button>';
        //  membuat aksi delete element
            hapus.onclick = function () {
                row.parentNode.removeChild(row);
            };
        
            i++;
        }
    </script>
@endpush()