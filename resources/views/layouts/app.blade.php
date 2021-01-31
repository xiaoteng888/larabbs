<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{csrf_token()}}">
	<title>@yield('title','首页')-论坛网站</title>
    <meta name="description" content="@yield('description',$site->seo_description ? :'sm爱好者社区')">
    <meta name="keywords" content="@yield('keyword', $site->seo_key ? :'sm,社区,论坛'))" />
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">

    @yield('styles')
</head>
<body>
    <div id="app" class="{{route_class()}}-page">
    	@include('layouts._header')
    	<div class="container">
    		@include('shared._messages')
    		@yield('content')
    	</div>
    	@include('layouts._footer',['site' => $site])
    </div> 
    <!-- Scripts -->
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>

    @yield('scripts')
</body>
</html>