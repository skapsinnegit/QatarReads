@extends("layout.default")

@section("content")
    <section class="section-padding auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <h3 class="heading text-center">Forgot Password</h3>
                            </div>
                           

                             <div class="col-md-10">
                                <div class="form-group">
                                     @if (count($errors) > 0)
                                 <div class="justify-content-md-center alert alert-danger">
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
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="email">Enter your registered email address below and we will send you instructions on resetting your password.</label>
                                    <input type="email" name="email" placeholder="Email Address" class="form-control" id="email" value="{{ old("email") }}" />
                                </div>
                            </div>
                            <div class="col-md-10"></div>
                            <div class="col-md-10 justify-content-md-center">
                                <p class="error" style="color:red;"> @if($errors->has('msg')) {{ $errors->first('msg') }} @endif</p>
                            </div>

                            <div class="col-md-5 text-center">
                                <button class="btn submit-btn submit d-block w-100">Send Email</button>
                            </div>
                            <div class="col-md-12">
                                <div class="row bottom-link">
                                    <div class="col-md-6 first-link">Already have an account? 
                                        <a href="{{ route('signIn') }}"> Sign In</a>
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