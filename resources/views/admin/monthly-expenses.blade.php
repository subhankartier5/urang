@extends('admin.layouts.master')
@section('content')
<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>
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
	               <input type="text" id="datepicker" style="float: right;" value="{{date('m/Y')}}" onchange="showMonth()"></input>
	               <p>Monthly Expenses</p>
	            </div>
	            <div class="panel-body">
	               <div class="table-responsive table-bordered">
	                  <table class="table">
	                     <thead>
	                        <tr>
	                           <th>Month</th>
	                           <th>No of orders</th>
	                           <th>Total Money Earned</th>
	                           <th>Total School Donation</th>
	                           <th>Total Money Given to vendor</th>
	                           <th>Total Profit</th>
	                        </tr>
	                     </thead>
	                     <tbody>
	                        @for($i=1; $i <= 12; $i++)
	                        	<tr id="row_{{$i}}">
	                        		<td>
	                        			<?php
	                        				switch ($i) {
	                        					case '1':
	                        						echo "january";
	                        						break;
	                        					case '2':
	                        						echo "February";
	                        						break;
	                        					case '3':
	                        						echo "March";
	                        						break;
	                        					case '4':
	                        						echo "April";
	                        						break;
	                        					case '5':
	                        						echo "May";
	                        						break;
	                        					case '6':
	                        						echo "June";
	                        						break;
	                        					case '7':
	                        						echo "July";
	                        						break;
	                        					case '8':
	                        						echo "August";
	                        						break;
	                        					case '9':
	                        						echo "September";
	                        						break;
	                        					case '10':
	                        						echo "October";
	                        						break;
	                        					case '11':
	                        						echo "November";
	                        						break;
	                        					case '12':
	                        						echo "December";
	                        						break;
	                        					default:
	                        						echo "Something went wrong";
	                        						break;
	                        				}
	                        			?>
	                        		</td>
	                        		<td>
	                        			<?php
	                        				switch ($i) {
	                        					case '1':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 1)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '2':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 2)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '3':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 3)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '4':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 4)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '5':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 5)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '6':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 6)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '7':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 7)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '8':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 8)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '9':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 9)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '10':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 10)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '11':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 11)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					case '12':
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 12)->count();
	                        						echo $no_of_orders;
	                        						break;
	                        					default:
	                        						echo "Something went wrong";
	                        						break;
	                        				}
	                        			?>
	                        		</td>
	                        		<td>
	                        			<?php
	                        				switch ($i) {
	                        					case '1':
	                        						$total_price_monthly = 0.00;	
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 1)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '2':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 2)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '3':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 3)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '4':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 4)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '5':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 5)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '6':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 6)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '7':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 7)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '8':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 8)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '9':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 9)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '10':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 10)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '11':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 11)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					case '12':
	                        						$total_price_monthly = 0.00;
	                        						$no_of_orders = \App\Pickupreq::where( DB::raw('MONTH(created_at)'), '=', 12)->get();
	                        						foreach ($no_of_orders as $order) {
	                        							$total_price_monthly +=$order->total_price;
	                        						}
	                        						echo $total_price_monthly;
	                        						break;
	                        					default:
	                        						echo "Something went wrong";
	                        						break;
	                        				}
	                        			?>
	                        		</td>
	                        		<td>test2</td>
	                        		<td>
	                        			<?php
	                        				switch ($i) {
	                        					case '1':
	                        						//echo "january";
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '2':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '3':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '4':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '5':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '6':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '7':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '8':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '9':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '10':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '11':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					case '12':
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        					default:
	                        						echo ($total_price_monthly*22)/100;
	                        						break;
	                        				}
	                        			?>
	                        		</td>
	                        		<td><?php
	                        				switch ($i) {
	                        					case '1':
	                        						//echo "january";
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '2':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '3':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '4':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '5':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '6':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '7':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '8':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '9':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '10':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '11':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					case '12':
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        					default:
	                        						echo $total_price_monthly-($total_price_monthly*22)/100;
	                        						break;
	                        				}
	                        			?></td>
	                        	</tr>
	                        @endfor
	                     </tbody>
	                  </table>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<script type="text/javascript">
		/*$(function(){
    		$("#datepicker" ).datepicker({
      		changeMonth: true,
      		changeYear: true
      		//dateFormat: 'mm/yy'
    		});
  		});*/
  		$(function() {
     		$('#datepicker').datepicker(
            {
                dateFormat: "mm/yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onClose: function(dateText, inst) {


                    function isDonePressed(){
                        return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                    }

                    if (isDonePressed()){
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');
                        
                         $('#datepicker').focusout()//Added to remove focus from datepicker input box on selecting date
                    }
                },
                beforeShow : function(input, inst) {

                    inst.dpDiv.addClass('month_year_datepicker')

                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length-4, datestr.length);
                        month = datestr.substring(0, 2);
                        $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                        $(this).datepicker('setDate', new Date(year, month-1, 1));
                    }
                }
            })
		});
  		function showMonth() {
  			var myDate = $('#datepicker').val().split('/');
  			for (var j = 0; j< myDate[0].length; j++) {
  				if (myDate[0][j] == 0) 
  				{
  					myDate[0] = myDate[0][j+1];
  				}
  			}
  			$('#row_'+myDate[0]).attr('style', 'color:white;background:#4CAF50;font-weight:bold;');
  			for (var k = 12; k >= 1; k--) {
  				if (k != myDate[0]) 
  				{
  					$('#row_'+k).attr('style', '');
  				}
  			}
  		}
  		$(document).ready(function(){
  			
  			var thismonth = new Date().getMonth()+1;
  			//console.log(thismonth);
  			//thismonth=1;
  			$('#row_'+thismonth).attr('style', 'color:white;background:#4CAF50;font-weight:bold;');
  		});
	</script>
@endsection