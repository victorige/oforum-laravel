@extends('layouts.panel')

@section('xcontent')


                <!-- Alert -->
                @if ($errors->has('msg'))
                    <script>alert('{{ $errors->first('msg') }}');</script>
                @endif
                <!-- Alert -->


<!-- Main Header Weather -->

<div class="main-header main-header-weather">
	<div class="content-bg-wrap bg-weather"></div>

	<div class="date-and-place">
        <div class="place">Member Since:</div>
		<div class="date">{{ $joindate }}</div>

	</div>

	<div class="wethear-update">
		{{ $greet }}
	</div>
	<div class="container">
		<div class="row">
			<div class="m-auto col-lg-4 col-md-8 col-sm-12 col-12">
				<div class="wethear-content">
					<div class="wethear-now">


						<div class="author-thumb">
							<img src="{{ $avatar }}" style="width:100px;height:100px;" alt="author">
</div>
						<div class="author-content">
                        <div class="climate">{{ $name }}</div>
						</div>




						<svg class="olymp-weather-partly-sunny-icon icon"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-happy-face-icon') }}"></use></svg>

                        <div class="date">Earnings: &#8358;{{ $earnings }}</div>

					</div>



                    <button onclick="myFunction()" class="btn btn-md-2 btn-primary">REQUEST PAYOUT</button>
<hr>
<p>
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
</p>
<hr>
                    <div class="date">Unsettled Activity Earnings: &#8358;{{ $uearnings }}</div>
                    <div class="date">Daily post earning limit -> {{ $readlimit }}</div>



                </div>





			</div>
		</div>
	</div>

    <img class="img-bottom" src="{{ asset('asset/img/weather-bottom.png') }}" alt="friends">

    <section class="medium-padding100">
	<div class="container">
        <div class="row">
                <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                    <ul style="background-color:white" class="table-careers">
                    @php
                    $phoner = Auth::user()->phone;
                    $presults = DB::table('user_coupon')->where('phone', $phoner)->count();
                    $apresults = DB::table('user_coupon')->where('phone', $phoner)->where('agentlist', '!=', 0)->count();
                    $oshare = Auth::user()->sharelimit;
                    @endphp

                    @if($presults == 1)
                    <li>
                            <a href="{{ route('buy.coupon') }}">
                                <span class="position bold">Buy Coupon</span>
                            </a>
                        </li>
                    @endif

                    @if($oshare == 1)

                    <li>
                            <a href="{{ route('oshare') }}">
                                <span class="position bold">Oshare to Facebook and Earn Extra Cash</span>
                            </a>
                        </li>

                    @endif

                        <li>
                            <a href="{{ route('refer') }}">
                                <span class="position bold">Refer (Link)</span>
                            </a>
                        </li>



                        <li>
                            <a href="{{ route('edit.bank') }}">
                                <span class="position bold">Edit Payment Details</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('history.payout') }}">
                                <span class="position bold">Payout History</span>
                            </a>
                        </li>

                        @if($apresults == 1)
                        <li>
                                <a href="{{ route('agent.payout') }}">
                                    <span class="position bold">Agent Payout History</span>
                                </a>
                            </li>
                        @endif

                        <li>
                        <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            <button class="btn btn-md-2 btn-primary">LOGOUT</button>
                        </form>
                        </li>
                    </ul>
                </div>
        </div>
    </div>
</section>
</div>

<!-- ... end Main Header Weather -->


<script>
    function myFunction() {

        if (confirm("Are you sure, you want to Request Payout?\nYou need at least {{ $min_payout }} Naira Earnings to Request Payout.\nA transfer charge of {{ $payout_charge }} Naira would be deducted.\nThis action can't be reversed.")) {
            window.location = "{{ route('request.payout') }}";
        }

    }
</script>

@endsection
