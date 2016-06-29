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
                  <a href="{{route('index')}}">Home</a>
              </li>
              <li>
                  <a href="{{route('getLogin')}}">Login</a>
              </li>
              <li>
                  <a href="#">Sign-Up</a>
              </li>
              <li><a href="#">Prices</a></li>
              <li>
                  <a href="#">FAQs</a>
              </li>
              <li>
                <a href=""> Neighborhoods <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                <ul>
                  @foreach($neighborhood as $hood)
                    <li> <a href="{{route('getNeiborhoodPage')}}">{{$hood->name}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li>
                  <a href="#">School Donations</a>
                  
              </li>
              <li>
                 <a href="#">Contact</a>
             </li>
             <li>
                 <a href="tel:8009595785">(800) 959-5785</a>
             </li>
          </ul>
      </div>
    </div>
  </nav>
</header><!--./navigation -->