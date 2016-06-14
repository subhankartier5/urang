@extends('pages.layouts.master')
@section('content')      
<!-- ========================== -->
<!-- HOME - HEADER -->
<!-- ========================== -->
<section class="top-header home-header with-bottom-effect transparent-effect dark">
    <div class="bottom-effect"></div>
    <div class="header-container">  
        <div class="wrap-section-slider" id="topSlider">
            <div class="sp-slides">
                <div class="slide-item sp-slide">
                    <div class="slide-image">
                        <img src="{{url('/')}}/public/img/sections/home-top-background.jpg"  alt="" />
                    </div>
                    <div class="slide-content ">
                        <p class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >We Are U-Rang</p>
                        <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">New York City's #1</div>
                        <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">Concierge Dry Cleaning Service</div>
                        <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> Owned and Operated Facility in Manhattan</div>
                        <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                            <a href="sign-up.php" class="btn btn-primary">Get Started NOW</a>
                            <a href="services.html" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
                        </div>
                    </div>
                </div>
                <div class="slide-item sp-slide">
                    <div class="slide-image">
                        <img src="{{url('/')}}/public/img/sections/section-11.jpg" alt="" />
                    </div>
                    <div class="slide-content sp-layer">
                        <p class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >We Are U-Rang</p>
                        <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">New York City's #1</div>
                        <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">Concierge Dry Cleaning Service</div>
                        <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> Owned and Operated Facility in Manhattan</div>
                        <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                            <a href="sign-up.php" class="btn btn-primary">Get Started NOW</a>
                            <a href="prices.html" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./container-->
</section>  


<!-- ========================== -->
<!-- HOME - FEATURES -->
<!-- ========================== -->
<section class="features-section">
    <div class="container">
        <div class="section-heading " >
            <div class="section-title">Our Services</div>
            <div class="section-subtitle"></div>
            <div class="design-arrow"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item ">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon icon-Carioca"></span>
                            </div>
                        </div>
                        <div class="title">Dry Clean Only</div>
                        <div class="text">
                            Dry Cleaners are not the same. We'll show you why. 
                       </div>
                    </div>
                </article>
            </div> 
            <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item active">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon icon-Heart"></span>
                            </div>
                        </div>
                        <div class="title">Wash & Fold</div>
                        <div class="text">
                            If you never tried our service you are 
                            in for a treat.
                        </div>
                    </div>
                </article>
            </div> 
            <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon  icon-Tools"></span>
                            </div>
                        </div>
                        <div class="title">Corporate</div>
                        <div class="text">
                            Corporate Events from Catering and 
                            Uniforms to Large Sports Events. 
                        </div>
                    </div>
                </article>
            </div> 
            <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon icon-Blog"></span>
                            </div>
                        </div>
                        <div class="title">Tailoring</div>
                        <div class="text">
                            Tailoring how much simpler can it be, we have an onsite tailor that handles A to Zippers.
                        </div>
                    </div>
                </article>
            </div> 
            <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon icon-Blog"></span>
                            </div>
                        </div>
                        <div class="title">Wet Cleaning</div>
                        <div class="text">
                            Wet cleaning is professional 
                            fabric care using water and 
                            special non-toxic soaps.
                        </div>
                    </div>
                </article>
            </div>
          <!-- <div class="col-md-4 col-sm-6 wow fadeIn">
                <article>
                    <div class="feature-item">
                        <div class="wrap-feature-icon">
                            <div class="feature-icon">
                                <span class="icon icon-Blog"></span>
                            </div>
                        </div>
                        <div class="title">Housekeeping</div>
                        <div class="text">
                            Quite simply the best home cleaning you can imagine. 
                        </div>
                    </div>
                </article>
            </div> -->
        </div>
    </div>
</section>


<!-- ========================== -->
<!-- HOME - LAPTOPS -->
<!-- ========================== -->
<section class="laptops-section">
    <div class="container">
        <div class="laptops text-center wow fadeInUp" data-wow-duration="1s">
            <img src="{{url('/')}}/public/img/laptop.jpg" alt="" class="img-responsive" />
        </div>
    </div>
    <div class="container">
        <div class="content-logo text-center wow fadeInUp"  data-wow-duration="1s">
            <img src="{{url('/')}}/public/img/content-logo.png" alt="" class="img-responsive" />
        </div>
    </div>
</section>

<!-- ========================== -->
<!-- HOME - AREAS OF EXPERTISE-->
<!-- ========================== --> 
<section class="areas-section with-icon with-top-effect">
    <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
    <div class="container"> 
        <div class="row">
            <div class="col-md-7 col-sm-7 text-right">
                <div class="clearfix " style="padding-right: 3px;">
                    <div class="above-title">We think, We Listen, We Care</div>
                    <h4>Areas of expertise</h4>
                </div>
                <div><em>We cover every aspect of a domestic concierge servcice.</em></div>
                <p>Serving NYC online for over 10 years.</p>
                <div class="design-arrow inline-arrow"></div>
                <p class="large">Fine Dry Cleaning and Laundry Service in New York City - Straight to Your Door</p>
                <p>Owned and Operated facility in Manhattan</p>
                <p>
                <ul style="font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
                    <li>Organic cleaning, offering our clients wet cleaning service in New York City (NYC), true Eco-friendly cleaning.</li>
                    <li>Free pick-up and delivery on all dry cleaning and wash and fold service in NYC.</li> 
                    <li>The finest Wash & Fold, laundry Service in New York City. </li>
                    <li>Expert stain removal and restoration for your fine garments.</li> 
                    <li>Each garment is personally inspected and treated for the highest quality.</li>
                    <li>We clean the finest leather and suede.</li>
                    <li>We offer you full storage on all your clothes including a fur vault.</li>
                <br />
                    <p class="large">Corporate</p>
                    <p>All Coporate Events from Catering and Uniforms to Large Sports Events</p>
                    <li>Dry Cleaning service for staff and buildings</li>
                    <li>Work directly with property management companies and property mangers</li>
                    <li>Laundry and dry cleaning service for corporate events and special events</li>
                    <li>Executive Wash & Fold service for nursery schools, Hedge funds, Executive gyms and corporate companies.</li>
                </ul>
                </p>
            </div>
            <div class="col-md-5 col-sm-5 text-center">
                <img src="{{url('/')}}/public/img/areas.png" alt="" class="img-responsive" />
            </div>
        </div>
    </div>
</section>

<!-- ========================== -->
<!-- HOME - ACHIEVEMENTS -->
<!-- ========================== -->
<!--    <section class="achievements-section with-bottom-effect dark dark-strong">
    <div class="bottom-effect"></div>
    <div class="container dark-content">
        <div class="row list-achieve">
            <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="0.5s">
                <article>
                    <div class="achieve-item">
                        <div class="achieve-icon">
                            <span class="icon icon-Tie"></span>
                        </div>
                        <div class="count">25561</div>
                        <div class="name">Dry Cleaning Delivered</div>
                    </div>
                </article>
            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="2.5s">
                <article>
                    <div class="achieve-item">
                        <div class="achieve-icon">
                            <span class="icon icon-Like"></span>
                        </div>
                        <div class="count">10160</div>
                        <div class="name">Happy Clients</div>
                    </div>
                </article>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="3.5s">
                <article>
                    <div class="achieve-item">
                        <div class="achieve-icon">
                            <span class="icon icon-Users"></span>
                        </div>
                        <div class="count">20</div>
                        <div class="name">Neighborhoods Serviced</div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>-->

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
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img1.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img2.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img3.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img4.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img5.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img6.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img7.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img8.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img9.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img10.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img11.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img12.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img13.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img14.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img15.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>
            <div class="scroll-content-item  ">
                <img src="{{url('/')}}/public/img/img16.jpg" alt="" />
                <div class="scroll-content-body">
                    <div class="name"></div> 
                </div>
            </div>

        </div>
        <div class="scroll-bar-wrap ">
            <div class="scroll-bar"></div>
        </div>
    </div>
</section>


<!-- ========================== -->
<!-- HOME - STEPS  -->
<!-- ========================== -->
<section class="steps-section with-icon ">
    <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
    <div class="container">
        <div class="section-heading">
            <div class="section-title">Simple Steps . Quick Results</div>
            <div class="section-subtitle">We make it easy, so you don't have to worry!</div>
            <div class="design-arrow"></div>
        </div>
    </div>
    <div class="container">
        <div class="row steps-list">
            <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" >
                <div class="step-item">
                    <div class="item-icon" data-count="1">
                        <span class="icon icon-Pencil"></span>
                    </div>
                    <div class="item-text">
                        <h5>Place Your <br />
                             Order .
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="step-item invert">
                    <div class="item-icon" data-count="2">
                        <span class="icon icon-Heart"></span>
                    </div>
                    <div class="item-text">
                        <h5>We Pick-Up  <br />&amp; 
                            Clean .
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" data-wow-delay="0.6s">
                <div class="step-item">
                    <div class="item-icon" data-count="3">
                        <span class="icon icon-Plaine"></span>
                    </div>
                    <div class="item-text">
                        <h5>We Return <br />
                            &amp; Deliver .
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================== -->
<!-- HOME - VIDEO SECTION -->
<!-- ========================== -->

<section class="video-section with-bottom-effect dark dark-strong">
    <div class="video-play" id="video-play" data-property="{videoURL:'https://www.youtube.com/watch?v=un0cZhW-6jQ',containment:'#video-play',autoPlay:true, mute:true, startAt:0, opacity:1}"></div>
    <div class="bottom-effect"></div>
    <div class="container dark-content">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="title"></div>
                <em></em>
                <button type="button" class="btn-play"></button>
                <div class="duration"> <span> </span></div>
            </div>
        </div>
    </div>
</section>

<!-- ========================== -->
<!-- REVIEWS SECTION -->
<!-- ========================== -->
<!-- <section class="reviews-section">
    <div class="container">
        <div class="section-heading">
            <div class="section-title">What clients are saying</div>
            <div class="section-subtitle">Just a few Testimonials from Our Clients</div>
            <div class="design-arrow"></div>
        </div>
    </div>
    <div class="container">
        <div class="reviews-slider enable-owl-carousel" data-single-item="true">
            <div class="slide-item">
                <div class="media-left">
                    <div class="image-block">
                        <img src="img/review-img1.jpg" alt="" />
                    </div>
                </div>
                <div class="media-body">
                    <div class="description-block">
                        <div class="name">
                            <span>James H. Ken </span>
                            <em>Trader.</em>
                        </div>
                        <div class="review">
                            <em>U-Rang never fails to deliver. My suits are always impeccable and delivered in a timely manner.</em>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slide-item">
                <div class="media-left">
                    <div class="image-block">
                        <img src="img/review-img2.jpg" alt="" />
                    </div>
                </div>
                <div class="media-body">
                    <div class="description-block">
                        <div class="name">
                            <span>Warren Daniels </span>
                            <em>Lawyer</em>
                        </div>
                        <div class="review">
                            <em>U-Rang, they answer, every single time. They've never not picked up my dry-cleaning or missed a delivery time. I can also count on them for a spotless apartment.</em>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>-->

<!-- ========================== -->
<!-- HOME - BROWSERS  -->
<!-- ========================== -->
<section class="browsers-section with-bottom-effect ">
    <div class="bottom-effect"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{url('/')}}/public/img/browsers-image.png" alt=" " class="img-responsive" />
            </div>
        </div>
    </div>
</section>

<!-- ========================== -->
<!-- HOME - SERVICES  -->
<!-- ========================== -->
<section class="services-section ">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-WorldGlobe"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Eco-Freindly</h5>
                        <p><em>best solutions that works</em></p>
                        <p>Environmentally conscious about what chemicals are used for our customers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-Tablet"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Web & Mobile Based</h5>
                        <p><em>Moving Forward.</em></p>
                        <p>Our site is designed mobile first, so you can browse from any device, phone, tablet or desktop.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-Phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Amazing Service</h5>
                        <p><em>Direct Line to Owner</em></p>
                        <p>Direct Owner Mobile Number – #1 priority, for our clients.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="services-divider">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-Heart"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Philanthropic</h5>
                        <p><em>Give back to your Community</em></p>
                        <p>Donate to the school of your choice in your very own community.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-Bag"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Affordable Pricing</h5>
                        <p><em>Honest and Transparent</em></p>
                        <p>Affordable services with fair prices without mark-ups.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="service-item">
                    <div class="media-left">
                        <div class="wrap-service-icon">
                            <div class="service-icon">
                                <span class="icon icon-DesktopMonitor"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h5>Corporate</h5>
                        <p><em>Putting your Best Foot Forward.</em></p>
                        <p>We've worked in Corporate America as-well. Looking good and feeling good is the first step in winning

business.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection