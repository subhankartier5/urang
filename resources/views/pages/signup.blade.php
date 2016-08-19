@extends('pages.layouts.master-black')
@section('content')
   <div class="register-page">
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
          <div class="form2">
            <!--<form class="register-form" role="form" method="post" action="register.php">
              <input type="text" placeholder="name"/>
              <input type="password" placeholder="password"/>
              <input type="text" placeholder="email address"/>
              <button>create</button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>-->
            <form class="login-form" role="form2" method="post" action="{{route('postSignUp')}}">
                <h2>Customer Registration</h2>
                <h3>Individual Clients</h3>
                <p class="message">We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery. </p>
                <span class="required">NOTE:</span> If you already have an account with us, please login at the <a href="{{route('getLogin')}}">login page.</a>
                <span class="warning" style="padding-left:18px;" align="left">
                <span class="warning" style="padding-left:18px;" align="left">
                <span class="warning" style="padding-left:18px;" align="left">
                <div style="height: 40px;"></div>
                <table>
                    <tr>
                        <td>
                        <tr>
                            <td width="169">Today's Date:</td>
                            <td width="443"><?= date('l,');?>&nbsp;<?= date('F d, Y');?></td>
                        </tr>
                         <div style="height: 40px;"></div>
                        <tr>
                            <td>Email: <span style="color: red;">*</span></td>
                            <td>
                                <input type="email" id="email" name="email" style="width:270px;" onkeyup="return IsValidEmail();" value="{{old('email')}}">
                                <div id="emailExist"></div>
                                <div id="errorInputEmail" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password: <span style="color: red;">*</span></td>
                            <td>
                                <input type="password"  id="password" name="password" style="width:270px;" onkeyup="return PassWordCheck();">
                                <div id="errorInputPassword" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password: <span style="color: red;">*</span></td>
                            <td>
                                <input type="password"  id="conf_password" name="conf_password" style="width:270px;" onkeyup="return PassWordCheck();">
                                <div id="errorInputConfPassword" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                           <td></td>
                           <td>
                              <div id="passcheck"></div>
                           </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="page_sub_heading" style="height:50px;" valign="bottom">Personal Info:</td>
                        </tr>
                        <tr>
                            <td>
                                Name: <span style="color: red;">*</span>
                            </td>
                            <td>
                                <input type="text" id="name" name="name" style="width:270px;" value="{{old('name')}}" onkeyup="$('#name').attr('style', 'width:270px;'); $('#errorInputName').html('');">
                                <div id="errorInputName" style="color: red;"></div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Address: <span style="color: red;">*</span>
                            </td>
                            <td>
                              <textarea cols="30" rows="3"  id="txtAddress" name="address" onkeyup="$('#txtAddress').attr('style', 'width:270px;'); $('#errorInputAddress').html('');">{{old('address')}}</textarea>
                              <div id="errorInputAddress" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone: <span style="color: red;">*</span></td>
                            <td>
                                <input type="number" id="Phone" placeholder="Format: 5555555555" name="personal_phone" value="{{old('personal_phone')}}" onkeyup="$('#Phone').attr('style', 'width:270px;'); $('#errorInputPhone').html('');" />
                                <div id="errorInputPhone" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cell phone (optional):</td>
                            <td>
                                <input type="number" id="cellphone" placeholder="Format: 5555555555" name="cell_phone" value="{{old('cell_phone')}}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Office phone (optional):</td>
                            <td>
                                <input type="number" id="officephone" placeholder="Format: 5555555555" name="office_phone" value="{{old('office_phone')}}" />
                            </td>
                        </tr>
                        <tr><td colspan="2" class="page_sub_heading" style="height:50px;" valign="bottom">Special Instructions:</td></tr>
                        <tr>
                            <td colspan="2">
                                We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.  Unless otherwise noted pick-up will be at addressed listed above.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Default Special Instructions (optional):
                            </td>
                            <td>
                                <textarea  cols="30" rows="3" name="spcl_instruction" style="margin-top: 10px;">{{old('spcl_instruction')}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Default Driving Instructions (optional):
                            </td>
                            <td>
                                <textarea  cols="30" rows="3" name="driving_instruction" style="margin-top: 10px;">{{old('driving_instruction')}}</textarea>
                            </td>
                        </tr>
                        <tr><td colspan="2" class="page_sub_heading" style="height:50px;" valign="bottom">Credit Card Info:</td></tr>
                        <tr>
                            <td colspan="2">
                                It is corporate policy to use our services we must have a credit card on file. You may choose another form of payment but for security purposes we need your credit info. <strong>Your credit card is NOT being charged at this time and is only being kept on file for security purposes.</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Card Holder Name: <span style="color: red;">*</span></td>
                            <td>
                                <input type="text" style="width:270px;" id="cardholder" name="cardholder_name"  value="{{ old('cardholder_name') }}" onkeyup="$('#cardholder').attr('style', 'width:270px;'); $('#errorInputCardHolder').html('');" >
                                <div id="errorInputCardHolder" style="color: red;"></div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Card Type</td>
                            <td>
                              <select id="cardtype" name="cardtype" required="" value="{{old('cardtype')}}">
                                    <option value="">Select Card Type</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Mastercard">Master Card</option>
                                    <option value="AmericanExpress">American Express</option>
                              </select>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Credit Card No: <span style="color: red;">*</span></td>
                            <td>
                                <input type="text" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();" style="width:270px;" value="{{old('card_no')}}">
                                <div id="errorInputCardNo" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                           <td></td>
                           <td>
                              <p class="log"></p>
                           </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="required">
                                [ Please do not enter spaces or hyphens (-) ] 
                            </td>
                        </tr>
                        <tr>
                            <td>CVV2 (optional):</td>
                            <td>
                                <input type="text"  id="cvv" name="cvv" maxlength="4" size="10" value="{{old('cvv')}}">
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="required">
                                [ CVV2 is a 3-digit value at the end of your account number printed on the back of your credit card. On American Express cards, CVV2 number consists of 3-4 digits located on the front of the card.] 
                            </td>
                        </tr>
                        <tr>
                            <td>Expiration Date: <span style="color: red;">*</span></td>
                              <td>
                                <select id="select_month" name="select_month" onchange="$('#select_month').removeAttr('style'); $('#errorInputDate').html('');">
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
                            </td>
                            <td>
                                <select id="select_year" name="select_year" onchange="$('#select_year').removeAttr('style'); $('#errorInputDate').html('');">
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
                           </td>
                           <td>
                             <div id="errorInputDate" style="color: red;"></div>
                           </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;">
                                Referrals - 10 percent discount on your next order if you refer a friend.
                            </td>
                        </tr>
                        <tr>
                          <td>Tell Us the Referer Name (optional) :</td>
                          <td><input type="text" name="ref_name" value="{{old('ref_name')}}"></input></td>
                        </tr>
                </table>
                <button type="submit" style="margin-top: 10px" onclick="IsValid(event);">Sign Up</button>
                <input type="hidden" name="_token" value="{{Session::token()}}"></input>
                <input type="hidden" id="email_checker"></input>
                <input type="hidden" id="card_no_checker"></input>
            </form>
          </div>
        </div>
<script>
    var err;
    function PassWordCheck() {
       //password and confirm password match function
       $('#password').attr('style', 'width: 270px;');
       $('#conf_password').attr('style', 'width: 270px;')
       $('#errorInputPassword').html("");
       $('#errorInputConfPassword').html("");
       var password = $('#password').val();
       var status='';
       var conf_password = $('#conf_password').val();
       if (password && password.length >= 6) 
       {
          if (password && conf_password) 
          {
             if (password === conf_password) 
             {
                $('#passcheck').html('<br><div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> password and confirm password matched! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                   return true;
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
                $('#passcheck').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password did not match! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                return false;
             }
          }
          else
          {
             $('#passcheck').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password should be same. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
             return false;
          }
       }
       else
       {
          $('#passcheck').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> password should atleast be 6 charecters. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
          return false;
       }
    }
    function creditCardValidate(){
      $('#card_no').attr('style', 'width:270px;'); 
      $('#errorInputCardNo').html('');
       $('#card_no').validateCreditCard(function(result) {
          //err=0;
          if (result.valid && result.length_valid && result.luhn_valid) 
          {
             err=0;
             $('.log').html('<br><div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>');
             $('#card_no_checker').val(1);
             //return err;
          }
          else
          {
             err=1;
             $('.log').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
             //return err;
             $('#card_no_checker').val(0);
          }
          
       });
    }
    function IsValidEmail() {
       //return true;
       $('#email').attr('style', 'width: 270px');
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
    //form submit done by this
    function IsValid(event) {
       event.preventDefault();
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
            $('.login-form').submit();
          }
         else
         {
            //alert('some error occured form cannot be submitted');
            sweetAlert("Oops..", "Error Occured Hint: 1. make sure password and confirm password is same, 2. Email is available, 3. Credit card number is valid", "error");
            return false;
         }
       } else {
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