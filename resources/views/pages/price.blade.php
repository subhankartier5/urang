@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
	<div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        <h2>Dry Cleaning Price List</h2>
        <p>Our Master Craftsmen can do miracles--you will be amazed! We offer full service Dry Cleaning & shirt Laundry, We also professionally clean Leather & Suede</p>

          <div class="price-table">
            <div class="col-md-6">
              <table class="table table-responsive">
                <thead>
                  <th>Residential Service</th>
                </thead>
                <tbody>
                	@foreach($price_list as $price)
	                	@if($price->categories->name == 'Residential Services')
	                		<tr>
			                  	<td>{{$price->item}}</td>
			                  	<td>${{$price->price}}</td>
			                </tr>
	                	@endif
	                @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-responsive">
                <thead>
                  <th>Household Items: Dry Clean</th>
                </thead>
                <tbody>
	              	@foreach($price_list as $price)
	                	@if($price->categories->name == 'Household Items: Dry Clean')
	                		<tr>
			                  	<td>{{$price->item}}</td>
			                  	<td>${{$price->price}}</td>
			                </tr>
	                	@endif
	                @endforeach
                </tbody>
              </table>
              <div class="clear50"></div>
              <table class="table table-responsive">
                <thead>
                  <th>Bedding</th>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2">&nbsp</td>
                  </tr>
                  @foreach($price_list as $price)
	                	@if($price->categories->name == 'Bedding')
	                		<tr>
			                  	<td>{{$price->item}}</td>
			                  	<td>${{$price->price}}</td>
			                </tr>
	                	@endif
	                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="right-sidebar">
              <h2>Our Services</h2>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/dryclean.png" class="img-responsives">
                  </div>
                  <h3>Dry Clean</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/washnfold.png" class="img-responsives">
                  </div>
                  <h3>Wash N Fold</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/corporate.png" class="img-responsives">
                  </div>
                  <h3>Corporate</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/tailoring.png" class="img-responsives">
                  </div>
                  <h3>Tailoring</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/wetcleaning.png" class="img-responsives">
                  </div>
                  <h3>Wet cleaning</h3>
                </a>
              </div>
              <div class="services">
                <a href="#">
                  <div class="image-serv">
                    <img src="images/cleanapt.png" class="img-responsives">
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