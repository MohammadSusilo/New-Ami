@extends('layouts.myapp')
@section('title', 'Renop')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" /> --}}
@endpush()

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Renop</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Renop</li>
            </ol>
          </div>   
          <div class="row mb-2">
            <div class="col-sm-4">
              <a href="{{ url()->previous() }}" class="btn btn-app">
                <i class="fas fa-sign-out-alt"></i> Kembali
              </a>
            </div><!-- /.button -->   
          </div><!-- /.row container -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header">
                <h3 class="card-title">Dokumen Acuan</h3>
              </div>
              <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Renop</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="renop" class="table table-bordered table-striped myButton">
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Unit Target</th>
                                <th>Target</th>
                                <th>Tahun</th>
                                <th>Jenis Dokumen</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody id="read">
                                {{-- <div id="read" class="m-2"></div> --}}
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    
                    </div>
                    <!-- /.row -->   
              </div>
              <!-- /.card -->
            </div>
          </div>
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

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}

    <script>
      $(function () {
              $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

        $("#renop").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#renstra').DataTable({
          "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "responsive": true,
        });

        $("#kinerja").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).on('click', 'tbody tr', function() {
          window.location.href = $(this).data('href');
        });

        $('tr').css('cursor','pointer');

        $("#buktis").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      });

    </script>

  <script type="text/javascript">
    $(document).ready(function(){
      readData();
      $("#input").change(function(){
          var strcari = $("#input").val();
          //console.log(strcari);
          if(strcari !=""){
            $("#read").html('<p class="text-muted"> Menunggu Mencari Data... </p>');
            $.ajax({
              url : "{{ url('renopget') }}",
              type : "get",
              data : "name=" + strcari,
              success: function(data)
              {
                  console.log(data);
                  $("#read").html(data);
						      //jQuery($('#topic')).append('<option>Nothing Topic, Please Select Division Others</option>');
                  //jQuery($('#subject_id')).empty();
                  //jQuery.each(data, function(key,value){
                  //  $($('#read')).append('<option value="'+ key +'">'+ value +'</option>');
                  //});
              }
            });
          }else{
                readData();
          }
      });

    });

    function readData(){
      $.get("{{ url('renopreadhistory') }}", {}, function(data,status){
        $("#read").html(data);
      });
    }
  </script>
@endpush()