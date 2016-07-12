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
        	@if(Session::has('fail'))
        		<div class="alert alert-danger">
        			<i class="fa fa-warning" aria-hidden="true"></i>
        			<strong>Error!</strong> {{Session::get('fail')}}
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        		</div>
        	@else
        	@endif
            <h1 class="page-header">Charge a card</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Make Payments
                    <button type="button" id="set_account" class="btn btn-primary btn-xs" style="float: right;" data-toggle="modal" data-target="#myModal">Set Up Account</button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="{{ route('postPayment') }}" id="payment_form" onsubmit="return IsValid();">
                                <div class="form-group">
                                    <label>Card No:</label>
                                    <input class="form-control" type="text" name="card_no" required="" id="card_no" onkeyup="return creditCardValidate();" placeholder="card no" />
                                </div>
                                <div id="errorJs"></div>
                                <div class="form-group">
                                    <label>Expiration Date:</label>
                                    <input class="form-control" type="text" name="exp_date" required="" id="exp_date" placeholder="Format: yyyy-mm" />
                                </div>
                                <div class="form-group">
                                    <label>CVV:</label>
                                    <input class="form-control" type="number" name="cvv" id="cvv" required="" placeholder="cvv" />
                                </div>
                                <div class="form-group">
                                	<label>Amount</label>
                                	<input type="number" class="form-control" name="amount" required="" placeholder="chargable amount" id="amount"></input>
                                </div>
                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block" id="make_payment">Make Payment</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
                                <input type="hidden" id="isValidCard"></input>
                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
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
        <h4 class="modal-title">Set Up Account</h4>
      </div>
      <div class="modal-body">
      	<form role="form" action="{{route('postPaymentKeys')}}" method="post">
        	<div class="form-group">
        		<label for="Authorize_ID">Authorize ID:</label>
        		<input type="text" class="form-control" name="authorize_id" id="Authorize_ID" required=""></input>
        	</div>
        	<div class="form-group">
        		<label for="tran_key">Transaction Key:</label>
        		<input type="text" class="form-control" name="tran_key" id="tran_key" required=""></input>
        	</div>
        	<div class="form-group">
        		<label for="mode">Select Mode:</label>
	        	<select name="mode" class="form-control" required="" id="mode">
	        		<option value="">Select Mode</option>
	        		<option value="1">Live</option>
	        		<option value="0">Test</option>
	        	</select>
        	</div>
        	 <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block">Save Details</button>
             <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@if($payment_keys != null)
	<script type="text/javascript">
		$(document).ready(function(){
			if ("{{$payment_keys}}") 
			{
				$('#Authorize_ID').val('{{$payment_keys->login_id}}');
				$('#tran_key').val('{{$payment_keys->transaction_key}}');
				$('#mode').val('{{$payment_keys->mode}}');
			}
			else
			{
				return false;
			}
		});
	</script>
@endif
<script type="text/javascript">
	function creditCardValidate(){
         $('#card_no').validateCreditCard(function(result) {
            //err=0;
            if (result.valid && result.length_valid && result.luhn_valid) 
            {
               //err=0;
               $('#errorJs').html('<br><div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>');
               	$('#isValidCard').val('0');
               return true;
               //return err;
            }
            else
            {
               //err=1;
               $('#errorJs').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
               //return err;
               //return false;
               $('#isValidCard').val('1');
               return false;
            }
            
         });
      }
      function IsValid(){
      	//return false;
      	if ($('#isValidCard').val() == 0 && $('#exp_date').val() && $('#cvv').val() && $('#amount').val()) 
      	{
      		return true;
      	}
      	else
      	{
      		//alert('wrong')
      		sweetAlert("Oops...", "Wrong Credit Card Details", "error");
      		return false;
      	}
      }
</script>
@endsection