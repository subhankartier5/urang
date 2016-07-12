<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">Welcome , {{$user_data->username}}</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('get-admin-profile')}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="{{ route('get-admin-settings') }}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('get-admin-logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route('get-admin-dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                     <a href="{{route('getAllCustomers')}}"><i class="fa fa-list" aria-hidden="true"></i> Customer Lists</a>
                </li>
                <li>
                    <a href="{{route('getCustomerOrders')}}"><i class="fa fa-group" aria-hidden="true"></i> Customer Orders</a>
                </li>
                <li>
                    <a href="{{ route('getPriceList') }}"><i class="fa fa-edit fa-fw"></i> Price List</a>
                </li>
                <li>
                    <a href="{{ route('get-neighborhood') }}"><i class="fa fa-map-marker" aria-hidden="true"></i> Neighborhood</a>
                </li>
                <li>
                    <a href="{{route('getFaq')}}"<i class="fa fa-question-circle" aria-hidden="true"></i> Faq Management</a>
                </li>
                <li>
                    <a href="{{route('getStaffList')}}"><i class="fa fa-user fa-fw"></i> Staffs Management</a>
                </li>
                <li>
                     <a href="{{route('getPayment')}}"><i class="fa fa-credit-card fa-fw"></i> Make Payments</a>
                </li>
               <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Cms<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('getCmsDryClean')}}">Dry Clean Page</a>
                        </li>
                        <li>
                            <a href="{{route('getCmsWashNFold')}}">Wash and Fold Page</a>
                        </li>
                        <li>
                            <a href="{{route('getCorporate')}}">Corporate Page</a>
                        </li>
                        <li>
                            <a href="{{route('getTailoring')}}">Tailoring Page</a>
                        </li>
                        <li>
                            <a href="#">Wet Cleaning Page</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>