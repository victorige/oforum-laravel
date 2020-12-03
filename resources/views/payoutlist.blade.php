@extends('layouts.panel')

@section('xcontent')

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
							<h6 class="title">Payout List</h6>
						</div>
						<div class="ui-block-content">


@if ($total_records != 0)


	<div class="container">
        <div class="row">
                <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                    <ul style="background-color:white" class="table-careers">

                    <li class="head">
                    <span></span>
                        <span>User</span>
                        <span>Amount</span>
                    </li>


                    @foreach ($payouts as $payout)
                    <li>
                    <span>
                    @php
                    $img = DB::table('users')
                    ->where('id', $payout->user)
                    ->first();
                    echo "<div class='author-thumb'>
								<img class='author-thumb' style='width:30px;height:30px' src='$img->avatar' alt='author'>
							</div>";
                    @endphp
                    </span>
                    <span class="position bold">
                    @php
                    echo $img->name;
                    @endphp
                        </span>

                        <span class="type bold">&#8358;
                        @php
                        echo number_format($payout->amount + $payout->charges,2,'.',',');
                        @endphp</span>


                        </span>

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



