@extends('layouts.myapp')
@section('title', 'Setting Apps')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting Apps</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">APPS</li>
              <li class="breadcrumb-item active">Setting Apps</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

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
                    <a class="nav-link active" id="Apps-tab" data-toggle="pill" href="#Apps" role="tab" aria-controls="Apps" aria-selected="true">Apps</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="Slider-tab" data-toggle="pill" href="#Slider" role="tab" aria-controls="Slider" aria-selected="true">Slider</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="FAQs-tab" data-toggle="pill" href="#FAQs" role="tab" aria-controls="FAQs" aria-selected="true">FAQs</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!-- Apps -->
                  <div class="tab-pane fade show active" id="Apps" role="tabpanel" aria-labelledby="Apps-tab">
                    <form method="POST" action="{{ route('setting.update', $setting->id ) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                          <form class="form-horizontal">
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label required">Judul</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="tittle" value ="{{$setting->tittle}}" id="inputName" placeholder="Enter Judul">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">Ucapan Selamat Datang</label>
                              <div class="col-sm-10">
                                <textarea class="form-control @error('welcome') is-invalid @enderror" rows="3" name="welcome" placeholder="Enter Ucapan">{{ $setting->welcome}}</textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label requiredfilepicture">Logo</label>
                              <div class="col-sm-10">
                                <div>
                                  <img
                                      src="{{ $setting->logo }}"
                                      alt="Signature">
                                </div>
                                <div class="custom-file">
                                  <input type="file" name="logo" class="custom-file-input" id="customFile">
                                  @if(!empty($profile->logo))
                                  <label class="custom-file-label" for="customFile">{{ $setting->logo }}</label>
                                  @else
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label requiredfilepicture">Favicon</label>
                              <div class="col-sm-10">
                                <div>
                                  <img
                                      src="{{ $setting->favicon }}"
                                      alt="Signature">
                                </div>
                                <div class="custom-file">
                                  <input type="file" name="favicon" class="custom-file-input" id="customFile">
                                  @if(!empty($profile->favicon))
                                  <label class="custom-file-label" for="customFile">{{ $setting->favicon }}</label>
                                  @else
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </form>
                  </div>

                  <!-- Slider -->
                  <div class="tab-pane fade" id="Slider" role="tabpanel" aria-labelledby="Slider-tab">
                    @include('menu.setting.slider.Slider')
                  </div>

                  <!-- FAQs -->
                  <div class="tab-pane fade" id="FAQs" role="tabpanel" aria-labelledby="FAQs-tab">
                    @include('menu.setting.faqs.FAQs')
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
    <!--This page plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    @stack('jsSlider')
    @stack('jsFAQs')

    <script>
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

        bsCustomFileInput.init();
      });
      
    </script>

@endpush()