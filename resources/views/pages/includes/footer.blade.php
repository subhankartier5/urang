<footer>
   <!-- ========================== -->
   <!-- SECTION -->
   <!-- ========================== -->
   <section class="buy-section with-icon">
      <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-md-offset-1 col-sm-9 wow fadeInLeft">
               <div class="section-text">
                  <div class=" vcenter like">
                     <span class="icon icon-Like"></span> 
                  </div>
                  <div class="buy-text vcenter">
                     <div class="top-text">U-Rang is New York City's #1 Concierge Service</div>
                     <div class="bottom-text">With more than 10+ years in Business, we are the Best.</div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-3  wow fadeInRight">
               <a href="{{route('getSignUp')}}" class="btn btn-info ">Sign-Up Now</a>
            </div>
         </div>
      </div>
   </section>
   <!-- ========================== -->
   <!-- FOOTER - FOOTER -->
   <!-- ========================== -->
   <section class="footer-section">
      <div class="container">
         <div class="row">
            <div class="col-md-3 col-sm-3">
               <h5>about us</h5>
               <p>U-Rang has been servicing the many affluent neigborhoods of New York City for more than 10 years. Our goals are simple, provide the best service while giving back to the community.</p>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>Sitemap</h5>
               <div class="row">
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('index')}}">About Us</a></li>
                        <li><a href="{{route('getLogin')}}">Login</a></li>
                        <li><a href="{{route('getSignUp')}}">Sign-Up</a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('getNeiborhoodPage')}}">Neighborhoods</a></li>
                        <li><a href="{{route('getPrices')}}">Prices</a></li>
                        <li><a href="{{route('getFaqList')}}">FAQ's</a></li>
                        <li><a href="{{ route('getContactUs') }}">Contact us</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>Contact info</h5>
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>15 Broad Street<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New York, NY 10005
                     </p>
                  </li>
                  <li>
                     <p><i class="icon icon-Phone2"></i>(800)959-5785</p>
                  </li>
                  <li>
                     <p><i class="icon icon-Mail"></i><a href="mailto:lisa@u-rang.com">lisa@u-rang.com</a> </p>
                  </li>
               </ul>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>Contact info</h5>
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>355 E 23rd Street<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New York, NY 10010
                     </p>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <section class="copyright-section">
      <p>©2016 <span>Paper'd Media, Inc.</span>. All Rights Reserved</p>
   </section>
</footer>
<script src="{{url('/')}}/public/new/js/custom.js" type="text/javascript"></script>