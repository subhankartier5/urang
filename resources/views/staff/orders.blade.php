@extends('staff.layouts.master')
@section('content')
<div id="wrapper" class="col-md-12 orders">
   <div id="page-wrapper">
      <div class="col-md-12">
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
            @if(Session::has('error_code'))
              <div class="alert alert-danger">
              <?php
              //0->no payment keys, 1->null response check date format or card details , check card details error in card number or amount null
                switch (Session::get('error_code')) {
                  case '0':
                      echo "Payment failed, Hint: Please set the payment keys and mode!";
                    break;
                  case '1':
                      echo "Payment Failed, Wrong Details. Hint : Plase make sure amount is more than 0 or wrong credit card number or keys are wrong!";
                    break;
                    case '2':
                      echo "Payment Failed, Wrong Details. Hint : Plase make sure amount is more than 0 or wrong credit card number or keys are wrong!";
                    break;
                  default:
                    echo "Unknown error occured!";
                    break;
                }
              ?>
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
            @endif
            {{ Session::forget('fail') }}
            {{ Session::forget('success') }}
            {{Session::forget('error_code')}}
            <?php
               $price_list = \App\PriceList::all();
               ?>
            <div>
               <div class="col-md-12">
                  <img src="{{url('/')}}/public/images/red.png" style="height: 10px; width: 10px;" alt="unpaid_red_logo"> <span style="color: red;">Unpaid Orders</span> &nbsp
                  <img src="{{url('/')}}/public/images/green.jpg" style="height: 10px; width: 10px;" alt="unpaid_red_logo"> <span style="color: green;">Paid Orders</span> &nbsp
                  <img src="{{url('/')}}/public/images/yellow.png" style="height: 10px; width: 10px;" alt="unpaid_red_logo"> <span style="color: #999900;">Emergency Orders</span>
               </div>
               <div class="top-bar">
                  <div class="row">
                     <div class="col-md-4">
                        <h2>Pickup Request Table</h2>
                     </div>
                     <div class="col-md-7">
                        <div class="row">
                           <form action="{{ route('sort') }}" method="get">
                              <div class="col-md-6">
                                 <select name="sort" class="form-control">
                                    <option value="">Sort By</option>
                                    <option value="pick_up_date">Pickup Date</option>
                                    <option value="created_at">Order Date</option>
                                    <option value="total_price">Price</option>
                                    <option value="is_Emergency">Emergency</option>
                                    <option value="paid">Paid Pick ups</option>
                                    <option value="unpaid">Unpaid Pick ups</option>
                                    <option value="delivered">Delivered Orders</option>
                                 </select>
                              </div>
                              <div class="col-md-6">
                                 <button type="submit" class="btn btn-default">Sort</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- <div class="col-md-1">
                        <div id="wrap">
                           <form action="{{ route('getSearch') }}" method="get">
                              <input id="search" name="search" type="text" placeholder="Search by order id"><input id="search_submit" value="Rechercher" type="submit" required="true">
                           </form>
                        </div>
                     </div> -->
                  </div>
               </div>
               <div class="col-lg-12">
                <div style="display: none;" id="loaderBodyOrderStaff" align="center">
                <p>Please wait...</p>
                <img src="{{url('/')}}/public/images/loading.gif" style="height: 150px;">
              </div>
              </div>
               <table class="table table-bordered table-responsive">
                  <thead>
                     <tr>
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
                        <th></th>
                        <th></th>
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
                     <tr id="color_{{$pickup->id}}">
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
                        <form id="change_status_form_staff">
                           <td>${{number_format((float)$pickup->total_price, 2, '.', '')}}</td>
                           <td>
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $pickup->id }}"><i class="fa fa-info" aria-hidden="true"></i></button>
                              <!-- <button type="button" id="infoButton" data-target="#yyy" class="btn btn-info"><i class="fa fa-info" aria-hidden="true"></i></button> -->
                           </td>
                           <td>
                            <select name="order_status" class="form-control" id="order_status_staff_{{$pickup->id}}">
                                @if($pickup->order_status == 1)
                                  <option value="1" selected="true" disabled="true">Order Placed</option>
                                  <option value="2">Picked Up</option>
                                  <option value="3">Processed</option>
                                  <option value="4">Delivered</option>
                                @elseif($pickup->order_status == 2)
                                  <option value="2" selected="true" disabled="true">Picked Up</option>
                                  <option value="3">Processed</option>
                                  <option value="4">Delivered</option>
                                @elseif($pickup->order_status == 3)
                                  <option value="3" selected="true" disabled="true">Processed</option>
                                  <option value="4">Delivered</option>
                                @else
                                  @if($pickup->payment_status == 1)
                                      <option value="4" selected="true" disabled="true">Delivered</option>
                                  @else
                                      <option value="4" selected="true">Delivered</option>
                                  @endif
                                @endif
                            </select>  
                           </td>
                           <td>
                              <input type="hidden" name="pickup_id" value="{{ $pickup->id }}" id="pickup_id_{{$pickup->id}}">
                              <input type="hidden" name="_token" value="{{ Session::token() }}">
                              <input type="hidden" name="chargable" id
                                 ="chargable_{{$pickup->id}}" value="{{number_format((float)$pickup->total_price, 2, '.', '')}}"></input>
                              <input type="hidden" name="user_id" value="{{$pickup->user_id}}" id="user_id_{{$pickup->id}}"></input>
                              <input type="hidden" name="payment_type" value="{{ $pickup->payment_type }}" id="payment_type_{{$pickup->id}}"></input>
                              <button type="button" class="btn btn-primary" onclick="AskForInvoice('{{$pickup->id}}', '{{$pickup->user_id}}', '{{count($pickup->invoice)}}');">Apply</button>
                           </td>
                        </form>
                        @if(count($pickup->invoice) > 0)
                        <td><button type="button" class="btn btn-primary btn-xs" id="showInv_{{$pickup->id}}" onclick="showDetails('{{$pickup->id}}')"><i class="fa fa-info-circle" aria-hidden="true"></i> Show Details</button></td>
                        @else
                          @if($pickup->order_status == 4 && $pickup->payment_status == 1)
                              <td>Cannot Recreate Invoice already delivered</td>
                          @else
                            <td><button type="button" class="btn btn-primary btn-xs" id="create_invoice_{{$pickup->id}}" onclick="createInvoice('{{$pickup->id}}', '{{$pickup->user_id}}')"><i class="fa fa-plus" aria-hidden="true"></i> Create Invoice</button></td>
                          @endif
                        @endif
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
            <h4 class="modal-title">Add More..</h4>
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
            @if($pickup->order_status == 4)
              <td><button class="btn btn-default" id="edit_itms" onclick="openEditItemModal({{$pickup->id}},{{$pickup->user->id}})" disabled="true">Edit Items</button></td>
            @else
              <td><button class="btn btn-default" id="edit_itms" onclick="openEditItemModal({{$pickup->id}},{{$pickup->user->id}})">Edit Items</button></td>
            @endif
         </div>
         <div class="modal-footer">
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
                  <!-- <div class="row">
                     <div class="col-md-5 col-sm-5"><strong>User Id</strong></div>
                     <div class="col-md-1 col-sm-1">:</div>
                     <div class="col-md-5 col-sm-5"><span>{{ $pickup->user->id }}</span></div>
                  </div> -->
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
                  <!-- <div class="row">
                     <div class="col-md-5 col-sm-5"><strong>Pickup Id</strong></div>
                     <div class="col-md-1 col-sm-1">:</div>
                     <div class="col-md-5 col-sm-5"><span> {{ $pickup->id }}</span></div>
                  </div> -->
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
         </div>
      </div>
   </div>
</div>
@endforeach
<!-- Modal -->
<div id="ModalShowInvoice" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Invoice Details as per <label id="invoice_date"></label></h4>
         </div>
         <div class="modal-body">
            <div style="float: right;">
               <p>Invoice No:</p>
               <label id="invoice_no"></label>
            </div>
            <div class="form-group">
               <label>User Name:</label>
               <div id="user_name"></div>
            </div>
            <div class="form-group">
               <label>User Email:</label>
               <div id="user_email"></div>
            </div>
            <div class="form-group">
               <label>Pickup Type:</label>
               <div id="pickup_type"></div>
            </div>
            <div class="form-group">
               <label>Total Price:</label>
               <div id="total_price"></div>
            </div>
            <div class="form-group">
               <label>Take Action:</label>
               <button type="button" class="btn btn-danger btn-xs dynamicBtn"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
            </div>
            <label>See Breakdown:</label>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <td>Item</td>
                     <td>Quantity</td>
                     <td>Price</td>
                  </tr>
               </thead>
               <tbody id="inv">
               </tbody>
            </table>
         </div>
         <div class="modal-footer">
            <input type="hidden" id="pick_up_req_id_alter" name="pick_up_req_id_alter"></input>
            <input type="hidden" id="user_id" name="user_id"></input>
            <button type="button" class="btn btn-default" id="show_modal_items">Edit Items</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div id="EditItemModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2>Select items you want</h2>
         </div>
         <div class="modal-body">
            <table class = "table table-striped">
               <thead>
                  <tr>
                     <th>No of Items</th>
                     <th>Item Name</th>
                     <th>Item Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($price_list) > 0)
                  @foreach($price_list as $list)
                  <tr>
                     <td>
                        <select name="number_of_item" id="number_{{$list->id}}">
                           @for($i=0; $i<=10; $i++)
                           <option value="{{$i}}">{{$i}}</option>
                           @endfor
                        </select>
                     </td>
                     <td id="item_{{$list->id}}">{{$list->item}}</td>
                     <td id="price_{{$list->id}}">{{$list->price}}</td>
                     <td><button type="button" class="btn btn-primary btn-xs" onclick="add_id({{$list->id}})" id="btn_{{$list->id}}">Add</button></td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                     <td>No Data</td>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
         <div class="modal-footer">
            <form action="{{ route('addItemCustom') }}" method="post" id="edit_item_form">
               <input type="hidden" id="row_id" name="row_id">
               <input type="hidden" id="list_items_json" name="list_items_json" required="">
               <input type="hidden" id="row_user_id" name="row_user_id">
               <input type="hidden" name="invoice_updt" id="invoice_update_staff"></input>
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <input type="hidden" id="old_items_selected"></input>
               <button type="button" onclick="sbmitEditForm()" class="btn btn-default" id="modal-close">Save Changes</button>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="ModalInvoice" class="modal fade" role="dialog">
   <!--work-->
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Invoice</h4>
         </div>
         <div class="modal-body">
            <table class = "table table-striped">
               <thead>
                  <tr>
                     <th>No of Items</th>
                     <th>Item Name</th>
                     <th>Item Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <form role="form" method="post" action="{{route('postInvoice')}}">
                     @if(count($price_list) > 0)
                     @foreach($price_list as $list)
                     <tr>
                        <td>
                           <select name="number_of_item" id="number1_{{$list->id}}">
                              @for($i=1; $i<=10; $i++)
                              <option value="{{$i}}">{{$i}}</option>
                              @endfor
                           </select>
                        </td>
                        <td id="item_{{$list->id}}">{{$list->item}}</td>
                        <td id="price_{{$list->id}}">{{$list->price}}</td>
                        <td><button type="button" class="btn btn-primary btn-xs" onclick="add_item({{$list->id}})" id="btn1_{{$list->id}}">Add</button></td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td>No Data</td>
                     </tr>
                     @endif
               </tbody>
            </table>
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_create_inv">Create Invoice</button>
         <input type="hidden" id="pick_up_req_id" name="pick_up_req_id"></input>
         <input type="hidden" id="req_user_id" name="req_user_id"></input>
         <input type="hidden" name="identifier" value="staff"></input>
         <input type="hidden" name="_token" value="{{Session::token()}}"></input>
         <input type="hidden" name="list_item" id="text_field"></input>
         </div>
      </div>
      </form>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
       $('#infoButton').click(function(){
           $('#infoModal').modal('show');
       });
       $('#show_modal_items').click(function(){
          $('#row_id').val($('#pick_up_req_id_alter').val());
          $('#row_user_id').val($('#user_id').val());
          $('#invoice_update_staff').val($('#invoice_no').text());
          openEditItemModal($('#pick_up_req_id_alter').val(), $('#user_id').val());
       });


        //color the tr of table according to condition
        @foreach($pickups as $pickup)
          //console.log('{{$pickup->is_emergency}}');
          if ('{{$pickup->is_emergency}}' == 1 && '{{$pickup->payment_status}}' == 0) 
          {
            $('#color_{{$pickup->id}}').attr('style', 'color: #999900;');
          }
          else if ('{{$pickup->payment_status}}' == 1) 
          {
            $('#color_{{$pickup->id}}').attr('class', 'success');
          }
          else if ('{{$pickup->payment_status}}' == 0)
          {
            $('#color_{{$pickup->id}}').attr('class', 'danger');
          }
          else
          {
            $('#color_{{$pickup->id}}').attr('class', 'active');
          }
        @endforeach
   });
   jsonArray = [];
   
   function add_id(id) {
    if ($('#number_'+id).val() > 0) 
    {
       if ($('#btn_'+id).text() == "Add") 
       {
         $('#btn_'+id).text("Remove");
         $('#number_'+id).prop('disabled', true);
         list_item = {};
         list_item['id'] = id;
         list_item['number_of_item'] = $('#number_'+id).val();
         list_item['item_name'] = $('#item_'+id).text();
         list_item['item_price'] = $('#price_'+id).text();
         jsonArray.push(list_item);
         jsonString = JSON.stringify(jsonArray);
         $('#list_items_json').val(jsonString);
       }
       else
       {
         $('#btn_'+id).text("Add");
         $('#number_'+id).prop('disabled', false);
         for(var j=0; j<= jsonArray.length; j++) {
           if(jsonArray.length == 1)
           {
               jsonArray = [];
               $('#list_items_json').val('');
               return;
           }
           else if(jsonArray[j].id == id)  
           {
             jsonArray.splice(j,j);
           }
         }
         jsonString = JSON.stringify(jsonArray);
         $('#list_items_json').val(jsonString);
       }
    }
    else
    {
       sweetAlert("Oops...", "Please select atleast one item", "error");
    }
   }
   function openEditItemModal(pickup_id,user_id)
   {
    jsonObj = [];
    var setJson= '';
    $.ajax({
     url:"{{route('postPickUpId')}}",
     type: "POST",
     data: {id: pickup_id, _token:"{{Session::token()}}"},
     success: function(data) {
       //console.log(data);
       //return;
       if (data != 0) 
       {
          for (var i = 0; i < data.length; i++) {
            search_item ={};
            search_item['id'] = data[i].list_item_id;
            search_item['number_of_item'] = data[i].quantity;
            search_item['item_name'] = data[i].item;
            search_item['item_price'] = data[i].price;
            //console.log(data[i].quantity);
            jsonObj.push(search_item);
          }
          setJson = JSON.stringify(jsonObj);
          //console.log(setJson);
          if ($.trim(setJson) != '') 
          {
            $('#old_items_selected').val(setJson);
          }
         //console.log(data);
         $('#row_id').val(pickup_id);
         $('#row_user_id').val(user_id);
         $('#invoice_update_staff').val(data[0].invoice_id);
         $('#EditItemModal').modal('show');
       }
       else
       {
         sweetAlert("Oops...", "Some Error occured. Hint: No invoice is related with this pick up req id", "error");
       }
     }
   });
   
   }
   $('#EditItemModal').on('shown.bs.modal',function(e){
      e.preventDefault();
      var data = $.parseJSON($('#old_items_selected').val());
      //console.log(data);
      for (var i = 0; i < data.length; i++) {
        //console.log(data[i]);
        $('#number_'+data[i].id).val(data[i].number_of_item);
        $('#btn_'+data[i].id).text('Remove');
      }
   });
  /* function recreateInv(pick_req_id_inv, user_id_inv) {
   //alert();
   //alert($('#invoice_no').text())
   //return;
   $('#row_id').val(pick_req_id_inv);
   $('#row_user_id').val(user_id_inv);
   //$('#identifier_modal').val(identifier);
   $('#invoice_updt').val($('#invoice_no').text());
   $('#EditItemModal').modal('show');
   }*/
   function sbmitEditForm()
   {
   
   if($('#list_items_json').val() != '')
   {
       $('#edit_item_form').submit();
   }
   else
   {
       sweetAlert("Oops...", "You have to select at least one item", "error");
   }
   }
   var i = 1;
   function createInvoice(pick_up_id, user_id) {
   $('#ModalInvoice').modal('show');
   $('#pick_up_req_id').val(pick_up_id);
   $('#req_user_id').val(user_id);
   }
   function add_item(id) {
   arrItems = [];
   if($('#btn1_'+id).text()=='Add')
   {
     var str=$('#text_field').val();
     var quan=$('#number1_'+id).val();
     var Itemname=$('#item_'+id).text();
     var Price=$('#price_'+id).text();
     if(str!='')
     {
       arrItems.push(str+','+id+'^%'+quan+'^%'+Itemname+'^%'+Price);
     }
     else
     {
       arrItems.push(id+'^%'+quan+'^%'+Itemname+'^%'+Price);
     }
     $('#btn1_'+id).text('Remove');
     
     $('#text_field').val(arrItems);
     $('#number1_'+id).prop('disabled', true);
   }
   else
   {
     var quan=$('#number1_'+id).val();
     var Itemname=$('#item_'+id).text();
     var Price=$('#price_'+id).text();
     var replace_string=id+'^%'+quan+'^%'+Itemname+'^%'+Price;
     var str=$('#text_field').val();
     var myString= $('#text_field').val();
     myString = myString.replace(replace_string,',');
     $('#text_field').val(myString);
     $('#btn1_'+id).text('Add');
     $('#number1_'+id).prop('disabled', false);
   }
    
   }
   $(document).ready(function(){
   $('#submit_inv').click(function(){
       $('#loop_limit').val(i);
   });
   });
   function showDetails(id) {
       var div = "";
       var total_price = 0;
       $('#ModalShowInvoice').modal('show');
           @foreach ($pickups as $pickup)
            if ('{{$pickup->id}}' == id) 
            {
              $('#user_name').text('{{$pickup->user_detail->name}}');
              $('#user_email').text('{{$pickup->user->email}}');
              $('#pickup_type').text('{{$pickup->pick_up_type == 1 ? "Fast Pickup" : "Detailed Pickup"}}');
              if ('{{$pickup->order_status}}' == 4) 
              {
                $('#show_modal_items').attr('disabled', 'true');
              }
              else
              {
                $('#show_modal_items').removeAttr('disabled');
              }
              @foreach($pickup->invoice as $invoice)
                 if ('{{$invoice->pick_up_req_id}}' == id) 
                 {
                     $('#invoice_no').text('{{$invoice->invoice_id}}');
                     $('#invoice_date').text('{{date("F jS Y",strtotime($invoice->created_at->toDateString()))}}')
                     div += "<tr><td>{{$invoice->item}}</td><td>{{$invoice->quantity}}</td><td>{{number_format((float)$invoice->price, 2, '.', '')}}</td></tr>";
                     total_price += parseFloat("{{$invoice->quantity*$invoice->price}}");
                     $('#total_price').text(total_price);
                     $('#inv').html(div);
                     //$('.dynamicBtn').attr('id', 'delBtn_{{$invoice->invoice_id}}');
                     $('#pick_up_req_id_alter').val('{{$invoice->pick_up_req_id}}');
                     $('#user_id').val('{{$invoice->user_id}}');
                     $('.dynamicBtn').attr('onclick', 'delInvoice({{$invoice->invoice_id}})');
                 }
             @endforeach
            }
           @endforeach
     }
     function delInvoice(id) {
       //alert(id);
       $.ajax({
           url: "{{route('postDeleteInvoice')}}",
           type: "POST",
           data: {invoice_id: id, _token: "{{Session::token()}}"},
           success: function(data) {
               if (data == 1) 
               {
                   location.reload();
               }
               else
               {
                   sweetAlert("Oops...", "Could Not delete this invoice", "error");
               }
           }
       });
     }
     function submitMyForm(idpickup) {
      //console.log(idpickup);
      var selectvalue = $('#order_status_staff_'+idpickup).val();
      var pickupid = $('#pickup_id_'+idpickup).val();
      var userid = $('#user_id_'+idpickup).val();
      var paymenttype = $('#payment_type_'+idpickup).val();
      var chargable = $('#chargable_'+idpickup).val();
      /*console.log(selectvalue);
      console.log(pickupid);
      console.log(userid);
      console.log(paymenttype);
      console.log(chargable);
      return;*/
      $('#loaderBodyOrderStaff').show();
      $('.table').hide();
      if ($.trim(selectvalue)) 
      {
        $.ajax({
          url: "{{ route('changeOrderStatus') }}",
          type: "POST",
          data: {order_status:selectvalue, payment_type: paymenttype, pickup_id: pickupid, user_id: userid, chargable:chargable, _token: "{{Session::token()}}"  },
          success: function(data) {
            /*console.log(data);
            return;*/
            if (data == 1) 
            {
              swal({
                  title: "Successful!",   
                  text: "Order status successfully updated!",   
                  type: "success",   
                  confirmButtonColor: "#8CD4F5",   
                  confirmButtonText: "Ok"
                  }, function(){
                    location.reload();
                  }               
                );
            }
            else if (data == 0) 
            {
              $('#loaderBodyOrderStaff').hide();
              $('.table').show();
              sweetAlert("Oops...", "Failed to update order status!", "error");
            }
            else if (data == "I00001") 
            {
              swal({
                  title: "Successful!",   
                  text: "Order status successfully updated and paid also!",   
                  type: "success",   
                  confirmButtonColor: "#8CD4F5",   
                  confirmButtonText: "Ok"
                  }, function(){
                    location.reload();
                  }               
                );
            }
            else if (data == "403") 
            {
              $('#loaderBodyOrderStaff').hide();
              $('.table').show();
              sweetAlert("Oops...", "At first make sure payment is done!", "error");
            }
            else if (data == "444") 
            {
              $('#loaderBodyOrderStaff').hide();
              $('.table').show();
              sweetAlert("Oops...", "select atleast one item from dropdown!", "error");
            }
            else
            {
              switch (data) {
                  case '0':
                      $('#loaderBodyOrderStaff').hide();
                      $('.table').show();
                      sweetAlert("Oops...", "Payment failed, Hint: Please set the payment keys and mode!", "error");
                    break;
                  case '1':
                      $('#loaderBodyOrderStaff').hide();
                      $('.table').show();
                      sweetAlert("Oops...", "Payment Failed, Wrong Details. Hint : Plase make sure amount is more than 0 or wrong credit card number or keys are wrong!", "error");
                    break;
                    case '2':
                      $('#loaderBodyOrderStaff').hide();
                      $('.table').show();
                      sweetAlert("Oops...", "Payment Failed, Wrong Details. Hint : Plase make sure amount is more than 0 or wrong credit card number or keys are wrong!", "error");
                    break;
                  default:
                    $('#loaderBodyOrderStaff').hide();
                    $('.table').show();
                    sweetAlert("Oops...", "Unknown error occured!", "error")
                    break;
                }
            }
          }
        });
      }
      else
      {
        $('#loaderBodyOrderStaff').hide();
        $('.table').show();
        sweetAlert("Oops...", "You have to select at least one item", "error");
      }
   }
     function AskForInvoice(pick_up_id2, user_id2, count1) {
      var invoice_id_updt= 0;
      if ($('#order_status_staff_'+pick_up_id2).val() == 4) 
      {
        swal({   
          title: "Are you sure?",   
          text: "You Don't Want to Update the Invoice?",   
          type: "warning",   
          showCancelButton: true, 
          cancelButtonText: "Yes, Update Invoice",  
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "No, Let's Deliver",   
          closeOnConfirm: true }, 
          function(isConfirm){
            if (isConfirm) 
            {
              submitMyForm(pick_up_id2);
            } else {
              if (count1 > 0) {
                //open edit invoice
                $('#row_id').val(pick_up_id2);
                $('#row_user_id').val(user_id2);
                @foreach($pickups as $pickup)
                  @foreach($pickup->invoice as $inv)
                    if ('{{$inv->pick_up_req_id}}' == pick_up_id2) 
                    {
                      invoice_id_updt = '{{$inv->invoice_id}}';
                    }
                  @endforeach
                @endforeach
                //console.log(invoice_id_updt);
                $('#invoice_update_staff').val(invoice_id_updt);
                //$('#EditItemModal').modal('show');
                openEditItemModal(pick_up_id2, user_id2);
              } else {
                //open create invoice
                $('#ModalInvoice').modal('show');
                $('#pick_up_req_id').val(pick_up_id2);
                $('#req_user_id').val(user_id2);
              }
              
            }
          
            //$('#change_status_form_staff').submit();
        });
      } else {
        submitMyForm(pick_up_id2);
      }
  }
</script>
@endsection