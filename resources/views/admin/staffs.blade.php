@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
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
                              	<button type="submit" id="btnBlock_{{$one_staff->id}}" class="btn btn-primary btn-xs">Block</button>
                              @else
                              	<button type="submit" id="btnBlock_{{$one_staff->id}}" class="btn btn-primary btn-xs">unblock</button>
                              @endif
                           </td>
                           <td><button type="submit" id="btnEdit_{{$one_staff->id}}" class="btn btn-warning btn-xs">Edit</button></td>
                           <td><button type="submit" id="btnDel_{{$one_staff->id}}" class="btn btn-danger btn-xs">Delete</button></td>
                           <td>{{$one_staff->created_at}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                           <td>No Data</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection