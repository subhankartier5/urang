<header class="header scrolling-header">
  <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container relative-nav-container">
      <a class="toggle-button visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-navicon"></i>
      </a>
      <a class="navbar-brand scroll" href="{{route('index')}}">
          <img class="normal-logo hidden-xs" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" />
          <img class="scroll-logo hidden-xs" src="{{url('/')}}/public/new/img/logo.png" alt="logo" />
          <img class="scroll-logo visible-xs-block" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" />
      </a>

      
      <div class="navbar-collapse collapse floated" id="navbar-collapse">
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
                    <li> <a href="{{route('getNeiborhoodPage')}}">{{$hood->name}}</a></li>
                  @endforeach
                  
                </ul>
              </li>
              <li>
                  <a href="{{route('getSchoolDonations')}}">School Donations</a>
                  
              </li>
              <li>
                <a href="#">Services <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                <ul style="width: 160%">
                  <li><a href="{{route('getDryClean')}}">DRY CLEAN ONLY</a></li>
                  <li><a href="{{route('getWashNFold')}}">WASH & FOLD</a></li>
                  <li><a href="">CORPOARTE</a></li>
                  <li><a href="">TAILORING</a></li>
                  <li><a href="">WET CLEANING</a></li>
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
          </ul>
      </div>
    </div>
  </nav>
</header><!--./navigation -->