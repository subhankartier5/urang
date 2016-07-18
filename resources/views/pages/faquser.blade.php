@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
           <!-- ========================== -->
        <!-- SERVICES - HEADER -->
        <!-- ========================== -->
        <section class="top-header qanda-header with-bottom-effect transparent-effect dark">
            <div class="bottom-effect"></div>
            <div class="header-container wow fadeInUp"> 
                <div class="header-title">
                    <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
                    <div class="title">our Q & A</div>
                    <em>Basic questions answered...</em>
                </div>
            </div><!--container-->
        </section>  
 

        
        <!-- ========================== -->
        <!-- ABOUT - HISTORY -->
        <!-- ========================== -->
        <section class="history-section">
            <div class="container">
                <div class="section-heading">
                    <div class="section-title">How U-RANG Delivery Service Works...</div>
                    <div class="section-subtitle">The box field that is on the home page EASY AS 1.2.3.....</div>
                    <div class="design-arrow"></div>
                </div>
            </div>

            <div class="wrap-timeline">
                <div class="container">
                    <div class="row top-row">
                        <div class="col-md-12">
                            <div class="time-title" id="timel"> <br />
                                <div class="round-ico"><span class="icon icon-Flag"></span></div>
                            </div>
                        </div>
                    </div>
                    @if(count($faq) > 0)
                      @for ($i=0; $i < count($faq) ; $i++)
                        @if ($i%2 == 0) 
                          <div class="row left-row">
                            <div class="round-ico little"></div>
                            <div class="col-md-6 col-sm-6 time-item wow fadeInUp" data-wow-duration="2s" >
                                <div class="date">Q & A</div>
                                <div class="title">{{$faq[$i]->question}}</div>
                                <div class="time-image">
                                    <img src="{{url('/')}}/public/dump_images/{{$faq[$i]->image}}" alt="" />
                                </div>
                                <p>{!!$faq[$i]->answer!!} </p>
                            </div>
                        </div>
                        @else
                          <div class="row right-row">
                            <div class="round-ico big"></div>
                            <div class="col-md-6 col-sm-6"></div>
                            <div class="col-md-6 col-sm-6 time-item wow fadeInUp" data-wow-duration="2s" >
                                <div class="date">Q & A</div>
                                <div class="title">{{$faq[$i]->question}}</div>
                                <div class="time-image">
                                    <img src="{{url('/')}}/public/dump_images/{{$faq[$i]->image}}" alt="" />
                                </div>
                                <p>{!!$faq[$i]->answer!!}</p>
                            </div>
                        </div>
                        @endif
                      @endfor
                    @else
                      No Q & A
                    @endif
                    <div class="plus">
                        <a href="{{route('getSignUp')}}" class="plus-ico">+</a>
                    </div>
                </div>
            </div>
        </section>
@endsection