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
	            <h1 class="page-header">Pickup Request Manager</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Manage Request Numbers
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <table class="table table-bordered">
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day1_form">
				                                <div class="form-group">
				                                	<label for="day_1">Monday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day1_strt" value="{{$pick_up_schedule[0] != null ? $pick_up_schedule[0]->opening_time: ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day1_end" value="{{$pick_up_schedule[0] != null ? $pick_up_schedule[0]->closing_time : ''}}"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_1">Save</button>
				                                	<input type="hidden" name="day" value="1"></input>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_1">{{$pick_up_schedule[0] != null && $pick_up_schedule[0]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
		                            <tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day2_form">
				                                <div class="form-group">
				                                	<label for="day_1">Tuesday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day2_strt" value="{{$pick_up_schedule[1] != null ? $pick_up_schedule[1]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day2_end" value="{{$pick_up_schedule[1] != null ? $pick_up_schedule[1]->closing_time : ''}}"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_2">Save</button>
				                                	<input type="hidden" name="day" value="2"></input>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_2">{{$pick_up_schedule[1] != null && $pick_up_schedule[1]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day3_form">
				                                <div class="form-group">
				                                	<label for="day_1">Wednesday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day3_strt" value="{{$pick_up_schedule[2] != null ? $pick_up_schedule[2]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day3_end" value="{{$pick_up_schedule[2] != null ? $pick_up_schedule[2]->closing_time : ''}}"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_3">Save</button>
				                                	<input type="hidden" name="day" value="3"></input>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_3">{{$pick_up_schedule[2] != null && $pick_up_schedule[2]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day4_form">
				                                <div class="form-group">
				                                	<label for="day_1">Thrusday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day4_strt" value="{{$pick_up_schedule[3] != null ? $pick_up_schedule[3]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day4_end" value="{{$pick_up_schedule[3] != null ? $pick_up_schedule[3]->closing_time : ''}}"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_4">Save</button>
				                                	<input type="hidden" name="day" value="4"></input>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_4">{{$pick_up_schedule[3] != null && $pick_up_schedule[3]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day5_form">
				                                <div class="form-group">
				                                	<label for="day_1">Friday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day5_strt" value="{{$pick_up_schedule[4] != null ? $pick_up_schedule[4]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day5_end" value="{{$pick_up_schedule[4] != null ? $pick_up_schedule[4]->closing_time : ''}}"></input>
				                                	<input type="hidden" name="day" value="5"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_5">Save</button>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_5">{{$pick_up_schedule[4] != null && $pick_up_schedule[4]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day6_form">
				                                <div class="form-group">
				                                	<label for="day_1">Saturday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day6_strt" value="{{$pick_up_schedule[5] != null ? $pick_up_schedule[5]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day6_end" value="{{$pick_up_schedule[5] != null ? $pick_up_schedule[5]->closing_time : ''}}"></input>
				                                	<input type="hidden" name="day" value="6"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_6">Save</button>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_6">{{$pick_up_schedule[5] != null && $pick_up_schedule[5]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            	<tr>
	                            		<td>
	                            			<form role="form" method="post" action="{{route('postSetTime')}}" id="day7_form">
				                                <div class="form-group">
				                                	<label for="day_1">Sunday</label><br>
				                                	<input type="text"  name="strt_tym" required="" id="day7_strt" value="{{$pick_up_schedule[6] != null ? $pick_up_schedule[6]->opening_time : ''}}"></input>
				                                	<input type="text"  name="end_tym" required="" id="day7_end" value="{{$pick_up_schedule[6] != null ? $pick_up_schedule[6]->closing_time : ''}}"></input>
				                                	<input type="hidden" name="day" value="7"></input>
				                                	<button type="submit" class="btn btn-default" id="btn_day_7">Save</button>
				                                	<input type="hidden" name="_token" value="{{Session::token()}}"></input>
				                                </div>
				                            </form>	
	                            		</td>
	                            		<td><button type="button" class="btn btn-default" id="btn_7">{{$pick_up_schedule[6] != null && $pick_up_schedule[6]->closedOrNot == 0 ? 'Mark As Closed': 'Mark As Open'}}</button></td>
	                            	</tr>
	                            </table>
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
	<script type="text/javascript">
		$(document).ready(function(){
			var arrayFromPhp = '{!!json_encode($pick_up_schedule)!!}';
			var new_array = jQuery.parseJSON(arrayFromPhp);
			for(var k=0; k<=6; k++) {
				if (new_array[k] != null && new_array[k].closedOrNot == 1) 
				{
					var m = k+1;
					$('#day'+m+'_strt').attr('disabled', 'true');
					$('#day'+m+'_end').attr('disabled', 'true');
					$('#btn_day_'+m+'').attr('disabled', 'true');
				}
			}
			for (var i = 1; i <= 7; i++) {
				//mark a day as closed or open
				$('#btn_'+i).click(function(){
					var new_id = this.id;
					var day = new_id.split('_');
					if ($(this).text() == 'Mark As Closed') 
					{
						$.ajax({
							'url' : "{{route('setToClose')}}",
							'type' : "POST",
							'data' : {day: day[1],value: 1, _token: "{{Session::token()}}"},
							'success' : function (data) {
								if (data == 1) 
								{
									location.reload();
								}
								else
								{
									sweetAlert("Oops...", "Unknown Error occured! cannot mark the day as close", "error");
								}
							}
						});
					}
					else
					{
						$.ajax({
							'url' : "{{route('setToClose')}}",
							'type' : "POST",
							'data' : {day: day[1],value: 0, _token: "{{Session::token()}}"},
							'success' : function (data) {
								//console.log(data);
								if (data == 1) 
								{
									location.reload();
								}
								else
								{
									sweetAlert("Oops...", "Unknown Error occured! cannot mark the day as close", "error");
								}
							}
						});
					}
				});
			}
			//generating dropdown
			for (var j=1; j<=7; j++) {
				$('#day'+j+'_strt').timepicker({'step': 1});
				$('#day'+j+'_end').timepicker({'step': 1});
			}
		});
	</script>
@endsection