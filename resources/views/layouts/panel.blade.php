@extends('layouts.app')

@section('content')



<body id="piop" style="visibility: hidden !important;">
<div id="babasbmsgx" style="visibility: visible !important;">Please disable your adblock and script blockers to view this page</div>


<!-- Header-BP -->

<header class="header" id="site-header">

<a style="padding-top: 15px; padding-left: 15px;" href="{{ route('index') }}" class="logo">
				<div class="img-wrap">
					<img src="{{ asset('asset/img/logo.png') }}" style="width:auto;height:47px;">
				</div>

            </a>

</header>

<!-- ... end Header-BP -->


<!-- Responsive Header-BP -->

<header class="header header-responsive" id="site-header-responsive">

<a style="padding-top: 15px; padding-left: 15px;" href="{{ route('index') }}" class="logo">
				<div class="img-wrap">
                <img src="{{ asset('asset/img/logo.png') }}" style="width:auto;height:47px;">
				</div>

            </a>

</header>

<!-- ... end Responsive Header-BP -->
<div class="header-spacer"></div>


@yield('xcontent')


<!-- Footer Dark -->

<div class="footer footer--dark" id="footer">
	<div class="container">
		<div class="row">

        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="widget w-list">
					<ul>
						<li>
							<a href="{{ route('index') }}">Home</a>
						</li>
						<li>
							<a href="{{ route('buy-coupon') }}">Buy Coupon</a>
						</li>
						<li>
							<a href="{{ route('about') }}">About Us</a>
						</li>

					</ul>
				</div>
            </div>



            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="widget w-list">
					<ul>
                    <li>
							<a href="{{ route('policy') }}">Privacy Policy</a>
						</li>
                        <li>
							<a href="{{ route('copyright') }}">Copyright</a>
						</li>
						<li>
							<a href="{{ route('disclaimer') }}">Disclaimer</a>
					</ul>
				</div>
            </div>


            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="widget w-list">
					<ul>

						</li>
						<li>
							<a href="{{ route('terms') }}">Terms of Service</a>
						</li>
						<li>
							<a href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li>
							<a href="{{ route('contact') }}">Contact Us</a>
						</li>
					</ul>
				</div>
			</div>







			<div class="col col-lg-12 col-md-12 col-sm-12 col-12">


				<!-- SUB Footer -->

				<div class="sub-footer-copyright">
					<span>
						Copyright <a href="{{ route('index') }}">@php echo env('APP_NAME'); @endphp</a> - All Rights Reserved 2019
                    </span>
                    <br>
                    <span>
                        Powered By: VICTEMIGE TECH. &#174; 2650978
					</span>
				</div>

				<!-- ... end SUB Footer -->

			</div>
		</div>
	</div>
</div>

<!-- ... end Footer Dark -->












<a class="back-to-top" href="#">
	<img src="{{ asset('asset/svg-icons/back-to-top.svg') }}" alt="arrow" class="back-icon">
</a>





@endsection
