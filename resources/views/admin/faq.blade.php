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
	                                    <th>Image</th>
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
		                           		<td>{!!$faq_details->answer!!}</td>
		                           		<td><img src="{{url('/')}}/public/dump_images/{{$faq_details->image}}" style="height: 50px; width: 73px;"></td>
		                           		<td>{{$faq_details->admin_details->username}}</td>
		                           		<td>{{ date("F jS Y",strtotime($faq_details->created_at->toDateString())) }}</td>
		                           		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit_{{$faq_details->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
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
	        <form role="form" id="add-faq-form" enctype="multipart/form-data" method="post" action="{{route('postAddFaq')}}">
			  <div class="form-group">
				 <div class="alert alert-success" id="success" style="display: none;"></div>
		         <div class="alert alert-danger" id="errordiv" style="display: none;"></div>
			    <label for="question">Question ?</label>
			    <input class="form-control" id="question" name="question" type="text" required="">
			  </div>
			  <div class="form-group">
			    <label for="answer">Answer</label>
			    <textarea class="form-control" id="answer" name="answer"></textarea>
			  </div>
			  <div class="form-group">
			    <label for="image">image</label>
			    <input type="file" class="form-control" name="image" id="image" required="" />
			  </div>
			  <button type="submit" class="btn btn-primary btn-lg btn-block" id="addFaq">Add Faq</button>
			  <input type="hidden" name="_token" value="{{Session::token()}}"></input>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

	      </div>
	    </div>

	  </div>
	</div>
	@foreach($faq as $faq_details)
		<!--Modal Edit-->
		<div id="myModalEdit_{{$faq_details->id}}" class="modal fade" role="dialog">
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
		        <form role="form" id="edit-faq-form" method="post" enctype="multipart/form-data" action="{{route('postEditFaq')}}">
				  <div class="form-group">
					 <div class="alert alert-success" id="successEdit" style="display: none;"></div>
			         <div class="alert alert-danger" id="errordivEdit" style="display: none;"></div>
			         <input type="hidden" id="faq_id" name="id" value="{{$faq_details->id}}"></input>
				    <label for="question">Question ?</label>
				    <input class="form-control" id="questionEdit" name="questionEdit" type="text" value="{{$faq_details->question}}">
				  </div>
				  <div class="form-group">
				    <label for="answer">Answer</label>
				    <textarea class="form-control ckeditor" id="answerEdit" name="answerEdit">{!!$faq_details->answer!!}</textarea>
				  </div>
				  <div class="form-group">
				    <label for="image">Image</label>
				    <div id="imagePreview"><img src="{{url('/')}}/public/dump_images/{{$faq_details->image}}" alt="image" class="img-responsive" style="height: 100px; width: 100px;"></div>
				    <input type="file" name="image" id="image" class="form-control"/>
				  </div>
				  <button type="submit" class="btn btn-primary btn-lg btn-block" id="editFaq">Save Details</button>
				  <input type="hidden" name="_token" value="{{Session::token()}}" />
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
	@endforeach
	<script type="text/javascript">
		$(document).ready(function(){
			/*$('#addFaq').click(function(){
				var editorContent = tinyMCE.get('answer').getContent();
				if ($.trim(editorContent) == '')
				{
				    sweetAlert("Oops...", "Answer Field is required!", "error");
				    return false;
				}
				else
				{
				    return true;
				}

			});*/
			@foreach($faq as $faq_details)
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
		});
	</script>
	<script type="text/javascript">
		CKEDITOR.replace('answer',
		{
		on :
		{
		instanceReady : function( ev )
		{
		this.dataProcessor.writer.setRules( '*',
		{
		indent : false,
		breakBeforeOpen : true,
		breakAfterOpen : false,
		breakBeforeClose : false,
		breakAfterClose : true
		});
		}}});
	</script>
@endsection