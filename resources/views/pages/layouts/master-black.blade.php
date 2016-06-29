<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.includes.header')
</head>
<body data-scrolling-animations="true" style="background: #1a1a1a;">
	@include('pages.includes.navbar')
	@yield('content')
    @include('pages.includes.footer')
</body>
</html>