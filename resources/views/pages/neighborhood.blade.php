@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
<section class="top-header neighborhood-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">neighborhoods</div>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<!-- ========================== -->
<!-- HOME - LATEST WORKS -->
<!-- ========================== -->
<section class="latest-works-section clearfix">
   <div class="container">
      <div class="section-heading">
         <div class="section-title">Neighborhoods We Service</div>
         <div class="section-subtitle"></div>
         <div class="design-arrow"></div>
      </div>
   </div>
   <div class="scroll-pane ">
      <div class="scroll-content">
         @if(count($neighborhood) > 0)
            @foreach($neighborhood as $n)
               <div class="scroll-content-item  ">
                  <img src="{{url('/')}}/public/dump_images/{{$n->image}}" alt="image" />
                  <div class="scroll-content-body">
                     <div class="name"></div>
                  </div>
               </div>
            @endforeach
         @else
            No Data
         @endif
       </div>
   </div>
</section>
<!-- ========================== -->
<!-- HOME - AREAS OF EXPERTISE-->
<!-- ========================== --> 
<section class="areas-section with-icon with-top-effect">
   <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
      @if(count($neighborhood) > 0)
         @foreach($neighborhood as $n)
            <div class="container">
               <div class="row">
                  <div class="col-md-7 col-sm-7 text-right">
                     <div class="clearfix " style="padding-right: 3px;">
                        <div class="above-title">Neighborhoods</div>
                        <h4>{{$n->name}}</h4>
                     </div>
                     <div class="design-arrow inline-arrow"></div>
                     <p>
                     <ul style="font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
                     <p>{!!$n->description!!}</p>
                     <br />
                  </div>
                  <div style="height: 60px;"></div>
                  <div class="col-md-5 col-sm-5 text-center">
                     <img src="{{url('/')}}/public/dump_images/{{$n->image}}" alt="image" />
                  </div>
               </div>
            </div>
         @endforeach
      @else
         No Data
      @endif
</section>
@endsection