@extends('layouts.panel')

@section('xcontent')



<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Giveaway</h1>

				</div>
			</div>
		</div>
	</div>
	<img class="img-bottom" src="{{ asset('asset/img/account-bottom.png') }}" alt="friends">
</div>

<!-- ... end Main Header Account -->




<!-- Your Account Personal Information -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 order-xl-2 col-lg-12 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
					<div style='color:black;font-size:16px' class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">OFORUM &#8358;100,000 GIVEAWAY</h6>
						</div>


						<div class="ui-block-content">
                        <b><h4>Total Likes: {{ $gw_reactioncount }}</h4></b>
                        <b><h4>Total Shares: {{ $gw_sharecount }}</h4></b>
                        <b><h4>Total Points: {{ $gw_totalpoints }}</h4></b>
                        <div style='color:blue'>How we calculate your points: We give 2 points for every likes and 5 points for every shares you have on your video.</div>
                        <hr/>
                        <p style='color:red; font-size:16px'>Read About the Giveaway Below.</p>
                        <hr/>


							<p><b>We are giving away &#8358;100,000 to 3 honest members on Oforum.</b></p>

                            <ul>
                            <li>1st Gets #50,000 Naira</li>
                            <li>2nd Gets #25,000 Naira</li>
                            <li>3rd Gets #25,000 Naira</li>
                            </ul>

                            <h4>HOW TO BE A WINNER</h4>
                            <ol>
                            <li>Record A Video Of Yourself And Tell Your Friends &amp; Family How Oforum Has Helped You.</li>
                            <li>Share The Video On Facebook And Include The Below Trackable Link To The Post</li>

                            <br>
                        <p>
                        <b>Trackable Link:</b>
                        <input class="form-control" id="copy-text" type="text" value="{{ $caption }}" readonly>
                        <script>
                            document.getElementById("copy-text").onclick = function() {
                                this.select();
                                document.execCommand('copy');
                                alert('copied');
                            }
                        </script>
                        </p>

                        <li>Tell Your Friends And Family To Like and Share It.</li>
                        </ol>

                        <div style='color:blue; font-size:16px'><b><p>The Most Honest, Liked &amp; Shared Videos Win The CASH!!!</p>

                        <p style='color:red; font-size:16px'>Disclaimer: Winners Video May Be Used For Advertisement.</p>

                        </b></div>


                        <b>
                        <p>

                        <p>The Giveaway Ends 28th Feburary, 2020.</p>
                        <p>Winners Will Be Announced and Credited on 29th Feburary, 2020.</p>

                        <div style='color:red'>Please Note.: Include the Trackable Link this helps us in identifying you because It contains a Unique Identity Code.  </div>


                        </p>
                        <p>
                            <i>Thank You.</i>
                        </p>
                        </b>

<hr>



							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->

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




@endsection

