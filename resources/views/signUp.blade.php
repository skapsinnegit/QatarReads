@extends("layout.default")

@section("content")
    <section class="section-padding auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <ul class="d-flex justify-content-center">
                        <li><a href="{{ routex('signIn') }}" class="first {{ Route::currentRouteName() == 'signIn' ? 'active' : ''}}">Login</a></li>
                        <li><a href="{{ routex('signUp') }}" class="{{ Route::currentRouteName() == 'signUp' ? 'active' : ''}}">Sign Up</a></li>
                    </ul>
                    <form method="post" action="{{ routex('signUp') }}" class="sb-ajax-form pt-30">
                        {{ csrf_field() }}
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 form-group">
                                <input name="first_name" placeholder="First Name" value="{{old('first_name')}}" type="name" class="form-control">
                                <p class="feedback">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</p>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="last_name" placeholder="Last Name" type="name" value="{{old('last_name')}}" class="form-control">
                                <p class="feedback">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <input name="email" placeholder="E-mail" type="email" value="{{old('email')}}" class="form-control">
                                <p class="feedback">@if($errors->has('email')) {{ $errors->first('email') }} @endif</p>
                            </div>
                             <div class="col-md-6 form-group">
                                <input name="password" placeholder="Password" type="password" class="form-control">
                                @if($errors->has('password'))
                                    <p class="feedback"> {{ $errors->first('password') }} </p>
                                @else 
                                    <p class="feedback" style="color:#7a7a7a;font-size:12px;">Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character</p>
                                @endif
                            </div>  
                            <div class="col-md-6 form-group">
                                <input name="password_confirmation" placeholder="Confirm Password" type="password" class="form-control">
                                @if($errors->has('password_confirmation'))
                                    <p class="feedback"> {{ $errors->first('password_confirmation') }} </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">+974</span>
                                    <input type="text" class="form-control" name="mobile" placeholder="Contact Number" value="{{old('mobile')}}">
                                </div>
                                 <p class="feedback">@if($errors->has('mobile')) {{ $errors->first('mobile') }} @endif</p>
                            </div>
                           
                            
                            <div class="col-md-6 form-group">
                                <span class="gender-section">
                                    <input type="radio" value="Male" name="gender" {{old('gender','Male') =='Male' ? "checked" : ""}}> &nbsp;Male
                                    <input type="radio" value="Female" name="gender" {{old('gender','Male') =='Female' ? "checked" : ""}}> &nbsp;Female
                                </span>
                                <p class="feedback">@if($errors->has('gender')) {{ $errors->first('gender') }} @endif</p>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="nationality" placeholder="Nationality" value="{{old('nationality')}}" type="text" class="form-control">
                                <p class="feedback">@if($errors->has('nationality')) {{ $errors->first('nationality') }} @endif</p>
                            </div>
                            <div class="col-md-6 form-group">
                                <select name="type" id="userType" class="form-control">
                                    <option value="">-Are you?-</option>
                                    <option value="Parent" {{old('type') =='Parent' ? "selected" : ""}}>Parent</option>
                                    <option value="Institution" {{old('type') =='Institution' ? "selected" : ""}}>Institution</option>
                                </select>
                                <p class="feedback">@if($errors->has('type')) {{ $errors->first('type') }} @endif</p>
                            </div>
                            <div class="col-md-6 form-group userSub">
                                <input name="institution_name" placeholder="Institution Name" value="{{old('institution_name')}}" type="text" class="form-control">
                                <p class="feedback">@if($errors->has('institution_name')) {{ $errors->first('institution_name') }} @endif</p>
                            </div>
                            <div class="col-md-6 form-group userSub">
                                <input name="occupation" value="{{old('occupation')}}" placeholder="Occupation" type="text" class="form-control">
                                <p class="feedback">@if($errors->has('occupation')) {{ $errors->first('occupation') }} @endif</p>
                            </div>
                            
                        </div>
                        <div class="justify-content-md-center">
                            @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                @if($errors->first('class')=="alert-success")<a href="{{routex('resendVerification')}}">Resend Verification Code</a> @endif
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 text-center">
                                <button class="btn submit-btn submit d-block w-100">Sign Up</button>
                            </div>
                        </div>
                        <div class="row bottom-link">
                            <div class="col-md-12 text-center">Already have an account? 
                                <a href="{{ routex('signIn') }}"> Sign In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection