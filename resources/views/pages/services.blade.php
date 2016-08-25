@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
	<section class="top-header services-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">our services</div>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<!-- ========================== -->
<!-- SERVICES - STEPS  -->
<!-- ========================== -->
<section class="core-features-section">
   <div class="container">
      <div class="section-heading">
         <div class="section-title">core services</div>
         <div class="section-subtitle">your personal concierge</div>
         <div class="design-arrow"></div>
      </div>
   </div>
   <div class="container">
      <div class="service-navigation">
         <ul class="row" role="tablist">
            <li role="presentation" id="dry_clean">
               <a href="#tabDry" aria-controls="tabDry" role="tab" data-toggle="tab" class="dry">
                  <div class="col-md-4 col-sm-4 col-xs-4 wow zoomInUp" data-wow-delay="0.2s">
                     <div class="navigation-item">
                        <div class="navigation-icon">
                           <span class="icon icon-DesktopMonitor"></span>
                        </div>
                        <h5>dry clean only</h5>
                     </div>
                  </div>
               </a>
            </li>
            <li role="presentation" id="wash_n_fold">
               <a href="#tabWash" aria-controls="tabWash" role="tab" data-toggle="tab" class="wash">
                  <div class="col-md-4 col-sm-4 col-xs-4 wow zoomInUp" data-wow-delay="0.3s">
                     <div class="navigation-item">
                        <div class="navigation-icon">
                           <span class="icon icon-Phone"></span>
                        </div>
                        <h5>wash & fold</h5>
                     </div>
                  </div>
               </a>
            </li>
            <li role="presentation" id="corporate">
               <a href="#tabCorp" aria-controls="tabCorp" role="tab" data-toggle="tab">
                  <div class="col-md-4 col-sm-4 col-xs-4 wow zoomInUp" data-wow-delay="0.4s">
                     <div class="navigation-item">
                        <div class="navigation-icon">
                           <span class="icon icon-DSLRCamera"></span>
                        </div>
                        <h5>coporate</h5>
                     </div>
                  </div>
               </a>
            </li>
            <li role="presentation" id="tailoring">
               <a href="#tabTailor" aria-controls="tabTailor" role="tab" data-toggle="tab">
                  <div class="col-md-4 col-sm-4 col-xs-4 wow zoomInUp" data-wow-delay="0.5s">
                     <div class="navigation-item">
                        <div class="navigation-icon">
                           <span class="icon icon-Picture"></span>
                        </div>
                        <h5>tailoring</h5>
                     </div>
                  </div>
               </a>
            </li>
            <li role="presentation" id="wet_cleaning">
               <a href="#tabWet" aria-controls="tabWet" role="tab" data-toggle="tab">
                  <div class="col-md-4 col-sm-4 col-xs-4 wow zoomInUp" data-wow-delay="0.5s">
                     <div class="navigation-item">
                        <div class="navigation-icon">
                           <span class="icon icon-Picture"></span>
                        </div>
                        <h5>wet cleaning</h5>
                     </div>
                  </div>
               </a>
            </li>
         </ul>
      </div>
   </div>
   <hr>
   <a href="" id="scroll_here"></a>
   <div class="container tab-content wow fadeInUp" >
      <div role="tabpanel" class="tab-pane" id="tabDry">
         <div class="row">
            <div style="height: 80px;"></div>
            <?php
            	$page_data_dry_clean = \App\Cms::where('identifier', 0)->first();
            	//0 for dry clean page
            ?>
            <div class="col-md-6 col-sm-6 text-center">
            	@if($page_data_dry_clean != null && $page_data_dry_clean->background_image!= null)
			        <img src="{{url('/')}}/public/dump_images/{{$page_data_dry_clean->background_image}}" class="img-responsive">
			    @else
			        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
			    @endif
            </div>
            <div class="col-md-6">
               <h5 class="italic-title">{{$page_data_dry_clean != null && $page_data_dry_clean->page_heading != null ? $page_data_dry_clean->page_heading : "Dry Clean Only"}}</h5>
               <p>
                  {!! $page_data_dry_clean != null && $page_data_dry_clean->content != null ? $page_data_dry_clean->content : "Dry Clean Page Default Content" !!}
               </p>
               <!-- <ul class="marker-list">
                  <li>Commodo consequt. Duis aute irure dolor reprehenderit </li>
                  <li>Atetur adipisicing elit sed do eiusmod tempor incididunt ut labore dolore</li>
                  <li>Pliqua ut enim ad mid veniam quis nostrud exercitation ullamco</li>
                  <li>Voluptate velit esse cillum dolore fugiat lore ipsum dolor sit amet </li>
                  <li>Amco laboris nisi ut aliquip xea commodo consequt </li>
                  </ul>-->
            </div>
            <div class="col-md-12">
               <div style="height: 40px;"></div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tabWash">
         <div class="row">
            <div style="height: 80px;"></div>
            <?php
            	$page_data_wash = \App\Cms::where('identifier', 1)->first();
            	//1 for wash and fold clean page
            ?>
            <div class="col-md-6 col-sm-6 text-center">
               @if($page_data_wash != null && $page_data_wash->background_image!= null)
			        <img src="{{url('/')}}/public/dump_images/{{$page_data_wash->background_image}}" class="img-responsive">
			    @else
			        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
			    @endif
            </div>
            <div class="col-md-6">
               <h5 class="italic-title">{{$page_data_wash != null && $page_data_wash->page_heading != null ? $page_data_wash->page_heading : "Wash and Fold"}}</h5>
               <p>
                  {!! $page_data_wash != null && $page_data_wash->content != null ? $page_data_wash->content : "Wash and Fold Page Default Content" !!}
               </p>
               <!-- <ul class="marker-list">
                  <li>Commodo consequt. Duis aute irure dolor reprehenderit </li>
                  <li>Atetur adipisicing elit sed do eiusmod tempor incididunt ut labore dolore</li>
                  <li>Pliqua ut enim ad mid veniam quis nostrud exercitation ullamco</li>
                  <li>Voluptate velit esse cillum dolore fugiat lore ipsum dolor sit amet </li>
                  <li>Amco laboris nisi ut aliquip xea commodo consequt </li>
                  </ul>-->
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tabCorp">
         <div class="row">
            <div class="row">
               <div style="height: 80px;"></div>
               <?php
	            	$page_data_corp = \App\Cms::where('identifier', 2)->first();
	            	//2 for corporate page
            	?>
               <div class="col-md-6 col-sm-6 text-center">
                   @if($page_data_corp != null && $page_data_corp->background_image!= null)
			        <img src="{{url('/')}}/public/dump_images/{{$page_data_corp->background_image}}" class="img-responsive">
				    @else
				        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
				    @endif
               </div>
               <div class="col-md-6">
                  <h5 class="italic-title">{{$page_data_corp != null && $page_data_corp->page_heading != null ? $page_data_corp->page_heading : "Corporate B2b"}}</h5>
                  <p>
                     {!! $page_data_corp != null && $page_data_corp->content != null ? $page_data_corp->content : "Corporate Page Default Content" !!}
                  </p>
                  <h5 class="italic-title"></h5>
                  <p></p>
                  <!-- <ul class="marker-list">
                     <li>Commodo consequt. Duis aute irure dolor reprehenderit </li>
                     <li>Atetur adipisicing elit sed do eiusmod tempor incididunt ut labore dolore</li>
                     <li>Pliqua ut enim ad mid veniam quis nostrud exercitation ullamco</li>
                     <li>Voluptate velit esse cillum dolore fugiat lore ipsum dolor sit amet </li>
                     <li>Amco laboris nisi ut aliquip xea commodo consequt </li>
                     </ul>-->
               </div>
               <div style="height: 80px;"></div>
               <div class="col-md-6">
                  <h5 class="italic-title"></h5>
                  <p></p>
               </div>
               <div class="col-md-6">
                  <p></p>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tabTailor">
         <div class="row">
            <div style="height: 80px;"></div>
            <?php
            	$page_data_tailoring = \App\Cms::where('identifier', 3)->first();
            	//3 for tailoring page
            ?>
            <div class="col-md-6 col-sm-6 text-center">
               @if($page_data_tailoring != null && $page_data_tailoring->background_image!= null)
		        <img src="{{url('/')}}/public/dump_images/{{$page_data_tailoring->background_image}}" class="img-responsive">
			   @else
			        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
			   @endif
            </div>
            <div class="col-md-6">
               <h5 class="italic-title">{{$page_data_tailoring != null && $page_data_tailoring->page_heading != null ? $page_data_tailoring->page_heading : "Tailoring"}}</h5>
               <p>
                  {!! $page_data_tailoring != null && $page_data_tailoring->content != null ? $page_data_tailoring->content : "Tailoring Page Default Content" !!}
               </p>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tabWet">
         <div class="row">
            <div style="height: 80px;"></div>
            <?php
            	$page_data_wet_cln = \App\Cms::where('identifier', 4)->first();
            	//4 for wet cleaning page
            ?>
            <div class="col-md-6 col-sm-6 text-center">
            	@if($page_data_wet_cln != null && $page_data_wet_cln->background_image!= null)
		        	<img src="{{url('/')}}/public/dump_images/{{$page_data_wet_cln->background_image}}" class="img-responsive">
			   	@else
			        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
			   	@endif
            </div>
            <div class="col-md-6">
               <h5 class="italic-title">{{$page_data_wet_cln != null && $page_data_wet_cln->page_heading != null ? $page_data_wet_cln->page_heading : "Wet Cleaning"}}</h5>

               <p>
               	{!! $page_data_wet_cln != null && $page_data_wet_cln->content != null ? $page_data_wet_cln->content : "Wet Cleaning Page Default Content" !!}
               </p>
               <ul class="marker-list">
                  <b>Benefits of Wet Cleaning</b>
                  <li>Wet-cleaning is environmentally friendly to the environment.</li>
                  <li>Wet-cleaning will eliminate the use of dry cleaning solvents.</li>
                  <li>Many soils are easily removed with water than a chemical solvent.</li>
                  <li>Wet-cleaned garments tend to have a pleasant smell, compared to dry cleaning.</li>
                  <li>Wet cleaning can help to keep the white garments whiter. </li>
                  <li>Nearly all garments labeled "Dry Clean Only" can be wet cleaned.</li>
                  <li>Wet Cleaning will reduce the use of perchloroethylene.</li>
                  <li>Wet cleaning reduces environmental concerns of the garment-cleaning industry.</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    var url = window.location.href;
    var myString = url.substr(url.indexOf("#") + 1);
    //console.log(myString);
    switch(myString) {
      case 'dry-clean' :
        $('#dry_clean').attr('class', 'active');
        $('#tabDry').attr('class', 'active');
        break;
      case 'wash-n-fold' :
        $('#wash_n_fold').attr('class', 'active');
        $('#tabWash').attr('class', 'active');
        break;
      case 'corporate' :
        $('#corporate').attr('class', 'active');
        $('#tabCorp').attr('class', 'active');
        break;
      case 'tailoring' :
        $('#tailoring').attr('class', 'active');
        $('#tabTailor').attr('class', 'active');
        break;
      case 'wet-cleaning' :
        $('#wet_cleaning').attr('class', 'active');
        $('#tabWet').attr('class', 'active');
        break;
      default :
        $('#wash_n_fold').attr('class', 'active');
        $('#tabWash').attr('class', 'active');
        break;
    }
    //dry clean
    $('#dry_clean').click(function() {
      //alert('hi')
      $('#dry_clean').attr('class', 'active');
      $('#tabDry').show();
      $('#wash_n_fold').attr('class','inactive');
      $('#tabWash').hide();
      $('#corporate').attr('class','inactive');
      $('#tabCorp').hide();
      $('#tailoring').attr('class','inactive');
      $('#tabTailor').hide();
      $('#wet_cleaning').attr('class','inactive');
      $('#tabWet').hide();
    });
    //wash n fold
    $('#wash_n_fold').click(function(){
      $('#dry_clean').attr('class', 'inactive');
      $('#tabDry').hide();
      $('#wash_n_fold').attr('class','active');
      $('#tabWash').show();
      $('#corporate').attr('class','inactive');
      $('#tabCorp').hide();
      $('#tailoring').attr('class','inactive');
      $('#tabTailor').hide();
      $('#wet_cleaning').attr('class','inactive');
      $('#tabWet').hide();
    });
    //corporate
    $('#corporate').click(function(){
      $('#dry_clean').attr('class', 'inactive');
      $('#tabDry').hide();
      $('#wash_n_fold').attr('class','inactive');
      $('#tabWash').hide();
      $('#corporate').attr('class','active');
      $('#tabCorp').show();
      $('#tailoring').attr('class','inactive');
      $('#tabTailor').hide();
      $('#wet_cleaning').attr('class','inactive');
      $('#tabWet').hide();
    });
    //tailoring
    $('#tailoring').click(function(){
      $('#dry_clean').attr('class', 'inactive');
      $('#tabDry').hide();
      $('#wash_n_fold').attr('class','inactive');
      $('#tabWash').hide();
      $('#corporate').attr('class','inactive');
      $('#tabCorp').hide();
      $('#tailoring').attr('class','active');
      $('#tabTailor').show();
      $('#wet_cleaning').attr('class','inactive');
      $('#tabWet').hide();
    });
    //wet clean
    $('#wet_cleaning').click(function(){
      $('#dry_clean').attr('class', 'inactive');
      $('#tabDry').hide();
      $('#wash_n_fold').attr('class','inactive');
      $('#tabWash').hide();
      $('#corporate').attr('class','inactive');
      $('#tabCorp').hide();
      $('#tailoring').attr('class','inactive');
      $('#tabTailor').hide();
      $('#wet_cleaning').attr('class','active');
      $('#tabWet').show();
    });
    $('html, body').animate({
        scrollTop: $('#scroll_here').offset().top
    }, 'slow');
  });
</script>
@endsection