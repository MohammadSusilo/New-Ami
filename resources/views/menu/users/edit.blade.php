@extends('layouts.myapp')
@section('title', 'Pengguna ~ Edit')

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
            <h1>Ubah Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master Pengguna</li>
              <li class="breadcrumb-item">Pengguna</li>
              <li class="breadcrumb-item active">Ubah Pengguna</li>
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
      <form method="POST" action="{{ route('users.update', $users->id) }}">
      @csrf
      @method('PUT')
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus placeholder="Enter name">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email }}" required autocomplete="email" placeholder="Enter email">
                      
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                    <div id="parsingData"></div>
                    <div class="form-group" style="display: none;" id="is_unitKerja">
                      <label for="exampleInputEmail1">Unit Kerja</label>
                        <select class="form-control select2bs4 unitkerja_id @error('unitkerja_id') is-invalid @enderror" name="unitkerja_id" id="unitkerja_id" style="width: 100%;">
                          @foreach($unitKerja as $UK)
                                        <option value="{{ $UK->id }}"
                                            @if ($UK->id === $users->unitkerja_id)
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
                    <div class="form-group" style="display: none;" id="is_pimpinan">
                      <label for="exampleInputEmail1">Unit Kerja</label>
                        <select class="form-control select2bs4 unitkerja_id @error('unitkerja_id') is-invalid @enderror" name="unitkerja_id" id="unitkerja_idPusat" style="width: 100%;">
                          <option value="" selected>Pusat/Pimpinan</option>
                          @foreach($unitKerja as $UK)
                                        <option value="{{ $UK->id }}"
                                            @if ($UK->id === $users->unitkerja_id)
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
                    <div class="form-group" style="display: none;" id="is_pimpinan">
                      <label for="exampleInputEmail1">Jabatan</label>
                      <select class="form-control select2bs4 is_pimpinan @error('is_pimpinan') is-invalid @enderror" value="{{ old('is_pimpinan') }}" name="is_pimpinan" style="width: 100%;">
                        @if($users->is_pimpinan == "D0")
                          <option value="D0" selected>Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                        @elseif($users->is_pimpinan == "WD1")
                          <option value="D0">Direktur</option>
                          <option value="WD1" selected>Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                        @elseif($users->is_pimpinan == "WD2")
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2" selected>Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                        @elseif($users->is_pimpinan == "WD3")
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3" selected>Wakil Direktur 3</option>
                          <option value="WD4">Wakil Direktur 4</option>
                        @else
                          <option value="D0">Direktur</option>
                          <option value="WD1">Wakil Direktur 1</option>
                          <option value="WD2">Wakil Direktur 2</option>
                          <option value="WD3">Wakil Direktur 3</option>
                          <option value="WD4" selected>Wakil Direktur 4</option>
                        @endif
                      </select>
                      
                      @error('is_pimpinan')
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
                <h3 class="card-title">Account</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Role</label>
                    <select class="custom-select" name="role_id" id="roles">
                      @foreach($roles as $role1)
                          <option 
                              value="{{$role1->id}}"
                              @if ($role1->id === $users->role_id)
                                  selected
                              @endif
                                  >{{$role1->name}}
                          </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input id="re-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="current-password">
                  </div>
                  <div class="form-group clearfix @error('status') is-invalid @enderror">
                      <label>Status</label>
                      @if($users->status == "aktif")
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

      $(document).ready(function(){
          var strcari = $("#roles").val();
          console.log(strcari);
          if(strcari == 1){
            $('#is_pimpinan').hide();
            $('#is_unitKerja').hide();
            $("#parsingData").append('<input type="hidden" name="unitkerja_id" value="" class="form-control">');
          }else if(strcari == 2 || strcari == 3){
            $("#is_unitKerja").fadeIn();
            $('#is_pimpinan').hide();
          }else{
            $('#is_unitKerja').hide();
            $('#is_unitKerjaPusat').fadeIn();
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