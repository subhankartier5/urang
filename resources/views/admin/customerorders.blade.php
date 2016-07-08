@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
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
	         	<h1>Customer Orders</h1>
	        </div>
	        <div class="panel-body">
	        	<div class="row">
	                <div class="col-lg-12">
	                	<table class="table">
	                            <thead>
	                                <tr>
	                                    <th>Order #</th>
	                                    <th>Order Type</th>
	                                    <th>Customer Name</th>
	                                    <th>Customer Address</th>
	                                    <th>Created By</th>
	                                    <th>Created At</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
	                            </thead>
	                            <tbody>
		                           
	                            </tbody>
	                        </table>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>
@endsection