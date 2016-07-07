@extends('staff.layouts.master')

@section('title')
	U-rang|Orders
@endsection

@section('content')


    <div id="wrapper">
	
    	<div id="page-wrapper">

            <div class="container-fluid">


            <div class="row">

                <div class="col-lg-12">

                <div class="row">
                <div class="col-md-6">
                    <h2>Pickup Request Table</h2>
                </div>
                <div class="col-md-6">
                    <div id="wrap">
                    <form>
                        <input id="search" name="search" type="text" placeholder="Search by order id"><input id="search_submit" value="Rechercher" type="submit">
                    </form>
                      
                    </div>
                </div>
                    
                </div>            
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Order Id</th>
                            <th>Created At</th>
                            <th>Updated At</th>
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
                            <td>{{ date("F jS Y",strtotime($pickup->updated_at->toDateString())) }}</td>
                            <td>{{ $pickup->user->email }}</td>
                            <td>{{ $pickup->address }}</td>
                            @if($pick_up_type == "Detailed Pickup")
                            <td>{{ $pick_up_type }} <button class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-info" aria-hidden="true"></i></button></td>
                            @else
                            <td>{{ $pick_up_type }}</td>
                            @endif
                            <td>{{ $order_status }}</td>
                            <td>{{ $is_emargency }}</td>
                            <td>{{ $payment_type }}</td>
                            <td>{{ $pickup->client_type }} </td>
                            <td>$50</td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $pickup->id }}"><i class="fa fa-info" aria-hidden="true"></i></button>
                                <!-- <button type="button" id="infoButton" data-target="#yyy" class="btn btn-info"><i class="fa fa-info" aria-hidden="true"></i></button> -->
                            </td>
                            <td>                              
                                 <select class="form-control">
                                  <option value="picked_up">Picked Up</option>
                                  <option value="processed">Processed</option>
                                  <option value="delivered">Delivered</option>
                                </select>
                                
                                 
                            </td>
                            <td>
                                <button class="btn btn-primary">Apply</button>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    
                </div>
                
            </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

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

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
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
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                  </tr>
                  <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                  </tr>
                  <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                  </tr>
                </tbody>
              </table>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#infoButton').click(function(){
            $('#infoModal').modal('show');
        });

    });
</script>

@endsection