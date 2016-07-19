<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="{{$page_data != null && $page_data->meta_keywords != null ? $page_data->meta_keywords : "U-rang 2016 | dry clean only"}}">
<meta name="description" content="{{$page_data != null && $page_data->meta_description != null ? $page_data->meta_description : "U-rang 2016 | dry clean only"}}">
<title>{{$page_data != null && $page_data->title != null ? $page_data->title : "U-rang 2016 | Dry clean"}}</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{url('/')}}/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="{{url('/')}}/public/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/style.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/new/css/main.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{url('/')}}/public/new/vendor/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('/')}}/public/js/main.js"></script>
<style type="text/css">
  .main-content{
    padding: 50px 0;
    margin-top: 90px;
  }
  .header .navbar{
    background: #000;
  }
  .dryclean h2 {
    border: none;
    margin-bottom: 0;
    font-size: 30px;    
}

  .dryclean h2 span {
    color: #ff6400;
  }

.dryclean h3{
  font-size: 17px;
}

  .services .image-serv {
    border: 5px solid #FFD4B8;
    border-radius: 50%;
    padding: 15px;
    background: #fff;
    display: inline-block;
}

.right-sidebar a:hover .image-serv {
    background: #FFD4B8;
    border: 5px solid #fff;
}

.right-sidebar {
    border: 1px solid #ff6400;
    display: inline-block;
    width: 100%;
    padding: 5px;
    background: url("{{url('/')}}/public/images/orange-bg.png") no-repeat top center;
    background-size: 100% 100%;
}

.image-serv span{
  color: #ff6400;
  font-size: 20px;
}

.services {
    box-shadow: 0 3px 3px 0 #999;
}

.services a:hover h3{
  color: #ff6400;
}

.dryclean img{
    float: left;
    width: 30%;
    margin-right: 20px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 5px;
    background: #f1f1f1;
}
</style>