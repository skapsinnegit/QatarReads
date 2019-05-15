@extends("layout.default")

@section("content")
    <section class="section-padding grey-section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('includes.parentMenu')
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-user "></i>Password Update
                        </div>
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form method="post" action="">
                                        {{ csrf_field() }}
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 form-group">
                                                <label>Current Password:</label>
                                                <input name="current_password" placeholder="Current Password" type="password" class="form-control">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>New Password:</label>
                                                <input name="password" placeholder="New Password" type="password" class="form-control">
                                                <p class="feedback">@if($errors->has('password')) {{ $errors->first('password') }} @endif</p>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Confirm Password:</label>
                                                <input name="password_confirmation" placeholder="Confirm Password" type="password" class="form-control">
                                                <p class="feedback">@if($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }} @endif</p>
                                            </div>
                                        </div>
                                        <div class="justify-content-md-center">
                                            @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                            @endif
                                        </div>

                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <button class="btn primary-btn submit d-block w-100">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection