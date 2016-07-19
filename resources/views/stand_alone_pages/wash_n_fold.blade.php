@extends('stand_alone_pages.layouts.master')
@section('content')
<div class="main-content">
<div class="container">
<div class="row">
  <div class="col-md-8 dryclean">
      <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span>{{$page_data != null && $page_data->page_heading != null ? $page_data->page_heading : "Wash and Fold"}}</h2>
      <h3>{{$page_data != null && $page_data->tags != null ? $page_data->tags : "U-Rang 2016 #1 wash and fold in US"}}</h3>
      <hr>
      @if($page_data != null && $page_data->background_image!= null)
        <img src="{{url('/')}}/public/dump_images/{{$page_data->background_image}}" class="img-responsive">
      @else
        <img src="{{url('/')}}/public/dump_images/182396758.jpg" class="img-responsive" alt="dry clean page image">
      @endif
      <div>{!! $page_data != null && $page_data->content != null ? $page_data->content : "Wash and Fold Page" !!}</div>
  </div>
  <div class="col-md-4">
      @include('stand_alone_pages.includes.sidenav')
  </div>
</div>
</div>
</div>
@endsection
