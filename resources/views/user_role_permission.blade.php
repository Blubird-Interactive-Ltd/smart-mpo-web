@extends('layouts.master')
@section('content')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<style>
		.feature_items {
			height: 300px;
			overflow-y: auto;
			overflow-x: auto;
			border: 1px solid #dedede;
			box-shadow: 0px 0px 10px 3px #e8e8e8;
			margin: 0 0 30px 0;
			padding: 15px;
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
                <span> Setup User</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">

		@if(\App\Utility::userRolePermission(Session::get('role_id'),34))
	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> User Role Permission</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">

				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<div class="alert alert-success" id="role_success" style="display:none"></div>
									<div class="alert alert-danger" id="role_danger" style="display:none"></div>
									
									<form id="role_permission_form" method="post" action="">
										{{ csrf_field() }}
										<div class="row">
											<div class="col-sm-3">
												<div class="form-group form-md-line-input">

	                                                <select class="form-control" id="role_id" name="role_id">
														<option value="">Select Role</option>
														<?php foreach($roles as $role){?>
															<option value="{{ $role->role_id }}">{{ $role->name }}</option>
														<?php } ?>
	                                                </select>

	                                                <label for="form_control_1">Select User Type</label>
	                                                <span class="help-block">Select User Type...</span>
	                                            </div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-md-line-input">
	                                                <select class="form-control" id="feature" name="feature">
	                                                    <option value="">Select Feature</option>
														<?php foreach($features as $feature){?>
															<option value="{{ $feature->feature_id }}">{{ $feature->feature_name }}</option>
														<?php } ?>
	                                                </select>
	                                                <label for="form_control_1">Select Feature</label>
	                                                <span class="help-block">Select Feature...</span>
	                                            </div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-md-line-input">
	                                                <select class="form-control" id="sub_feature" name="sub_feature">
	                                                    <option value="">Select Sub Feature</option>
	                                                </select>
	                                                <label for="form_control_1">Select Sub Featuree</label>
	                                                <span class="help-block">Select Sub Feature...</span>
	                                            </div>
											</div>

											<!--div class="col-sm-1">
												<button type="button" class="btn btn-primary m-t-20" id="search_button">Search</button>
											</div-->
					                    </div>
										<div>
											<table class="table table-bordered table-stripped">
												<thead>
												<tr>
													<th width="40px"><input type="checkbox" id="check_all" value="1"></th>
													<th>Feature Action</th>
												</tr>
												</thead>
												<tbody id="action_body">

												</tbody>
											</table>
										</div>
					                    <div class="row">
					                    	<div class="col-sm-12 text-right">
					                    		<button type="button" class="btn btn-success" id="save_button">Save changes</button>
					                    	</div>
					                    </div>
				                    </form>
								</div>
				        	</div>

		                </div>
		            </div>
	      		</div>
	      	</div>
		@endif
		</div>
	</div>

@endsection

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <script>
		(function($){
			$(window).on("load",function(){
				$(".feature_items").mCustomScrollbar({
					theme:"dark"
				});
			});

			$(document).on('change','#feature', function(){
				$('#check_all').prop('checked', false);
				var role_id = $('#role_id').val();
				var feature_id = $(this).val();

				var url = "{{ url('get_sub_features') }}";
				$.ajax({
					type: "POST",
					url: url,
					data: {feature_id:feature_id,_token: "{{ csrf_token() }}"},
					dataType: "json",
					cache : false,
					success: function(data){
						if(data.status == 200){
							$('#sub_feature').html(data.options);
							$('#action_body').html('');
						}
						else{
							console.log(data);
						}

					} ,error: function(xhr, status, error) {
						alert(error);
					},
				});
			})

			$(document).on('change','#sub_feature', function(){
				$('#check_all').prop('checked', false);
				var role_id = $('#role_id').val();
				var sub_feature_id = $(this).val();

				var url = "{{ url('get_feature_actions') }}";
				$.ajax({
					type: "POST",
					url: url,
					data: {role_id:role_id,sub_feature_id:sub_feature_id,_token: "{{ csrf_token() }}"},
					dataType: "json",
					cache : false,
					success: function(data){
						if(data.status == 200){
							$('#action_body').html(data.list);
						}
						else{
							console.log(data);
						}

					} ,error: function(xhr, status, error) {
						alert(error);
					},
				});
			})

			$(document).on('change','#role_id', function(){
				$('#check_all').prop('checked', false);
				var role_id = $(this).val();
				var sub_feature_id = $('#sub_feature').val();

				var url = "{{ url('get_feature_actions') }}";
				$.ajax({
					type: "POST",
					url: url,
					data: {role_id:role_id,sub_feature_id:sub_feature_id,_token: "{{ csrf_token() }}"},
					dataType: "json",
					cache : false,
					success: function(data){
						if(data.status == 200){
							$('#action_body').html(data.list);
						}
						else{
							console.log(data);
						}

					} ,error: function(xhr, status, error) {
						alert(error);
					},
				});
			});

			$(document).on('click','#save_button', function(){
				var role_id = $('#role_id').val();
				var feature_id = $('#feature').val();
				var sub_feature_id = $('#sub_feature').val();

				var validate = '';
				if(role_id==''){
					validate = validate+"User type required</br>";
				}
				if(feature_id==''){
					validate = validate+"Feature required</br>";
				}
				if(sub_feature_id==''){
					validate = validate+"Sub feature required</br>";
				}

				/*if ($("#role_permission_form input:checkbox:checked").length > 0)
				{
					// any one is checked
				}
				else
				{
					validate = validate+"Select at least one action";// none is checked
				}*/

				if(validate==''){
					var formData = new FormData($('#role_permission_form')[0]);
					var url = '{{ url('update_role_permission') }}';
					$.ajax({
						type: "POST",
						url: url,
						data: formData,
						async: false,
						success: function (data) {
							if(data.status == 200){
								$('#role_success').show();
								$('#role_danger').hide();
								$('#role_success').html(data.reason);
							}
							else{
								$('#role_success').hide();
								$('#role_danger').show();
								$('#role_danger').html(data.reason);
							}
						},
						cache: false,
						contentType: false,
						processData: false
					});
				}
				else{
					$('#role_success').hide();
					$('#role_danger').show();
					$('#role_danger').html(validate);
				}

				setTimeout(function(){
					$('#role_success').hide();
					$('#role_danger').hide();
					$('#role_success').html('');
					$('#role_danger').html('');
				}, 3000);
			});

			$("#check_all").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});

		})(jQuery);
    </script>
@endsection

