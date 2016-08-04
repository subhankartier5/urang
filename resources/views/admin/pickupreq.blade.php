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
		         	<h1>Add New Customer</h1>
		        </div>
		        <div class="panel-body">
		        	<div class="row">
		                <div class="col-lg-12">
		                	<form role="form" action="{{route('postPickUpReq')}}" method="post">
								<div class="form-group">
								    <label>Select a Customer</label>
								    <select name="user_id" class="form-control" required="" id="cus_email">
								    	@if(count($users) > 0)
								    		<option value="">Select a customer</option>
									    	@foreach($users as $user)
									    		<option value="{{$user->id}}">{{$user->email}}</option>
									    	@endforeach
									    @else
									    	<option value="">No Customer</option>
								    	@endif
								    </select>
								</div>
								<div class="form-group">
								    <label>Pick Up Address</label>
								    <textarea class="form-control" name="address" id="user_add" required=""></textarea>
								</div>
								<div class="form-group">
								    <label>Pick up date</label>
								    <input class="form-control" name="pick_up_date" type="text" required="" id='datepicker'>
								</div>
								<div class="form-group">
								    <label for="schedule">Schedule</label>
								    <br>
								    <label>
								    	<input type="radio" name="schedule" id="inlineRadio1" value="For the time specified only" required=""> For the time specified only.
								    </label>
								    <br>
								  	<label>
								  		<input type="radio" name="schedule" id="inlineRadio2" value="Daily at this time except weekends"> Daily at this time except weekends.
								  	</label>	
					                 <label>
					                 	<input type="radio" name="schedule" id="inlineRadio3" value="Daily at this time including weekends">  Daily at this time including weekends.	
					                 </label>
					                 <br>
					                 <label>
					                 	<input type="radio" name="schedule" id="inlineRadio4" value="Weekly on this day of the week">  Weekly on this day of the week.
					                </label>
					                <label>
					                  <input type="radio" name="schedule" id="inlineRadio5" value="Monthly on this day of the month">  Monthly on this day of the month.
					                </label>
								</div>
								<div class="form-group">
								    <label>How Would You Like Your Shirts</label>
						              <div class="checkbox">
						                <label>
						                  <input type="radio" name="boxed_or_hung" value="boxed"> Boxed
						              </label>
						              </div>
						              <div class="checkbox">
						                <label>
						                  <input type="radio" name="boxed_or_hung" value="hung"> Hung
						                </label>
								</div>
								<div class="form-group">
									<label>Strach type:</label>
				                  <select name="strach_type" required="" class="form-control">
					                <option value="no">No Strach</option>
					                <option value="very_light_starch">Very Light Starch</option>
					                <option value="light_starch">Light Starch</option>
					                <option value="medium_starch">Medium Starch</option>
					                <option value="heavy_starch">Heavy Starch</option>
					              </select>
								</div>
								<div class="form-group">
								    <label>Doorman</label>
					              	<select name="doorman" class="form-control">
						                <option value="1">Yes</option>
						                <option value="0">No</option>
					              	</select>
								</div>
								<div class="form-group">
									 <label>
                    					<input type="checkbox" name="urang_bag"> Please tick this box if you need U-Rang bag.
                  					</label>
								</div>
								<div class="form-group">
					                <label>Special Instructions</label>
					                <textarea class="form-control" rows="3" name="spcl_ins"></textarea>
					            </div>
					            <div class="form-group">
					                <label>Driving Instructions</label>
					                <textarea class="form-control" rows="3" name="driving_ins"></textarea>
					            </div>
					             <div class="form-group">
					              <label>Select Payment Method</label><br>
					                <label>
					                  <input type="radio" name="pay_method" id="inlineRadio6" value="1" required=""> Charge my credit card this time for amount $ 
					                </label><br>
					                <label>
					                  <input type="radio" name="pay_method" id="inlineRadio8" value="2"> COD
					                </label><br>
					                <label>
					                  <input type="radio" name="pay_method" id="inlineRadio9" value="3"> Check
					                </label>
					            </div>
					            <div class="form-group">
					                <select id="order_type" name="order_type" id="order_type"required="" class="form-control">
					                  <option value="">Type of order</option>
					                  <option value="1">Fast Pickup</option>
					                  <option value="0">Detailed Pickup</option>
					                </select>
					            </div>
					            <div class="form-group">
					              <label for="wash_n_fold">Wash and fold?</label>
					              <select name="wash_n_fold" id="wash_n_fold" required="" class="form-control">
					                <option value="1">Yes</option>
					                <option value="0">No</option>
					              </select>
					            </div>
					            <div class="form-group">
					              <label for="client_type">What type of client you are ?</label>
					              <select name="client_type" id="client_type" required="" class="form-control">
					                <option value="">Client Type</option>
					                <option value="new_client">New Client</option>
					                <option value="key_client">Key Client</option>
					                <option value="reff">Referral</option>
					              </select>
					            </div>
					            <div class="form-group">					                
					            	<label>Is it a emergency service ? <p style="color: red;">$7 extra</p></label>
					                <input type="checkbox" name="isEmergency"></input>
					            </div>
					            <div class="form-group">
					               <label>Do you have a coupon code ?<p style="color: red;">Please leave the field blank if you dont hav any.</p></label>
					              	<input type="text" name="coupon" id="coupon" class="form-control" />
					            </div>
					            <div class="form-group">
					            	<label>Donate to a school in your neighborhood ?</label>
                  					<input onclick="openCheckBoxSchool()" id="school_checkbox" type="checkbox" name="isDonate"></input>
              					</div>
              					<div class="form-group">
				                <span>
				                  <select name="school_donation_id" id="schoolNameDropDown" class="form-control">
				                    <option value="">Select School</option>
				                    @foreach($school_list as $school)
				                    <option value="{{$school->id}}">{{$school->school_name}}</option>
				                    @endforeach
				                  </select>
				                </span>
				              </div>
              					<button type="submit" class="btn btn-primary btn-lg btn-block">Schedule Pick up</button>
								<input type="hidden" name="_token" value="{{Session::token()}}"></input>
								<input type="hidden" name="identifier" value="admin"></input>
								<div id="myModal" class="modal fade" role="dialog">
						        <div class="modal-dialog">
						          <!-- Modal content-->
						          <div class="modal-content">
						            <div class="modal-header">
						              <button type="button" class="close" data-dismiss="modal">&times;</button>
						              <h2>Select items you want</h2>
						            </div>
						            <div class="modal-body">
						              <table class = "table table-striped">
						                <thead>
						                  <tr>
						                    <th>No of Items</th>
						                    <th>Item Name</th>
						                    <th>Item Price</th>
						                    <th>Action</th>
						                  </tr>
						                </thead>
						                <tbody> 
						              @if(count($price_list) > 0)
						                @foreach($price_list as $list)
						                  <tr>
						                    <td>
						                      <select name="number_of_item" id="number_{{$list->id}}">
						                        @for($i=0; $i<=10; $i++)
						                          <option value="{{$i}}">{{$i}}</option>
						                        @endfor
						                      </select>
						                    </td>
						                    <td id="item_{{$list->id}}">{{$list->item}}</td>
						                    <td id="price_{{$list->id}}">{{$list->price}}</td>
						                    <td><button type="button" class="btn btn-primary btn-xs" onclick="add_id({{$list->id}})" id="btn_{{$list->id}}">Add</button></td>
						                  </tr>
						                @endforeach
						              @else
						                <tr><td>No Data</td></tr>
						              @endif
						                </tbody>
						              </table>
						            </div>
						            <div class="modal-footer">
						              <button type="button" class="btn btn-default" id="modal-close">Save Changes</button>
						            </div>
						          </div>

						        </div>
						      </div>
						      <input type="hidden" name="list_items_json" id="list_items_json"></input>
		                	</form>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#order_type').change(function(){
	      if ($('#order_type').val() == 0) 
	      {
	        $('#myModal').modal('show');
	      }
	      else
	      {
	        $('#myModal').modal('hide');
	      }
	     });
		//generating address of user and school
		$('#cus_email').change(function(){
			if ($.trim($('#cus_email').val()) != null) 
			{
				//console.log($('#cus_email').val());
				//return;
				if('{{count($users)}}' > 0) {
					//console.log('{{count($users)}}')
					@foreach($users as $user)
						while ('{{$user->user_details->user_id}}' == $('#cus_email').val()) {
							//console.log('{{$user->user_details->address}}');
							//console.log('{{$user->user_details->school_id}}');
							//populatingg address field
							if ($.trim('{{$user->user_details->address}}') != null) 
							{
								$('#user_add').val('{{$user->user_details->address}}');
							}
							else
							{
								return;
							}
							//populate school donation
							if ($.trim('{{$user->user_details->school_id}}') != null) 
							{

								$('#schoolNameDropDown').val('{{$user->user_details->school_id}}');
							}
							else
							{
								return;
							}
							return;
						}
					@endforeach
				}		    		
				else {
					return;
				}
									    	
			}
			else
			{
				return;
			}
		});
		var todays_date=  $.datepicker.formatDate('mm/dd/yy', new Date());
     	$('#datepicker').val(todays_date);
     	$( "#datepicker" ).datepicker();
     	$('#modal-close').click(function(){
	        if($('#list_items_json').val() == '')
	        {
	          sweetAlert("Oops...", "You can't request a Detailed Pickup without selecting any item", "warning");
	          $('#myModal').modal('hide');
	          $('#order_type>option:eq(0)').prop('selected', true);
	          return;
	        }
        	$('#myModal').modal('hide');
        	swal("Success!", "Your items are select now please place an order", "success");
     	});
  	});

  jsonArray = [];

  function add_id(id) {
     if ($('#number_'+id).val() > 0) 
     {
        if ($('#btn_'+id).text() == "Add") 
        {
          $('#btn_'+id).text("Remove");
          $('#number_'+id).prop('disabled', true);
          list_item = {};
          list_item['id'] = id;
          list_item['number_of_item'] = $('#number_'+id).val();
          list_item['item_name'] = $('#item_'+id).text();
          list_item['item_price'] = $('#price_'+id).text();
          jsonArray.push(list_item);
          jsonString = JSON.stringify(jsonArray);
          $('#list_items_json').val(jsonString);
        }
        else
        {
          $('#btn_'+id).text("Add");
          $('#number_'+id).prop('disabled', false);
          for(var j=0; j< jsonArray.length; j++) {
            if (jsonArray.length > 1) 
            {
              if (jsonArray[j].id == id) 
              {
                jsonArray.splice(j,j);
                jsonString = JSON.stringify(jsonArray);
              }
            }
            else
            {
              jsonArray = [];
              $('#list_items_json').val('');
            }
            
          }
          //jsonString = JSON.stringify(jsonArray);
          $('#list_items_json').val(jsonString);
        }
     }
     else
     {
        sweetAlert("Oops...", "Please select atleast one item", "error");
     }
  }
  $('#schoolNameDropDown').hide();
  $('#schoolDonationAmount').hide();
  function openCheckBoxSchool()
  {
    $('#schoolNameDropDown').toggle();
  }
</script>
@endsection