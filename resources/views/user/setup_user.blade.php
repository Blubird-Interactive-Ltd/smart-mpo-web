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
                <span> Setup User</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    
	<!-- Head sections  -->
	<div class="row m-t-25">
    	<div class="col-lg-12">
	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="row">
								<div class="col-sm-3">
									<div class="caption">
						                <i class="icon-bar-chart font-dark hide"></i>
						                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Setup User</span>
						            </div>
								</div>
								<div class="col-sm-5">
									<!-- Message Section-->
				        			@include('layouts.includes.message')

									<div class="alert alert-success alert-dismissible hidden" id="status_warning" role="alert">
									  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  	<strong>Warning!</strong> Better check yourself, you're not looking too good.
									</div>
								</div>
								<div class="col-sm-4">
									<div class="actions lg-action pull-right">
										<!--div class="form-group form-md-line-input w200 action-select">
		                                    <select class="form-control" id="setup_user_type">
		                                        <option value="">Select User Type</option>
		                                        @if(isset($roles))
		                                    	@foreach($roles as $role)
		                                    	<option value="{{ $role->role_id }}">{{ $role->name }}
		                                    	</option>
		                                    	@endforeach
		                                    	@else
		                                    	<option>No user role found !!</option>
		                                    	@endif
		                                    </select>
		                                </di-->

										@if(\App\Utility::userRolePermission(Session::get('role_id'),30))
											<div class="btn-group btn-group-devided pull-right">
												<button type="button" class="btn btn-primary" id="add_new_user_btn" data-toggle="modal" data-target="#add_new_user"><i class="icon-plus icons"></i> Add New</button>
											</div>
										@endif
		                            </div>
								</div>
							</div>
				            
				        </div>

				        <div class="portlet-body Details">

							@if(\App\Utility::userRolePermission(Session::get('role_id'),29))

				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<div class="">
										<select class="form-control edited single_filter" id="user_type_select">
				                            <option value="">Filter by User Type</option>
                                        	<option value="MPO">MPO </option>
                                        	<option value="AM">AM</option>
                                        	<option value="RSM">RSM</option>
                                        	<option value="ZSM">ZSM </option>
                                        	<option value="SM">SM</option>
				                        </select>

				                        <table class="table table-bordered datatable" id="user_type_table" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w30">Sl. No.</th>
								                  <th class="w100"> Name</th>
								                  <th class="w70">Hr Code </th>
								                  <th class="w70">User Type </th>
								                  <th class="w100">Work Contact</th>
								                  <th class="w100">IMEI</th>
								                  <th class="w70">User Id </th>
								                  <th class="w70">Password </th>
								                  <th class="text-center w200">Action</th>
								                </tr>
							              	</thead>
							              	<tbody><?php $num=1; ?>
							              	@if(isset($users))
							              	@foreach($users as $user)	
								                <tr id="user{{ $user->id }}">
								                  	<td>{{ $num }}</td>
								                  	<td>{{ $user->first_name }} {{ $user->last_name }}</td>
								                  	<td>{{ $user->hr_port }}</td>
								                  	<td class="user_type_td">{{ $user->name }}</td>
								                  	<td>{{ $user->work_contact }}</td>
								                  	<td>{{ $user->active_imei }}</td>
								                  	<td>{{ $user->user_id }}</td>
								                  	<td>{{ \App\Utility::decrypt_string($user->is_view_password) }}</td>
								                  	<td class="text-center">

														@if(\App\Utility::userRolePermission(Session::get('role_id'),31))
								                  		<a title="Edit" href="javascript:;" class="btn btn-sm btn-info edit_user" data-toggle="modal" data-target="#add_new_user" onclick="userEdit('{{ $user->id }}','{{ $user->role_id }}')">
								                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								                  		</a>
														@endif
													@if($user->is_locked == 1)
														@if(\App\Utility::userRolePermission(Session::get('role_id'),32))
															<a title="Unlock" href="javascript:;" class="btn btn-sm btn-danger" onclick="UserLock('{{ $user->id }}','unlock');">
																<i class="fa fa-unlock" aria-hidden="true"></i>
															</a>
														@endif
													@else
														@if(\App\Utility::userRolePermission(Session::get('role_id'),32))
															<a title="Lock" href="javascript:;" class="btn btn-sm btn-warning" onclick="UserLock('{{ $user->id }}','lock');">
																<i class="fa fa-lock" aria-hidden="true"></i>
															</a>
														@endif
													@endif

													@if($user->status == 'active')
														@if(\App\Utility::userRolePermission(Session::get('role_id'),33))
														<a title="Inactive" href="javascript:;" class="btn btn-sm btn-danger" onclick="changeStatus('{{ $user->id }}','inactive')">
															<i class="fa fa-ban" aria-hidden="true"></i>
														</a>
														@endif
								                  	@else
														@if(\App\Utility::userRolePermission(Session::get('role_id'),33))
														<a title="Active" href="javascript:;" class="btn btn-sm btn-success" onclick="changeStatus('{{ $user->id }}','active')">
															<i class="fa fa-flash" aria-hidden="true"></i>
														</a>
														@endif
								                  	@endif		

								                  	</td>
								                </tr><?php $num++; ?>
								                @endforeach
								                @endif
								            </tbody>
							            </table>
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

	<!-- New User Add modal-->
	<!-- Modal -->
	<div id="add_new_user" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add User</h4>
		      	</div>
		      	<div class="modal-body" id="user-forms">
		      		<div id="typeArea">
			      		<div class="row">
				      		<div class="col-sm-4 col-sm-offset-4">
					      		<div class="form-group form-md-line-input">
                                    <select class="form-control" id="setup_user_type">
                                        <option value="">Select</option>
                                        @if(isset($roles))
                                    	@foreach($roles as $role)
                                    	<option value="{{ $role->role_id }}">{{ $role->name }}
                                    	</option>
                                    	@endforeach
                                    	@else
                                    	<option>No user role found !!</option>
                                    	@endif
                                    </select>
                                    <label for="setup_user_type">Select User Type</label>
                                </div>
		                    </div>
	                    </div>
                    </div>

		      		<div id="Create5" class="hidden user-forms-item">
		      			<form action="{{ url('/user/store') }}" id="mpo_user" method="POST">
							<div class="alert alert-success success_message" style="display: none"></div>
							<div class="alert alert-danger error_message" style="display: none"></div>

		      			{{ csrf_field() }}

				        	<div class="row">
				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation" name="parent_id" id="parent_id">
	                                        <option value="">Select</option>
	                                        @if(isset($amList))
	                                        @foreach($amList as $am)
	                                        <option value="{{ $am->id }}">{{ $am->first_name }} {{ $am->last_name }}</option>
	                                        @endforeach
	                                        @endif
	                                    </select>
	                                    <label for="form_control_1">Select AM</label>
	                                    <span class="help-block" id="err_parent_id">Select AM...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation division_id" name="division_id" id="mpo_division_id">
	                                        <option value="">Select Division</option>
											@if(isset($divisions))
												@foreach($divisions as $div)
													<option value="{{ $div->division_id }}">{{ $div->name }}</option>
												@endforeach
											@endif
	                                    </select>
	                                    <label for="form_control_1">Select Division</label>
	                                    <span class="help-block" id="err_territory_id">Select Territory...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation zone_id" name="zone_id" id="mpo_zone_id">
	                                        <option value="">Select Zone</option>
	                                    </select>
	                                    <label for="form_control_1">Select Zone</label>
	                                    <span class="help-block" id="err_territory_id">Select Territory...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation region_id" name="region_id" id="mpo_region_id">
	                                        <option value="">Select Region</option>
	                                    </select>
	                                    <label for="form_control_1">Select Region</label>
	                                    <span class="help-block" id="err_territory_id">Select Territory...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation area_id" name="area_id" id="mpo_area_id">
	                                        <option value="">Select Area</option>
	                                    </select>
	                                    <label for="form_control_1">Select Area</label>
	                                    <span class="help-block" id="err_territory_id">Select Territory...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation territory_id" name="territory_id" id="mpo_territory_id">
	                                        <option value="">Select Territory</option>
	                                    </select>
	                                    <label for="form_control_1">Select Territory</label>
	                                    <span class="help-block" id="err_territory_id">Select Territory...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="first_name" name="first_name" value="">
				                        <label for="">Fiest Name </label>
				                        <span class="help-block" id="err_first_name">Enter Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="last_name" name="last_name">
				                        <label for="">Last Name </label>
				                        <span class="help-block" id="err_last_name">Enter Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="hr_port" name="hr_port">
				                        <label for="">Hr Code </label>
				                        <span class="help-block" id="err_hr_port">Enter HR code</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="account_port" name="account_port">
				                        <label for="">Account Code </label>
				                        <span class="help-block" id="err_account_port">Enter Account port</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="home_contact" name="home_contact">
				                        <label for="">Home Contact </label>
				                        <span class="help-block" id="err_home_contact">Enter Home Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="personal_contact" name="personal_contact">
				                        <label for="self_phone">Personal Contact</label>
				                        <span class="help-block" id="err_personal_contact">Enter Personal Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="work_contact" name="work_contact">
				                        <label for="">Work Contact</label>
				                        <span class="help-block" id="err_work_contact">Enter Work Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="email" class="form-control chcek-validation" id="email" name="email">
				                        <label for="">Email </label>
				                        <span class="help-block" id="err_email">Enter Email</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="active_imei" name="active_imei">
				                        <label for="">IMEI  </label>
				                        <span class="help-block" id="err_active_imei">Enter IMEI </span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="user_id" name="user_id" autocomplete="off">
				                        <label for="">User ID </label>
				                        <span class="help-block" id="err_user_id">Enter User ID</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label" id="mpo_pass">
				                        <input type="password" class="form-control chcek-validation" id="password" name="password" autocomplete="off">
				                        <label for="">Password</label>
				                        <span class="help-block" id="err_password">Enter Password</span>
				                    </div>
				        		</div>
				        		<input type="hidden" name="role_id" id="user_role" value="5">
				        		<input type="hidden" id="uid" value="0">

				        		<div class="col-sm-12 col-xs-12 text-right">
									<span class="hidden" id="ajax_loader_mpo"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="mpo_submit">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>

		        	<div id="Create4" class="hidden user-forms-item">
		        		<form action="">
							<div class="alert alert-success success_message" style="display: none"></div>
							<div class="alert alert-danger error_message" style="display: none"></div>
				        	<div class="row">
				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation" name="rsm_id" id="rsm_id">
	                                        <option value="">Select</option>
	                                        @if(isset($rsmList))
						              		@foreach($rsmList as $rsm)
						              		<option value="{{ $rsm->id }}">{{ $rsm->first_name }} {{ $rsm->last_name }}</option>
							                @endforeach
							                @endif
	                                    </select>
	                                    <label for="form_control_1">Select RSM</label>
	                                    <span class="help-block" id="err_rsm_id">Select RSM...</span>
	                                </div>
				        		</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation division_id" name="division_id" id="am_division_id">
											<option value="">Select Division</option>
											@if(isset($divisions))
												@foreach($divisions as $div)
													<option value="{{ $div->division_id }}">{{ $div->name }}</option>
												@endforeach
											@endif
										</select>
										<label for="form_control_1">Select Division</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation zone_id" name="zone_id" id="am_zone_id">
											<option value="">Select Zone</option>
										</select>
										<label for="form_control_1">Select Zone</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation region_id" name="region_id" id="am_region_id">
											<option value="">Select Region</option>
										</select>
										<label for="form_control_1">Select Region</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation area_id" name="area_id" id="am_area_id">
											<option value="">Select Area</option>
										</select>
										<label for="form_control_1">Select Area</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_fname" name="am_fname">
				                        <label for=""> First Name </label>
				                        <span class="help-block" id="err_am_fname">Enter First Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_lname" name="am_lname">
				                        <label for=""> Last Name </label>
				                        <span class="help-block" id="err_am_lname">Enter Last Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_hr_port" name="am_hr_port">
				                        <label for="">Hr Code </label>
				                        <span class="help-block" id="err_am_hr">Enter HR code</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_acc_port" name="am_acc_port">
				                        <label for="">Account Code </label>
				                        <span class="help-block" id="err_am_acc">Enter Account port</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="am_hcontact" name="am_hcontact">
				                        <label for="">Home Contact </label>
				                        <span class="help-block" id="err_am_hcontact">Enter Home Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="am_pcontact" name="am_pcontact">
				                        <label for="">Personal Contact</label>
				                        <span class="help-block" id="err_am_pcontact">Enter Personal Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="am_wcontact" name="am_wcontact">
				                        <label for="">Work Contact</label>
				                        <span class="help-block" id="err_am_wcontact">Enter Work Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="email" class="form-control chcek-validation" id="am_email" name="am_email">
				                        <label for="">Email </label>
				                        <span class="help-block" id="err_am_email">Enter Email</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_imei" name="am_imei">
				                        <label for="">IMEI  </label>
				                        <span class="help-block" id="err_am_imei">Enter IMEI </span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="am_uid" name="am_uid" autocomplete="off">
				                        <label for="">User ID </label>
				                        <span class="help-block" id="err_am_id">Enter User ID</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label" id="am_pass">
				                        <input type="password" class="form-control chcek-validation" id="am_password" name="am_password" autocomplete="off">
				                        <label for="">Password</label>
				                        <span class="help-block" id="err_am_password">Enter Password</span>
				                    </div>
				        		</div>

				        	<input type="number" name="role_id" id="am_role_id" value="4" hidden>
				        	<input type="hidden" id="amUid" value="0">

				        		<div class="col-sm-12 col-xs-12 text-right">
									<span class="hidden" id="ajax_loader_am"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="am_submit">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>

		        	<div id="Create3" class="hidden user-forms-item">
		        		<form id="rsm_user" action="">
							<div class="alert alert-success success_message" style="display: none"></div>
							<div class="alert alert-danger error_message" style="display: none"></div>
				        	<div class="row">
				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation" name="zsm_id" id="zsm_id">
	                                        <option value="">Select</option>
	                                        @if(isset($zsmList))
						              		@foreach($zsmList as $zsm)
						              		<option value="{{ $zsm->id }}">{{ $zsm->first_name }} {{ $zsm->last_name }}</option>
							                @endforeach
							                @endif
	                                    </select>
	                                    <label for="form_control_1">Select ZSM</label>
	                                    <span class="help-block" id="err_zsm_id">Select ZSM...</span>
	                                </div>
				        		</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation division_id" name="division_id" id="rsm_division_id">
											<option value="">Select Division</option>
											@if(isset($divisions))
												@foreach($divisions as $div)
													<option value="{{ $div->division_id }}">{{ $div->name }}</option>
												@endforeach
											@endif
										</select>
										<label for="form_control_1">Select Division</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation zone_id" name="zone_id" id="rsm_zone_id">
											<option value="">Select Zone</option>
										</select>
										<label for="form_control_1">Select Zone</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation region_id" name="region_id" id="rsm_region_id">
											<option value="">Select Region</option>
										</select>
										<label for="form_control_1">Select Region</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_fname" name="rsm_fname">
				                        <label for="">First Name </label>
				                        <span class="help-block" id="err_rsm_fname">Enter First Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_lname" name="rsm_lname">
				                        <label for="">Last Name </label>
				                        <span class="help-block" id="err_rsm_lname">Enter Last Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_hr" name="rsm_hr">
				                        <label for="">Hr Code </label>
				                        <span class="help-block" id="err_rsm_hr">Enter HR code</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_acc" name="rsm_acc">
				                        <label for="">Account Code </label>
				                        <span class="help-block" id="err_rsm_acc">Enter Account port</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="rsm_hcontact" name="rsm_hcontact">
				                        <label for="">Home Contact </label>
				                        <span class="help-block" id="err_rsm_hcontact">Enter Home Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="rsm_pcontact" name="rsm_pcontact">
				                        <label for="">Personal Contact</label>
				                        <span class="help-block" id="err_rsm_pcontact">Enter Personal Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="rsm_wcontact" name="rsm_wcontact">
				                        <label for="">Work Contact</label>
				                        <span class="help-block" id="err_rsm_wcontact">Enter Work Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="email" class="form-control chcek-validation" id="rsm_email" name="rsm_email">
				                        <label for="">Email </label>
				                        <span class="help-block" id="err_rsm_email">Enter Email</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_imei" name="rsm_imei">
				                        <label for="">IMEI  </label>
				                        <span class="help-block" id="err_rsm_imei">Enter IMEI </span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="rsm_uid" name="rsm_uid" autocomplete="off">
				                        <label for="">User ID </label>
				                        <span class="help-block" id="err_rsm_uid">Enter User ID</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label" id="rsm_pass">
				                        <input type="password" class="form-control chcek-validation" id="rsm_password" name="rsm_password" autocomplete="off">
				                        <label for="">Password</label>
				                        <span class="help-block" id="err_rsm_password">Enter Password</span>
				                    </div>
				        		</div>

								<input type="hidden" name="" id="rsm_role" value="3">
								<input type="hidden" id="rsmUid" value="0">

				        		<div class="col-sm-12 col-xs-12 text-right">
									<span class="hidden" id="ajax_loader_rsm"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="rsm_submit">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>

		        	<div id="Create2" class="hidden user-forms-item">
		        		<form id="zsm_user" action="">
							<div class="alert alert-success success_message" style="display: none"></div>
							<div class="alert alert-danger error_message" style="display: none"></div>
				        	<div class="row">
				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation" name="sm_id" id="sm_id">
	                                        <option value="">Select</option>
	                                        @if(isset($smList))
						              		@foreach($smList as $sm)
						              			<option value="{{ $sm->id }}">{{ $sm->first_name }} {{ $sm->last_name }}</option>
							                @endforeach
							                @endif
	                                    </select>
	                                    <label for="form_control_1">Select SM</label>
	                                    <span class="help-block" id="err_sm_id">Select SM...</span>
	                                </div>
				        		</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation division_id" name="division_id" id="zsm_division_id">
											<option value="">Select Division</option>
											@if(isset($divisions))
												@foreach($divisions as $div)
													<option value="{{ $div->division_id }}">{{ $div->name }}</option>
												@endforeach
											@endif
										</select>
										<label for="form_control_1">Select Division</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

								<div class="col-sm-4 col-xs-12">
									<div class="form-group form-md-line-input">
										<select class="form-control chcek-validation zone_id" name="zone_id" id="zsm_zone_id">
											<option value="">Select Zone</option>
										</select>
										<label for="form_control_1">Select Zone</label>
										<span class="help-block" id="err_territory_id">Select Territory...</span>
									</div>
								</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_fname" name="zsm_fname">
				                        <label for="">First Name </label>
				                        <span class="help-block" id="err_zsm_fname">Enter First Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_lname" name="zsm_lname">
				                        <label for="">Last Name </label>
				                        <span class="help-block" id="err_zsm_lname">Enter Last Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_hr" name="zsm_hr">
				                        <label for="">Hr Code </label>
				                        <span class="help-block" id="err_zsm_hr">Enter HR code</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_acc" name="zsm_acc">
				                        <label for="">Account Code </label>
				                        <span class="help-block" id="err_zsm_acc">Enter Account port</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="zsm_hcontact" name="zsm_hcontact">
				                        <label for="">Home Contact </label>
				                        <span class="help-block" id="err_zsm_hcontact">Enter Home Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="zsm_pcontact" name="zsm_pcontact">
				                        <label for="">Personal Contact</label>
				                        <span class="help-block" id="err_zsm_pcontact">Enter Personal Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="zsm_wcontact" name="zsm_wcontact">
				                        <label for="">Work Contact</label>
				                        <span class="help-block" id="err_zsm_wcontact">Enter Work Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="email" class="form-control chcek-validation" id="zsm_email" name="zsm_email">
				                        <label for="">Email </label>
				                        <span class="help-block" id="err_zsm_email">Enter Email</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_imei" name="zsm_imei">
				                        <label for="">IMEI  </label>
				                        <span class="help-block" id="err_zsm_imei">Enter IMEI </span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="zsm_uid" name="zsm_uid" autocomplete="off">
				                        <label for="">User ID </label>
				                        <span class="help-block" id="err_zsm_uid">Enter User ID</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label" id="zsm_pass">
				                        <input type="password" class="form-control chcek-validation" id="zsm_password" name="zsm_password" autocomplete="off">
				                        <label for="">Password</label>
				                        <span class="help-block" id="err_zsm_password">Enter Password</span>
				                    </div>
				        		</div>
								<input type="hidden" name="" id="zsm_role" value="2">
								<input type="hidden" id="zsmUid" value="0">
				        		<div class="col-sm-12 col-xs-12 text-right">
									<span class="hidden" id="ajax_loader_zsm"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="zsm_submit">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>

		        	<div id="Create1" class="hidden user-forms-item">
		        		<form id="sm_user" action="">
							<div class="alert alert-success success_message" style="display: none"></div>
							<div class="alert alert-danger error_message" style="display: none"></div>

							<div class="row">

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                    <select class="form-control chcek-validation division_id" name="division_id" id="sm_division_id">
	                                        <option value="">Select</option>
	                                        @if(isset($divisions))
						              		@foreach($divisions as $div)
							                <option value="{{ $div->division_id }}">{{ $div->name }}</option>
							                @endforeach
							                @endif
	                                    </select>
	                                    <label for="form_control_1">Select Division</label>
	                                    <span class="help-block" id="err_division_id">Select Division...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_fname" name="sm_fname">
				                        <label for="">First Name </label>
				                        <span class="help-block" id="err_sm_fname">Enter First Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_lname" name="sm_lname">
				                        <label for="">Last Name </label>
				                        <span class="help-block" id="err_sm_lname">Enter Last Name</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_hr" name="sm_hr">
				                        <label for="">Hr Code </label>
				                        <span class="help-block" id="err_sm_hr">Enter HR code</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_acc" name="sm_acc">
				                        <label for="">Account Code </label>
				                        <span class="help-block" id="err_sm_acc">Enter Account port</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="sm_hcontact" name="sm_hcontact">
				                        <label for="">Home Contact </label>
				                        <span class="help-block" id="err_sm_hcontact">Enter Home Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="sm_pcontact" name="sm_pcontact">
				                        <label for="">Personal Contact</label>
				                        <span class="help-block" id="err_sm_pcontact">Enter Personal Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control chcek-validation" id="sm_wcontact" name="sm_wcontact">
				                        <label for="">Work Contact</label>
				                        <span class="help-block" id="err_sm_wcontact">Enter Work Contact</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="email" class="form-control chcek-validation" id="sm_email" name="sm_email">
				                        <label for="">Email </label>
				                        <span class="help-block" id="err_sm_email">Enter Email</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_imei" name="sm_imei">
				                        <label for="">IMEI  </label>
				                        <span class="help-block" id="err_sm_imei">Enter IMEI </span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control chcek-validation" id="sm_uid" name="sm_uid" autocomplete="off">
				                        <label for="">User ID </label>
				                        <span class="help-block" id="err_sm_uid">Enter User ID</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label" id="sm_pass">
				                        <input type="password" class="form-control chcek-validation" id="sm_password" name="sm_password" autocomplete="off">
				                        <label for="">Password</label>
				                        <span class="help-block" id="err_sm_password">Enter Password</span>
				                    </div>
				        		</div>
								<input type="hidden" name="" id="sm_role" value="1">
								<input type="hidden" id="smUid" value="0">
				        		<div class="col-sm-12 col-xs-12 text-right">
									<span class="hidden" id="ajax_loader_sm"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="sm_submit">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>

		      	</div>
		    </div>

	  	</div>
	</div>


	<!-- Accept /reject modal START-->

	<!-- Modal -->
	<div id="changeStatus" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3 id="confirm_status"> </h3>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<a href="#" data-del="" data-status="" class="btn btn-success" id="delUser" data-dismiss="modal">Yes, Continue</a>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

	<!-- Lock Unlock modal START-->
	<!-- Modal -->
	<div id="lockUnlock" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3 id="confirm_sms"></h3>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<a href="#" data-del="" data-lock="" class="btn btn-success" id="lockUser" data-dismiss="modal">Yes, Continue</a>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
<script type="text/javascript">
	setTimeout(function(){
		$('.alert-success').addClass('hidden');
	}, 3000);
	//MPO submit AJAX Function
	$('#mpo_submit').click(function(){
		$('#ajax_loader_mpo').removeClass('hidden');
		var parent_id = $("#parent_id option:selected").val(); 
		var division_id = $( "#mpo_division_id option:selected" ).val();
		var zone_id = $( "#mpo_zone_id option:selected" ).val();
		var region_id = $( "#mpo_region_id option:selected" ).val();
		var area_id = $( "#mpo_area_id option:selected" ).val();
		var territory_id = $( "#mpo_territory_id option:selected" ).val();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var hr_port = $('#hr_port').val();
		var account_port = $('#account_port').val();
		var home_contact = $('#home_contact').val();
		var personal_contact = $('#personal_contact').val();
		var work_contact = $('#work_contact').val();
		var email = $('#email').val();
		var active_imei = $('#active_imei').val();
		var user_id = $('#user_id').val();
		var password = $('#password').val();
		var user_role = $('#user_role').val();
		var uid = $('#uid').val();

		var validate = '';

		if(parent_id === ''){
			validate = validate+'Select AM<br>';
		}
		if(division_id.trim() === ''){
			validate = validate+'Select division<br>';
		}
		if(zone_id.trim() === ''){
			validate = validate+'Select zone<br>';
		}
		if(region_id.trim() === ''){
			validate = validate+'Select region<br>';
		}
		if(area_id.trim() === ''){
			validate = validate+'Select area<br>';
		}
		if(territory_id.trim() === ''){
			validate = validate+'Select territory<br>';
		}
		
		if(first_name.trim() === ''){
			validate = validate+'First name required<br>';
		}
		if(last_name.trim() === ''){
			validate = validate+'Last name required<br>';
		}
		if(hr_port.trim() === ''){
			validate = validate+'HR code required<br>';
		}
		if(account_port.trim() === ''){
			validate = validate+'Account port required<br>';
		}
		if(home_contact.trim() === ''){
			validate = validate+'Home Contact required<br>';
		}
		if(personal_contact.trim() === ''){
			validate = validate+'Personal contact required<br>';
		}
		if(work_contact.trim() === ''){
			validate = validate+'Work contact required<br>';
		}
		/*if(email === ''){
			validate = validate+'Email required<br>';
		}*/
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
        if (email.trim() !='' && !emailRegex.test(email)) {
			validate = validate+'Email is invalid<br>';
        }

		/*if(active_imei.trim() === ''){
			validate = validate+'Active imei required<br>';
		}*/
		if(user_id.trim() === ''){
			validate = validate+'User id required<br>';
		}
		if($('#uid').val() ==0 && password.trim() === ''){
			validate = validate+'Password required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				email : email,
				parent_id : parent_id,
				division_id:division_id,
				zone_id:zone_id,
				region_id:region_id,
				area_id:area_id,
				territory_id:territory_id,
				first_name:first_name,
				last_name:last_name,
				hr_port:hr_port,
				account_port:account_port,
				home_contact:home_contact,
				personal_contact:personal_contact,
				work_contact:work_contact,
				active_imei:active_imei,
				user_id:user_id,
				password:password,
				user_role:user_role,
				uid:uid
			};
			if(uid != 0){
				var url = "{{ url('user/update') }}";
			}else{
				var url = "{{ url('user/store') }}";
			}
			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('.success_message').show();
						$('.error_message').hide();
						$('.error_message').html(data.reason);
						location.reload();
					}
					else{
						$('#ajax_loader_mpo').addClass('hidden');
						$('.success_message').hide();
						$('.error_message').show();
						$('.error_message').html(data.reason);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('#ajax_loader_mpo').addClass('hidden');
			$('.success_message').hide();
			$('.error_message').show();
			$('.error_message').html(validate);
		}

		setTimeout(function(){
			$('.success_message').html('');
			$('.error_message').hide();
		}, 3000);

	});	


	//AM submit AJAX Function
	$('#am_submit').click(function(){
		$('#ajax_loader_am').removeClass('hidden');
		var rsm_id = $("#rsm_id option:selected").val();
		var division_id = $( "#am_division_id option:selected" ).val();
		var zone_id = $( "#am_zone_id option:selected" ).val();
		var region_id = $( "#am_region_id option:selected" ).val();
		var area_id = $( "#am_area_id option:selected" ).val();
		var am_fname = $('#am_fname').val();
		var am_lname = $('#am_lname').val();
		var am_hr_port = $('#am_hr_port').val();
		var am_acc_port = $('#am_acc_port').val();
		var am_hcontact = $('#am_hcontact').val();
		var am_pcontact = $('#am_pcontact').val();
		var am_wcontact = $('#am_wcontact').val();
		var am_email = $('#am_email').val();
		var amUid = $('#amUid').val();
		var am_uid = $('#am_uid').val();
		var am_password = $('#am_password').val();
		var user_role = $('#am_role_id').val();
		var am_imei = $('#am_imei').val();

		var validate='';

		if(rsm_id.trim() === ''){
			validate = validate+'Select RSM<br>';
		}
		if(division_id.trim() === ''){
			validate = validate+'Select division<br>';
		}
		if(zone_id.trim() === ''){
			validate = validate+'Select zone<br>';
		}
		if(region_id.trim() === ''){
			validate = validate+'Select region<br>';
		}
		if(area_id.trim() === ''){
			validate = validate+'Select area<br>';
		}
		
		if(am_fname.trim() === ''){
			validate = validate+'First name required<br>';
		}
		if(am_lname.trim() === ''){
			validate = validate+'Last name required<br>';
		}
		if(am_hr_port.trim() === ''){
			validate = validate+'HR code required<br>';
		}
		if(am_acc_port.trim() === ''){
			validate = validate+'Account port required<br>';
		}
		if(am_hcontact.trim() === ''){
			validate = validate+'Home contact required<br>';
		}
		if(am_pcontact.trim() === ''){
			validate = validate+'Personal contact required<br>';
		}
		if(am_wcontact.trim() === ''){
			validate = validate+'Work contact required<br>';
		}
		/*if(am_email.trim() === ''){
			validate = validate+'email required<br>';
		}*/
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		if (am_email.trim() !='' && !emailRegex.test(am_email)) {
			validate = validate+'Email is invalid<br>';
		}

		/*if(am_imei.trim() === ''){
			validate = validate+'Active imei required<br>';
		}*/

		if(am_uid.trim() === ''){
			validate = validate+'User id required<br>';
		}
		if($('#amUid').val() ==0 && am_password.trim() === ''){
			validate = validate+'password required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				email : am_email,
				active_imei:am_imei,
				parent_id : rsm_id,
				division_id:division_id,
				zone_id:zone_id,
				region_id:region_id,
				area_id:area_id,
				territory_id:0,
				first_name:am_fname,
				last_name:am_lname,
				hr_port:am_hr_port,
				account_port:am_acc_port,
				home_contact:am_hcontact,
				personal_contact:am_pcontact,
				work_contact:am_wcontact,
				user_role:user_role,
				user_id:am_uid,
				password:am_password,
				uid:amUid
			};

			if(amUid == 0){
				var url = "{{ url('user/store') }}";
			}else{
				var url = "{{ url('user/update') }}";
			}

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('.success_message').show();
						$('.error_message').hide();
						$('.error_message').html(data.reason);
						location.reload();
					}
					else{
						$('#ajax_loader_am').addClass('hidden');
						$('.success_message').hide();
						$('.error_message').show();
						$('.error_message').html(data.reason);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('#ajax_loader_am').addClass('hidden');
			$('.success_message').hide();
			$('.error_message').show();
			$('.error_message').html(validate);
		}
		setTimeout(function(){
			$('.success_message').html('');
			$('.error_message').hide();
		}, 3000);

	});

	//RSM submit AJAX Function
	$('#rsm_submit').click(function(){
		$('#ajax_loader_rsm').removeClass('hidden');
		var zsm_id = $("#zsm_id option:selected").val();
		var division_id = $( "#rsm_division_id option:selected" ).val();
		var zone_id = $( "#rsm_zone_id option:selected" ).val();
		var region_id = $( "#rsm_region_id option:selected" ).val();
		var rsm_fname = $('#rsm_fname').val();
		var rsm_lname = $('#rsm_lname').val();
		var rsm_hr = $('#rsm_hr').val();
		var rsm_acc = $('#rsm_acc').val();
		var rsm_hcontact = $('#rsm_hcontact').val();
		var rsm_pcontact = $('#rsm_pcontact').val();
		var rsm_wcontact = $('#rsm_wcontact').val();
		var rsm_email = $('#rsm_email').val();
		var rsm_uid = $('#rsm_uid').val();
		var rsm_password = $('#rsm_password').val();
		var user_role = $('#rsm_role').val();
		var rsm_imei = $('#rsm_imei').val();
		var rsmUid = $('#rsmUid').val();

		var validate = '';

		if(zsm_id.trim() === ''){
			validate = validate+'Select ZSM<br>';
		}
		if(division_id.trim() === ''){
			validate = validate+'Select division<br>';
		}
		if(zone_id.trim() === ''){
			validate = validate+'Select zone<br>';
		}
		if(region_id.trim() === ''){
			validate = validate+'Select region<br>';
		}
		
		if(rsm_fname.trim() === ''){
			validate = validate+'First name required<br>';
		}
		if(rsm_lname.trim() === ''){
			validate = validate+'Last name required<br>';
		}
		if(rsm_hr.trim() === ''){
			validate = validate+'HR code required<br>';
		}
		if(rsm_acc.trim() === ''){
			validate = validate+'Account port required<br>';
		}
		if(rsm_hcontact.trim() === ''){
			validate = validate+'Home contact required<br>';
		}
		if(rsm_pcontact.trim() === ''){
			validate = validate+'Personal contact required<br>';
		}
		if(rsm_wcontact.trim() === ''){
			validate = validate+'Work contact required<br>';
		}
		/*if(rsm_email.trim() === ''){
			validate = validate+'Email required<br>';
		}*/
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		if (rsm_email.trim() !='' && !emailRegex.test(rsm_email)) {
			validate = validate+'Email is invalid<br>';
		}

		/*if(rsm_imei === ''){
			validate = validate+'Active imei required<br>';
		}*/
		if(rsm_uid.trim() === ''){
			validate = validate+'User id required<br>';
		}
		if($('#rsmUid').val() ==0 && rsm_password === ''){
			validate = validate+'Password required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				email : rsm_email,
				parent_id : zsm_id,
				division_id:division_id,
				zone_id:zone_id,
				region_id:region_id,
				area_id:0,
				territory_id:0,
				first_name:rsm_fname,
				last_name:rsm_lname,
				hr_port:rsm_hr,
				account_port:rsm_acc,
				home_contact:rsm_hcontact,
				personal_contact:rsm_pcontact,
				work_contact:rsm_wcontact,
				user_id:rsm_uid,
				active_imei:rsm_imei,
				password:rsm_password,
				user_role : user_role,
				uid:rsmUid,
			};
			if(rsmUid == 0){
				var url = "{{ url('user/store') }}";
			}else{
				var url = "{{ url('user/update') }}";
			}

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('.success_message').show();
						$('.error_message').hide();
						$('.error_message').html(data.reason);
						location.reload();
					}
					else{
						$('#ajax_loader_rsm').addClass('hidden');
						$('.success_message').hide();
						$('.error_message').show();
						$('.error_message').html(data.reason);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('#ajax_loader_rsm').addClass('hidden');
			$('.success_message').hide();
			$('.error_message').show();
			$('.error_message').html(validate);
		}
		setTimeout(function(){
			$('.success_message').html('');
			$('.error_message').hide();
		}, 3000);

	});

	//ZSM submit AJAX Function
	$('#zsm_submit').click(function(){
		$('#ajax_loader_zsm').removeClass('hidden');
		var sm_id = $("#sm_id option:selected").val();
		var division_id = $( "#zsm_division_id option:selected" ).val();
		var zone_id = $( "#zsm_zone_id option:selected" ).val();
		var zsm_fname = $('#zsm_fname').val();
		var zsm_lname = $('#zsm_lname').val();
		var zsm_hr = $('#zsm_hr').val();
		var zsm_acc = $('#zsm_acc').val();
		var zsm_hcontact = $('#zsm_hcontact').val();
		var zsm_pcontact = $('#zsm_pcontact').val();
		var zsm_wcontact = $('#zsm_wcontact').val();
		var zsm_email = $('#zsm_email').val();
		var zsm_imei = $('#zsm_imei').val();
		var zsm_uid = $('#zsm_uid').val();
		var zsm_password = $('#zsm_password').val();
		var user_role = $('#zsm_role').val();
		var zsmUid = $('#zsmUid').val();

		var validate ='';

		if(sm_id.trim() === ''){
			validate = validate+'Select SM<br>';
		}
		if(division_id.trim() === ''){
			validate = validate+'Select division<br>';
		}
		if(zone_id.trim() === ''){
			validate = validate+'Select zone<br>';
		}
		
		if(zsm_fname.trim() === ''){
			validate = validate+'First name required<br>';
		}
		if(zsm_lname.trim() === ''){
			validate = validate+'Last name required<br>';
		}
		if(zsm_hr.trim() === ''){
			validate = validate+'HR code required<br>';
		}
		if(zsm_acc.trim() === ''){
			validate = validate+'Account port required<br>';
		}
		if(zsm_hcontact.trim() === ''){
			validate = validate+'Home contact required<br>';
		}
		if(zsm_pcontact.trim() === ''){
			validate = validate+'Personal contact required<br>';
		}
		if(zsm_wcontact.trim() === ''){
			validate = validate+'Work contact required<br>';
		}
		/*if(zsm_email.trim() === ''){
			validate = validate+'email required<br>';
		}*/
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		if (zsm_email.trim() !='' && !emailRegex.test(zsm_email)) {
			validate = validate+'Email is invalid<br>';
		}
		/*if(zsm_imei.trim() === ''){
			validate = validate+'Active imei required<br>';
		}*/
		if(zsm_uid.trim() === ''){
			validate = validate+'User id required<br>';
		}
		if($('#zsmUid').val() ==0 && zsm_password === ''){
			validate = validate+'Password required<br>';
		}

		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				email : zsm_email,
				parent_id : sm_id,
				division_id:division_id,
				zone_id:zone_id,
				region_id:0,
				area_id:0,
				territory_id:0,
				first_name:zsm_fname,
				last_name:zsm_lname,
				hr_port:zsm_hr,
				account_port:zsm_acc,
				home_contact:zsm_hcontact,
				personal_contact:zsm_pcontact,
				work_contact:zsm_wcontact,
				user_id:zsm_uid,
				active_imei:zsm_imei,
				password:zsm_password,
				user_role : user_role,
				uid:zsmUid
			};
			if(zsmUid == 0){
				var url = "{{ url('user/store') }}";
			}else{
				var url = "{{ url('user/update') }}";
			}

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('.success_message').show();
						$('.error_message').hide();
						$('.error_message').html(data.reason);
						$('#ajax_loader_zsm').addClass('hidden');
						location.reload();
					}
					else{
						$('#ajax_loader_zsm').addClass('hidden');
						$('.success_message').hide();
						$('.error_message').show();
						$('.error_message').html(data.reason);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('#ajax_loader_zsm').addClass('hidden');
			$('.success_message').hide();
			$('.error_message').show();
			$('.error_message').html(validate);
		}
		setTimeout(function(){
			$('.success_message').html('');
			$('.error_message').hide();
		}, 3000);

	});

	//SM submit AJAX Function
	$('#sm_submit').click(function(){
		$('#ajax_loader_sm').removeClass('hidden');
		var division_id = $( "#sm_division_id option:selected" ).val();
		var sm_fname = $('#sm_fname').val();
		var sm_lname = $('#sm_lname').val();
		var sm_hr = $('#sm_hr').val();
		var sm_acc = $('#sm_acc').val();
		var sm_hcontact = $('#sm_hcontact').val();
		var sm_pcontact = $('#sm_pcontact').val();
		var sm_wcontact = $('#sm_wcontact').val();
		var sm_email = $('#sm_email').val();
		var sm_imei = $('#sm_imei').val();
		var sm_uid = $('#sm_uid').val();
		var sm_password = $('#sm_password').val();
		var user_role = $('#sm_role').val();
		var smUid = $('#smUid').val();

		var validate ='';

		if(division_id.trim() === ''){
			validate = validate+'Select division<br>';
		}
		
		if(sm_fname.trim() === ''){
			validate = validate+'First name required<br>';
		}
		if(sm_lname.trim() === ''){
			validate = validate+'Last name required<br>';
		}
		if(sm_hr.trim() === ''){
			validate = validate+'Home contact required<br>';
		}
		if(sm_acc.trim() === ''){
			validate = validate+'Account contact required<br>';
		}
		if(sm_hcontact.trim() === ''){
			validate = validate+'Home contact required<br>';
		}
		if(sm_pcontact.trim() === ''){
			validate = validate+'Personal contact required<br>';
		}
		if(sm_wcontact.trim() === ''){
			validate = validate+'Work contact required<br>';
		}
		/*if(sm_email.trim() === ''){
			validate = validate+'Email required<br>';
		}*/
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		if (sm_email.trim() !='' && !emailRegex.test(sm_email)) {
			validate = validate+'Email is invalid<br>';
		}
		/*if(sm_imei === ''){
			validate = validate+'Active imei required<br>';
		}*/
		if(sm_uid.trim() === ''){
			validate = validate+'User id required<br>';
		}
		if($('#smUid').val() ==0 && sm_password === ''){
			validate = validate+'Password required<br>';
		}


		if(validate==''){
			var dataString = {
				_token: "{{ csrf_token() }}",
				email : sm_email,
				division_id:division_id,
				zone_id:0,
				region_id:0,
				area_id:0,
				territory_id:0,
				first_name:sm_fname,
				last_name:sm_lname,
				hr_port:sm_hr,
				account_port:sm_acc,
				home_contact:sm_hcontact,
				personal_contact:sm_pcontact,
				work_contact:sm_wcontact,
				user_id:sm_uid,
				active_imei:sm_imei,
				password:sm_password,
				user_role : user_role,
				uid:smUid
			};

			if(smUid == 0){
				var url = "{{ url('user/store') }}";
			}else{
				var url = "{{ url('user/update') }}";
			}

			$.ajax({
				type: "POST",
				url: url,
				data: dataString,
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('.success_message').show();
						$('.error_message').hide();
						$('.error_message').html(data.reason);
						location.reload();
					}
					else{
						$('#ajax_loader_sm').addClass('hidden');
						$('.success_message').hide();
						$('.error_message').show();
						$('.error_message').html(data.reason);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		else{
			$('#ajax_loader_sm').addClass('hidden');
			$('.success_message').hide();
			$('.error_message').show();
			$('.error_message').html(validate);
		}
		setTimeout(function(){
			$('.success_message').html('');
			$('.error_message').hide();
		}, 3000);

	});


</script>


<script>
	$(document).ready(function(){
		var select_val;
		$('#setup_user_type').change(function(){
			select_val = $(this).val();
			$('.user-forms-item').addClass('hidden');
			$('#Create'+select_val).removeClass('hidden');

			$('.division_id').val('');
			$('.zone_id').html('<option value="">Select Zone</option>');
			$('.region_id').html('<option value="">Select Region</option>');
			$('.area_id').html('<option value="">Select Area</option>');
			$('.territory_id').html('<option value="">Select Territory</option>');
			//$('.user-forms-item').addClass('hidden');
		});

		$('#add_new_user_btn').click(function(){
			$('#add_new_user').find('.modal-title').text('Add User');
			//$('.user-forms-item').addClass('hidden');

		});
	});

	// $(document).on('click','.edit_user',function(){
	// 	var edit_user_type = $(this).parents('tr').children('.user_type_td').val();
	// 	$('#add_new_user').find('.modal-title').text('Edit User');
	// 	$('.user-forms-item').addClass('hidden');
	// 	$('#Create'+edit_user_type).removeClass('hidden');
	// });

	//User edit modal from here
	function userEdit(a,b){
		$.ajax({
			type: "POST",
			url: "{{ url('user/edit/') }}",
			data: { _token: "{{ csrf_token() }}",role:b,id:a},
			dataType: "json",
			cache : false,
			success: function(data){console.log(data);
				if(data.status == 200){
					$('#typeArea').hide();
					if(b==5){
						$('#parent_id').val(data.users.parent_id);
						$('#first_name').val(data.users.first_name);
						$('#last_name').val(data.users.last_name);
						$('#hr_port').val(data.users.hr_port);
						$('#account_port').val(data.users.account_port);
						$('#home_contact').val(data.users.home_contact);
						$('#personal_contact').val(data.users.personal_contact);
						$('#work_contact').val(data.users.work_contact);
						$('#email').val(data.users.email);
						$('#active_imei').val(data.users.active_imei);
						$('#user_id').val(data.users.user_id);
						$('#mpo_pass').remove();
						$('#mpo_submit').html('Update');
						$('#uid').val(data.users.id);

						// Setup location
						set_zone(data.users.division_id,data.users.zone_id);
						set_region(data.users.zone_id,data.users.region_id);
						set_area(data.users.region_id,data.users.area_id);
						set_territory(data.users.area_id,data.users.territory_id);
						$('.division_id').val(data.users.division_id);
					}

					if(b==4){
						$('#rsm_id').val(data.users.parent_id);
						$('#am_fname').val(data.users.first_name);
						$('#am_lname').val(data.users.last_name);
						$('#am_hr_port').val(data.users.hr_port);
						$('#am_acc_port').val(data.users.account_port);
						$('#am_hcontact').val(data.users.home_contact);
						$('#am_pcontact').val(data.users.personal_contact);
						$('#am_wcontact').val(data.users.work_contact);
						$('#am_email').val(data.users.email);
						$('#am_imei').val(data.users.active_imei);
						$('#am_uid').val(data.users.user_id);
						$('#am_pass').remove();
						$('#am_submit').html('Update');
						$('#amUid').val(data.users.id);

						// Setup location
						set_zone(data.users.division_id,data.users.zone_id);
						set_region(data.users.zone_id,data.users.region_id);
						set_area(data.users.region_id,data.users.area_id);
						$('.division_id').val(data.users.division_id);
					}

					if(b==3){
						$('#zsm_id').val(data.users.parent_id);
						$('#rsm_fname').val(data.users.first_name);
						$('#rsm_lname').val(data.users.last_name);
						$('#rsm_hr').val(data.users.hr_port);
						$('#rsm_acc').val(data.users.account_port);
						$('#rsm_hcontact').val(data.users.home_contact);
						$('#rsm_pcontact').val(data.users.personal_contact);
						$('#rsm_wcontact').val(data.users.work_contact);
						$('#rsm_email').val(data.users.email);
						$('#rsm_imei').val(data.users.active_imei);
						$('#rsm_uid').val(data.users.user_id);
						$('#rsm_pass').remove();
						$('#rsm_submit').html('Update');
						$('#rsmUid').val(data.users.id);

						// Setup location
						set_zone(data.users.division_id,data.users.zone_id);
						set_region(data.users.zone_id,data.users.region_id);
						$('.division_id').val(data.users.division_id);
					}

					if(b==2){
						$('#sm_id').val(data.users.parent_id);
						$('#zone_id').val(data.users.location_id);
						$('#zsm_fname').val(data.users.first_name);
						$('#zsm_lname').val(data.users.last_name);
						$('#zsm_hr').val(data.users.hr_port);
						$('#zsm_acc').val(data.users.account_port);
						$('#zsm_hcontact').val(data.users.home_contact);
						$('#zsm_pcontact').val(data.users.personal_contact);
						$('#zsm_wcontact').val(data.users.work_contact);
						$('#zsm_email').val(data.users.email);
						$('#zsm_imei').val(data.users.active_imei);
						$('#zsm_uid').val(data.users.user_id);
						$('#zsm_pass').remove();
						$('#zsm_submit').html('Update');
						$('#zsmUid').val(data.users.id);

						// Setup location
						set_zone(data.users.division_id,data.users.zone_id);
						$('.division_id').val(data.users.division_id);
					}

					if(b==1){
						$('#sm_fname').val(data.users.first_name);
						$('#sm_lname').val(data.users.last_name);
						$('#sm_hr').val(data.users.hr_port);
						$('#sm_acc').val(data.users.account_port);
						$('#sm_hcontact').val(data.users.home_contact);
						$('#sm_pcontact').val(data.users.personal_contact);
						$('#sm_wcontact').val(data.users.work_contact);
						$('#sm_email').val(data.users.email);
						$('#sm_imei').val(data.users.active_imei);
						$('#sm_uid').val(data.users.user_id);
						$('#sm_pass').remove();
						$('#sm_submit').html('Update');
						$('#smUid').val(data.users.id);

						// Setup location
						$('.division_id').val(data.users.division_id);
					}

				}
				else{
					//$('.alert-success').removeClass('hidden');
					//$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});

		$('#add_new_user').find('.modal-title').text('Edit User');
		$('.user-forms-item').addClass('hidden');
		$('#Create'+b).removeClass('hidden');
		$('.form-control').addClass('edited');
		$('.help-block').css('opacity','0');
	}

	$('.chcek-validation').keyup(function(){
		if($(this).length != ''){
			$(this).parents('.form-group').children('.help-block').removeClass('invalid');
		}
	});

	//Delete modal open
	function changeStatus(id,status){
		$('#confirm_status').text('Are you sure you want to make this user '+status+'?');
		$('#changeStatus').modal('show');
		$("#delUser").attr('data-del',id);
		$("#delUser").attr('data-status',status);
	}
	//User Delete ajax modal opem
	$(document).on('click','#delUser',function(){
		var id = $("#delUser").attr('data-del');
		var status = $("#delUser").attr('data-status');
		$.ajax({
			type: "POST",
			url: "{{ url('user/change_status/') }}",
			data: { _token: "{{ csrf_token() }}",id:id,status:status},
			dataType: "json",
			cache : false,
			success: function(data){
				console.log(data);
				if(data.status == 200){
					$('#status_warning').removeClass('hidden');
					$('#status_warning').html(data.reason);
					//$('#user'+a).remove();
					location.reload();
				}
				else{
					$('#status_warning').removeClass('hidden');
					$('#status_warning').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	});

	//Lock modal opem
	function UserLock(a,b){
		$('#confirm_sms').text('Are you sure you want to '+b+' this user?');
		$('#lockUnlock').modal('show');
		$("#lockUser").attr('data-del',a);
		$("#lockUser").attr('data-lock',b);
	}
	//User lock ajax modal opem
	$(document).on('click','#lockUser',function(){
		var a = $("#lockUser").attr('data-del');
		var b = $("#lockUser").attr('data-lock');
		$.ajax({
			type: "POST",
			url: "{{ url('user/lock/') }}",
			data: { _token: "{{ csrf_token() }}",flag:b,id:a},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
					location.reload();

					//$('#user'+a).find('.btn-warning').text('Unlock');
				}
				else{
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	});

	$(document).on('change','.division_id', function(){
		var division_id = $(this).val();
		set_zone(division_id,'');
	});

	$(document).on('change','.zone_id', function(){
		var zone_id = $(this).val();
		set_region(zone_id,'')
	});

	$(document).on('change','.region_id', function(){
		var region_id = $(this).val();
		set_area(region_id,'');
	});

	$(document).on('change','.area_id', function(){
		var area_id = $(this).val();
		set_territory(area_id,'');
	});

	function set_zone(division_id,zone_id){
		$.ajax({
			type: "POST",
			url: "{{ url('zone_by_division') }}",
			data: { _token: "{{ csrf_token() }}",division_id:division_id},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('.zone_id').html(data.options);
					$('.zone_id').val(zone_id);
				}
				else{
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}

	function set_region(zone_id,region_id){
		$.ajax({
			type: "POST",
			url: "{{ url('region_by_zone') }}",
			data: { _token: "{{ csrf_token() }}",zone_id:zone_id},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('.region_id').html(data.options);
					$('.region_id').val(region_id);
				}
				else{
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}

	function set_area(region_id,area_id){
		$.ajax({
			type: "POST",
			url: "{{ url('area_by_region') }}",
			data: { _token: "{{ csrf_token() }}",region_id:region_id},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('.area_id').html(data.options);
					$('.area_id').val(area_id);
				}
				else{
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}

	function set_territory(area_id,territory_id){
		$.ajax({
			type: "POST",
			url: "{{ url('territory_by_area') }}",
			data: { _token: "{{ csrf_token() }}",area_id:area_id},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.status == 200){
					$('.territory_id').html(data.options);
					$('.territory_id').val(territory_id);
				}
				else{
					$('.alert-success').removeClass('hidden');
					$('.alert-success').html(data.reason);
				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}


	$('#add_new_user_btn').click(function(){
		$('.form-control').removeClass('edited');
	});

	$("#add_new_user").on('hidden.bs.modal', function () {
		location.reload();
	});

	//user type
	var user_type = $('#user_type_table').DataTable();
	$('#user_type_select').change(function(){
		var select_val = $(this).val();
		user_type
				.columns(3)
				.search(select_val)
				.draw();
	});

</script>
@endsection