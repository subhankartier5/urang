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
	            <?php $i=0;?>
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
	                        						echo $orders[1];
	                        						break;
	                        					case '2':
	                        						echo $orders[2];
	                        						break;
	                        					case '3':
	                        						echo $orders[3];
	                        						break;
	                        					case '4':
	                        						echo $orders[4];
	                        						break;
	                        					case '5':
	                        						echo $orders[5];
	                        						break;
	                        					case '6':
	                        						echo $orders[6];
	                        						break;
	                        					case '7':
	                        						echo $orders[7];
	                        						break;
	                        					case '8':
	                        						echo $orders[8];
	                        						break;
	                        					case '9':
	                        						echo $orders[9];
	                        						break;
	                        					case '10':
	                        						echo $orders[10];
	                        						break;
	                        					case '11':
	                        						echo $orders[11];
	                        						break;
	                        					case '12':
	                        						echo $orders[12];
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
	                        						echo $total_money_gained[1];
	                        						break;
	                        					case '2':
	                        						echo $total_money_gained[2];
	                        						break;
	                        					case '3':
	                        						echo $total_money_gained[3];
	                        						break;
	                        					case '4':
	                        						echo $total_money_gained[4];
	                        						break;
	                        					case '5':
	                        						echo $total_money_gained[5];
	                        						break;
	                        					case '6':
	                        						echo $total_money_gained[6];
	                        						break;
	                        					case '7':
	                        						echo $total_money_gained[7];
	                        						break;
	                        					case '8':
	                        						echo $total_money_gained[8];
	                        						break;
	                        					case '9':
	                        						echo $total_money_gained[9];
	                        						break;
	                        					case '10':
	                        						echo $total_money_gained[10];
	                        						break;
	                        					case '11':
	                        						echo $total_money_gained[11];
	                        						break;
	                        					case '12':
	                        						echo $total_money_gained[12];
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
	                        						echo $school_donation_monthly[1];
	                        						break;
	                        					case '2':
	                        						echo $school_donation_monthly[2];
	                        						break;
	                        					case '3':
	                        						echo $school_donation_monthly[3];
	                        						break;
	                        					case '4':
	                        						echo $school_donation_monthly[4];
	                        						break;
	                        					case '5':
	                        						echo $school_donation_monthly[5];
	                        						break;
	                        					case '6':
	                        						echo $school_donation_monthly[6];
	                        						break;
	                        					case '7':
	                        						echo $school_donation_monthly[7];
	                        						break;
	                        					case '8':
	                        						echo $school_donation_monthly[8];
	                        						break;
	                        					case '9':
	                        						echo $school_donation_monthly[9];
	                        						break;
	                        					case '10':
	                        						echo $school_donation_monthly[10];
	                        						break;
	                        					case '11':
	                        						echo $school_donation_monthly[11];
	                        						break;
	                        					case '12':
	                        						echo $school_donation_monthly[12];
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
	                        						echo ($total_money_gained[1]*22)/100;
	                        						break;
	                        					case '2':
	                        						echo ($total_money_gained[2]*22)/100;
	                        						break;
	                        					case '3':
	                        						echo ($total_money_gained[3]*22)/100;
	                        						break;
	                        					case '4':
	                        						echo ($total_money_gained[4]*22)/100;
	                        						break;
	                        					case '5':
	                        						echo ($total_money_gained[5]*22)/100;
	                        						break;
	                        					case '6':
	                        						echo ($total_money_gained[6]*22)/100;
	                        						break;
	                        					case '7':
	                        						echo ($total_money_gained[7]*22)/100;
	                        						break;
	                        					case '8':
	                        						echo ($total_money_gained[8]*22)/100;
	                        						break;
	                        					case '9':
	                        						echo ($total_money_gained[9]*22)/100;
	                        						break;
	                        					case '10':
	                        						echo ($total_money_gained[10]*22)/100;
	                        						break;
	                        					case '11':
	                        						echo ($total_money_gained[11]*22)/100;
	                        						break;
	                        					case '12':
	                        						echo ($total_money_gained[12]*22)/100;
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
	                        						echo $total_money_gained[1]-($school_donation_monthly[1]+($total_money_gained[1]*22)/100);
	                        						break;
	                        					case '2':
	                        						echo $total_money_gained[2]-($school_donation_monthly[2]+($total_money_gained[2]*22)/100);
	                        						break;
	                        					case '3':
	                        						echo $total_money_gained[3]-($school_donation_monthly[3]+($total_money_gained[3]*22)/100);
	                        						break;
	                        					case '4':
	                        						echo $total_money_gained[4]-($school_donation_monthly[4]+($total_money_gained[4]*22)/100);
	                        						break;
	                        					case '5':
	                        						echo $total_money_gained[5]-($school_donation_monthly[5]+($total_money_gained[5]*22)/100);
	                        						break;
	                        					case '6':
	                        						echo $total_money_gained[6]-($school_donation_monthly[6]+($total_money_gained[6]*22)/100);
	                        						break;
	                        					case '7':
	                        						echo $total_money_gained[7]-($school_donation_monthly[7]+($total_money_gained[7]*22)/100);
	                        						break;
	                        					case '8':
	                        						echo $total_money_gained[8]-($school_donation_monthly[8]+($total_money_gained[8]*22)/100);
	                        						break;
	                        					case '9':
	                        						echo $total_money_gained[9]-($school_donation_monthly[9]+($total_money_gained[9]*22)/100);
	                        						break;
	                        					case '10':
	                        						echo $total_money_gained[10]-($school_donation_monthly[10]+($total_money_gained[10]*22)/100);
	                        						break;
	                        					case '11':
	                        						echo $total_money_gained[11]-($school_donation_monthly[11]+($total_money_gained[11]*22)/100);
	                        						break;
	                        					case '12':
	                        						echo $total_money_gained[12]-($school_donation_monthly[12]+($total_money_gained[12]*22)/100);
	                        						break;
	                        					default:
	                        						echo "Something went wrong";
	                        						break;
	                        				}
	                        			?>
	                        		</td>
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
  				if (myDate[0][0] == 0) 
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