@extends('stand_alone_pages.layouts.master')
@section('content')
<div class="main-content">
<div class="container">
<div class="row">
  <div class="col-md-8 dryclean">
      <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span>{{$page_data->page_heading}}</h2>
      <h3>{{$page_data->tags}}</h3>
      <hr>
      <img src="{{url('/')}}/public/dump_images/{{$page_data->background_image}}" class="img-responsive">
      <div>{!! $page_data->content !!}</div>
  </div>
  <div class="col-md-4">
      <div class="right-sidebar">
        <h2>Our Services</h2>
        <div class="services">
          <a href="{{route('getDryClean')}}">
            <div class="image-serv">
              <span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
            </div>
            <h3>Dry Clean</h3>
          </a>
        </div>
        <div class="services">
          <a href="#">
            <div class="image-serv">
              <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            </div>
            <h3>Wash N Fold</h3>
          </a>
        </div>
        <div class="services">
          <a href="#">
            <div class="image-serv">
              <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
            </div>
            <h3>Corporate</h3>
          </a>
        </div>
        <div class="services">
          <a href="#">
            <div class="image-serv">
              <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
            </div>
            <h3>Tailoring</h3>
          </a>
        </div>
        <div class="services">
          <a href="#">
            <div class="image-serv">
              <span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
            </div>
            <h3>Wet cleaning</h3>
          </a>
        </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
