@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<div class="alert alert-success" id="success" style="display: none;"></div>
	                	<div class="alert alert-danger" id="errordiv" style="display: none;"></div>
	                   Customers
	                   <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_cus"><i class="fa fa-plus" aria-hidden="true"></i> Add Customers</button>
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
	                                    <th>ID</th>
	                                    <th>Name</th>
	                                    <th>Email</th>
	                                    <th>Phone</th>
	                                    <th>Address</th>
	                                    <th>Payment Status</th>
	                                    <th>Block</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
	                            </thead>
	                            <tbody id="tablePriceList">
		                            @if(count($customers) > 0)
		                            	@foreach($customers as $customer)
			                            	<tr>
			                            		<td>{{$customer->id}}</td>
			                            		@if($customer->user_details != null)
			                            			<td>{{$customer->user_details->name}}</td>
				                            		<td>{{$customer->email}}</td>
				                            		<td>{{$customer->user_details->personal_ph}}</td>
				                            		<td>{{$customer->user_details->address}}</td>
				                            		<td>{{$customer->user_details->payment_status == 0 ? 'pending' : 'paid'}}</td>
				                            		<td><button type="submit" id="block_{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-ban" aria-hidden="true"></i> Block</button></td>
				                            		<td><button type="submit" id="edit_{{$customer->id}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
				                            		<td><button type="submit" id="del_{{$customer->id}}" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
			                            		@else
			                            		@endif
			                            	</tr>
		                            	@endforeach
		                            @else
			                            <tr>
			                            	<td>No Data Exists</td>
			                            </tr>
		                            @endif
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{{$customers->render()}}</span>
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