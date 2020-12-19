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
                <span> Massage Template</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Massage Template</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">

							@if(\App\Utility::userRolePermission(Session::get('role_id'),71))
				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<form action="">
										<div class="row">
											<div class="col-sm-3 col-sm-offset-9">
												<div class="form-group form-md-line-input">
	                                                <select class="form-control" name="delivery">
	                                                    <option value="">Select User Type</option>
				                                        <option value="MPO">MPO </option>
				                                        <option value="AM">AM</option>
				                                        <option value="RSM">RSM</option>
				                                        <option value="ZSM">ZSM </option>
				                                        <option value="SM">SM</option>
	                                                </select>
	                                                <!-- <label for="form_control_1">Select User Type</label> -->
	                                                <span class="help-block">Select User Type...</span>
	                                            </div>
											</div>
					                    </div>

					                    <div class="row">
											<div class="col-sm-3">
												<div class="tag-list">
													<p>Select tags to insert...</p>
													<ul>
														<li>
															<a href="javascript:;">[name]</a>
														</li>
														<li>
															<a href="javascript:;">[fastival]</a>
														</li>
														<li>
															<a href="javascript:;">[tag 01]</a>
														</li>
														<li>
															<a href="javascript:;">[tag 02]</a>
														</li>
													</ul>
												</div>
											</div>

											<div class="col-sm-9">
												<div class="form-group form-md-line-input form-md-floating-label">
	                                                <textarea class="form-control" rows="5"></textarea>
	                                                <label for="form_control_1">Enter Your Massage...</label>
	                                            </div>
											</div>
					                    </div>

					                    <div class="row">
					                    	<div class="col-sm-12 text-right">
					                    		<button type="button" class="btn btn-success">Save changes</button>
					                    	</div>
					                    </div>
				                    </form>
								</div>
				        	</div>
							@endif

		                </div>
		            </div>
	      		</div>
	      	</div>
		</div>
	</div>

@endsection

@section('js')
    <script>

    </script>
@endsection