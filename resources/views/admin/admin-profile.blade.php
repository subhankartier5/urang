@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	        	@if(Session::has('success'))
	        		<div class="alert alert-success">
	        			<i class="fa fa-check" aria-hidden="true"></i>
	        			<strong>Success!</strong> {{Session::get('success')}}
	        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        		</div>
	        	@else
	        	@endif

	        	@if(Session::has('error'))
	        		<div class="alert alert-danger">
	        			<i class="fa fa-warning" aria-hidden="true"></i>
	        			<strong>Error!</strong> {{Session::get('error')}}
	        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        		</div>
	        	@else
	        	@endif
	            <h1 class="page-header">Update Details</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Admin Details
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <form role="form" method="post" action="{{ route('post-admin-profile') }}">
	                                <div class="form-group">
	                                    <label>User Name:</label>
	                                    <input class="form-control" type="text" name="user_name" value="{{ $user_data->username }}" />
	                                </div>
	                                <div class="form-group">
	                                    <label>User Email:</label>
	                                    <input class="form-control" type="email" name="user_email" value="{{ $user_data->email }}"/>
	                                    <p class="help-block" style="color: red;">Email is used for login.</p>
	                                </div>
	                                <div class="form-group">
	                                    <label>Confirm Password:</label>
	                                    <input class="form-control" type="password" name="user_password" required="" />
	                                </div>
	                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block">Update</button>
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
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
@endsection