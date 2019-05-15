<nav class="navbar navbar-default">
    <div class="container-fluid header-container">
        <div class="navbar-header">
            <a class="navbar-brand d-flex p-0" href="{{ route('admin.index') }}">
                <img src="images/logo.png" alt="{{ config('app.name') }}" class="img-responsive">
                <img src="images/logo-grey.png" alt="{{ config('app.name') }}" class="img-responsive">
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <i class="icon-menu3" aria-hidden="true"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             @if((\Request::route()->getName() !="admin.login") && (\Request::route()->getName() !="signIn"))
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.listUser') }}">Users</a></li>
                <li class="dropdown">
                    <a href="{{ route('admin.listProgram') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Programs</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.listProgram') }}">List Programs</a></li>
                            @if(!Auth::check() || Auth::user()->editor_roll==1 || Auth::user()->roll == 1)
                                <li><a href="{{ route('admin.addProgram') }}">Add Programs</a></li>
                            @endif
                    </ul>
                </li>

                @if(!Auth::check() || Auth::user()->editor_roll==1 || Auth::user()->roll == 1)
                <li class="dropdown">
                    <a href="{{ route('admin.listEditor') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Editors</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.listEditor') }}">List Editors</a></li>
                        <li><a href="{{ route('admin.addEditor') }}">Add Editors</a></li>
                    </ul>
                @endif
                </li>
               
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.updateProfile') }}">Profile Update</a></li>
                        <li><a href="{{ route('admin.changePassword') }}">Change Password</a></li>
                        <li><a href="{{ route('logout') }}" class="confirm">Logout</a></li>
                    </ul>
                </li>
                
            </ul>
            @endif
        </div>
    </div>
</nav>