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
				          			<td><button class="btn btn-link" type="button" id="btn1_{{$req->id}}" onclick="openModal('{{$req->id}}')">See Details</button></td>
				          			<td><button class="btn btn-link" type="button" id="btn2_{{$req->id}}" onclick="openModal('{{$req->id}}')">See Details</button></td>
				          			<td><button class="btn btn-link" type="button" id="btn3_{{$req->id}}" onclick="openModal('{{$req->id}}')">See Details</button></td>
				          		@else
				          			<td>No Items</td>
				          			<td>0</td>
				          			<td>0.00</td>
				          		@endif
				          		<td>
				          			@if($req->order_status == 1)
				          				<button type="button" id="btn_{{$req->id}}" class="btn btn-danger btn-xs" onclick="DeleteOrder('{{$req->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          			@else
				          				<button type="button" id="btn_{{$req->id}}" class="btn btn-danger btn-xs" disabled="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          			@endif
				          		</td>
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
			      <tbody id="order">
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
function openModal(id) {
	$('#myModal').modal('show');
	var div = "";
	@foreach($pick_up_req as $req)
		if ('{{$req->id}}' == id) 
		{
			@foreach($req->order_detail as $order)
				div += '<tr><td>{{$order->items}}</td><td>{{$order->quantity}}</td><td>{{$order->price}}</td></tr>';
				$('#order').html(div);
			@endforeach
		}
	@endforeach
}
function DeleteOrder(id_to_del) {
	$.ajax({
		url: "{{route('postDeletePickup')}}",
		type: "POST",
		data: {id: id_to_del, _token: '{{Session::token()}}'},
		success: function(data) {
			//console.log(data);
			if (data == 1) 
			{
				location.reload();
			}
			else
			{
				sweetAlert("Oops...", "Cannot Delete this item", "error");
			}
		}
	});
}
</script>
@endsection