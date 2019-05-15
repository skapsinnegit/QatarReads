<!-- Main navbar -->
	<div class="navbar navbar-inverse top-navbar">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ route("admin.index") }}">{{ env('APP_NAME') }}</a>
			@if(Auth::guard('admin')->check())
				<ul class="nav navbar-nav visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
					<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
				</ul>
			@endif

		</div>
		@if(Auth::guard('admin')->check())
			<div class="navbar-collapse collapse" id="navbar-mobile">
				<ul class="nav navbar-nav">
					<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<img src="img/admin/placeholder.jpg" alt="">
							<span>{{ Auth::guard('admin')->user()->name }}</span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="{{route('admin.updatePassword')}}"><i class="icon-lock2"></i> Update Profile</a></li>
							<li><a href="{{route('admin.logout')}}"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		@endif
	</div>
	<!-- /main navbar -->