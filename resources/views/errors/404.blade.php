<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404</title>


	<!-- Main Font -->
	<script src="{{ asset('asset/js/libs/webfontloader.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap-reboot.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/Bootstrap/dist/css/bootstrap-grid.css') }}">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/fonts.min.css') }}">

    <style>
div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
}

.chip {
    font-family: Poppins, sans-serif;
    display: inline-block;
    padding: 0 25px;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #ed1c24;

}

.chip b {
    color: white;
    text-transform: uppercase;
}

.chip i {
    float: left;
    margin: 10px 10px 10px -15px;
    font-size: 2.0em;
    color: white;
}

 a:hover .chip {
    background-color: black;
}
</style>


</head>
<section class="medium-padding120">
	<div class="container">
		<div class="row">
			<div class="col col-xl-6 m-auto col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="page-404-content">
					<img src="{{ asset('asset/img/404.png') }}" alt="photo">
					<div class="crumina-module crumina-heading align-center">
						<h2 class="h1 heading-title">A <span class="c-primary">wild ghost</span> appears! Sadly, not what you were looking for...</h2>
						<p class="heading-text">Sorry! The page you were looking for has been moved or doesn’t exist.

						</p>
					</div>

					<a href="{{ route('index') }}" class="btn btn-primary btn-lg">Go to Homepage</a>
				</div>
			</div>
		</div>
	</div>
</section>




    <!-- JS Scripts -->
    <script src="{{ asset('asset/js/jQuery/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.appear.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('asset/js/libs/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.matchHeight.js') }}"></script>
<script src="{{ asset('asset/js/libs/svgxuse.js') }}"></script>
<script src="{{ asset('asset/js/libs/imagesloaded.pkgd.js') }}"></script>
<script src="{{ asset('asset/js/libs/Headroom.js') }}"></script>
<script src="{{ asset('asset/js/libs/velocity.js') }}"></script>
<script src="{{ asset('asset/js/libs/ScrollMagic.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.waypoints.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.countTo.js') }}"></script>
<script src="{{ asset('asset/js/libs/popper.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/material.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/bootstrap-select.js') }}"></script>
<script src="{{ asset('asset/js/libs/smooth-scroll.js') }}"></script>
<script src="{{ asset('asset/js/libs/selectize.js') }}"></script>
<script src="{{ asset('asset/js/libs/swiper.jquery.js') }}"></script>
<script src="{{ asset('asset/js/libs/moment.js') }}"></script>
<script src="{{ asset('asset/js/libs/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/js/libs/fullcalendar.js') }}"></script>
<script src="{{ asset('asset/js/libs/isotope.pkgd.js') }}"></script>
<script src="{{ asset('asset/js/libs/ajax-pagination.js') }}"></script>
<script src="{{ asset('asset/js/libs/Chart.js') }}"></script>
<script src="{{ asset('asset/js/libs/chartjs-plugin-deferred.js') }}"></script>
<script src="{{ asset('asset/js/libs/circle-progress.js') }}"></script>
<script src="{{ asset('asset/js/libs/loader.js') }}"></script>
<script src="{{ asset('asset/js/libs/run-chart.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('asset/js/libs/jquery.gifplayer.js') }}"></script>
<script src="{{ asset('asset/js/libs/mediaelement-and-player.js') }}"></script>
<script src="{{ asset('asset/js/libs/mediaelement-playlist-plugin.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('asset/js/libs/leaflet.js') }}"></script>
<script src="{{ asset('asset/js/libs/MarkerClusterGroup.js') }}"></script>
<script src="{{ asset('asset/js/libs/lazyload.js') }}"></script>
<script type="text/javascript">
	var pageLazyLoad = new LazyLoad({
		elements_selector: "[loading=lazy]",
		use_native: true // ← enables hybrid lazy loading
	});

	window.lazyLoadOptions = {
		elements_selector: "[loading=lazy]",
		use_native: true // ← enables hybrid lazy loading
	};
</script>

<script src="{{ asset('asset/js/main.js') }}"></script>
<script src="{{ asset('asset/js/libs-init/libs-init.js') }}"></script>
<script defer src="fonts/fontawesome-all.js') }}"></script>

<script src="{{ asset('asset/Bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
</body>
</html>

