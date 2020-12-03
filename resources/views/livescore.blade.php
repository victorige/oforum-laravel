@extends('layouts.panel')

@section('xcontent')
<meta http-equiv="refresh" content="60">

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
							<h6 class="title">Live Soccer Scores</h6>
						</div>
						<div class="ui-block-content">





	<div class="container">
        <div class="row">
                <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                    <ul style="background-color:white" class="table-careers">

<style>
.line {
    white-space: nowrap;
}
</style>

@if($count == 0)

<li>



                    <div class="line" style="color:red">
                     No Live event is available
                    </div>

                    </li>

@else

                    @foreach ($livescoredata as $data)

                    <li>

                    <span class="position bold">

                    <div class="line" style="color:red">
                    {{ $data['status'] }} : {{ $data['elapsed'] }}' @if($data['score']['extratime'] != null)
                     [ET: {{ $data['score']['extratime'] }}]
                     @endif
                    </div>

                    <br>

                    <div >{{ $data['league']['country'] }} - {{ $data['league']['name'] }}</div>

                    </span>

                    <br>


                    <span class="position bold">
                    <div class='line'><img class='author-thumb' style='width:15px;height:15px' src="{{ $data['homeTeam']['logo'] }}" alt='author'> {{ $data['homeTeam']['team_name'] }}</div>
                    <hr>
                    <div class='line'> <img class='author-thumb' style='width:15px;height:15px' src="{{ $data['awayTeam']['logo'] }}" alt='author'> {{ $data['awayTeam']['team_name'] }}</div>

                    </span>

                    <span style="float:right" class="position bold">
                    <div class='line'>{{ $data['goalsHomeTeam'] }}</div>
                    <hr>

                    <div class='line'>{{ $data['goalsAwayTeam'] }}</div>
                    </span>







					</li>

                            @endforeach

                            @endif

                    </ul>

                </div>
        </div>
    </div>




















							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->




@endsection



