<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.includes.header')
</head>
<body>
	@include('pages.includes.navbar')
	@yield('content')
    @include('pages.includes.footer')
</body>
</html>