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
                	@if(count($errors) > 0)
			        <div class="alert alert-danger">
			        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			          <ul>
			            @foreach($errors->all() as $error)
			              <li>{{$error}}</li>
			            @endforeach
			          </ul>
			        </div>
			      @endif
		         	<h1>Add New Customer</h1>
		        </div>
		        <div class="panel-body">
		        	<div class="row">
		                <div class="col-lg-12">
		                	<form role="form" action="{{route('postAddNewCustomer')}}" method="post" id="add_customer">
								<div class="form-group">
								    <label>Customer Name</label>
								    <input class="form-control" name="name" type="text"  id="name" onkeyup="$('#name').removeAttr('style'); $('#errorInputName').html('');" value="{{old('name')}}">
								    <div id="errorInputName" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label>Customer Email</label>
								    <input class="form-control" id="email" name="email" type="email"  onkeyup="return IsValidEmail();" value="{{old('email')}}">
								    <div id="errorInputEmail" style="color: red;"></div>
								</div>
								<div class="form-group">
									<div id="emailExist"></div>
								</div>
								<div class="form-group">
								    <label>password</label>
								    <input class="form-control" id="password" name="password" type="password" onkeyup="return PassWordCheck();">
								    <div id="errorInputPassword" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label>Confirm Password</label>
								    <input class="form-control" id="conf_password" name="conf_password" type="password" onkeyup ="return PassWordCheck();">
								    <div id="errorInputConfPassword" style="color: red;"></div>
								</div>
								<div id="passcheck"></div>
								<div class="form-group">
								    <label>Customer Address</label>
								    <textarea class="form-control" name="address" id="txtAddress" onkeyup="$('#txtAddress').removeAttr('style', 'width:270px;'); $('#errorInputAddress').html('');">{{old('address')}}</textarea>
								    <div id="errorInputAddress" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label>Personal Phone Number</label>
								    <input class="form-control" name="personal_ph" id="Phone" type="number" onkeyup="$('#Phone').removeAttr('style', 'width:270px;'); $('#errorInputPhone').html('');" value="{{old('personal_ph')}}">
								    <div id="errorInputPhone" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label for="name">Cell Phone Number (optional)</label>
								    <input class="form-control" name="cellph_no" type="number" value="{{old('cellph_no')}}">
								</div>
								<div class="form-group">
								    <label for="name">Office Phone Number (optional)</label>
								    <input class="form-control" name="officeph_no" type="number" value="{{old('officeph_no')}}">
								</div>
								<div class="form-group">
								    <label for="name">Special Instructions (optional)</label>
								    <textarea class="form-control" name="spcl_instruction">{{old('spcl_instruction')}}</textarea>
								</div>
								<div class="form-group">
								    <label for="name">Driving Instructions (optional)</label>
								    <textarea class="form-control" name="driving_instructions">{{old('driving_instructions')}}</textarea>
								</div>
								<label style="color: red;">*Customer Credit Card Details</label>
								<div class="form-group">
								    <label for="name">Name on Card</label>
								    <input type="text" class="form-control" id="cardholder" name="card_name" onkeyup="$('#cardholder').removeAttr('style', 'width:270px;'); $('#errorInputCardHolder').html('');" value="{{old('card_name')}}" />
								    <div id="errorInputCardHolder" style="color: red;"></div>
								</div>
								<!-- <div class="form-group">
								    <label for="name">Card Type</label>
								    <select class="form-control" id="cardType" name="cardType" required="">
								    	<option value="">Select Card Type</option>
								    	<option value="Visa">Visa</option>
								    	<option value="AmericanExpress">American Express</option>
								    	<option value="Mastercard">Mastercard</option>
								    </select>
								</div> -->
								<div class="form-group">
								    <label for="name">Card No</label>
								    <input type="text" class="form-control" id="card_no" name="card_no" onkeyup="return creditCardValidate();" value="{{old('card_no')}}"/>
								    <p class="log"></p>
								    <div id="errorInputCardNo" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label for="name">Cvv (optional)</label>
								    <input type="number" class="form-control" id="cvv" name="cvv" value="{{old('cvv')}}" />
								</div>
								<div class="form-group">
								    <label for="name">Expiration Date</label>
								    	<select id="select_month" name="SelectMonth" onchange="$('#select_month').removeAttr('style'); $('#errorInputDate').html('');">
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
								    	<select id="select_year" name="selectYear" onchange="$('#select_year').removeAttr('style'); $('#errorInputDate').html('');">
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
								   <div id="errorInputDate" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label for="name">Reffered By (Optional)</label>
								    <input type="text" class="form-control" id="ref_name" name="ref_name" value="{{old('ref_name')}}" />
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block" onclick="IsValid(event);">Add</button>
								<input type="hidden" id="email_checker"></input>
								<input type="hidden" id="card_no_checker"></input>
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
		$('#password').removeAttr('style', 'width: 270px;');
	    $('#conf_password').removeAttr('style', 'width: 270px;')
	    $('#errorInputPassword').html("");
	    $('#errorInputConfPassword').html("");
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
		$('#card_no').removeAttr('style', 'width:270px;'); 
      	$('#errorInputCardNo').html('');
		$('#card_no').validateCreditCard(function(result) {
			err=0
			if (result.valid && result.length_valid && result.luhn_valid) 
			{
				err=0;
				$('.log').html('<div style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number</div>');
				$('#card_no_checker').val(1);
				//return err;
			}
			else
			{
				err=1;
				$('.log').html('<div style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number</div>');
				//return err;
				$('#card_no_checker').val(0);
			}
			
    	});
	}
	function IsValidEmail() {
       //return true;
       $('#email').removeAttr('style');
       $('#errorInputEmail').html("");
       var email = $('#email').val();
       var isValidEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if ($.trim(email)) 
       {
          //return isValidEmail.test(email);
          if (isValidEmail.test(email)) 
          {
             //$('#emailExist').html('');
             $.ajax({
                url : "{{route('postEmailChecker')}}",
                type: "POST",
                data: {email: email, _token: "{{Session::token()}}"},
                success : function(data){
                   //$('#email_checker').val(data);
                   //console.log(data);
                   //alert(data)
                   //return data;
                   //$('#emailExist').html(data);
                   //console.log("data :: "+data);
                   if (data == 1) 
                   {
                      $('#emailExist').html("<div class='alert alert-success'><i class='fa fa-check' aria-hidden='true'></i> Email address is available ! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
                      $('#email_checker').val(data);
                      return true;

                   }
                   else
                   {
                      $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Hold on! email already exists! try another one. <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
                      $('#email_checker').val(0);
                      return false;
                   }
                   //return data;
                }
             });
          }
          else
          {
             $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Not A Valid Email Address! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
             return false;
          }
       }
       else
       {
          $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Please Enter an Email Address! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
          return false;
       }
	}
	function IsValid(event) {
       event.preventDefault();
       //return;
       var email = $('#email').val();
       var password = $('#password').val();
       var conf_password = $('#conf_password').val();
       var name = $('#name').val();
       var add = $('#txtAddress').val();
       var phone = $('#Phone').val();
       var name_on_card = $('#cardholder').val();
       var card_number = $('#card_no').val();
       var month_val = $('#select_month').val();
       var year_val = $('#select_year').val();
       var pass_check=PassWordCheck();
       var email_check = $('#email_checker').val();
       var card_no_checker = $('#card_no_checker').val();
       if ($.trim(email) && $.trim(password) && $.trim(conf_password) && $.trim(name) && $.trim(add) && $.trim(phone) && $.trim(name_on_card) && $.trim(card_number) && $.trim(month_val) && $.trim(year_val)) 
       {
          if(pass_check && $.trim(email_check) == 1 && $.trim(card_no_checker) == 1)
          {
            $('#add_customer').submit();
          }
         else
         {
            //alert('some error occured form cannot be submitted');
            sweetAlert("Oops..", "Error Occured Hint: 1. make sure password and confirm password is same, 2. Email is available, 3. Credit card number is valid", "error");
            return false;
         }
       } else {
        //alert("these fields are req");
    	if (!email) 
    	{
    		$('#email').attr('style', 'border-color: red;');
      		$('#errorInputEmail').html("This Field is Required!");
    	}
    	if (!password) 
    	{
    		$('#password').attr('style', 'border-color: red;');
          	$('#errorInputPassword').html("This Field is Required!");
    	}
    	if (!conf_password) 
    	{
    		$('#conf_password').attr('style', 'border-color: red;');
          	$('#errorInputConfPassword').html("This Field is Required!");
    	}
       	  
       	if (!name) 
       	{
       	  	$('#name').attr('style', 'border-color: red;');
          	$('#errorInputName').html("This Field is Required!");
       	}
 		if (!add) 
 		{
 			$('#txtAddress').attr('style', 'border-color: red;');
          	$('#errorInputAddress').html("This Field is Required!");
 		}   
 		if (!phone) 
 		{
 			$('#Phone').attr('style', 'border-color: red;');
          	$('#errorInputPhone').html("This Field is Required!");
 		}      
 		if (!name_on_card) 
 		{
 			$('#cardholder').attr('style', 'border-color: red;');
          	$('#errorInputCardHolder').html("This Field is Required!");
 		}
 		if (!card_number) 
 		{
 			$('#card_no').attr('style', 'border-color: red;');
          	$('#errorInputCardNo').html("This Field is Required!");
 		}
 		if (!month_val) 
 		{
 			$('#select_month').attr('style', 'border-color:red;');
 			$('#errorInputDate').html("This Field is Required!");
 		}
        if (!year_val) 
        {
        	$('#select_year').attr('style', 'border-color:red;');
        	$('#errorInputDate').html("This Field is Required!");
        }
        return false;
       }
    } 
	</script>
@endsection