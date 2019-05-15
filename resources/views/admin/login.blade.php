@extends("admin.layout.default")

@section("content")
	<section class="section-padding auth-form">
		<div class="container">
			<div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <h3 class="heading text-center">Login</h3>
                    <form method="post" action="{{ route('signIn') }}" class="sb-ajax-form" id="sign-in-form">
                        {{ csrf_field() }}
                        <div class="row justify-content-center d-flex flex-wrap">
                            <div class="col-md-12 form-group">
                        <input type="hidden" name="logtype" value="admin" />
                                <input name="email" placeholder="Email" type="text"  class="form-control">
                                <p class="feedback"></p>
                            </div>
                            <div class="col-md-12 form-group">
                                <input name="password" placeholder="Password" type="password" class="form-control">
                                <p class="feedback"></p>
                            </div>
                            <div class="col-md-12"></div>
                             <div class="row justify-content-md-center">
                                @if($errors->has('msg'))
                                    <p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                    @if($errors->first('class')=="alert-danger" && $errors->first('verify'))
                                        <p class="w-100 text-center"><a href="{{route('resendVerification')}}">Resend Verification Code</a></p> 
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-10 text-center">
                                <button class="btn submit-btn submit d-block w-100">Login</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</section>
@endsection