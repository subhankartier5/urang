@extends('pages.layouts.master')
@section('content')
<div class="main-content">
<div class="container-fluid">
  <div class="row banner">
   <div id="slide1">
     <div class="content">
     <div id="snowflakes1"></div>
     <div id="snowflakes2"></div>
     <h2>We are U-Rang</h2>
     <div id="divider"> </div>
     <h1>NEW YORK CITY'S #1</h1>
     
     <h3>Concierge Dry Cleaning Service Owned and Operated Facility in Manhattan</h3>
     <div class="subscribe-buttons">
       <a href="#">get started now</a>
       <a href="#">discover more</a>
     </div>
     </div> 
   </div>
  </div>
</div>
<div class="container" id="slide2">
  <div class="row">
    <h2>Our Services</h2>
    <div class="col-md-12">
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
              <span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
            </div>
          </div>
          <h3> Dry clean Only </h3>
          <p>Dry Cleaners are not the same. We'll show you why.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
             <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            </div>
          </div>
          <h3> WASH & FOLD </h3>
          <p>If you never tried our service you are in for a treat.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
             <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
            </div>
          </div>
          <h3> Corporate </h3>
          <p>Tailoring how much simpler can it be, we have an onsite tailor that handles A to Zippers.</p>
        </div>
      </div>
      <div class="clear50"></div>
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
             <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
            </div>
          </div>
          <h3> TAILORING </h3>
          <p>Tailoring how much simpler can it be, we have an onsite tailor that handles A to Zippers.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
            <span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
            </div>
          </div>
          <h3> WET CLEANING </h3>
          <p>Wet cleaning is professional fabric care using water and special non-toxic soaps.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="section-first">
          <div class="icon-section">
            <div class="icon-img">
            <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
            </div>
          </div>
          <h3>Clean my apt </h3>
          <p>Wet cleaning is professional fabric care using water and special non-toxic soaps.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="slide3">
  <div class="row banner">
       <div class="col-md-6 col-sm-12">
        <div class="third-content move">
          <h2>WE THINK, WE LISTEN, WE CARE</h2>
          <h1>AREAS OF EXPERTISE</h1>
          <h4>We cover every aspect of a domestic concierge servcice</h4>
          <p>Serving NYC online for over 10 years.</p>
          <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
          <div class="section-content">
            <h5>Fine Dry Cleaning and Laundry Service in New York City - Straight to Your Door</h5>
            <p>Owned and Operated facility in Manhattan</p>
            <p>Organic cleaning, offering our clients wet cleaning service in New York City (NYC), true Eco-friendly cleaning.
Free pick-up and delivery on all dry cleaning and wash and fold service in NYC.</p>
            <p>The finest Wash & Fold, laundry Service in New York City.
Expert stain removal and restoration for your fine garments.
Each garment is personally inspected and treated for the highest quality.
We clean the finest leather and suede.
We offer you full storage on all your clothes including a fur vault.</p>
          </div>
          <div class="section-content">
            <h5>Corporate</h5>
            <p>All Coporate Events from Catering and Uniforms to Large Sports Events</p>
            <p>Dry Cleaning service for staff and buildings
Work directly with property management companies and property mangers
Laundry and dry cleaning service for corporate events and special events
Executive Wash & Fold service for nursery schools, Hedge funds, Executive gyms and corporate companies.</p>
          </div>
        </div>
       </div> 
       <div class="col-md-6 col-sm-12">
          <div class="third-content third-content-image">
            <div class="urang-img">
              <img src="{{url('/')}}/public/images/areas.png" class="img-responsive">
            </div>
          </div>
        </div>
  </div> 
</div>
<div class="container" id="slide4">
  <div class="row">
    <h2>Simple Steps. Quick Design</h2>
    <h4>We make it easy, so you don't have to worry!</h4>
    <div class="col-md-12">
      <div class="col-md-4">
        <div class="section-quick first">
          <img src="{{url('/')}}/public/images/placeorder.png" class="img-responsive">
          <p>1. Place your order</p>
        </div>
      </div>
      <div class="col-md-4"><img src="{{url('/')}}/public/images/arrow.png" class="img-responsive arrowimg"></div>
      <div class="col-md-4"></div>
      <div class="clear"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="section-quick">
          <img src="{{url('/')}}/public/images/person.png" class="img-responsive">
          <p>2. We pick-up & clean</p>
        </div>
      </div>
      <div class="col-md-4"><img src="{{url('/')}}/public/images/arrow.png" class="img-responsive arrowimg"></div>
      <div class="clear"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="section-quick">
          <img src="{{url('/')}}/public/images/deliver.png" class="img-responsive">
          <p>3. We return & deliver</p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid slide5">
<div id="slide5">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-2 thumpsup">
        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
      </div>
      <div class="col-md-6">
        <h2>U-RANG IS NEW YORK CITY'S #1 CONCIERGE SERVICE</h2>
        <h3>With more than 10+ years in Business, we are the Best.</h3>
      </div>
      <div class="col-md-4 thumpsup">
          <button type="button" class="btn btn-primary btn-lg">Sign up now</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection