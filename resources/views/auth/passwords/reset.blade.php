@extends("layout.default")

@section("content")
    <section class="section-padding auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form method="post" action="{{ route('password.request') }}" class="sb-ajax-form" id="sign-in-form">
                        {{ csrf_field() }}
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <h3 class="heading text-center">Update Your New Password</h3>
                            </div>
                            @if (count($errors) > 0)
                                 <div class="alert alert-danger">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{!! $error !!}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                             @endif
                             @if(session()->has('msg'))
                                 <p class="alert alert-success" data-onload="scroll">{{ session('msg') }}</p>
                             @endif
                             @if (session('status'))
                                 <div class="alert alert-success">
                                     {{ session('status') }}
                                 </div>
                             @endif
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                                    <p class="feedback"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                    <p class="feedback"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    <p class="feedback"></p>
                                </div>
                            </div>
                            <div class="col-md-10 justify-content-md-center">
                                <p class="error" style="color:red;"> @if($errors->has('msg')) {{ $errors->first('msg') }} @endif</p>
                            </div>
                            <div class="col-md-10 text-center">
                                <button class="btn primary-btn submit d-block w-100">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection