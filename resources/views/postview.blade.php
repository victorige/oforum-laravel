@extends('layouts.widgets')

@section('main')

<meta property="og:url" content="{{ $ogurl }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{!! $post_title !!}" />
<meta property="og:description" content="{{ $ogdescription }}" />


<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

			<div id="newsfeed-items-grid">

				<div class="ui-block">


					<article class="hentry post">

						<div class="post__author author vcard inline-items">

							<div class="author-date">
								<div class="h4 post__author-name fn">{!! $post_title !!}</div>
                                <hr>
                                <div class="post__date">
									<time class="published">
										{{ $timeago }}
									</time>
								</div>
							</div>


						</div>
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

						<p>{!! $post_content !!}</p>



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

					</article>

                </div>

			</div>



		</main>

@endsection
