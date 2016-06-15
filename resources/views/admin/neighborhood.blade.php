@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                   View Neighborhood
	                   <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_neighbor"><i class="fa fa-plus" aria-hidden="true"></i> Add Neighborhood</button>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive table-bordered">
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th>#</th>
	                                    <th>Name</th>
	                                    <th>Description</th>
	                                    <th>Created By</th>
	                                    <th>Created At</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@foreach($neighborhood as $neighbor)
	                            	<tr>
	                            		<td>{{$neighbor->id}}</td>
	                            		<td>{{$neighbor->name}}</td>
	                            		<td>{{$neighbor->description}}</td>
	                            		@foreach($neighbor->admin as $admin)
	                            			<td>{{$admin->username}}</td>
	                            		@endforeach
	                            		<td>{{ date("F jS Y",strtotime($neighbor->created_at->toDateString())) }}</td>
	                                </tr>
	                            	@endforeach
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
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Neighborhood</h4>
	      </div>
	      <div class="modal-body">
			<form role="form">
			  <div class="form-group">
			    <label for="name">Name</label>
			    <input class="form-control" id="name" name="name" type="text" required="">
			  </div>
			  <div class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control" id="description" name="description" required=""></textarea>
			  </div>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="postneighbor">Block level button</button>
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
				$.ajax({
					url: baseUrl+'/neighborhood',
					type:"POST",
					data: {name:name, description:description, _token: '{!! csrf_token() !!}'},
					success: function(data) {
						
					}
				});
			});
		});
	</script>
@endsection