@extends('layouts.myapp')
@section('title', 'Dashboard')
@push('css')

@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard {{auth()->user()->name}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null)
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Dok Induk</span>
                          <span class="info-box-number">{{ $tile['dokInduk'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="far fa-file-alt"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Dok Checklist</span>
                          <span class="info-box-number">{{ $tile['dokChecklist'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('PimpinanUnitKerja') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Pimpinan</span>
                          <span class="info-box-number">{{ $tile['pimpinan'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('PimpinanUnitKerja') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users-cog"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Pengelola UK</span>
                          <span class="info-box-number">{{ $tile['pengelola'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Dok Acuan</span>
                          <span class="info-box-number">{{ $tile['renstra'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Renop</span>
                          <span class="info-box-number">{{ $tile['renop'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('PimpinanUnitKerja') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Unit Kerja</span>
                          <span class="info-box-number">{{ $tile['unitKerja'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('users') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Users</span>
                          <span class="info-box-number">{{ $tile['users'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Kinerja Unit</span>
                          <span class="info-box-number">{{ $tile['kinerjaUnit'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-archive"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Bukti Kinerja</span>
                          <span class="info-box-number">{{ $tile['buktiKinerja'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-week"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Jadwal Audit</span>
                          <span class="info-box-number">{{ $tile['jadwalAudit'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-archive"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Laporan Audit</span>
                          <span class="info-box-number">{{ $tile['laporanAudit'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-signature"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">CAR</span>
                          <span class="info-box-number">{{ $tile['CAR'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-minus"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Jadwal TM</span>
                          <span class="info-box-number">{{ $tile['jadwalTM'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-contract"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bahan TM</span>
                        <span class="info-box-number">{{ $tile['bahanTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sticky-note"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Hasil TM</span>
                        <span class="info-box-number">{{ $tile['hasilTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-medical-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tindak Lanjut TM</span>
                        <span class="info-box-number">{{ $tile['tindakTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
        @elseif(auth()->user()->role_id == 2)
            <div class="col-12 col-sm-12 col-md-12">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="far fa-file-alt"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Dok Checklist</span>
                          <span class="info-box-number">{{ $tile['dokChecklist'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Renop</span>
                          <span class="info-box-number">{{ $tile['renop'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Kinerja Unit</span>
                      <span class="info-box-number">{{ $tile['kinerjaUnit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-archive"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Bukti Kinerja</span>
                      <span class="info-box-number">{{ $tile['buktiKinerja'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-week"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Jadwal Audit</span>
                      <span class="info-box-number">{{ $tile['jadwalAudit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-archive"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Laporan Audit</span>
                      <span class="info-box-number">{{ $tile['laporanAudit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-signature"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">CAR</span>
                      <span class="info-box-number">{{ $tile['CAR'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-minus"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Jadwal TM</span>
                      <span class="info-box-number">{{ $tile['jadwalTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-contract"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Bahan TM</span>
                      <span class="info-box-number">{{ $tile['bahanTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sticky-note"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Hasil TM</span>
                      <span class="info-box-number">{{ $tile['hasilTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-medical-alt"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Tindak Lanjut TM</span>
                      <span class="info-box-number">{{ $tile['tindakTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
        @else
            <div class="col-12 col-sm-12 col-md-12">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="far fa-file-alt"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Dok Checklist</span>
                      <span class="info-box-number">{{ $tile['dokChecklist'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Renop</span>
                          <span class="info-box-number">{{ $tile['renop'] }}</span>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Kinerja Unit</span>
                      <span class="info-box-number">{{ $tile['kinerjaUnit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('RencanaStrategisRencanaOperasional') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-archive"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Bukti Kinerja</span>
                      <span class="info-box-number">{{ $tile['buktiKinerja'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-week"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Jadwal Audit</span>
                      <span class="info-box-number">{{ $tile['jadwalAudit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-archive"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Laporan Audit</span>
                      <span class="info-box-number">{{ $tile['laporanAudit'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ url('AMI') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-signature"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">CAR</span>
                      <span class="info-box-number">{{ $tile['CAR'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-minus"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Jadwal TM</span>
                      <span class="info-box-number">{{ $tile['jadwalTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-contract"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Bahan TM</span>
                      <span class="info-box-number">{{ $tile['bahanTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sticky-note"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Hasil TM</span>
                      <span class="info-box-number">{{ $tile['hasilTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('TinjauanManajemen') }}">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-medical-alt"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">Tindak Lanjut TM</span>
                      <span class="info-box-number">{{ $tile['tindakTM'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              <!-- /.info-box -->
            </div>
        @endif
        </div>
        <!-- /.row -->

					<!-- Statistic Tickets -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Grafik data AMI Politeknik Negeri Semarang</div>
									</div>
								</div>
								<div class="card-body">
                  <canvas id="lineChart"></canvas>
								</div>
							</div>
						</div>
					</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}

    <!-- Chart JS -->
    {{-- <script src="https://technext.github.io/quixlab/plugins/chart.js/Chart.bundle.min.js"></script> --}}
    <script src="{{ asset('plugins/chart.js/chartJS.min.js') }}"></script>

    <script type="text/javascript">
    //line chart
    var ctx = document.getElementById("lineChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($label); ?>,
            datasets: [
                {
                    label: "Dokumen Acuan",
                    borderColor: '#46F1EA',
                    pointBackgroundColor: 'rgba(70,241,234, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(70,241,234, 0.4)',
                    legendColor: '#46F1EA',
                    fill: true,
                    borderWidth: 2,
                    data: <?php echo json_encode($renstra); ?>
                },{
                    label: "Renop",
                    borderColor: '#03fc30',
                    pointBackgroundColor: 'rgba(3, 252, 48, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(3, 252, 48, 0.4)',
                    legendColor: '#03fc30',
                    fill: true,
                    borderWidth: 2,
                    data: <?php echo json_encode($renop); ?>
                },{
                    label: "Dokumen Induk",
                    borderColor: '#fdaf4b',
                    pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(253, 175, 75, 0.4)',
                    legendColor: '#fdaf4b',
                    fill: true,
                    borderWidth: 2,
                    data: <?php echo json_encode($dokInduk); ?>
                },{
                    label: "Dokumen Checklist",
                    borderColor: '#177dff',
                    pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(23, 125, 255, 0.4)',
                    legendColor: '#177dff',
                    fill: true,
                    borderWidth: 2,
                    data: <?php echo json_encode($dokCheck); ?>
                },{
                  label: "Jadwal Audit",
                  borderColor: '#3E8E7E',
                  pointBackgroundColor: 'rgba(62, 142, 126, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(62, 142, 126, 0.4)',
                  legendColor: '#3E8E7E',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($jadwalAudit); ?>
                },{
                  label: "Laporan Audit",
                  borderColor: '#F05454',
                  pointBackgroundColor: 'rgba(240, 84, 84, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(240, 84, 84, 0.4)',
                  legendColor: '#F05454',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($laporanAudit); ?>
                },{
                  label: "CAR",
                  borderColor: '#2D4263',
                  pointBackgroundColor: 'rgba(45, 66, 99, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(45, 66, 99, 0.4)',
                  legendColor: '#2D4263',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($CAR); ?>
                },{
                  label: "Jadwal TM",
                  borderColor: '#97BFB4',
                  pointBackgroundColor: 'rgba(151, 191, 180, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(151, 191, 180, 0.4)',
                  legendColor: '#97BFB4',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($jadwalTM); ?>
                },{
                  label: "Hasil TM",
                  borderColor: '#4F091D',
                  pointBackgroundColor: 'rgba(79, 9, 29, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(79, 9, 29, 0.4)',
                  legendColor: '#4F091D',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($hasilTM); ?>
                },{
                  label: "Bahan TM",
                  borderColor: '#B983FF',
                  pointBackgroundColor: 'rgba(185, 131, 255, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(185, 131, 255, 0.4)',
                  legendColor: '#B983FF',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($bahanTM); ?>
                },{
                  label: "Tindak Lanjut TM",
                  borderColor: '#172774',
                  pointBackgroundColor: 'rgba(23, 39, 116, 0.6)',
                  pointRadius: 0,
                  backgroundColor: 'rgba(23, 39, 116, 0.4)',
                  legendColor: '#172774',
                  fill: true,
                  borderWidth: 2,
                  data: <?php echo json_encode($tindakTM); ?>
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });
	</script>
@endpush()