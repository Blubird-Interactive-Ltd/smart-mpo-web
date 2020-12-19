@extends('layouts.master')
@section('content')
	<style>
		.changed_sp_day {
			border: 2px solid #ec0909;
		}
		.changed_data label::after {
			background: #ec0909 !important;
		}
		.changed_data .bootstrap-select, .changed_data .dropdown-toggle, .changed_data textarea, .changed_data select{
			border-bottom: 1px solid #f30042 !important;
		}
		#pagination_area .pagination{
			float: right;
			margin-top: -15px;
			z-index: 999;
		}
		#ajax_loader_list {
			position:relative;
			height: 80px;
			width: 80px;
			z-index: 999;
			top: 0;
			left: 0;
			text-align: center;
			padding-top: 35%;
		}
		#ajax_loader_list>img{
			width: 55px !important;
			margin: 20px auto;
			display: block;
		}
	</style>
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>Doctor List</span>
			</li>
		</ul>
	</div>
	<!-- END PAGE BAR -->

	<div class="row m-t-25">
		<div class="col-lg-12">

			<!-- Audit List-->
			<div class="row">
				<div class="col-lg-12">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bar-chart font-dark hide"></i>
								<span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Doctor List</span>
							</div>

							<div class="actions">

								@if(\App\Utility::userRolePermission(Session::get('role_id'),9))
								<div class="btn-group btn-group-devided">
									<button type="button" class="btn btn-primary" id="add_new_product" data-toggle="modal" data-target="#addDoctorModal"><i class="icon-plus icons"></i>Add New</button>
								</div>
								@endif
							</div>
						</div>

						<div class="portlet-body">
							@if(\App\Utility::userRolePermission(Session::get('role_id'),9))
							<div class="">
								<select class="form-control edited three-option-filter-01" id="select_specialty">
									<option value="" selected="">Filter by Specialty</option>
									<?php foreach($specialities as $sp){?>
									<option value="{{ $sp->name }}">{{ $sp->name }}</option>
									<?php } ?>
								</select>

								<select class="form-control edited three-option-filter-02" id="select_class">
									<option value="" selected="">Filter by Class</option>
									<?php foreach($classes as $class){?>
									<option value="{{ $class->class_name }}">{{ $class->class_name }}</option>
									<?php } ?>
								</select>

								<select class="form-control edited three-option-filter-03" id="select_Honorarium">
									<option value="" selected="">Filter by Honorarium</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>

								<select class="form-control edited three-option-filter-04" id="select_doctor_status">
		                            <option value="" selected="">Filter by status</option>
									<option value="Active">Active</option>
									<option value="Pending">Pending</option>
									<option value="Update requested">Update requested</option>
		                        </select>

								<div class="form-inline custom-search">
									<form id="search_item_form" method="post" action="">
										<label for="">Search</label>
										<input class="form-control" type="text" id="search_text" name="search_text">
										<button class="btn btn-primary" type="button" id="search_button">Search</button>
									</form>
								</div>

								<div class="clearfix"></div>

								<div class="table-responsive m-t-20">
									<table class="table table-bordered" id="doctor_list" width="100%" cellspacing="0" id="doctor_list">
										<thead>
										<tr>
											<!--th class="w40">Sl. No.</th-->
											<th class="w150">Doctor name</th>
											<th class="text-center">Gender</th>
											<th class="text-center">Contact Number</th>
											<th class="text-center">Qualification</th>
											<th class="text-center w100">Specialty</th>
											<th class="text-center w100">Class</th>
											<th class="text-center w100">Honorarium</th>
											<th class="text-center w100">Created By</th>
											<th class="text-center">Status</th>
											<th class="w200 text-center">Action</th>
										</tr>
										</thead>
										<tbody id="set_doctor">

										</tbody>
									</table>
									<div id="pagination_area">

									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Doctor Modal -->
	<div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<form action="" method="POST" id="doctorAddForm">
				{{ csrf_field() }}
				<input type="hidden" id="doctor_id" name="doctor_id" value=""/>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add New Doctor</h4>
					</div>
					<div class="modal-body">

						<!-- Alert Massage Section -->
						<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
						<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
						<!-- Alert Massage Section -->

						<div class="row">
							<div class="col-sm-4 col-xs-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									<input type="text" class="form-control" id="name" name="name">
									<label for="">Doctor Name <span class="mandatory_field">*</span></label>
									<span class="help-block">Enter Doctor Name...</span>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="form-group form-md-line-input no-padding">
									<label>Select Gender <span class="mandatory_field">*</span></label>
									<select class="selectpicker form-control show-tick" id="gender" name="gender">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="m-b-35">
									<label for="specialty">Specialty <span class="mandatory_field">*</span></label> <br>
									<select class="selectpicker form-control show-tick" id="speciality" name="speciality[]" multiple>
										<option value="">Select speciality</option>
										<?php foreach($specialities as $sp){?>
										<option value="{{ $sp->speciality_id }}">{{ $sp->name }}</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									<input type="text" class="form-control" id="qualification" name="qualification">
									<label for="">Qualification <span class="mandatory_field">*</span></label>
									<span class="help-block">Enter Qualification</span>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="m-b-35">
									<label for="class">Class <span class="mandatory_field">*</span></label> <br>
									<select class="selectpicker form-control show-tick" id="class" name="class">
										<option value="">Select class</option>
										<?php foreach($classes as $class){?>
										<option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="m-b-35">
									<label for="">Honorarium <span class="mandatory_field">*</span></label> <br>
									<select class="selectpicker form-control show-tick" id="honorarium" name="honorarium">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" id="event_create" name="" placeholder="Select Date">
									<label for="">Doctor Special Day</label>
									<span class="help-block">Enter Doctor Special Day...</span>
								</div>

								<div id="special_day_area">

								</div>

								<label>Special Day List</label>
								<div class="event_list">

									<ul id="event_preview">

									</ul>
								</div>
							</div>

							<div class="col-sm-4 col-xs-12" id="ext_contact">
								<div class="form-group form-md-line-input form-md-floating-label">
									<div class="input-group input-group-sm">
										<div class="input-group-control">
											<input type="text" class="form-control input-sm" id="contact" name="contact[]">
											<label>Contact Number<span class="mandatory_field"> *</span></label>
											<span class="help-block">Enter Contact Number</span>
										</div>
										<span class="input-group-btn btn-right">
                                        <a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </span>
									</div>
									<span class="help-block">Enter Contact Number</span>
								</div>

								<div id="more_contact_num"></div>
							</div>

							<div class="col-sm-4 col-xs-12" id="email_section">
								<div class="form-group form-md-line-input form-md-floating-label">
									<div class="input-group input-group-sm">
										<div class="input-group-control">
											<input type="email" class="form-control input-sm" id="email" name="email[]">
											<label>Email<span class="mandatory_field"> *</span></label>
											<span class="help-block">Enter Email</span>
										</div>
										<span class="input-group-btn btn-right">
                                        <a class="btn btn-primary add_more_email" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </span>
									</div>
									<span class="help-block">Enter Email</span>
								</div>

								<div id="more_email"></div>
							</div>
						</div>

						<div class="clearfix"></div>

						<div id="doctor_chember_address">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">Chamber Address<span class="mandatory_field"> *</span></div>
									<div class="actions">
										<div class="btn-group btn-group-devided">
											<button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="row address_child">
										<div class="col-sm-4 col-xs-12">

											<div class="form-group form-md-line-input form-md-floating-label p-t-9">
												<textarea class="form-control h70" rows="3"  id="chamber_address1" name="chember_address1[]"></textarea>
												<label for="">Address Line 1<span class="mandatory_field"> *</span></label>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select Division <span class="mandatory_field">*</span></label>
												<select class="form-control chamber_division" id="chamber_division1" name="chamber_division[]" data-id="1">
													<option value="">Select Division</option>
													<?php foreach($divisions as $division){?>
													<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select District <span class="mandatory_field">*</span></label>
												<select class="form-control chamber_district" id="chamber_district1" name="chamber_district[]" data-id="1" >
													<option value="">Select District</option>
												</select>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select Thana/City <span class="mandatory_field">*</span></label>
												<select class="form-control chamber_thana" id="chamber_thana1" name="chamber_thana[]" data-id="1">
													<option value="">Select Thana/city</option>
												</select>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select ZIP <span class="mandatory_field">*</span></label>
												<select class="form-control chamber_zip" id="chamber_zip1" name="chamber_zip[]" data-id="1" >
													<option value="">Select ZIP</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">Home Address </div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input form-md-floating-label p-t-9">
											<textarea class="form-control h70" rows="3" id="home_address1" name="home_address1"></textarea>
											<label for="">Address Line 1</label>
											<span class="help-block">Enter Address Line 1</span>
										</div>
									</div>

									<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input">
											<label>Select Division</label>
											<select class="form-control" id="home_division" name="home_division">
												<option value="">Select Division</option>
												<?php foreach($divisions as $division){?>
												<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input">
											<label>Select District</label>
											<select class="form-control" id="home_district" name="home_district" disabled="">
												<option value="">Select District</option>
											</select>
										</div>
									</div>

									<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input">
											<label>Select Thana/City</label>
											<select class="form-control" id="home_thana" name="home_thana" disabled="">
												<option value="">Select Thana/city</option>
											</select>
										</div>
									</div>

									<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input">
											<label>Select ZIP </label>
											<select class="form-control" id="home_zip" name="home_zip" disabled="">
												<option value="">Select ZIP</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<span class="hidden" id="ajax_loader"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-success " id="save_doctor">Save changes</button>
						<button type="button" class="btn btn-success" id="accept_doctor" onclick="acceptRejectDoctor(1)" style="display:none">Accept</button>
						<button type="button" class="btn btn-danger" id="reject_doctor" onclick="acceptRejectDoctor(4)" style="display:none">Reject</button>
						<button type="button" class="btn btn-success" id="approve_changes" style="display:none">Accept</button>
						<button type="button" class="btn btn-danger" id="decline_changes" onclick="declineDoctorChanges()" style="display:none">Reject</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Edit Doctor Modal -->
	<!--div class="modal fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Doctor Details</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="edit_name" name="name">
		                        <label for="">Doctor Name <span class="mandatory_field">*</span></label>
		                        <span class="help-block">Enter Doctor Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input no-padding">
		        				<label>Select Gender <span class="mandatory_field">*</span></label>
		                         <select class="selectpicker form-control show-tick" multiple id="edit_gender" name="gender">
		        					<option value="Male">Male</option>
		        					<option value="Female">Female</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="m-b-35">
		                        <label for="specialty">Specialty <span class="mandatory_field">*</span></label> <br>
		                        <select class="selectpicker form-control show-tick" id="edit_speciality" name="speciality[]" multiple>
									<option value="">Select speciality</option>
									<?php foreach($specialities as $sp){?>
			<option value="{{ $sp->speciality_id }}">{{ $sp->name }}</option>
									<?php } ?>
			</select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input form-md-floating-label">
            <input type="text" class="form-control" id="edit_qualification" name="qualification">
            <label for="">Qualification <span class="mandatory_field">*</span></label>
            <span class="help-block">Enter Qualification</span>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="m-b-35">
            <label for="class">Class <span class="mandatory_field">*</span></label> <br>
            <select class="selectpicker form-control show-tick" id="edit_class" name="class">
                <option value="">Select class</option>
                <?php foreach($classes as $class){?>
			<option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
									<?php } ?>
			</select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="m-b-35">
            <label for="">Honorarium <span class="mandatory_field">*</span></label> <br>
            <select class="selectpicker form-control show-tick" id="edit_honorarium" name="honorarium">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <label>Doctor Special Day<span class="mandatory_field"> *</span></label>
        <div class="m-b-20" id="tempust_edit"></div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input form-md-floating-label">
            <div class="input-group input-group-sm">
                <div class="input-group-control">
                    <input type="text" class="form-control input-sm" id="" name="" value="0152151511">
                    <label>Contact Number<span class="mandatory_field"> *</span></label>
                    <span class="help-block">Enter Contact Number</span>
                </div>
                <span class="input-group-btn btn-right">
                    <a class="btn btn-danger dlt_contact" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    <a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </span>
            </div>
            <span class="help-block">Enter Contact Number</span>
        </div>

        <div class="form-group form-md-line-input form-md-floating-label">
            <div class="input-group input-group-sm">
                <div class="input-group-control">
                    <input type="text" class="form-control input-sm" id="" name="" value="0952151511">
                    <label>Contact Number<span class="mandatory_field"> *</span></label>
                    <span class="help-block">Enter Contact Number</span>
                </div>
                <span class="input-group-btn btn-right">
                    <a class="btn btn-danger dlt_contact" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    <a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </span>
            </div>
            <span class="help-block">Enter Contact Number</span>
        </div>

        <div id="more_contact_num"></div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input form-md-floating-label">
            <div class="input-group input-group-sm">
                <div class="input-group-control">
                    <input type="email" class="form-control input-sm" id="" name="" value="test@gmail.com">
                                        <label>Email<span class="mandatory_field"> *</span></label>
                                        <span class="help-block">Enter Email</span>
                                    </div>
                                    <span class="input-group-btn btn-right">
                                    	<a class="btn btn-danger dlt_email" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                        <a class="btn btn-primary add_more_email" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </span>
                                </div>
		                        <span class="help-block">Enter Email</span>
		                    </div>

		                    <div id="more_email"></div>
		        		</div>
		        	</div>

	        		<div class="clearfix"></div>

	        		<div id="doctor_chember_address">
		        		<div class="portlet light bordered">
		        			<div class="portlet-title">
		        				<div class="caption">Chamber Address<span class="mandatory_field"> *</span></div>
		        				<div class="actions">
	                                <div class="btn-group btn-group-devided">
	                                    <button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>
	                                </div>
	                            </div>
		        			</div>
		        			<div class="portlet-body">
				        		<div class="row">
					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label m-t-i12">
					                        <textarea class="form-control h70" rows="3" placeholder="Address Line 1" id="edit_chamber_address1" name="chember_address1[]"></textarea>
					                        <span class="help-block">Enter Address Line 1</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					                    <div class="form-group form-md-line-input">
					                        <select class="form-control" id="edit_chamber_division" name="chamber_division[]">
					                            <option value="">Select Division</option>
												<?php foreach($divisions as $division){?>
			<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
												<?php } ?>
			</select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input">
            <select class="form-control" id="edit_chamber_district" name="chamber_district[]" disabled="">
					                            <option value="">Select District</option>
					                        </select>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
										<div class="form-group form-md-line-input">
					                        <select class="form-control" id="edit_chamber_thana" name="chamber_thana[]" disabled="">
					                            <option value="">Select Thana/city</option>
					                        </select>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input">
					                        <select class="form-control" id="edit_chamber_thana" name="chamber_thana[]" disabled="">
					                            <option value="">Select ZIP</option>
					                        </select>
					                    </div>
					        		</div>
				        		</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="clearfix"></div>

	        		<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">Home Address </div>
						</div>
						<div class="portlet-body">
			        		<div class="row">
				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label m-t-i12">
				                        <textarea class="form-control h70" rows="3" placeholder="Address Line 1" id="edit_home_address1" name="home_address1[]"></textarea>
				                        <span class="help-block">Enter Address Line 1</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				                    <div class="form-group form-md-line-input">
				                        <select class="form-control" id="edit_home_division" name="">
				                            <option value="">Select Division</option>
											<?php foreach($divisions as $division){?>
			<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
											<?php } ?>
			</select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input">
            <select class="form-control" id="edit_home_district" name="home_district" disabled="">
                <option value="">Select District</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input">
            <select class="form-control" id="" name="home_thana" disabled="">
                <option value="">Select Thana/City</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="form-group form-md-line-input">
            <select class="form-control" id="edit_home_zip" name="home_zip" disabled="">
                <option value="">Select Zip</option>
            </select>
        </div>
    </div>
</div>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-success">Save changes</button>
</div>
</div>
</div>
</div-->

	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="DocDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Alert Massage Section -->
			<div class="alert alert-danger print-error-msg" style="display:none" id="del_error"><ul></ul></div>
			<div class="alert alert-success print-error-msg" style="display:none" id="del_success"></div>
			<!-- Alert Massage Section -->

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">&nbsp;</h4>
				</div>
				<div class="modal-body text-center">
					<h3 id="warning_message"></h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" data-id="" data-status="" class="btn btn-success" id="deldoc" data-dismiss="modal">Yes, Continue</a>
				</div>
			</div>

		</div>
	</div>
	<!-- Accept /reject modal END-->

	<!-- Add Event modal START-->
	<div id="add_event_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Doctor Special Day</h4>
				</div>
				<div class="modal-body text-center">
					<!-- Alert Massage Section -->
					<div class="alert alert-danger print-error-msg" style="display:none" id="spd_error"><ul></ul></div>
					<div class="alert alert-success print-error-msg" style="display:none" id="spd_success"></div>
					<!-- Alert Massage Section -->
					<form action="">
						<div class="m-b-35">
							<label for="">Doctor special day type<span class="mandatory_field">*</span></label> <br>
							<select class="selectpicker form-control show-tick" id="special_day_type" name="special_day_type[]">
								<option value="">Select Day Type</option>
								<?php foreach($special_day_types as $sp_day){?>
								<option value="{{ $sp_day->doctor_special_day_type_id.'#'.$sp_day->name }}">{{ $sp_day->name }}</option>
								<?php } ?>
							</select>
							<input type="hidden" id="event_date">
						</div>
						<div class="m-b-35">
							<label for="">Remark<span class="mandatory_field">*</span></label> <br>
							<textarea cols="60" rows="5" name="" id="remark"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" data-id="" data-status="" class="btn btn-success" id="add_special_day">Save</a>
				</div>
			</div>

		</div>
	</div>
	<!-- Add Event modal END-->

@endsection

@section('js')
	<script type="text/javascript">
		//Del product Ajax
		function delDoctor(a,b){
			if(b==1){
				$('#warning_message').text('Are you sure you want to activate this doctor?');
			}
			else{
				$('#warning_message').text('Are you sure you want to inactivate this doctor?');
			}

			$('#DocDelete').modal('show');
			$("#deldoc").attr('data-id',a);
			$("#deldoc").attr('data-status',b);
		}

		$("#deldoc").click(function(){
			var a = $("#deldoc").attr('data-id');
			var b = $("#deldoc").attr('data-status');
			var url = '{{ url('/doctor/doctorDelete') }}';
			var dataString = {
				_token: "{{ csrf_token() }}",
				id:a,status:b
			};
			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$("#del_success").css('display','block');
						$("#del_success").html(data.reason);
						setTimeout(function() {$('#del_success').hide(); },2000);
						setTimeout(function() {$('#proDelete').modal('hide');},2000);
						getData();
					}

					if(data.status == 401){
						$("#del_error").css('display','block');
						$("#del_error").html(data.reason);
						setTimeout(function() {$('#del_error').hide(); },3000);
						setTimeout(function() {$('#proDelete').modal('hide');},3000);
					}


				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		});

		$(document).on('click','#add_special_day', function(){
			//var selectedVal = $('#special_day_type').find("option:selected");
			var special_day_type = $('#special_day_type').val();
			var remark = $('#remark').val();
			var validate = '';
			var arrSelectedVal = [];

			var day_date = $('#event_date').val();
			if(special_day_type==''){
				validate = validate+'Select day type<br>';
			}
			if(remark.trim()==''){
				validate = validate+'Enter remark';
			}

			if(validate!=''){
				//alert('Select day type');
				$('#spd_success').hide();
				$('#spd_error').show();
				$('#spd_error').html(validate);
			}
			else{
				var html = '';
				var day_input_list = '';
				var children = ($("#doctor_chember_address > .chamber").length)+1;
				var split_val = special_day_type.split('#');

				arrSelectedVal.push(special_day_type);
				html += '<li>';
				html += '<p><i>'+custom_date_format(day_date)+'</i></p>';
				html += '<p>'+split_val[1]+'</p>';
				html += '<p>'+remark+'</p>';
				html += '<a class="remove_sp_day" data-id="'+children+'" href="javascript:;"><i class="icon-close icons"></i></a>';
				html += '</li>';

				day_input_list +='<div class="chamber" id="sp_day_'+children+'">';
				day_input_list +='<input type="hidden" name="special_day_type[]" value="'+split_val[0]+'">';
				day_input_list +='<input type="hidden" name="special_day_date[]" value="'+day_date+'">';
				day_input_list +='<input type="hidden" name="remark[]" value="'+remark+'">';
				day_input_list +='</div>';

				$('#special_day_area').append(day_input_list);
				$('#event_preview').append(html);
				$('#event_create').val('');
				$('#special_day_type').selectpicker('val', []);
				$('#event_date').val('');

				$('#spd_success').hide();
				$('#spd_error').hide();
				$('#spd_error').html('');
				$('#add_event_modal').modal('hide');
			}
		})


		//Save Doctor Ajax
		$("#save_doctor").click(function(){
			save_doctor();
		});

		//Approve Doctor changes Ajax
		$("#approve_changes").click(function(){
			save_doctor();
		});

		function save_doctor(){
			$('#ajax_loader').removeClass('hidden');
			$('#save_doctor').prop('disabled', true);
			var doctor_id = $('#doctor_id').val();
			var name = $('#name').val();
			var gender = $('#gender').val();
			var speciality = $('#speciality').val();
			var doctor_class = $('#class').val();
			var qualification = $('#qualification').val();
			var honorarium = $('#honorarium').val();
			var contact = $('#contact').val();
			var email = $('#email').val();
			var chamber_address = $('#chamber_address1').val();
			var chamber_division = $('#chamber_division1').val();
			var chamber_district = $('#chamber_district1').val();
			var chamber_thana = $('#chamber_thana1').val();
			var chamber_zip = $('#chamber_zip1').val();
			var email = $('#email').val();

			var validate = '';
			if(name.trim()==''){
				validate=validate+'Name is required<br>';
			}
			if(gender==''){
				validate=validate+'Gender is required<br>';
			}
			if(speciality===null){
				validate=validate+'Speciality is required<br>';
			}
			if(doctor_class.trim()==''){
				validate=validate+'Class is required<br>';
			}
			if(qualification.trim()==''){
				validate=validate+'Qualification is required<br>';
			}
			if(honorarium==''){
				validate=validate+'Honorarium is required<br>';
			}
			if(contact.trim()==''){
				validate=validate+'Contact is required<br>';
			}
			if(email.trim()==''){
				validate=validate+'Email is required<br>';
			}

			isValid = 1;
			$("#email_section input").each(function() {
				var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
				var element = $(this);
				if (element.val().trim() !='' && !emailRegex.test(element.val())) {
					//element.css('border','1px solid #f30000');
					isValid = 0;
				}
			});
			if(isValid==0){
				validate = validate+"Invalid email address</br>";
			}

			if(chamber_address.trim()==''){
				validate=validate+'Chamber address 1 is required<br>';
			}
			if(chamber_division.trim()==''){
				validate=validate+'Chamber division is required<br>';
			}
			if(chamber_district.trim()==''){
				validate=validate+'Chamber district is required<br>';
			}
			if(chamber_thana.trim()==''){
				validate=validate+'Chamber thana is required<br>';
			}
			if(chamber_zip.trim()==''){
				validate=validate+'Chamber zip is required<br>';
			}

			if(validate==''){
				if(doctor_id==''){
					var url = "{{ url('/doctor/doctorStore') }}";
				}
				else{
					var url = "{{ url('/doctor/doctorUpdate') }}";
				}
				var formData = new FormData($('#doctorAddForm')[0]);
				var url = url;
				$.ajax({
					type: "POST",
					url: url,
					data: formData,
					async: false,
					success: function (data) { console.log(data);
						if(data.status == 200){
							$('#save_doctor').removeClass('disabled');
							$("#success").show();
							$("#error").hide();
							$("#success").html(data.reason);
							setTimeout(function() {$('#success').hide(); },3000);
							setTimeout(function() {$('#addDoctorModal').modal('hide');},3000);
							//getData();
							location.reload(true);
						}

						if(data.status == 401){
							$('#ajax_loader').addClass('hidden');
							$('#save_doctor').prop('disabled', false);
							printErrorMsg(data.error);
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
			else{
				$("#success").hide();
				$("#error").show();
				$("#error").html(validate);
				$('#ajax_loader').addClass('hidden');
				$('#save_doctor').prop('disabled', false);
			}
			$('#addDoctorModal').animate({ scrollTop: 0 }, 'slow');
		}

		function declineDoctorChanges(){
			var url = "{{ url('/doctor/decline_doctor_changes') }}";
			var formData = new FormData($('#doctorAddForm')[0]);
			var url = url;
			$.ajax({
				type: "POST",
				url: url,
				data: formData,
				async: false,
				success: function (data) {
					if(data.status == 200){
						$('#save_doctor').removeClass('disabled');
						$("#success").show();
						$("#error").hide();
						$("#success").html(data.reason);
						setTimeout(function() {$('#success').hide(); },3000);
						setTimeout(function() {$('#addDoctorModal').modal('hide');},3000);
						getData();
						location.reload();
					}

					if(data.status == 401){
						$('#save_doctor').prop('disabled', false);
						printErrorMsg(data.error);
					}
				},
				cache: false,
				contentType: false,
				processData: false
			});
			$('#addDoctorModal').animate({ scrollTop: 0 }, 'slow');
		}

		// A $( document ).ready() block.
		$( document ).ready(function() {
			getData();
		});

		//Get Data Ajax Function
		function getData(){
			var loader = '<tr>';
			loader += '<td colspan="10"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
			loader += '</tr>';
			$('#set_doctor').html(loader);

			var search_string = $('#search_text').val();
			if(search_string==''){
				var url = "{{ url('/doctor/getDoctor') }}";
			}
			else{
				var url = "{{ url('/') }}/doctor/getDoctor?search_string="+search_string;
			}

			var dataString = {
				_token: "{{ csrf_token() }}",
			};

			$.ajax({
				type: "GET",
				url: url,
				data: {},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						//Datatable destroy function
						$('#doctor_list').DataTable().destroy();

						var html = '';
						var count = 1;
						$.each(data.val.data, function (index, value) {
							var d_contact = '';
							var d_specialities = '';

							if(value.name !== null){ var name = value.name}else{ var name = ''; }
							if(value.gender !== null){ var gender = value.gender}else{ var gender = ''; }
							if(value.qualification !== null){ var qualification = value.qualification}else{ var qualification = ''; }
							if(value.class_name !== null){ var class_name = value.class_name}else{ var class_name = ''; }
							if(value.honorium == 1){ var honorium = 'Yes'}else{ var honorium = 'No'; }
                            if(value.first_name !== null){ var first_name = value.first_name}else{ var first_name = ''; }
                            if(value.last_name !== null){ var last_name = value.last_name}else{ var last_name = ''; }

							if(value.status == 'pending' && value.is_edit_requst == 1)
								{ var status = 'Upadate requested';}
							else if(value.status == 'pending')
								{ var status = 'Pending'; }else{ var status = 'Active';}

							$.each(value.contacts, function (index, contact) {
								d_contact +=contact.contact_no;
								if(index < value.contacts.length-1){
									d_contact +='<br>';
								}
							});

							$.each(value.doctor_specialities, function (index, d_sp) {
								d_specialities +=d_sp.name;
								if(index < value.doctor_specialities.length-1 ){
									d_specialities +=',';
								}
							});

							html += '<tr>';
							//html += '<td class="text-center">'+count+'</td>';
							html += '<td class="text-center">'+name+'</td>';
							html += '<td class="text-center">'+gender +'</td>';
							html += '<td class="text-center">'+d_contact +'</td>';
							html += '<td class="text-center">'+qualification+'</td>';
							html += '<td class="text-center">'+d_specialities +'</td>';
							html += '<td class="text-center">'+class_name+'</td>';
							html += '<td class="text-center">'+honorium+'</td>';
							html += '<td class="text-center">'+first_name+" "+last_name+'</td>';
							html += '<td class="text-center">'+status+'</td>';
							html += '<td class="text-center">'

							if(value.status == 'pending') {
								@if(\App\Utility::userRolePermission(Session::get('role_id'),74))
								if(value.is_edit_request == 1){
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editRequestDoctor('+value.doctor_id+')"><i class="fa fa-wrench" aria-hidden="true"></i></a>';
								}
								else{
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editDoctor(' + value.doctor_id + ',\'pending\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								}
								@endif
							}
							else{
								@if(\App\Utility::userRolePermission(Session::get('role_id'),11))
								html += '<a href="javascript:;" class="btn btn-sm btn-info" title="Edit" onclick="editDoctor(' + value.doctor_id + ',\'active\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								@endif
							}

							@if(\App\Utility::userRolePermission(Session::get('role_id'),12))
							if(value.status == 'active'){
								html += '<a href="#" class="btn btn-sm btn-danger" title="Inactive" onclick="delDoctor('+value.doctor_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
							}
							else if(value.status == 'inactive'){
								html += '<a href="#" class="btn btn-sm btn-success" title="Active" onclick="delDoctor('+value.doctor_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
							}
							@endif


							@if(\App\Utility::userRolePermission(Session::get('role_id'),13))
							html += '<a title="View" href="{{url('/')}}/doctor_details/'+value.doctor_id+'" class="btn btn-sm btn-success">';
							html += '<i class="fa fa-eye" aria-hidden="true"></i>';
							html += '</a>';
							@endif
							html += '</td>';
							html += '</tr>';
							count++;
						});
						$('#set_doctor').html(html);
						$('#pagination_area').html(data.pagination);

						//Datatable Initialize

						var doctor_list = $('#doctor_list').DataTable({
							"paging": false,
							"lengthChange": false,
							"ordering": false
						});

						$('#doctor_list_filter').hide();

						$('#select_specialty').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(4)
									.search(select_val)
									.draw();
						});
						$('#select_class').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(5)
									.search(select_val)
									.draw();
						});
						$('#select_Honorarium').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(6)
									.search(select_val)
									.draw();
						});

						$('#select_doctor_status').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(8)
									.search(select_val)
									.draw();
						});

						
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}


		$(document).on('click','.pagination>li>a',function(e) {
			e.preventDefault();
			var loader = '<tr>';
			loader += '<td colspan="10"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
			loader += '</tr>';
			$('#set_doctor').html(loader);

			var search_string = $('#search_text').val();
			var url = $(this).attr('href');
			$.ajax({
				type: "GET",
				url: url,
				data: {search_string:search_string},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						//Datatable destroy function
						$('#doctor_list').DataTable().destroy();

						var html = '';
						var count = 1;
						$.each(data.val.data, function (index, value) {
							var d_contact = '';
							var d_specialities = '';

							if(value.name !== null){ var name = value.name}else{ var name = ''; }
							if(value.gender !== null){ var gender = value.gender}else{ var gender = ''; }
							if(value.qualification !== null){ var qualification = value.qualification}else{ var qualification = ''; }
							if(value.class_name !== null){ var class_name = value.class_name}else{ var class_name = ''; }
							if(value.honorium == 1){ var honorium = 'Yes'}else{ var honorium = 'No'; }

							if(value.status == 'pending' && value.is_edit_requst == 1)
							{ var status = 'Upadate requested';}
							else if(value.status == 'pending')
							{ var status = 'Pending'; }else{ var status = 'Active';}

							$.each(value.contacts, function (index, contact) {
								d_contact +=contact.contact_no;
								if(index < value.contacts.length-1){
									d_contact +='<br>';
								}
							});

							$.each(value.doctor_specialities, function (index, d_sp) {
								d_specialities +=d_sp.name;
								if(index < value.doctor_specialities.length-1 ){
									d_specialities +=',';
								}
							});

							html += '<tr>';
							//html += '<td class="text-center">'+count+'</td>';
							html += '<td class="text-center">'+name+'</td>';
							html += '<td class="text-center">'+gender +'</td>';
							html += '<td class="text-center">'+d_contact +'</td>';
							html += '<td class="text-center">'+qualification+'</td>';
							html += '<td class="text-center">'+d_specialities +'</td>';
							html += '<td class="text-center">'+class_name+'</td>';
							html += '<td class="text-center">'+honorium+'</td>';
							html += '<td class="text-center">'+status+'</td>';
							html += '<td class="text-center">'

							if(value.status == 'pending') {
								@if(\App\Utility::userRolePermission(Session::get('role_id'),74))
								if(value.is_edit_request == 1){
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editRequestDoctor('+value.doctor_id+')"><i class="fa fa-wrench" aria-hidden="true"></i></a>';
								}
								else{
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editDoctor(' + value.doctor_id + ',\'pending\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								}
								@endif
							}
							else{
								@if(\App\Utility::userRolePermission(Session::get('role_id'),11))
										html += '<a href="javascript:;" class="btn btn-sm btn-info" title="Edit" onclick="editDoctor(' + value.doctor_id + ',\'active\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								@endif
							}

							@if(\App\Utility::userRolePermission(Session::get('role_id'),12))
							if(value.status == 'active'){
								html += '<a href="#" class="btn btn-sm btn-danger" title="Inactive" onclick="delDoctor('+value.doctor_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
							}
							else if(value.status == 'inactive'){
								html += '<a href="#" class="btn btn-sm btn-success" title="Active" onclick="delDoctor('+value.doctor_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
							}
							@endif


									@if(\App\Utility::userRolePermission(Session::get('role_id'),13))
									html += '<a title="View" href="{{url('/')}}/doctor_details/'+value.doctor_id+'" class="btn btn-sm btn-success">';
							html += '<i class="fa fa-eye" aria-hidden="true"></i>';
							html += '</a>';
							@endif
									html += '</td>';
							html += '</tr>';
							count++;
						});
						$('#set_doctor').html(html);
						$('#pagination_area').html(data.pagination);

						//Datatable Initialize

						var doctor_list = $('#doctor_list').DataTable({
							"paging": false,
							"lengthChange": false
						});

						$('#doctor_list_filter').hide();

						$('#select_specialty').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(4)
									.search(select_val)
									.draw();
						});
						$('#select_class').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(5)
									.search(select_val)
									.draw();
						});
						$('#select_Honorarium').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(6)
									.search(select_val)
									.draw();
						});

						$('#select_doctor_status').change(function(){
							var select_val = $(this).val();
							doctor_list
									.columns(7)
									.search(select_val)
									.draw();
						});


					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		});


		//Print error Message JS function
		function printErrorMsg (msg) {
			$("#error").find("ul").html('');
			$("#error").css('display','block');
			$.each( msg, function( key, value ) {
				$("#error").find("ul").append('<li>'+value+'</li>');
			});
			setTimeout(function() { $('#error').hide(); }, 5000);
		}
		//Print error Message JS function
		function printErrorMsgEdit (msg) {
			$("#edit_error").find("ul").html('');
			$("#edit_error").css('display','block');
			$.each( msg, function( key, value ) {
				$("#edit_error").find("ul").append('<li>'+value+'</li>');
			});
			setTimeout(function() { $('#edit_error').hide(); }, 3000);
		}

		function editDoctor(id,status){
			var url = "{{ url('doctor_details_ajax') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {doctor_id:id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#doctor_id').val(data.doctor.doctor_id);

						$('#name').val(data.doctor.name);

						//$('#gender').val(data.doctor.gender);
						$('#gender').selectpicker('val', [data.doctor.gender]);
						$('#qualification').val(data.doctor.qualification);
						//$('#class').val(data.doctor.class_id);

						$('#class').selectpicker('val', [data.doctor.class_id]);
						$('#honorarium').selectpicker('val', [data.doctor.honorium]);


						/*Special days area*/
						var speciality = [];
						$.each(data.doctor.doctor_specialities, function( index, spc ) {
							speciality.push(spc.speciality_id);
						});
						$('#speciality').selectpicker('val', speciality);
						/*Special days area ends*/

						/*Special days area*/
						var html = '';
						var day_input_list = '';
						$.each(data.doctor.special_days, function( index, sp_day ) {
							var child = index+1;
							html += '<li>';
							html += '<p><i>'+custom_date_format(sp_day.date)+'</i></p>';
							html += '<p>'+sp_day.name+'</p>';
							html += '<p>'+sp_day.message+'</p>';
							html += '<a class="remove_sp_day" data-id="'+child+'" href="javascript:;"><i class="icon-close icons"></i></a>';
							html += '</li>';

							day_input_list +='<div class="chamber" id="sp_day_'+child+'">';
							day_input_list +='<input type="hidden" name="special_day_type[]" value="'+sp_day.special_day_id+'">';
							day_input_list +='<input type="hidden" name="special_day_date[]" value="'+sp_day.date+'">';
							day_input_list +='<input type="hidden" name="remark[]" value="'+sp_day.message+'">';
							day_input_list +='</div>';
						});
						$('#special_day_area').append(day_input_list);
						$('#event_preview').append(html);
						/*Special days area ends*/

						var contact_list = '';
						$.each(data.doctor.contacts, function( index, contact ) {
							contact_list +='<div class="more-contact-wrapper form-group form-md-line-input form-md-floating-label">';
							contact_list +='<div class="input-group input-group-sm">';
							contact_list +='<div class="input-group-control">';
							contact_list +='<input type="text" class="form-control input-sm" id="contact" name="contact[]" value="'+contact.contact_no+'">';
							contact_list +='<label>Contact Number<span class="mandatory_field"> *</span></label>';
							contact_list +='<span class="help-block">Enter Contact Number</span>';
							contact_list +='</div>';
							contact_list +='<span class="input-group-btn btn-right">';
							if(index>0){
								contact_list += '<a class="btn btn-danger dlt_contact" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
							}
							contact_list +='<a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
							contact_list +='</span>';
							contact_list +='</div>';
							contact_list +='<span class="help-block">Enter Contact Number</span>';
							contact_list +='</div>';
						});
						contact_list +='<div id="more_contact_num"></div>';
						$('#ext_contact').html(contact_list);

						var emails = data.doctor.email.split(",");
						var email_list = '';
						$.each(emails, function( index, email ) {
							email_list +='<div class="more-email-wrapper form-group form-md-line-input form-md-floating-label">';
							email_list +='<div class="input-group input-group-sm">';
							email_list +='<div class="input-group-control">';
							email_list +='<input type="email" class="form-control input-sm" id="email" name="email[]" value="'+email+'">';
							email_list +='<label>Email<span class="mandatory_field"> *</span></label>';
							email_list +='<span class="help-block">Enter Email</span>';
							email_list +='</div>';
							email_list +='<span class="input-group-btn btn-right">';
							if(index>0){
								email_list += '<a class="btn btn-danger dlt_email" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
							}
							email_list +='<a class="btn btn-primary add_more_email" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
							email_list +='</span>';
							email_list +='</div>';
							email_list +='<span class="help-block">Enter Email</span>';
							email_list +='</div>';

						});
						email_list +='<div id="more_email"></div></div>';
						$('#email_section').html(email_list);

						/*Populate chamber address*/

						var divisions ='<option value="">Select Division</option>';
						<?php foreach($divisions as $division){?>
								divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
								<?php } ?>

						var html = '';
						var children = 0;
						$.each(data.doctor.chambers, function( index, chamber ) {
							children = index+1;
							html += '<div class="portlet light bordered">';
							html += '<div class="portlet-title">';
							html += '<div class="caption">Chamber Address</div>';
							html += '<div class="actions">';
							html += '<div class="btn-group btn-group-devided">';
							html += '<button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>';
							if(index>0){
								html += '<button type="button" class="btn btn-danger remove_chember"><i class="icon-minus icons"></i>Remove</button>';
							}
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '<div class="portlet-body">';
							html += '<div class="row address_child">';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
							html += '<textarea class="form-control h70 edited" rows="3" id="chamber_address'+children+'" name="chember_address1[]">'+chamber.address_line1+'</textarea>';
							html += '<label for="">Address Line 1</label>';
							html += '<span class="help-block">Enter Address Line 1</span>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select Division <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_division" id="chamber_division'+children+'" name="chamber_division[]" data-id="'+children+'">';
							html += divisions;
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select District <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_district" id="chamber_district'+children+'" name="chamber_district[]" data-id="'+children+'">';
							html += '<option value="">Select District</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select Thana/City <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_thana" id="chamber_thana'+children+'" name="chamber_thana[]" data-id="'+children+'">';
							html += '<option value="">Select Thana/city</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select ZIP <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_zip" id="chamber_zip'+children+'" name="chamber_zip[]" data-id="'+children+'">';
							html += '<option value="">Select ZIP</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';

						});
						$('#doctor_chember_address').html(html);


						var children2 = 0;
						$.each(data.doctor.chambers, function( index, chamber ) {
							children2 = index+1;
							$('#chamber_division'+children2).val(chamber.division);
							populate_chamber_district(chamber.division, chamber.district, children2);
							populate_chamber_thana(chamber.district, chamber.thana, children2);
							populate_chamber_zip(chamber.thana, chamber.zip, children2);
						});

						/*Populate chamber address ends*/

						/*Populate home address*/
						$('#home_address1').val(data.doctor.home_address[0].address_line1);
						$('#home_division').val(data.doctor.home_address[0].division);

						populate_home_district(data.doctor.home_address[0].division,data.doctor.home_address[0].district);
						populate_home_thana(data.doctor.home_address[0].district,data.doctor.home_address[0].thana);
						populate_home_zip(data.doctor.home_address[0].thana,data.doctor.home_address[0].zip);
						/*Populate home address ends*/

						$('#myModalLabel').text('Edit Doctor');
						$('#addDoctorModal').modal('show');

						$("form input,form textarea").each(function() {
							var element = $(this);
							if (element.val() != "") {
								element.addClass('edited');
							}
						});

						if(status=='active'){
							$('#save_doctor').show();
							$('#accept_doctor').hide();
							$('#reject_doctor').hide();
							$('#approve_changes').hide();
							$('#decline_changes').hide();
						}
						else{ // status==pending
							$('#save_doctor').hide();
							$('#accept_doctor').show();
							$('#reject_doctor').show();
							$('#approve_changes').hide();
							$('#decline_changes').hide();
						}
					}
					else{
						alert(data);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}



		function editRequestDoctor(id){
			var url = "{{ url('doctor_details_ajax') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {doctor_id:id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						//detect_changes(data.doctor,data.doctor_edit_detail);

						$('#doctor_id').val(data.doctor.doctor_id);

						$('#name').val(data.doctor_edit_detail.name);
						if(data.doctor.name != data.doctor_edit_detail.name){
							$('#name').parent('.form-group').addClass('changed_data')
						}

						//$('#gender').val(data.doctor.gender);
						$('#gender').selectpicker('val', [data.doctor_edit_detail.gender]);
						if(data.doctor.gender != data.doctor_edit_detail.gender){
							$('#gender').parents('.form-group').addClass('changed_data')
						}

						$('#qualification').val(data.doctor_edit_detail.qualification);
						if(data.doctor.qualification != data.doctor_edit_detail.qualification){
							$('#qualification').parent('.form-group').addClass('changed_data')
						}

						//$('#class').val(data.doctor.class_id);

						$('#class').selectpicker('val', [data.doctor_edit_detail.class_id]);
						if(data.doctor.class_id != data.doctor_edit_detail.class_id){
							$('#class').parents('.m-b-35').addClass('changed_data')
						}

						$('#honorarium').selectpicker('val', [data.doctor_edit_detail.honorium]);
						if(data.doctor.honorium != data.doctor_edit_detail.honorium){
							$('#honorarium').parents('.m-b-35').addClass('changed_data')
						}


						/*Speciality area*/
						var original_speciality =[];
						var sp_changed = 0;
						var speciality = jQuery.parseJSON(data.doctor_edit_detail.specialities);
						$.each(data.doctor.doctor_specialities, function( index, original_spc ) {
							original_speciality.push(original_spc.speciality_id);
						});
						var is_same = (original_speciality.length == speciality.length) && original_speciality.every(function(element, index) {
									return element === speciality[index];
								});
						if(!is_same){
							$('#speciality').parents('.m-b-35').addClass('changed_data')
						}
						$('#speciality').selectpicker('val', speciality);
						/*Speciality area ends*/


						/*Special days area*/
						var html = '';
						var day_input_list = '';
						var original_special_days = [];
						var changed_special_days = jQuery.parseJSON(data.doctor_edit_detail.special_days);

						$.each(data.doctor.special_days, function( index, org_sp_day ) {
							original_special_days.push(org_sp_day.date+"("+org_sp_day.special_day_id+")");
						});
						console.log(original_special_days);
						$.each(changed_special_days, function( index, sp_day ) {
							if(jQuery.inArray(sp_day.data+"("+sp_day.special_day_id+")", original_special_days) != -1) {
								var c_class = '';
							} else {
								var c_class = ' changed_sp_day';
							}

							var child = index+1;
							html += '<li class='+c_class+'>';
							html += '<p><i>'+custom_date_format(sp_day.date)+'</i></p>';
							html += '<p>'+sp_day.name+'</p>';
							html += '<a class="remove_sp_day" data-id="'+child+'" href="javascript:;"><i class="icon-close icons"></i></a>';
							html += '</li>';

							day_input_list +='<div class="chamber" id="sp_day_'+child+'">';
							day_input_list +='<input type="hidden" name="special_day_type[]" value="'+sp_day.special_day_id+'">';
							day_input_list +='<input type="hidden" name="special_day_date[]" value="'+sp_day.date+'">';
							day_input_list +='</div>';
						});
						$('#special_day_area').append(day_input_list);
						$('#event_preview').append(html);
						/*Special days area ends*/

						var contact_list = '';
						var org_contact =[];
						var contacts = jQuery.parseJSON(data.doctor_edit_detail.contacts);
						$.each(data.doctor.contacts, function( index, original_contact ) {
							org_contact.push(original_contact.contact_no);
						});
						$.each(contacts, function( index, contact ) {
							if(jQuery.inArray(contact.contact_no, org_contact) != -1) {
								var c_class = '';
							} else {
								var c_class = ' changed_data';
							}

							contact_list +='<div class="more-contact-wrapper form-group form-md-line-input form-md-floating-label">';
							contact_list +='<div class="input-group input-group-sm">';
							contact_list +='<div class="input-group-control'+c_class+'">';
							contact_list +='<input type="text" class="form-control input-sm" id="contact" name="contact[]" value="'+contact.contact_no+'">';
							contact_list +='<label>Contact Number<span class="mandatory_field"> *</span></label>';
							contact_list +='<span class="help-block">Enter Contact Number</span>';
							contact_list +='</div>';
							contact_list +='<span class="input-group-btn btn-right">';
							if(index>0){
								contact_list += '<a class="btn btn-danger dlt_contact" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
							}
							contact_list +='<a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
							contact_list +='</span>';
							contact_list +='</div>';
							contact_list +='<span class="help-block">Enter Contact Number</span>';
							contact_list +='</div>';
						});
						contact_list +='<div id="more_contact_num"></div>';
						$('#ext_contact').html(contact_list);


						var original_emails = data.doctor.email.split(",");
						var changed_emails = data.doctor_edit_detail.email.split(",");
						var email_list = '';
						$.each(changed_emails, function( index, email ) {
							if(jQuery.inArray(email, original_emails) != -1) {
								var c_class = '';
							} else {
								var c_class = ' changed_data';
							}
							email_list +='<div class="more-email-wrapper form-group form-md-line-input form-md-floating-label">';
							email_list +='<div class="input-group input-group-sm">';
							email_list +='<div class="input-group-control'+c_class+'">';
							email_list +='<input type="email" class="form-control input-sm" id="email" name="email[]" value="'+email+'">';
							email_list +='<label>Email<span class="mandatory_field"> *</span></label>';
							email_list +='<span class="help-block">Enter Email</span>';
							email_list +='</div>';
							email_list +='<span class="input-group-btn btn-right">';
							if(index>0){
								email_list += '<a class="btn btn-danger dlt_email" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
							}
							email_list +='<a class="btn btn-primary add_more_email" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
							email_list +='</span>';
							email_list +='</div>';
							email_list +='<span class="help-block">Enter Email</span>';
							email_list +='</div>';

						});
						email_list +='<div id="more_email"></div></div>';
						$('#email_section').html(email_list);

						/*Populate chamber address*/

						var divisions ='<option value="">Select Division</option>';
						<?php foreach($divisions as $division){?>
								divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
								<?php } ?>

						var html = '';
						var original_address1 = [];
						var changed_chambers = jQuery.parseJSON(data.doctor_edit_detail.chamber_address);
						var children = 0;

						$.each(data.doctor.chambers, function( index, org_chamber ) {
							original_address1.push(org_chamber.address_line1);
						});
						$.each(changed_chambers, function( index, chamber ) {
							if(jQuery.inArray(chamber.address_line1, original_address1) != -1) {
								var c_class = '';
							} else {
								var c_class = ' changed_data';
							}

							children = index+1;
							html += '<div class="portlet light bordered'+c_class+'">';
							html += '<div class="portlet-title">';
							html += '<div class="caption">Chamber Address</div>';
							html += '<div class="actions">';
							html += '<div class="btn-group btn-group-devided">';
							html += '<button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>';
							if(index>0){
								html += '<button type="button" class="btn btn-danger remove_chember"><i class="icon-minus icons"></i>Remove</button>';
							}
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '<div class="portlet-body">';
							html += '<div class="row address_child">';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
							html += '<textarea class="form-control h70" rows="3" id="chamber_address'+children+'" name="chember_address1[]">'+chamber.address_line1+'</textarea>';
							html += '<label for="">Address Line 1</label>';
							html += '<span class="help-block">Enter Address Line 1</span>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<select class="form-control chamber_division" id="chamber_division'+children+'" name="chamber_division[]" data-id="'+children+'">';
							html += divisions;
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select Division <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_district" id="chamber_district'+children+'" name="chamber_district[]" data-id="'+children+'">';
							html += '<option value="">Select District</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<label>Select Thana/City <span class="mandatory_field">*</span></label>';
							html += '<select class="form-control chamber_thana" id="chamber_thana'+children+'" name="chamber_thana[]" data-id="'+children+'">';
							html += '<option value="">Select Thana/city</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '<div class="col-sm-4 col-xs-12">';
							html += '<div class="form-group form-md-line-input">';
							html += '<select class="form-control chamber_zip" id="chamber_zip'+children+'" name="chamber_zip[]" data-id="'+children+'">';
							html += '<option value="">Select ZIP</option>';
							html += '</select>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';
							html += '</div>';

						});
						$('#doctor_chember_address').html(html);


						var children2 = 0;
						$.each(changed_chambers, function( index, chamber ) {
							children2 = index+1;
							$('#chamber_division'+children2).val(chamber.division);
							populate_chamber_district(chamber.division, chamber.district, children2);
							populate_chamber_thana(chamber.district, chamber.thana, children2);
							populate_chamber_zip(chamber.thana, chamber.zip, children2);
						});

						/*Populate chamber address ends*/

						/*Populate home address*/
						$('#home_address1').val(data.doctor_edit_detail.home_address1);
						if(data.doctor.address_line1 != data.doctor_edit_detail.home_address1){
							$('#home_address1').parents('.form-group').addClass('changed_data')
						}
						$('#home_division').val(data.doctor_edit_detail.home_division);
						if(data.doctor.division != data.doctor_edit_detail.home_division){
							$('#home_division').parents('.col-sm-4').addClass('changed_data')
						}

						populate_home_district(data.doctor.home_address[0].division,data.doctor.home_address[0].district);
						populate_home_thana(data.doctor.home_address[0].district,data.doctor.home_address[0].thana);
						populate_home_zip(data.doctor.home_address[0].thana,data.doctor.home_address[0].zip);
						/*Populate home address ends*/

						$('#myModalLabel').text('Edit Doctor');
						$('#addDoctorModal').modal('show');

						$("form input").each(function() {
							var element = $(this);
							if (element.val() != "") {
								element.addClass('edited');
							}
						});

						$('#save_doctor').hide();
						$('#accept_doctor').hide();
						$('#reject_doctor').hide();
						$('#approve_changes').show();
						$('#decline_changes').show();
					}
					else{
						alert(data);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}



		function acceptRejectDoctor(status){
			var doctor_id = $("#doctor_id").val();
			var url = '{{ url('/doctor/doctorDelete') }}';
			var dataString = {
				_token: "{{ csrf_token() }}",
				id:doctor_id,status:status
			};
			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						$("#success").show();
						$("#error").hide();
						$("#success").html(data.reason);
						$('#addDoctorModal').animate({ scrollTop: 0 }, 'slow');
						setTimeout(function() {$('#success').hide(); },2000);
						setTimeout(function() {$('#addDoctorModal').modal('hide');},2000);
						getData();
					}

					if(data.status == 401){
						$("#error").css('display','block');
						$("#error").html(data.reason);
						setTimeout(function() {$('#error').hide(); },3000);
						//setTimeout(function() {$('#addDoctorModal').modal('hide');},3000);
					}


				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}

		function custom_date_format(date){
			var m_names = new Array("January", "February", "March",
					"April", "May", "June", "July", "August", "September",
					"October", "November", "December");
			var d = new Date(date);
			var curr_date = d.getDate();
			var curr_month = d.getMonth();
			var curr_year = d.getFullYear();
			return m_names[curr_month] + " " + curr_date + ", " + curr_year;
		}


		// Add Chember list START
		$(document).on('click','.add_chember',function(){

			var children = $("#doctor_chember_address > div").length;
			children = children+1;

			var divisions ='<option value="">Select Division</option>';
			<?php foreach($divisions as $division){?>
					divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
					<?php } ?>

			var html = '<div class="portlet light bordered">';
			html += '<div class="portlet-title">';
			html += '<div class="caption">Chamber Address</div>';
			html += '<div class="actions">';
			html += '<div class="btn-group btn-group-devided">';
			html += '<button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>';
			html += '<button type="button" class="btn btn-danger remove_chember"><i class="icon-minus icons"></i>Remove</button>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '<div class="portlet-body">';
			html += '<div class="row address_child">';
			html += '<div class="col-sm-4 col-xs-12">';
			html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
			html += '<textarea class="form-control h70" rows="3" id="chamber_address'+children+'" name="chember_address1[]"></textarea>';
			html += '<label for="">Address Line 1</label>';
			html += '<span class="help-block">Enter Address Line 1</span>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-sm-4 col-xs-12">';
			html += '<div class="form-group form-md-line-input">';
			html += '<label>Select Division <span class="mandatory_field">*</span></label>';
			html += '<select class="form-control chamber_division" id="chamber_division'+children+'" name="chamber_division[]" data-id="'+children+'">';
			html += divisions;
			html += '</select>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-sm-4 col-xs-12">';
			html += '<div class="form-group form-md-line-input">';
			html += '<label>Select District <span class="mandatory_field">*</span></label>';
			html += '<select class="form-control chamber_district" id="chamber_district'+children+'" name="chamber_district[]" data-id="'+children+'">';
			html += '<option value="">Select District</option>';
			html += '</select>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-sm-4 col-xs-12">';
			html += '<div class="form-group form-md-line-input">';
			html += '<label>Select Thana/City <span class="mandatory_field">*</span></label>';
			html += '<select class="form-control chamber_thana" id="chamber_thana'+children+'" name="chamber_thana[]" data-id="'+children+'">';
			html += '<option value="">Select Thana/city</option>';
			html += '</select>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-sm-4 col-xs-12">';
			html += '<div class="form-group form-md-line-input">';
			html += '<label>Select Thana/City <span class="mandatory_field">*</span></label>';
			html += '<select class="form-control chamber_zip" id="chamber_zip'+children+'" name="chamber_zip[]" data-id="'+children+'">';
			html += '<option value="">Select ZIP</option>';
			html += '</select>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += '</div>';

			$('#doctor_chember_address').append(html);
		});
		$(document).on('click','.remove_chember',function(){
			$(this).parents('.portlet').remove();
		});

		$(document).on("focus", ".chemberThana", function(){
			$(this).autocomplete({
				source: chemberAvailableThana
			});
		});
		$(document).on("focus", ".chemberDistrict", function(){
			$(this).autocomplete({
				source: chemberAvailableDistrict
			});
		});
		$(document).on("focus", ".chemberDivision", function(){
			$(this).autocomplete({
				source: chemberAvailabledivision
			});
		});
		// Add Chember list END


		$(document).on('click','.add_more_contact',function(){
			var html = '<div class="more-contact-wrapper form-group form-md-line-input form-md-floating-label">';
			html += '<div class="input-group input-group-sm">';
			html += '<div class="input-group-control">';
			html += '<input type="text" class="form-control input-sm" id="contact" name="contact[]">';
			html += '<label>Contact number</label>';
			html += '<span class="help-block">Enter Contact Number</span>';
			html += '</div>';
			html += '<span class="input-group-btn btn-right">';
			html += '<a class="btn btn-danger dlt_contact" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
			html += '<a class="btn btn-primary add_more_contact" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
			html += '</span>';
			html += '</div>';
			html += '<span class="help-block">Enter Contact Number</span>';
			html += '</div>';
			$(this).parents('.modal').find('#more_contact_num').append(html);
		});

		$(document).on('click','.dlt_contact',function(){
			$(this).parents('.more-contact-wrapper').remove();
		});

		$(document).on('click','.add_more_email',function(){
			var html = '<div class="more-email-wrapper form-group form-md-line-input form-md-floating-label">';
			html += '<div class="input-group input-group-sm">';
			html += '<div class="input-group-control">';
			html += '<input type="email" class="form-control input-sm" id="email" name="email[]">';
			html += '<label>Email<span class="mandatory_field"> *</span></label>';
			html += '<span class="help-block">Enter Email</span>';
			html += '</div>';
			html += '<span class="input-group-btn btn-right">';
			html += '<a class="btn btn-danger dlt_email" type="button" title="Add More"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
			html += '<a class="btn btn-primary add_more_email" type="button" title="Add More"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
			html += '</span>';
			html += '</div>';
			html += '<span class="help-block">Enter Email</span>';
			html += '</div>';

			$(this).parents('.modal').find('#more_email').append(html);
		});

		$(document).on('click','.dlt_email',function(){
			$(this).parents('.more-email-wrapper').remove();
		});


		$(document).on('change','.chamber_division',function(){
			var row_id = $(this).attr('data-id');
			var division_id = $(this).val();
			populate_chamber_district(division_id,'',row_id);
			$('#chamber_thana'+row_id).html('<option value="">Select Thana/City</option>');
			$('#chamber_zip'+row_id).html('<option value="">Select Zip</option>');
		});
		$(document).on('change','.chamber_district',function(){
			var row_id = $(this).attr('data-id');
			var district_id = $(this).val();
			populate_chamber_thana(district_id,'',row_id);
			$('#chamber_zip'+row_id).html('<option value="">Select Zip</option>');
		});
		$(document).on('change','.chamber_thana',function(){
			var row_id = $(this).attr('data-id');
			var thana_id = $(this).val();
			populate_chamber_zip(thana_id,'',row_id)
		});


		function populate_chamber_district(division_id,district_id,row_id){
			var url = "{{ url('district_by_division') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {division_id:division_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#chamber_district'+row_id).html(data.options);
						$('#chamber_district'+row_id).val(district_id);
						$('#chamber_district'+row_id).removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		function populate_chamber_thana(district_id,thana_id,row_id){
			var url = "{{ url('thana_by_district') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {district_id:district_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#chamber_thana'+row_id).html(data.options);
						$('#chamber_thana'+row_id).val(thana_id);
						$('#chamber_thana'+row_id).removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}

		function populate_chamber_zip(thana_id,zip_id,row_id){
			var url = "{{ url('zip_by_thana') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {thana_id:thana_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#chamber_zip'+row_id).html(data.options);
						$('#chamber_zip'+row_id).val(zip_id);
						$('#chamber_zip'+row_id).removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}


		$(document).on('change','#home_division',function(){
			var division_id = $(this).val();
			populate_home_district(division_id,'');
			$('#home_thana').html('<option value="">Select Thana/City</option>');
			$('#home_zip').html('<option value="">Select Zip</option>');
		});
		$(document).on('change','#home_district',function(){
			var district_id = $(this).val();
			populate_home_thana(district_id,'');
			$('#home_zip').html('<option value="">Select Zip</option>');
		});
		$(document).on('change','#home_thana',function(){
			var thana_id = $(this).val();
			populate_home_zip(thana_id,'');
		});

		function populate_home_district(division_id,district_id){
			var url = "{{ url('district_by_division') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {division_id:division_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#home_district').html(data.options);
						$('#home_district').val(district_id);
						$('#home_district').removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}

		function populate_home_thana(district_id,thana_id){
			var url = "{{ url('thana_by_district') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {district_id:district_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#home_thana').html(data.options);
						$('#home_thana').val(thana_id);
						$('#home_thana').removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}

		function populate_home_zip(thana_id,zip_id){
			var url = "{{ url('zip_by_thana') }}";
			$.ajax({
				type: "POST",
				url: url,
				data: {thana_id:thana_id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#home_zip').html(data.options);
						$('#home_zip').val(zip_id);
						$('#home_zip').removeAttr("disabled");
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}

		$(document).on('submit','#search_item_form', function (event) {
			event.preventDefault();
			getData();
		});
		$(document).on('click','#search_button', function () {
			getData();
		});

		$("#addDoctorModal").on('hidden.bs.modal', function () {
			location.reload();
		});

		$(document).ready(function() {
			$('#event_create').datepicker( {
				onSelect: function(date) {
					$('#add_event_modal').modal('show');
					$('#event_date').val(date);
				},
			});

			$(document).on('click','.remove_sp_day',function(){
				var data_id = $(this).attr('data-id');
				$('#sp_day_'+data_id).remove();
				$(this).parents('li').eq(0).remove();
			});
		});
	</script>
@endsection