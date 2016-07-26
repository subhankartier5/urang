<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ isset($site_details) && $site_details!=null && $site_details->meta_description!= null ? $site_details->meta_description : 'U-rang is the #1 dry cleaning services in New York'}}">
    <meta name="author" content="">
    <meta name="keyword" content="{{ isset($site_details) && $site_details!=null && $site_details->meta_keywords!= null ? $site_details->meta_keywords : 'U-rang'}}">

    <title>{{ isset($site_details) && $site_details!=null && $site_details->site_title!= null ? $site_details->site_title : 'U-rang'}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('/')}}/public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('/')}}/public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{url('/')}}/public/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('/')}}/public/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="{{url('/')}}/public/css/staff.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('/')}}/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/jquery-ui.css">
    <script src="{{url('/')}}/public/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/sweetalert.css"/>
    <script type="text/javascript" src="{{url('/')}}/public/js/jquery.creditCardValidator.js"></script>
    <script type="text/javascript" src="{{url('/')}}/public/js/sweetalert.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{url('/')}}/public/js/jquery-ui.js"></script>
</head>