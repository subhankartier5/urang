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
		                	<form role="form" action="#" method="post">
								<div class="form-group">
								    <label>Select a Customer</label>
								    <select name="user_email" class="form-control" required="" id="cus_email">
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
								    <textarea class="form-control" name="address" required=""></textarea>
								</div>
								<div class="form-group">
								    <label>Pick up date</label>
								    <input class="form-control" name="pick_up_date" type="text" required="">
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
              					<button type="submit" class="btn btn-primary btn-lg btn-block">Schedule Pick up</button>
								<input type="hidden" name="_token" value="{{Session::token()}}"></input>
		                	</form>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		//alert('jhd')
	});
</script>
@endsection