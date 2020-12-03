@extends('layouts.panel')

@section('xcontent')

<meta property="og:url" content="{{ $ogurl }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{!! $post_title !!}" />
<meta property="og:description" content="{{ $ogdescription }}" />

<div class="container mb60 mt50">
	<div class="row">
		<div class="col col-xl-8 m-auto col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">


				<!-- Single Post -->

				<article class="hentry blog-post single-post single-post-v2">

					<h2 class="h1 post-title">{!! $post_title !!}</h2>

					<div class="post-content-wrap">

						<div style="color:black; font-size:16px;" class="post-content">
                            {!! $post_content !!}
                        </div>
					</div>


				</article>

				<!-- ... end Single Post -->

			</div>

		</div>


	</div>
</div>



@endsection
