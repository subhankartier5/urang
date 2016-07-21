@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper" style="margin-top:30px;">

    <div class="row">   
        <div id="filter-panel" class="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" action="{{route('changeWeekDayNumber')}}" method="post" role="form">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Weekday's Pickup Number(perday):</label>
                            <input type="number" name="value" value="{{$pick_up_number->week_day}}"> 
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="column_name" value="week_day">                               
                        </div> <!-- form group [rows] -->
                        
                        <div class="form-group">    
                            
                            <button type="submit" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Save Settings
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>     
	</div>

    <div class="row">   
        <div id="filter-panel" class="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" action="{{route('changeWeekDayNumber')}}" method="post" role="form">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">WeekEnds's Pickup Number(Saturday):</label>
                            <input type="number" name="value" value="{{$pick_up_number->saturday}}"> 
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="column_name" value="saturday">                               
                        </div> <!-- form group [rows] -->
                        
                        <div class="form-group">    
                            
                            <button type="submit" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Save Settings
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>     
    </div>
<?php
    if($pick_up_number->sunday==0)
    {
        $display_class = "hidden_div";
    }
    else
    {
        $display_class = "";
    }
?>
    <div class="row {{$display_class}}" id="sunday_div" >   
        <div id="filter-panel" class="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" action="{{route('changeWeekDayNumber')}}" method="post" role="form">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Sunday's Pickup Number:</label>
                            <input type="number" name="value" value="{{$pick_up_number->sunday}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="column_name" value="sunday">                                
                        </div> <!-- form group [rows] -->
                        
                        <div class="form-group">    
                            
                            <button type="submit" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Save Settings
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>     
    </div>
    

    <div class="row">
        
            @if($pick_up_number->sunday == 0)
                <button type="button" id="add_sunday" class="pull-right" name="add_sunday">Add Sunday(custom)</button>
                <form action="{{route('setSundayToZero')}}" method="get">
                    <button type="submit" id="remove_sunday" class="pull-right hidden_div">Remove Sunday</button>
                </form>
                
            @else
                <button type="button" id="add_sunday" class="pull-right hidden_div" name="add_sunday">Add Sunday(custom)</button>
                <form action="{{route('setSundayToZero')}}" method="get">
                    <button type="submit" id="remove_sunday" class="pull-right">Remove Sunday</button>
                </form>
                
            @endif
        
    </div>

</div>
<script type="text/javascript">
    $('#add_sunday').click(function(){
        $('#sunday_div').show();
        $('#remove_sunday').show();
        $('#add_sunday').hide();
    });
    /*$('#remove_sunday').click(function(){
        $('#sunday_div').hide();
        $('#remove_sunday').hide();
        $('#add_sunday').show();
    });*/
</script>
@endsection