@extends('staff.layouts.master')

@section('title')
	U-rang|Orders
@endsection

@section('content')


    <div id="wrapper">
	
    	<div id="page-wrapper">

            <div class="container-fluid">


            <div class="row">

                <div class="col-lg-12">

                <div class="row">
                <div class="col-md-6">
                    <h2>Pickup Request Table</h2>
                </div>
                <div class="col-md-6">
                    <div id="wrap">
                    <form>
                        <input id="search" name="search" type="text" placeholder="Search by order id"><input id="search_submit" value="Rechercher" type="submit">
                    </form>
                      
                    </div>
                </div>
                    
                </div>
                    

                    
                                
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Order Id</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Customer Email</th>
                            <th>Pickup Address</th>
                            <th>Order Status</th>
                            <th>Emergency</th>
                            <th>Payment Type</th>
                            <th>Clint Type</th>
                            <th>Total Amount</th>
                            <th>More Info</th>
                            <th>Mark As</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>0001</td>
                            <td>12/07/2016</td>
                            <td>12/07/2016</td>
                            <td>john@example.com</td>
                            <td>Customer Address</td>
                            <td>Order Placed</td>
                            <td>Yes</td>
                            <td>Card</td>
                            <td>New Clint</td>
                            <td>$250</td>
                            <td>
                                <button type="button" id="infoButton" class="btn btn-info"><i class="fa fa-info" aria-hidden="true"></i></button>
                            </td>
                            <td>                              
                                 <select class="form-control">
                                  <option value="picked_up">Picked Up</option>
                                  <option value="processed">Processed</option>
                                  <option value="delivered">Delivered</option>
                                </select>
                                
                                 
                            </td>
                            <td>
                                <button class="btn btn-primary">Apply</button>
                            </td>
                          </tr>
                          <tr>
                            <td>0001</td>
                            <td>12/07/2016</td>
                            <td>12/07/2016</td>
                            <td>john@example.com</td>
                            <td>Customer Address</td>
                            <td>Order Placed</td>
                            <td>Yes</td>
                            <td>Card</td>
                            <td>New Clint</td>
                            <td>$250</td>
                            <td>
                                <button type="button" id="infoButton" class="btn btn-info"><i class="fa fa-info" aria-hidden="true"></i></button>
                            </td>
                            <td>
                                <select class="form-control">
                                  <option value="picked_up">Picked Up</option>
                                  <option value="processed">Processed</option>
                                  <option value="delivered">Delivered</option>
                                </select>
                                 
                            </td>
                            <td>
                                <button class="btn btn-primary">Apply</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    
                </div>
                
            </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal -->
  <div class="modal fade" id="infoModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Details</h4>
        </div>
        <div class="modal-body">

            <div class="row">
            <div class="col-md-6 col-sm-6 col-sm-offset-3">
                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Name</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> jon</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Email</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> user@email.com</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Address</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> user address</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Personal Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Cell Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Office Phone</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Special Instruction</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Driving Instruction</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>Created At</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-5"><strong>DUpdated At</strong></div> 
                    <div class="col-md-1 col-sm-1">:</div> 
                    <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
                </div>
            </div>
            </div>


          
        </div>
        <div class="modal-header" style="border-top: 1px solid #292424;">
          
          <h4 class="modal-title">Pickup Details</h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-offset-3">


            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Id</strong></div> 
            <div class="col-md-1 col-sm-1">:</div> 
            <div class="col-md-5 col-sm-5"><span> 1245</span></div>    
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Created At</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> 12/07/2016</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Address</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> user@email.com</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Date</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> user address</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Pickup Type</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5">7894562123</div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Schedule</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> 123456789</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Delivary Type</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Fast</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Starch Type</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Normal</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Need Bag</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Yes</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Doorman:</strong></div>    
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Yes</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Special Instruction:</strong></div>     
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> user's special instruction</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Driving Instruction:</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> user's driving instruction</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Payment Type</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> COD</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Order Status</strong></div>
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Picked Up</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Emergency</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> Yes</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Clint Type</strong></div> 
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> New</span></div>
            </div>
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Wash and Fold</strong></div>   
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> wash and fold info</span></div>
            </div> 
            <div class="row">
            <div class="col-md-5 col-sm-5"><strong>Updated At</strong></div>  
            <div class="col-md-1 col-sm-1">:</div>
            <div class="col-md-5 col-sm-5"><span> 11/08/2016</span></div>
            </div> 
        
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#infoButton').click(function(){
            $('#infoModal').modal('show');
        });

    });
</script>

@endsection