@extends('layouts.panel')

@section('xcontent')



<!-- Main Header Account -->

<div class="main-header">
	<div class="content-bg-wrap bg-account"></div>
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
				<div class="main-header-content">
					<h1>Edit Bank Account Details</h1>

				</div>
			</div>
		</div>
	</div>
	<img class="img-bottom" src="{{ asset('asset/img/account-bottom.png') }}" alt="friends">
</div>

<!-- ... end Main Header Account -->

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
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg full-width">Yes</a>

                                    <a href="{{ route('edit.bank') }}" class="btn btn-secondary btn-md full-width">No</a>
									</div>

								</div>
</div>




                                @else


                            <form method="POST" action="{{ route('editconfirm.bank') }}">
                                @csrf
								<div class="row">



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
										<label class="control-label">Bank Name</label>
										<select name='bankcode' class="selectpicker form-control" required="required">
                                            <option value="{{ $bankcode }}">{{ $bankname }}</option>
                                            @foreach ($banks as $bank)
                                                <option value='{{ $bank->code }}'>{{ $bank->name }}</option>
                                            @endforeach
										</select>
                                    </div>

										<div class="form-group label-floating">
											<label class="control-label">Bank Account Number </label>
											<input class="form-control" type="text" pattern="^\d{10}$" maxlength="10" minlength="10" name="bankacc" value="{{ $accnum }}" required="required">
										</div>
                                    </div>



									<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
										<button class="btn btn-primary btn-lg full-width">Edit</button>
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




@endsection










