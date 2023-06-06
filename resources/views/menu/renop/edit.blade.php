@extends('layouts.myapp')
@section('title', 'Renop ~ Edit')

@push('css')
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
            <h1>Ubah Renop</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Renop</li>
              <li class="breadcrumb-item active">Ubah Renop</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
              <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
          </div><!-- /.button -->   
        </div><!-- /.row container -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- form start -->
      <form method="POST" action="{{ route('renop.update', $renop->id) }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Renop</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Kode</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $renop->kode }}">

                      @error('kode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{ $renop->deskripsi }}</textarea>
                    <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ $renop->deskripsi }}"> -->

                      @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Target</label>
                    <input type="number" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ $renop->target }}">

                      @error('target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Unit Target</label>
                    <input type="text" class="form-control @error('unit_target') is-invalid @enderror" name="unit_target" value="{{ $renop->unit_target }}">

                      @error('unit_target')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text"  id="datepicker" name="tahun" value="{{ $renop->tahun }}" class="form-control @error('tahun') is-invalid @enderror">

                      @error('tahun')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Unit Kerja</label>
                      <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="unitkerja_id" style="width: 100%;">
                        @foreach($unitKerja as $UK)
                          <option 
                              value="{{$UK->id}}"
                              @if ($UK->id === $renop->unitkerja_id)
                                  selected
                              @endif
                                  >{{$UK->name}}
                          </option>
                        @endforeach
                      </select>
                      
                      @error('unitkerja_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Dokumen Acuan</label>
                    <select class="select2 @error('renstra') is-invalid @enderror" name="renstra[]" id="renstra" multiple="multiple" data-placeholder="Select a Renop" style="width: 100%;">
                        @foreach($dokAcuans as $dokAcuan)
                          {{-- <option @php if (in_array($dokAcuan->id, $renop->renstra->toArray())) { echo "selected"; } @endphp value="{{ $dokAcuan->id }}">{{ $dokAcuan->name }}</option>  --}}
                          {{-- <option {{ in_array($dokAcuan->id, $kirim) ? 'selected' : ''}} value="{{$dokAcuan->id}}">{{$dokAcuan->name}}</option> --}}
                          <option {{ in_array($dokAcuan->id, $send) ? 'selected' : ''}} value="{{$dokAcuan->id}}">{{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})</option>
                          {{-- <option 
                              value="{{$dokAcuan->id}}"
                              @if ($dokAcuan->id === $kirim)
                                  selected
                              @endif
                                  >{{ $dokAcuan->kode}} ({{ strtoupper($dokAcuan->jenis) }} - {{ $dokAcuan->tahun}})
                          </option> --}}
                        @endforeach
                    </select>
                      
                      @error('renstra')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <label>Status</label>
                      @if($renop->status == "aktif")
                      <div class="icheck-success">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif" checked>
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="status" value="nonaktif">
                        <label for="radioPrimary2">
                          Tidak Aktif
                        </label>
                      </div>

                      @else

                      <div class="icheck-success">
                        <input type="radio" id="radioPrimary1" name="status" value="aktif">
                        <label for="radioPrimary1">
                          Aktif
                        </label>
                      </div>
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="status" value="nonaktif" checked>
                        <label for="radioPrimary2">
                          Tidak Aktif
                        </label>
                      </div>
                      @endif
                      
                      @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateRenop">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateRenop">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Renop</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Renop : {{ $renop->kode }} !!!</p>
                        <center>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-success">Iya</button>
                        </center>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </form>
        <!-- form finish -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renstra').select2({
        theme: 'bootstrap4'
      })

      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
      });
    </script>

@endpush()