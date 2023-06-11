@extends('layouts.myapp')
@section('title', 'Dokumen Polines ~ Create')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush()

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dokumen Polines</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Dokumen Polines</li>
                    </ol>
                </div>
                <div class="col-sm-4">
                    <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
                    <a href="{{ url('/RencanaStrategisRencanaOperasional') }}" class="btn btn-app">
                        <i class="fas fa-sign-out-alt"></i> Back
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- form start -->
            <form method="POST" action="{{ route('dokumenPolines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Dokumen Polines</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                               
                                @if(auth()->user()->role_id != 3)
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Unit Kerja</label>
                                    <!-- <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror"  name="unitkerja_id" style="width: 100%;"> -->
                                    <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" id="input" name="unitkerja_id" style="width: 100%;">
                                        <option disabled selected="selected">Pilih Unit Kerja...</option>
                                        @foreach($unitKerja as $unitKer)
                                        <option {{ ($unitKer->id) == old('unitkerja_id') ? 'selected' : '' }} value="{{$unitKer->id}}">{{$unitKer->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('unitkerja_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $("#dokinduk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#dokcheck').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        bsCustomFileInput.init();

        $("#datepicker1").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
</script>

@endpush()