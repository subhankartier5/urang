<?php $i=0;?>
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
<!-- ========================== -->
<!-- HOME - FEATURES -->
<!-- ========================== -->
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
               @for($j=0 ; $j< count($price_list); $j++)
                  @if($price_list[$j]->categories->name == 'Residential Services')
                        <li class="plan highlight">
                           <span class="price price-green">{{$price_list[$j]->price}}</span>
                           <div class="details">
                              <h1 class="plan-title" style="margin-top: 14px;">
                                 <?php
                                    $arr = 0;
                                    if (preg_match('/.*\(.*\).*/', $price_list[$j]->item))
                                    {
                                      $arr = explode("(",$price_list[$j]->item);
                                    }
                                    else
                                    {
                                      echo $price_list[$j]->item;
                                    }
                                 ?>
                                 {{$arr[0]}}
                              </h1>
                              <p>{{preg_match('/.*\(.*\).*/', $price_list[$j]->item )? substr_replace($arr[1], '(', 0, 0): ''}}</p>
                           </div>
                           <a href="{{route('getSignUp')}}"><button class="btn select ">Sign-Up Now</button></a>
                        </li>
                  @endif
               @endfor
            @else
               No Data
            @endif
         </ul>
      </div>
      <div class="col-md-6">
         <ul class="plans">
            <h2>Household Items: Dry Clean</h2>
            @if(count($price_list) > 0)
               @foreach($price_list as $price)
                  @if($price->categories->name == 'Household Items: Dry Clean')
                     <li class="plan highlight">
                        <span class="price price-green">{{$price->price}}</span>
                        <div class="details">
                           <h1 class="plan-title" style="margin-top: 14px;">
                              <?php
                                 $arr = 0;
                                 if (preg_match('/.*\(.*\).*/', $price->item))
                                 {
                                   $arr = explode("(",$price->item);
                                 }
                                 else
                                 {
                                   echo $price->item;
                                 }
                              ?>
                              {{$arr[0]}}
                           </h1>
                           <p>{{preg_match('/.*\(.*\).*/', $price->item )? substr_replace($arr[1], '(', 0, 0): ''}}</p>
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
                        <span class="price price-green">{{$price->price}}</span>
                        <div class="details">
                           <h1 class="plan-title" style="margin-top: 14px;">
                              <?php
                                 $arr = 0;
                                 if (preg_match('/.*\(.*\).*/', $price->item))
                                 {
                                   $arr = explode("(",$price->item);
                                 }
                                 else
                                 {
                                   echo $price->item;
                                 }
                              ?>
                              {{$arr[0]}}
                           </h1>
                           <p>{{preg_match('/.*\(.*\).*/', $price->item )? substr_replace($arr[1], '(', 0, 0): ''}}</p>
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