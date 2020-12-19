@extends('layouts.master')
@section('content')
	<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Setup Location</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Setup Location</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
			      			<div class="">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
		                            <li role="presentation" class="active">
		                                <a href="#Division" data-toggle="tab">
		                                    Division to Zone
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Zone" data-toggle="tab">
		                                    Zone to Region
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Region" data-toggle="tab">
		                                    Region to Area
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Area" data-toggle="tab">
		                                    Area to Territory
		                                </a>
		                            </li>
		                        </ul>

		                        <!-- Tab panes -->
		                        <div class="tab-content">
		                            <div role="tabpanel" class="tab-pane fade in active" id="Division">
		                                <div class="">
											<div class="text-right m-b-30">
												<div class="btn-group btn-group-devided">
				                                    <button type="button" class="btn btn-primary" id="add_new_Division" data-toggle="modal" data-target="#addDivisionModal"><i class="icon-plus icons"></i>Add New</button>
				                                </div>
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
												  	<tr>
													    <th>SL.</th>
													    <th>Division</th>
													    <th>Zone</th>
													    <th>Action</th>
												  	</tr>
												</thead>
												<tbody>
												  	<tr>
													    <td rowspan="3">01</td>
													    <td rowspan="3">Division01</td>
													    <td>Zone</td>
													    <td rowspan="3" class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addDivisionModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												  	<tr>
												    	<td>Zone 01</td>
												  	</tr>
												  	<tr>
												    	<td>Zone 02</td>
												  	</tr>
												  	<tr>
													    <td>02</td>
													    <td>Division01</td>
													    <td>Zone 03</td>
													    <td class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addDivisionModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												</tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Zone">
		                                <div class="">
											<div class="text-right m-b-30">
												<div class="btn-group btn-group-devided">
				                                    <button type="button" class="btn btn-primary" id="add_new_Zone" data-toggle="modal" data-target="#addZoneModal"><i class="icon-plus icons"></i>Add New</button>
				                                </div>
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
												  	<tr>
													    <th>SL.</th>
													    <th>Division</th>
													    <th>Zone</th>
													    <th>Action</th>
												  	</tr>
												</thead>
												<tbody>
												  	<tr>
													    <td rowspan="3">01</td>
													    <td rowspan="3">Zone 01</td>
													    <td>Region</td>
													    <td rowspan="3" class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addZoneModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												  	<tr>
												    	<td>Region 01</td>
												  	</tr>
												  	<tr>
												    	<td>Region 02</td>
												  	</tr>
												  	<tr>
													    <td>02</td>
													    <td>Zone 02</td>
													    <td>Region 03</td>
													    <td class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addZoneModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												</tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Region">
		                                <div class="">
											<div class="text-right m-b-30">
												<div class="btn-group btn-group-devided">
				                                    <button type="button" class="btn btn-primary" id="add_new_Region" data-toggle="modal" data-target="#addRegionModal"><i class="icon-plus icons"></i>Add New</button>
				                                </div>
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
												  	<tr>
													    <th>SL.</th>
													    <th>Region</th>
													    <th>Area</th>
													    <th>Action</th>
												  	</tr>
												</thead>
												<tbody>
												  	<tr>
													    <td rowspan="3">01</td>
													    <td rowspan="3">Region 01</td>
													    <td>Area</td>
													    <td rowspan="3" class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addRegionModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												  	<tr>
												    	<td>Area 01</td>
												  	</tr>
												  	<tr>
												    	<td>Area 02</td>
												  	</tr>
												  	<tr>
													    <td>02</td>
													    <td>Region 02</td>
													    <td>Area 03</td>
													    <td class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addRegionModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												</tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Area">
		                                <div class="">
											<div class="text-right m-b-30">
												<div class="btn-group btn-group-devided">
				                                    <button type="button" class="btn btn-primary" id="add_new_Area" data-toggle="modal" data-target="#addAreaModal"><i class="icon-plus icons"></i>Add New</button>
				                                </div>
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
												  	<tr>
													    <th>SL.</th>
													    <th>Area</th>
													    <th>Territory</th>
													    <th>Action</th>
												  	</tr>
												</thead>
												<tbody>
												  	<tr>
													    <td rowspan="3">01</td>
													    <td rowspan="3">Area 01</td>
													    <td>Territory</td>
													    <td rowspan="3" class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addAreaModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
									                  	</td>
												  	</tr>
												  	<tr>
												    	<td>Territory 01</td>
												  	</tr>
												  	<tr>
												    	<td>Territory 02</td>
												  	</tr>
												  	<tr>
													    <td>02</td>
													    <td>Area 02</td>
													    <td>Territory 03</td>
													    <td class="text-center">
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addAreaModal">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>

									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
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
		</div>
	</div>

	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="acceptRejectModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3>Are you sure want to inactive?</h3>
		      	</div>
		      	<div class="modal-footer" style="text-align: center;">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Yes, Continue</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

	<!-- Add Modal -->
	<div id="addDivisionModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Division to Zone</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">
		        		<div class="row">
		        			<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input">
                                    <select class="form-control" name="">
                                        <option value="">Select</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label for="form_control_1">Select Division</label>
                                    <span class="help-block">Select Division...</span>
                                </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
			        			<div class="">
			                        <label for="">Select Zone</label> <br>
			                        <select class="selectpicker form-control show-tick" multiple>
									  	<option>Zone</option>
									  	<option>Zone 01</option>
									  	<option>Zone 02</option>
									  	<option>Zone 03</option>
									  	<option>Zone 04</option>
									  	<option>Zone 05</option>
									  	<option>Zone 06</option>
									  	<option>Zone 07</option>
									  	<option>Zone 08</option>
									</select>
			                    </div>
							</div>
		        		</div>

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
		        		</div>
		        	</form>
		      	</div>
		    </div>

	  	</div>
	</div>

	<div id="addZoneModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Zone to Region</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">

	        			<div class="row">
		        			<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input">
                                    <select class="form-control" name="">
                                        <option value="">Select</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label for="form_control_1">Select Zone</label>
                                    <span class="help-block">Select Zone...</span>
                                </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
			        			<div class="">
			                        <label for="">Select Region</label> <br>
			                        <select class="selectpicker form-control show-tick" multiple>
									  	<option>Region</option>
									  	<option>Region 01</option>
									  	<option>Region 02</option>
									  	<option>Region 03</option>
									  	<option>Region 04</option>
									  	<option>Region 05</option>
									  	<option>Region 06</option>
									  	<option>Region 07</option>
									  	<option>Region 08</option>
									</select>
			                    </div>
							</div>
		        		</div>

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
		        		</div>
		        	</form>
		      	</div>
		    </div>

	  	</div>
	</div>

	<div id="addRegionModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Region to Area</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">

	        			<div class="row">
		        			<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input">
                                    <select class="form-control" name="">
                                        <option value="">Select</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label for="form_control_1">Select Region</label>
                                    <span class="help-block">Select Region...</span>
                                </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
			        			<div class="">
			                        <label for="">Select Area</label> <br>
			                        <select class="selectpicker form-control show-tick" multiple>
									  	<option>Area</option>
									  	<option>Area 01</option>
									  	<option>Area 02</option>
									  	<option>Area 03</option>
									  	<option>Area 04</option>
									  	<option>Area 05</option>
									  	<option>Area 06</option>
									  	<option>Area 07</option>
									  	<option>Area 08</option>
									</select>
			                    </div>
							</div>
		        		</div>

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
		        		</div>
		        	</form>
		      	</div>
		    </div>

	  	</div>
	</div>

	<div id="addAreaModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Area to Territory</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">

	        			<div class="row">
		        			<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input">
                                    <select class="form-control" name="">
                                        <option value="">Select</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label for="form_control_1">Select Area</label>
                                    <span class="help-block">Select Area...</span>
                                </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
			        			<div class="">
			                        <label for="">Select Territory</label> <br>
			                        <select class="selectpicker form-control show-tick" multiple>
									  	<option>Territory</option>
									  	<option>Territory 01</option>
									  	<option>Territory 02</option>
									  	<option>Territory 03</option>
									  	<option>Territory 04</option>
									  	<option>Territory 05</option>
									  	<option>Territory 06</option>
									  	<option>Territory 07</option>
									  	<option>Territory 08</option>
									</select>
			                    </div>
							</div>
		        		</div>

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
		        		</div>
		        	</form>
		      	</div>
		    </div>

	  	</div>
	</div>

	<div id="addTerritoryModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&nbsp;</button>
		        	<h4 class="modal-title">Territory</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form action="">
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control" id="" name="">
			                        <label for="">Territory Name</label>
			                        <span class="help-block">Enter Territory Name...</span>
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