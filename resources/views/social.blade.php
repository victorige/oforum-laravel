@extends('layouts.app')

@section('content')
<body class="landing-page">

<!-- Preloader -->

<div id="hellopreloader">
	<div class="preloader">
		<svg width="45" height="45" stroke="#fff">
			<g fill="none" fill-rule="evenodd" stroke-width="2" transform="translate(1 1)">
				<circle cx="22" cy="22" r="6" stroke="none">
					<animate attributeName="r" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="6;22"/>
					<animate attributeName="stroke-opacity" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="1;0"/>
					<animate attributeName="stroke-width" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="2;0"/>
				</circle>
				<circle cx="22" cy="22" r="6" stroke="none">
					<animate attributeName="r" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="6;22"/>
					<animate attributeName="stroke-opacity" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="1;0"/>
					<animate attributeName="stroke-width" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="2;0"/>
				</circle>
				<circle cx="22" cy="22" r="8">
					<animate attributeName="r" begin="0s" calcMode="linear" dur="1.5s" repeatCount="indefinite" values="6;1;2;3;4;5;6"/>
				</circle>
			</g>
		</svg>

		<div class="text">Loading ...</div>
	</div>
</div>

<!-- ... end Preloader -->

<div class="content-bg-wrap"></div>


<!-- Header Standard Landing  -->

<div class="header--standard header--standard-landing" id="header--standard">
	<div class="container">
		<div class="header--standard-wrap">

			<a href="{{ route('index') }}" class="logo">
				<div class="img-wrap">
                <img src="{{ asset('asset/img/logo-white.png') }}" style="width:auto;height:47px;">
				</div>

			</a>

			<a href="#" class="open-responsive-menu js-open-responsive-menu">
				<svg class="olymp-menu-icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-menu-icon') }}"></use></svg>
			</a>

			<div class="nav nav-pills nav1 header-menu">
				<div class="mCustomScrollbar">
					<ul>
						<li class="nav-item">
							<a href="{{ route('index') }}" class="nav-link">Home</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('terms') }}" class="nav-link">Terms & Conditions</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('policy') }}" class="nav-link">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
							<a href="{{ route('contact') }}" class="nav-link">Contact</a>
						</li>
						<li class="close-responsive-menu js-close-responsive-menu">
							<svg class="olymp-close-icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-close-icon') }}"></use></svg>
						</li>
						<li class="nav-item js-expanded-menu">
							<a href="#" class="nav-link">
								<svg class="olymp-menu-icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-menu-icon') }}"></use></svg>
								<svg class="olymp-close-icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-close-icon') }}"></use></svg>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ... end Header Standard Landing  -->
<div class="header-spacer--standard"></div>

<div class="container">
	<div class="row display-flex">
		<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="landing-content">
				<h1>Welcome to the most trusted money website in Nigeria.</h1>
				<p>Making &#8358;10,000 - &#8358;50,000 on @php echo env('APP_NAME'); @endphp is 100% sure and guarantee monthly if you join us today, understand the concept and take action. With one time payment of only &#8358;1,400, a lot of Nigerians have been earning ₦50,000 - ₦100,000 monthly on @php echo env('APP_NAME'); @endphp.
                </p><p>
                    It's profitable, sustainable, convincing and suitable for whoever that wish to take advantage of online earning opportunity as it creates the channel for participant to earn extra income from home with our affiliate system.
				</p>

			</div>
		</div>

		<div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">

			<!-- Login-Registration Form  -->

			<div class="registration-login-form">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
							<svg class="olymp-login-icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-login-icon') }}"></use></svg>
						</a>
					</li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">


					<div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
						<div class="title h6">Social Login</div>
						<form class="content">
							<div class="row">
								<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                <!-- Alert -->
                                @if ($errors->has('msg'))
                                    <div class="alert logout-content">
                                        <h6 style="color:red;">{{ $errors->first('msg') }}
                                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                    </div>
                                @endif
                                <!-- Alert -->


									<a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fab fa-facebook-f" aria-hidden="true"></i>Login with Facebook</a>

                                    <a href="{{ route('social.oauth', 'google') }}" class="btn btn-lg bg-google full-width btn-icon-left"><i class="fab fa-google" aria-hidden="true"></i>Login with Google</a>

                                    <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fab fa-twitter" aria-hidden="true"></i>Login with Twitter</a>



								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

            <!-- ... end Login-Registration Form  -->
        </div>
	</div>
</div>



@endsection
