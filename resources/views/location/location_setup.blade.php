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
						
						<!-- Message Section-->
				        {{--@include('layouts.includes.message')--}}

				        <!--div class="alert alert-success alert-dismissible hidden" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  	<strong>Warning!</strong> Better check yourself, you're not looking too good.
						</div-->
						<!-- end Message sections -->

				        <div class="portlet-body Details">
			      			<div class="">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs tab-nav-right" role="tablist" id="sectionTab">
		                            <li role="presentation" class="active">
		                                <a href="#Division" data-toggle="tab">
		                                    Division 
		                                </a>
		                            </li>
		                            <li role="presentation" id="zone">
		                                <a href="#Zone" data-toggle="tab">
		                                    Zone
		                                </a>
		                            </li>
		                            <li role="presentation" id="region">
		                                <a href="#Region" data-toggle="tab">
		                                    Region
		                                </a>
		                            </li>
		                            <li role="presentation" id="area">
		                                <a href="#Area" data-toggle="tab" >
		                                    Area 
		                                </a>
		                            </li>
		                            <li role="presentation" id="territory">
		                                <a href="#Territory" data-toggle="tab" >
		                                    Territory 
		                                </a>
		                            </li>
		                        </ul>

		                        <!-- Tab panes -->
		                        <div class="tab-content" id="tabPane">

									@if(\App\Utility::userRolePermission(Session::get('role_id'),35))

		                            <div role="tabpanel" class="tab-pane fade in active" id="Division">
		                                <div class="">
											<div class="alert alert-success status_success_message" style="display: none"></div>
											<div class="alert alert-danger status_error_message" style="display: none"></div>
											<div class="text-right">

												@if(\App\Utility::userRolePermission(Session::get('role_id'),36))
												<div class="btn-group btn-group-devided m-t-i100">
				                                    <button type="button" class="btn btn-primary" id="add_new_Division" data-toggle="modal" data-target="#addDivisionModal"><i class="icon-plus icons"></i>Add New Division</button>
				                                </div>
												@endif
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w100">Sl. No.</th>
									                  <th class="">Name</th>
									                  <th class="w250 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody><?php $num=1; ?>
								              		@if(isset($divisions))
								              		@foreach($divisions as $div)
									                <tr id="division{{ $div->division_id }}">
									                  	<td>{{ $num }}</td>
									                  	<td>{{ $div->name }}</td>
									                  	<td class="text-center">
															@if(\App\Utility::userRolePermission(Session::get('role_id'),37))
									                  		<a title="Edit" href="#" class="btn btn-sm btn-info" data-toggle="modal" onclick="editData('{{ $div->division_id }}','division')">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>
															@endif

															@if(\App\Utility::userRolePermission(Session::get('role_id'),38))
															<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" id="division_inactive_{{ $div->division_id }}" onclick="changeLocationStatus('{{ $div->division_id }}','division','deactivate')" @if($div->status=='Inactive')style="display:none" @endif>
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
															<a title="Active" href="javascript:;" class="btn btn-sm btn-success" id="division_active_{{ $div->division_id }}" onclick="changeLocationStatus('{{ $div->division_id }}','division','activate')" @if($div->status=='Active')style="display:none" @endif>
																<i class="fa fa-flash" aria-hidden="true"></i>
															</a>
															@endif
									                  	</td>
									                </tr><?php $num++; ?>
									                @endforeach
									                @endif
									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Zone">
		                                <div class="">
											<div class="alert alert-success status_success_message" style="display: none"></div>
											<div class="alert alert-danger status_error_message" style="display: none"></div>
											<div class="text-right">
												@if(\App\Utility::userRolePermission(Session::get('role_id'),36))
												<div class="btn-group btn-group-devided m-t-i100">
				                                    <button type="button" class="btn btn-primary" id="add_new_Zone" data-toggle="modal" data-target="#addZoneModal"><i class="icon-plus icons"></i>Add New Zone</button>
				                                </div>
												@endif
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w70">Sl. No.</th>
									                  <th class="w250">Zone Name</th>
									                  <th class="w250">Division Name</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody><?php $num=1; ?>
								              		@if(isset($zone))
								              		@foreach($zone as $zo)
									                <tr id="zone{{ $zo->zone_id }}">
									                  	<td>{{ $num }}</td>
									                  	<td>{{ $zo->zone_name }}</td>
									                  	<td>{{ $zo->division_name }}</td>
									                  	<td class="text-center">
															@if(\App\Utility::userRolePermission(Session::get('role_id'),37))
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" onclick="editData('{{ $zo->zone_id }}','zone')">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>
															@endif

															@if(\App\Utility::userRolePermission(Session::get('role_id'),38))
									                  		<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" id="zone_inactive_{{ $zo->zone_id }}" onclick="changeLocationStatus('{{ $zo->zone_id }}','zone','deactivate')" @if($zo->status=='Inactive')style="display:none" @endif>
									                  			<i class="fa fa-ban" aria-hidden="true"></i>
									                  		</a>
															<a title="Active" href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" id="zone_active_{{ $zo->zone_id }}" onclick="changeLocationStatus('{{ $zo->zone_id }}','zone','activate')" @if($zo->status=='Active')style="display:none" @endif>
																<i class="fa fa-flash" aria-hidden="true"></i>
															</a>
															@endif
									                  	</td>
									                </tr><?php $num++; ?>
									                @endforeach
									                @endif
									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Region">
		                                <div class="">
											<div class="alert alert-success status_success_message" style="display: none"></div>
											<div class="alert alert-danger status_error_message" style="display: none"></div>
											<div class="text-right">
												@if(\App\Utility::userRolePermission(Session::get('role_id'),36))
												<div class="btn-group btn-group-devided m-t-i100">
				                                    <button type="button" class="btn btn-primary" id="add_new_Region" data-toggle="modal" data-target="#addRegionModal"><i class="icon-plus icons"></i>Add New Region</button>
				                                </div>
												@endif
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w70">Sl. No.</th>
									                  <th class="">Region Name</th>
									                  <th class="">Zone Name</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody><?php $num=1; ?>
								              		@if(isset($regions))
								              		@foreach($regions as $region)
									                <tr id="region{{ $region->region_id }}">
									                  	<td>{{ $num }}</td>
									                  	<td>{{ $region->region_name }}</td>
									                  	<td>{{ $region->zone_name }}</td>
									                  	<td class="text-center">
															@if(\App\Utility::userRolePermission(Session::get('role_id'),37))
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editData('{{ $region->region_id }}','region')" >
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>
															@endif

															@if(\App\Utility::userRolePermission(Session::get('role_id'),38))
															<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" id="region_inactive_{{ $region->region_id }}" onclick="changeLocationStatus('{{ $region->region_id }}','region','deactivate')" @if($region->status=='Inactive')style="display:none" @endif>
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
															<a title="Active" href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" id="region_active_{{ $region->region_id }}" onclick="changeLocationStatus('{{ $region->region_id }}','region','activate')" @if($region->status=='Active')style="display:none" @endif>
																<i class="fa fa-flash" aria-hidden="true"></i>
															</a>
															@endif
									                  	</td>
									                </tr><?php $num++; ?>
									                @endforeach
									                @endif
									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Area">
		                                <div class="">
											<div class="alert alert-success status_success_message" style="display: none"></div>
											<div class="alert alert-danger status_error_message" style="display: none"></div>
											<div class="text-right">
												@if(\App\Utility::userRolePermission(Session::get('role_id'),36))
												<div class="btn-group btn-group-devided m-t-i100">
				                                    <button type="button" class="btn btn-primary" id="add_new_Area" data-toggle="modal" data-target="#addAreaModal"><i class="icon-plus icons"></i>Add New Area</button>
				                                </div>
												@endif
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w70">Sl. No.</th>
									                  <th class="w250">Area Name</th>
									                  <th class="w250">Region Name</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody><?php $num=1; ?>
								              		@if(isset($areas))
								              		@foreach($areas as $area)
									                <tr id="area{{ $area->area_id }}">
									                  	<td>{{ $num }}</td>
									                  	<td>{{ $area->area_name }}</td>
									                  	<td>{{ $area->region_name }}</td>
									                  	<td class="text-center">

															@if(\App\Utility::userRolePermission(Session::get('role_id'),37))
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editData('{{ $area->area_id }}','area')">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>
															@endif


															@if(\App\Utility::userRolePermission(Session::get('role_id'),38))
															<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" id="area_inactive_{{ $area->area_id }}" onclick="changeLocationStatus('{{ $area->area_id }}','area','deactivate')" @if($area->status=='Inactive')style="display:none" @endif>
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
															<a title="Active" href="javascript:;" class="btn btn-sm btn-success" id="area_active_{{ $area->area_id }}" onclick="changeLocationStatus('{{ $area->area_id }}','area','activate')" @if($area->status=='Active')style="display:none" @endif>
																<i class="fa fa-flash" aria-hidden="true"></i>
															</a>
															@endif
									                  	</td>
									                </tr><?php $num++; ?>
									                @endforeach
									                @endif
									            </tbody>
								            </table>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Territory">
		                                <div class="">
											<div class="alert alert-success status_success_message" style="display: none"></div>
											<div class="alert alert-danger status_error_message" style="display: none"></div>
											<div class="text-right">
												@if(\App\Utility::userRolePermission(Session::get('role_id'),36))
												<div class="btn-group btn-group-devided m-t-i100">
				                                    <button type="button" class="btn btn-primary" id="add_new_Division" data-toggle="modal" data-target="#addTerritoryModal"><i class="icon-plus icons"></i>Add New Territory </button>
				                                </div>
												@endif
											</div>
								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w70">Sl. No.</th>
									                  <th class="">Territory Name</th>
									                  <th class="">Area Name</th>
									                  <th class="">Thana Name</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody><?php $num=1; ?>
								              		@if(isset($territories))
								              		@foreach($territories as $territory)
									                <tr id="territory{{ $territory->territory_id }}">
									                  	<td>{{ $num }}</td>
									                  	<td>{{ $territory->name }}</td>
									                  	<td>{{ $territory->area_name }}</td>
									                  	<td>{{ $territory->thana_name }}</td>
									                  	<td class="text-center">
															@if(\App\Utility::userRolePermission(Session::get('role_id'),37))
									                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editData('{{ $territory->territory_id }}','territory')">
									                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									                  		</a>
															@endif
															@if(\App\Utility::userRolePermission(Session::get('role_id'),38))
															<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" id="territory_inactive_{{ $territory->territory_id }}" onclick="changeLocationStatus('{{ $territory->territory_id }}','territory','deactivate')" @if($territory->status=='Inactive')style="display:none" @endif>
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
															<a title="Active" href="javascript:;" class="btn btn-sm btn-success" id="territory_active_{{ $territory->territory_id }}" onclick="changeLocationStatus('{{ $territory->territory_id }}','territory','activate')" @if($territory->status=='Active')style="display:none" @endif>
																<i class="fa fa-flash" aria-hidden="true"></i>
															</a>
															@endif
									                  	</td>
									                </tr><?php $num++; ?>
									                @endforeach
									                @endif
									            </tbody>
								            </table>
							          	</div>
		                            </div>

									@endif
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
		        	<h3>Are you sure want to delete?</h3>
		      	</div>
		      	<div class="modal-footer" style="text-align: center;">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" data-id="0" data-table="0" id="set_delete">Yes, Continue</button>
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
		        	<h4 class="modal-title">Division</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form id="division_form" action="">
						<div class="alert alert-success division_success_message" style="display: none"></div>
						<div class="alert alert-danger division_error_message" style="display: none"></div>
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control chcek-validation" id="divition_name" name="divition_name">
			                        <label for="">Division Name</label>
			                        <span class="help-block" id="err_divition_name">Enter Division Name...</span>
			                    </div>
			        		</div>
		        		</div>
		        		

		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" data-id="0" id="set_division">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
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
		        	<h4 class="modal-title">Zone</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form id="zone_form" action="">
						<div class="alert alert-success zone_success_message" style="display: none"></div>
						<div class="alert alert-danger zone_error_message" style="display: none"></div>
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control chcek-validation" id="zone_name" name="zone_name">
			                        <label for="">Zone Name</label>
			                        <span class="help-block" id="err_zone_name">Enter Zone Name...</span>
			                    </div>
			        		</div>

							<div class="col-sm-6 col-xs-12">
				        		<div class="form-group form-md-line-input">
	                                <select class="form-control chcek-validation" name="state" id="state">
	                                    <option value="">Select</option>
	                                    @if(isset($divisions))
					              		@foreach($divisions as $div)
						                <option value="{{ $div->division_id }}">{{ $div->name }}</option>
						                @endforeach
						                @endif
	                                </select>
	                                <label for="form_control_1">Select Division</label>
	                                <span class="help-block" id="err_state">Some help goes here...</span>
	                            </div>
							</div>
		        		</div>
		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" id="set_zone" data-id="0">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
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
		        	<h4 class="modal-title">Region</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form id="region_form" action="">
						<div class="alert alert-success region_success_message" style="display: none"></div>
						<div class="alert alert-danger region_error_message" style="display: none"></div>
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control chcek-validation" id="region_name" name="region_name">
			                        <label for="">Region Name</label>
			                        <span class="help-block" id="err_region_name">Enter Region Name...</span>
			                    </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
				        		<div class="form-group form-md-line-input">
	                                <select class="form-control chcek-validation" name="region_zone" id="region_zone">
	                                    <option value="">Select</option>
	                                    @if(isset($zone))
					              		@foreach($zone as $zo)
					              			<option value="{{ $zo->zone_id }}">{{ $zo->zone_name }}</option>
						                @endforeach
						                @endif
	                                </select>
	                                <label for="form_control_1">Select zone</label>
	                                <span class="help-block" id="err_region_zone">Select zone...</span>
	                            </div>
							</div>
		        		</div>
		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" id="set_region" data-id="0">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
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
		        	<h4 class="modal-title">Area</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form id="area_form" action="">
						<div class="alert alert-success area_success_message" style="display: none"></div>
						<div class="alert alert-danger area_error_message" style="display: none"></div>
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control chcek-validation" id="area_name" name="area_name">
			                        <label for="">Area Name</label>
			                        <span class="help-block" id="err_area_name">Enter Area Name...</span>
			                    </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
				        		<div class="form-group form-md-line-input">
	                                <select class="form-control chcek-validation" name="area_region" id="area_region">
	                                    <option value="">Select</option>
	                                    @if(isset($regions))
					              		@foreach($regions as $region)
					              		<option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
						                @endforeach
						                @endif
	                                </select>
	                                <label for="form_control_1">Select Region</label>
	                                <span class="help-block" id="err_area_region">Select Region...</span>
	                            </div>
							</div>
		        		</div>
		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" id="set_area" data-id="0">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
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
		        	<form id="territory_form" action="">
						<div class="alert alert-success territory_success_message" style="display: none"></div>
						<div class="alert alert-danger territory_error_message" style="display: none"></div>
		        		<div class="row">
		        			<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control chcek-validation" id="territory_name" name="territory_name">
			                        <label for="">Territory Name</label>
			                        <span class="help-block" id="err_territory_name">Enter Territory Name...</span>
			                    </div>
			        		</div>
							
							<div class="col-sm-6 col-xs-12">
				        		<div class="form-group form-md-line-input">
	                                <select class="form-control chcek-validation" name="territory_thana" id="territory_thana">
	                                    <option value="">Select</option>
	                                    
	                                    @if(isset($thanas))
					              		@foreach($thanas as $thana)
					              		<option value="{{ $thana->thana_id }}">{{ $thana->thana_name }}</option>
						                @endforeach
						                @endif
	                                </select>
	                                <label for="form_control_1">Select Thana</label>
	                                <span class="help-block" id="err_territory_area">Select Thana...</span>
	                            </div>
							</div>

							<div class="col-sm-6 col-xs-12">
				        		<div class="form-group form-md-line-input">
	                                <select class="form-control chcek-validation" name="territory_area" id="territory_area">
	                                    <option value="">Select</option>

	                                    @if(isset($areas))
					              		@foreach($areas as $area)
					              		<option value="{{ $area->area_id }}">{{ $area->area_name }}</option>
						                @endforeach
						                @endif
	                                </select>
	                                <label for="form_control_1">Select Area</label>
	                                <span class="help-block" id="err_territory_area">Select Area...</span>
	                            </div>
							</div>
		        		</div>
		        		<div class="text-right">
		        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        			<button type="button" class="btn btn-success" id="set_territory" data-id="0">Save</button>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	
		      	</div>
		    </div>

	  	</div>
	</div>


	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="DocDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">&nbsp;</h4>
				</div>
				<div class="modal-body text-center">
					<!-- Alert Massage Section -->
					<div class="alert alert-danger print-error-msg" style="display:none" id="del_error"><ul></ul></div>
					<div class="alert alert-success print-error-msg" style="display:none" id="del_success"></div>
					<!-- Alert Massage Section -->

					<h3 id="warning_message"></h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" data-id="" data-status="" data-location="" class="btn btn-success" id="deldoc">Yes, Continue</a>
				</div>
			</div>

		</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
<script type="text/javascript">


	function changeLocationStatus(id,location_type,action){
		$('#warning_message').text('Are you sure you want to '+action+' this '+location_type+'?');

		$('#DocDelete').modal('show');
		$("#deldoc").attr('data-id',id);
		$("#deldoc").attr('data-status',action);
		$("#deldoc").attr('data-location',location_type);
	}

	$("#deldoc").click(function(){
		var id = $("#deldoc").attr('data-id');
		var location_type = $("#deldoc").attr('data-location');
		var status_type = $("#deldoc").attr('data-status');
		if(status_type=='activate'){
			var status = 'Active';
		}
		else{
			var status = 'Inactive';
		}
		var dataString = {
			_token: "{{ csrf_token() }}",
			table:location_type,
			id:id,
			status:status
		};
		var url = '{{ url('change_location_status') }}';

		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){ console.log(data);
				if(data.status == 200){
					$('#'+location_type+'_active_'+id).hide();
					$('#'+location_type+'_inactive_'+id).show();

					$("#del_success").css('display','block');
					$("#del_success").html(data.reason);
					setTimeout(function() {$('#del_success').hide(); },3000);
					setTimeout(function() {$('#DocDelete').modal('hide');},2000);
				}

				if(data.status == 401){
					$("#del_error").css('display','block');
					$("#del_error").html(data.reason);
					setTimeout(function() {$('#del_error').hide(); },3000);
					setTimeout(function() {$('#DocDelete').modal('hide');},2000);
				}


			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});

	});

//Division Function
	$('#set_division').click(function(){
		var name = $('#divition_name').val();
		var division_id = $('#set_division').attr('data-id');
		var validate ='';
		if(division_id == 0){
			var url = '{{ url('division/store') }}';
		}else{
			var url = '{{ url('division/update') }}';
		}
		 
		if(name.trim() === ''){
			validate = validate+'division name required<br>';
		}
		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				name : name,
				division_id:division_id
			};

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$('.division_success_message').show();
						$('.division_error_message').hide();
						$('.division_success_message').html(data.reason);
						location.reload();
					}
					else{
						$('.division_success_message').hide();
						$('.division_error_message').show();
						$('.division_error_message').html(data.reason);
						var	result = 401;
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('.division_success_message').hide();
			$('.division_error_message').show();
			$('.division_error_message').html(validate);
		}
		setTimeout(function(){
			$('.division_success_message').hide();
			$('.division_error_message').hide();
		}, 3000);

	});

//Zone Function
	$('#set_zone').click(function(){
		var name = $('#zone_name').val();
		var state = $("#state option:selected").val();
		var zone_id = $('#set_zone').attr('data-id');
		var validate = '';
		if(zone_id == 0){
			var url = '{{ url('zone/store') }}';
		}else{
			var url = '{{ url('zone/update') }}';
		}
		 
		if(name.trim() === ''){
			validate = validate+'Zone name required<br>';
		}
		if(state.trim() === ''){
			validate = validate+'Division required<br>';
		}
		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				name : name,
				zone_id:zone_id,
				state:state
			};

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$('.zone_success_message').show();
						$('.zone_error_message').hide();
						$('.zone_success_message').html(data.reason);
						location.reload();
					}
					else{
						$('.zone_success_message').hide();
						$('.zone_error_message').show();
						$('.zone_error_message').html(data.reason);
						var	result = 401;
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('.zone_success_message').hide();
			$('.zone_error_message').show();
			$('.zone_error_message').html(validate);
		}
		setTimeout(function(){
			$('.zone_success_message').hide();
			$('.zone_error_message').hide();
		}, 3000);

	});	


//Region Function
	$('#set_region').click(function(){
		var url = '{{ url('region/store') }}';
		var name = $('#region_name').val();
		var zone = $("#region_zone option:selected").val();
		var region_id = $('#set_region').attr('data-id');
		var validate = '';
		if(region_id == 0){
			var url = '{{ url('region/store') }}';
		}else{
			var url = '{{ url('region/update') }}';
		}
		 
		if(name.trim() === ''){
			validate = validate+'Region name required<br>';
		}

		if(zone.trim() === ''){
			validate = validate+'Zone required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				name : name,
				region_id:region_id,
				zone:zone
			};

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$('.region_success_message').show();
						$('.region_error_message').hide();
						$('.region_success_message').html(data.reason);
						location.reload();
					}
					else{
						$('.region_success_message').hide();
						$('.region_error_message').show();
						$('.region_error_message').html(data.reason);
						var	result = 401;
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('.region_success_message').hide();
			$('.region_error_message').show();
			$('.region_error_message').html(validate);
		}
		setTimeout(function(){
			$('.region_success_message').hide();
			$('.region_error_message').hide();
		}, 3000);

	});	

//Region Function
	$('#set_area').click(function(){
		var url = '{{ url('area/store') }}';
		var name = $('#area_name').val();
		var region = $("#area_region option:selected").val();
		var area_id = $('#set_area').attr('data-id');
		var validate = '';
		if(area_id == 0){
			var url = '{{ url('area/store') }}';
		}else{
			var url = '{{ url('area/update') }}';
		}
		 
		if(name.trim() === ''){
			validate = validate+'Area name required<br>';
		}

		if(region === ''){
			validate = validate+'Region required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				name : name,
				area_id:area_id,
				region:region
			};

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$('.area_success_message').show();
						$('.area_error_message').hide();
						$('.area_success_message').html(data.reason);
						location.reload();
					}
					else{
						$('.area_success_message').hide();
						$('.area_error_message').show();
						$('.area_error_message').html(data.reason);
						var	result = 401;
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('.area_success_message').hide();
			$('.area_error_message').show();
			$('.area_error_message').html(validate);
		}

		setTimeout(function(){
			$('.area_success_message').hide();
			$('.area_error_message').hide();
		}, 3000);

	});	

//Territory Function
	$('#set_territory').click(function(){
		var name = $('#territory_name').val();
		var area = $("#territory_area option:selected").val();
		var thana = $("#territory_thana option:selected").val();
		var territory_id = $('#set_territory').attr('data-id');
		var validate = '';
		if(territory_id == 0){
			var url = '{{ url('territory/store') }}';
		}else{
			var url = '{{ url('territory/update') }}';
		}
		 
		if(name.trim() === ''){
			validate = validate+'Territory name required<br>';
		}

		if(area.trim() === ''){
			validate = validate+'Area required<br>';
		}

		if(thana.trim() === ''){
			validate = validate+'Thana required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				name : name,
				territory_id:territory_id,
				area:area,
				thana:thana
			};

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$('.territory_success_message').show();
						$('.territory_error_message').hide();
						$('.territory_success_message').html(data.reason);
						location.reload();
					}
					else{
						$('.territory_success_message').hide();
						$('.territory_error_message').show();
						$('.territory_error_message').html(data.reason);
						var	result = 401;
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('.territory_success_message').hide();
			$('.territory_error_message').show();
			$('.territory_error_message').html(validate);
		}

		setTimeout(function(){
			$('.territory_success_message').hide();
			$('.territory_error_message').hide();
		}, 3000);

	});	

// Data Edit function
	function editData(a,b){
			var dataString = {
            _token: "{{ csrf_token() }}",
            table:b,
            id:a
        	};
        	var url = '{{ url('data/edit') }}';
			$.ajax({
	            type: "POST",
	            url: url,
	            data: dataString,
	            dataType: "json",
	            cache : false,
	            success: function(data){ console.log(data);
	                if(data.status == 200){
	                	$('.form-control').addClass('edited');

	                	if(b == 'division'){
	                		$('#set_division').attr('data-id',a);
	                		$('#divition_name').val(data.all.name);
							$('#addDivisionModal').modal('show');
	                	}

	                	if(b == 'zone'){
	                		$('#set_zone').attr('data-id',a);
	                		$('#zone_name').val(data.all.zone_name);
	                		$('#state').val(data.all.division_id);
							$('#addZoneModal').modal('show');
	                	}

	                	if(b == 'region'){
	                		$('#set_region').attr('data-id',a);
	                		$('#region_name').val(data.all.region_name);
	                		$('#region_zone').val(data.all.zone_id);
							$('#addRegionModal').modal('show');
	                	}

	                	if(b == 'area'){
	                		$('#set_area').attr('data-id',a);
	                		$('#area_name').val(data.all.area_name);
	                		$('#area_region').val(data.all.region_id);
							$('#addAreaModal').modal('show');
	                	}

	                	if(b == 'territory'){
	                		$('#set_territory').attr('data-id',a);
	                		$('#territory_name').val(data.all.name);
	                		$('#territory_area').val(data.all.area_id);
	                		$('#territory_thana').val(data.all.thana_id);
							$('#addTerritoryModal').modal('show');
	                	}

	                }

	            } ,error: function(xhr, status, error) {
	                alert(error);
	            },
        	});
	}

	// Data activate function
	function activateData(a,b){
		//$('#acceptRejectModal').modal('show');

		var dataString = {
			_token: "{{ csrf_token() }}",
			table:b,
			id:a,
			status:'Active'
		};
		var url = '{{ url('change_location_status') }}';
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){
				console.log(data);
				if(data.status==200){
					$('#'+b+'_active_'+a).hide();
					$('#'+b+'_inactive_'+a).show();
					//location.reload();
					$('.status_success_message').show();
					$('.status_error_message').hide();
					$('.status_success_message').html(data.reason);
				}
				else{
					$('.status_success_message').hide();
					$('.status_error_message').show();
					$('.status_error_message').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});

		setTimeout(function(){
			$('.status_success_message').hide();
			$('.status_error_message').hide();
		}, 2000);
	}

	// Data deactivate function
	function deactivateData(a,b){
		//$('#acceptRejectModal').modal('show');

		var dataString = {
			_token: "{{ csrf_token() }}",
			table:b,
			id:a,
			status:'Inactive'
		};
		var url = '{{ url('change_location_status') }}';
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){
				console.log(data);
				if(data.status==200){
					$('#'+b+'_inactive_'+a).hide();
					$('#'+b+'_active_'+a).show();
					//location.reload();
					$('.status_success_message').show();
					$('.status_error_message').hide();
					$('.status_success_message').html(data.reason);
				}
				else{
					$('.status_success_message').hide();
					$('.status_error_message').show();
					$('.status_error_message').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});

		setTimeout(function(){
			$('.status_success_message').hide();
			$('.status_error_message').hide();
		}, 2000);
	}


	$('#set_delete').click(function(){
		var id = $('#set_delete').attr('data-id');
		var b = $('#set_delete').attr('data-table');
		var dataString = {
            _token: "{{ csrf_token() }}",
            table:b,
            id:id
        	};
        	var url = '{{ url('data/delete') }}';
			$.ajax({
	            type: "POST",
	            url: url,
	            data: dataString,
	            dataType: "json",
	            cache : false,
	            success: function(data){ console.log(data);
	            		if(b == 'division'){
	                		$('#division'+id).remove();
	                	}

	                	if(b == 'zone'){
	                		$('#zone'+id).remove();
	                	}

	                	if(b == 'region'){
	                		$('#region'+id).remove();
	                	}

	                	if(b == 'area'){
	                		$('#area'+id).remove();
	                	}

	                	if(b == 'territory'){
	                		$('#territory'+id).remove();
	                	}
	                	
	                	$('#acceptRejectModal').modal('hide');
	                	$('.alert-success').removeClass('hidden');
	                	$('.alert-success').html(data.reson);
	                
	            } ,error: function(xhr, status, error) {
	                alert(error);
	            },
        	});
	});




//Common submit ajax function

	function submitAjax(url,dataString){ 
		//var result = '';
		$.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
                var result = 200;
                }
                else{
                var	result = 401;
                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
        return result;
	}

	//Validation Clear
	    $('.chcek-validation').keyup(function(){
	    	if($(this).length != ''){
	    		$(this).parents('.form-group').children('.help-block').removeClass('invalid');
	    	}
	    });

		$("#addDivisionModal").on('hidden.bs.modal', function () {
			//location.reload();
			$('#division_form')[0].reset();
		});
		$("#addZoneModal").on('hidden.bs.modal', function () {
			//location.reload();
			$('#zone_form')[0].reset();
		});
		$("#addRegionModal").on('hidden.bs.modal', function () {
			//location.reload();
			$('#region_form')[0].reset();
		});
		$("#addAreaModal").on('hidden.bs.modal', function () {
			//location.reload();
			$('#area_form')[0].reset();
		});
		$("#addTerritoryModal").on('hidden.bs.modal', function () {
			//location.reload();
			$('#territory_form')[0].reset();
		});

</script>


@if ($message = Session::get('key'))
<script type="text/javascript">
$( document ).ready(function() {
    var section = '{{ $message }}';
    if(section == 'zone'){
    	$('#sectionTab').children('li').removeClass('active');
    	$('#tabPane').children('.tab-pane').removeClass('in active');    
    	$('#zone').addClass('active');
    	$('#Zone').addClass('in active');
    }
    if(section == 'region'){
    	$('#sectionTab').children('li').removeClass('active');
    	$('#tabPane').children('.tab-pane').removeClass('in active');  
    	$('#region').addClass('active');
    	$('#Region').addClass('in active');
    }
    if(section == 'area'){
    	$('#sectionTab').children('li').removeClass('active');
    	$('#tabPane').children('.tab-pane').removeClass('in active');  
    	$('#area').addClass('active');
    	$('#Area').addClass('in active');
    }
    if(section == 'territory'){
    	$('#sectionTab').children('li').removeClass('active');
    	$('#tabPane').children('.tab-pane').removeClass('in active');  
    	$('#territory').addClass('active');
    	$('#Territory').addClass('in active');
    }


});	
</script>
@endif


@endsection