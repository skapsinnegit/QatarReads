<!doctype html>
<html>
<head>
	<title>Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <base href="{{url("/")}}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrfToken" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="css/admin-core.css">
	<link rel="stylesheet" href="{{ltrim(mix('css/admin.css'), "/")}}">

</head>
<body>
    <div id="app">
       {{-- @include("admin.includes.admin-top-nav") --}}
       @include("admin.includes.header")
        <div class="page-container {{ Auth::check() ? '' : 'login-container' }}">
            <div class="page-content">
                @if(Auth::guard('admin')->check())
                    {{-- @include("admin.includes.admin-nav") --}}
                @endif
                <div class="content-wrapper">
                    @yield("content")
                </div>
            </div>
        </div>
        @include("admin.includes.footer")
    </div>
    @yield('footerIncludes')
	<script src="{{ltrim(mix('js/admin.js'), "/")}}"></script>
</body>
</html>