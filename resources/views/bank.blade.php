@extends('layouts.panel')

@section('xcontent')



<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Bank Account Details</h1>

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
                            @if ($view == 1)
                                <h6 class="title">Confirm Bank Account Details</h6>
                                @else
                                <h6 class="title">Enter Bank Account Details</h6>
                            @endif
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

                            @if ($view == 1)




                            <div>
                                @csrf
								<div class="row">



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">


										<div class="form-group label-floating">
											<label class="control-label">Account Name </label>
											<input class="form-control" value="{{ $accname }}" disabled>
                                        </div>

                                        <div class="form-group label-floating">
											<label class="control-label">Account Number </label>
											<input class="form-control" value="{{ $accnum }}" disabled>
                                        </div>

                                        <div class="form-group label-floating">
											<label class="control-label">Bank Name </label>
											<input class="form-control" value="{{ $bankname }}" disabled>
                                        </div>


                                    </div>



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="title">Are you sure the above information is correct?</h6>
                                    <a data-toggle="modal" data-target="#edit-widget-twitter" href="#" class="btn btn-primary btn-lg full-width">Yes</a>

                                    <a href="{{ route('no.bank') }}" class="btn btn-secondary btn-md full-width">No</a>
									</div>

								</div>
</div>




                                @else


                            <form method="POST" action="{{ route('confirm.bank') }}">
                                @csrf
								<div class="row">



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
										<label class="control-label">Bank Name</label>
										<select name='bankcode' class="selectpicker form-control" required="required">
                                            <option value="">Select Bank Name</option>
                                            @foreach ($banks as $bank)
                                                <option value='{{ $bank->code }}'>{{ $bank->name }}</option>
                                            @endforeach
										</select>
                                    </div>

										<div class="form-group label-floating">
											<label class="control-label">Bank Account Number </label>
											<input class="form-control" type="text" pattern="^\d{10}$" maxlength="10" minlength="10" name="bankacc" required="required">
										</div>
                                    </div>



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
										<button class="btn btn-primary btn-lg full-width">Verify</button>
									</div>

								</div>
                            </form>
                            @endif

							<!-- ... end Personal Information Form  -->						</div>
					</div>
                </div>

			</div>

		</div>


	</div>
</div>

<!-- ... end Your Account Personal Information -->




<!-- Window-popup Edit Widget Twitter -->

<div class="modal fade" id="edit-widget-twitter" tabindex="-1" role="dialog" aria-labelledby="edit-widget-twitter" aria-hidden="true">
	<div class="modal-dialog window-popup edit-widget edit-widget-twitter" role="document">
		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
			</a>
            <form method="GET" action="{{ route('yes.bank') }}">
                @csrf

                <div class="modal-body">
                    <div class="remember">
                        <div class="checkbox">
                                <label>
                                 <input name="optionsCheckboxes" type="checkbox" required="required">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                    </div>

                    <button class="btn btn-purple btn-lg full-width">Complete Registration!</button>

                </div>

            </form>
        </div>

	</div>
</div>

<!-- ... end Window-popup Edit Widget Twitter -->






@endsection










