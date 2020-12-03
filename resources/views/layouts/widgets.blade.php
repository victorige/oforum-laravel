@extends('layouts.panel')

@section('xcontent')


<div class="container">

<div style="padding-bottom: 25px;" class="scrollmenu">



<div class="scrollmenu">

@guest
<a href="{{ route('index') }}">  <div class="chip">
<i class="fas fa-home"></i>
    <b>Home</b>
  </div></a>

  <a href="{{ route('social.login') }}">  <div class="chip">
<i class="fas fa-sign-in-alt"></i>
      <b>Join</b>
    </div></a>

    <a href="{{ route('how') }}">  <div class="chip">
<i class="fas fa-question"></i>
        <b>How it works</b>
      </div></a>

      <a href="{{ route('buy-coupon') }}">  <div class="chip">
<i class="fas fa-shopping-cart"></i>
          <b>Buy Coupon</b>
        </div></a>

        <a href="{{ route('faq') }}">  <div class="chip">
<i class="fas fa-tasks"></i>
            <b>FAQ</b>
          </div></a>

          <a href="{{ route('contact') }}">  <div class="chip">
<i class="fas fa-hands-helping"></i>
              <b>Support</b>
            </div></a>


@endguest

@auth
@php
 $datareg = Auth::user()->data;
 $oshare = Auth::user()->sharelimit;
@endphp

  @if($datareg == 5)

<a href="{{ route('index') }}">  <div class="chip">
<i class="fas fa-home"></i>
    <b>Home</b>
  </div></a>

  @if($oshare == 1)
  <a href="{{ route('oshare') }}">  <div class="chip">
<i class="fas fa-ad"></i>
    <b>Oshare</b>
  </div></a>
  @endif

<a href="{{ route('dashboard') }}">  <div class="chip">
<i class="fas fa-user-alt"></i>
    <b>Account</b>
  </div></a>

    <a href="{{ route('history.payout') }}">  <div class="chip">
<i class="fas fa-money-check"></i>
        <b>Payout</b>
      </div></a>

      <a href="{{ route('refer') }}">  <div class="chip">
<i class="fas fa-user-friends"></i>
          <b>Refer</b>
        </div></a>

        <a href="{{ route('contact') }}">  <div class="chip">
<i class="fas fa-hands-helping"></i>
            <b>Support</b>
          </div></a>



  @else
    <a href="{{ route('redirector') }}">  <div class="chip">
        <i class="fas fa-sign-in-alt"></i>
        <b>Registration</b>
    </div></a>

  <a href="{{ route('how') }}">  <div class="chip">
        <i class="fas fa-question"></i>
      <b>How it works</b>
    </div></a>

    <a href="{{ route('buy-coupon') }}">  <div class="chip">
        <i class="fas fa-shopping-cart"></i>
        <b>Buy Coupon</b>
      </div></a>

      <a href="{{ route('faq') }}">  <div class="chip">
        <i class="fas fa-tasks"></i>
          <b>FAQ</b>
        </div></a>

        <a href="{{ route('contact') }}">  <div class="chip">
        <i class="fas fa-hands-helping"></i>
            <b>Support</b>
          </div></a>

  @endif
@endauth




</div>
<div>
@guest
    <p>
        <a href="{{ route('social.login') }}" style="float:right" class="btn btn-bg-secondary btn-md">Login or Register </a>
    </p>
    @endguest

    @auth
    <form method="POST" action="{{ route('logout') }}">
                                @csrf
    <p>
        <button style="float:right" class="btn btn-bg-secondary btn-md">Logout </button>
    </p>
    </form>

    @endauth
</div>

</div>



	<div class="row">

    @yield('main')


		<!-- Left Sidebar -->

		<aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
        <div class="ui-block">


<!-- W-Action -->

<div class="widget">
    <div class="content">
        <center>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Square Auto -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-9587885399192232"
            data-ad-slot="9752656738"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </center>
    </div>
</div>

<!-- ... end W-Action -->


<!-- W-Action -->

<div class="widget w-action">


    <div class="content">
        <h4 class="title">@php echo env('APP_NAME'); @endphp</h4>
        <span>Join Smart Earner And Start Earning Millions</span>
        <a href="{{ route('social.login') }}" class="btn btn-bg-secondary btn-md">Join Now!</a>
    </div>
</div>

<!-- ... end W-Action -->
</div>

		</aside>

		<!-- ... end Left Sidebar -->


		<!-- Right Sidebar -->

		<aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">



			<div class="ui-block">

            <!-- W-Action -->

<div class="widget">
    <div class="content">
        <center>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Square Auto -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-9587885399192232"
            data-ad-slot="9752656738"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </center>
    </div>
</div>

<!-- ... end W-Action -->


				<!-- W-Action -->

				<div class="widget w-action">


					<div class="content">
						<h4 class="title">@php echo env('APP_NAME'); @endphp</h4>
						<span>Join Smart Earner And Start Earning Millions</span>
						<a href="{{ route('social.login') }}" class="btn btn-bg-secondary btn-md">Join Now!</a>
					</div>
				</div>

				<!-- ... end W-Action -->
			</div>

		</aside>

		<!-- ... end Right Sidebar -->



	</div>
</div>





@endsection
