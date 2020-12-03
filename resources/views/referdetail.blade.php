@extends('layouts.panel')

@section('xcontent')



<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Refer</h1>

				</div>
			</div>
		</div>
	</div>
	<img class="img-bottom" src="{{ asset('asset/img/account-bottom.png') }}" alt="friends">
</div>

<!-- ... end Main Header Account -->

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


<!-- Your Account Personal Information -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 order-xl-2 col-lg-12 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Earn &#8358;1,000 for each referral</h6>
						</div>
						<div class="ui-block-content">

                        <h4>Your Referral ID is: <b>{{ $refercode }}</b></h4>

                        Your referral link is : <input class="form-control" id="copy-text" type="text" value="{{ $appurl }}/r/{{ $refercode }}" readonly>
                        <script>
                            document.getElementById("copy-text").onclick = function() {
                                this.select();
                                document.execCommand('copy');
                                alert('copied');
                            }
                        </script>
<hr>
<h4>Total Referrals: {{ $total_records }}</h4>

@if ($total_records != 0)

	<div class="container">
        <div class="row">
                <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                    <ul style="background-color:white" class="table-careers">

                    <li class="head">
						<span>Name</span>
						<span>Phone</span>
						<span>Amount</span>
						<span>Status</span>
                    </li>


                    @foreach ($referrals as $referral)
                    <li>
						<span class="date bold">{{ $referral->name }}</span>
						<span class="position bold">+{{ $referral->country }}{{ $referral->phone }}</span>
                        <span class="type bold">+ &#8358;1,000.00</span>
                        @if ($referral->data == 5)
                            @if ($referral->regcom == 1)
                            <span><div class="btn btn-primary btn-sm full-width">Success</a></span>
                            @else
                            <span><div class="btn btn-secondary btn-sm full-width">Pending</a></span>
                            @endif
                        @else
                        <span><div class="btn btn-secondary btn-sm full-width">Registration in progress</a></span>
                        @endif



					</li>

                            @endforeach

                    </ul>
                    @if ($page > 1)
                <span  style='float: left;'><a href='?page={{ $jm }}' class='btn btn-bg-secondary btn-md'>< PREV</a></span>
            @endif

            @if ($page != $totalPages)
                <span style='float: right;'><a id='page_a_link'  class='btn btn-bg-secondary btn-md' href='?page={{ $jp }}'>NEXT ></a></span>
            @endif
                </div>
        </div>
    </div>

    @endif


















							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->




@endsection



