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
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="add_new_product" data-toggle="modal" data-target="#addDoctorModal"><i class="icon-plus icons"></i>Add New</button>
                                </div>
   
                            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">
				        		<select class="form-control edited" id="select_specialty">
		                            <option value="" selected="">Filter by Specialty</option>
		                            <option value="Heart">Heart</option>
		                            <option value="Kidney">Kidney</option>
		                        </select>

		                        <select class="form-control edited" id="select_class">
		                            <option value="" selected="">Filter by Class</option>
		                            <option value="Dami Class 01">Dami Class 01</option>
		                            <option value="Dami Class 01">Dami Class 02</option>
		                        </select>

					            <table class="table table-bordered" id="doctor_list" width="100%" cellspacing="0">
					              	<thead>
						                <tr>
						                  <th class="w40">Sl. No.</th>
						                  <th class="w150">Doctor name</th>
						                  <th class="text-center">Gender</th>
						                  <th class="text-center">Contact number</th>
						                  <th class="text-center">Qualification</th>
						                  <th class="text-center w100">Specialty</th>
						                  <th class="text-center w100">Class</th>
						                  <th class="w250 text-center">Action</th>
						                </tr>
					              	</thead>
					              	<tbody>
						                <tr>
						                  	<td>01</td>
						                  	<td>Doctor 01</td>
						                  	<td class="text-center">Male</td>
						                  	<td class="text-center">0195555510</td>
						                  	<td class="text-center">FCPS</td>
						                  	<td class="text-center">Kidney</td>
						                  	<td class="text-center">Dami Class 01</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDoctorModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>

						                  		<a href="{{url('doctor_details')}}" class="btn btn-sm btn-success">
						                  			View
						                  		</a>
						                  	</td>
						                </tr>
						                
						                <tr>
						                  	<td>02</td>
						                  	<td>Doctor 02</td>
						                  	<td class="text-center">Male</td>
						                  	<td class="text-center">0195555510</td>
						                  	<td class="text-center">FCPS</td>
						                  	<td class="text-center">Heart</td>
						                  	<td class="text-center">Dami Class 02</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDoctorModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>
						                  		<a href="{{url('doctor_details')}}" class="btn btn-sm btn-success">
						                  			View
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

	<!-- Add Doctor Modal -->
	<div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Add New Doctor</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Doctor Name</label>
		                        <span class="help-block">Enter Doctor Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="email" class="form-control" id="" name="">
		                        <label for=""> Email</label>
		                        <span class="help-block">Enter Email</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input">
		                        <select class="form-control" id="">
		                            <option>Select Gender</option>
		        					<option value="">Male</option>
		        					<option value="">Female</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Contact number</label>
		                        <span class="help-block">Enter Contact number</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Qualification</label>
		                        <span class="help-block">Enter Qualification</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Specialty</label>
		                        <span class="help-block">Enter Specialty</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Class</label>
		                        <span class="help-block">Enter Class</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="">
		                        <label for="">Doctor special day type</label> <br>
		                        <select class="selectpicker form-control show-tick" multiple>
								  	<option>Marrige Day</option>
								  	<option>Birth Day</option>
								</select>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input">
		                        <input type="text" class="form-control datepicker" id="" name="" placeholder="Enter Date">
		                        <label for="">Doctor special day</label>
		                        <span class="help-block">Enter Doctor special day</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Honorarium</label>
		                        <span class="help-block">Enter Honorarium</span>
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
				        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
				                        <textarea class="form-control h60" rows="3" placeholder="Address Line 1"></textarea>
				                        <span class="help-block">Enter Address Line 1</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
				                        <textarea class="form-control h60" rows="3" placeholder="Address Line 2"></textarea>
				                        <span class="help-block">Enter Address Line 2</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="division" name="">
				                        <label for="">Division</label>
				                        <span class="help-block">Enter Division</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="district" name="">
				                        <label for="">District</label>
				                        <span class="help-block">Enter District</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="thana" name="">
				                        <label for="">Thana</label>
				                        <span class="help-block">Enter Thana</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="ZIP" name="">
				                        <label for="">ZIP</label>
				                        <span class="help-block">Enter ZIP</span>
				                    </div>
				        		</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="clearfix"></div>
					
					<div id="doctor_chember_address">
		        		<div class="portlet light bordered">
		        			<div class="portlet-title">
		        				<div class="caption">Chamber Address</div>
		        				<div class="actions">
	                                <div class="btn-group btn-group-devided">
	                                    <button type="button" class="btn btn-primary add_chember"><i class="icon-plus icons"></i>Add More Chamber Address</button>
	                                </div>
	                            </div>
		        			</div>
		        			<div class="portlet-body">
				        		<div class="row">
					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
					                        <textarea class="form-control h60" rows="3" placeholder="Address Line 1"></textarea>
					                        <span class="help-block">Enter Address Line 1</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
					                        <textarea class="form-control h60" rows="3" placeholder="Address Line 2"></textarea>
					                        <span class="help-block">Enter Address Line 2</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberDivision" name="">
					                        <label for="">Division</label>
					                        <span class="help-block">Enter Division</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberDistrict" name="">
					                        <label for="">District</label>
					                        <span class="help-block">Enter District</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberThana" name="">
					                        <label for="">Thana</label>
					                        <span class="help-block">Enter Thana</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control" id="" name="">
					                        <label for="">ZIP</label>
					                        <span class="help-block">Enter ZIP</span>
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

	<!-- Edit Doctor Modal -->
	<div class="modal fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Doctor Name</label>
		                        <span class="help-block">Enter Doctor Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="email" class="form-control" id="" name="">
		                        <label for=""> Email</label>
		                        <span class="help-block">Enter Email</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input">
		                        <select class="form-control" id="">
		                            <option>Select Gender</option>
		        					<option value="">Male</option>
		        					<option value="">Female</option>
		                        </select>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Contact number</label>
		                        <span class="help-block">Enter Contact number</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Qualification</label>
		                        <span class="help-block">Enter Qualification</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Specialty</label>
		                        <span class="help-block">Enter Specialty</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Class</label>
		                        <span class="help-block">Enter Class</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="">
		                        <label for="">Doctor special day type</label> <br>
		                        <select class="selectpicker form-control show-tick" multiple>
								  	<option>Marrige Day</option>
								  	<option>Birth Day</option>
								</select>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input">
		                        <input type="text" class="form-control datepicker" id="" name="" placeholder="Enter Date">
		                        <label for="">Doctor special day</label>
		                        <span class="help-block">Enter Doctor special day</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-4 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Honorarium</label>
		                        <span class="help-block">Enter Honorarium</span>
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
				        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
				                        <textarea class="form-control h60" rows="3" placeholder="Address Line 1"></textarea>
				                        <span class="help-block">Enter Address Line 1</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
				                        <textarea class="form-control h60" rows="3" placeholder="Address Line 2"></textarea>
				                        <span class="help-block">Enter Address Line 2</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="division" name="">
				                        <label for="">Division</label>
				                        <span class="help-block">Enter Division</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="district" name="">
				                        <label for="">District</label>
				                        <span class="help-block">Enter District</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="thana" name="">
				                        <label for="">Thana</label>
				                        <span class="help-block">Enter Thana</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-4 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="text" class="form-control" id="ZIP" name="">
				                        <label for="">ZIP</label>
				                        <span class="help-block">Enter ZIP</span>
				                    </div>
				        		</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="clearfix"></div>
					
					<div id="">
		        		<div class="portlet light bordered">
		        			<div class="portlet-title">
		        				<div class="caption">Chamber Address</div>
		        				
		        			</div>
		        			<div class="portlet-body">
				        		<div class="row">
					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
					                        <textarea class="form-control h60" rows="3" placeholder="Address Line 1"></textarea>
					                        <span class="help-block">Enter Address Line 1</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label m-t-i26">
					                        <textarea class="form-control h60" rows="3" placeholder="Address Line 2"></textarea>
					                        <span class="help-block">Enter Address Line 2</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberDivision" name="">
					                        <label for="">Division</label>
					                        <span class="help-block">Enter Division</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberDistrict" name="">
					                        <label for="">District</label>
					                        <span class="help-block">Enter District</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control chemberThana" name="">
					                        <label for="">Thana</label>
					                        <span class="help-block">Enter Thana</span>
					                    </div>
					        		</div>

					        		<div class="col-sm-4 col-xs-12">
					        			<div class="form-group form-md-line-input form-md-floating-label">
					                        <input type="text" class="form-control" id="" name="">
					                        <label for="">ZIP</label>
					                        <span class="help-block">Enter ZIP</span>
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

@endsection

@section('js')
    <script>

    </script>
@endsection