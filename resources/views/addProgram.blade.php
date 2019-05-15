@extends("layout.default")

@section("content")
    <section class="section-padding grey-section form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h3 class="heading text-center">Add Program</h3>
                    <form action="{{routex('addProgram')}}" method="post">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-md-8">
                                <label for="name">Program Name</label>
                                <input name="name" placeholder="Program Name" type="text" id="name" class="form-control">
                                <p class="feedback">@if($errors->has('name')) {{ $errors->first('name') }} @endif</p>
                            </div>
                            <div class="col-md-8">
                                <label for="max_subscription">Maximum Number of subscription</label>
                                <input name="max_subscription" placeholder="Max Number of Subscription" type="integer" id="max_subscription" class="form-control">
                                <p class="feedback">@if($errors->has('max_subscription')) {{ $errors->first('max_subscription') }} @endif</p>
                            </div>
                            
                            <div class="col-md-8">
                                <label for="cost">Cost</label>
                                <input name="cost" placeholder="Cost" type="text" id="cost" class="form-control">
                                <p class="feedback">@if($errors->has('cost')) {{ $errors->first('cost') }} @endif</p>
                            </div>
                            <div class="col-md-8">
                                <label for="recurring_cost">Monthly Recurring Cost</label>
                                <input name="recurring_cost" placeholder="Monthly Recurring Cost" type="text" id="recurring_cost" class="form-control">
                                <p class="feedback">@if($errors->has('recurring_cost')) {{ $errors->first('recurring_cost') }} @endif</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="start_age">Age Limit</label>
                                        <input name="start_age" placeholder="Starting Age" type="text" id="start_age" class="form-control">
                                        <p class="feedback">@if($errors->has('start_age')) {{ $errors->first('start_age') }} @endif</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_age">&nbsp;</label>
                                        <input name="end_age" placeholder="Ending Age" type="text" id="end_age" class="form-control">
                                        <p class="feedback">@if($errors->has('end_age')) {{ $errors->first('end_age') }} @endif</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                            </div>
                            <div class="row justify-content-md-center">
                                 @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>@endif
                            </div>
                            <div class="col-md-8 text-center">
                                <button class="btn primary-btn submit d-block">Add Program</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection