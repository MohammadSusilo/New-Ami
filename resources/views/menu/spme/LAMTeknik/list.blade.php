@extends('layouts.myapp')
@section('title', 'SPME ~ LAM TEKNIK')

@push('css')

@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAM TEKNIK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">SPME</li>
              <li class="breadcrumb-item active">LAM Teknik</li>
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
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0">
                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" role="tab" href="#LED" data-target="#LED" aria-controls="LED" aria-selected="true">LED</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" role="tab" href="#LKPS" data-target="#LKPS" aria-controls="LKPS" aria-selected="true">LKPS</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-one-tabContent">
                            <!-- Instant Create -->
                            <!-- Jadwal Audit -->
                            <div id="LED" class="tab-pane fade show active" role="tabpanel">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-12" id="accordion">
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse1">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        1. Cover
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse1" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        COVER LED LAM TEKNIK
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                        </div>
                                                        <span class="badge bg-info">5 Step Total</span>
                                                        <span class="badge bg-success">4 Step Selesai</span>
                                                        <span class="badge bg-danger">1 Step Belum Selesai</span>
                                                        <div class="text-right">
                                                            <a href="{{ url('/LAMTeknik/LED/Cover/'.$idku) }}">
                                                                <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse2">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        2. BAB I Pendahuluan
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse2" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        PENDAHULUAN LED LAM TEKNIK
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                            </div>
                                                            <span class="badge bg-info">{{ $countAllPendahuluan }} Step Total</span>
                                                            <span class="badge bg-success">{{ $countCheckPendahuluanNN }} Step Selesai</span>
                                                            <span class="badge bg-danger">{{ $countCheckPendahuluanN }} Step Belum Selesai</span>
                                                            <div class="text-right">
                                                                <a href="{{ url('/LAMTeknik/LED/BAB1/'.$idku) }}">
                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                </a>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse3">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        3. BAB II Struktur Laporan Evaluasi Diri
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse3" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card card-secondary card-outline">
                                                            <div class="card-header">
                                                                <h4 class="card-title w-100">
                                                                    A.	Struktur tim penyusun dan mekanisme kerja
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                BAB II A LED LAM TEKNIK
                                                                <div class="text-right">
                                                                    <a href="{{ url('/LAMTeknik/LED/BAB2/Struktur') }}">
                                                                        <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
        
                                                        <div class="card card-secondary card-outline">
                                                            <div class="card-header">
                                                                <h4 class="card-title w-100">
                                                                    B.	Kondisi Eksternal
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                BAB II B LED LAM TEKNIK
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                                    </div>
                                                                    <span class="badge bg-info">{{ $countAllKondisiEksternal }} Step Total</span>
                                                                    <span class="badge bg-success">{{ $countCheckKondisiEksternalNN }} Step Selesai</span>
                                                                    <span class="badge bg-danger">{{ $countCheckKondisiEksternalN }} Step Belum Selesai</span>
                                                                    <div class="text-right">
                                                                        <a href="{{ url('/LAMTeknik/LED/BAB2/KondisiEksternal/'.$idku) }}">
                                                                            <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                        </a>
                                                                    </div>
                                                            </div>
                                                        </div>
        
                                                        <div class="card card-secondary card-outline">
                                                            <div class="card-header">
                                                                <h4 class="card-title w-100">
                                                                    C.	Profil UPPS
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                BAB II C LED LAM TEKNIK
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                                    </div>
                                                                    <span class="badge bg-info">{{ $countAllProfilUPPS }} Step Total</span>
                                                                    <span class="badge bg-success">{{ $countCheckProfilUPPSNN }} Step Selesai</span>
                                                                    <span class="badge bg-danger">{{ $countCheckProfilUPPSN }} Step Belum Selesai</span>
                                                                    <div class="text-right">
                                                                        <a href="{{ url('/LAMTeknik/LED/BAB2/ProfilUPPS/'.$idku) }}">
                                                                            <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                        </a>
                                                                    </div>
                                                            </div>
                                                        </div>
        
                                                        <div class="card card-secondary card-outline">
                                                            <div class="card-header">
                                                                <h4 class="card-title w-100">
                                                                    D.	Kriteria Akreditasi
                                                                </h4>
                                                            </div>
                                                                <div class="card-body">
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                1.	Visi, Misi, Tujuan dan Strategi
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 1 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria1') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                2.	Tata Pamong, Tata Kelola dan Kerja sama
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 2 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria2') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                3.	Mahasiswa
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 3 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria3') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                4.	Sumber Daya Manusia
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 4 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria4') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                5.	Keuangan, Sarana dan Prasarana
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 5 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria5') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                6.	Pendidikan
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 6 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria6') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                7.	Penelitian
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 7 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria7') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                8.	Pengabdian kepada Masyarakat
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 8 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria8') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title w-100">
                                                                                9.	Luaran dan Capaian Tridharma Perguruan Tinggi
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            KRITERIA 9 LED LAM TEKNIK
                                                                            <div class="text-right">
                                                                                <a href="{{ url('/LAMTeknik/LED/BAB2/Kriteria9') }}">
                                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse4">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        4. BAB III Penjaminan Mutu
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse4" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        PENJAMINAN MUTU LED LAM TEKNIK
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                            </div>
                                                            <span class="badge bg-info">{{ $countAllPendahuluan }} Step Total</span>
                                                            <span class="badge bg-success">{{ $countCheckPendahuluanNN }} Step Selesai</span>
                                                            <span class="badge bg-danger">{{ $countCheckPendahuluanN }} Step Belum Selesai</span>
                                                            <div class="text-right">
                                                                <a href="{{ url('/LAMTeknik/LED/BAB3/'.$idku) }}">
                                                                    <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                                </a>
                                                            </div>
                                                        {{-- <div class="text-right">
                                                            <a href="{{ url('/LAMTeknik/LED/BAB3') }}">
                                                                <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                            </a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse5">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        5. BAB IV Program Pengembangan Berkelanjutan
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse5" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        PROGRAM PENGEMBANGAN BERKELANJUTAN LED LAM TEKNIK
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                        </div>
                                                        <span class="badge bg-info">{{ $countAllPendahuluan }} Step Total</span>
                                                        <span class="badge bg-success">{{ $countCheckPendahuluanNN }} Step Selesai</span>
                                                        <span class="badge bg-danger">{{ $countCheckPendahuluanN }} Step Belum Selesai</span>
                                                        <div class="text-right">
                                                            <a href="{{ url('/LAMTeknik/LED/BAB4/'.$idku) }}">
                                                                <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse6">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        6. BAB V Penutup
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse6" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        PENUTUP LED LAM TEKNIK
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                        </div>
                                                        <span class="badge bg-info">{{ $countAllPendahuluan }} Step Total</span>
                                                        <span class="badge bg-success">{{ $countCheckPendahuluanNN }} Step Selesai</span>
                                                        <span class="badge bg-danger">{{ $countCheckPendahuluanN }} Step Belum Selesai</span>
                                                        <div class="text-right">
                                                            <a href="{{ url('/LAMTeknik/LED/BAB5/'.$idku) }}">
                                                                <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapse7">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        7. Lampiran
                                                    </h4>
                                                </div>
                                                </a>
                                                <div id="collapse7" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        LAMPIRAN LED LAM TEKNIK
                                                        <div class="text-right">
                                                            <a href="{{ url('/LAMTeknik/LED/Lampiran') }}">
                                                                <button class="button btn btn-xl btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-sign-in"></i> PILIH</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
          
                            <!-- Laporan Audit -->
                            <div id="LKPS" class="tab-pane fade" role="tabpanel">
                              {{-- @include('menu.menuInduk.submenuInduk.laporanAudit') --}}
                            </div>
                          </div>
                          <!-- /.card body -->    
                        </div>
                        <!-- /.card -->
                    </div>
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

@endpush()