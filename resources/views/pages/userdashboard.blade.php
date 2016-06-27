@extends('pages.layouts.user-master')
@section('content')
<div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8 dashboard">
            <h2> Dashboard </h2>
            <div class="dash-section">
              <h3>New Pick-Up</h3>
              <p><a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Schedule Pick-Up </a></p>
            </div>
            <div class="clear50"></div>
            <div class="dash-section">
              <h3>Current Pick-Ups</h3>
              <p>You currently have no scheduled pick-ups.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="right-sidebar">
              <h2>Our Services</h2>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/dryclean.png" class="img-responsives">
                  </div>
                  <h3>Dry Clean</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/washnfold.png" class="img-responsives">
                  </div>
                  <h3>Wash N Fold</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/corporate.png" class="img-responsives">
                  </div>
                  <h3>Corporate</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/tailoring.png" class="img-responsives">
                  </div>
                  <h3>Tailoring</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/wetcleaning.png" class="img-responsives">
                  </div>
                  <h3>Wet cleaning</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/cleanapt.png" class="img-responsives">
                  </div>
                  <h3>clean my apt</h3>
                </a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection