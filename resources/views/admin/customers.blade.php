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
	                	@if(Session::has('successUpdate'))
	                		<div class="alert alert-success">	                             	{{Session::get('successUpdate')}}
	                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                		</div>
	                	@else
	                	@endif
	                	<div class="alert alert-success" id="success" style="display: none;"></div>
	                	<div class="alert alert-danger" id="errordiv" style="display: none;"></div>
	                   Customers
	                   <a href="{{route('getAddNewCustomers')}}">
	                   	<button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_cus"><i class="fa fa-plus" aria-hidden="true"></i> Add Customers</button>
						</a>
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
	                                    <th>Email</th>
	                                    <th>Name</th>
	                                    <th>Phone</th>
	                                    <th>Address</th>
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
			                            		<td>{{$customer->email}}</td>
			                            		@if($customer->user_details != null)
			                            			<td>{{$customer->user_details->name}}</td>
				                            		<td>{{$customer->user_details->personal_ph}}</td>
				                            		<td>{{$customer->user_details->address}}</td>
				                            		<td><button type="submit" id="block_{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-ban" aria-hidden="true"></i> {{$customer->block_status == 0 ? 'Block' : 'Unblock'}}</button></td>
				                            		<td><a href="{{route('getEditCustomer', ['id' => base64_encode($customer->id)])}}"><button type="submit" id="edit_{{$customer->id}}" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a></td>
				                            		<td><button type="submit" id="del_{{$customer->id}}" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
			                            		@else
			                            			<td>No Data</td>
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
<script type="text/javascript">
		$(document).ready(function(){
			var baseUrl = "{{url('/')}}";
			@if (count($customers) > 0) 
				@foreach($customers as $customer)
					//block functionality
					$('#block_'+{{$customer->id}}).click(function(){
						var id = '{{$customer->id}}';
						$.ajax({
							url: baseUrl+"/block-user",
							type: "POST",
							data: {id: id, _token: '{!!csrf_token()!!}'},
							success: function(data) {
								if (data == 1) 
								{
									location.reload();
								}
								else
								{
									$('#errordiv').show();
									$('#errordiv').html('Some Error occured please try again later');
								}
								//console.log(data);
							}
						});
					});
					//delete functionality
					$('#del_'+{{$customer->id}}).click(function(){
						swal({   
							title: "Are you sure?",   
							text: "Deleting this user will remove all pickup req and all data associated with it!",   
							type: "warning",   
							showCancelButton: true,   
							confirmButtonColor: "#DD6B55",   
							confirmButtonText: "Yes, delete it!",   
							closeOnConfirm: false }, 
							function(){
								var id = '{{$customer->id}}';
								$.ajax({
									url: baseUrl+"/delete-user",
									type: "POST",
									data: {id: id, _token: '{!!csrf_token()!!}'},
									success: function(data) {
										if (data == 1) 
										{
											location.reload();
										}
										else
										{
											console.log(data);
											$('#errordiv').show();
											$('#errordiv').html('Some Error occured please try again later');
										}
										//console.log(data);
									}
								});
						});
					});
				@endforeach
			@else
			console.log('No Customers');
			@endif

			
		});
</script>
@endsection