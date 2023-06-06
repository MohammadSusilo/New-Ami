@extends('layouts.myapp')
@section('title', 'Menu ~ Show')

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
            <h1>Lihat Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Apps</li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">Lihat Menu</li>
            </ol>
          </div><!-- /.breadcrumb -->
        </div><!-- /.row container -->

        <div class="row mb-2">
          <div class="col-sm-4">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-app"> -->
            <a href="{{ url('menu') }}" class="btn btn-app">
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
      {{-- <form method="POST" action="{{ route('kinerjaUnit.store') }}">
      @csrf --}}
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
                            <th>Judul</th>
                            <td>:</td>
                            <td>{{ $menu->name }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>:</td>
                            <td>                              
                                @if($menu->master == "0")
                                  <span class="badge badge-pill badge-info">Main Menu</span>
                                @else
                                  <span class="badge badge-pill badge-danger">Sub Main Menu</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Master</th>
                            <td>:</td>
                            <td>{{ $menu->master }}</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td>:</td>
                            <td>{{ $menu->url }}</td>
                        </tr>
                        <tr>
                            <th>Icon</th>
                            <td>:</td>
                            <td>{{ $menu->icon }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>:</td>
                            <td>
                              @foreach($roles as $role)
                                  @foreach(explode(',', $menu->role_id) as $info) 
                                      @if($role->id == $info )    
                                          <span class="badge badge-pill badge-primary">{{$role->name}}</span>
                                      @endif
                                  @endforeach
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Sorting</th>
                            <td>:</td>
                            <td>{{ $menu->sorting }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                              @if($menu->status == "aktif")
                                <span class="badge badge-pill badge-success">Aktif</span>
                              @else
                                <span class="badge badge-pill badge-danger">Non Aktif</span>
                              @endif
                            </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->

        </div><!-- /.row -->
        {{-- </form> --}}
        <!-- form finish -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

@endpush()