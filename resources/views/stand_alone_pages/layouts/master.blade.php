<html>
<head>
  @include('stand_alone_pages.includes.header')
</head>
<body>
	@if($login_check != null)
		@include('pages.includes.navbaruser')
	@else
		@include('pages.includes.navbar')
	@endif
	@yield('content')
	@include('stand_alone_pages.includes.footer')
</body>
</html>