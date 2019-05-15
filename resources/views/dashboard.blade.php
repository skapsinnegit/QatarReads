@extends("layout.default")

@section("content")
	<section class="section-padding grey-section dashboard">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					@include('includes.parentMenu')
					<div class="panel">
						<div class="panel-heading">
							<i class="fa fa-bar-chart"></i>@lang('dashboard.page-title')
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-6 border-sub-panel">
									<div class="sub-panel">
										<div class="row align-items-center title-section">
											<div class="col-sm-6"><h3 class="title">@lang('dashboard.sub-title-1')</h3></div>
											<div class="col-sm-6 text-right"><a href="{{ routex('addchildren') }}" class="btn primary-btn action-btn">@lang('dashboard.add-child-btn')</a></div>
										</div>
										<div class="row">
											<div class="col-md-12 table-responsive">
												<table class="data-table table table-striped table-bordered">
													<thead>
														<tr>
															<th>@lang('dashboard.child-table-th-1')</th>
															<th>@lang('dashboard.child-table-th-2')</th>
															<th>@lang('dashboard.child-table-th-4')</th>
															<th>@lang('dashboard.child-table-th-5')</th>
														</tr>
													</thead>
													<tbody>
													@foreach($children as $child)
														<tr>
															<td>{{$child->name}}</td>
															<td>{{$child->dob}}</td>
															<td>{{$child->gender}}</td>
															<td>{{$child->institution}}</td>
														</tr>
													@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="sub-panel">
										<div class="row align-items-center title-section">
											<div class="col-sm-6"><h3 class="title">@lang('dashboard.sub-title-2')</h3></div>
										</div>
										<div class="row">
											<div class="col-md-12 table-responsive">
												<table class="data-table data-table table table-striped table-bordered">
													<thead>
														<tr>
															<th>@lang('dashboard.subscribe-table-th-1')</th>
															<th>@lang('dashboard.subscribe-table-th-2')</th>
														</tr>
													</thead>
													<tbody>
														@foreach($subscriptions as $subscription)
														<tr>
															<td>{{$subscription->programs->name}}</td>
															<td>
																@if($subscription->status==1)
																{{$subscription->programs->recurring_cost}} Per Child <br> ({{$subscription->count }} Children)
																@else
																Waiting List
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