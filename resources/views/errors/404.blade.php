<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Error 404!</title>
  <!-- Latest compiled and minified CSS -->
  <link href="{{url('/')}}/public/new/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Optional theme -->
  <link rel="stylesheet" href="{{url('/')}}/public/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/style.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="{{url('/')}}/public/new/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<style type="text/css">
body{
    background: #000;
}

.top-banner img{
  margin: 100px auto 0;
}

.top-banner h1{
    font-size: 30px;
    text-transform: capitalize;
    margin-bottom: 40px;
}

.top-banner p{
    font-size: 20px;
}

.top-banner p a{
  color: #ff6400;
  text-transform: uppercase;
}

.top-banner p a:hover{
  text-decoration: underline;
}

.contenterror{
    background: #ccc;
    padding: 40px;
    margin-top: 50px;
    border-radius: 10px;
}
</style>
</head>
<body>

  <div class="main-content top-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <img src="{{url('/')}}/public/images/404.png" class="img-responsive">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="contenterror">
              <h1>Sorry, we can't seem to find the page your are looking for.</h1>
              <p>Here is our <a href="{{route('index')}}">HOME PAGE</a> link instead.<p>
            </div>
        </div>
        <div class="col-md-1"></div>
        </div>
      </div>
  </div>

</body>
</html>