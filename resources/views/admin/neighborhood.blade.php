@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<div class="alert alert-success" id="success" style="display: none;"></div>
	                   View Neighborhood
	                   <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_neighbor"><i class="fa fa-plus" aria-hidden="true"></i> Add Neighborhood</button>
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
	                                    <th>Name</th>
	                                    <th>Description</th>
	                                    <th>Created By</th>
	                                    <th>Created At</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
	                            </thead>
	                            <tbody>
		                            @if(count($neighborhood) > 0 )
		                            	@foreach($neighborhood as $neighbor)
			                            	<tr>
			                            		<td>{{$neighbor->id}}</td>
			                            		<td>{{$neighbor->name}}</td>
			                            		<td>{{$neighbor->description}}</td>
			                            		@foreach($neighbor->admin as $admin)
			                            			<td>{{$admin->username}}</td>
			                            		@endforeach
			                            		<td>{{ date("F jS Y",strtotime($neighbor->created_at->toDateString())) }}</td>
			                            		<td><button type="button" id="edit_{{$neighbor->id}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
			                            		<td><button type="button" id="del_{{$neighbor->id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>
			                                </tr>
		                            	@endforeach
		                            @else
		                            	<tr>
		                            		<td><label class="alert alert-warning">No data exists please create one.</label></td>
		                            	</tr>
	                            	@endif
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{!!$neighborhood->render()!!}</span>
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
	        <h4 class="modal-title">Add Neighborhood</h4>
	      </div>
	      <div class="modal-body">
	      	<div style="background: transparent; display: none;" id="loader" align="center">
	      			<p>Please wait...</p>
		        	<img src="{{url('/')}}/public/img/reload.gif">
		    </div>
			<form role="form" id="add-modal-form">
			  <div class="form-group">
			    <label for="name">Name</label>
			    <input class="form-control" id="name" name="name" type="text" required="">
			  </div>
			  <div class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control" id="description" name="description" required=""></textarea>
			  </div>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="postneighbor">Add Neighborhood</button>
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
	        <h4 class="modal-title">Edit Neighborhood</h4>
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
			    <label for="descriptionEdit">Description</label>
			    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"></textarea>
			  </div>
			  <input type="hidden" name="id" id="id"></input>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="postEditneighbor">Save Changes</button>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<!--Add new neighbor script-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#add_neighbor').click(function(){
				//showing modal
				$('#myModal').modal({
					show: 'true'
				});
			});
		});
		$(document).ready(function(){
			var baseUrl = "{{url('/')}}";
			//adding neighbor in database
			$('#postneighbor').click(function(){
				var name = $('#name').val();
				var description = $('#description').val();
				//console.log(name);
				$('#add-modal-form').hide();
				$('#loader').show();
				$.ajax({
					url: baseUrl+'/neighborhood',
					type:"POST",
					data: {name:name, description:description, _token: '{!! csrf_token() !!}'},
					success: function(data) {
						if (data) 
						{
							window.setTimeout(function(){
        						$('body').html(data);
        						$('#success').html("<strong><i class='fa fa-check' aria-hidden='true'></i> Success!</strong> Neighborhood successfully added! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>");
								$('#success').show();
							}, 200);
						}
						else
						{
							$('#error').html('<i class="fa fa-times" aria-hidden="true"></i>'+' <strong>Sorry!</strong>'+' Could not save this neighborhood now please try again later');
						}
					}
				});
			});

			//edit neighborhood show or get
			@foreach($neighborhood as $neighbor)
				$('#edit_{{$neighbor->id}}').click(function(){
					$('#myModalEdit').modal({
						show: 'true'
					});
					$('#nameEdit').val('{{$neighbor->name}}');
					$('#descriptionEdit').val('{{$neighbor->description}}');
					$('#id').val('{{$neighbor->id}}');
				});
				// delete neighborhood
				$('#del_{{$neighbor->id}}').click(function(){
					$('.table').hide();
					$('#loaderBody').show();
					$.ajax({
						url: baseUrl+"/delete-neighborhood",
						type: "POST",
						data: {id: '{{$neighbor->id}}', _token: '{!!csrf_token()!!}'},
						success: function(data) {
							if (data) 
							{
								window.setTimeout(function(){
	        						$('body').html(data);
	        						$('#success').html("<strong><i class='fa fa-check' aria-hidden='true'></i> Success!</strong> Neighborhood successfully Deleted! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>");
									$('#success').show();
								}, 200);
							}
							else
							{
								$('#error').html('<i class="fa fa-times" aria-hidden="true"></i>'+' <strong>Sorry!</strong>'+' Could not delete this neighborhood now please try again later');
							}
						}
					});
				});
			@endforeach

			//post neighborhood edit
			$('#postEditneighbor').click(function(){
				var id = $('#id').val();
				//console.log(id);
				var nameEdited = $('#nameEdit').val();
				//console.log(nameEdited);
				var descriptionEdited = $('#descriptionEdit').val();
				//console.log(descriptionEdited);
				//console.log(baseUrl);
				$('#edit-modal-form').hide();
				$('#loaderEdit').show();
				$.ajax({
					url: baseUrl+'/edit-neighborhood',
					type:"POST",
					data: {id: id, name:nameEdited, description:descriptionEdited, _token: '{!! csrf_token() !!}'},
					success: function(data) { 
						if (data) 
						{
							window.setTimeout(function(){
        						$('body').html(data);
        						$('#success').html("<strong><i class='fa fa-check' aria-hidden='true'></i> Success!</strong> Neighborhood successfully Updated! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>");
								$('#success').show();
							}, 200);
						}
						else
						{
							$('#error').html('<i class="fa fa-times" aria-hidden="true"></i>'+' <strong>Sorry!</strong>'+' Could not update this neighborhood now please try again later');
						}
					}
				});
			});
		});
	</script>
@endsection