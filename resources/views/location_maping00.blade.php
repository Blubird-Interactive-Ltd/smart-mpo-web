@extends('layouts.master')
@section('content')
	<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}l">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span> Location map</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">

	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Location map</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
			      			<div class="row	">
		                        <div class="col-sm-2 col-xs-12">
		                        	<div class="form-group form-md-line-input">
                                        <select class="form-control" name="delivery">
                                            <option value="">Select Division</option>
                                            <option value="1">Division 1</option>
                                            <option value="2">Division 2</option>
                                            <option value="3">Division 3</option>
                                        </select>
                                        <label for="form_control_1">Select Division</label>
                                        <span class="help-block">Select Division...</span>
                                    </div>
		                        </div>

		                        <div class="col-sm-2 col-xs-12">
		                        	<div class="form-group form-md-line-input">
                                        <select class="form-control" name="delivery">
                                            <option value="">Select Zone</option>
                                            <option value="1">Zone 1</option>
                                            <option value="2">Zone 2</option>
                                            <option value="3">Zone 3</option>
                                        </select>
                                        <label for="form_control_1">Select Zone</label>
                                        <span class="help-block">Select Zone...</span>
                                    </div>
		                        </div>

		                        <div class="col-sm-2 col-xs-12">
		                        	<div class="form-group form-md-line-input">
                                        <select class="form-control" name="delivery">
                                            <option value="">Select Region</option>
                                            <option value="1">Region 1</option>
                                            <option value="2">Region 2</option>
                                            <option value="3">Region 3</option>
                                        </select>
                                        <label for="form_control_1">Select Region</label>
                                        <span class="help-block">Select Region...</span>
                                    </div>
		                        </div>

		                        <div class="col-sm-2 col-xs-12">
		                        	<div class="form-group form-md-line-input">
                                        <select class="form-control" name="delivery">
                                            <option value="">Select Area</option>
                                            <option value="1">Area 1</option>
                                            <option value="2">Area 2</option>
                                            <option value="3">Area 3</option>
                                        </select>
                                        <label for="form_control_1">Select Area</label>
                                        <span class="help-block">Select Area...</span>
                                    </div>
		                        </div>

		                        <div class="col-sm-2 col-xs-12">
		                        	<div class="form-group form-md-line-input">
                                        <select class="form-control" name="delivery">
                                            <option value="">Select Territory</option>
                                            <option value="1">Territory 1</option>
                                            <option value="2">Territory 2</option>
                                            <option value="3">Territory 3</option>
                                        </select>
                                        <label for="form_control_1">Select Territory</label>
                                        <span class="help-block">Select Territory...</span>
                                    </div>
		                        </div>

		                        <div class="col-sm-2 col-xs-12 text-right">
		                        	<button class="btn btn-success m-t-20">Add New Location</button>
		                        </div>
		                    </div>

		                    <hr>

		                    <div class="row	">
		                        <div class="col-sm-12 col-xs-12">
									<table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <th class="w100">Sl. No.</th>
							                  <th class="">Division Name</th>
							                  <th class="">Zone Name</th>
							                  <th class="">Region Name</th>
							                  <th class="">Area Name</th>
							                  <th class="">Territory Name</th>
							                  <th class="w250 text-center">Action</th>
							                </tr>
						              	</thead>
						              	<tbody>
							                <tr>
							                  	<td>01</td>
							                  	<td>Division 01</td>
							                  	<td class="">Zone 01</td>
							                  	<td class="">Region 01</td>
							                  	<td class="">Area 01</td>
							                  	<td class="">Territory 01</td>
							                  	<td class="text-center">
							                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addLocationModal">
							                  			Edit
							                  		</a>

							                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
							                  			Delete
							                  		</a>
							                  	</td>
							                </tr>
							                
							                <tr>
							                  	<td>02</td>
							                  	<td>Division 02</td>
							                  	<td class="">Zone 02</td>
							                  	<td class="">Region 02</td>
							                  	<td class="">Area 02</td>
							                  	<td class="">Territory 02</td>
							                  	<td class="text-center">
							                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addLocationModal">
							                  			Edit
							                  		</a>

							                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
							                  			Delete
							                  		</a>
							                  	</td>
							                </tr>

							            </tbody>
						            </table>
		                        </div>
		                    </div>
		                </div>
		            </div>
	      		</div>
	      	</div>
		</div>
	</div>

	<!-- Accept /reject modal START-->
	<div id="acceptRejectModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3>Are you sure want to Delete?</h3>
		      	</div>
		      	<div class="modal-footer" style="text-align: center;">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Yes, Continue</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

	<div id="addLocationModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Edit Location</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">
		        		<div class="row">
		        			<div class="col-sm-6 col-xs-12">
	                        	<div class="form-group form-md-line-input">
                                    <select class="form-control" name="delivery">
                                        <option value="">Select Division</option>
                                        <option value="1">Division 1</option>
                                        <option value="2">Division 2</option>
                                        <option value="3">Division 3</option>
                                    </select>
                                    <label for="form_control_1">Select Division</label>
                                    <span class="help-block">Select Division...</span>
                                </div>
	                        </div>

	                        <div class="col-sm-6 col-xs-12">
	                        	<div class="form-group form-md-line-input">
                                    <select class="form-control" name="delivery">
                                        <option value="">Select Zone</option>
                                        <option value="1">Zone 1</option>
                                        <option value="2">Zone 2</option>
                                        <option value="3">Zone 3</option>
                                    </select>
                                    <label for="form_control_1">Select Zone</label>
                                    <span class="help-block">Select Zone...</span>
                                </div>
	                        </div>

	                        <div class="col-sm-6 col-xs-12">
	                        	<div class="form-group form-md-line-input">
                                    <select class="form-control" name="delivery">
                                        <option value="">Select Region</option>
                                        <option value="1">Region 1</option>
                                        <option value="2">Region 2</option>
                                        <option value="3">Region 3</option>
                                    </select>
                                    <label for="form_control_1">Select Region</label>
                                    <span class="help-block">Select Region...</span>
                                </div>
	                        </div>

	                        <div class="col-sm-6 col-xs-12">
	                        	<div class="form-group form-md-line-input">
                                    <select class="form-control" name="delivery">
                                        <option value="">Select Area</option>
                                        <option value="1">Area 1</option>
                                        <option value="2">Area 2</option>
                                        <option value="3">Area 3</option>
                                    </select>
                                    <label for="form_control_1">Select Area</label>
                                    <span class="help-block">Select Area...</span>
                                </div>
	                        </div>

	                        <div class="col-sm-6 col-xs-12">
	                        	<div class="form-group form-md-line-input">
                                    <select class="form-control" name="delivery">
                                        <option value="">Select Territory</option>
                                        <option value="1">Territory 1</option>
                                        <option value="2">Territory 2</option>
                                        <option value="3">Territory 3</option>
                                    </select>
                                    <label for="form_control_1">Select Territory</label>
                                    <span class="help-block">Select Territory...</span>
                                </div>
	                        </div>
		        		</div>

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
		      	</div>
		    </div>

	  	</div>
	</div>

@endsection

@section('js')
    <script>

    </script>
@endsection