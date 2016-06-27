@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
	<div class="main-content neighbour">
	   <div class="container">
	      <div class="row">
	         <div class="col-md-8">
	            <div id="tabs">
	            <div style="display: none;">{{$i=1}}</div>
	               <ul>
	               		@foreach($neighborhood as $neighboor)
	               			<li><a href="#tabs-{{$i}}">{{$neighboor->name}}</a></li>
	               			<div style="display: none;">{{$i++}}</div>
	               		@endforeach
	               </ul>
	               <div style="display: none;">{{$j=1}}</div>
		               @foreach($neighborhood as $neighboor)
			               <div id="tabs-{{$j}}">
			                  <p>{{$neighboor->description}}</p>
			               </div>
			               <div style="display: none;">{{$j++}}</div>
			            @endforeach
	            </div>
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
	    $( "#tabs" ).tabs();
	  });
	</script>
@endsection