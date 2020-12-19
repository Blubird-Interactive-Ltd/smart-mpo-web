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
                <span>Prescription</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Prescription</span>
				            </div>
				        </div>

						<div id="prescription_loader" style="text-align: center;">
							<img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}">
						</div>

				        <div class="portlet-body Details hidden">
							@if(\App\Utility::userRolePermission(Session::get('role_id'),18))
			      			<div class="">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
		                            <li role="presentation" class="active">
		                                <a href="#home_only_icon_title" data-toggle="tab">
		                                    All
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#profile_only_icon_title" data-toggle="tab">
		                                    Accept
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#messages_only_icon_title" data-toggle="tab">
		                                    Pending
		                                    <span class="badge badge-primary">{{ count($pending_count) }}</span>
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#settings_only_icon_title" data-toggle="tab">
		                                    Reject
		                                </a>
		                            </li>
		                        </ul>

		                        <!-- Tab panes -->
		                        <div class="tab-content">
		                            <div role="tabpanel" class="tab-pane fade in active prescription_tab_list" id="home_only_icon_title">
		                                <div class="">
											<form id="mpo_all_filter_form" method="get" action="{{ url('prescription') }}">
												<select class="selectpicker mpo_search form-control" name="filter_mpo" data-type="all" data-live-search="true" title="Search by MPO">
													<option value="">Select</option>
													<?php foreach($mpos as $mpo){ ?>
														<option value="{{ $mpo->id }}" @if($mpo->id == Session::get('filter_mpo')) selected @endif>{{ $mpo->first_name." ".$mpo->last_name." ".$mpo->territory_name }}</option>
													<?php } ?>
												</select>
											</form>

							        		<select class="form-control edited single_filter three-option-filter-02" id="pres_all_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accepted">Accepted</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Rejected">Rejected</option>
					                        </select>

											<form id="date_filter_form" method="get" action="{{ url('/filter_prescription') }}">
												<input class="form-control three-option-filter-03 datepicker" name="end_date" id="end_date" value="{{ Session::get('end_date') }}" placeholder="Filter by Date(To)">
												<input class="form-control three-option-filter-01 datepicker" name="start_date" id="start_date" value="{{ Session::get('start_date') }}" placeholder="Filter by Date(From)">
												<button class="btn btn-primary" id="filter_by_date">Filter</button>
											</form>

											<div class="form-inline custom-search">
												<form id="accept_search_form" method="post" action="{{ url('search_prescription#home_only_icon_title') }}">
													{{ csrf_field() }}
													<label for="">Search</label>
													<input class="form-control" type="hidden" id="accept_type" name="type" value="all">
													<input class="form-control" type="text" id="all_search_text" name="search_text" value="{{ Session::get('search_string') }}">
													<button class="btn btn-primary" type="submit" id="search_button">Search</button>
												</form>
											</div>

											<div class="clearfix"></div>

								            <table class="table table-bordered" id="pres_al_table" width="100%" cellspacing="0" style="margin-top: 30px;">
								              	<thead>
									                <tr>
									                  <th class="w30">Sl. No.</th>
									                  <th class="w70">Prescription</th>
									                  <th class="text-center">MPO/AM name</th>
									                  <th class="text-center">Territory/Area</th>
									                  <th class="text-center">Doctor Name</th>
									                  <th class="text-center">Product Name</th>
									                  <th class="text-center w40">Honorarium</th>
									                  <th class="text-center">Submit Date</th>
									                  <th class="text-center w40">Status</th>
									                  <th class="w100">Reject Reason</th>
									                  <th class="w120 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody>
													<?php
													$count=1;
													$pending=0;
													foreach($prescriptions as $prescription){
														if($prescription->honorium==1){
															$honorarium = 'Yes';
														}
														else{
															$honorarium = 'No';
														}
														$specialities = \App\models\DoctorSpeciality::where('doctor_id',$prescription->doctor_id)
															->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
															->get();
														$speciality = '';
														foreach($specialities as $key=>$sp){
															$speciality .= $sp->name;
															if($key < count($specialities)-1){
																$speciality .= ', ';
															}
														}
													?>
									                <tr>
									                  	<td>{{ $count }}</td>
									                  	<td class="text-center">
									                  		<a class="multi_img_link @if(count($prescription->images) !=0) multi_img_slide @endif" href="javascript:;" data-id="{{ $prescription->prescription_id }}">
																@if(count($prescription->images) !=0)

																	<?php foreach($prescription->images as $key=>$image){ ?>
																		@if($key==0)
																			<img src="{{'http://202.125.76.60/service/v1/'.$image->image_path }}">
																		@endif
																	<?php } //end foreach ?>

																@else
																	<img src="{{ url('/').'/assets/custom/images/noimage.jpg' }}">
																@endif
									                  		</a>
									                  	</td>
									                  	<td class="text-center">{{ $prescription->first_name." ".$prescription->last_name}} <br> {{"#".$prescription->hr_port }}</td>
									                  	<td class="text-center">{{ $prescription->territory }}</td>
									                  	<td class="text-center">{{ $prescription->doctor_name }}<br> {{ $speciality }}, {{ $prescription->class_name }}</td>
									                  	<td class="text-center">
									                  		<ul class="product_list">
																<?php foreach($prescription->products as $product){
																$productDetail = \App\models\Product::where('product_id',$product->product_id)->first();
																?>
									                  			<li>{{ $productDetail->name }}</li>
																<?php } ?>
									                  		</ul>
									                  	</td>
									                  	<td class="text-center">{{ $honorarium }}</td>
									                  	<td class="text-center">{{ date('m/d/Y',strtotime($prescription->created_at)) }}</td>
									                  	<td class="text-center">
															@if($prescription->status=='pending')
																<p class="font-bold text-warning">{{ 'Pending' }}</p>
															@elseif($prescription->status=='accepted')
																<p class="font-bold text-success">{{ 'Accepted' }}</p>
															@else
																<p class="font-bold text-danger">{{ 'Rejected' }}</p>
															@endif
														</td>
									                  	<td>{{ $prescription->reject_reason }}</td>
									                  	<td class="text-center">
															@if($prescription->status=='pending')

																@if(\App\Utility::userRolePermission(Session::get('role_id'),19))
																<a href="javascript:;" title="Accept" class="btn btn-sm btn-success" onclick="accept_prescription({{ $prescription->prescription_id }})">
																	<i class="fa fa-check" aria-hidden="true"></i>
																</a>
																@endif

																@if(\App\Utility::userRolePermission(Session::get('role_id'),20))
																<a href="javascript:;" title="Reject" class="btn btn-sm btn-danger" onclick="reject_prescription({{ $prescription->prescription_id }})">
																	<i class="fa fa-times" aria-hidden="true"></i>
																</a>
																@endif
															@endif

									                  	</td>
									                </tr>
													<?php $count++;
													} ?>

									            </tbody>
                                                                            </table>

                                                                            <div class="pagination">
                                                                                {{ $prescriptions->appends($_GET)->links() }}
                                                                            </div>

							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="profile_only_icon_title">
										<form id="mpo_accept_filter_form" method="get" action="{{ url('prescription#profile_only_icon_title') }}">
											<select class="selectpicker mpo_search" name="filter_mpo" data-type="accept" data-live-search="true" title="Search by MPO">
												<option value="">Select</option>
												<?php foreach($mpos as $mpo){ ?>
												<option value="{{ $mpo->id }}" @if($mpo->id == Session::get('filter_mpo')) selected @endif>{{ $mpo->first_name." ".$mpo->last_name." ".$mpo->territory_name }}</option>
												<?php } ?>
											</select>
										</form>

										<div class="form-inline custom-search">
											<form id="accept_search_form" method="post" action="{{ url('search_prescription#profile_only_icon_title') }}">
												{{ csrf_field() }}
												<label for="">Search</label>
												<input class="form-control" type="hidden" id="accept_type" name="type" value="accept">
												<input class="form-control" type="text" id="accept_search_text" name="search_text" value="{{ Session::get('search_string') }}">
												<button class="btn btn-primary" type="submit" id="search_button">Search</button>
											</form>
										</div>

										<div class="clearfix"></div>

		                                <table class="table table-bordered m-t-30" id="pres_accept_table" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w40">Sl. No.</th>
								                  <th class="">Prescription Image</th>
								                  <th class="text-center">MPO/AM name</th>
								                  <th class="text-center">Territory/Area</th>
								                  <th class="text-center">Doctor Name</th>
								                  <th class="text-center">Product Name</th>
													<th class="text-center">Honorarium</th>
													<th class="text-center">Submit Date</th>
								                  <th class="text-center">Status</th>
								                </tr>
							              	</thead>
							              	<tbody>
											<?php
											$count=1;
											foreach($prescriptions_accept as $prescription){
												if($prescription->status=='accepted'){
													if($prescription->honorium==1){
														$honorarium = 'Yes';
													}
													else{
														$honorarium = 'No';
													}
													$specialities = \App\models\DoctorSpeciality::where('doctor_id',$prescription->doctor_id)
															->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
															->get();
													$speciality = '';
													foreach($specialities as $key=>$sp){
														$speciality .= $sp->name;
														if($key < count($specialities)-1){
															$speciality .= ', ';
														}
													}
													?>
													<tr>
														<td>{{ $count }}</td>
														<td class="text-center">
															<a class="multi_img_link @if(count($prescription->images) !=0) multi_img_slide @endif" href="javascript:;" data-id="{{ $prescription->prescription_id }}">
																@if(count($prescription->images) !=0)

																	<?php foreach($prescription->images as $key=>$image){ ?>
																	@if($key==0)
																		<img src="{{'http://202.125.76.60/service/v1/'.$image->image_path }}">
																	@endif
																	<?php } //end foreach ?>

																@else
																<img src="{{ url('/').'/assets/custom/images/noimage.jpg' }}">
																@endif
															</a>
														</td>
														<td class="text-center">{{ $prescription->first_name." ".$prescription->last_name }} <br> {{ "#".$prescription->hr_port }}</td>
														<td class="text-center">{{ $prescription->territory }}</td>
														<td class="text-center">{{ $prescription->doctor_name }}<br> {{ $speciality }}, {{ $prescription->class_name }}</td>
														<td class="text-center">
															<ul class="product_list">
																<?php foreach($prescription->products as $product){
																$productDetail = \App\models\Product::where('product_id',$product->product_id)->first();
																?>
																<li>{{ $productDetail->name }}</li>
																<?php } ?>
															</ul>
														</td>
														<td class="text-center">{{ $honorarium }}</td>
														<td class="text-center">{{ date('m/d/Y',strtotime($prescription->created_at)) }}</td>
														<td class="text-center">
															<p class="font-bold text-success">{{ 'Accepted' }}</p>
														</td>
													</tr>
													<?php $count++;
												} // end if
											} //end foreach ?>

								            </tbody>
							            </table>

                                                                            <div class="pagination">
                                                                                {{ $prescriptions_accept->fragment('profile_only_icon_title')->appends($_GET)->links() }}
                                                                            </div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="messages_only_icon_title">
										<form id="mpo_pending_filter_form" method="get" action="{{ url('prescription#messages_only_icon_title') }}">
											<select class="selectpicker mpo_search" name="filter_mpo" data-type="pending" data-live-search="true" title="Search by MPO">
												<option value="">Select</option>
												<?php foreach($mpos as $mpo){ ?>
												<option value="{{ $mpo->id }}" @if($mpo->id == Session::get('filter_mpo')) selected @endif>{{ $mpo->first_name." ".$mpo->last_name." ".$mpo->territory_name }}</option>
												<?php } ?>
											</select>
										</form>

										<div class="form-inline custom-search">
											<form id="accept_search_form" method="post" action="{{ url('search_prescription#messages_only_icon_title') }}">
												{{ csrf_field() }}
												<label for="">Search</label>
												<input class="form-control" type="hidden" id="accept_type" name="type" value="pending">
												<input class="form-control" type="text" id="pending_search_text" name="search_text" value="{{ Session::get('search_string') }}">
												<button class="btn btn-primary" type="submit" id="search_button">Search</button>
											</form>
										</div>

										<div class="clearfix"></div>

		                                <table class="table table-bordered m-t-30" id="pres_pending_table" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w30">Sl. No.</th>
								                  <th class="">Prescription</th>
								                  <th class="text-center">MPO/AM name</th>
								                  <th class="text-center">Territory/Area</th>
								                  <th class="text-center">Doctor Name</th>
								                  <th class="text-center">Product Name</th>
													<th class="text-center">Honorarium</th>
								                  <th class="text-center">Submit Date</th>
								                  <th class="text-center w70">Status</th>
								                  <th class="text-center w120">Action</th>
								                </tr>
							              	</thead>
							              	<tbody>
											<?php
											$count=1;
											foreach($prescriptions_pending as $prescription){
												if($prescription->status=='pending'){
													if($prescription->honorium==1){
														$honorarium = 'Yes';
													}
													else{
														$honorarium = 'No';
													}
													$specialities = \App\models\DoctorSpeciality::where('doctor_id',$prescription->doctor_id)
															->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
															->get();
													$speciality = '';
													foreach($specialities as $key=>$sp){
														$speciality .= $sp->name;
														if($key < count($specialities)-1){
															$speciality .= ', ';
														}
													}
													?>
													<tr>
														<td>{{ $count }}</td>
														<td class="text-center">
															<a class="multi_img_link @if(count($prescription->images) !=0) multi_img_slide @endif" href="javascript:;" data-id="{{ $prescription->prescription_id }}">
																@if(count($prescription->images) !=0)

																	<?php foreach($prescription->images as $key=>$image){ ?>
																	@if($key==0)
																		<img src="{{'http://202.125.76.60/service/v1/'.$image->image_path }}">
																	@endif
																	<?php } //end foreach ?>

																@else
																<img src="{{ url('/').'/assets/custom/images/noimage.jpg' }}">
																@endif
															</a>
														</td>
														<td class="text-center">{{ $prescription->first_name." ".$prescription->last_name }} <br> {{"#".$prescription->hr_port }}</td>
														<td class="text-center">{{ $prescription->territory }}</td>
														<td class="text-center">{{ $prescription->doctor_name }}<br> {{ $speciality }}, {{ $prescription->class_name }}</td>
														<td class="text-center">
															<ul class="product_list">
																<?php foreach($prescription->products as $product){
																$productDetail = \App\models\Product::where('product_id',$product->product_id)->first();
																?>
																<li>{{ $productDetail->name }}</li>
																<?php } ?>
															</ul>
														</td>
														<td class="text-center">{{ $honorarium }}</td>
														<td class="text-center">{{ date('m/d/Y',strtotime($prescription->created_at)) }}</td>
														<td class="text-center">
															@if($prescription->status=='pending')
																<p class="font-bold text-warning">{{ 'Pending' }}</p>
															@elseif($prescription->status=='accepted')
																<p class="font-bold text-success">{{ 'Accepted' }}</p>
															@else
																<p class="font-bold text-danger">{{ 'Rejected' }}</p>
															@endif
														</td>
														<td class="text-center">
															@if(\App\Utility::userRolePermission(Session::get('role_id'),19))
															<a href="javascript:;" title="Accept" class="btn btn-sm btn-success" onclick="accept_prescription({{ $prescription->prescription_id }})">
																<i class="fa fa-check" aria-hidden="true"></i>
															</a>
															@endif

															@if(\App\Utility::userRolePermission(Session::get('role_id'),20))
															<a href="javascript:;" title="Reject" class="btn btn-sm btn-danger" onclick="reject_prescription({{ $prescription->prescription_id }})">
																<i class="fa fa-times" aria-hidden="true"></i>
															</a>
															@endif
														</td>
													</tr>
													<?php $count++;
												} // end if
											} //end foreach ?>

								            </tbody>
							            </table>

                                                                            <div class="pagination">
                                                                                {{ $prescriptions_pending->fragment('messages_only_icon_title')->links() }}
                                                                            </div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="settings_only_icon_title">
										<form id="mpo_reject_filter_form" method="get" action="{{ url('prescription#settings_only_icon_title') }}">
											<select class="selectpicker mpo_search" name="filter_mpo" data-type="reject" data-live-search="true" title="Search by MPO">
												<option value="">Select</option>
												<?php foreach($mpos as $mpo){ ?>
												<option value="{{ $mpo->id }}" @if($mpo->id == Session::get('filter_mpo')) selected @endif>{{ $mpo->first_name." ".$mpo->last_name." ".$mpo->territory_name }}</option>
												<?php } ?>
											</select>
										</form>

										<div class="form-inline custom-search">
											<form id="accept_search_form" method="post" action="{{ url('search_prescription#settings_only_icon_title') }}">
												{{ csrf_field() }}
												<label for="">Search</label>
												<input class="form-control" type="hidden" id="accept_type" name="type" value="reject">
												<input class="form-control" type="text" id="reject_search_text" name="search_text" value="{{ Session::get('search_string') }}">
												<button class="btn btn-primary" type="submit" id="search_button">Search</button>
											</form>
										</div>

										<div class="clearfix"></div>

		                                <table class="table table-bordered m-t-30" id="pres_reject_table" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w30">Sl. No.</th>
								                  <th class="w70">Prescription</th>
								                  <th class="text-center">MPO/AM name</th>
								                  <th class="text-center">Territory/Area</th>
								                  <th class="text-center">Doctor Name</th>
								                  <th class="text-center">Product Name</th>
													<th class="text-center">Honorarium</th>
								                  <th class="text-center">Submit Date</th>
								                  <th class="text-center">Status</th>
								                  <th class="w100">Reject reason</th>
								                </tr>
							              	</thead>
							              	<tbody>
											<?php
											$count=1;
											foreach($prescriptions_reject as $prescription){
												if($prescription->status=='rejected'){
													if($prescription->honorium==1){
														$honorarium = 'Yes';
													}
													else{
														$honorarium = 'No';
													}
													$specialities = \App\models\DoctorSpeciality::where('doctor_id',$prescription->doctor_id)
															->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
															->get();
													$speciality = '';
													foreach($specialities as $key=>$sp){
														$speciality .= $sp->name;
														if($key < count($specialities)-1){
															$speciality .= ', ';
														}
													}
													?>
													<tr>
														<td>{{ $count }}</td>
														<td class="text-center">
															<a class="multi_img_link @if(count($prescription->images) !=0) multi_img_slide @endif" href="javascript:;" data-id="{{ $prescription->prescription_id }}">
																@if(count($prescription->images) !=0)

																	<?php foreach($prescription->images as $key=>$image){ ?>
																	@if($key==0)
																		<img src="{{'http://202.125.76.60/service/v1/'.$image->image_path }}">
																	@endif
																	<?php } //end foreach ?>

																@else
																<img src="{{ url('/').'/assets/custom/images/noimage.jpg' }}">
																@endif
															</a>
														</td>
														<td class="text-center">{{ $prescription->first_name." ".$prescription->last_name }} <br> {{  "#".$prescription->hr_port }}</td>
														<td class="text-center">{{ $prescription->territory }}</td>
														<td class="text-center">{{ $prescription->doctor_name }}<br> {{ $speciality }}, {{ $prescription->class_name }}</td>
														<td class="text-center">
															<ul class="product_list">
																<?php foreach($prescription->products as $product){
																$productDetail = \App\models\Product::where('product_id',$product->product_id)->first();
																?>
																<li>{{ $productDetail->name }}</li>
																<?php } ?>
															</ul>
														</td>
														<td class="text-center">{{ $honorarium }}</td>
														<td class="text-center">{{ date('m/d/Y',strtotime($prescription->created_at)) }}</td>
														<td class="text-center">
															<p class="font-bold text-danger">{{ 'Rejected' }}</p>
														</td>
														<td>{{ $prescription->reject_reason }}</td>
													</tr>
													<?php $count++;
												} //end if
											} // end foreach ?>
								            </tbody>
							            </table>

                                                                            <div class="pagination">
                                                                                {{ $prescriptions_reject->fragment('settings_only_icon_title')->links() }}
                                                                            </div>
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

	<!-- Accept /reject modal START-->
	<!-- Accept Modal -->
	<div id="acceptRejectModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
					<!-- Alert Massage Section -->
					<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
					<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
					<!-- Alert Massage Section -->

		        	<h3 id="accept_text">Are you sure want to accept?</h3>
		        	<h3 id="reject_text">Are you sure want to reject?</h3>

		        	<div class="form-group m-t-20">
						<input type="hidden" name="prescription_id" id="prescription_id" value="">
		        		<textarea class="form-control" id="reject_reason" name="reject_reason" rows="5" placeholder="Please Enter Reject Reason"></textarea>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-success" id="accept_button">Yes, Continue</button>
		        	<button type="button" class="btn btn-success" id="reject_button">Submit</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->


	<!-- Image modal START-->
	<div id="multi_img_modal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Prescriptions</h4>
		      	</div>
		      	<div class="modal-body text-center">

					<div id="prescription-carousel" class="carousel slide">
					    <!-- Indicators -->
					    <ol class="carousel-indicators">

					    </ol>

					    <!-- Wrapper for slides -->
					    <div class="carousel-inner">

					    </div>

					    <!-- Left and right controls -->
					    <a class="left carousel-control" id="prev_button" href="#prescription-carousel" data-slide="prev">
					      <span class="glyphicon glyphicon-chevron-left"></span>
					      <span class="sr-only">Previous</span>
					    </a>
					    <a class="right carousel-control" id="next_button" href="#prescription-carousel" data-slide="next">
					      <span class="glyphicon glyphicon-chevron-right"></span>
					      <span class="sr-only">Next</span>
					    </a>
					</div>

					<!--img src="http://202.125.76.60/service/v1//uploads/prescriptions/pr1.png" alt="Los Angeles" style="width:100%;"-->
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
    <script>
		$(document).ready(function(){
		    setTimeout(function(){
                $('#prescription_loader').addClass('hidden');
                $('.portlet-body').removeClass('hidden');
			},3000);
		})
		//Datatable Initialize

		var all_list = $('#pres_al_table').DataTable({
			"paging": false,
			"lengthChange": false
		});
		$('#pres_al_table_filter').hide();
		$('#pres_all_sort').change(function(){
			var select_val = $(this).val();
			all_list
					.columns(8)
					.search(select_val)
					.draw();
		});

		var accept_list = $('#pres_accept_table').DataTable({
			"paging": false,
			"lengthChange": false
		});
		$('#pres_accept_table_filter').hide();

		var pending_list = $('#pres_pending_table').DataTable({
			"paging": false,
			"lengthChange": false
		});
		$('#pres_pending_table_filter').hide();

		var reject_list = $('#pres_reject_table').DataTable({
			"paging": false,
			"lengthChange": false
		});
		$('#pres_reject_table_filter').hide();

    	$(document).on('click','.multi_img_slide',function(){
    		var id=$(this).attr('data-id');
			var url = "{{ url('/prescription/get_images') }}";

			$.ajax({
				type: "POST",
				url: url,
				data: {prescription_id:id,_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						var indicator = '';
						var html = '';
						var slide=0;
						var count = 1;
						var status='active';
						$.each(data.images, function (index, value) {
							if(count!=1){
								status = '';
							}
							var src = "http://202.125.76.60/service/v1/"+value.image_path;

							indicator += '<li data-target="#prescription-carousel" data-slide-to="'+slide+'" class="'+status+'">'+count+'</li>';

							html += '<div class="item '+status+'">';
							html += '<img src="'+src+'" alt="Los Angeles" style="width:100%;">';
							html += '<h3>'+value.location+'</h3>';
							html += '</div>';
							count++;
							slide++;
						});

						$('.carousel').carousel()

						$('.carousel-indicators').html(indicator);
						$('.carousel-inner').html(html);
						if(count>2){
							$('#prev_button').show();
							$('#next_button').show();
						}
						else{
							$('#prev_button').hide();
							$('#next_button').hide();
						}

						$('#multi_img_modal').modal('show');
					}
					else{

					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});

    	});

		function accept_prescription(id){
			$('#accept_text').show();
			$('#reject_text').hide();
			$('#reject_reason').hide();
			$('#accept_button').show();
			$('#reject_button').hide();
			$('#prescription_id').val(id);
			$('#acceptRejectModal').modal('show');
		}

		function reject_prescription(id){
			$('#accept_text').hide();
			$('#reject_text').show();
			$('#reject_reason').show();
			$('#accept_button').hide();
			$('#reject_button').show();
			$('#prescription_id').val(id);
			$('#acceptRejectModal').modal('show');
		}

		$(document).on('click','#accept_button',function(){
			var id = $('#prescription_id').val();
			var url = "{{ url('/prescription/change_status') }}";

			$.ajax({
				type: "POST",
				url: url,
				data: {prescription_id:id,status:'accepted',reject_reason:'',_token: "{{ csrf_token() }}"},
				dataType: "json",
				cache : false,
				success: function(data){
					if(data.status == 200){
						$('#success').show();
						$('#error').hide();
						$('#success').html(data.reason);
						location.reload();
					}
					else{
						$('#success').hide();
						$('#error').show();
						$('#success').html(data);
					}

				} ,error: function(xhr, status, error) {
					alert(error);
				},
			});
		})

		$(document).on('click','#reject_button',function(){
			var id = $('#prescription_id').val();
			var reject_reason = $('#reject_reason').val();
			var url = "{{ url('/prescription/change_status') }}";
			var validate = '';

			if(reject_reason.trim()!=''){
				$.ajax({
					type: "POST",
					url: url,
					data: {prescription_id:id,status:'rejected',reject_reason:reject_reason,_token: "{{ csrf_token() }}"},
					dataType: "json",
					cache : false,
					success: function(data){
						if(data.status == 200){
							$('#success').show();
							$('#error').hide();
							$('#success').html(data.reason);
							location.reload();
						}
						else{
							$('#success').hide();
							$('#error').show();
							$('#error').html(data);
						}

					} ,error: function(xhr, status, error) {
						alert(error);
					},
				});
			}
			else{
				$('#success').hide();
				$('#error').show();
				$('#error').html('Reject reason required');
			}

		})

		$(document).on('change','.mpo_search', function(){
			var id = $(this).val();
			var type = $(this).attr('data-type');
			$('#mpo_'+type+'_filter_form').submit();
		})
    </script>
@endsection