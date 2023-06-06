@extends('layouts.myapp')
@section('title', 'Tindak Lanjut TM ~ Edit')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <script src="{{ asset('plugins/timepicker/timepicker.css') }}"></script>
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
            <h1>Ubah Tindak Lanjut TM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Renop</li>
              <li class="breadcrumb-item">Tinjauan Manajemen</li>
              <li class="breadcrumb-item active">Ubah Tindak Lanjut TM</li>
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
      <form method="POST" action="{{ route('tindakLanjutTM.update', $tindakTM->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Tindak Lanjut TM</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                @if(auth()->user()->role_id == 1)
                  <div class="form-group">
                    <label class="required">Jadwal TM</label>
                    <select class="form-control select2bs4" id="hslrpt_id" name="hslrpt_id" data-placeholder="Select a Users" style="width: 100%;">
                      @foreach ($hasilTM as $hasil)
                        <option value="{{ $hasil->id }}"
                          @if ($hasil->id === $tindakTM->hslrpt_id)
                              selected
                          @endif
                              >{{$hasil->subjek}}
                        </option>
                      @endforeach
                    </select>

                      @error('hslrpt_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">Tindak Lanjut</label>
                      <textarea class="form-control @error('tindakLanjut') is-invalid @enderror" rows="3" name="tindakLanjut" placeholder="Enter tindakLanjut">{{ $tindakTM->tindakLanjut }}</textarea>

                        @error('tindakLanjut')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="required">PIC</label>

                      <select class="form-control select2bs4 @error('PIC') is-invalid @enderror" name="PIC[]" id="PIC" multiple="multiple" data-placeholder="Select a Users" style="width: 100%;">

                        @foreach($users as $key=>$user)
                          <option {{ in_array($user->id, $tes) ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>

                        @error('PIC')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                @endif
                @if(auth()->user()->role_id == 1)
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                    <label>Status</label>
                      @if($tindakTM->status == "selesai")
                        <div class="icheck-success">
                          <input type="radio" id="radioPrimary1" name="status" value="selesai" checked>
                          <label for="radioPrimary1">
                          Selesai
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" id="radioPrimary2" name="status" value="nonselesai">
                          <label for="radioPrimary2">
                            Belum Selesai
                          </label>
                        </div>
                      @else
                        <div class="icheck-success">
                          <input type="radio" id="radioPrimary1" name="status" value="selesai">
                          <label for="radioPrimary1">
                          Selesai
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" id="radioPrimary2" name="status" value="nonselesai" checked>
                          <label for="radioPrimary2">
                            Belum Selesai
                          </label>
                        </div>
                      @endif
                    
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                @endif
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateTindakTM">
                    Submit
                </button>
              </div>

                <div class="modal fade" id="updateTindakTM">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Tindak Lanjut TM</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p style="text-align: center;">Apakah anda akan mengubah data Tindak Lanjut TM : {{ $tindakTM->tindakLanjut }} !!!</p>
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
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('plugins/timepicker/timepicker.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    

    <script>
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('#renstra').select2({
        theme: 'bootstrap4'
      })
      
      bsCustomFileInput.init();

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
        
        $("#datepicker1").datepicker({
            format: "yyyy-mm-dd",
            viewMode: "date", 
            minViewMode: "date"
        });

        $('.timepicker').clockpicker()
          .find('input').change(function(){
            console.log(this.value);
          });
        var input = $('#single-input').clockpicker({
          placement: 'bottom',
          align: 'left',
          autoclose: true,
          'default': 'now'
        });
      });
    </script>

@endpush()