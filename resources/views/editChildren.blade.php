@extends("layout.default")

@section("content")
    <section class="section-padding grey-section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('includes.parentMenu')
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-child"></i> @lang('editChild.page-title')
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sub-panel">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-section">
                                                    <form action="{{routex('editChild',['id'=>encrypt($child->id)])}}" method="post">
                                                        @csrf
                                                        <div class="row justify-content-md-center">
                                                            <div class="col-md-8">
                                                                <label for="name">@lang('editChild.label-1')</label>
                                                                <input name="name" value="{{$child->name}}" placeholder="Child Name" type="text" id="name" class="form-control">
                                                                <p class="feedback">@if($errors->has('name')) {{ $errors->first('name') }} @endif</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label for="dob">@lang('editChild.label-2')</label>
                                                                <input name="dob" value="{{$child->dob}}" placeholder="Date of Birth" type="date" id="dob" class="form-control">
                                                                <p class="feedback">@if($errors->has('dob')) {{ $errors->first('dob') }} @endif</p>
                                                            </div>
                                                          
                                                            <div class="col-md-8">
                                                                <label for="institution">@lang('editChild.label-3')</label>
                                                                <input name="institution" value="{{$child->institution}}" placeholder="Institution Name" type="text" id="institution" class="form-control">
                                                                <p class="feedback">@if($errors->has('institution')) {{ $errors->first('institution') }} @endif</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="d-flex align-items-center">@lang('editChild.label-4'):
                                                                    <input type="radio" name="gender" value="Male" {{old('gender',$child->gender) =='Male' ? "checked" : ""}}>@lang('editChild.value-1')
                                                                    <input type="radio" name="gender" value="Female" {{old('gender',$child->gender) =='Female' ? "checked" : ""}}>@lang('editChild.value-2')
                                                                </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <button class="btn primary-btn submit d-block w-100">@lang('editChild.submit-btn')</button>
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