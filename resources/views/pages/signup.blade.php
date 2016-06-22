@extends('pages.layouts.master')
@section('content')
<div class="main-content login-signup">
   <div class="container">
      <div class="row signup login">
         <div class="col-md-12">
            <h2>Customer Registration</h2>
            	@if(Session::has('fail'))
		        <div class="alert alert-danger">{{Session::get('fail')}}
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
            <h3>Individual Clients</h3>
            <p class="reg-heading">We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery.</p>
            <p class="signup-link">NOTE: If you already have an account with us, please login at the <a href="{{route('getLogin')}}">login page</a>.</p>
            <form class="form-inline" action="{{route('postSignUp')}}" method="post" onsubmit="return PassWordCheck();">
               <div class="col-md-6 individual-form">
                  <h4>Login Info:</h4>
                  <div class="form-group">
                     <label for="exampleInputuname1">Email</label>
                     <input type="email" class="form-control" id="exampleInputuname1" name="email" required="">
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" id="password" name="password" required="" onkeyup="return PassWordCheck();">
                  </div>
                  <div class="form-group">
                     <label for="conf_password">Confirm Password</label>
                     <input type="password" class="form-control" id="conf_password" name="conf_password" required="" onkeyup="return PassWordCheck();">
                  </div>
                  <div id="passcheck"></div>
               </div>
               <div class="col-md-6 individual-form">
                  <h4>Personal Info:</h4>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" required="" >
                  </div>
                  <div class="form-group">
                     <label for="address">Address</label>
                     <textarea class="form-control" rows="10" name="address" required=""></textarea>
                  </div>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <input type="number" class="form-control" id="Phone" placeholder="Format: 5555555555" name="personal_phone" required="">
                  </div>
                  <div class="form-group">
                     <label for="cellphone">Cell Phone (optional)</label>
                     <input type="number" class="form-control" id="cellphone" placeholder="Format: 5555555555" name="cell_phone">
                  </div>
                  <div class="form-group">
                     <label for="officephone">Office Phone (optional)</label>
                     <input type="number" class="form-control" id="officephone" placeholder="Format: 5555555555" name="office_phone">
                  </div>
               </div>
               <div class="clear50"></div>
               <div class="col-md-6 individual-form">
                  <h4>Special Instructions:</h4>
                  <p>We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions. Unless otherwise noted pick-up will be at addressed listed above.</p>
                  <div class="form-group">
                     <label for="address">Default Special Instructions (optional)</label>
                     <textarea class="form-control" rows="10" name="spcl_instruction"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="address">Default Driving Instructions (optional)</label>
                     <textarea class="form-control" rows="10" name="driving_instruction"></textarea>
                  </div>
               </div>
               <div class="col-md-6 individual-form">
                  <h4>Credit Card Info:</h4>
                  <p>It is corporate policy to use our services we must have a credit card on file. You may choose another form of payment but for security purposes we need your credit info. Your credit card is NOT being charged at this time and is only being kept on file for security purposes.</p>
                  <div class="form-group">
                     <label for="cardholder">Card Holder Name</label>
                     <input type="text" class="form-control" id="cardholder" name="cardholder_name" required="">
                  </div>
                  <div class="form-group">
                     <label for="cardholder">Card Type</label>
                     <select class="form-control" id="cardtype" name="cardtype" required="">
                        <option>Select Card Type</option>
                        <option value="Visa">Visa</option>
                        <option value="AmericanExpress">Master Card</option>
                        <option value="Mastercard">American Express</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="cardnumber">Credit Card Number</label>
                     <input type="text" class="form-control" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();">
                      <p class="log"></p>
                     <em>[ Please do not enter spaces or hyphens (-) ]</em>
                  </div>
                  <div class="form-group">
                     <label for="cvv">CVV2 (optional)</label>
                     <input type="text" class="form-control" id="cvv" name="cvv">
                     <em>[ CVV2 is a 3-digit value at the end of your account number printed on the back of your credit card. On American Express cards, CVV2 number consists of 3-4 digits located on the front of the card.]</em>
                  </div>
                  <div class="form-group">
                     <label for="cardholder">Expiration Date</label>
                     <select class="form-control expiration" id="select_month" name="select_month" required="">
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
                     <select class="form-control expiration" id="select_year" name="select_year" required="">
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
               </div>
               <div class="clear50"></div>
               <button type="submit" class="btn btn-default">Create Free Account</button>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
               <p class="offer">Referrals - 10 percent discount on your next order if you refer a friend.</p>
            </form>
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