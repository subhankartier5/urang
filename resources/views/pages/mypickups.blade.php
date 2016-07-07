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
			            <th>Details</th>
			            <th>Delete</th>
			            <th>Invoice</th>
			         </tr>
			      </thead>
			      <tbody>
			         <tr>
			            <td></td>
			            <td></td>
			            <td></td>
			            <td></td>
			            <td></td>
			            <td></td>
			         </tr>
			      </tbody>
			      
			   </table>
			</div>  
	    </div>
	   </div>
	</div>
</div>
@endsection