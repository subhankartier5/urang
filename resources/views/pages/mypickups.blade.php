@extends('pages.layouts.user-master')
@section('content')
<style type="text/css">
	.single-form {
	 border: none !important; 
     padding: 0 !important; 
     background: none !important; 
     width: 0 !important; 
	}
</style>
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
		    <div id="jqstatus"></div>
		    <div class = "table-responsive">
			   <table class = "table table-bordered">
			      <thead>
			         <tr id="a_id_to_refresh">
			            <th>Order ID</th>
			            <th>Date Order Placed</th>
			            <th>Pickup Date</th>
			            <th>Processing</th>
			            <th>Expected Return Date</th>
			            <th>Date Returned</th>
			            <th>Original Invoice</th>
			            <th>Final Invoice</th>
			            <th>Payment Status</th>
			            <th>Delete</th>
			            @if(count($pick_up_req) > 0)
			      			@foreach($pick_up_req as $req)
			      				<th>{{$req->order_status != 5 ? "cancel order" : "undo"}}</th>
			      			@endforeach
			      		@endif
			            <th>Invoice</th>
			         </tr>
			      </thead>
			      <tbody id="a_id_to_refresh1">
		      		@if(count($pick_up_req) > 0)
			      		@foreach($pick_up_req as $req)
			      			<tr>
					            <td>{{$req->id}}</td>
					            <td>{{ date("F jS Y",strtotime($req->OrderTrack->order_placed)) }}</td>
					            <td>{{$req->OrderTrack->picked_up_date == null ? "Yet not picked up" : date("F jS Y",strtotime($req->OrderTrack->picked_up_date))}}</td>
					            <td>
					            	@if($req->order_status == 1)
					            		Order Placed
					            	@elseif($req->order_status == 2)
					            		Yes
					            	@elseif($req->order_status == 3)
					            		Done & Ready to Dispatch
					            	@elseif($req->order_status == 4)
					            		Delivered
					            	@else
					            		Cancelled
					            	@endif
					            </td>
					            <td>{{$req->OrderTrack->expected_return_date == null ? '2 , 3 business days' : date("F jS Y",strtotime($req->OrderTrack->expected_return_date))}}</td>
					            <td>{{$req->OrderTrack->return_date == null ? 'Pending' :date("F jS Y",strtotime($req->OrderTrack->return_date)) }}</td>
					            <td>{{$req->OrderTrack->original_invoice}}</td>
					            <td>{{$req->OrderTrack->final_invoice == null ? "Pending" : number_format((float)$req->OrderTrack->final_invoice, 2, '.', '') }}</td>
					            <td>{{$req->payment_status == 0 ? "Pending" : "Paid"}}</td>
				          		<td>
				          			@if($req->order_status == 1 || $req->order_status == 5)
				          				<button type="button" id="btn_{{$req->id}}" class="btn btn-danger btn-xs" onclick="DeleteOrder('{{$req->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          			@else
				          				<button type="button" id="btn_{{$req->id}}" class="btn btn-danger btn-xs" disabled="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          			@endif
				          		</td>
				          		<td>
				          			@if($req->order_status == 1)
				          				<button type="button" class="btn btn-xs btn-warning" onclick="return CancelReq('{{$req->id}}', 'cancel');"><i class="fa fa-times" aria-hidden="true"></i></button>
				          			@elseif($req->order_status == 5)
				          				<button type="button" class="btn btn-xs btn-warning" onclick="return CancelReq('{{$req->id}}', 'open');"><i class="fa fa-check" aria-hidden="true"></i></button>
				          			@else
				          				<button type="button" class="btn btn-xs btn-warning" disabled="true"><i class="fa fa-times" aria-hidden="true"></i></button>
				          			@endif
				          		</td>
				          		<td>
				          			<form action="{{route('showInvoiceUser')}}" method="post" class="single-form">
				          				<button type="submit" class="btn btn-link"><i class="fa fa-external-link" aria-hidden="true"></i></button>
				          				<input type="hidden" name="id" value="{{$req->id}}"></input>
				          				<input type="hidden" name="_token" value="{{Session::token()}}"></input>
					          		</form>
				          		</td>
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
				div += '<tr><td>{{$order->items}}</td><td>{{$order->quantity}}</td><td>{{number_format((float)$order->price, 2, '.', '')}}</td></tr>';
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
function CancelReq(pickup_id , flag) {
	//alert(pickup_id);
	$.ajax({
		url: "{{route('postCancelOrder')}}",
		type: "post",
		data: {id: pickup_id, flag: flag,  _token: "{{Session::token()}}"},
		success: function(data) {
			console.log(data);
			if (data == 1) 
			{	
				if (flag == 'cancel') 
				{
					$('#jqstatus').html('<div class="alert alert-success">Order Successfully cancelled!</div>');	
				}
				else
				{
					$('#jqstatus').html('<div class="alert alert-success">Order Successfully placed again!</div>');
				}
				location.reload();
			}
			else
			{
				$('#jqstatus').html('<div class="alert alert-success">'+data+'</div>');
			}
		}
	});
}
</script>
@endsection