@extends('pages.layouts.user-master')
@section('content')
<div class="main-content nycpick">
<div class="fixed-div">
  <h2><label>Contact Us:</label> (800)959-5785</h2>
  <h2><label>Email-Id:</label> support@u-rang.com</h2>
  <div class="open-square"><i class="fa fa-comments-o" aria-hidden="true"></i> Support</div>
</div>
    <div class="container">
      <div class="row signup login">
        <div class="col-md-12">
          @if(Session::has('fail'))
            <div class="alert alert-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> {{Session::get('fail')}}
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
          <form class="form-inline form2" method="post" action="{{route('postPickUpReq')}}">
          <h2>NYC Pick-up</h2>
          <h3>Individual Clients</h3>
          <p class="reg-heading">We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery.</p>
              <h4>Schedule Pick-up - Regular Customer</h4>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="{{auth()->guard('users')->user()->email}}" readonly="">
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{auth()->guard('users')->user()->user_details->name}}" readonly="">
              </div>
              <div class="form-group">
                <label for="address">Pick-Up Address</label>
                <textarea class="form-control" rows="3" name="address" required="">   {{auth()->guard('users')->user()->user_details->address}} </textarea>
              </div>
              <div class="form-group">
                <label for="address_line_2">Address Line 2 (optional)</label>
                <textarea class="form-control" rows="3" name="address_line_2"></textarea>
              </div>
              <div class="form-group">
                <label for="apt_no">Apartment Number (if any optional)</label>
                <input type="text" name="apt_no" id="apt_no" placeholder="eg. 33b" class="form-control"></input>
              </div>
              <div class="form-group">
                <label for="address">Pick-Up Date</label>
                <div class='input-group date'>
                    <input type='text' class="form-control" id='datepicker' required="" name="pick_up_date" required="" />
                    <span class="input-group-addon">
                        <a href="#" class="calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                    </span>
                </div>
              </div>
            <div class="form-group schedule">
              <label for="schedule">Schedule</label>
              <div class="schedule-radio">
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio1" value="For the time specified only"> For the time specified only.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio2" value="Daily at this time except weekends"> Daily at this time except weekends.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio3" value="Daily at this time including weekends">  Daily at this time including weekends.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio4" value="Weekly on this day of the week">  Weekly on this day of the week.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio5" value="Monthly on this day of the month">  Monthly on this day of the month.
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>How Would You Like Your Shirts</label>
              <div class="checkbox">
                <label>
                  <input type="radio" name="boxed_or_hung" value="Boxed"> Boxed
              </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="radio" name="boxed_or_hung" value="Hung"> Hung
                </label>
              </div>
              <select name="strach_type" required="">
                <option value="No">No Starch</option>
                <option value="Very_light_starch">Very Light Starch</option>
                <option value="Light_starch">Light Starch</option>
                <option value="Medium_starch">Medium Starch</option>
                <option value="Heavy_starch">Heavy Starch</option>
              </select>
            </div>
            <div class="form-group">
              <label for="doorman">Doorman</label>
              <select name="doorman" id="doorman">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group" style="display: none;" id="time_frame">
              <label for="time_frame">Give Us a Time Frame</label>
              <input type="text" name="time_frame_start" id="time_frame_start" class="form-control" style="width: 25%" placeholder="Start time"></input> To
              <input type="text" name="time_frame_end" id="time_frame_end" class="form-control" style="width: 25%" placeholder="End time"></input>
            </div>
             <div class="form-group">
                <div class="checkbox checkbox-large">
                  <label>
                    <input type="checkbox" name="urang_bag"> Please tick this box if you need U-Rang bag.
                  </label>
              </div>
            </div>
            <p>We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.</p>
            <div class="clear50"></div>
            <div class="form-group">
                <label>Special Instructions</label>
                <textarea class="form-control" rows="3" name="spcl_ins"></textarea>
            </div>
            <div class="form-group">
                <label>Driving Instructions</label>
                <textarea class="form-control" rows="3" name="driving_ins"></textarea>
            </div>
            <div class="form-group schedule">
              <label for="schedule">How to pay </label>
              <div class="schedule-radio">
                <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio6" value="1" required=""> Charge my credit card this time for amount $ 
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio8" value="2"> COD
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio9" value="3"> Check
                </label>
              </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <select id="order_type" name="order_type" id="order_type" class="col-xs-5" required="">
                  <option value="">Type of order</option>
                  <option value="1">Fast Pickup</option>
                  <option value="0">Detailed Pickup</option>
                </select>
            </div>
            <div style="display: none;">
              <?php
                $price_list = \App\PriceList::all();
              ?>
            </div>
            <div class="form-group">
              <label for="wash_n_fold">Wash and fold?</label>
              <select name="wash_n_fold" id="wash_n_fold" required="">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="client_type">What type of client you are ?</label>
              <select name="client_type" id="client_type" required="">
                <option value="">Client Type</option>
                <option value="new_client">New Client</option>
                <option value="key_client">Key Client</option>
                <option value="corporate_client">Corporate Client</option>
                <option value="reff">Referral</option>
              </select>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-large">
                <label>
                  <input type="checkbox" name="isEmergency">
                Is it a emergency service ? <span style="color: red;">$7 extra</span>
                </label>
              </div>
            </div>
            <div class="form-group">
                <label>Do you have a coupon code ?<p style="color: red;">Please leave the field blank if you dont hav any.</p></label>
                <input type="text" name="coupon" id="coupon" class="form-control" />
            </div>
            <div class="form-group">
                <div class="checkbox checkbox-large">
                  <label>
                  <input onclick="openCheckBoxSchool()" id="school_checkbox" type="checkbox" name="isDonate">
                  Donate to a school in your neighborhood ?                  
                  </label>
                </div>
            </div>
            <div class="form-group">
                  <?php 
                  $school_list = \App\SchoolDonations::all();
                ?>
                <span>
                  <select name="school_donation_id" id="schoolNameDropDown">
                    <option value="">Select School</option>
                    @foreach($school_list as $school)
                    <option value="{{$school->id}}">{{$school->school_name}}</option>
                    @endforeach
                  </select>
                </span>
            </div>
               <button type="submit" class="btn btn-default">Schedule Pick up</button>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
            <p class="offer">Referrals - 10 percent discount on your next order if you refer a friend.</p>
            </div>
           
            
                  <!-- Modal -->
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
  <script type="text/javascript">
  $(document).ready(function(){
    $('#doorman').on('change', function(){
      var value = $(this).val();
      //console.log(value);
      if (value == 0) {
        //sweetAlert("now")
        $('#time_frame').show();
        $('#time_frame_start').timepicker({'step': 1});
        $('#time_frame_end').timepicker({'step': 1});
      } else {
        $('#time_frame').hide();
      }
    });
    $(".fixed-div").click(function(){

       $(this).toggleClass("open");

       if($(this).hasClass("open")){
         $( this ).animate({
            left: "0"
          }, 500, function() {
          });
        }
      else{
        $( this ).animate({
            left: "-275px"
          }, 500, function() {
          });
      }

    });

    //sweetAlert("Oops...", "Something went wrong!", "error");
      $('#schoolNameDropDown').val("{{auth()->guard('users')->user()->user_details->school_id}}");
      $( "#datepicker" ).datepicker();
      $( ".calendar" ).click(function(e) {
        e.preventDefault();
        $( "#datepicker" ).focus();
      });
      //alert('test')
     var todays_date=  $.datepicker.formatDate('mm/dd/yy', new Date());
     //alert(some);
     $('#datepicker').val(todays_date);
     //alert($('#order_type').val())
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