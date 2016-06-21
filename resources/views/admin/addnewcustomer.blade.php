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
		                	<form role="form" action="{{route('postAddNewCustomer')}}" method="post" id="add_customer" onsubmit="return PassWordCheck();">
								<div class="form-group">
								    <label>Customer Name</label>
								    <input class="form-control" name="name" type="text" required="">
								</div>
								<div class="form-group">
								    <label>Customer Email</label>
								    <input class="form-control" name="email" type="email" required="">
								</div>
								<div class="form-group">
								    <label>password</label>
								    <input class="form-control" id="password" name="password" type="password" required="" onkeyup="return PassWordCheck();">
								</div>
								<div class="form-group">
								    <label>Confirm Password</label>
								    <input class="form-control" id="conf_password" name="conf_password" type="password" required="" onkeyup ="return PassWordCheck();">
								</div>
								<div id="passcheck"></div>
								<div class="form-group">
								    <label>Customer Address</label>
								    <textarea class="form-control" name="address" required=""></textarea>
								</div>
								<div class="form-group">
								    <label>Personal Phone Number</label>
								    <input class="form-control" name="personal_ph" type="text" required="">
								</div>
								<div class="form-group">
								    <label for="name">Cell Phone Number (optional)</label>
								    <input class="form-control" name="cellph_no" type="text">
								</div>
								<div class="form-group">
								    <label for="name">Office Phone Number (optional)</label>
								    <input class="form-control" name="officeph_no" type="text">
								</div>
								<div class="form-group">
								    <label for="name">Special Instructions (optional)</label>
								    <textarea class="form-control" name="spcl_instruction"></textarea>
								</div>
								<div class="form-group">
								    <label for="name">Driving Instructions (optional)</label>
								    <textarea class="form-control" name="driving_instructions"></textarea>
								</div>
								<label style="color: red;">*Customer Credit Card Details</label>
								<div class="form-group">
								    <label for="name">Name on Card</label>
								    <input type="text" class="form-control" id="card_name" name="card_name" required="" />
								</div>
								<div class="form-group">
								    <label for="name">Card Type</label>
								    <select class="form-control" id="cardType" name="cardType" required="">
								    	<option value="">Select Card Type</option>
								    	<option value="Visa">Visa</option>
								    	<option value="AmericanExpress">American Express</option>
								    	<option value="Mastercard">Mastercard</option>
								    </select>
								</div>
								<div class="form-group">
								    <label for="name">Card No</label>
								    <input type="text" class="form-control" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();" />
								    <p class="log"></p>
								</div>
								<div class="form-group">
								    <label for="name">Cvv (optional)</label>
								    <input type="text" class="form-control" id="cvv" name="cvv"/>
								</div>
								<div class="form-group">
								    <label for="name">Expiration Date</label>
								    	<select id="SelectMonth" name="SelectMonth" required="">
								    		<option value="">Select Month</option>
								    		<option value="01">January</option>
								    		<option value="02">February</option>
								    		<option value="03">March</option>
								    		<option value="04">April</option>
								    		<option value="05">May</option>
								    		<option value="06">June</option>
								    		<option value="07">July</option>
								    		<option value="08">August</option>
								    		<option value="09">September</option>
								    		<option value="10">October</option>
								    		<option value="11">November</option>
								    		<option value="12">December</option>
								    	</select>
								    	<select id="selectYear" name="selectYear" required="">
								    		<option value="">Select Year</option>
								    		<option value="16">2016</option>
								    		<option value="17">2017</option>
								    		<option value="18">2018</option>
								    		<option value="19">2019</option>
								    		<option value="20">2020</option>
								    		<option value="21">2021</option>
								    		<option value="22">2022</option>
								    		<option value="23">2023</option>
								    		<option value="24">2024</option>
								    		<option value="25">2025</option>
								    		<option value="26">2026</option>
								    		<option value="27">2027</option>
								    		<option value="28">2028</option>
								    	</select>
								   
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
								<input type="hidden" name="_token" value="{{Session::token()}}"></input>
		                	</form>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var err;
		function PassWordCheck() {
			//password and confirm password match function
			var password = $('#password').val();
			var status='';
			var conf_password = $('#conf_password').val();
			if (password && password.length >= 6) 
			{
				if (password && conf_password) 
				{
					if (password == conf_password) 
					{
						$('#passcheck').html('<div style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> password and confirm password matched!</div>');
						creditCardValidate();
						if(err==0)
						{
						return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						$('#passcheck').html('<div style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password did not match!</div>');
						return false;
					}
				}
				else
				{
					$('#passcheck').html('<div style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password should be same.</div>');
					return false;
				}
			}
			else
			{
				$('#passcheck').html('<div style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> password should atleast be 6 charecters.</div>');
				return false;
			}
		}
		function creditCardValidate(){
			$('#card_no').validateCreditCard(function(result) {
				err=0
				if (result.valid && result.length_valid && result.luhn_valid) 
				{
					err=0;
					$('.log').html('<div style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number</div>');
					
					//return err;
				}
				else
				{
					err=1;
					$('.log').html('<div style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number</div>');
					//return err;
					
				}
				
        	});
		}
	</script>
@endsection