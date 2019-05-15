@extends("layout.default")

@section("content")
	<section class="section-padding auth-form">
		<div class="container"> 
			<div class="row justify-content-center">
				<div class="col-md-12">
					<ul class="d-flex justify-content-center">
	                    <li><a href="{{ routex('signIn') }}" class="first {{ Route::currentRouteName() == 'signIn' ? 'active' : ''}}">Login</a></li>
	                    <li><a href="{{ routex('signUp') }}" class="{{ Route::currentRouteName() == 'signUp' ? 'active' : ''}}">Sign Up</a></li>
	                </ul>
				</div>
                <div class="col-md-8">
                    <form method="post" action="{{ routex('signIn') }}" class="sb-ajax-form" id="sign-in-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="logtype" value="user" />
                        <div class="row justify-content-md-center">
                            <div class="col-md-10 form-group">
                                <input name="email" placeholder="Email ID" type="text"  class="form-control">
                                <p class="feedback"></p>
                            </div>
                            <div class="col-md-10 form-group">
                                <input name="password" placeholder="Password" type="password" class="form-control">
                                <p class="feedback"></p>
                            </div>
                            <div class="col-md-10"></div>
                             <div class="col-md-10 justify-content-md-center">
                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                     @if($errors->first('class')=="alert-danger" && $errors->first('verify'))
                                        <p class="w-100 text-center"><a href="{{route('resendVerification')}}">Resend Verification Code</a></p> 
                                     @endif
                                @endif
                            </div>
                            <div class="col-md-5 text-center">
                                <button class="btn submit-btn submit d-block w-100">Log in</button>
                            </div>
                            <div class="col-md-12">
                                <div class="row bottom-link">
                                    <div class="col-md-6 first-link">Forgot password?
                                        <a href="{{ routex('password.request') }}"> Reset Password</a>
                                    </div>
                                    <div class="col-md-6">Don't have an account? 
                                        <a href="{{ routex('signUp') }}"> Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</section>
@endsection