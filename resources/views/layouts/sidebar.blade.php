      @php
        //$role = auth()->user()->role_id;
        //$db = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->where('role_id', $role)->first();
        $profile = DB::table('profile')->where('user_id', auth()->user()->id)->first();
        //dd($profile->signature);
      @endphp
        
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
      <!--  @if(!empty($profile->foto) && $profile->foto != null && !empty($profile->signature) && $profile->signature != null)-->
      <!--  <div class="image">-->
      <!--    <a href="{{ url('profile') }}" class="d-block">-->
      <!--      <img src="{{ asset($profile->foto) }}" class="img-circle elevation-2" alt="User Image">-->
      <!--      {{ Auth::user()->name }}-->
      <!--    </a>-->
      <!--  </div>-->
      <!--  @elseif(!empty($profile->foto) && $profile->foto != null && $profile->signature == null)-->
      <!--  <div class="image">-->
      <!--    <a href="{{ url('profile') }}" class="d-block">-->
      <!--      <img class="img-circle elevation-2" src="{{ asset($profile->foto) }}" alt="User Image">-->
      <!--      <span class="badge badge-warning navbar-badge">Cek profile !</span>-->
      <!--      {{ Auth::user()->name }} -->
      <!--    </a>-->
      <!--  </div>-->
      <!--  @else-->
      <!--  <div class="image">-->
      <!--    <a href="{{ url('profile') }}" class="d-block">-->
      <!--      <img class="img-circle elevation-2" src="{{ asset('images/img_user.jpg') }}" alt="User Image">-->
      <!--      <span class="badge badge-warning navbar-badge">Cek profile !</span>-->
      <!--      {{ Auth::user()->name }} -->
      <!--    </a>-->
      <!--  </div>-->
      <!--  @endif-->
      <!--</div>-->
	    
	        <div class="profile-sidebar">
	            @if(!empty($profile->foto) && $profile->foto != null && !empty($profile->signature) && $profile->signature != null)
    	    		<!-- SIDEBAR USERPIC -->
    				<div class="profile-userpic">
    					<img src="{{ asset($profile->foto) }}" class="img-responsive" alt="">
    				</div>
    				<!-- END SIDEBAR USERPIC -->
    				<!-- SIDEBAR USER TITLE -->
    				<div class="profile-usertitle">
    					<div class="profile-usertitle-name">
    						{{ Auth::user()->name }}
    					</div>
    					<div class="profile-usertitle-job">
    					    @if(Auth::user()->role_id == 1)
    					        ADMIN
    					    @elseif(Auth::user()->role_id == 2)
    					        AUDITOR
    					    @elseif(Auth::user()->role_id == 3)
    					        AUDITEE
    					    @else
    					        PIMPINAN
    					    @endif
    					</div>
    				</div>
                @elseif(!empty($profile->foto) && $profile->foto != null && $profile->signature == null)
                    <!-- SIDEBAR USERPIC -->
    				<div class="profile-userpic">
    					<img src="{{ asset($profile->foto) }}" class="img-responsive" alt="">
    				</div>
    				<!-- END SIDEBAR USERPIC -->
    				<!-- SIDEBAR USER TITLE -->
    				<div class="profile-usertitle">
    					<div class="profile-usertitle-name">
    						{{ Auth::user()->name }}
    					</div>
    					<div class="profile-usertitle-job">
    					    @if(Auth::user()->role_id == 1)
    					        ADMIN
    					    @elseif(Auth::user()->role_id == 2)
    					        AUDITOR
    					    @elseif(Auth::user()->role_id == 3)
    					        AUDITEE
    					    @else
    					        PIMPINAN
    					    @endif
    					</div>
    					<button type="button" onclick="window.location.href='{{ url('profile') }}';" class="btn btn-info btn-sm text-white font-weight-bold">CEK PROFILE !</button>
    				</div>
    				<!-- END SIDEBAR USER TITLE -->
    			@else
    			    <!-- SIDEBAR USERPIC -->
    				<div class="profile-userpic">
    					<img src="{{ asset('images/img_user.jpg') }}" class="img-responsive" alt="">
    				</div>
    				<!-- END SIDEBAR USERPIC -->
    				<!-- SIDEBAR USER TITLE -->
    				<div class="profile-usertitle">
    					<div class="profile-usertitle-name">
    						{{ Auth::user()->name }}
    					</div>
    					<div class="profile-usertitle-job">
    					    @if(Auth::user()->role_id == 1)
    					        ADMIN
    					    @elseif(Auth::user()->role_id == 2)
    					        AUDITOR
    					    @elseif(Auth::user()->role_id == 3)
    					        AUDITEE
    					    @else
    					        PIMPINAN
    					    @endif
    					</div>
    					<button type="button" onclick="window.location.href='{{ url('profile') }}';" class="btn btn-info btn-sm text-white font-weight-bold">CEK PROFILE !</button>
    				</div>
    				<!-- END SIDEBAR USER TITLE -->
    			@endif
    				<!-- SIDEBAR BUTTONS -->
    				<div class="profile-userbuttons">
    					<a href="{{ url('profile') }}">
    					    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-users mr-2"></i> Profile</button>
                        </a>
    					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    					    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> LOGOUT</button>
    					</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
    				</div>
			</div>
			<div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>
	    

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @php
            $role = auth()->user()->role_id;
            
            $main_menu=DB::table('menu')
              //->orderBy('sorting', 'ASC')
              ->whereRaw("FIND_IN_SET(?, role_id) > 0", [$role])
              //->whereRaw("find_in_set('1',role_id)")
              ->where('master',0)
              ->get();
              

            $sub_menu=DB::table('menu')
              //->orderBy('sorting', 'ASC')
              ->whereRaw("FIND_IN_SET(?, role_id) > 0", [$role])
              //->whereRaw("find_in_set('3',role_id)")
              ->where('master',1)
              ->get();
            //dd($sub_menu);
          @endphp
          @foreach($main_menu as $key => $main)

              @if($main->level == "main_menu_0" || $main->level == "main_menu_1")
              <li class="nav-item">
                <a href="{{url($main->url)}}" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                  </p>
                </a>
              </li>
              @endif
         
              @if($main->level == "main_menu_2")
              <li class="nav-header">MASTER APP & TRANSACTIONS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                
                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_2")
                  <li class="nav-item">
                    <a href="{{route($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif

              @if($main->level == "main_menu_3" || $main->level == "main_menu_4")
              <li class="nav-item">
                <a href="{{route($main->url)}}" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                  </p>
                </a>
              </li>
              @endif

              <!-- @if($main->level == "main_menu_3")
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_3")
                  <li class="nav-item">
                    <a href="{{url($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif

              @if($main->level == "main_menu_44")
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                
                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_4")
                  <li class="nav-item">
                    <a href="{{url($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif -->

              @if($main->level == "main_menu_5")
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                
                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_5")
                  <li class="nav-item">
                    <a href="{{route($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif

              @if($main->level == "main_menu_6")
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                
                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_6")
                  <li class="nav-item">
                    <a href="{{route($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif

              @if($main->level == "main_menu_7")
              <li class="nav-header">SETTINGS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_7")
                  <li class="nav-item">
                    <a href="{{route($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif

              @if($main->level == "main_menu_8")
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>
                    {{$main->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  @foreach($sub_menu as $key => $sub)
                  @if($sub->level == "sub_menu_8")
                  <li class="nav-item">
                    <a href="{{url($sub->url)}}" class="nav-link">
                      <i class="{{$sub->icon}} nav-icon"></i>
                      <p>{{$sub->name}}</p>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
              @endif
          
              @if($main->level == "main_menu_9")  
              <li class="nav-header">OTHERS</li>  
              <li class="nav-item">
                <a href="{{url($main->url)}}" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>{{$main->name}}</p>
                </a>
              </li>
              @endif

              @if($main->level == "main_menu_10")
              <li class="nav-item">
                <a href="{{url($main->url)}}" class="nav-link">
                  <i class="nav-icon {{$main->icon}}"></i>
                  <p>{{$main->name}}</p>
                </a>
              </li>
              @endif



          @endforeach

        </ul>
      </nav>
      <!-- /.sidebar-menu -->