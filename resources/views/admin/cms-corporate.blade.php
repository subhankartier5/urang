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
            <h1 class="page-header">Corporate Page Contents</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Corporate Page
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="{{route('postCorpoarte')}}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input class="form-control" type="text" name="title" id="title" />
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Meta Keywords:</label>
                                    <input class="form-control" type="text" name="keywords" id="keywords" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Meta Description:</label>
                                    <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                                </div>
                                <div class="form-group">
                                	<label for="heading">Page Heading:</label>
                                	<input type="text" class="form-control" name="heading" id="heading"></input>
                                </div>
                                <div class="form-group">
                                	<label for="tags">Tag Lines:</label>
                                	<input type="text" class="form-control" name="tags" id="tags"></input>
                                </div>
                                <div class="form-group">
                                	<label for="content">Page Content:</label>
                                	<textarea name="content" id="content" class="form-control" required="" rows="10"></textarea>
                                </div>
                                @if($cms_data != null)
                                    @if($cms_data->background_image)
                                        <div class="form-group">
                                            <img src="" id="imagePreview" style="height: 150px; width: 150px;" />
                                        </div>
                                    @endif
                                @endif
                                <div class="form-group">
                                	<label for="bgimage">Select Background Image:</label>
                                	<input type="file" name="bgimage" id="bgimage" class="form-control"></input>
                                </div>
                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block" id="save_dry_clean">Save Details</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
                                <input type="hidden" name="identifier" value="1"></input>
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
@if($cms_data != null)
	<script type="text/javascript">
		$(document).ready(function(){
			$('#title').val("{{$cms_data->title}}");
			$('#keywords').val("{{$cms_data->meta_keywords}}");
			$('#description').val("{{$cms_data->meta_description}}");
			$('#heading').val("{{$cms_data->page_heading}}");
			$('#tags').val("{{$cms_data->tags}}");
			$('#content').val("{{$cms_data->content}}");
			$('#imagePreview').attr('src',"{{url('/')}}/public/dump_images/{{$cms_data->background_image}}");
		});
	</script>
@endif
@endsection