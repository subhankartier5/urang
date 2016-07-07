<header>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 header-bar">
            <div class="logo">
              <a href="{{route('index')}}">
                <img src="{{url('/')}}/public/images/logo.png" class="img-responsive">
              </a>
            </div>
            <div class="navigation">
              <nav class="navbar navbar-default nav-tabs">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li role="presentation"><a href="{{route('getCustomerDahsboard')}}">Home</a></li>
                      <li role="presentation"><a href="{{route('getPickUpReq')}}">NYC Pick-UP </a></li>
                      <li role="presentation"><a href="#">My Pick-UP </a></li>
                      <li role="presentation"><a href="{{route('getPrices')}}">Prices</a></li>
                      <li role="presentation">
                        
                        <a href="{{route('getNeiborhoodPage')}}"> Neighborhoods <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                        <ul>
                          <div style="display:none;">{{$test = (new \App\Helper\NavBarHelper)->getNeighborhood()}}</div>
                          @foreach($test as $hood)
                            <li> <a href="{{route('getNeiborhoodPage')}}">{{$hood->name}}</a></li>
                          @endforeach
                        </ul>

                      </li>
                      <li role="presentation"><a href="{{route('getFaqList')}}">FAQs</a></li>
                      <li role="presentation"><a href="{{route('getContactUs')}}">Contact</a></li>

                      <li><a href="tel:8009595785">(800) 959-5785</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                      <div style="display: none;">{{$logged_user= (new \App\Helper\NavBarHelper)->getCustomerData()}}</div>
                      <li role="presentation" class="welcome-user"><a href="#">Welcome <span>{{$logged_user->user_details->name}}</span></a>
                        <ul>
                          <li role="presentation"><a href="{{route('get-user-profile')}}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                          <li role="presentation"><a href="{{route('getChangePassword')}}"><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('getLogout')}}"><i class="fa fa-power-off" aria-hidden="true"></i></a></li>
                    </ul>
                
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
            </div>
          </div>
        </div>
    </div>
  </header>