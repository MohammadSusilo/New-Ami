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
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="renops-tab" data-toggle="pill" href="#renops" role="tab" aria-controls="renops" aria-selected="true">Renop</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="kinerjaUnit-tab" data-toggle="pill" href="#kinerjaUnit" role="tab" aria-controls="kinerjaUnit" aria-selected="false">Kinerja Unit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="buktiKinerja-tab" data-toggle="pill" href="#buktiKinerja" role="tab" aria-controls="buktiKinerja" aria-selected="false">Bukti Kinerja</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="renops" role="tabpanel" aria-labelledby="renops-tab">
                    <a href="{{ route('renop.create')}}" class="btn btn-app">
                      <i class="fas fa-plus"></i> New
                    </a>
                    <a href="#" onclick="location.reload();" class="button btn btn-app">
                      <i class="fas fa-sync"></i> Refresh
                    </a>
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Renstra</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <form method="POST" action="{{ route('renop.store') }}" class="subscribe" id="form1">
                            @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Renstra</label>
                                  <select class="form-control select2bs4 @error('renstra') is-invalid @enderror" id="input" name="renstra" style="width: 100%;">
                                    <option disabled selected="selected">Pilih Renstra...</option>
                                    @foreach($renstra as $rens)
                                      <option value="{{$rens->id}}">{{$rens->kode}}</option>  
                                    @endforeach
                                  </select>
                              </div>
                            </form>
                          
                            {{-- <div id="button" data-role="button">Click on button</div> --}}
                            {{-- <table id="renstra" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>SS</th>
                                <th>PU</th>
                                <th>IK</th>
                                <th>Kode</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($renstra as $key=> $rens)
                                  <tr> 
                                    <td>{{ ++ $key }}</td>
                                    <td>{{ $rens->tahun }}</td>
                                    <td>
                                      <button id="input{{$rens->id}}" type="submit" value="{{$rens->id}}">Show</button>
                                      


                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $rens->kode }}</td>
                                    <td>
                                        
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table> --}}
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->

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
                  <div class="tab-pane fade" id="kinerjaUnit" role="tabpanel" aria-labelledby="kinerjaUnit-tab">
                    <a href="{{ route('kinerjaUnit.create') }}" class="btn btn-app">
                      <i class="fas fa-plus"></i> New
                    </a>
                    <table id="kinerja" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nilai Capaian</th>
                          <th>Unit Capaian</th>
                          <th>Renop</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($kinerja as $key=>$kinerjas)
                        <tr data-href='{{ route('buktiKinerja.list', $kinerjas->id) }}'>
                          <td>{{ ++$key }}</td>
                          <td>{{ $kinerjas->nilaiCapaian }}</td>
                          <td>{{ $kinerjas->unitCapaian }}</td>
                          <td>
                            @foreach ($renop as $RN)
                              @if($RN->id == $kinerjas->renop_id)
                                {{ $RN->kode }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $kinerjas->status }}</td>
                          <td>
                          <div class="btn-group">
                            <div style="margin:5px">
                            <!-- Show -->
                            <a href="{{ route('kinerjaUnit.show', $kinerjas->id) }}">
                                <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Edit -->
                            <a href="{{ route('kinerjaUnit.edit', $kinerjas->id) }}">
                                <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                            </a>
                            </div>
                            <div style="margin:5px">
                            <!-- Destroy -->
                            <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('kinerjaUnit.destroy', $kinerjas->id) }}" method="POST" class="is-inline">
                                @csrf
                                @method('DELETE')
                                <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                            </form>
                            </div>

                            <div style="margin:5px">
                            <a href="{{ route('buktiKinerja.new', $kinerjas->id) }}">
                                <button class="button btn btn-link btn-outline-primary is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fas fa-plus"></i> New Bukti</button>
                            </a>
                            </div>
                          </td>
                          </div>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="buktiKinerja" role="tabpanel" aria-labelledby="buktiKinerja-tab">
                    <!-- <a href="{{ route('buktiKinerja.create') }}" class="btn btn-app">
                      <i class="fas fa-plus"></i> New
                    </a> -->
                    <table id="buktis" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Bukti</th>
                          <th>Kinerja Unit</th>
                          <th>Lokasi</th>
                          <th>Tahun</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($bukti as $key=>$buktis)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $buktis->namaBukti }}</td>
                          <td>
                            @foreach ($kinerja as $KU)
                              @if($KU->id == $buktis->kinerjaUnit_id)
                                {{ $KU->deskripsi }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $buktis->lokDokBukti }}</td>
                          <td>{{ $buktis->tahun }}</td>
                          <td>{{ $buktis->status }}</td>
                          <td>
                            <div class="btn-group">
                                <div style="margin:5px">
                                <!-- Show -->
                                <a href="{{ route('buktiKinerja.show', $buktis->id) }}">
                                    <button class="button btn btn-link btn-outline-secondary is-small is-info" data-toggle="tooltip" data-original-title="Lihat Pengguna"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Edit -->
                                <a href="{{ route('buktiKinerja.edit', $buktis->id) }}">
                                    <button class="button btn btn-link btn-outline-warning is-small is-info" data-toggle="tooltip" data-original-title="Ubah Pengguna"><i class="fa fa-edit"></i></button>
                                </a>
                                </div>
                                <div style="margin:5px">
                                <!-- Destroy -->
                                <form onclick="return confirm('Apakah anda yakin hapus data ini?');" action="{{ route('buktiKinerja.destroy', $buktis->id) }}" method="POST" class="is-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button btn btn-link btn-outline-danger is-small is-info" data-toggle="tooltip" data- original-title="Hapus Rule"><i class="fa fa-times"></i></button>
                                </form>
                                </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card content -->    
                </div>
                <!-- /.card body -->    
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
      $.get("{{ url('renopread') }}", {}, function(data,status){
        $("#read").html(data);
      });
    }
  </script>
@endpush()