@extends('layouts.panel')

@section('xcontent')


<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Select Your Payment Option</h1>

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
							<h6 class="title">Payment Option</h6>
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

                            <!-- Personal Information Form  -->

                            <form method="POST" action="{{ route('option.payment') }}">
                            @csrf
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="option" value="flutterwave" checked> Flutterwave (Online Payment) Instant Activation<br>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="option" value="coupon" > Coupon<br>
                                    </label>
                                </div>
                            </div>

                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
									<button class="btn btn-primary btn-lg full-width">Next</button>
								</div>
                            </form>


							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->


@endsection
