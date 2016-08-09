@extends('staff.layouts.master')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-plus-square-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ count($orders_to_pick_up) }}</div>
                                        <div>New Orders</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('getStaffOrders') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ count($orders_picked_up) }}</div>
                                        <div>Picked Up Orders</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('getStaffOrders') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ count($orders_processed) }}</div>
                                        <div>Processed Orders</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('getStaffOrders') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ count($orders_delivered) }}</div>
                                        <div>Deliverd Orders</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/')}}/staff/sort?sort=delivered">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart">
                                    
                                    <canvas id="myChart" width="400" height="400"></canvas>

                                </div>
                                <div class="text-right">
                                    <a href="{{ route('getStaffOrders') }}">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Delivery Date</th>
                                                <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pickups as $pickup)
                                            <tr style="cursor: pointer;" onclick="trclick('info_modal_{{$pickup->id}}')">
                                                <td>{{$pickup->id}}</td>
                                                <td>{{date("F jS Y",strtotime($pickup->created_at->toDateString()))}}</td>
                                                <td>{{date("F jS Y",strtotime($pickup->pick_up_date))}}</td>
                                                <td>{{number_format((float)$pickup->total_price, 2, '.', '')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <span style="float: right;">{!!$pickups->render()!!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @foreach($pickups as $pickup)
<?php
$order_status = "";
switch ($pickup->order_status) {
    case '1':
        $order_status = "Order Placed";
        break;
    case '2':
        $order_status = "Picked Up";
        break;
    case '3':
        $order_status = "Processed";
        break;
    case '4':
        $order_status = "Delivered";
        break;
    
    default:
        $order_status = "Default";
        break;
}

$is_emargency = $pickup->is_emergency == 1 ? "Yes" : "No";

$payment_type = "";
switch ($pickup->payment_type) {
    case '1':
        $payment_type = "Card";
        break;
    case '2':
        $payment_type = "COD";
        break;
    case '3':
        $payment_type = "Check Payment";
        break;
    
    default:
        $payment_type = "Default";
        break;
}

$door_man = $pickup->door_man == 1 ? "Yes" : "No";

$need_bag = $pickup->need_bag == 1 ? "Yes" : "No";

$wash_n_fold = $pickup->wash_n_fold == 1? "Yes" : "No";

$pick_up_type = $pickup->pick_up_type == 1? "Fast Pickup" : "Detailed Pickup";

?>    
  <div class="modal fade" id="info_modal_{{ $pickup->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Details</h4>
        </div>
        <div class="modal-body">

            <div class="row">
            <div class="col-md-6 col-sm-6 col-sm-offset-3">

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>User Id</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span>{{ $pickup->user->id }}</span></div>    
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Name</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span>{{ $pickup->user_detail->name }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Email</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user->email }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Address</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->address }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Personal Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->personal_ph }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Cell Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->cell_phone }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Office Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->address }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Special Instruction</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->spcl_instructions }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Driving Instruction</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ $pickup->user_detail->driving_instructions }}</span></div>    
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Created At</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ date("F jS Y",strtotime($pickup->user_detail->created_at->toDateString())) }}</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Updated At</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> {{ date("F jS Y",strtotime($pickup->user_detail->updated_at->toDateString())) }}</span></div>    
                </div>
            </div>
            </div>


          
        </div>
        <div class="modal-header" style="border-top: 1px solid #292424;">
          
          <h4 class="modal-title">Pickup Details</h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-offset-3">


            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Id</strong></div> 
            <div class="col-md-1 col-sm-1">:</div> 
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->id }}</span></div>    
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Created At</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ date("F jS Y",strtotime($pickup->created_at->toDateString())) }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Address</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->address }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Date</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->pick_up_date }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Type</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5">{{ $pick_up_type }}</div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Schedule</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->schedule }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Delivary Type</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->delivary_type }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Starch Type</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->starch_type }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Need Bag</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $need_bag }}</span></div>

            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Doorman:</strong></div>    
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $door_man }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Special Instruction:</strong></div>     
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->special_instructions }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Driving Instruction:</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->driving_instructions }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Payment Type</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $payment_type }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Order Status</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $order_status }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Emergency</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $is_emargency }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Clint Type</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $pickup->client_type }}</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Wash and Fold</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ $wash_n_fold }}</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Updated At</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> {{ date("F jS Y",strtotime($pickup->updated_at->toDateString())) }}</span></div>
            </div> 
        
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach 

  <script type="text/javascript">
      $(document).ready(function(){
        /*$('tr').click(function(){
            alert('click');
        });*/

      });
        function trclick(modalid)
        {
            $('#'+modalid).modal('show');
        }
  </script>

    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["New Orders", "Picked Up Orders", "Processed Orders", "Delivered Orders"],
                datasets: [{
                    label: 'Orders',
                    data: ['{{ count($orders_to_pick_up) }}', '{{ count($orders_picked_up) }}', '{{ count($orders_processed) }}', '{{ count($orders_delivered) }}'],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                        
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>

@endsection