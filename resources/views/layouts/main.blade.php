<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name') }}</title>

    <!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon/android-icon-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
	<meta name="theme-color" content="#ffffff">
	

    @include('layouts.front.css')

</head>

<body id="top">

<header>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{{ asset($frontEnd->logo) }} " alt="" class="img-fluid">
			</a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
				<span class="icofont-navigation-menu"></span>
			</button>
	  
			<div class="collapse navbar-collapse" id="navbarmain">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#Home">Home</a>
					</li>
					<!--<li class="nav-item">-->
					<!--	<a class="nav-link" href="#grafikSPMI">Grafik SPMI</a>-->
					<!--</li>-->
					<li class="nav-item">
						<a class="nav-link" href="#dokumenSPMI">Dokumen SPMI</a>
					</li>
					<!--<li class="nav-item">-->
					<!--	<a class="nav-link" href="#FAQs">FAQs</a>-->
					<!--</li>-->
					@guest
						<div class="btn-container ">
							<a href="{{ route('login') }}" class="btn btn-main-2 btn-icon btn-round-full">Login<i class="icofont-simple-right ml-2  "></i></a>
						</div>
					@else
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="doctor.html" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <i class="icofont-thin-down"></i></a>
							<ul class="dropdown-menu" aria-labelledby="dropdown03">
								<li><a class="dropdown-item" href="{{ url('dashboard') }}">Dashboard</a></li>
								<li>
									<a class="dropdown-item" href="{{ route('logout') }}" 
										onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
</header>
	


@yield('content')

    @include('layouts.front.footer')  

    <!-- 
    Essential Scripts
    =====================================-->

    @include('layouts.front.js')

  </body>
  </html>
   