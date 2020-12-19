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
                <a href="index.html">Home</a>
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
									<form action="">
										<div class="row">
											<div class="col-sm-3">
												<div class="form-group form-md-line-input">
	                                                <select class="form-control" id="role_id" name="role_id">
														<?php foreach($roles as $role){?>
															<option value="{{ $role->role_id }}">{{ $role->name }}</option>
														<?php } ?>
	                                                </select>
	                                                <label for="form_control_1">Select User Type</label>
	                                                <span class="help-block">Select User Type...</span>
	                                            </div>
											</div>
											<div class="col-sm-3">
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
											<div class="col-sm-3">
												<div class="form-group form-md-line-input">
	                                                <select class="form-control" id="sub_feature" name="sub_feature">
	                                                    <option value="">Select Sub Feature</option>
	                                                </select>
	                                                <label for="form_control_1">Select Sub Featuree</label>
	                                                <span class="help-block">Select Sub Feature...</span>
	                                            </div>
											</div>
					                    </div>
										<div>
											<table class="table">
												<thead>
												<tr>
													<th><input type="checkbox" id="check_all" value="1"></th>
													<th>Feature Action</th>
												</tr>
												</thead>
												<tbody id="action_body">

												</tbody>
											</table>
										</div>
					                    <div class="row">
					                    	<div class="col-sm-12 text-right">
					                    		<button type="button" class="btn btn-success">Save changes</button>
					                    	</div>
					                    </div>
				                    </form>
								</div>
				        	</div>

		                </div>
		            </div>
	      		</div>
	      	</div>
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

			$("#check_all").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});

		})(jQuery);
    </script>
@endsection
