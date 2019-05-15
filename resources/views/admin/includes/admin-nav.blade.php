<?php
$_controller = explode("@", basename(str_replace('\\', '/', Route::currentRouteAction())))[0] ? :"";
?>
<div class="sidebar sidebar-main">
	<div class="sidebar-content">
		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li class="dropdown-toggle{{ Route::currentRouteName()=='admin'? " active":""}}">
						<a href="{{route('admin.index')}}"><i class="icon-home4"></i> <span>Dashboard</span></a>
					</li>
				</ul>
			</div>
		</div>
		<!-- /main navigation -->
	</div>
</div>