@extends('staff.layouts.master')
@section('content')
<div id="wrapper">
   <div id="page-wrapper">
      <div class="container-fluid">
         <div class="row">
            @if(Session::has('fail'))
            <div class="alert alert-danger"><i class="fa fa-warning" aria-hidden="true"></i> <strong>Error!</strong> {{Session::get('fail')}}
               <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @else
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>Success!</strong> {{Session::get('success')}}
               <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @else
            @endif
            <div class="alert alert-warning" style="display: none;" id="conf_msg">
              <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Now You can charge this card all the details are filled up! click on make payment to charge this card.Reset to clear.
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            {{ Session::forget('fail') }}
            {{ Session::forget('success') }}
            <div class="col-lg-12">
               <div class="row">
                  <div class="col-md-3">
                     <h2>Charge a card</h2>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              Make Payments
                              <button type="button" id="set_account" class="btn btn-primary btn-xs" style="float: right;" data-toggle="modal" data-target="#myModal">Set Up Account</button>
                              <button type="button" id="show_customers_card" class="btn btn-primary btn-xs" style="float: right; margin-right: 1%;" data-toggle="modal" data-target="#modalCustomrs">Show Clients</button>
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
                                          <label>Amount</label>
                                          <input type="number" class="form-control" name="amount" required="" placeholder="chargable amount" id="amount" step="any"></input>
                                       </div>
                                       <button type="submit" class="btn btn-outline btn-primary" id="make_payment">Make Payment</button>
                                       <button type="button" class="btn btn-outline btn-primary" id="reset_btn" onclick="flushData()">Reset</button>
                                       <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
                                       <input type="hidden" id="isValidCard"></input>
                                       <input type="hidden" name="pick_up_re_id" id="pick_up_re_id"></input>
                                       <input type="hidden" name="i_m_staff" value="1"></input>
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
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /#page-wrapper -->
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
             <input type="hidden" name="i_m_staff" value="1"></input>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="modalCustomrs" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-list" aria-hidden="true"></i> Pending Customer List with card info:</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Client ID:</th>
              <th>Order ID:</th>
              <th>Client Email:</th>
              <th>Card Number</th>
              <th>cvv</th>
              <th>Expiry Date (yyyy-mm)</th>
              <th>Chargable Amount</th>
              <th>Charge It</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user_details as $user)
              <tr>
                <td>{{$user->user->id}}</td>
                <td>{{$user->id}}</td>
                <td>{{$user->user->email}}</td>
                <td><?php
                $card_info = \App\CustomerCreditCardInfo::where('user_id', $user->user_id)->first();
                ?>{{substr_replace($card_info->card_no, str_repeat("*", 8), 4, 8)}}</td>
                <td>{{$card_info->cvv !=null ? $card_info->cvv: "No cvv" }}</td>
                <td>20{{$card_info->exp_year}}-{{$card_info->exp_month}}</td>
                <td id="amount_{{$user->id}}">{{number_format((float)$user->total_price, 2, '.', '') == 0.00 ? "Invoice Is Not Created Yet" : number_format((float)$user->total_price, 2, '.', '')}}</td>
                <td><button type="button" id="charge_{{$user->id}}" class="btn btn-warning btn-xs" onclick="charge_it('{{$user->user->id}}', '{{$user->id}}')"><i class="fa fa-credit-card" aria-hidden="true"></i> Charge It</button></td>
              </tr>
            @endforeach
          </tbody>
      </table>
      </div>
      <div class="modal-footer">
        
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
      	if ($('#isValidCard').val() == 0 && $('#exp_date').val() && $('#amount').val()) 
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
      function MarkAsPaid(id) {
        //alert(id);
        $.ajax({
          url:"{{route('postMarkAsPaid')}}",
          type: "POST",
          data: {pick_up_req_id : id, _token: "{{Session::token()}}"},
          success: function(data) {
            //console.log(data);
            //return false;
            if (data == 1) 
            {
              location.reload();
            }
            else
            {
              sweetAlert("Oops...", "Something went wrong cannot mark as paid", "error");
              return false;
            }
          }
        });
      }
      $(function() {
        $("#exp_date").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: 'yy-mm'
        });
      });
      function charge_it(id, oid) {
        //alert(id)
        $('#modalCustomrs').modal('hide');
        $.ajax({
          url: "{{route('postGetCustomerCreditCard')}}",
          type: "POST",
          data: {id: id, _token: "{{Session::token()}}"},
          success: function(data) {
            $('#card_no').val(data.card_no);
            $('#exp_date').val("20"+data.exp_year+"-"+data.exp_month);
            $('#amount').val($('#amount_'+oid).text());
            $('#pick_up_re_id').val(oid);
            $('#conf_msg').show();
            return;
          }
        });
      }
      function flushData() {
        $('#card_no').val('');
        $('#exp_date').val('');
        $('#amount').val('');
        $('#conf_msg').hide();
        return;
      }
</script>
@endsection