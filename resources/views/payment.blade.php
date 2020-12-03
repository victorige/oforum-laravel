@extends('layouts.panel')

@section('xcontent')


<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Make a Payment of &#8358;{{ $amount }}</h1>

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
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Online Payment</h6>
						</div>
						<div class="ui-block-content">

                        @if ($txfstatus == 2)
                            <div class="alert logout-content">
                                <h6 style="color:red;">Payment Failed
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                            </div>

                        @endif

                            <!-- Alert -->
                            @if ($errors->has('msg'))
                                        <div class="alert logout-content">
                                            <h6 style="color:red;">{{ $errors->first('msg') }}
                                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                        </div>
                            @endif
                                <!-- Alert -->

                            <!-- Personal Information Form  -->


                            <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>


                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
									<button class="btn btn-primary btn-lg full-width" onClick="payWithRave()">Pay Now</button>
								</div>
                            <script>


                   function payWithRave() {
                       var x = getpaidSetup({
                           PBFPubKey: "{{ $FLWPUBK }}",
                           customer_email: "{{ $email }}",
                           amount: {{ $amount }},
                           customer_phone: "+{{ $phone }}",
                           currency: "NGN",
                           txref: "{{ $txf }}",
                           meta: [{
                               metaname: "Fullname",
                               metavalue: "{{ $fname }}"
                           }],
                           onclose: function() {
                            window.location.href = "{{ route('process.payment') }}";
                           },
                           callback: function(response) {
                               var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                               console.log("This is the response returned after a charge", response);
                               if (
                                   response.tx.chargeResponseCode == "00" ||
                                   response.tx.chargeResponseCode == "0"
                               ) {
                                  window.location.href = "{{ route('process.payment') }}"; // redirect to a success page
                               } else {
                                window.location.href = "{{ route('process.payment') }}";   // redirect to a failure page.
                               }

                               x.close(); // use this to close the modal immediately after payment.
                           }
                       });
                   }
               </script>



							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->



@endsection
