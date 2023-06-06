@extends('layouts.main')

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.rounded-15{
			box-shadow: 0px 3px 22px rgba(0, 0, 0, 0.08);
			border-radius: 15px;
		}
		.carousel-item.active,
		.carousel-item-next,
		.carousel-item-prev {
			display: block;
		}

		.slide-gambar .carousel .carousel-control-prev,.slide-gambar  .carousel .carousel-control-next  { 
			visibility: hidden;
			opacity: 0;
			transition: visibility 0s linear 300ms, opacity 300ms;
		}
		.slide-gambar .carousel:hover .carousel-control-next,.slide-gambar .carousel:hover  .carousel-control-prev { 
			visibility: visible;
			opacity: 1;
			transition: visibility 0s linear 0s, opacity 300ms;
		}

		.carousel-parent {
			min-height: 396px;
		}

		.carousel-inner{
			background-color: #F8EAE9;
		}

		.carousel-item img {
			display: block;
			margin: auto;
			width: 60%;
			max-height: 396px;
		}

		.slide-video.carousel-indicators{
			bottom: -40px;
		}

		.carousel-indicators li {
			border-radius: 8px;
			display: inline-block;
			width: 15px;
			height: 15px;
			margin-left: 15px;
			border-radius: 50%;
			text-indent: 0;
			cursor: pointer;
			border: none;
			background-color: #e74c3c; 
		}
		.carousel-indicators .active {
			width: 15px;
			height: 15px;
			border-radius: 50%;
			background-color: #c0392b;
		}

		.carousel-control-prev-icon {
			display: none;
		}

		.carousel-control-next-icon{
			display: none;
		}

		.icon-slide{
			box-shadow: 0 .5rem 1rem rgba(0,0,0,.5) !important;
			width: 50px;
			height: 50px;
			border-radius: 50%;
			line-height: 50px;
			background-color: #f82649;
		}

		.owl-carousel{
			position: relative;
			padding-left: 40px !important;
			padding-right: 40px !important;
		}

	</style>
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

	<style>
        a:hover, a:focus{
            text-decoration: none !important;
            outline: none !important;
            
        }
        .panel-group .panel{
            background-color: #fff;
            border:none;
            box-shadow:none;
            border-radius: 10px;
            margin-bottom:11px;
        }
        .panel .panel-heading{
            padding: 0;
            border-radius:10px;
            border: none;
        }
        .panel-heading a{
            color:#fff !important;
            display: block;
            border:none;
            padding:20px 35px 20px;
            font-size: 20px;
            background-color:rgb(236, 87, 102);
            font-weight:600;
            position: relative;
            color:#fff;
            box-shadow:none;
            transition:all 0.1s ease 0;
        }
        .panel-heading a:after, .panel-heading a.collapsed:after{
            content: "\f068";
            font-family: fontawesome;
            text-align: center;
            position: absolute;
            left:-20px;
            top: 10px;
            color:#fff;
            background-color:rgb(236, 87, 102);
            border: 5px solid #fff;
            font-size: 15px;
            width: 40px;
            height:40px;
            line-height: 30px;
            border-radius: 50%;
            transition:all 0.3s ease 0s;
        }
        .panel-heading:hover a:after,
        .panel-heading:hover a.collapsed:after{
            transform:rotate(360deg);
        }
        .panel-heading a.collapsed:after{
            content: "\f067";
        }
        #accordion .panel-body{
            background-color:#Fff;
            color:#8C8C8C;
            line-height: 25px;
            padding: 10px 25px 20px 35px ;
            border-top:none;
            font-size:14px;
            position: relative;
        }
	</style>
@endpush

@section('content')
<!-- Banner Start -->
<section class="banner" id="Home">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-xl-7">
				<div class="block">
					<div class="divider mb-3"></div>
					<span class="text-uppercase text-sm letter-spacing ">{{ $frontEnd->tittle }}</span>
					<h1 class="mb-6 mt-12">{{ $frontEnd->welcome }}</h1>
					
					<div class="btn-container ">
						<a href="{{ route('login') }}" class="btn btn-main-2 btn-icon btn-round-full">Buat Audit Mutu<i class="icofont-simple-right ml-2  "></i></a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Slider Start -->
<section class="features">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9 col-md-9 col-sm-12 col-12 mb-3">
				<div class="rounded-15 shadow bg-white">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div id="homeSlider" class="carousel slide" data-ride="carousel">
							    <ol class="carousel-indicators">
                                      @foreach($banners as $key=>$banner)
                                        @if($banner->id == 1)
                                           <li data-target="#homeSlider" data-slide-to="{{ $banner->id }}" class="active"></li>
                                        @else
                                           <li data-target="#homeSlider" data-slide-to="{{ $banner->id }}"></li>
                                        @endif
                                      @endforeach
                                </ol>
                                <div class="carousel-inner rounded-15">
                                    @foreach($banners as $key=>$banner)
                                        @if($banner->id == 1)
        									<div class="carousel-item active">
        
        										<div class="carousel-parent d-flex align-items-center justify-content-center">
        
        											<img src="{{ asset($banner->path) }}" alt="">
        
        										</div>
        
        									</div>
        							    @else
        									<div class="carousel-item">
        
        										<div class="carousel-parent d-flex align-items-center justify-content-center">
        
        											<img src="{{ asset($banner->path) }}" alt="">
        
        										</div>
        
        									</div>
									    @endif
                                    @endforeach
									
							    </div>
							    
							    <a class="carousel-control-prev" href="#homeSlider" data-slide="prev">

									<span class="icon-slide fa fa-chevron-left text-white"></span>

								</a>

								<a class="carousel-control-next" href="#homeSlider" data-slide="next">

									<span class="icon-slide fa fa-chevron-right text-white"></span>

								</a>
								
									<!-- <div class="carousel-item active">
										<div class="carousel-parent d-flex align-items-center justify-content-center">
											<img src="https://polines.ac.id/id/images/resized/images/headers/0-0x2-r0_960_400.jpg" alt="">
										</div>
									</div>
									<div class="carousel-item">
										<div class="carousel-parent d-flex align-items-center justify-content-center">
											<img src="https://polines.ac.id/id/images/resized/images/headers/0-0x2_960_400.jpg" alt="">
										</div>
									</div>
									<div class="carousel-item">
										<div class="carousel-parent d-flex align-items-center justify-content-center">
											<img src="https://polines.ac.id/id/images/resized/images/headers/0-0x3-1_960_400.jpg" alt="">
										</div>
									</div>
									<div class="carousel-item">
										<div class="carousel-parent d-flex align-items-center justify-content-center">
											<img src="https://polines.ac.id/id/images/resized/images/headers/0-0x3_960_400.jpg" alt="">
										</div>
									</div> -->
								
								<a class="carousel-control-prev" href="#homeSlider" data-slide="prev">
									<span class="icon-slide fa fa-chevron-left text-white"></span>
								</a>
								<a class="carousel-control-next" href="#homeSlider" data-slide="next">
									<span class="icon-slide fa fa-chevron-right text-white"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- Page Break -->
<section class="section about">

</section>
<!-- Dokumen -->
<!--<div></div>-->
<section class="cta-section" id="dokumenSPMI">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 text-center">
				<div class="section-title">
					<h2>Dokumen Task AMI</h2>
					<div class="divider mx-auto my-4"></div>
					<p>The following is the number of tasks that are carried out on the AMI Polines system :</p>
				</div>
			</div>
		</div>

		<div>
					<table id="dokumenPublic" class="table table-bordered table-striped">
                        <thead>
                            <tr>
								<th>No</th>
								<th>Nama</th>
								<th>Nomor</th>
								<th>Revisi</th>
								<th>Tahun</th>
								<th>Status</th>
								@if(!empty(auth()->user()))
									<th>Action</th>
								@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokInduks as $key=> $dokInd)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $dokInd->name }}</td>
								<td>{{ $dokInd->nomor }}</td>
								<td>{{ $dokInd->revisi }}</td>
                                <td>{{ $dokInd->tahun_aktif }} - {{ $dokInd->tahun_selesai }}</td>
								<td>
									@if($dokInd->status == "aktif")
										<span class="badge badge-pill badge-info">Aktif</span>
									@else
										<span class="badge badge-pill badge-danger">Non Aktif</span>
									@endif
								</td>
								@if(!empty(auth()->user()))
                                	<td><a class="btn btn-sm btn-primary" href="{{ url('dokumen') }}"><i class="fa fa-eye"></i> Lihat</a></td>
								@endif
                                <!--<td>-->
                                <!--    @if($dokInd->status == "aktif")-->
                                <!--        <span class="badge badge-pill badge-info">Aktif</span>-->
                                <!--    @else-->
                                <!--        <span class="badge badge-pill badge-danger">Non Aktif</span>-->
                                <!--    @endif-->
                                <!--</td>-->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
			<!--<iframe src="filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>-->
		</div>
	</div>
</section>
<!-- Page Break -->
<section class="section about">

</section>

<!--</section>-->
<!-- FAQs -->
<!--<section class="cta-section" id="FAQs">-->
<!--	<div class="container">-->
<!--		<div class="row justify-content-center">-->
<!--			<div class="col-lg-12 text-center">-->
<!--				<div class="section-title">-->
<!--					<h2>FAQs AMI</h2>-->
<!--					<div class="divider mx-auto my-4"></div>-->
<!--					<p>The following is the number of tasks that are carried out on the AMI Polines system :</p>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->

<!--		@foreach($FAQs as $FAQ)-->
<!--		<div class="row">-->
<!--			<div class="col-md-offset-3 col-md-12">-->
<!--				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->

<!--					<div class="panel panel-default">-->
<!--						<div class="panel-heading" role="tab" id="heading{{ $FAQ->id }}">-->
<!--							<h4 class="panel-title">-->
<!--								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $FAQ->id }}" aria-expanded="true" aria-controls="collapse{{ $FAQ->id }}">-->
<!--									{{ $FAQ->subjek }}-->
<!--									<span> </span>-->
<!--								</a>-->
<!--							</h4>-->
<!--						</div>-->
<!--						<div id="collapse{{ $FAQ->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $FAQ->id }}">-->
<!--							<div class="panel-body">-->
<!--								<p>{{ $FAQ->uraian }}</p>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->

<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		@endforeach-->
		
<!--	</div>-->
<!--</section>-->
<!-- Page Break -->
<!--<section class="section about">-->

<!--</section>-->
@endsection

@push('js')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
        <script>
        // DataTable
        $("#dokumenPublic").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": true,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        </script>
@endpush