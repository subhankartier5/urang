@extends('pages.layouts.user-master')
@section('content')
<style type="text/css">
	.alert_manage {
		width: 52%;
	    margin-left: 23%;
	    text-align: center;
	}
</style>
<div class="main-content login-signup">
   <div class="container">
      <div class="row signup login">
         <div class="col-md-12">
            <h2>Change Password</h2>
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
            <form class="form-inline" action="#" method="post" onsubmit="return checkValidPassword();">
               <div class="col-md-12 individual-form">
                  <h4>Change Password:</h4>
                  <div class="form-group">
                     <label for="old_password">Old Password</label>
                     <input type="text" class="form-control" id="old_password" name="old_password" required="">
                  </div>
                  <div class="form-group">
                     <label for="new_password">New Password</label>
                     <input type="text" class="form-control" id="new_password" name="new_password" required="" onkeyup="return checkValidPassword();">
                  </div>
                  <div class="form-group">
                     <label for="conf_password">Confirm New Password</label>
                     <input type="text" class="form-control" id="conf_password" name="conf_password" required="" onkeyup="return checkValidPassword();">
                  </div>
                  <div class="alert alert-danger alert_manage" id="danger" style="display: none;"></div>
                  <div class="alert alert-success alert_manage" id="success" style="display: none;"></div>
                  <button type="submit" name="btn_change_password" class="btn btn-default">Change Password</button>
                  <input type="hidden" name="_token" value="{{Session::token()}}" />
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	function checkValidPassword() {
		var new_password = $('#new_password').val();
		var conf_password = $('#conf_password').val();
		//console.log(new_password);
		//console.log(conf_password);
		//return false;
		if (new_password.length >= 6)
		{
			if (new_password && conf_password && new_password==conf_password) 
			{
				$('#success').html('<i class="fa fa-check" aria-hidden="true"></i> Success! Password and confirm password matched <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
				$('#success').show();
				$('#danger').hide();
				return true;
			}
			else
			{
				$('#danger').html('<i class="fa fa-times" aria-hidden="true"></i> Password and confirm password should be same <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
				$('#danger').show();
				$('#success').hide();
				return false;
			}
		}
		else
		{
			$('#danger').html('<i class="fa fa-times" aria-hidden="true"></i> Password should atleast be 6 charecters <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
			$('#danger').show();
			$('#success').hide();
			return false;
		}
	}
</script>
@endsection