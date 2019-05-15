<ul class="parent-menu">
	<li><a href="{{ routex('dashboard') }}" class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : ''}}"><i class="fa fa-bar-chart"></i>Dashboard</a></li>
	<li><a href="{{ routex('listChildren') }}" class="{{ (Route::currentRouteName() == 'listChildren' || Route::currentrouteName() == "addchildren" || Route::currentrouteName() == "editChild") ? 'active' : ''}}"><i class="fa fa-child"></i>My Children</a></li>
	<li><a href="{{ routex('listProgram') }}" class="{{ (Route::currentRouteName() == 'listProgram' || Route::currentrouteName() == "subscribeForm") ? 'active' : ''}}"><i class="fa fa-file-text-o "></i>Programs</a></li>
	<li><a href="{{ routex('profileUpdate') }}" class="{{ Route::currentRouteName() == 'profileUpdate' ? 'active' : ''}}"><i class="fa fa-user"></i>Profile</a></li>
	<li><a href="{{routex('logout')}}" class="confirm"><i class="fa fa-sign-out"></i>Logout</a></li>
</ul>