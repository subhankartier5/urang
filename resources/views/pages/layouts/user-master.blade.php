<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.includes.header')
</head>
<body>
	@include('pages.includes.navbaruser')
	@yield('content')
    @include('pages.includes.footer')
</body>
</html>