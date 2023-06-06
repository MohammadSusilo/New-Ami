@extends('layouts.myapp')
@section('title', 'Profile')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" /> --}}

    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  -->
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <!--<link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">-->
  
    <style>
        /* Styles for signature plugin v1.2.0. */
        .kbw-signature {
        	display: inline-block;
        	border: 1px solid #a0a0a0;
        	-ms-touch-action: none;
        }
        .kbw-signature-disabled {
        	opacity: 0.35;
        }
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                @if(!empty($profile->foto))
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$profile->foto}}"
                       alt="User profile picture">
                </div>
                @else
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('images/img_user.jpg') }}"
                       alt="User profile picture">
                </div>
                @endif

                <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                @if(!empty($unitKerja->name))
                  <p class="text text-left">Pengelola : {{$unitKerja->pengelolaUnitKerja->name}}</p>
                  <p class="text text-left">Unit Kerja : {{$unitKerja->name}}</p>
                  <p class="text text-left">Jabatan : {{$profile->jabatan}}</p>
                @else
                  <p class="text text-left">Pengelola : PUSAT</p>
                  <p class="text text-left">Unit Kerja : Pusat Penjaminan Mutu Pendidikan (PPMP)</p>
                  <p class="text text-left">Jabatan : {{$profile->jabatan}}</p>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <!-- form start -->
                            <form method="POST" action="{{ route('profile.update', auth()->user()->id ) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- {{ csrf_field() }} -->
                                <form class="form-horizontal">
                                  <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label required">Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="name" value ="{{$users->name}}" id="inputName" placeholder="Name">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control" disabled name="email" value ="{{$users->email}}" id="inputEmail" placeholder="Email">
                                    </div>
                                  </div>
                                  @if(!empty($profile->jabatan))
                                  <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="jabatan" value="{{$profile->jabatan}}" class="form-control" placeholder="Jabatan">
                                    </div>
                                  </div>
                                  @else
                                  <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                                    </div>
                                  </div>
                                  @endif
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                      @if($users->status == "aktif")
                                      <span class="badge badge-pill badge-success">Aktif</span>
                                      @else
                                      <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                      <div class="custom-file">
                                        <input type="file" name="foto" class="custom-file-input" id="customFile">
                                        @if(!empty($profile->foto))
                                        <label class="custom-file-label" for="customFile">{{ $profile->foto }}</label>
                                        @else
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label required">Signature</label>
                                    <div class="col-sm-4">
                                      @if($profile->signature != null || !empty($profile->signature))
                                      <div>
                                        <img
                                            src="{{ $profile->signature }}"
                                            alt="Signature">
                                      </div>
                                      @endif
                                      <div id="sig" ></div>
                                      <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                      <textarea id="signature64" name="signed" style="display: none"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                </form>
                            </form>
                            <!-- form finish -->
                        </div>
                        
                        <div class="tab-pane" id="password">
                            @if(count($errors) > 0 )
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- form start -->
                            <form method="POST" action="{{ route('profile.password', auth()->user()->id ) }}" enctype="multipart/form-data">
                            <!--<form method="POST" action="{{ route('profile.password', auth()->user()->id ) }}" enctype="multipart/form-data">-->
                            @csrf
                            @method('PUT')
                            <!-- {{ csrf_field() }} -->
                                <!--<form class="form-horizontal">-->
                                  <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label required">Password Baru</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Ulang Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control @error('repassword') is-invalid @enderror" name="password_confirmation" placeholder="Ulang Password" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                <!--</form>-->
                            </form>
                            <!-- form finish -->
                        </div>
                    </div>
                    <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
        <!-- bs-custom-file-input -->
        <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <!--<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>-->
    <script type="text/javascript" src="{{ asset('js/signature.js') }}"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>

    
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

        bsCustomFileInput.init();
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
      $.get("{{ url('renopread') }}", {}, function(data,status){
        $("#read").html(data);
      });
    }
  </script>
@endpush()