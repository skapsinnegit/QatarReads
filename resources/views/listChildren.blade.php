@extends("layout.default")

@section("content")
	<section class="section-padding grey-section dashboard">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					@include('includes.parentMenu')
					<div class="panel">
						<div class="panel-heading">
							<i class="fa fa-child"></i> @lang('children.page-title')
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="sub-panel">
										<div class="row align-items-center title-section">
											<div class="col-md-6"><h3 class="title">@lang('dashboard.sub-title-1')</h3></div>
											<div class="col-md-6 text-right"><a href="{{ routex('addchildren') }}" class="btn primary-btn action-btn">@lang('dashboard.add-child-btn')</a></div>
										</div>
										<div class="row">
											<div class="col-md-12 table-responsive">
												<table class="data-table data-table table table-striped table-bordered">
													<thead>
														<tr>
															<th>@lang('children.child-table-th-1')</th>
															<th>@lang('children.child-table-th-2')</th>
															<th>@lang('children.child-table-th-4')</th>
															<th>@lang('children.child-table-th-5')</th>
															<th>@lang('children.child-table-th-6')</th>
														</tr>
													</thead>
													<tbody>
														@foreach($children as $child)
														<tr>
															<td>{{$child->name}}</td>
															<td>{{$child->dob}}</td>
															<td>{{$child->gender}}</td>
															<td>{{$child->institution}}</td>
															<td>
																<a href="{{ routex('editChild',['id'=>encrypt($child->id)]) }}">@lang('children.edit-btn')</a>
																&nbsp; &nbsp;
																<a class="confirm" data-msg="Child will be deleted" href="{{ routex('deleteChild',['id'=>encrypt($child->id)]) }}">@lang('children.delete-btn')</a>
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