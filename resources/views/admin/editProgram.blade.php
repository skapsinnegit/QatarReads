@extends("admin.layout.default")

@section("content")
   

    <div class="content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="{{ route("admin.editProgram",['id'=>encrypt($program->id)]) }}" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Edit Program</h5>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Program Name: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" value="{{ old("name",$program->name) }}" required>
                                     <p class="feedback">@if($errors->has('name')) {{ $errors->first('name') }} @endif</p>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Maximum Number of subscription: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="max_subscription" value="{{ old("max_subscription",$program->max_subscription) }}">
                                    <p class="feedback">@if($errors->has('max_subscription')) {{ $errors->first('max_subscription') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Cost: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="cost"  value="{{ old("cost",$program->cost) }}" required>
                                    <p class="feedback">@if($errors->has('cost')) {{ $errors->first('cost') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Monthly Recurring Cost: *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="recurring_cost"  value="{{ old("recurring_cost",$program->recurring_cost) }}">
                                    <p class="feedback">@if($errors->has('recurring_cost')) {{ $errors->first('recurring_cost') }} @endif</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Age Limit: *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="start_age" value="{{ old("start_age",$program->start_age) }}" required>
                                     <p class="feedback">@if($errors->has('start_age')) {{ $errors->first('start_age') }} @endif</p>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="end_age" value="{{ old("end_age",$program->end_age) }}" required>
                                     <p class="feedback">@if($errors->has('end_age')) {{ $errors->first('end_age') }} @endif</p>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                 @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
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
