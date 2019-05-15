@extends("layout.default")

@section("content")
    <section class="section-padding grey-section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('includes.parentMenu')
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-child"></i> @lang('addChild.page-title')
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sub-panel">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                            	<div class="form-section">
                                                    <form action="{{routex('addchildren')}}" method="post">
                                                    	@csrf
                                                    	<div class="row justify-content-md-center">
                                                            <div class="col-md-8">
                                                                <label for="name">@lang('addChild.label-1')</label>
                                                                <input name="name" placeholder="@lang('addChild.placeholder-1')" type="text" id="name" class="form-control" value="{{ old('name') }}">
                                                                <p class="feedback">@if($errors->has('name')) {{ $errors->first('name') }} @endif</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label for="dob">@lang('addChild.label-2')</label>
                                                                <input name="dob" placeholder="Date of Birth" type="date" id="dob" class="form-control" value="{{ old('dob') }}">
                                                                <p class="feedback">@if($errors->has('dob')) {{ $errors->first('dob') }} @endif</p>
                                                            </div>
                                                           
                                                            <div class="col-md-8">
                                                                <label for="institution">@lang('addChild.label-3')</label>
                                                                <input name="institution"  placeholder="@lang('addChild.placeholder-3')" type="text" id="institution" class="form-control" value="{{ old('institution') }}">
                                                                <p class="feedback">@if($errors->has('institution')) {{ $errors->first('institution') }} @endif</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="d-flex align-items-center">@lang('addChild.label-4'):
                                                    		    	<input type="radio" value="Male" name="gender" {{old('gender','Male') =='Male' ? "checked" : ""}}>@lang('addChild.value-1')
                                                    		    	<input type="radio" value="Female" name="gender" {{old('gender','Male') =='Female' ? "checked" : ""}}>@lang('addChild.value-2')
                                                    		    </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-group d-flex align-items-center">
                                                                	<input type="checkbox" name="terms" value="1" {{old('terms','0') == 1 ? "checked" : ""}}> @lang('addChild.label-5') <a href="" class="terms"> @lang('addChild.value-3')</a>
                                                                </span>
                                                                <p class="feedback">@if($errors->has('terms')) {{ $errors->first('terms') }} @endif</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <button class="btn primary-btn submit d-block w-100">@lang('addChild.submit-btn')</button>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection