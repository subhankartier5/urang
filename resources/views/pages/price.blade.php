@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
<section class="top-header pricing-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">our prices</div>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<section class="features-section">
   <div class="container">
      <div class="section-heading " >
         <div class="section-title">Our Prices</div>
         <div class="section-subtitle">
            Our Master Craftsmen can do miracles--you will be amazed! <br>We offer full service Dry Cleaning & shirt Laundry, We also professionally clean Leather & Suede
         </div>
         <div class="design-arrow"></div>
      </div>
      <div class="col-md-6">
         <ul class="plans">
            <h2>Residential Service</h2>
            @if(count($price_list) > 0)
              @foreach($price_list as $price)
                @if($price->categories->name == 'Residential Services')
                  <li class="plan highlight">
                     <span class="price price-green">${{$price->price}}</span>
                     <div class="details">
                        <h1 class="plan-title" style="margin-top: 14px;">{{$price->item}}</h1>
                     </div>
                     <a href="{{route('getSignUp')}}"><button class="btn select ">Sign-Up Now</button></a>
                  </li>
                @endif
              @endforeach
            @else
              No Data
            @endif
         </ul>
      </div>
      <div class="col-md-6">
         <ul class="plans">
            <div style="height:60px;"></div>
            <h2>Household Items: Dry Clean</h2>
             @if(count($price_list) > 0)
              @foreach($price_list as $price)
                @if($price->categories->name == 'Household Items: Dry Clean')
                  <li class="plan highlight">
                     <span class="price price-green">${{$price->price}}</span>
                     <div class="details">
                        <h1 class="plan-title" style="margin-top: 14px;">{{$price->item}}</h1>
                     </div>
                     <a href="{{route('getSignUp')}}"><button class="btn select ">Sign-Up Now</button></a>
                  </li>
                @endif
              @endforeach
            @else
              No Data
            @endif
            <div style="height:40px;"></div>
            <h2>Bedding</h2>
            @if(count($price_list) > 0)
              @foreach($price_list as $price)
                @if($price->categories->name == 'Bedding')
                  <li class="plan highlight">
                     <span class="price price-green">${{$price->price}}</span>
                     <div class="details">
                        <h1 class="plan-title" style="margin-top: 14px;">{{$price->item}}</h1>
                     </div>
                     <a href="{{route('getSignUp')}}"><button class="btn select ">Sign-Up Now</button></a>
                  </li>
                @endif
              @endforeach
            @else
              No Data
            @endif
         </ul>
      </div>
   </div>
</section>
@endsection