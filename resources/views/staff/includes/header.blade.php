<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
    $obj = new \App\Helper\NavBarHelper();
    $site_details = $obj->siteData();
?>
<meta name="description" content="{{ isset($site_details) && $site_details!=null && $site_details->meta_description!= null ? $site_details->meta_description : 'U-rang is the #1 dry cleaning services in New York'}}">
<meta name="author" content="">
<meta name="keyword" content="{{ isset($site_details) && $site_details!=null && $site_details->meta_keywords!= null ? $site_details->meta_keywords : 'U-rang'}}">

<title>{{ isset($site_details) && $site_details!=null && $site_details->site_title!= null ? $site_details->site_title : 'U-rang'}}</title>


<!-- Bootstrap Core CSS -->
<link href="{{url('/')}}/public/new/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- Custom CSS -->
<link href="{{url('/')}}/public/css/sb-admin.css" rel="stylesheet">

<link href="{{url('/')}}/public/css/staff.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{url('/')}}/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/sweetalert.css"/>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/public/js/jquery.creditCardValidator.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{url('/')}}/public/new/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('/')}}/public/js/sweetalert.min.js"></script>


