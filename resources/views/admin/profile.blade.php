@extends("admin.layout.default")

@section("content")
   

    <div class="content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
   
           
                <form action="{{ route("admin.updateProfile") }}" class="form-horizontal" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Update Profile</h5>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="first_name" value="{{ old("first_name",$user->first_name) }}" placeholder="First Name" required>
                                    <p class="feedback">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="last_name" value="{{ old("last_name",$user->last_name) }}" placeholder="Last Name" required>
                                    <p class="feedback">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Email: *</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email"  placeholder="Email" value="{{ old("email",$user->email) }}">
                                    <p class="feedback">@if($errors->has('email')) {{ $errors->first('email') }} @endif</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobile"  placeholder="Phone" value="{{ old("mobile",$user->mobile) }}" required>
                                    <p class="feedback">@if($errors->has('mobile')) {{ $errors->first('mobile') }} @endif</p>
                                </div>
                            </div>


                             <div class="row justify-content-md-center">
                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                @endif
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
