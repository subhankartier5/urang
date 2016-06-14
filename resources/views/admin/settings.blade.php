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
	            <h1 class="page-header">Settings</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	        <div class="col-lg-6">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Change Password
	                </div>
	                <div class="panel-body">
		                <div class="alert alert-danger" style="display: none;" id="errorJs"></div>
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <form role="form" method="post" action="{{ route('post-change-password') }}">
	                                <div class="form-group">
	                                    <label>Current Password:</label>
	                                    <input class="form-control" type="password" name="c_pass" required="" />
	                                </div>
	                                <div class="form-group">
	                                    <label>New Password:</label>
	                                    <input class="form-control" type="password" name="n_pass" required="" id="n_pass" />
	                                </div>
	                                <div class="form-group">
	                                    <label>Confirm Password:</label>
	                                    <input class="form-control" type="password" name="confirm_password" id="confirm_password" required="" />
	                                </div>
	                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block" id="change_password">Change Password</button>
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
	        <div class="col-lg-6">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Site Settings
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <form role="form" method="post" action="#">
	                                <div class="form-group">
	                                    <label>Site Title:</label>
	                                    <input class="form-control" type="text" name="title" value="#" />
	                                </div>
	                                <div class="form-group">
	                                    <label>Site URL:</label>
	                                    <input class="form-control" type="text" name="url" value="#"/>
	                                </div>
	                                <div class="form-group">
	                                    <label>Site Email:</label>
	                                    <input class="form-control" type="email" name="email" required="" />
	                                </div>
	                               	<div class="form-group">
	                                    <label>Meta Keywords:</label>
	                                    <textarea class="form-control" name="meta-key"></textarea>
	                                </div>
	                                <div class="form-group">
	                                    <label>Meta Description:</label>
	                                    <textarea class="form-control" name="meta-des"></textarea>
	                                </div>
	                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block">Change</button>
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