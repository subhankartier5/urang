@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
	  <div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h2>FAQs</h2>
          <p>How U-RANG Delivery Service Works...</p> 
          <p>The box field that is on the home page EASY AS 1.2.3.....</p>
          <div id="accordion" class="faq">
          	@if(count($faq) > 0)
	          	@foreach($faq as $faqs)
	      			<h3>{{$faqs->question}}</h3>
		            <div>
		              <p>{{$faqs->answer}}</p>
		            </div>
	          	@endforeach
	        @else
	        	<p class="alert alert-warning" style="text-align: center;">No Faq Still Now!</p>
	        @endif
          </div>
          <p class="schedule-pick">Click here to <a href="#">Schedule Pick-Up</a></p>
        </div>
<div class="col-md-4">
            <div class="right-sidebar">
              <h2>Our Services</h2>
              <div class="services">
                <a href="dryclean.html">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/dryclean.png" class="img-responsives">
                  </div>
                  <h3>Dry Clean</h3>
                </a>
              </div>
              <div class="services">
                <a href="washnfold.html">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/washnfold.png" class="img-responsives">
                  </div>
                  <h3>Wash N Fold</h3>
                </a>
              </div>
              <div class="services">
                <a href="corporate.html">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/corporate.png" class="img-responsives">
                  </div>
                  <h3>Corporate</h3>
                </a>
              </div>
              <div class="services">
                <a href="tailoring.html">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/tailoring.png" class="img-responsives">
                  </div>
                  <h3>Tailoring</h3>
                </a>
              </div>
              <div class="services">
                <a href="wetcleaning.html">
                  <div class="image-serv">
                    <img src="{{url('/')}}/public/images/wetcleaning.png" class="img-responsives">
                  </div>
                  <h3>Wet cleaning</h3>
                </a>
              </div>
              <div class="services">
                <a href="cleanmyapt.html">
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
   <script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  </script>
@endsection