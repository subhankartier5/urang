<header class="body fixed-header scrolling-header navbar">
    <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container relative-nav-container">
            <a class="toggle-button visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-navicon"></i>
            </a>
            <a class="navbar-brand scroll" href="{{route('index')}}">
                <img class="normal-logo hidden-xs" src="{{url('/')}}/public/img/logo-white.png" alt="logo" />
                <img class="scroll-logo hidden-xs" src="{{url('/')}}/public/img/logo.png" alt="logo" />
                <img class="scroll-logo visible-xs-block" src="{{url('/')}}/public/img/logo-white.png" alt="logo" />
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
                        <a href="sign-up.html">Sign-Up</a>
                    </li>
                    <li><a href="price-list.html">Prices</a></li>
                    <li>
                        <a href="faqs.html">FAQs</a>
                    </li>
                    <li>
                        <a href="neighborhoods.html">Neighborhoods</a>
                        <!--<div class=" wrap-inside-nav">
                            <div class="inside-col">
                                <ul class="inside-nav">
                                    <li><a href="contact.html">Contacts 1 </a></li>
                                    <li><a href="contact-2.html">Contacts 2 </a></li>
                                </ul>
                            </div>
                        </div>-->
                    </li>
                    <li>
                        <a href="schools.html">School Donations</a>
                        <!--<div class=" wrap-inside-nav">
                            <div class="inside-col">
                                <ul class="inside-nav">
                                    <li><a href="contact.html">Contacts 1 </a></li>
                                    <li><a href="contact-2.html">Contacts 2 </a></li>
                                </ul>
                            </div>
                        </div>-->
                    </li>
                    <li>
                       <a href="contact-us.html">Contact</a>
                   </li>
                   <li>
                       <a href="tel:8009595785">(800) 959-5785</a>
                   </li>
                </ul>
            </div>
        </div>
     </nav>
</header><!--./navigation -->