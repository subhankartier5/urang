@extends('admin.layouts.master')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                @if(count($customers) > 0)
                                    <div class="huge">{{count($customers)}}</div>
                                @else
                                    <div class="huge">0</div>
                                @endif
                                <div>Customers!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <a class="pull-left" href="{{route('getAllCustomers')}}">View Details</a>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php $j = 0; ?>
                                @foreach($customers as $cus)
                                    @foreach($cus->pickup_req as $pick)
                                        <?php $j += count($pick); ?>
                                    @endforeach
                                @endforeach
                                <div class="huge">{{$j}}</div>
                                <div>Orders!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <a class="pull-left" href="{{route('getCustomerOrders')}}">View Details</a>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php $i = 0; ?>
                                @foreach($customers as $cus)
                                    @foreach($cus->order_details as $order)
                                        <?php $i += count($order); ?>
                                    @endforeach
                                @endforeach
                                <div class="huge">{{$i}}</div>
                                <div>Scheduled Pickup!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <a href="{{route('getCustomerOrders')}}" class="pull-left">View Details</a>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Order Tracking Graph
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div style="height: 400px width:400px">
                            <canvas id="myChart" height="350" width="977"></canvas>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script type="text/javascript">
    var ctx = $("#myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Data"],
            datasets: [{
                label: 'Customers',
                data: ['{{count($customers)}}'],
                backgroundColor: ['rgba(0,0,255,0.6)'],
                borderColor: ['rgba(0,0,255,0.3)'],
                borderWidth: 1
            },
            {
                label: 'Orders',
                data: ['{{$j}}'],
                backgroundColor: ['rgba(92,184,92,1)'],
                borderColor: ['rgba(92, 184, 92, 0.7)'],
                borderWidth: 1
            },
            {
                label: 'Schedule Pickup',
                data: ['{{$i}}'],
                backgroundColor: ['rgba(255, 153, 0, 0.7)'],
                borderColor: ['rgba(255, 153, 0, 1)'],
                borderWidth: 1
            }],
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