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
                <span>Chemist List</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Chemist List</span>
				            </div>

				            <div class="actions">

								@if(\App\Utility::userRolePermission(Session::get('role_id'),15))
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="add_new_product" data-toggle="modal" data-target="#addChemistModal"><i class="icon-plus icons"></i>Add New</button>
                                </div>
								@endif
   
                            </div>
				        </div>

				        <div class="portlet-body">
							@if(\App\Utility::userRolePermission(Session::get('role_id'),14))
				        	<div class="">
				        		<select class="form-control edited three-option-filter-01" id="select_chemist_class">
		                            <option value="" selected="">Filter by Class</option>
									<?php foreach($classes as $class){?>
									<option value="{{ $class->class_name }}">{{ $class->class_name }}</option>
									<?php } ?>
		                        </select>

				        		<select class="form-control edited three-option-filter-02" id="select_chemist_territory">
		                            <option value="" selected="">Filter by Territory</option>
									<?php foreach($territories as $territory){?>
									<option value="{{ $territory->name }}">{{ $territory->name }}</option>
									<?php } ?>
		                        </select>

		                        <select class="form-control edited three-option-filter-03" id="select_chemist_category">
		                            <option value="" selected="">Filter by Category</option>
									<?php foreach($categories as $category){?>
									<option value="{{ $category->name }}">{{ $category->name }}</option>
									<?php } ?>
		                        </select>

		                        <select class="form-control edited three-option-filter-04" id="select_chemist_status">
		                            <option value="" selected="">Filter by status</option>
									<option value="Enable">Active</option>
									<option value="Disable">Inactive</option>
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

								<div class="table-responsive">
						            <table class="table table-bordered" id="Chemist_list" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <!--th class="w40">Sl. No.</th-->
							                  <th class="w200">Chemist name</th>
							                  <th class="text-center">Contact number</th>
							                  <th class="text-center">Territory</th>
							                  <th class="text-center w100">Class</th>
							                  <th class="text-center w100">Category</th>
							                  <th class="text-center w100">Created By</th>
							                  <th class="text-center">Status</th>
							                  <th class="w250 text-center">Action</th>
							                </tr>
						              	</thead>
						              	<tbody id="set_chemist">

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

	<!-- Add Chemist Modal -->
	<div class="modal fade" id="addChemistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
				<form id="chemistAddForm">
					{{ csrf_field() }}
					<input type="hidden" id="chemist_id" name="chemist_id" value=""/>
					<input type="hidden" id="is_edit_requst" name="is_edit_requst" value=""/>

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add New Chemist</h4>
					</div>
					<div class="modal-body">
						<!-- Alert Massage Section -->
						<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
						<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
						<!-- Alert Massage Section -->

						<div class="row">
							<div class="col-sm-3 col-xs-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									<input type="text" class="form-control" id="name" name="name">
									<label for="">Chemist Name<span class="mandatory_field"> *</span></label>
									<span class="help-block">Enter Chemist Name...</span>
								</div>
							</div>

							<div class="col-sm-3 col-xs-12">
								<div class="form-group form-md-line-input no-padding">
									<label>Select Territory <span class="mandatory_field">*</span></label>
									 <select class="selectpicker form-control show-tick" id="territory" name="territory">
										 <option value="">Select territory</option>
										 <?php foreach($territories as $territory){?>
										 <option value="{{ $territory->territory_id }}">{{ $territory->name }}</option>
										 <?php } ?>
									</select>
								</div>
							</div>

							<div class="col-sm-3 col-xs-12">
								<div class="form-group form-md-line-input no-padding">
									<label>Select Category <span class="mandatory_field">*</span></label>
									 <select class="selectpicker form-control show-tick" id="category" name="category">
										 <option value="">Select category</option>
										 <?php foreach($categories as $category){?>
										 <option value="{{ $category->chemist_category_id }}">{{ $category->name }}</option>
										 <?php } ?>
									</select>
								</div>
							</div>

							<div class="col-sm-3 col-xs-12">
								<div class="form-group form-md-line-input no-padding">
									<label>Select Class <span class="mandatory_field">*</span></label>
									 <select class="selectpicker form-control show-tick" id="class" name="class">
										 <option value="">Select class</option>
										 <?php foreach($classes as $class){?>
										 <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
										 <?php } ?>
									</select>
								</div>
							</div>

							<div class="clearfix"></div>

							<div class="col-sm-4 col-xs-12">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" id="event_create" name="" placeholder="Select Date">
									<label for="">Chemist Special Day<span class="mandatory_field">*</span></label>
									<span class="help-block">Enter Chemist Special Day...</span>
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
						</div>

						<div class="clearfix"></div>

						<div id="Chemist_chember_address">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">Chemist Address</div>
									<div class="actions">
										<div class="btn-group btn-group-devided">
											<button type="button" class="btn btn-primary add_chemist_address"><i class="icon-plus icons"></i>Add More Address</button>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-sm-4 col-xs-12">

											<div class="form-group form-md-line-input form-md-floating-label p-t-9">
												<textarea class="form-control h70" id="chemist_address1" name="chemist_address1[]"></textarea>
												<label for="">Address Line 1<span class="mandatory_field"> *</span></label>
												<span class="help-block">Enter Address Line 1...</span>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select Division <span class="mandatory_field">*</span></label>
												<select class="form-control chemist_division" id="chemist_division1" name="chemist_division[]" data-id="1">
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
												<select class="form-control chemist_district" id="chemist_district1" name="chemist_district[]" data-id="1" >
													<option value="">Select District</option>
												</select>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select Thana/City <span class="mandatory_field">*</span></label>
												<select class="form-control chemist_thana" id="chemist_thana1" name="chemist_thana[]" data-id="1">
													<option value="">Select Thana/city</option>
												</select>
											</div>
										</div>

										<div class="col-sm-4 col-xs-12">
											<div class="form-group form-md-line-input">
												<label>Select ZIP <span class="mandatory_field">*</span></label>
												<select class="form-control chemist_zip" id="chemist_zip1" name="chemist_zip[]" data-id="1" >
													<option value="">Select ZIP</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<span class="hidden" id="ajax_loader"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-success" id="save_chemist">Save changes</button>
						<button type="button" class="btn btn-danger" id="reject_chemist" style="display: none;">Reject Change</button>

						<button type="button" class="btn btn-success" id="accept_chemist" onclick="acceptRejectChemist(1)" style="display:none">Accept</button>
						<button type="button" class="btn btn-danger" id="reject_chemist_add" onclick="acceptRejectChemist(4)" style="display:none">Reject</button>

						{{-- <button type="button" class="btn btn-success" id="approve_changes" style="display:none">Accept</button>
						<button type="button" class="btn btn-danger" id="decline_changes" onclick="declineDoctorChanges()" style="display:none">Reject</button> --}}
					</div>
				</form>
			</div>
	  	</div>
	</div>

	<!-- Edit Chemist Modal -->
	<div class="modal fade" id="editChemistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Chemist Details</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-3 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Chemist Name<span class="mandatory_field"> *</span></label>
		                        <span class="help-block">Enter Chemist Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-3 col-xs-12">
		                    <div class="form-group form-md-line-input no-padding">
		        				<label>Select Territory <span class="mandatory_field">*</span></label>
		                         <select class="selectpicker form-control show-tick" multiple id="" name="">
		        					<option value="">Territory A</option>
		        					<option value="">Territory B</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="col-sm-3 col-xs-12">
							<div class="form-group form-md-line-input no-padding">
		        				<label>Select Category <span class="mandatory_field">*</span></label>
		                         <select class="selectpicker form-control show-tick" multiple id="" name="">
		        					<option value="">Category A</option>
		        					<option value="">Category B</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="col-sm-3 col-xs-12">
		        			<div class="form-group form-md-line-input no-padding">
		        				<label>Select Class <span class="mandatory_field">*</span></label>
		                         <select class="selectpicker form-control show-tick" multiple id="" name="">
		        					<option value="">Class A</option>
		        					<option value="">Class B</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="clearfix"></div>

		        		<div class="col-sm-4 col-xs-12">
		        			<label>Doctor Special Day<span class="mandatory_field"> *</span></label>
		                    <div class="m-b-20" id="tempust_edit"></div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">

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
		        	</div>

	        		<div class="clearfix"></div>
					
					<div id="Chemist_chember_address">
		        		<div class="portlet light bordered">
		        			<div class="portlet-title">
		        				<div class="caption">Chemist Address</div>
		        				<div class="actions">
	                                <div class="btn-group btn-group-devided">
	                                    <button type="button" class="btn btn-primary add_chemist_address"><i class="icon-plus icons"></i>Add More Address</button>
	                                </div>
	                            </div>
		        			</div>
		        			<div class="portlet-body">
				        		<div class="row">
					        		<div class="col-sm-4 col-xs-12">

					                    <div class="form-group form-md-line-input form-md-floating-label p-t-9">
					                        <textarea class="form-control h70"></textarea>
					                        <label for="">Address Line 1<span class="mandatory_field"> *</span></label>
					                        <span class="help-block">Enter Address Line 1...</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input no-padding">
					        				<label>Select Division <span class="mandatory_field">*</span></label>
					                         <select class="selectpicker form-control show-tick" multiple id="" name="">
					        					<option value="">Class Aaaa</option>
					        					<option value="">Class B</option>
					                        </select>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input">
					        				<label>Select District <span class="mandatory_field">*</span></label>
					                         <select class="selectpicker form-control show-tick" multiple id="" name="">
					        					<option value="">District A</option>
					        					<option value="">District Bbbb</option>
					                        </select>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input">
					        				<label>Select Thana/City <span class="mandatory_field">*</span></label>
					                         <select class="selectpicker form-control show-tick" multiple id="" name="">
					        					<option value="">Thana/City A</option>
					        					<option value="">Thana/City B</option>
					                        </select>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input">
					        				<label>Select ZIP <span class="mandatory_field">*</span></label>
					                         <select class="selectpicker form-control show-tick" multiple id="" name="">
					        					<option value="">ZIP A</option>
					        					<option value="">ZIP B</option>
					                        </select>
					                    </div>
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
	</div>

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
		        	<h4 class="modal-title">Add Chemist Special Day</h4>
		      	</div>
		      	<div class="modal-body text-center">
					<!-- Alert Massage Section -->
					<div class="alert alert-danger print-error-msg" style="display:none" id="spd_error"><ul></ul></div>
					<div class="alert alert-success print-error-msg" style="display:none" id="spd_success"></div>
					<!-- Alert Massage Section -->
		      		<form action="">
			        	<div class="m-b-35">
	                        <label for="">Chemist special day type<span class="mandatory_field">*</span></label> <br>
							<select class="selectpicker form-control show-tick" id="special_day_type" name="special_day_type[]">
								<option value="">Select Day Type</option>
								<?php foreach($special_day_types as $sp_day){?>
								<option value="{{ $sp_day->chemist_special_day_type_id.'#'.$sp_day->name }}">{{ $sp_day->name }}</option>
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
    <script>
//Change request reject    	
		$("#reject_chemist").click(function(){
			var id = $("#chemist_id").val();
			var url = '{{ url('/reject_edit_request') }}';
			var dataString = {
				_token: "{{ csrf_token() }}",
				chemist_id:id,
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
						setTimeout(function() {$('#success').hide(); },3000);
						setTimeout(function() {$('#addChemistModal').modal('hide');},3000);
						getData();
					}

					if(data.status == 401){
						$("#success").hide();
						$("#error").show();
						$("#error").html(data.reason);
					}

					$('#addChemistModal').animate({ scrollTop: 0 }, 'slow');

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		});

//New Added or requested chemist accept o reject
	function editRequestChemist(id){
		var url = "{{ url('chemistReviewData') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: {chemist_id:id,_token: "{{ csrf_token() }}"},
			dataType: "json",
			cache : false,
			success: function(data){ console.log(data);
				if(data.status == 200){
					$('#chemist_id').val(data.chemist.chemist_id);
					$('#is_edit_requst').val(1);

					$('#name').val(data.request_data.name);
					if(data.chemist.name != data.request_data.name){
						$('#name').parent('.form-group').addClass('changed_data')
					}

					$('#territory').selectpicker('val', [data.request_data.territory_id]);
					if(data.chemist.territory_id != data.request_data.territory_id){
						$('#territory').parents('.form-group').addClass('changed_data')
					}

					$('#category').selectpicker('val', [data.chemist.category_id]);
					if(data.chemist.category_id != data.request_data.category_id){ 
						$('#category').parents('.form-group').addClass('changed_data')
					}

					$('#class').selectpicker('val', [data.chemist.class_id]);
					if(data.chemist.class_id != data.request_data.class_id){ 
						$('#class').parents('.form-group').addClass('changed_data')
					}

					/*Special days area*/
						var html = '';
						var day_input_list = '';
						var original_special_days = [];
						var changed_special_days = jQuery.parseJSON(data.request_data.other_special_day);

						$.each(data.chemist.special_days, function( index, org_sp_day ) {
							original_special_days.push(org_sp_day.date+"("+org_sp_day.special_day_id+")");
						});
						//console.log(original_special_days);
						$.each(changed_special_days, function( index, sp_day ) {
							if(jQuery.inArray(sp_day.data+"("+sp_day.special_day_id+")", original_special_days) != -1) {
								var c_class = '';
							} else {
								var c_class = ' changed_sp_day';
							}

							var child = index+1;
							html += '<li class='+c_class+'>';
							html += '<p><i>'+custom_date_format(sp_day.date)+'</i></p>';
							html += '<p>'+sp_day.message+'</p>';
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

						/* Contact list manage*/
						var contact_list = '';
						var org_contact =[];
						var contacts = jQuery.parseJSON(data.request_data.contacts);
						$.each(data.chemist.contacts, function( index, original_contact ) {
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
						/* End contact list manage*/

					/*Populate chamber address*/
					var divisions ='<option value="">Select Division</option>';
					<?php foreach($divisions as $division){?>
							divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
							<?php } ?>

					var html = '';
					var original_address1 = [];
					var changed_chambers = jQuery.parseJSON(data.request_data.chemist_address);
					var children = 0;

					$.each(data.chemist.chemist_address, function( index, org_chamber ) {
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
						html += '<div class="caption">Chemist Address</div>';
						html += '<div class="actions">';
						html += '<div class="btn-group btn-group-devided">';
						html += '<button type="button" class="btn btn-primary add_chemist_address"><i class="icon-plus icons"></i>Add More Address</button>';
						if(index>0) {
							html += '<button type="button" class="btn btn-danger remove_chemist_address"><i class="icon-minus icons"></i>Remove</button>';
						}
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '<div class="portlet-body">';
						html += '<div class="row">';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
						html += '<textarea class="form-control h70" id="chemist_address'+children+'" name="chemist_address1[]">'+chamber.address_line1+'</textarea>';
						html += '<label for="">Address Line 1</label>';
						html += '<span class="help-block">Enter Address Line 1...</span>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select Division</label>';
						html += '<select class="form-control chemist_division" id="chemist_division'+children+'" name="chemist_division[]" data-id="'+children+'">';
						html += '<option value="">Select Division</option>';
						html += divisions;
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select District</label>';
						html += '<select class="form-control chemist_district" id="chemist_district'+children+'" name="chemist_district[]" data-id="'+children+'" >';
						html += '<option value="">Select District</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select Thana/City</label>';
						html += '<select class="form-control chemist_thana" id="chemist_thana'+children+'" name="chemist_thana[]" data-id="'+children+'">';
						html += '<option value="">Select Thana/city</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select ZIP</label>';
						html += '<select class="form-control chemist_zip" id="chemist_zip'+children+'" name="chemist_zip[]" data-id="'+children+'" >';
						html += '<option value="">Select ZIP</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';

					});
					$('#Chemist_chember_address').html(html);


					var children2 = 0;
					$.each(data.chemist.chemist_address, function( index, chamber ) {
						children2 = index+1;
						$('#chemist_division'+children2).val(chamber.division);
						populate_chemist_district(chamber.division, chamber.district, children2);
						populate_chemist_thana(chamber.district, chamber.thana, children2);
						populate_chemist_zip(chamber.thana, chamber.zip, children2);
					});

					/*Populate chamber address ends*/
					

					$("form input").each(function() {
						var element = $(this);
						if (element.val() != "") {
							element.addClass('edited');
						}
					});
					/* Edit modal show*/
					$('#myModalLabel').text('Review Chemist');
					$('#addChemistModal').modal('show');
					$('#save_chemist').html('Accept Change');
					$('#reject_chemist').show();	
				}
				else{
					alert(data);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}




		//Del product Ajax
		function changeChemistStatus(a,b){
			if(b==1){
				$('#warning_message').text('Are you sure you want to activate this chemist?');
			}
			else{
				$('#warning_message').text('Are you sure you want to inactivate this chemist?');
			}

			$('#DocDelete').modal('show');
			$("#deldoc").attr('data-id',a);
			$("#deldoc").attr('data-status',b);
		}

		$("#deldoc").click(function(){
			var a = $("#deldoc").attr('data-id');
			var b = $("#deldoc").attr('data-status');
			var url = '{{ url('/chemist/change_chemist_status') }}';
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
				arrSelectedVal.push($(this).val());

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
				$('#special_day_type').val('');
				$('#event_date').val('');

				$('#spd_success').hide();
				$('#spd_error').hide();
				$('#spd_error').html('');
				$('#add_event_modal').modal('hide');
			}
		})

		//Save Doctor Ajax
		$("#save_chemist").click(function(){
			$('#ajax_loader').removeClass('hidden');
			$('#save_chemist').prop('disabled', true);
			var chemist_id = $('#chemist_id').val();
			var name = $('#name').val();
			var territory = $('#territory').val();
			var category = $('#category').val();
			var chemist_class = $('#class').val();
			var contact = $('#contact').val();
			var chemist_address = $('#chemist_address1').val();
			var chemist_division = $('#chemist_division1').val();
			var chemist_district = $('#chemist_district1').val();
			var chemist_thana = $('#chemist_thana1').val();
			var chemist_zip = $('#chemist_zip1').val();

			var validate = '';
			if(name.trim()==''){
				validate=validate+'Name is required<br>';
			}
			if(territory.trim()==''){
				validate=validate+'Territory is required<br>';
			}
			if(category.trim()==''){
				validate=validate+'Category is required<br>';
			}
			if(chemist_class.trim()==''){
				validate=validate+'Class is required<br>';
			}
			if(contact.trim()==''){
				validate=validate+'Contact is required<br>';
			}

			if(chemist_address.trim()==''){
				validate=validate+'Chemist address 1 is required<br>';
			}
			if(chemist_division.trim()==''){
				validate=validate+'Chemist division is required<br>';
			}
			if(chemist_district.trim()==''){
				validate=validate+'Chemist district is required<br>';
			}
			if(chemist_thana.trim()==''){
				validate=validate+'Chemist thana is required<br>';
			}
			if(chemist_zip.trim()==''){
				validate=validate+'Chemist zip is required<br>';
			}

			if(validate==''){
				if(chemist_id==''){
					var url = "{{ url('/chemist/chemistStore') }}";
				}
				else{
					var url = "{{ url('/chemist/chemistUpdate') }}";
				}
				var formData = new FormData($('#chemistAddForm')[0]);
				var url = url;
				$.ajax({
					type: "POST",
					url: url,
					data: formData,
					async: false,
					success: function (data) { console.log(data);
						if(data.status == 200){
							$("#success").show();
							$("#error").hide();
							$("#success").html(data.reason);
							setTimeout(function() {$('#success').hide(); },3000);
							setTimeout(function() {$('#addChemistModal').modal('hide');},3000);
							$('#ajax_loader').addClass('hidden');
							//getData();
							location.reload(true);
						}

						if(data.status == 401){
							$('#ajax_loader').addClass('hidden');
							$('#save_chemist').prop('disabled', false);
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
				$('#save_chemist').prop('disabled', false);
			}
			$('#addChemistModal').animate({ scrollTop: 0 }, 'slow');
		});

		// A $( document ).ready() block.
		$( document ).ready(function() {
			getData();
		});



		//Get Data Ajax Function
		function getData(){
			var loader = '<tr>';
			loader += '<td colspan="8"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
			loader += '</tr>';
			$('#set_chemist').html(loader);

			var url = "{{ url('/chemist/getChemist') }}";
			var search_string = $('#search_text').val();
			var dataString = {
				_token: "{{ csrf_token() }}",
			};

			$.ajax({
				type: "GET",
				url: url,
				data: {search_string:search_string},
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						//Datatable destroy function
						$('#Chemist_list').DataTable().destroy();

						var html = '';
						var count = 1;
						$.each(data.val.data, function (index, value) {
							var c_contact = '';
							var d_territories = '';

							if(value.class_name !== null){ var class_name = value.class_name}else{ var class_name = ''; }
							if(value.category_name !== null){ var category_name = value.category_name}else{ var category_name = ''; }
                            if(value.first_name !== null){ var first_name = value.first_name}else{ var first_name = ''; }
                            if(value.last_name !== null){ var last_name = value.last_name}else{ var last_name = ''; }
							if(value.status == 'pending' && value.is_edit_requst == 1)
								{ var status = 'Upadate requested';
								  var hidden_status = 'Upadate requested';
								}
							else if(value.status == 'pending')
								{ var status = 'Pending';
								  var hidden_status = 'Pending';
								}
							else if(value.status == 'inactive')
								{ var status = 'Inactive';
									var hidden_status = 'Disable';
								}
							else{ var status = 'Active';
								var hidden_status = 'Enable';
							}

							$.each(value.contacts, function (index, contact) {
								c_contact +=contact.contact_no;
								if(index < value.contacts.length-1){
									c_contact +='<br>';
								}
							});

							$.each(value.territories, function (index, ter) {
								d_territories +=ter.name;
								if(index < value.territories.length-1){
									d_territories +=',';
								}
							});

							html += '<tr>';
							//html += '<td>'+count+'</td>';
							html += '<td>'+value.name+'</td>';
							html += '<td class="text-center">'+c_contact+'</td>';
							html += '<td class="text-center">'+d_territories+'</td>';
							html += '<td class="text-center">'+class_name+'</td>';
							html += '<td class="text-center">'+category_name+'</td>';
                            html += '<td class="text-center">'+first_name+" "+last_name+'</td>';
							html += '<td class="text-center">'+status;
							html += '<span class="hidden">'+hidden_status+'</span></td>';
							html += '<td class="text-center">';

							if(value.status == 'pending') {
								@if(\App\Utility::userRolePermission(Session::get('role_id'),75))
								if(value.is_edit_request == 1){
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editRequestChemist('+value.chemist_id+')"><i class="fa fa-wrench" aria-hidden="true"></i></a>';
								}
								else{
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editChemist(' + value.chemist_id + ',\'pending\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								}
								@endif
							}
							else{
								@if(\App\Utility::userRolePermission(Session::get('role_id'),16))
								html += '<a href="javascript:;" class="btn btn-sm btn-info" title="Edit" onclick="editChemist(' + value.chemist_id + ',\'active\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								@endif
							}

							// if(value.status == 'pending') {
							// 	html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-warning"  onclick="editRequestChemist('+value.chemist_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							// }
							// else{

							// 	html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info"  onclick="editChemist(' + value.chemist_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							// }

							if(value.status == 'active'){
								html += '<a href="#" class="btn btn-sm btn-danger" title="Inactive" onclick="changeChemistStatus('+value.chemist_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
							}
							else if(value.status == 'inactive'){
								html += '<a href="#" class="btn btn-sm btn-success" title="Active" onclick="changeChemistStatus('+value.chemist_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
							}

							@if(\App\Utility::userRolePermission(Session::get('role_id'),17))
							html += '<a title="View" href="{{url('/')}}/chemist_details/'+value.chemist_id+'" class="btn btn-sm btn-success">';
							html += '<i class="fa fa-eye" aria-hidden="true"></i>';
							html += '</a>';
							@endif

							html += '</td>';
							html += '</tr>';
							count++;
						});
						$('#set_chemist').html(html);
						$('#pagination_area').html(data.pagination);

						//Datatable Initialize
						var chemist_list = $('#Chemist_list').DataTable({
							"paging": false,
							"lengthChange": false,
							"ordering": false
						});
						$('#Chemist_list_filter').hide();

						$('#select_chemist_territory').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(2)
									.search(select_val)
									.draw();
						});
						$('#select_chemist_class').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(3)
									.search(select_val)
									.draw();
						});
						$('#select_chemist_category').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(4)
									.search(select_val)
									.draw();
						});

						$('#select_chemist_status').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(6)
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


		$(document).on('click','.pagination>li>a',function(e){
			e.preventDefault();
			var loader = '<tr>';
			loader += '<td colspan="8"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
			loader += '</tr>';
			$('#set_chemist').html(loader);

			var url = $(this).attr('href');
			var search_string = $('#search_text').val();
			$.ajax({
				type: "GET",
				url: url,
				data: {search_string:search_string},
				dataType: "json",
				cache : false,
				success: function(data){ console.log(data);
					if(data.status == 200){
						//Datatable destroy function
						$('#Chemist_list').DataTable().destroy();

						var html = '';
						var count = 1;
						$.each(data.val.data, function (index, value) {
							var c_contact = '';
							var d_territories = '';

							if(value.class_name !== null){ var class_name = value.class_name}else{ var class_name = ''; }
							if(value.category_name !== null){ var category_name = value.category_name}else{ var category_name = ''; }
							if(value.status == 'pending' && value.is_edit_requst == 1)
							{ var status = 'Upadate requested';
								var hidden_status = 'Upadate requested';
							}
							else if(value.status == 'pending')
							{ var status = 'Pending';
								var hidden_status = 'Pending';
							}
							else if(value.status == 'inactive')
							{ var status = 'Inactive';
								var hidden_status = 'Disable';
							}
							else{ var status = 'Active';
								var hidden_status = 'Enable';
							}

							$.each(value.contacts, function (index, contact) {
								c_contact +=contact.contact_no;
								if(index < value.contacts.length-1){
									c_contact +='<br>';
								}
							});

							$.each(value.territories, function (index, ter) {
								d_territories +=ter.name;
								if(index < value.territories.length-1){
									d_territories +=',';
								}
							});

							html += '<tr>';
							//html += '<td>'+count+'</td>';
							html += '<td>'+value.name+'</td>';
							html += '<td class="text-center">'+c_contact+'</td>';
							html += '<td class="text-center">'+d_territories+'</td>';
							html += '<td class="text-center">'+class_name+'</td>';
							html += '<td class="text-center">'+category_name+'</td>';
							html += '<td class="text-center">'+status;
							html += '<span class="hidden">'+hidden_status+'</span></td>';
							html += '<td class="text-center">';


							if(value.status == 'pending') {
								@if(\App\Utility::userRolePermission(Session::get('role_id'),75))
								if(value.is_edit_request == 1){
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editRequestChemist('+value.chemist_id+')"><i class="fa fa-wrench" aria-hidden="true"></i></a>';
								}
								else{
									html += '<a href="javascript:;" class="btn btn-sm btn-warning" title="Review" onclick="editChemist(' + value.chemist_id + ',\'pending\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								}
								@endif
							}
							else{
								@if(\App\Utility::userRolePermission(Session::get('role_id'),16))
										html += '<a href="javascript:;" class="btn btn-sm btn-info" title="Edit" onclick="editChemist(' + value.chemist_id + ',\'active\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								@endif
							}

							// if(value.status == 'pending') {
							// 	html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-warning"  onclick="editRequestChemist('+value.chemist_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							// }
							// else{

							// 	html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info"  onclick="editChemist(' + value.chemist_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							// }

							if(value.status == 'active'){
								html += '<a href="#" class="btn btn-sm btn-danger" title="Inactive" onclick="changeChemistStatus('+value.chemist_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
							}
							else if(value.status == 'inactive'){
								html += '<a href="#" class="btn btn-sm btn-success" title="Active" onclick="changeChemistStatus('+value.chemist_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
							}

							@if(\App\Utility::userRolePermission(Session::get('role_id'),17))
									html += '<a title="View" href="{{url('/')}}/chemist_details/'+value.chemist_id+'" class="btn btn-sm btn-success">';
							html += '<i class="fa fa-eye" aria-hidden="true"></i>';
							html += '</a>';
							@endif

									html += '</td>';
							html += '</tr>';
							count++;
						});
						$('#set_chemist').html(html);
						$('#pagination_area').html(data.pagination);

						//Datatable Initialize
						var chemist_list = $('#Chemist_list').DataTable({
							"paging": false,
							"lengthChange": false
						});
						$('#Chemist_list_filter').hide();

						$('#select_chemist_territory').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(2)
									.search(select_val)
									.draw();
						});
						$('#select_chemist_class').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(3)
									.search(select_val)
									.draw();
						});
						$('#select_chemist_category').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(4)
									.search(select_val)
									.draw();
						});

						$('#select_chemist_status').change(function(){
							var select_val = $(this).val();
							chemist_list
									.columns(5)
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

		//templust event date picker
		/*$("#tempust").tempust({
		    date: new Date("2017/12/12"),
		    offset: 1,
		    events: {
		        "2017/12/12": $("<div>Birth Day</div>"),
		        "2017/12/13": $("<div>Marriage Day</div>"),
		    }
		});

		$("#tempust_edit").tempust({
		    date: new Date("2017/12/12"),
		    offset: 1,
		    events: {
		        "2017/12/12": $("<div>Birth Day</div>"),
		        "2017/12/13": $("<div>Marriage Day</div>"),
		    }
		});*/

		$(document).on('click','.day',function(){
			$('#add_event_modal').modal('show');
		});

		$(document).on('click','.add_more_contact',function(){
		var html = '<div class="more-contact-wrapper form-group form-md-line-input form-md-floating-label">';
			html += '<div class="input-group input-group-sm">';
			html += '<div class="input-group-control">';
			html += '<input type="text" class="form-control input-sm" name="contact[]">';
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

	function editChemist(id,status){
		var url = "{{ url('chemist_details_ajax') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: {chemist_id:id,_token: "{{ csrf_token() }}"},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('#chemist_id').val(data.chemist.chemist_id);
					$('#name').val(data.chemist.name);
					$('#category').selectpicker('val', [data.chemist.category_id]);
					$('#territory').selectpicker('val', [data.chemist.territory_id]);

					$('#class').selectpicker('val', [data.chemist.class_id]);


					/*Special days area*/
					var html = '';
					var day_input_list = '';
					$.each(data.chemist.special_days, function( index, sp_day ) {
						var child = index+1;
						html += '<li>';
						html += '<p><i>'+custom_date_format(sp_day.date)+'</i></p>';
						html += '<p>'+sp_day.name+'</p>';
						html += '<p>'+sp_day.message+'</p>';
						html += '<a class="remove_sp_day" data-id="'+child+'"  href="javascript:;"><i class="icon-close icons"></i></a>';
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
					$.each(data.chemist.contacts, function( index, contact ) {
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

					/*Populate chamber address*/

					var divisions ='<option value="">Select Division</option>';
					<?php foreach($divisions as $division){?>
							divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
							<?php } ?>

					var html = '';
					var children = 0;
					$.each(data.chemist.chemist_address, function( index, chamber ) {
						children = index+1;
						html += '<div class="portlet light bordered">';
						html += '<div class="portlet-title">';
						html += '<div class="caption">Chemist Address</div>';
						html += '<div class="actions">';
						html += '<div class="btn-group btn-group-devided">';
						html += '<button type="button" class="btn btn-primary add_chemist_address"><i class="icon-plus icons"></i>Add More Address</button>';
						if(index>0) {
							html += '<button type="button" class="btn btn-danger remove_chemist_address"><i class="icon-minus icons"></i>Remove</button>';
						}
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '<div class="portlet-body">';
						html += '<div class="row">';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
						html += '<textarea class="form-control h70" id="chemist_address'+children+'" name="chemist_address1[]">'+chamber.address_line1+'</textarea>';
						html += '<label for="">Address Line 1</label>';
						html += '<span class="help-block">Enter Address Line 1...</span>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select Division</label>';
						html += '<select class="form-control chemist_division" id="chemist_division'+children+'" name="chemist_division[]" data-id="'+children+'">';
						html += '<option value="">Select Division</option>';
						html += divisions;
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select District</label>';
						html += '<select class="form-control chemist_district" id="chemist_district'+children+'" name="chemist_district[]" data-id="'+children+'" >';
						html += '<option value="">Select District</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select Thana/City</label>';
						html += '<select class="form-control chemist_thana" id="chemist_thana'+children+'" name="chemist_thana[]" data-id="'+children+'">';
						html += '<option value="">Select Thana/city</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-sm-4 col-xs-12">';
						html += '<div class="form-group form-md-line-input">';
						html += '<label>Select ZIP</label>';
						html += '<select class="form-control chemist_zip" id="chemist_zip'+children+'" name="chemist_zip[]" data-id="'+children+'" >';
						html += '<option value="">Select ZIP</option>';
						html += '</select>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';

					});
					$('#Chemist_chember_address').html(html);


					var children2 = 0;
					$.each(data.chemist.chemist_address, function( index, chamber ) {
						children2 = index+1;
						$('#chemist_division'+children2).val(chamber.division);
						populate_chemist_district(chamber.division, chamber.district, children2);
						populate_chemist_thana(chamber.district, chamber.thana, children2);
						populate_chemist_zip(chamber.thana, chamber.zip, children2);
					});

					/*Populate chamber address ends*/

					$('#myModalLabel').text('Edit Chemist');
					$('#addChemistModal').modal('show');
					// $('#save_chemist').show();
					// $('#reject_chemist').hide();

					$("form input, form textarea").each(function() {
						var element = $(this);
						if (element.val() != "") {
							element.addClass('edited');
						}
					});

					if(status=='active'){
							$('#save_chemist').show();
							$('#accept_chemist').hide();
							$('#reject_chemist_add').hide();
							$('#approve_changes').hide();
							$('#decline_changes').hide();
						}
						else{ // status==pending
							$('#save_chemist').hide();
							$('#accept_chemist').show();
							$('#reject_chemist_add').show();
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

	$(document).on('click','.dlt_contact',function(){
		$(this).parents('.more-contact-wrapper').remove();
	});

	$(document).ready(function() {
	    $('#event_create').datepicker( {
	     	onSelect: function(date) {
	     		$('#add_event_modal').modal('show');
				$('#event_date').val(date);
	     	},
	  	});
	});


	$(document).on('change','.chemist_division',function(){
		var row_id = $(this).attr('data-id');
		var division_id = $(this).val();
		populate_chemist_district(division_id,'',row_id);
		$('#chemist_thana'+row_id).html('<option value="">Select Thana/City</option>');
		$('#chemist_zip'+row_id).html('<option value="">Select Zip</option>');
	});
	$(document).on('change','.chemist_district',function(){
		var row_id = $(this).attr('data-id');
		var district_id = $(this).val();
		populate_chemist_thana(district_id,'',row_id);
		$('#chemist_zip'+row_id).html('<option value="">Select Zip</option>');
	});
	$(document).on('change','.chemist_thana',function(){
		var row_id = $(this).attr('data-id');
		var thana_id = $(this).val();
		populate_chemist_zip(thana_id,'',row_id)
	});


	function populate_chemist_district(division_id,district_id,row_id){
		var url = "{{ url('district_by_division') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: {division_id:division_id,_token: "{{ csrf_token() }}"},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('#chemist_district'+row_id).html(data.options);
					$('#chemist_district'+row_id).val(district_id);
					$('#chemist_district'+row_id).removeAttr("disabled");
				}
				else{

				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}
	function populate_chemist_thana(district_id,thana_id,row_id){
		var url = "{{ url('thana_by_district') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: {district_id:district_id,_token: "{{ csrf_token() }}"},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('#chemist_thana'+row_id).html(data.options);
					$('#chemist_thana'+row_id).val(thana_id);
					$('#chemist_thana'+row_id).removeAttr("disabled");
				}
				else{

				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}

	function populate_chemist_zip(thana_id,zip_id,row_id){
		var url = "{{ url('zip_by_thana') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: {thana_id:thana_id,_token: "{{ csrf_token() }}"},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('#chemist_zip'+row_id).html(data.options);
					$('#chemist_zip'+row_id).val(zip_id);
					$('#chemist_zip'+row_id).removeAttr("disabled");
				}
				else{

				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}

	//Add Chemist
	$(document).on('click','.add_chemist_address',function(){
		var children = $("#doctor_chember_address > div").length;

		var divisions ='<option value="">Select Division</option>';
		<?php foreach($divisions as $division){?>
		divisions += '<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>';
		<?php } ?>

		var html = '<div class="portlet light bordered">';
		html += '<div class="portlet-title">';
		html += '<div class="caption">Chemist Address</div>';
		html += '<div class="actions">';
		html += '<div class="btn-group btn-group-devided">';
		html += '<button type="button" class="btn btn-primary add_chemist_address"><i class="icon-plus icons"></i>Add More Address</button>';
		html += '<button type="button" class="btn btn-danger remove_chemist_address"><i class="icon-minus icons"></i>Remove</button>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		html += '<div class="portlet-body">';
		html += '<div class="row">';
		html += '<div class="col-sm-4 col-xs-12">';
		html += '<div class="form-group form-md-line-input form-md-floating-label p-t-9">';
		html += '<textarea class="form-control h70" id="chemist_address'+children+'" name="chemist_address1[]"></textarea>';
		html += '<label for="">Address Line 1</label>';
		html += '<span class="help-block">Enter Address Line 1...</span>';
		html += '</div>';
		html += '</div>';
		html += '<div class="col-sm-4 col-xs-12">';
		html += '<div class="form-group form-md-line-input">';
		html += '<label>Select Division</label>';
		html += '<select class="form-control chemist_division" id="chemist_division'+children+'" name="chemist_division[]" data-id="'+children+'">';
		html += '<option value="">Select Division</option>';
		html += divisions;
		html += '</select>';
		html += '</div>';
		html += '</div>';
		html += '<div class="col-sm-4 col-xs-12">';
		html += '<div class="form-group form-md-line-input">';
		html += '<label>Select District</label>';
		html += '<select class="form-control chemist_district" id="chemist_district'+children+'" name="chemist_district[]" data-id="'+children+'" >';
		html += '<option value="">Select District</option>';
		html += '</select>';
		html += '</div>';
		html += '</div>';
		html += '<div class="col-sm-4 col-xs-12">';
		html += '<div class="form-group form-md-line-input">';
		html += '<label>Select Thana/City</label>';
		html += '<select class="form-control chemist_thana" id="chemist_thana'+children+'" name="chemist_thana[]" data-id="'+children+'">';
		html += '<option value="">Select Thana/city</option>';
		html += '</select>';
		html += '</div>';
		html += '</div>';
		html += '<div class="col-sm-4 col-xs-12">';
		html += '<div class="form-group form-md-line-input">';
		html += '<label>Select ZIP</label>';
		html += '<select class="form-control chemist_zip" id="chemist_zip'+children+'" name="chemist_zip[]" data-id="'+children+'" >';
		html += '<option value="">Select ZIP</option>';
		html += '</select>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';

		$('#Chemist_chember_address').append(html);
	});
	$(document).on('click','.remove_chemist_address',function(){
		$(this).parents('.portlet').remove();
	});

	$(document).on('submit','#search_item_form', function (event) {
		event.preventDefault();
		getData();
	});
	$(document).on('click','#search_button', function () {
		getData();
	});

	$("#addChemistModal").on('hidden.bs.modal', function () {
		location.reload();
	});


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

	$(document).on('click','.remove_sp_day',function(){
		var data_id = $(this).attr('data-id');
		$('#sp_day_'+data_id).remove();
  		$(this).parents('li').eq(0).remove();
  	});

  	//Print error Message JS function
	function printErrorMsg (msg) {
		$("#error").find("ul").html('');
		$("#error").css('display','block');
		$.each( msg, function( key, value ) {
			$("#error").find("ul").append('<li>'+value+'</li>');
		});
		setTimeout(function() { $('#error').hide(); }, 3000);
	}

	//cHEMIST accept reject Ajax
	function acceptRejectChemist(status){
		var chemist_id = $("#chemist_id").val(); 
		var url = '{{ url('/chemist/change_chemist_status') }}';
		var dataString = {
			_token: "{{ csrf_token() }}",
			id:chemist_id,status:status
		};
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){ //console.log(data);
				if(data.status == 200){
					$("#success").show();
					$("#error").hide();
					$("#success").html(data.reason);
					$('#addChemistModal').animate({ scrollTop: 0 }, 'slow');
					setTimeout(function() {$('#success').hide(); },2000);
					setTimeout(function() {$('#addChemistModal').modal('hide');},2000);
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
    </script>
@endsection