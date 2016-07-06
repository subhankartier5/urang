<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@include('staff.includes.header')	
</head>
<body>
	@include('staff.includes.navbar')
	@yield('content')

</body>
</html>