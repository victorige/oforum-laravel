@extends('layouts.panel')

@section('xcontent')

<!-- Your Account Personal Information -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 order-xl-2 col-lg-12 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Buy Coupon</h6>
						</div>
						<div class="ui-block-content">

                            <!-- Alert -->
                            @if ($errors->has('msg'))
                                        <div class="alert logout-content">
                                            <h6 style="color:red;">{{ $errors->first('msg') }}
                                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                        </div>
                            @endif
                                <!-- Alert -->

                                @if ($processing == 1)
                                    <meta http-equiv="refresh" content="10">
                                    <button class="btn btn-secondary btn-lg full-width">Processing</button>
                                @else

                                <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>


                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <button class="btn btn-primary btn-lg full-width" onClick="payWithRave()">Pay Now</button>
                                    </div>
                                    <script>


                                    function payWithRave() {
                                    var x = getpaidSetup({
                                    PBFPubKey: "@php echo env('FLWPUBK'); @endphp",
                                    customer_email: "@php echo Auth::user()->email; @endphp",
                                    amount: @php echo env('COUPON_PAY_AMOUNT'); @endphp,
                                    customer_phone: "+@php echo Auth::user()->country.Auth::user()->phone; @endphp",
                                    currency: "NGN",
                                    txref: "{{ $coutrfx }}",
                                    meta: [{
                                    metaname: "Fullname",
                                    metavalue: "@php echo Auth::user()->name; @endphp"
                                    }],
                                    onclose: function() {
                                        window.location.href = "{{ route('buy.coupon') }}";
                                    },
                                    callback: function(response) {
                                    var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                                    console.log("This is the response returned after a charge", response);
                                    if (
                                    response.tx.chargeResponseCode == "00" ||
                                    response.tx.chargeResponseCode == "0"
                                    ) {
                                    window.location.href = "{{ route('buy.coupon') }}"; // redirect to a success page
                                    } else {
                                    window.location.href = "{{ route('buy.coupon') }}";   // redirect to a failure page.
                                    }

                                    x.close(); // use this to close the modal immediately after payment.
                                    }
                                    });
                                    }
                                    </script>

                                    @endif




@if ($total_records != 0)

<div class="container">
    <div class="row">
            <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                <ul style="background-color:white" class="table-careers">

                <li class="head">
                    <span>Code</span>
                    <span>Time</span>
                    <span>Status</span>
                </li>


                @foreach ($couponcodes as $couponcode)
                <li>
                    <span class="date bold">{{ $couponcode->value }}</span>
                    <span class="position bold">{{ $couponcode->date }}</span>

                    @if ($couponcode->status == 0)
                    <span><button onclick="setClipboard('{{ $couponcode->value }}')" class="btn btn-primary btn-sm full-width">Active</button></span>
                    @else
                    <span><button onclick="setClipboard('{{ $couponcode->value }}')" class="btn btn-secondary btn-sm full-width">Used</button></span>
                    @endif
                </li>



                        @endforeach

                        <script>
                        function setClipboard(value) {
                            var tempInput = document.createElement("input");
                            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                            tempInput.value = value;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert('copied: ' + value );
                        }

                        </script>

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







											</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->


@endsection
