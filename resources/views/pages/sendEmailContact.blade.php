<!DOCTYPE html>
<html>
<head>
	<title>U-rang</title>
</head>
<body>
<h1>Someone tried to contact you from <a href="{{ url('/') }}">u-rang</a></h1>
<hr>
<label>Person's Details</label>
<div>First Name :- {{$firstName}}</div><br>
<div>Last Name :- {{$lastName}}</div><br>
<div>Phone No :- {{$phone}}</div><br>
<div>Email :- {{$email}}</div><br>
<div>Subject :- {{$subject}}</div><br>
<div>Message :- {{$text}}</div>

</body>
</html>