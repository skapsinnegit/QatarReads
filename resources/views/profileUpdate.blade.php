@extends("layout.default")

@section("content")
    <section class="section-padding grey-section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('includes.parentMenu')
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-user "></i> @lang('profile.page-title')
                        </div>
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-9">
                                    <form method="post" action="">
                                        {{ csrf_field() }}
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-6 form-group">
                                                <label> @lang('profile.label-1'):</label>
                                                <input name="first_name" placeholder="First Name" value="{{old('first_name',$user->first_name)}}" type="name" class="form-control">
                                                <p class="feedback">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</p>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>@lang('profile.label-2'):</label>
                                                <input name="last_name" placeholder="Last Name" type="name" value="{{old('last_name',$user->last_name)}}" class="form-control">
                                                <p class="feedback">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</p>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>@lang('profile.label-3'):</label>
                                                <input name="email" placeholder="E-mail" type="email" value="{{old('email',$user->email)}}" class="form-control">
                                                <p class="feedback">@if($errors->has('email')) {{ $errors->first('email') }} @endif</p>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>@lang('profile.label-4'):</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">+974</span>
                                                    <input type="text" class="form-control" name="mobile" placeholder="Contact Number" value="{{old('mobile',$user->mobile)}}">
                                                    <p class="feedback">@if($errors->has('mobile')) {{ $errors->first('mobile') }} @endif</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>@lang('profile.label-6'):</label>
                                                <input name="nationality" placeholder="Nationality" value="{{old('nationality',$user->nationality)}}" type="text" class="form-control">
                                                <p class="feedback">@if($errors->has('nationality')) {{ $errors->first('nationality') }} @endif</p>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="radio-inline">@lang('profile.label-5'):<br>
                                                    <span class="gender-section">
                                                        <input type="radio" value="Male" name="gender" {{old('gender',$user->gender) =='Male' ? "checked" : ""}}>@lang('profile.value-1')
                                                        <input type="radio" value="Female" name="gender" {{old('gender',$user->gender) =='Female' ? "checked" : ""}}>@lang('profile.value-2')
                                                    </span>
                                                </label>
                                                <p class="feedback">@if($errors->has('gender')) {{ $errors->first('gender') }} @endif</p>
                                            </div>


                                              <div class="col-md-6 form-group">
                                                <label>@lang('profile.label-7'):</label>
                                                <select disabled  id="userType" class="form-control">
                                                    <option value="">-@lang('profile.value-3')-</option>
                                                    <option value="Parent" {{old('type',$user->type) =='Parent' ? "selected" : ""}}>@lang('profile.value-4')</option>
                                                    <option value="Institution" {{old('type',$user->type) =='Institution' ? "selected" : ""}}>@lang('profile.value-5')</option>
                                                </select>
                                                <p class="feedback">@if($errors->has('type')) {{ $errors->first('type') }} @endif</p>
                                            </div>

                                            <div class="col-md-6 form-group">
                                            
                                            </div>


        
                                        </div>
                                        <div class="row justify-content-md-center">
                                            @if($errors->has('msg') && !$errors->has('alert'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <button class="btn primary-btn submit d-block">@lang('profile.submit-btn')</button>
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