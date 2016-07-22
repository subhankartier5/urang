@extends('staff.layouts.master')
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
                     <h2>Customers</h2>
                  </div>
                  <div class="alert alert-danger col-lg-12">Customers with card payment will be shown in <a href="{{route('getMakePayments')}}">Make Payment Module</a></div>
               </div>
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>Client ID</th>
                        <th>Order ID</th>
                        <th>Clent Email</th>
                        <th>Pick Up Type</th>
                        <th>Payment Method</th>
                        <th>Order Date</th>
                        <th>Total Cost</th>
                        <th>Mark As Paid</th>
                     </tr>
                  </thead>
                  <tbody id="tablePriceList">
                	@if(count($data) > 0)
                		@foreach($data as $items)
                			<tr>
                				<td>{{$items->user_id}}</td>
                				<td>{{$items->id}}</td>
                				<td>{{$items->user->email}}</td>
                				<td>{{$items->pick_up_type == 1 ? "Fast Pickup" : "Detailed Pickup"}}</td>
                				<td>{{$items->payment_type == 2 ? "Cash On Delivary" : "Check Payment"}}</td>
                				<td>{{date("F jS Y",strtotime($items->created_at->toDateString()))}}</td>
                				<td>{{number_format((float)$items->total_price, 2, '.', '') ==0.00 ? "Hold On invoice is not ready yet" : number_format((float)$items->total_price, 2, '.', '')}}</td>
                				<td><button type="button" id="paid_{{$items->id}}" class="btn btn-danger btn-xs" onclick="MarkAsPaid('{{$items->id}}')"><i class="fa fa-check" aria-hidden="true"></i> Paid</button></td>
                			</tr>
                		@endforeach
                	@else
                		<tr>
                			<td>No Pending Data</td>
                		</tr>
                	@endif
                </tbody>
               </table>
               <span style="float: right;">{!!$data->render()!!}</span>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /#page-wrapper -->
</div>
<script type="text/javascript">
	function MarkAsPaid(id) {
        //alert(id);
        $.ajax({
          url:"{{route('postMarkAsPaid')}}",
          type: "POST",
          data: {pick_up_req_id : id, _token: "{{Session::token()}}"},
          success: function(data) {
            //console.log(data);
            //return false;
            if (data == 1) 
            {
              location.reload();
            }
            else
            {
              sweetAlert("Oops...", "Something went wrong cannot mark as paid", "error");
              return false;
            }
          }
        });
      }
</script>
@endsection