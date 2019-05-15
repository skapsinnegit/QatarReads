@extends("admin.layout.default")

@section("content")
    
    <div class="content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            
                <form action="{{ route("admin.addProgram") }}" class="form-horizontal" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Add Program</h5>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Program Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Program Name" value="{{ old("name") }}" required>
                                    <p class="feedback">@if($errors->has('name')) {{ $errors->first('name') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Maximum Number of subscription: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="max_subscription" placeholder="Maximum Number of subscription" value="{{ old("max_subscription") }}">
                                    <p class="feedback">@if($errors->has('max_subscription')) {{ $errors->first('max_subscription') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Cost: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="cost" placeholder="Cost" value="{{ old("cost") }}" required>
                                    <p class="feedback">@if($errors->has('cost')) {{ $errors->first('cost') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Monthly Recurring Cost: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="recurring_cost" placeholder="Monthly Recurring Cost" value="{{ old("recurring_cost") }}">
                                     <p class="feedback">@if($errors->has('recurring_cost')) {{ $errors->first('recurring_cost') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Age Limit: *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Starting Age" name="start_age" value="{{ old("start_age") }}" required>
                                    <p class="feedback">@if($errors->has('start_age')) {{ $errors->first('start_age') }} @endif</p>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="end_age" placeholder="Ending Age" value="{{ old("end_age") }}" required>
                                    <p class="feedback">@if($errors->has('end_age')) {{ $errors->first('end_age') }} @endif</p>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                 @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Add Program</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
