@extends("layout.default")

@section("content")
    <section class="section-padding grey-section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('includes.parentMenu')
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-file-text-o "></i>@lang('subscribe.page-title')
                        </div>
                        <div class="panel-body">
                            @if($program->subscriptions->where('status',1)->count() >= $program->max_subscription)
                                 <p class="alert alert-info text-center"> Maximum Subscription Limit for this program has been reached, You will be joined in waiting list </p>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="sub-panel">
                                        <div class="row align-items-center">
                                            <div class="col-md-6"><h3 class="title">@lang('subscribe.page-title')</h3></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>@lang('subscribe.table-th-1'): </b></td>
                                                            <td>{{$program->name}}</td>
                                                        </tr>
                                                         <tr>
                                                            <td><b>@lang('subscribe.table-th-5'): </b></td>
                                                            <td>{{$program->start_age.' To '.$program->end_age}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>@lang('subscribe.table-th-2'): </b></td>
                                                            <td>{{$childrens}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>@lang('subscribe.table-th-3'): </b></td>
                                                            <td>{{$program->cost}} QAR/Month</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>@lang('subscribe.table-th-4'):</b></td>
                                                            <td>{{$program->recurring_cost}} QAR/Child</td>
                                                        </tr>
    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="sub-panel">
                                        <div class="row align-items-center">
                                            <div class="col-md-6"><h3 class="title">@lang('subscribe.page-sub-title-2')</h3></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">

                                                @if($childrens > 0)
                                                <form action="{{routex('subscribeForm',['id'=>encrypt($program->id)])}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="total" value="{{$childrens}}" />
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-md-6">
                                                            <label for="address">@lang('subscribe.label-1')</label>
                                                            <input name="address" value="{{old('address',$oldData ? $oldData->address : "")}}" placeholder="@lang('subscribe.label-1')" type="text" id="address" class="form-control">
                                                            <p class="feedback">@if($errors->has('address')) {{ $errors->first('address') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="state">@lang('subscribe.label-2')</label>
                                                            <input name="state" value="{{old('state',$oldData ? $oldData->state : "")}}" placeholder="@lang('subscribe.label-2')" type="text" id="state" class="form-control">
                                                            <p class="feedback">@if($errors->has('state')) {{ $errors->first('state') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="city">@lang('subscribe.label-3')</label>
                                                            <input name="city" value="{{old('city',$oldData ? $oldData->city : "")}}" placeholder="@lang('subscribe.label-3')" type="text" id="city" class="form-control">
                                                            <p class="feedback">@if($errors->has('city')) {{ $errors->first('city') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="pin">@lang('subscribe.label-4')</label>
                                                            <input name="pincode" value="{{old('pincode',$oldData ? $oldData->pincode : "")}}" placeholder="@lang('subscribe.label-4')" type="text" id="pin" class="form-control">
                                                            <p class="feedback">@if($errors->has('pincode')) {{ $errors->first('pincode') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="country">@lang('subscribe.label-5')</label>
                                                            <input name="country" value="{{old('country',$oldData ? $oldData->country : "")}}" placeholder="@lang('subscribe.label-5')" type="text" id="country" class="form-control">
                                                            <p class="feedback">@if($errors->has('country')) {{ $errors->first('country') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="language">@lang('subscribe.label-6')</label>
                                                            <select name="language" id="language" class="form-control">
                                                                <option value="">-@lang('subscribe.label-6')-</option>
                                                                <option value="English" {{old('language',$oldData ? $oldData->language : "") =="English" ? "selected" : ""}}>English</option>
                                                                <option value="Arabic" {{old('language',$oldData ? $oldData->language : "") =="Arabic" ? "selected" : ""}}>Arabic</option>
                                                                <option value="Bilingual" {{old('language',$oldData ? $oldData->language : "") =="Bilingual" ? "selected" : ""}}>Bilingual</option>
                                                            </select>
                                                            <p class="feedback">@if($errors->has('language')) {{ $errors->first('language') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6 p-0">
                                                             <span class="form-group d-flex align-items-center">
                                                                <input name="monthly_subscription" value="1" data-cost="{{$program->recurring_cost}}" id="monthly_sub_chk" type="checkbox" {{old('monthly_subscription',$oldData ? $oldData->monthly_subscription : "")==1 ? "checked" : ""}}> @lang('subscribe.label-7')</a>
                                                            </span>
                                                            <p class="feedback">@if($errors->has('monthly_subscription')) {{ $errors->first('monthly_subscription') }} @endif</p>
                                                        </div>
                                                        <div class="col-md-6"></div>
                                                           <div class="row justify-content-md-center">
                                                            @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                                                           </div>
                                                        <div class="col-md-12 text-center">
                                                            <button class="btn primary-btn submit d-block w-100">@lang('subscribe.submit-btn')</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @else
                                                    <div class="text-center justify-content-md-center">
                                                       <p class="alert alert-warning"> No Elgible Children Available <a href="{{routex('addchildren')}}" class="btn primary-btn action-btn">Add Children</a></p>

                                                    </div>
                                                @endif
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