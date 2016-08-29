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
            <h1 class="page-header">Index Page Contents</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage index Page
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="{{route('postSaveCmsIndex')}}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="tag">Tag Line:</label>
                                    <input class="form-control" type="text" name="tag" id="tag" value="{{$cms_data == null ? '' : $cms_data->tag_line}}" />
                                </div>
                                <div class="form-group">
                                    <label for="header">Header Text:</label>
                                    <input class="form-control" type="text" name="header" id="header" value="{{$cms_data == null ? '' : $cms_data->header}}" />
                                </div>
                                <div class="form-group">
                                    <label for="tag_2">Tag Line 2:</label>
                                    <input type="text" class="form-control" name="tag_2" id="tag_2" value="{{$cms_data == null ? '' : $cms_data->tag_line_2}}"  ></input>
                                </div>
                                <div class="form-group">
                                	<label for="tag_3">Tag Line 3:</label>
                                	<input type="text" class="form-control" name="tag_3" id="tag_3" value="{{$cms_data == null ? '' : $cms_data->tag_line_3}}"></input>
                                </div>
                                <div class="form-group">
                                	<label for="tag_4">Tag Line 4:</label>
                                	<input type="text" class="form-control" name="tag_4" id="tag_4" value="{{$cms_data == null ? '' : $cms_data->tag_line_4}}"></input>
                                </div>
                                <div class="form-group">
                                	<label for="head_section">Section Head:</label>
                                	<input type="text" class="form-control" name="head_section" id="head_section" value="{{$cms_data == null ? '' : $cms_data->head_setion}}"></input>
                                </div>
                                <div class="form-group">
                                	<label for="content">Content:</label>
                                	<textarea name="content" class="form-control" id="content">{!!$cms_data == null ? '' : $cms_data->contents!!}</textarea>
                                </div>
                                <div class="form-group">
                                	<label for="head_section_2">Section Head 2:</label>
                                	<input type="text" class="form-control" name="head_section_2" id="head_section_2" value="{{$cms_data == null ? '' : $cms_data->head_section_2}}"></input>
                                </div>
                                <div class="form-group">
                                	<label for="content_2">Content 2:</label>
                                	<textarea name="content_2" class="form-control" id="content_2">{!!$cms_data == null ? '' : $cms_data->contents_2!!}</textarea>
                                </div>
                                @if($cms_data != null && $cms_data->image != null)
                                	<div class="form-group">
	                                	<img src="{{url('/')}}/public/dump_images/{{$cms_data->image}}" id="imagePreview" style="height: 150px; width: 150px;" />
	                                </div>
                                @endif
                                <div class="form-group">
                                	<label for="image">Select Image:</label>
                                	<input type="file" name="image" id="image" class="form-control"></input>
                                </div>
                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block" id="save_dry_clean">Save Details</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}"></input>
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
<script type="text/javascript">
	CKEDITOR.replace('content',
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
			}
		}
	});
	CKEDITOR.replace('content_2',
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
			}
		}
	});
</script>
@endsection