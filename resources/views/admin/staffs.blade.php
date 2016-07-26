@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               @if(Session::has('fail'))
                 <div class="alert alert-danger"><strong>Error!</strong> {{Session::get('fail')}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 </div>
               @else
               @endif
               @if(Session::has('success'))
                 <div class="alert alert-success"><strong>Success!</strong> {{Session::get('success')}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 </div>
               @else
               @endif
               <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_staff" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Staff</button>
               <p>Staffs</p>
            </div>
            <div class="panel-body">
               <div class="table-responsive table-bordered">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Email / Username</th>
                           <th>Block Status</th>
                           <th>Edit Details</th>
                           <th>Delete</th>
                           <th>Change Password</th>
                           <th>Created At</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($staff) > 0)
                        @foreach($staff as $one_staff)
                        <tr>
                           <td>{{$one_staff->id}}</td>
                           <td>{{$one_staff->user_name}}</td>
                           <td>
                              @if ($one_staff->active == 1) 
                                <button type="submit" id="btnBlock_{{$one_staff->id}}" class="btn btn-primary btn-xs" onclick="isBlock('{{$one_staff->id}}')"><i class="fa fa-ban" aria-hidden="true"></i> Block</button>
                              @else
                                <button type="submit" id="btnBlock_{{$one_staff->id}}" class="btn btn-primary btn-xs" onclick="isBlock('{{$one_staff->id}}')"><i class="fa fa-ban" aria-hidden="true"></i> unblock</button>
                              @endif
                           </td>
                           <td><button type="submit" id="btnEdit_{{$one_staff->id}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                           <td><button type="submit" id="btnDel_{{$one_staff->id}}" class="btn btn-danger btn-xs" onclick="DelRecord('{{$one_staff->id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
                           <td><button type="submit" id="btnCp_{{$one_staff->id}}" class="btn btn-warning btn-xs"><i class="fa fa-key" aria-hidden="true"></i> Change Password</button></td>
                           <td>{{ date("F jS Y",strtotime($one_staff->created_at->toDateString())) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                           <td>No Data</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
                  <span style="float: right;">{!!$staff->render()!!}</span>
               </div>
            </div>
         </div>
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
        <h4 class="modal-title">Add Staff</h4>
      </div>
      <div class="modal-body">
         <form role="form" method="post" action="{{route('postAddStaff')}}">
        <div class="form-group">
         <div class="alert alert-success" id="success" style="display: none;"></div>
             <div class="alert alert-danger" id="errordiv" style="display: none;"></div>
          <label for="email">Staff Email:</label>
          <input class="form-control" id="email" name="email" type="email" required="">
        </div>
        <div class="form-group">
          <label for="password">password</label>
          <input type="password" class="form-control" name="password" id="password" required="" />
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" id="addStaff">Add Staff</button>
        <input type="hidden" name="_token" value="{{Session::token()}}"></input>
      </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>

<!-- ModalEdit -->
<div id="myModalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Changes</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="{{route('postEditDetailsStaff')}}">
          <div class="form-group">
            <label for="email">Staff Email:</label>
            <input class="form-control" id="emailEdit" name="email" type="email" required="">
          </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block" id="editStaff">Save Staff</button>
        <input type="hidden" name="_token" value="{{Session::token()}}"></input>
        <input type="hidden" name="user_id" id="user_id"></input>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModalCp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="{{route('postChangeStaffPassword')}}" onsubmit="return CheckPassword()">
          <div class="form-group">
            <label for="new_pass">New Password</label>
            <input type="password" name="new_pass" id="new_pass" class="form-control" required="" onkeyup="return CheckPassword();"></input>
          </div>
          <div class="form-group">
            <label for="new_pass">Confirm New Password</label>
            <input type="password" name="con_new_pass" id="con_new_pass" class="form-control" required="" onkeyup="return CheckPassword();"></input>
          </div>
          <div class="form-group" id="passcheck"></div>
          <button type="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
          <input type="hidden" name="_token" value="{{Session::token()}}"></input>
          <input type="hidden" name="user_id" id="user_id1"></input>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
function isBlock(id) {
  //alert(id);
  $.ajax({
    url: "{{route('postIsBlock')}}",
    type: "POST",
    data: {id: id, _token: "{{Session::token()}}"},
    success: function(data) {
      //console.log(data);
      if (data == 1) 
      {
        location.reload();
      }
      else
      {
        sweetAlert("Oops...", "Some error occured please try again later", "error");
      }
    } 
  });
}
$(document).ready(function(){
  @foreach($staff as $one_staff)
    $('#btnEdit_{{$one_staff->id}}').click(function(){
      $('#myModalEdit').modal('show');
      $('#emailEdit').val("{{$one_staff->user_name}}");
      $('#user_id').val("{{$one_staff->id}}");
      return false;
    });
    $('#btnCp_{{$one_staff->id}}').click(function(){
      $('#myModalCp').modal('show');
      $('#user_id1').val('{{$one_staff->id}}');
      //alert('hi')
    });
  @endforeach
});
function DelRecord(id) {
  //alert(id);
  $.ajax({
    url: "{{route('postDelStaff')}}",
    type: "POST",
    data: {id: id, _token: "{{Session::token()}}"},
    success: function(data) {
      //console.log(data);
      if (data == 1) 
      {
        location.reload();
      }
      else
      {
        sweetAlert("Oops...", "Some error occured please try again later", "error");
      }
    } 
  });
}
function CheckPassword() {
  var password = $('#new_pass').val();
  //return false;
  var conf_password = $('#con_new_pass').val();
  if (password && conf_password) 
  {
    if (password.length >= 6 && conf_password.length >=6) 
    {
      if (password == conf_password) 
      {
        $('#passcheck').html("<div style='color:green;'>password and confirm password matched!</div>");
        return true;
      }
      else
      {
        $('#passcheck').html("<div style='color:red;'>password and confirm password did not match!</div>");
        return false;
      }
    }
    else
    {
      $('#passcheck').html("<div style='color:red;'>password should atleast be 6 charecters!</div>");
      return false;
    }
    
  }
  else
  {
    $('#passcheck').html("<div style='color:red;'>password and confirm password should be same and atleast be 6 charecters</div>");
    return false;
  }
}
</script>
@endsection