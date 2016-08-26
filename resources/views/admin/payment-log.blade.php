@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	@if(Session::has('fail'))
	                		<div class="alert alert-danger">{{Session::get('fail')}}
	                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                		</div>
	                	@else
	                	@endif
	                	@if(Session::has('success'))
	                		<div class="alert alert-success">	                             	{{Session::get('success')}}
	                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                		</div>
	                	@else
	                	@endif
	                	<div class="alert alert-success" id="success" style="display: none;"></div>
	                	<div class="alert alert-danger" id="errordiv" style="display: none;"></div>
	                   Payment Log
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive table-bordered">
	                    	<div style="background: transparent; display: none;" id="loaderBody" align="center">
								<p>Please wait...</p>
								<img src="{{url('/')}}/public/img/reload.gif">
							</div>
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Email</th>
	                                    <th>Card Number</th>
	                                    <th>Contact No</th>
	                                    <th>Pickup ID</th>
	                                    <th>Coupon</th>
	                                    <th>Money Charged</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@if(count($payment_log) > 0)
	                            		@foreach($payment_log as $log)
		                            		<tr>
		                            			<td>{{$log->user_detail->name}}</td>
		                            			<td>{{$log->user->email}}</td>
		                            			<td>
		                            			<?php
		                            			$card_data = (new \App\Helper\SiteHelper)->showCardNumber($log->user_detail->user_id);
		                            			print_r(substr_replace($card_data->card_no, str_repeat("*", 8), 4, 8));
		                            			?>
		                            			</td>
		                            			<td>{{$log->user_detail->personal_ph}}</td>
		                            			<td>{{$log->id}}</td>
		                            			<td>{{$log->coupon == null ? 'No Coupon Applied' : $log->coupon}}</td>
		                            			<td>{{number_format((float)$log->total_price, 2, '.', '')}}</td>
		                            		</tr>
		                            	@endforeach
	                            	@else
	                            		<tr>
	                            			<td>No Data</td>
	                            		</tr>
	                            	@endif
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{!!$payment_log->render()!!}</span>
	                    </div>
	                    <!-- /.table-responsive -->
	                </div>
	                <!-- /.panel-body -->
	            </div>
	            <!-- /.panel -->
	        </div>
	        <!-- /.col-lg-6 -->
	    </div>
</div>
@endsection