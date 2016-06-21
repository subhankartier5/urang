@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-heading">
	         	<h1>Edit Details</h1>
	        </div>
	        <div class="panel-body">
	        	<div class="row">
	                <div class="col-lg-12">
	                	<form role="form" action="{{route('postEditCustomer')}}" method="post">
	                		@if($user != null)
							    <div class="form-group">
								    <label for="name">Customer ID</label>
								    <input class="form-control" id="id" name="id" type="text" readonly="" value="{{$user->id}}">
								</div>
								<div class="form-group">
								    <label for="name">Customer Name</label>
								    <input class="form-control" id="name" name="name" type="text" required="" value="{{$user->user_details != null ? $user->user_details->name : 'No data Exist '}}">
								</div>
								<div class="form-group">
								    <label for="name">Customer Email</label>
								    <input class="form-control" id="email" name="email" type="email" required="" value="{{$user->email}}">
								</div>
								<div class="form-group">
								    <label for="name">Customer Address</label>
								    <textarea class="form-control" id="address" name="address" required="">{{$user->user_details != null ? $user->user_details->address : 'No data Exist '}}</textarea>
								</div>
								<div class="form-group">
								    <label for="name">Personal Phone Number</label>
								    <input class="form-control" id="pph_no" name="pph_no" type="number" required="" value="{{$user->user_details != null ? $user->user_details->personal_ph : 'No data Exist '}}">
								</div>
								<div class="form-group">
								    <label for="name">Cell Phone Number (optional)</label>
								    <input class="form-control" id="cph_no" name="cph_no" type="number" value="{{$user->user_details != null ? $user->user_details->cell_phone : 'No data Exist '}}">
								</div>
								<div class="form-group">
								    <label for="name">Office Phone Number (optional)</label>
								    <input class="form-control" id="oph_no" name="oph_no" type="number" value="{{$user->user_details != null ? $user->user_details->off_phone : 'No data Exist '}}">
								</div>
								<div class="form-group">
								    <label for="name">Special Instructions (optional)</label>
								    <textarea class="form-control" id="spcl_instruction" name="spcl_instruction">{{$user->user_details != null ? $user->user_details->spcl_instructions : 'No data Exist '}}</textarea>
								</div>
								<div class="form-group">
								    <label for="name">Driving Instructions (optional)</label>
								    <textarea class="form-control" id="driving_instructions" name="driving_instructions">{{$user->user_details != null ? $user->user_details->driving_instructions : 'No data Exist '}}</textarea>
								</div>
								<label style="color: red;">*Customer Credit Card Details</label>
								<div class="form-group">
								    <label for="name">Name on Card</label>
								    <input type="text" class="form-control" id="card_name" name="card_name" required="" value="{{$user->card_details != null ? $user->card_details->name : 'No data exist' }}" />
								</div>
								<div class="form-group">
								    <label for="name">Card Type</label>
								    <select class="form-control" id="cardType" name="cardType">
								    	<option value="">Select Card Type</option>
								    	<option value="Visa">Visa</option>
								    	<option value="AmericanExpress">American Express</option>
								    	<option value="Mastercard">Mastercard</option>
								    </select>
								</div>
								<div class="form-group">
								    <label for="name">Card No</label>
								    <input type="text" class="form-control" id="card_no" name="card_no" required="" value="{{$user->card_details != null ? $user->card_details->card_no : 'No data exist' }}" /></input>
								</div>
								<div class="form-group">
								    <label for="name">Cvv (optional)</label>
								    <input type="text" class="form-control" id="cvv" name="cvv" value="{{$user->card_details != null ? $user->card_details->cvv : 'No data exist' }}" />
								</div>
								<div class="form-group">
								    <label for="name">Expiration Date</label>
								    	<select id="SelectMonth" name="SelectMonth">
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
								    	<select id="selectYear" name="selectYear">
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
							@else
	                			No Such Data
	                		@endif
	                	</form>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		if ('{{$user->card_details}}') 
		{
			var SelectCardType = $.trim('{{$user->card_details->card_type}}');
			var SelectMonth = $.trim('{{$user->card_details->exp_month}}');
			var SelectYear = $.trim('{{$user->card_details->exp_year}}');
			//console.log(SelectMonth);
			//console.log(SelectYear);
			//console.log(SelectCardType);
			$('#cardType').val(SelectCardType);
			$('#selectYear').val(SelectYear);
			$('#SelectMonth').val(SelectMonth);
		}
		else
		{
			$('#cardType').val("");
			$('#selectYear').val("");
			$('#SelectMonth').val("");
		}
	});
</script>
@endsection