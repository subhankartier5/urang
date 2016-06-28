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
	                	@if(Session::has('successUpdate'))
	                		<div class="alert alert-success">	                             	{{Session::get('successUpdate')}}
	                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                		</div>
	                	@else
	                	@endif
	                   Frequently asked questions
	                   <button type="button" class="btn btn-primary btn-xs" style="float: right;" id="add_faq" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add faq</button>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive table-bordered">
	                    	<div style="background: transparent; display: none;" id="loaderBody" align="center">
								<p>Please wait...</p>
								<img src="{{url('/')}}/public/img/reload.gif">
							</div>
							<div class="alert alert-danger" id="err" style="display: none;"></div>
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th>ID</th>
	                                    <th>Question</th>
	                                    <th>Answer</th>
	                                    <th>Created By</th>
	                                    <th>Created At</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
	                            </thead>
	                            <tbody id="tableFaq">
		                           @foreach($faq as $faq_details)
		                           	<tr>
		                           		<td>{{$faq_details->id}}</td>
		                           		<td>{{$faq_details->question}}</td>
		                           		<td>{{$faq_details->answer}}</td>
		                           		<td>{{$faq_details->admin_details->username}}</td>
		                           		<td>{{ date("F jS Y",strtotime($faq_details->created_at->toDateString())) }}</td>
		                           		<td><button type="button" id="edit_{{$faq_details->id}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
			                           	<td><button type="button" id="del_{{$faq_details->id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>
		                           	</tr>
		                           @endforeach
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{{$faq->render()}}</span>
	                    </div>
	                    <!-- /.table-responsive -->
	                </div>
	                <!-- /.panel-body -->
	            </div>
	            <!-- /.panel -->
	        </div>
	        <!-- /.col-lg-6 -->
	    </div>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Faq</h4>
	      </div>
	      <div class="modal-body">
	      <div style="background: transparent; display: none;" id="loaderBodyAdd" align="center">
			<p>Please wait...</p>
			<img src="{{url('/')}}/public/img/reload.gif">
		 </div>
	        <form role="form" id="add-faq-form">
			  <div class="form-group">
				 <div class="alert alert-success" id="success" style="display: none;"></div>
		         <div class="alert alert-danger" id="errordiv" style="display: none;"></div>
			    <label for="question">Question ?</label>
			    <input class="form-control" id="question" name="question" type="text" required="">
			  </div>
			  <div class="form-group">
			    <label for="answer">Answer</label>
			    <textarea class="form-control" id="answer" name="answer" required=""></textarea>
			  </div>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="addFaq">Add Faq</button>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<!--Modal Edit-->
	<div id="myModalEdit" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Faq</h4>
	      </div>
	      <div class="modal-body">
	      <div style="background: transparent; display: none;" id="loaderBodyEdit" align="center">
			<p>Please wait...</p>
			<img src="{{url('/')}}/public/img/reload.gif">
		 </div>
	        <form role="form" id="edit-faq-form">
			  <div class="form-group">
				 <div class="alert alert-success" id="successEdit" style="display: none;"></div>
		         <div class="alert alert-danger" id="errordivEdit" style="display: none;"></div>
		         <input type="hidden" id="faq_id"></input>
			    <label for="question">Question ?</label>
			    <input class="form-control" id="questionEdit" name="questionEdit" type="text">
			  </div>
			  <div class="form-group">
			    <label for="answer">Answer</label>
			    <textarea class="form-control" id="answerEdit" name="answerEdit"></textarea>
			  </div>
			  <button type="button" class="btn btn-primary btn-lg btn-block" id="editFaq">Edit Faq</button>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			//alert('hi')
			//add functionality
			$('#addFaq').click(function(){
				var question = $('#question').val();
				var answer = $('#answer').val();
				//alert('hi')
				//console.log(question);
				//console.log(answer);
				if ($.trim(question) && $.trim(answer)) 
				{
					$('#loaderBodyAdd').show();
					$('#add-faq-form').hide();
					$('#loaderBody').show();
					$('.table').hide();
					$.ajax({
						type: "POST",
						url: "{{route('postAddFaq')}}",
						data: {question: question, answer: answer, _token: "{{Session::token()}}"},
						success: function(data) {
							if (data != 0) 
							{
								location.reload();
							}
							else
							{
								$('#errordiv').show();
								$('#errordiv').html('<i class="fa fa-times" aria-hidden="true"></i> Could Not Save Your Details Please Try Again Later! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
								return false;
							}
						}
					});
				}
				else
				{
					$('#errordiv').show();
					$('#errordiv').html('<i class="fa fa-times" aria-hidden="true"></i> All The Fields Are Mandetory and Make Sure You haven"t use a semicolon ";" <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
					return false;
				}
			});
			@foreach($faq as $faq_details)
				$('#edit_{{$faq_details->id}}').click(function(){
					$('#myModalEdit').modal('show');
					$('#faq_id').val('{{$faq_details->id}}');
					$('#questionEdit').val("{{$faq_details->question}}");
					$('#answerEdit').val("{{$faq_details->answer}}");
				});
				$('#del_{{$faq_details->id}}').click(function(){
					$.ajax({
						url: "{{route('postDeleteFaq')}}",
						type: "POST",
						data: {id: '{{$faq_details->id}}', _token:'{{Session::token()}}' },
						success: function(data) {
							if (data != 0) 
							{
								location.reload();
							}
							else
							{
								$('#err').show();
								$('#err').html('<i class="fa fa-times" aria-hidden="true"></i> Some Error Occured Please Try Again Later! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
								return false;
							}
						}
					});
				});
			@endforeach
			$('#editFaq').click(function(){
				var id = $('#faq_id').val();
				var questionEdit = $('#questionEdit').val();
				var answerEdit = $('#answerEdit').val();
				$('#loaderBodyEdit').show();
				$('#edit-faq-form').hide();
				$.ajax({
					url : "{{route('postEditFaq')}}",
					type: "POST",
					data: {id: id, questionEdit: questionEdit, answerEdit: answerEdit, _token: "{{Session::token()}}"},
					success: function(data) {
						if (data != 0) 
						{
							location.reload();
						}
						else
						{
							$('#loaderBodyEdit').hide();
							$('#edit-faq-form').show();
							$('#errordivEdit').show();
							$('#errordivEdit').html('<i class="fa fa-times" aria-hidden="true"></i> Some Error Occured Please Try Again Later! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
							return false;
						}
					}
				});
			});
		});
	</script>
@endsection