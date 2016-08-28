@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
	   <div class="row">
	      <div class="col-lg-12">
	         <div class="panel panel-default">
	            <div class="panel-heading">
	               @if(Session::has('fail'))
	                 <div class="alert alert-danger"><strong>Error!</strong> {{Session::get('fail')}}
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                 </div>
	               @else
	               @endif
	               @if(Session::has('success'))
	                 <div class="alert alert-success"><strong>Success!</strong> {{Session::get('success')}}
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                 </div>
	               @else
	               @endif
	               <input type="number" step="any" name="percentage" id="percentage" style="display: none; margin-left: 75%;"></input>
	               <button type="button" class="btn btn-primary btn-xs" style="float: right;margin-left: 1%;" id="add_percentage" onclick="OpenTextBox()">Add Money Percentage</button>
	               <button type="button" class="btn btn-primary btn-xs" style="float: right;margin-left: 1%; display: none;" id="reset">close</button>
	               <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_school" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add School</button>
	               <form role="form" method="get" action="{{route('postSearchByButton')}}" style="margin-left: 55%;">
	               		<input type="text" name="search_school" id="search_school" onkeypress ="return SearchRes();"  placeholder="school name" />
	               		<button type="submit" id="search_school" class="btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> search</button>
	               		<div id="res_temp"></div>
	               </form>
	               <div id="errorjs"></div>
	               <p>School List (School Donation Percentage {{$percentage != null ? $percentage->percentage: '0'}}%)</p>
	            </div>
	            <div class="panel-body">
	               <div class="table-responsive table-bordered">
	                  <table class="table">
	                     <thead>
	                        <tr>
	                           <th>#</th>
	                           <th>School Name</th>
	                           <th>School Neighborhood</th>
	                           <th>School Image</th>
	                           <th>Total Money Donated</th>
	                           <th>Pending Money</th>
	                           <th>Edit</th>
	                           <th>Delete</th>
	                           <th>Pay Pending Money</th>
	                        </tr>
	                     </thead>
	                     <tbody>
	                        @if(count($list_school) > 0)
	                        	@foreach($list_school as $school)
	                        		<tr>
	                        			<td>{{$school->id}}</td>
	                        			<td>{{$school->school_name}}</td>
	                        			<td>
	                        				@if($school->neighborhood_id == 0)
	                        					Others
	                        				@else
	                        					{{$school->neighborhood->name}}
	                        				@endif
	                        			</td>
	                        			<td><img src="{{url('/')}}/public/dump_images/{{$school->image}}" alt="school image" style="height: 50px; width: 73px"></td>
	                        			<td>{{number_format((float)$school->total_money_gained, 2, '.', '')}}</td>
	                        			<td>{{number_format((float)$school->pending_money, 2, '.', '')}}</td>
	                        			<td><button type="button" class="btn btn-warning btn-xs" onclick="editSchool('{{$school->id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
	                        			<td><button type="button" class="btn btn-danger btn-xs" onclick="delSchool('{{$school->id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
	                        			<td>
	                        				@if(number_format((float)$school->pending_money, 2, '.', '') == 0.00)
	                        					<label style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> Paid</label>
	                        				@else
	                        					<button type="button" class="btn btn-primary btn-xs" onclick="payPendingMoney('{{$school->id}}')"><i class="fa fa-check" aria-hidden="true"></i> Not Paid</button>
	                        				@endif
	                        			</td>
	                        		</tr>
	                        	@endforeach
	                        @else
	                        	<tr><td>No Data</td></tr>
	                        @endif
	                     </tbody>
	                  </table>
	                  <span style="float: right;">{!! $list_school->render() !!}</span>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add School</h4>
	      </div>
	      <div class="modal-body">
	        <form role="form" enctype="multipart/form-data" action="{{route('postSaveSchool')}}" method="post">
	        	<div class="form-group">
	        		<label for="school_name">School Name:</label>
	        		<input type="text" class="form-control" name="school_name" required=""></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="neighborhood">Select Neighborhood:</label>
	        		@if(count($neighborhood) > 0)
	        			<select class="form-control" name="neighborhood" required="">
	        				<option value="">Select Neighborhood</option>
	        				@foreach($neighborhood as $neighbor)
	        					<option value="{{$neighbor->id}}">{{$neighbor->name}}</option>
	        				@endforeach
	        				<option value="0">Others</option>
	        			</select>
	        		@else
	        			No Neighborhood please create one <a href="{{route('get-neighborhood')}}">click here</a>
	        		@endif
	        	</div>
	        	<div class="form-group">
	        		<label for="image">Upload Image:</label>
	        		<input type="file" name="image" class="form-control" required=""></input>
	        	</div>
	        	<button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
	        	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>

	  </div>
	</div>
	<div id="myModalEdit" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit School</h4>
	      </div>
	      <div class="modal-body">
	        <form role="form" enctype="multipart/form-data" action="{{route('postEditSchool')}}" method="post">
	        	<div class="form-group">
	        		<label for="school_name">School Name:</label>
	        		<input type="text" class="form-control" name="school_name" id="school_name"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="neighborhood">Select Neighborhood:</label>
	        		@if(count($neighborhood) > 0)
	        			<select class="form-control" name="neighborhood" id="neighborhood">
	        				<option value="">Select Neighborhood</option>
	        				@foreach($neighborhood as $neighbor)
	        					<option value="{{$neighbor->id}}">{{$neighbor->name}}</option>
	        				@endforeach
	        					<option value="0">Others</option>
	        			</select>
	        		@else
	        			No Neighborhood please create one <a href="{{route('getNeiborhoodPage')}}">click here</a>
	        		@endif
	        	</div>
	        	<div class="form group">
	        		<label for="pending_money">Pending Money:</label>
	        		<input type="text" id="pending_money" name="pending_money" class="form-control"></input>
	        	</div>
	        	<div class="form group">
	        		<label for="total_money_gained">Total Money Paid:</label>
	        		<input type="text" id="total_money_gained" name="total_money_gained" class="form-control"></input>
	        	</div><br>
	        	<div class="form-group">
	        		<div id="imagePreview"></div>
	        		<label for="image">Upload Image:</label>
	        		<input type="file" name="image" class="form-control" id="image"></input>
	        	</div>
	        	<button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
	        	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
	        	<input type="hidden" name="sch_id" id="sch_id"></input>
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>

	  </div>
	</div>
	<script type="text/javascript">
		function editSchool(id) {
			$('#myModalEdit').modal('show');
			@foreach($list_school as $school)
				if ('{{$school->id}}' == id) 
				{
					$('#school_name').val('{{$school->school_name}}');
					$('#neighborhood').val('{{$school->neighborhood_id}}');
					$('#imagePreview').html('<img src="{{url("/")}}/public/dump_images/{{$school->image}}" style="height: 100px; width: 100px;" alt="school image">');
					$('#pending_money').val('{{number_format((float)$school->pending_money, 2, '.', '')}}');
					$('#total_money_gained').val('{{number_format((float)$school->total_money_gained, 2, '.', '')}}');
					$('#sch_id').val('{{$school->id}}');
				}
			@endforeach
			
		}
		function delSchool(id) {
			$.ajax({
				url: "{{route('postDeleteSchool')}}",
				type:"POST",
				data: {id: id, _token: "{{Session::token()}}"},
				success : function(data) {
					//console.log(data)
					if (data == 1) 
					{
						location.reload();
					}
					else
					{
						sweetAlert("Oops...", "Cannot delete school please try again later!", "error");
					}
				}
			});
		}
		function payPendingMoney(id) {
			$.ajax({
				url: "{{route('postPendingMoney')}}",
				type:"POST",
				data: {id: id, _token: "{{Session::token()}}"},
				success : function(data) {
					//console.log(data);
					//return;
					if (data == 1) 
					{
						location.reload();
					}
					else
					{
						sweetAlert("Oops...", "Cannot delete school please try again later!", "error");
					}
				}
			});
		}
		function OpenTextBox() {
			if ($('#add_percentage').text() == 'Add Money Percentage') 
			{
				$('#add_percentage').text('Save');
				$('#percentage').slideDown('slow');
				$('#add_school').hide();
				$('#reset').show();
			}
			else
			{
				var value_box = $('#percentage').val();
				if ($.trim(value_box) && $.isNumeric(value_box)) {
					$('#percentage').attr('style', 'margin-left:75%;');
					$('#percentage').val('');
					$('#errorjs').hide();
					$.ajax({
						url : "{{route('savePercentage')}}",
						type: "POST",
						data: {percentage: value_box, _token: "{{Session::token()}}"},
						success: function(data) {
							//console.log(data);
							if (data == 1) 
							{
								location.reload();
							}
							else
							{
								$('#errorjs').html('<p style="color:red;margin-left: 75%;"><i class="fa fa-times" aria-hidden="true"></i> Error! Something went wrong</p>');
							}
						}

					});
				}
				else
				{
					$('#errorjs').show();
					$('#percentage').attr('style', 'border-color:#ff0000; margin-left:75%;');
					$('#percentage').effect('shake' ,{times:2}, 500);
					$('#errorjs').html('<p style="color:red;margin-left: 75%;"><i class="fa fa-times" aria-hidden="true"></i> Error! Invalid input. Hint: input number!</p>');
					$('#percentage').keyup(function(){
						$('#errorjs').hide();
						$('#percentage').attr('style', 'margin-left:75%; border: none;');
					});
					return;
				}
				$('#percentage').slideUp('slow');
				$('#add_school').show();
				$('#add_percentage').text('Add Money Percentage');
			}
		}
		$('#reset').click(function() {
			$('#add_percentage').text('Add Money Percentage');
			$('#percentage').attr('style', 'margin-left:75%;');
			$('#percentage').val('');
			$('#percentage').slideUp('slow');
			$('#add_school').show();
			$('#errorjs').hide();
			$('#reset').hide();
		});
		function SearchRes() {
			//console.log($('#search_school').val());
			var j = 0;
			$.ajax({
				url: "{{route('postSearchSchool')}}",
				type: "POST",
				data: {search: $('#search_school').val(), _token: "{{Session::token()}}"},
				success: function(data) {
					/*console.log(data.length);
					return;*/
					if (data.length > 0) 
					{
						for(var i=0 ; i<= data.length; i++)
						{
							if (data[i]) 
							{
								$('#res_temp').append('<a href="#" onclick="return setvalue(\''+data[i].school_name+'\');">'+data[i].school_name+'</a><br>');
							}	
						}
					}
					else
					{
						return false;
					}
				}
			});
		}
		function setvalue(name) {
			//alert('test')
			$('#search_school').val(name);
		}
		/*$(document).ready(function(){
			$('.click_me').click(function(){
				alert('hi');
			});
		});*/
	</script>
@endsection