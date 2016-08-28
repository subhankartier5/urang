<header class="header scrolling-header">
  <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container relative-nav-container">
      <a class="toggle-button visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-navicon"></i>
      </a>
      <a class="navbar-brand scroll" href="{{route('index')}}">
          <img class="normal-logo hidden-xs" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" style="height: 51px; width: 132px; margin-left: -40px;" />
          <img class="scroll-logo hidden-xs" src="{{url('/')}}/public/new/img/logo.png" alt="logo" />
          <img class="scroll-logo visible-xs-block" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" />
      </a>

      
      <div class="navbar-collapse collapse floated" id="navbar-collapse" style="margin-left: 115px;">
          <ul class="nav navbar-nav navbar-with-inside clearfix navbar-right with-border"> 
              <li class="active">
                  @if(auth()->guard('users')->user() == null)
                    <a href="{{route('index')}}">Home</a>
                  @else
                    <a href="{{route('getCustomerDahsboard')}}">Home</a>
                  @endif
              </li>
              <li><a href="{{route('getPrices')}}">Prices</a></li>
              <li>
                  <a href="{{route('getFaqList')}}">FAQs</a>
              </li>
              <li>
                <a href="{{route('getNeiborhoodPage')}}"> Neighborhoods <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                <ul>
                <div style="display:none;">{{$navber_data = (new \App\Helper\NavBarHelper)->getNeighborhood()}}</div>
                  @foreach($navber_data as $hood)
                    <li> <a href="{{route('getStandAloneNeighbor', $hood->url_slug)}}" target="_blank">{{$hood->name}}</a></li>
                  @endforeach
                  
                </ul>
              </li>
              <li>
                  <a href="{{route('getSchoolDonations')}}">School Donations</a>
                  
              </li>
              <li>
                <a href="{{route('getServices')}}">Services <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                <ul style="width: 160%">
                  <li class="dryclean"><a target="_blank" href="{{route('getStandAloneService', 'dry-clean')}}">DRY CLEAN ONLY</a></li>
                  <li class="washnfold"><a target="_blank" href="{{route('getStandAloneService', 'washNfold')}}">WASH & FOLD</a></li>
                  <li><a target="_blank" href="{{route('getStandAloneService', 'corporate')}}">CORPOARTE</a></li>
                  <li><a target="_blank" href="{{route('getStandAloneService', 'tailoring')}}">TAILORING</a></li>
                  <li><a target="_blank" href="{{route('getStandAloneService', 'wet-cleaning')}}">WET CLEANING</a></li>
                </ul>
              </li>
              <li>
                 <a href="{{ route('getContactUs') }}">Contact</a>
             </li>
             <li>
                  @if(auth()->guard('users')->user() != null)
                     <a href="{{route('getLogout')}}">Logout</a>
                  @else
                       <a href="{{route('getLogin')}}">Login</a>
                  @endif
              </li>
              <li>
                  @if(auth()->guard('users')->user() == null)
                     <a href="{{route('getSignUp')}}">Sign-Up</a>
                  @else
                  @endif
              </li>
              <li>
                <a href="{{route('getComplaints')}}">Complaints</a>
              </li>
          </ul>
      </div>
    </div>
  </nav>
</header><!--./navigation -->

