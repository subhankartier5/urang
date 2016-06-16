@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<div class="alert alert-success" id="success" style="display: none;"></div>
	                   View Price List
	                   <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_items"><i class="fa fa-plus" aria-hidden="true"></i> Add Items</button>
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
	                                    <th>#</th>
	                                    <th>Category</th>
	                                    <th>Item</th>
	                                    <th>Created By</th>
	                                    <th>Created At</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
	                            </thead>
	                            <tbody>
		                            @if(count($priceList) > 0)
		                            	@foreach($priceList as $item)
			                            	<tr>
				                            	<td>{{$item->id}}</td>
				                            	@if($item->categories != null)
				                            		<td>{{$item->categories->name}}</td>
				                            	@else
				                            		<td>No Categories are there in our record</td>
				                            	@endif
				                            	<td>{{$item->item}}</td>
				                            	<td>{{$item->admin->username}}</td>
				                            	<td>{{ date("F jS Y",strtotime($item->created_at->toDateString())) }}</td>
				                            	<td><button type="button" id="edit_{{$item->id}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
				                            	<td><button type="button" id="del_{{$item->id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>
			                            	</tr>
		                            	@endforeach
		                            @else
		                            	<tr>
			                            	<td><label class="alert alert-warning">No data exists please create one.</label></td>
			                            </tr>
		                            @endif
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{!!$priceList->render()!!}</span>
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
	<!-- Modal for add  -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="color: red;" id="error"></h4>
	        <h4 class="modal-title">Add Items</h4>
	      </div>
	      <div class="modal-body">
	      	<div style="background: transparent; display: none;" id="loader" align="center">
	      			<p>Please wait...</p>
		        	<img src="{{url('/')}}/public/img/reload.gif">
		    </div>
			<form role="form" id="add-modal-form">
				<div class="form-group">
				    <label for="categories">Categories</label>
				    @if(count($categories) > 0)
				    	<select class="form-control">
				    		<option value="">Select Category</option>
					    	@foreach($categories as $category)
								<option value="{{ $category->name }}">{{ $category->name }}</option>
					    	@endforeach
				    	</select>
				    @else
				    	<label class="alert alert-warning">No Categories.</label>
				    @endif
			  </div>
			  <div class="form-group">
			    <label for="name">Item Name</label>
			    <input class="form-control" id="name" name="name" type="text" required="">
			  </div>
			  <div class="form-group">
			    <label for="price">Price</label>
			    <input type="number" class="form-control" name="price" id="price" required=""></input>
			  </div>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="postItem">Add Item</button>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<!-- Modal for edit  -->
	<div id="myModalEdit" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="color: red;" id="errorEdit"></h4>
	        <h4 class="modal-title">Edit Item</h4>
	      </div>
	      <div class="modal-body">
		      <div style="background: transparent; display: none;" id="loaderEdit" align="center">
		      			<p>Please wait...</p>
			        	<img src="{{url('/')}}/public/img/reload.gif">
			  </div>
			<form role="form" id="edit-modal-form">
			  <div class="form-group">
			    <label for="nameEdit">Name</label>
			    <input class="form-control" id="nameEdit" name="nameEdit" type="text">
			  </div>
			  <div class="form-group">
			    <label for="priceEdit">Description</label>
			    <input type="number" class="form-control" name="priceEdit" id="priceEdit" required=""></input>
			  </div>
			  <input type="hidden" name="id" id="id"></input>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="postEditItem">Save Changes</button>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			//showing modal to add item
			$('#add_items').click(function(){
				$('#myModal').modal('show');
			});
		});
	</script>
@endsection