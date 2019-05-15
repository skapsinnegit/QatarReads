@extends("layout.default")

@section("content")
	<section class="section-padding grey-section dashboard">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					@include('includes.parentMenu')
					<div class="panel">
						<div class="panel-heading">
							<i class="fa fa-file-text-o"></i> @lang('programs.page-title')
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="sub-panel">
										<div class="row">
											<div class="col-md-12 table-responsive">
												<table class="data-table data-table table table-striped table-bordered">
													<thead>
														<tr>					
															<th>@lang('programs.table-th-1')</th>
															<th>@lang('programs.page-title')</th>
															<th>@lang('programs.table-th-7')</th>
															<th>@lang('programs.table-th-2')</th>
															<th>@lang('programs.table-th-3')</th>
															<th>@lang('programs.table-th-4')</th>
															<th>@lang('programs.table-th-5')</th>
															<th>@lang('programs.table-th-6')</th>
														</tr>
													</thead>
													<tbody>	
													@foreach($programs as $key => $program)			
														<tr>
															<td>{{$key+1}}</td>
															<td>{{$program->name}}</td>
															<td>{{$program->start_age}} To {{$program->end_age}}</td>
															<td>{{$program->cost}} QAR/User</td>
															<td>{{$program->recurring_cost}} QAR/User</td>
															<td>{{checksubscription($program->id)->value == 1 ? "Subscribed" : "Nill"}}</td>
															<td>
																@if(checksubscription($program->id)->value==1)
															<input name="monthly_subscription" value="1" id="monthly_subscribed" data-url="{{routex('monthlySubscription',['id'=>encrypt($program->id)])}}" data-cost="{{$program->recurring_cost}}"  type="checkbox" {{subscriptionDetails($program->id)->monthly_subscription==1 ? "checked" : ""}}>
															{{$program->recurring_cost}}	Per Child
																
																	({{subscriptionDetails($program->id)->total}} Children)
																@else

																Nill

																@endif
														    </td>
															<td>
																@if(checksubscription($program->id)->value==1 || checksubscription($program->id)->value==2)

																@if(checksubscription($program->id)->value==1)
																	<a data-msg="You will be unsubsribed from this program" href="{{ routex('unsubscribe',['id'=>encrypt($program->id)]) }}" class="btn btn-danger text-white confirm">Unsubscribe </a>
																	@elseif(checksubscription($program->id)->value==2)
																		<a data-msg="You will be unsubsribed from this program" href="{{ routex('unsubscribe',['id'=>encrypt($program->id)]) }}" class="waiting-list btn btn-info text-white confirm">Waiting List </a>
																	@endif
																@else
																	<a href="{{ routex('subscribeForm',['id'=>encrypt($program->id)]) }}" class="btn btn-info text-white">{{$program->subscriptions->where('status',1)->count() >= $program->max_subscription ? "Join waiting List" : "Subscribe"}} </a>
																@endif

															</td>
														</tr>	
													@endforeach		
													</tbody>
												</table>
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