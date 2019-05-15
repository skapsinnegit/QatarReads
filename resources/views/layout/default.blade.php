<!doctype html>
<html>
<head>
	<title>{{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <base href="{{url("/")}}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ltrim(mix('css/app.css'), "/")}}">
</head>
<body>
	<div id="app">
		@include("includes.header")
		<div class="wrapper">
			@yield("content")
		</div>
		@include("includes.footer")
	</div>
	<script src="{{ltrim(mix('js/app.js'), "/")}}"></script>
	@if($errors->has('alert'))
		<script>
			swal("{{$errors->first('msg')}}!", {
	          icon: "success",
	        }); 
		</script>
	@endif
</body>