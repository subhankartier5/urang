@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
           <!-- ========================== -->
        <!-- SERVICES - HEADER -->
        <!-- ========================== -->
        <section class="top-header school-donation-header with-bottom-effect transparent-effect dark">
            <div class="bottom-effect"></div>
            <div class="header-container wow fadeInUp"> 
                <div class="header-title">
                    <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
                    <div class="title">School Donations</div>
                    <em>Let's make future clean along with your cloths....</em>
                </div>
            </div><!--container-->
        </section>  
 

        
        <!-- ========================== -->
        <!-- ABOUT - HISTORY -->
        <!-- ========================== -->
        <section class="history-section">
            <div class="container">
                <div class="section-heading">
                    <div class="section-title">Let's bring the smile and make the difference....</div>
                    <div class="section-subtitle">Let's bring a smarter world with just some simple clicks...</div>
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
                    	@if(count($list_school) == 0)
                    		<div class="alert alert-danger">School List has not yet been set up by the admin.</div>
                    	@else
                    		@for($i=0; $i< count($list_school); $i++)
                    			@if($i%2 == 0)
                    				<div class="row left-row">
			                            <div class="round-ico little"></div>
			                            <div class="col-md-6 col-sm-6 time-item wow fadeInUp" data-wow-duration="2s" >
			                                <div class="dateLeft">{{$list_school[$i]->neighborhood->name}}</div>
			                                <div class="title">{{$list_school[$i]->school_name}}</div>
			                                <div class="time-image">
			                                    <img src="{{url('/')}}/public/dump_images/{{$list_school[$i]->image}}" alt="School Image" />
			                                </div>
			                                <p>Total Money Donated till date: ${{number_format((float)$list_school[$i]->total_money_gained, 2, '.', '')}}</p>
			                                 <p>Total pending till date: ${{number_format((float)$list_school[$i]->pending_money, 2, '.', '')}} </p>
			                            </div>
			                        </div>
                    			@else
                    				<div class="row right-row">
			                            <div class="round-ico big"></div>
			                            <div class="col-md-6 col-sm-6"></div>
			                            <div class="col-md-6 col-sm-6 time-item wow fadeInUp" data-wow-duration="2s" >
			                                <div class="dateRight">{{$list_school[$i]->neighborhood->name}}</div>
			                                <div class="title">{{$list_school[$i]->school_name}}</div>
			                                <div class="time-image">
			                                    <img src="{{url('/')}}/public/dump_images/{{$list_school[$i]->image}}" alt="School Image" />
			                                </div>
			                                <p>Total Money Donated till date: ${{number_format((float)$list_school[$i]->total_money_gained, 2, '.', '')}}</p>
			                                 <p>Total pending till date: ${{number_format((float)$list_school[$i]->pending_money, 2, '.', '')}} </p>
			                            </div>
			                        </div>
                    			@endif
                    		@endfor
                    	@endif
                    <div class="plus">
                        <a href="{{route('getSignUp')}}" class="plus-ico">+</a>
                    </div>
                </div>
            </div>
        </section>
@endsection