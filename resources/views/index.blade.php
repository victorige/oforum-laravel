@extends('layouts.widgets')

@section('main')

<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
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

            <a href="{{ route('how') }}"><div class="page-description bold">
				<div class="icon">
					<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-star-icon') }}"></use></svg>
				</div>
				<span style="color: black; font-size: 14px">
                @php
                $txtrand = rand(0,1);
                @endphp

                @if ($txtrand == 0)
                Join Smart Earner on @php echo env('APP_NAME'); @endphp And Start Earning Millions
                @else
                Referral is Optional on @php echo env('APP_NAME'); @endphp &amp; Everyone Will Get Paid (100% Guaranteed)
                @endif

                </span>
            </div></a>

            <a href="{{ route('payout') }}"><div class="page-description bold">
				<div class="icon">
					<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-share-icon') }}"></use></svg>
				</div>
				<span style="color: black; font-size: 14px">Payout Record</span>
            </div></a>

            @if ($livescoredata_count > 0)
            <a href="{{ route('livescore') }}"><div class="page-description bold">
				<div class="icon">
					<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="{{ asset('asset/svg-icons/sprites/icons.svg#olymp-thunder-icon') }}"></use></svg>
				</div>
				<span style="color: black; font-size: 14px">Live Soccer Scores</span>
            </div></a>
            @endif


			<div id="newsfeed-items-grid">
				<div class="ui-block">
					<article class="hentry post">
						<div class="post__author author vcard inline-items">
							<div class="author-date">

                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-format="fluid"
                                data-ad-layout-key="-hj-v+35-g-4x"
                                data-ad-client="ca-pub-9587885399192232"
                                data-ad-slot="6038936148"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <hr>

                            <a href="{{ route('smart-guys') }}"><div class="h5 post__author-name fn">How Oforum Members Earn A Lot Of Money And Cash Out Daily</div></a>
                                <hr>

                            @foreach ($posts as $post)
                            <a href="-/{{ $post->post_name }}"><div class="h5 post__author-name fn">{!! $post->post_title !!}</div></a>
                                <hr>
                            @endforeach

                            <center><p>
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- 320 X 50 -->
                            <ins class="adsbygoogle"
                                style="display:inline-block;width:320px;height:50px"
                                data-ad-client="ca-pub-9587885399192232"
                                data-ad-slot="5439976825"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            </p></center>
                            </div>


                            @if ($page > 1)
               <span  style='float: left;'><a href='?page={{ $jm }}' class='btn btn-bg-secondary btn-md'>< PREV</a></span>
            @endif

            @if ($page != $totalPages)
                <span style='float: right;'><a id='page_a_link'  class='btn btn-bg-secondary btn-md' href='?page={{ $jp }}'>NEXT ></a></span>
            @endif


                        </div>

					</article>
                </div>
            </div>

		</main>


@endsection
