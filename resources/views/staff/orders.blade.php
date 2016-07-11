@extends('staff.layouts.master')

@section('title')
	U-rang|Orders
@endsection

@section('content')


    <div id="wrapper">
	
    	<div id="page-wrapper">

            <div class="container-fluid">
            

            <div class="row">


            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}
                <a href="{{ route('getStaffOrders') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @else
            @endif
            @if(Session::has('success'))
              <div class="alert alert-success">{{Session::get('success')}}
                <a href="{{ route('getStaffOrders') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
            @else
            @endif
            {{ Session::forget('fail') }}
            {{ Session::forget('success') }}

                <div class="col-lg-12">

                <div class="row">
                <div class="col-md-3">
                    <h2>Pickup Request Table</h2>
                </div>
                <div class="col-md-4">
                <div class="row">
                <form action="{{ route('sort') }}" method="get">
                    <div class="col-md-5">
                        <select name="sort" class="form-control">
                          <option value="">Sort By</option>
                          <option value="pick_up_date">Pickup Date</option>
                          <option value="created_at">Order Date</option>
                          <option value="total_price">Price</option>
                          <option value="is_Emergency">Emergency</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-default">Sort</button>
                    </div>
                </form>
                </div>
                    
                    
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-1">
                    <div id="wrap">
                    <form action="{{ route('getSearch') }}" method="get">
                        <input id="search" name="search" type="text" placeholder="Search by order id"><input id="search_submit" value="Rechercher" type="submit" required="true">
                    </form>
                      
                    </div>
                </div>
                    
                </div>            
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Order Id</th>
                            <th>Created At</th>
                            <th>Pickup Date</th>
                            <th>Customer Email</th>
                            <th>Pickup Address</th>
                            <th>Pickup Type</th>
                            <th>Order Status</th>
                            <th>Emergency</th>
                            <th>Payment Type</th>
                            <th>Clint Type</th>
                            <th>Total Amount</th>
                            <th>More Info</th>
                            <th>Mark As</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($pickups as $pickup)
                        <?php
                        $pick_up_type = $pickup->pick_up_type == 1? "Fast Pickup" : "Detailed Pickup";

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

                        ?>
                          <tr>
                            <td>{{ $pickup->id }}</td>
                            <td>{{ date("F jS Y",strtotime($pickup->created_at->toDateString())) }}</td>
                            <td>{{ date("F jS Y",strtotime($pickup->pick_up_date)) }}</td>
                            <td>{{ $pickup->user->email }}</td>
                            <td>{{ $pickup->address }}</td>
                            @if($pick_up_type == "Detailed Pickup")
                            <td>{{ $pick_up_type }} <button class="btn btn-default" data-toggle="modal" data-target="#detail_{{ $pickup->id }}"><i class="fa fa-info" aria-hidden="true"></i></button></td>
                            @else
                            <td>{{ $pick_up_type }}</td>
                            @endif
                            <td>{{ $order_status }}</td>
                            <td>{{ $is_emargency }}</td>
                            <td>{{ $payment_type }}</td>
                            <td>{{ $pickup->client_type }} </td>
                            <form action="{{ route('changeOrderStatus') }}" method="post">
                            @if(count($pickup->order_detail)>0)
                            <td>{{number_format((float)$pickup->total_price, 2, '.', '')}}</td>
                            @else
                            <td contenteditable>
                            

                            <input style="width: 70px" type="number" name="total_price" value="{{number_format((float)$pickup->total_price, 2, '.', '')}}" required>
                            </td>
                            @endif
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $pickup->id }}"><i class="fa fa-info" aria-hidden="true"></i></button>
                                <!-- <button type="button" id="infoButton" data-target="#yyy" class="btn btn-info"><i class="fa fa-info" aria-hidden="true"></i></button> -->
                            </td>
                              
                            <td>
                                @if($pickup->order_status == 1)
                                <select name="order_status" class="form-control">
                                  <option value="2">Picked Up</option>
                                  <option value="3">Processed</option>
                                  <option value="4">Delivered</option>
                                </select>
                                @elseif($pickup->order_status == 2)
                                <select name="order_status" class="form-control">
                                  <option value="3">Processed</option>
                                  <option value="4">Delivered</option>
                                </select>
                                @else
                                <select name="order_status" class="form-control">
                                  <option value="4">Delivered</option>
                                </select>
                                @endif    
                            </td>
                            <td>
                                <input type="hidden" name="pickup_id" value="{{ $pickup->id }}">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </td>
                            </form>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>

                      <span style="float: right;">{!!$pickups->render()!!}</span>
                    
                </div>
                
            </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@foreach($pickups as $pickup) 
    @if(count($pickup->order_detail)>0)
                        
    <!-- Modal -->
        <div id="detail_{{ $pickup->id }}" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                
                  <h2>Order Items</h2>
                  
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No Of Items</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($pickup->order_detail as $order)
                      <tr>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->items }}</td>
                        <td>${{ number_format((float)$order->price, 2, '.', '') }}</td>
                      </tr>
                    @endforeach  
                    </tbody>
                  </table>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

    @endif
@endforeach


    <!-- Modal -->
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
  <div class="modal fade" id="{{ $pickup->id }}" role="dialog">
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
        $('#infoButton').click(function(){
            $('#infoModal').modal('show');
        });

    });
</script>

@endsection