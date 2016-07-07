@extends('pages.layouts.user-master')
@section('content')
<div class="main-content">
	<div class="container">
	  <div class="row signup login">
	    <div class="col-md-12">
		    <h2>My Pick-up</h2>
		    <h3>Individual Clients</h3>
		    <p class="reg-heading">Here you will get all the details about your scheduled pick ups.</p>
		    @if(Session::has('fail'))
		      <div class="alert alert-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> {{Session::get('fail')}}
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      </div>
		    @else
		    @endif
		    @if(Session::has('success'))
		      <div class="alert alert-success">                               {{Session::get('success')}}
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      </div>
		    @else
		    @endif
		    <div class = "table-responsive">
			   <table class = "table table-bordered">
			      <thead>
			         <tr>
			            <th>Pick Up ID</th>
			            <th>Issue Date</th>
			            <th>Order Status</th>
			            <th>Item Name</th>
			            <th>Quantity</th>
			            <th>Price(Per Quantiy)</th>
			            <th>Delete</th>
			            <th>Invoice</th>
			         </tr>
			      </thead>
			      <tbody>
		      		@if(count($pick_up_req) > 0)
			      		@foreach($pick_up_req as $req)
			      			<tr>
					            <td>{{$req->id}}</td>
					            <td>{{ date("F jS Y",strtotime($req->created_at->toDateString())) }}</td>
					            <td>
					            	<?php
					            		$order_status = $req->order_status;
					                    switch ($order_status) {
					                      case '1':
					                        echo "Order Placed";
					                        break;
					                      case '2':
					                         echo "Order Picked up";
					                        break;
					                      case '3':
					                         echo "Order Processed";
					                        break;
					                      case '4':
					                         echo "Order Delivered";
					                        break;
					                      default:
					                        echo "Something went wrong error!";
					                        break;
					                    }
					            	?>
					            </td>
				          		@if(count($req->order_detail) > 0)
				          			<td><button class="btn btn-link" type="button" id="btn1_{{$req->id}}" onclick="openModal({{$req->id}})">See Details</button></td>
				          			<td><button class="btn btn-link" type="button" id="btn2_{{$req->id}}" onclick="openModal({{$req->id}})">See Details</button></td>
				          			<td><button class="btn btn-link" type="button" id="btn3_{{$req->id}}" onclick="openModal({{$req->id}})">See Details</button></td>
				          		@else
				          			<td>No Items</td>
				          			<td>0</td>
				          			<td>0.00</td>
				          		@endif
				          		<td><button type="button" id="btn_{{$req->id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
				          		<td>link</td>
			         		</tr>
			      		@endforeach
			      	@else
			      		<tr>
			      			<td><div class="alert alert-warning">NO DATA</div></td>
			      		</tr>
			      	@endif
			      </tbody>
			      
			   </table>
			</div>  
	    </div>
	   </div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">
        <div class = "table-responsive">
			   <table class = "table table-bordered">
			      <thead>
			         <tr>
			            <th>Item Name</th>
			            <th>Qty</th>
			            <th>Price</th>
			         </tr>
			      </thead>
			      <tbody>
      				<tr>
      					<td id="name"></td>
      					<td id="qty"></td>
      					<td id="price"></td>
      				</tr>
			      </tbody>
			      
			   </table>
			</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function openModal(id){
		$("#myModal").modal('show');
		
	}
</script>
@endsection