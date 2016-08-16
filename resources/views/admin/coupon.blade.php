@extends('admin.layouts.master')
@section('content')
<style>
	.modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
</style>
	<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	@if(count($errors) > 0)
        		<div class="alert alert-danger">
        				<ul>
        					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        				@foreach($errors->all() as $error)
	        					<li>{{$error}}</li>
	        				@endforeach
        				</ul>
        		</div>
        	@endif
        	@if(Session::has('success'))
        		<div class="alert alert-success">
        			<i class="fa fa-check" aria-hidden="true"></i>
        			<strong>Success!</strong> {{Session::get('success')}}
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        		</div>
        	@else
        	@endif
        	@if(Session::has('fail'))
        		<div class="alert alert-danger">
        			<i class="fa fa-warning" aria-hidden="true"></i>
        			<strong>Error!</strong> {{Session::get('fail')}}
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        		</div>
        	@else
        	@endif
            <h1 class="page-header">Generate Coupon</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Coupon generator
                    <button type="button" id="show_coupons" class="btn btn-primary btn-xs" style="float: right;" data-toggle="modal" data-target="#showCoupons">Show all coupons</button>
                    <button type="button" id="gen_coupon" class="btn btn-primary btn-xs" style="float: right; margin-right: 1%;">generate a coupon</button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="{{route('postSaveCoupon')}}">
                                <div class="form-group">
                                    <label>Coupon Code:</label>
                                    <input class="form-control" type="text" name="coupon_code"  id="coupon_code" required="true" />
                                </div>
                                <div class="form-group">
                                    <label>Discount (in %)</label>
                                    <input class="form-control" type="number" step="any" name="discount"  id="discount" required="true" />
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" id="save_coupon">Save</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div> 
    </div>
</div>
<div id="showCoupons" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Coupons List</h4>
      </div>
      <div class="modal-body">
      	<div class="col-lg-12">
	        <div style="display: none;" id="loaderBodyCoupon" align="center">
	        <p>Please wait...</p>
	        <img src="{{url('/')}}/public/images/loading.gif" style="height: 150px;">
      	</div>
        <table class="table table-bordered">
        	<thead>
        		<tr>
	        		<th>Coupon Code</th>
	                <th>Discount</th>
	                <th>Active</th>
	                <th>Status</th>
	                <th>Delete</th>
        		</tr>
        	</thead>
        	<tbody>
        		@if(count($coupon_list) > 0)
        			@foreach($coupon_list as $coupon)
        				<tr>
        					<td>{{$coupon->coupon_code}}</td>
        					<td>{{$coupon->discount}}%</td>
        					<td>{{$coupon->isActive == 1 ? "Yes" : "No"}}</td>
        					<td><button type="button" class="btn btn-{{$coupon->isActive == 1 ? 'danger' : 'primary'}} btn-xs marginClass" id="changeStatus_{{$coupon->id}}" onclick="ChangeStatus('{{$coupon->id}}')">{{$coupon->isActive == 1 ? "Mark As Inactive" : "Mark As Active"}}</button></td>
        					<td><button type="button" class="btn btn-danger btn-xs marginClass" id="delCoupon_{{$coupon->id}}" onclick="DeleteCoupon('{{$coupon->id}}')">Delete</button></td>
        				</tr>
        			@endforeach
        		@else
        			<tr>
        				<td></td>
        				<td></td>
        				<td>No Coupons</td>
        				<td></td>
        				<td></td>
        			</tr>
        		@endif
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//coupon generator script
		$('#gen_coupon').click(function(){
		    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
			var string_length = 8;
			var randomstring = '';
			for (var i=0; i<string_length; i++) {
				var rnum = Math.floor(Math.random() * chars.length);
				randomstring += chars.substring(rnum,rnum+1);
			}
			$('#coupon_code').val("urang"+randomstring);
		});
	});
	//mark as active in active 
	function ChangeStatus(id) {
		//sweetAlert(id);
		$('#loaderBodyCoupon').show();
		$('.table').hide();
		$.ajax({
			url : "{{route('ChangeStatusCoupon')}}",
			type: "post",
			data: {id: id, _token: "{{Session::token()}}"},
			success: function(data) {
				//console.log(data);
				if (data == 1) 
				{
					location.reload();
				}
				else
				{
					$('#loaderBodyCoupon').hide();
					$('.table').show();
					sweetAlert("Oops...", data , "error");
				}
			}
		});
	}
	//delete coupon 
	function DeleteCoupon(id) {
		swal({   
			title: "Are you sure?",   
			text: "You will not be able to recover this coupon code!",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#5cb85c",   
			confirmButtonText: "Yes, delete it!",   
			closeOnConfirm: true }, 
			function(){ 
				$('#loaderBodyCoupon').show();
				$('.table').hide();
				$.ajax({
					url : "{{route('postDeleteCoupon')}}",
					type: "post",
					data: {id: id, _token: "{{Session::token()}}"},
					success: function(data) {
						if (data == 1) 
						{
							location.reload();
						}
						else
						{
							$('#loaderBodyCoupon').hide();
							$('.table').show();
							sweetAlert("Oops...", data , "error");
						}
					}
				});
		});
	}
</script>
@endsection