@extends("layout.default")

@section("content")
    <section class="section-padding auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form method="post" action="{{ routex('resendVerification') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <h3 class="heading text-center">Resend Verification Code</h3>
                            </div>
                           
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="email">Enter your registered email address below and we will send you instructions on verifying your email.</label>
                                    <input type="email" name="email" placeholder="Email Address" class="form-control" id="email" value="{{ old("email") }}" />
                                </div>
                            </div>


                            <div class="row justify-content-md-center">
                                @if($errors->has('msg'))<p style="margin-top:20px;" class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                            </div>
                            <div class="col-md-10 text-center">
                                <button class="btn primary-btn submit d-block w-100">Resend Code</button>
                            </div>
                            <div class="col-md-10">
                                <div class="row bottom-link">
                                    <div class="col-md-5 text-left">Not a member yet? 
                                        <a href="{{ routex('signUp') }}"> Sign Up</a>
                                    </div>
                                    <div class="col-md-7 text-right">Already a member?
                                        <a href="{{ routex('signIn') }}"> Sign In</a>
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