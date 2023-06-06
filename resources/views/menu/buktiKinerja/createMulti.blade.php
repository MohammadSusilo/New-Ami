@extends('layouts.myapp')
@section('title', 'New Multi Bukti Kinerja')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

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
            <h1>New Bukti Kinerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item"><a href="#">Renop</a></li>
              <li class="breadcrumb-item"><a href="#">Bukti Kinerja</a></li>
              <li class="breadcrumb-item active">New Multi Bukti Kinerja</li>
            </ol>
          </div>
          <div class="col-sm-4">
            <a href="{{ url()->previous() }}" class="btn btn-app">
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
      <form method="POST" action="{{ route('buktiKinerja.saveMulti') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Bukti Kinerja</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped" id="buktiMultiTable">  
                    <tr>
                        <th class="required">Nama Bukti</th>
                        <th class="required">Deskripsi</th>
                        <th>Tahun</th>
                        <th class="requiredfile">File</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <input name="kinerjaUnit_id" type="hidden" value="{{$idKU}}">
                        <td>
                            <input type="text" class="form-control @error('namaBukti') is-invalid @enderror" name="addmore[0][namaBukti]" value="{{ old('namaBukti') }}" autofocus placeholder="Enter Nama Bukti">
                            @error('addmore.0.namaBukti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>  
                        <td>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore[0][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                            <!-- <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="addmore[0][deskripsi]" value="{{ old('deskripsi') }}" placeholder="Enter deskripsi"> -->
                            @error('addmore.0.deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>  
                        <td>
                            <input type="text" name="addmore[0][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">
                            @error('addmore.0.tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>  
                        <td>
                            <div class="custom-file">
                              <input type="file" name="addmore[0][lokDokBukti]" class="custom-file-input @error('lokDokBukti') is-invalid @enderror" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                              @error('addmore.0.lokDokBukti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                        </td>  
                        <td>
                            <div class="form-group clearfix @error('status') is-invalid @enderror">
                                <div class="icheck-success">
                                    <input type="radio" id="selectAktifBukti0" name="addmore[0][status]" value="aktif" checked>
                                    <label for="selectAktifBukti0">
                                        Aktif
                                    </label>
                                </div>

                                <div class="icheck-danger">
                                    <input type="radio" id="selectNonAktifBukti0" name="addmore[0][status]" value="nonaktif">
                                    <label for="selectNonAktifBukti0">
                                        Non Aktif
                                    </label>
                                </div>
                            </div>
                            @error('addmore.0.status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>  
                        <td>
                            <button type="button" name="add" id="addBukti" class="btn btn-success"><i class="fas fa-plus"></i></button>
                        </td>  
                    </tr>  
                </table>                  
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    

    <script>
      //Initialize Select2 Elements
      // $('.select2bs4').select2({
      //   theme: 'bootstrap4'
      // })
      // $('#renstra').select2({
      //   theme: 'bootstrap4'
      // })
      
      bsCustomFileInput.init();

      // $(function () {
      //   $("#example1").DataTable({
      //     "responsive": true, "lengthChange": false, "autoWidth": false,
      //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      //   $("#datepicker").datepicker({
      //       format: "yyyy",
      //       viewMode: "years", 
      //       minViewMode: "years"
      //   });
      // });

      // Add Row Bukti Multi Record
      var i = 0;
      $("#addBukti").click(function(){
          // var datasend = $('#input[name=datasend]');
          var datasend = $("#datasend").val();
          console.log(datasend);
          ++i;
          $("#buktiMultiTable").append(
              '<tr>'+
                  '<td><input type="text" class="form-control @error('namaBukti') is-invalid @enderror" name="addmore['+i+'][namaBukti]" value="{{ old('namaBukti') }}" autofocus placeholder="Enter Nama Bukti">'+
                      '@error('addmore.[+i+].namaBukti')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td><textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="addmore['+i+'][deskripsi]" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>'+
                      '@error('addmore.[+i+].deskripsi')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td><input type="text" name="addmore['+i+'][tahun]" value="{{ old('tahun') }}" class="form-control dateYear @error('tahun') is-invalid @enderror" placeholder="Enter Tahun">'+
                      '@error('addmore.[+i+].tahun')'+
                          '<span class="invalid-feedback" role="alert">'+
                              '<strong>{{ $message }}</strong>'+
                          '</span>'+
                      '@enderror'+
                  '</td>'+
                  '<td>'+
                      '<div class="custom-file">'+
                          '<input type="file" name="addmore['+i+'][lokDokBukti]" class="custom-file-input @error('lokDokBukti') is-invalid @enderror"" id="customFile">'+
                          '<label class="custom-file-label" for="customFile">Choose file</label>'+
                          '@error('addmore.[+i+].lokDokBukti')'+
                              '<span class="invalid-feedback" role="alert">'+
                                  '<strong>{{ $message }}</strong>'+
                              '</span>'+
                          '@enderror'+
                      '</div>'+
                  '</td>'+
                  '<td>'+
                      '<div class="form-group @error('status') is-invalid @enderror">'+
                          '<div class="icheck-success">'+
                              '<input type="radio" id="selectAktifBukti['+i+']" name="addmore['+i+'][status]" value="aktif" checked>'+
                              '<label for="selectAktifBukti['+i+']">Aktif</label>'+
                          '</div>'+
                          '<div class="icheck-danger">'+
                              '<input type="radio" id="selectNonAktifBukti['+i+']" name="addmore['+i+'][status]" value="nonaktif">'+
                              '<label for="selectNonAktifBukti['+i+']">Non Aktif</label>'+
                          '</div>'+
                                
                          '@error('addmore.[+i+].status')'+
                              '<span class="invalid-feedback" role="alert">'+
                                  '<strong>{{ $message }}</strong>'+
                              '</span>'+
                          '@enderror'+
                      '</div>'+
                  '</td>'+
                  '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>'+
              '</tr>');
                                  
      });

      $(document).on('click', '.custom-file', function(){  
          bsCustomFileInput.init();
      });
       
      $(document).on('click', '.select2bs4', function(){  
          $(this).select2({
              theme: 'bootstrap4'
          })
      });

      $(document).on('focus', '.dateYear', function(){  
          $(this).datepicker({
              format: "yyyy",
              viewMode: "years", 
              minViewMode: "years"
          });
      });      

      $(document).on('click', '.remove-tr', function(){  
              $(this).parents('tr').remove();
      });     
    </script>

@endpush()