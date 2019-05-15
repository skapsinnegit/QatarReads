@extends("admin.layout.default")

@section("content")
   

    <div class="content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
   
           
                <form action="{{ route("admin.changePassword") }}" class="form-horizontal" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Change Password</h5>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Current Password:</label>
                                <div class="col-md-9">
                                    <input name="current_password" placeholder="Current Password" type="password" class="form-control">
                                </div>
                            </div>


                             <div class="form-group">
                                <label class="col-md-3 control-label">New Password:</label>
                                <div class="col-md-9">
                                    <input name="password" placeholder="New Password" type="password" class="form-control">
                                    <p class="feedback">@if($errors->has('password')) {{ $errors->first('password') }} @endif</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Confirm Password:</label>
                                <div class="col-md-9">
                                    <input name="password_confirmation" placeholder="Confirm Password" type="password" class="form-control">
                                    <p class="feedback">@if($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }} @endif</p>
                                </div>
                            </div>


                             <div class="row justify-content-md-center">
                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                @endif
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
