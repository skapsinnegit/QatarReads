@extends("admin.layout.default")

@section("content")
    <div class="content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="{{ route("admin.addEditor") }}" class="form-horizontal" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Add editor</h5>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="first_name" value="{{ old("first_name") }}" placeholder="First Name" required>
                                    <p class="feedback">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="last_name" value="{{ old("last_name") }}" placeholder="Last Name" required>
                                    <p class="feedback">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Email: *</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email"  placeholder="Email" value="{{ old("email") }}">
                                    <p class="feedback">@if($errors->has('email')) {{ $errors->first('email') }} @endif</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Password: *</label>
                                <div class="col-md-9">
                                    <input name="password" placeholder="Password" type="password" class="form-control">
                                    @if($errors->has('password_confirmation'))
                                        <p class="feedback"> {{ $errors->first('password_confirmation') }} </p>
                                    @else 
                                        <p class="feedback" style="color:#7a7a7a;font-size:12px;">Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character</p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Confirm Password: *</label>
                                <div class="col-md-9">
                                    <input name="password_confirmation" placeholder="Confirm Password" type="password" class="form-control">
                                    <p class="feedback">@if($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobile"  placeholder="Phone" value="{{ old("mobile") }}" required>
                                    <p class="feedback">@if($errors->has('mobile')) {{ $errors->first('mobile') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Editor Roll: *</label>
                                <div class="col-md-9">
                                    <select class="select select2" name="editor_roll" id="editor_roll">
                                         <option value="" >Select Editor Roll</option>
                                         <option value="1" {{old('editor_roll') == 1 ? "selected" : ""}}>Manage Programs & Editor</option>
                                         <option value="2" {{old('editor_roll') == 2 ? "selected" : ""}}>Manage Programs</option>
                                    </select>
                                    <p class="feedback">@if($errors->has('editor_roll')) {{ $errors->first('editor_roll') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group assignpgm" style="display:none">
                                <label class="col-md-3 control-label">Assigned Program: *</label>
                                <div class="col-md-9">
                                    <select id="assignpgm" class="select select2 js-example-basic-multiple" name="assigned_program[]" multiple="multiple">
                                        @foreach($programs as $program)
                                         <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="feedback">@if($errors->has('assigned_program')) {{ $errors->first('assigned_program') }} @endif</p>
                                </div>
                            </div>


                             <div class="row justify-content-md-center">
                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                                @endif
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Add Editor</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
