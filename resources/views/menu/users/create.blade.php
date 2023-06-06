@extends('layouts.myapp')
@section('title', 'Pengguna ~ Create')

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
            <h1>Pengguna Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item">Pengguna</li>
              <li class="breadcrumb-item active">Pengguna Baru</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
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
      <form method="POST" action="{{ route('users.store') }}">
      @csrf
        <div class="row">
          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pengguna</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus placeholder="Enter name">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
                      
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Fungsi</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Role</label>
                    <select class="form-control select2bs4 @error('roles') is-invalid @enderror" name="roles" id="roles">
                        <option>Pilih Roles...</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name}}
                        </option>
                        @endforeach
                    </select>
                  </div>
                  <div id="parsingData"></div>
                  <div class="form-group" style="display: none;" id="is_unitKerjaPusat">
                    <label for="exampleInputEmail1">Unit Kerja</label>
                      <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="unitkerja_id" id="unitkerja_idPusat" style="width: 100%;">
                        <option disabled selected="selected">Pilih Unit Kerja...</option>
                        <option value="">Pusat/Pimpinan</option>
                        @foreach($unitKerja as $UK)
                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                        @endforeach
                      </select>
                      
                      @error('unitkerja_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group" style="display: none;" id="is_unitKerja">
                    <label for="exampleInputEmail1">Unit Kerja</label>
                      <select class="form-control select2bs4 @error('unitkerja_id') is-invalid @enderror" value="{{ old('unitkerja_id') }}" name="unitkerja_id" id="unitkerja_id" style="width: 100%;">
                        <option disabled selected="selected">Pilih Unit Kerja...</option>
                        @foreach($unitKerja as $UK)
                          <option value="{{$UK->id}}">{{$UK->name}}</option>  
                        @endforeach
                      </select>
                      
                      @error('unitkerja_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group" style="display: none;" id="is_pimpinan">
                    <label for="exampleInputEmail1">Jabatan</label>
                      <select class="form-control select2bs4 @error('is_pimpinan') is-invalid @enderror" value="{{ old('is_pimpinan') }}" name="is_pimpinan" style="width: 100%;">
                        <option disabled selected="selected">Pilih Jabatan...</option>
                        <option value="D0">Direktur</option>
                        <option value="WD1">Wakil Direktur 1</option>
                        <option value="WD2">Wakil Direktur 2</option>
                        <option value="WD3">Wakil Direktur 3</option>
                        <option value="WD4">Wakil Direktur 4</option>
                      </select>
                      
                      @error('is_pimpinan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <!--<div class="form-group">-->
                  <!--  <label for="exampleInputPassword1">Password</label>-->
                  <!--  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="new-password" placeholder="Password">-->

                  <!--    @error('password')-->
                  <!--        <span class="invalid-feedback" role="alert">-->
                  <!--            <strong>{{ $message }}</strong>-->
                  <!--        </span>-->
                  <!--    @enderror-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--  <label for="exampleInputPassword1">Confirm Password</label>-->
                  <!--  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password" placeholder="Confirm Password">-->
                  <!--</div>-->
                  <!-- <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="checkbox" value="{{ old('checkbox') }}" required>
                    <label class="custom-control-label" for="customCheckbox1">Sudah yakin!</label>
                  </div> -->
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

    <script>
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $("#roles").change(function(){
          var strcari = $("#roles").val();
          console.log(strcari);
            if(strcari == 1){
              $("#is_pimpinan").hide();
              $("#is_unitKerja").hide();
              $("#parsingData").append('<input type="hidden" name="unitkerja_id" value="" class="form-control">');
            }else if(strcari == 2 || strcari == 3){
              $("#is_unitKerja").fadeIn();
              $("#is_pimpinan").hide();
            }else{
              $("#is_unitKerjaPusat").fadeIn()
              $("#is_unitKerja").hide();;
              $("#unitkerja_idPusat").change(function(){
                  var strcari = $("#unitkerja_idPusat").val();
                  console.log(strcari);
                    if(strcari !=""){
                      $("#is_pimpinan").fadeOut();
                    }else{
                      $("#is_pimpinan").fadeIn();
                    }
              });
            }
      });

    </script>

@endpush()