<header class="header">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-md-12 ">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand d-flex" href="https://qatarreads.dike.io/">
                        <img src="images/logo.png" alt="{{ config('app.name') }}" class="img-fluid">
                        <img src="images/logo-grey.png" alt="{{ config('app.name') }}" class="img-fluid">
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="https://qatarreads.dike.io/about/">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://qatarreads.dike.io/activities/" id="accountDropdown"  aria-haspopup="true" aria-expanded="false">Activities </a>
                                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/dibf/">DIBF</a>
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/library-of-wonders/">Library of Wonders</a>
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/dar-al-saie/">Darb Al Saie</a>
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/empower/">Empower</a>
                                    </div>
                                </li>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://qatarreads.dike.io/junior/" id="accountDropdown"  aria-haspopup="true" aria-expanded="false">Junior </a>
                                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/junior/stories-to-go/">Stories To Go</a>
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/camp/">Camp</a>
                                    </div>
                                </li>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://qatarreads.dike.io/programs/" id="accountDropdown"  aria-haspopup="true" aria-expanded="false">Programs </a>
                                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                        <a class="dropdown-item" href="https://qatarreads.dike.io/family-reading-program-2/">Family Reading Program</a>
                                    </div>
                                </li>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://qatarreads.dike.io/partnerships/">Partnership</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://qatarreads.dike.io/community/" id="accountDropdown"  aria-haspopup="true" aria-expanded="false">Community </a>
                                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <a class="dropdown-item" href="https://qatarreads.dike.io/hospital-reading-program/">Hospital Reading Program</a>
                                    <a class="dropdown-item" href="https://qatarreads.dike.io/volunteer/">Volunteer</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://qatarreads.dike.io/gallery/">Gallery</a>
                            </li>
                            <li class="nav-item">
                                @if(config('app.locale') == "en")
                                    <a class="nav-link change-lang btn primary-btn" href="{{ route(Route::currentRouteName(), ['lang' => 'ar']) }}">العربية</a>
                                @else
                                    <a class="nav-link change-lang btn primary-btn" href="{{ route(Route::currentRouteName(), ['lang' => 'en']) }}">en</a>
                                @endif
                            </li>                            
                            @if(!Auth::check() || (\Request::route()->getName() =="admin.login") || \Request::route()->getName() =="signIn")
                                <li class="nav-item">
                                    <a class="nav-link btn trans-btn" href="{{ routex('signIn') }}"><i class="fa fa-user"></i> LogIn</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="accountDropdown"  aria-haspopup="true" aria-expanded="false">Hi, {{ Auth::user()->first_name }} </a>
                                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                        <a class="dropdown-item" href="{{ routex('dashboard') }}">Dashboard</a>
                                        <a class="dropdown-item" href="{{ routex('listChildren') }}">Children</a>
                                        <a class="dropdown-item" href="{{ routex('listProgram') }}">Programs</a>
                                        <a class="dropdown-item" href="{{ routex('profileUpdate') }}">Update Profile</a>
                                        <a class="dropdown-item" href="{{ routex('updatePassword') }}">Update Password</a>
                                        <a class="dropdown-item confirm" data-msg="" href="{{routex('logout')}}">Logout</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>