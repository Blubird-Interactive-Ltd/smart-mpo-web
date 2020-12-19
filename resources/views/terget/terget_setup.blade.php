@extends('layouts.master')
@section('content')
	<style>
    .ui-datepicker-calendar {
        display: none;
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
                <span> Setup Target</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Setup Target</span>
				            </div>

				            <div class="actions lg-action">
								@if(\App\Utility::userRolePermission(Session::get('role_id'),27))
                                <div class="btn-group btn-group-devided pull-right">
                                    <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#add_new_target"><i class="icon-plus icons"></i> Add New</button>
                                </div>
								@endif
                            </div>
				        </div>

				        <div class="portlet-body Details">

							@if(\App\Utility::userRolePermission(Session::get('role_id'),26))
				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<div class="">
										
				                        <select class="form-control edited three-option-filter-01" id="filter_month">
                                        	<option value="1" @if(date('m') == '1') selected @endif>January</option>
				                            <option value="2" @if(date('m') == '2') selected @endif>February</option>
				                            <option value="3" @if(date('m') == '3') selected @endif >March</option>
				                            <option value="4" @if(date('m') == '4') selected @endif>April</option>
				                            <option value="5" @if(date('m') == '5') selected @endif>May</option>
				                            <option value="6" @if(date('m') == '6') selected @endif >June</option>
				                            <option value="7" @if(date('m') == '7') selected @endif >July</option>
				                            <option value="8" @if(date('m') == '8') selected @endif >August</option>
				                            <option value="9" @if(date('m') == '9') selected @endif >September</option>
				                            <option value="10" @if(date('m') == '10') selected @endif >October</option>
				                            <option value="11" @if(date('m') == '11') selected @endif >Novermber</option>
				                            <option value="12" @if(date('m') == '12') selected @endif >December</option>
				                        </select>

				                        <select class="form-control edited three-option-filter-03" id="territory_select">
				                            <option value="">Filter by Territory</option>
				                            @if(isset($territories))
				                            @foreach($territories as $tr)
                                        	<option value="{{ $tr->name }}">{{ $tr->name }}</option>
											@endforeach
											@endif
				                        </select>

				                        <select class="form-control edited three-option-filter-02" id="filter_year">
                                        	 <option value="2010" @if(date('Y') == '2010') selected @endif >2010</option>
				                            <option value="2011" @if(date('Y') == '2011') selected @endif>2011</option>
				                            <option value="2012" @if(date('Y') == '2012') selected @endif>2012</option>
				                            <option value="2013" @if(date('Y') == '2013') selected @endif>2013</option>
				                            <option value="2014" @if(date('Y') == '2014') selected @endif >2014</option>
				                            <option value="2015" @if(date('Y') == '2015') selected @endif >2015</option>
				                            <option value="2016" @if(date('Y') == '2016') selected @endif >2016</option>
				                            <option value="2017" @if(date('Y') == '2017') selected @endif >2017</option>
				                            <option value="2018" @if(date('Y') == '2018') selected @endif >2018</option>
				                            <option value="2019" @if(date('Y') == '2019') selected @endif >2019</option>
				                            <option value="2020" @if(date('Y') == '2020') selected @endif >2020</option>
				                            <option value="2021" @if(date('Y') == '2021') selected @endif >2021</option>
				                            <option value="2022" @if(date('Y') == '2022') selected @endif >2022</option>
				                        </select>
										
										<div class="table-responsive">
					                        <table class="table table-bordered" id="setup_target_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th class="w70 text-center">MPO Name</th>
									                  <th class="w70">Created by</th>
									                  <th>Territory</th>
									                  <th class="w150 text-center">Prescription Target</th>
									                  <th class="w150 text-center">Doctor Visit Target</th>
									                  <th class="w150 text-center">Order Target</th>
									                  <th class="w150 text-center">Collection Target</th>
									                  <th class="text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_terget_list">

									            </tbody>
								            </table>
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
	<!-- Modal -->
	<div id="add_new_target" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Target</h4>
		      	</div>
		      	<div class="modal-body" id="user-forms">

				<!-- Alert Massage Section -->
				<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
				<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
	      		<!-- Alert Massage Section -->

		        	<div id="CreateAM" class=" user-forms-item">
		        		<form action="" id="terget_form">
		        		{{ csrf_field() }}	

				        	<div class="row">
				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                   <select class="selectpicker form-control show-tick" id="mpo" name="mpo">
	                                        <option value="0">Select</option>
	                                        @if(isset($mpoList))
	                                        @foreach($mpoList as $list)
	                                        <option value="{{ $list->id }}">{{ $list->first_name.' '.$list->last_name }}</option>
	                                        @endforeach
	                                        @endif
	                                    </select>
	                                    <label for="form_control_1">Select MPO<span class="mandatory_field"> *</span></label>
	                                    <span class="help-block">Select MPO...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-3 col-xs-12">
				        			<div class="form-group form-md-line-input">
				                        <select class="form-control chamber_thana" id="month" name="month">
				                            <option value="0">Target Month</option>
				                            <option value="1">January</option>
				                            <option value="2">February</option>
				                            <option value="3">March</option>
				                            <option value="4">April</option>
				                            <option value="5">May</option>
				                            <option value="6">June</option>
				                            <option value="7">July</option>
				                            <option value="8">August</option>
				                            <option value="9">September</option>
				                            <option value="10">October</option>
				                            <option value="11">Novermber</option>
				                            <option value="12">December</option>
				                        </select>
				                    </div>
				        		</div>

				        		<div class="col-sm-3 col-xs-12">
				        			<div class="form-group form-md-line-input">
				                        <select class="form-control chamber_thana" id="year" name="year">
				                            <option value="">Target Year</option>
				                            <option value="2010" @if(date('Y') == '2010') selected @endif >2010</option>
				                            <option value="2011" @if(date('Y') == '2011') selected @endif>2011</option>
				                            <option value="2012" @if(date('Y') == '2012') selected @endif>2012</option>
				                            <option value="2013" @if(date('Y') == '2013') selected @endif>2013</option>
				                            <option value="2014" @if(date('Y') == '2014') selected @endif >2014</option>
				                            <option value="2015" @if(date('Y') == '2015') selected @endif >2015</option>
				                            <option value="2016" @if(date('Y') == '2016') selected @endif >2016</option>
				                            <option value="2017" @if(date('Y') == '2017') selected @endif >2017</option>
				                            <option value="2018" @if(date('Y') == '2018') selected @endif >2018</option>
				                            <option value="2019" @if(date('Y') == '2019') selected @endif >2019</option>
				                            <option value="2020" @if(date('Y') == '2020') selected @endif >2020</option>
				                            <option value="2021" @if(date('Y') == '2021') selected @endif >2021</option>
				                            <option value="2022" @if(date('Y') == '2022') selected @endif >2022</option>
				                        </select>
				                    </div>
				        		</div>
				        	</div>

							<div class="row">
				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="p_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="1"  name="type[]">
				                        <label for="">Prescription Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Prescription Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="d_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="2"  name="type[]">
				                        <label for="">Doctor Visit Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Doctor Visit Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="col_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="3"  name="type[]">
				                        <label for="">Collection Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Collection Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="or_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="4"  name="type[]">
				                        <label for="">Order Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Order Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-12 col-xs-12 text-right">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" class="btn btn-success" id="save_target">Save</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>
		      	</div>
		    </div>

	  	</div>
	</div>

	<div id="edit_target" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Edit Target</h4>
		      	</div>
		      	<div class="modal-body" id="user-forms">

				<!-- Alert Massage Section -->
				<div class="alert alert-success print-error-msg" style="display:none" id="edit_success"></div>
				<div class="alert alert-danger print-error-msg" style="display:none" id="edit_error"><ul></ul></div>
	      		<!-- Alert Massage Section -->

		        	<div id="CreateAM" class=" user-forms-item">
		        		<form action="" id="edit_terget_form">
		        		{{ csrf_field() }}	

				        	<div class="row">
				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input">
	                                   <select class="form-control" id="edit_mpo" name="mpo" disabled>
	                                        <option value="0">Select</option>
	                                        @if(isset($mpoList))
	                                        @foreach($mpoList as $list)
	                                        <option value="{{ $list->id }}">{{ $list->first_name.' '.$list->last_name }}</option>
	                                        @endforeach
	                                        @endif
	                                    </select>
	                                    <label for="form_control_1">Select MPO<span class="mandatory_field"> *</span></label>
	                                    <span class="help-block">Select MPO...</span>
	                                </div>
				        		</div>

				        		<div class="col-sm-3 col-xs-12">
				        			<div class="form-group form-md-line-input">
				                        <select class="form-control chamber_thana" id="edit_month" name="month">
				                            <option value="0">Target Month</option>
				                            <option value="1">January</option>
				                            <option value="2">February</option>
				                            <option value="3">March</option>
				                            <option value="4">April</option>
				                            <option value="5">May</option>
				                            <option value="6">June</option>
				                            <option value="7">July</option>
				                            <option value="8">August</option>
				                            <option value="9">September</option>
				                            <option value="10">October</option>
				                            <option value="11">Novermber</option>
				                            <option value="12">December</option>
				                        </select>
				                    </div>
				        		</div>

				        		<div class="col-sm-3 col-xs-12">
				        			<div class="form-group form-md-line-input">
				                        <select class="form-control chamber_thana" id="edit_year" name="year">
				                            <option value="0">Target Year</option>
				                            <option value="2010" @if(date('Y') == '2010') selected @endif >2010</option>
				                            <option value="2011" @if(date('Y') == '2011') selected @endif>2011</option>
				                            <option value="2012" @if(date('Y') == '2012') selected @endif>2012</option>
				                            <option value="2013" @if(date('Y') == '2013') selected @endif>2013</option>
				                            <option value="2014" @if(date('Y') == '2014') selected @endif >2014</option>
				                            <option value="2015" @if(date('Y') == '2015') selected @endif >2015</option>
				                            <option value="2016" @if(date('Y') == '2016') selected @endif >2016</option>
				                            <option value="2017" @if(date('Y') == '2017') selected @endif >2017</option>
				                            <option value="2018" @if(date('Y') == '2018') selected @endif >2018</option>
				                            <option value="2019" @if(date('Y') == '2019') selected @endif >2019</option>
				                            <option value="2020" @if(date('Y') == '2020') selected @endif >2020</option>
				                            <option value="2021" @if(date('Y') == '2021') selected @endif >2021</option>
				                            <option value="2022" @if(date('Y') == '2022') selected @endif >2022</option>
				                        </select>
				                    </div>
				        		</div>
				        	</div>

							<div class="row">
				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="edit_p_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="1"  name="type[]">
				                        <label for="">Prescription Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Prescription Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="edit_d_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="2"  name="type[]">
				                        <label for="">Doctor Visit Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Doctor Visit Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="edit_col_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="3"  name="type[]">
				                        <label for="">Collection Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Collection Target</span>
				                    </div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12">
				        			<div class="form-group form-md-line-input form-md-floating-label">
				                        <input type="number" class="form-control" id="edit_or_terget" name="terget[]">
				                        <input type="hidden" class="form-control" value="4"  name="type[]">
				                        <label for="">Order Target<span class="mandatory_field"> *</span></label>
				                        <span class="help-block">Enter Order Target</span>
				                    </div>
				        		</div>


								<input type="hidden" name="old_id" id="old_id" value="">
								<input type="hidden" name="old_month" id="old_month" value="">
								<input type="hidden" name="old_year" id="old_year" value="">

				        		<div class="col-sm-12 col-xs-12 text-right">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        					<button type="button" data-id="" data-month="" data-year=""  class="btn btn-success" id="edit_target_mpo">Update</button>
				        		</div>
			        		</div>
		        		</form>
		        	</div>
		      	</div>
		    </div>

	  	</div>
	</div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).on('show.bs.modal','#add_new_target', function () {
	  	$(this).find('.form-control').removeClass('edited');
	});

	$( "#filter_month" ).change(function() {
	  	var month = $(this).val();
		var year = $('#filter_year').val();
	    getData(month,year);
	});

	$( "#filter_year" ).change(function() {
	  	var month = $('#filter_month').val();
		var year = $(this).val();
	    getData(month,year);
	});

	//Save Doctor Ajax
	$("#edit_target_mpo").click(function(){
		var mpo = $('#edit_mpo').val();
		var month = $('#edit_month').val();
		var year = $('#edit_year').val();
		var p_terget = $('#edit_p_terget').val();
		var d_terget = $('#edit_d_terget').val();
		var or_terget = $('#edit_or_terget').val();
		var col_terget = $('#edit_col_terget').val();
		var filter_month = $('#filter_month').val();
		var filter_year = $('#filter_year').val();
		var validate = '';
		if(mpo == 0){
			validate=validate+'Mpo selection is required <br>';
		}
		if(month == 0){
			validate=validate+'Target Month selection is required <br>';
		}
		if(year == 0){
			validate=validate+'Target Year selection is required <br>';
		}
		if(p_terget.trim()==''){
			validate=validate+'Prescription target is required<br>';
		}
		if(d_terget.trim() == ''){
			validate=validate+'Doctor target is required<br>';
		}
		if(or_terget.trim() == ''){
			validate=validate+'Order target  is required<br>';
		}
		if(col_terget.trim() == ''){
			validate=validate+'Collection target is required<br>';
		}

		if(validate==''){
			var url = "{{ url('/target/updateTerget') }}";
			var formData = new FormData($('#edit_terget_form')[0]);
			var url = url;
			$.ajax({
				type: "POST",
				url: url,
				data: formData,
				async: false,
				success: function (data) { console.log(data);
					if(data.status == 200){
						//$('#save_doctor').removeClass('disabled');
						$("#edit_success").show();
						$("#edit_error").hide();
						$("#edit_success").html(data.reason);
						$('#edit_terget_form')[0].reset();
						setTimeout(function() {$('#edit_success').hide(); },3000);
						setTimeout(function() {$('#edit_target').modal('hide');},4000);
						getData(filter_month,filter_year);
					}

					if(data.status == 401){
						$("#edit_success").hide();
						$("#edit_error").show();
						$("#edit_error").html(data.reason);
						setTimeout(function() {$('#error').hide(); },3000);
					}	
				},
				cache: false,
				contentType: false,
				processData: false
			});
		}
		else{
			$("#edit_success").hide();
			$("#edit_error").show();
			$("#edit_error").html(validate);
	        setTimeout(function() {$("#error").hide(); },3000);
		}
		$('#edit_target').animate({ scrollTop: 0 }, 'slow');
	});



	//Save product Ajax
	function editTerget(id,month,year){
	    var url = '{{ url('/target/getEditVal') }}';
		var dataString = {
		  _token: "{{ csrf_token() }}",
		  id:id,month:month,year:year
		};

	    $.ajax({
	        type: "POST",
	        url: url,
	        data: dataString,
	        dataType: "json",
	        cache : false,
	        success: function(data){ console.log(data);
	              if(data.status == 200){
	              	$('#edit_mpo').val(id);
	              	$('#edit_month').val(month);
					$('#edit_year').val(year);
					$('#edit_p_terget').val(data.val[0].unit);
					$('#edit_d_terget').val(data.val[1].unit);
					
					$('#edit_col_terget').val(data.val[2].unit);
					$('#edit_or_terget').val(data.val[3].unit);
					$("#old_id").val(id);
					$("#old_month").val(month);
					$("#old_year").val(year);
	              	$('#edit_target').modal('show');
	            }

	            if(data.status == 401){

	            }


	        } ,error: function(xhr, status, error) {
	            alert(error);
	        },
	    });
	}

	//Save Doctor Ajax
	$("#save_target").click(function(){
		var mpo = $('#mpo').val();
		var month = $('#month').val();
		var year = $('#year').val();
		var p_terget = $('#p_terget').val();
		var d_terget = $('#d_terget').val();
		var or_terget = $('#or_terget').val();
		var col_terget = $('#col_terget').val();
		var filter_month = $('#filter_month').val();
		var filter_year = $('#filter_year').val();
		var validate = '';
		if(mpo == 0){
			validate=validate+'Mpo selection is required <br>';
		}
		if(month == 0){
			validate=validate+'Target Month selection is required <br>';
		}
		if(year == 0){
			validate=validate+'Target Year selection is required <br>';
		}
		if(p_terget.trim()==''){
			validate=validate+'Prescription target is required<br>';
		}
		if(d_terget.trim() == ''){
			validate=validate+'Doctor target is required<br>';
		}
		if(or_terget.trim() == ''){
			validate=validate+'Order target is required<br>';
		}
		if(col_terget.trim() == ''){
			validate=validate+'Collection target is required<br>';
		}

		if(validate==''){
			// if(doctor_id==''){
			// 	var url = "{{ url('/doctor/doctorStore') }}";
			// }
			// else{
			// 	var url = "{{ url('/doctor/doctorUpdate') }}";
			// }

			var url = "{{ url('/target/storeTerget') }}";
			var formData = new FormData($('#terget_form')[0]);
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
						$('#terget_form')[0].reset();
						setTimeout(function() {$('#success').hide(); },3000);
						setTimeout(function() {$('#add_new_target').modal('hide');},4000);
						getData(filter_month,filter_year);
					}

					if(data.status == 401){
						$("#success").hide();
						$("#error").show();
						$("#error").html(data.reason);
						setTimeout(function() {$('#error').hide(); },3000);
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
	        $('#save_target').prop('disabled', false);
	        setTimeout(function() {$("#error").hide(); },3000);
		}
		$('#add_new_target').animate({ scrollTop: 0 }, 'slow');


	});





	// A $( document ).ready() block.
	$( document ).ready(function() {
		var month = $('#filter_month').val();
		var year = $('#filter_year').val();
	    getData(month,year);	
	});

	//Get Data Ajax Function
	function getData(month,year){
		var url = "{{ url('/terget/getTergetList') }}";
			var dataString = {
	            _token: "{{ csrf_token() }}",
	            month:month,year:year
	        };

	        $.ajax({
	            type: "POST",
	            url: url,
	            data: dataString,
	            dataType: "json",
	            cache : false,
	            success: function(data){ //console.log(data);
	                if(data.status == 200){
	                //Datatable destroy function	
	                $('#setup_target_table').DataTable().destroy();

	                	var html = '';
	                	var count = 1;
	                	$.each(data.val, function (index, value) {
	                	if(value.fname !== null){ var fname = value.fname}else{ var fname = ''; }
	                	if(value.lname !== null){ var lname = value.lname}else{ var lname = ''; }
	                	if(value.hr_code !== null){ var hrCode = '#'+value.hr_code}else{ var hrCode = ''; }
	                	if(value.crFname !== null){ var crFname = value.crFname}else{ var crFname = ''; }
	                	if(value.crLname !== null){ var crLname = value.crLname}else{ var crLname = ''; }
	                	if(value.trName !== null){ var trName = value.trName}else{ var trName = ''; }
	                	if(value.user_id !== null){ var uId = value.user_id}else{ var uId = ''; }
	                	if(value.p_target !== null){ var p_target = value.p_target}else{ var p_target = ''; }
	                	if(value.d_target !== null){ var d_target = value.d_target}else{ var d_target = ''; }
	                	if(value.or_target !== null){ var or_target = value.or_target}else{ var or_target = ''; }
	                	if(value.col_target !== null){ var col_target = value.col_target}else{ var col_target = ''; }

					        html += '<tr>';
					        html += '<td>'+count+'</td>';
					        html += '<td><p>'+fname+' '+lname+'</p><span>'+hrCode+'</span></td>';
					        html += '<td><p>'+crFname+' '+crLname+'</p></td>';
					        html += '<td>'+trName+'</td>';
					        html += '<td>'+ p_target +'</td>';
					        html += '<td>'+ d_target +'</td>';
					        html += '<td>'+ or_target +'</td>';
					        html += '<td>'+ col_target +'</td>';
					        html += '<td class="text-center">'

							@if(\App\Utility::userRolePermission(Session::get('role_id'),28))
					        html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editTerget('+value.id+','+month+','+year+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							@endif

					        html += '</td>';
					        html += '</tr>';
					        count++;
					    });
						$('#set_terget_list').html(html);

						//Datatable Initialize 
					    $('#setup_target_table').dataTable();
					    dataFilter();
	                }
	                else{
	                
	                }

	            } ,error: function(xhr, status, error) {
	                alert(error);
	            },
	        });
	}
	</script>

	<script>
	    function dataFilter(){
	    	var doctor_list = $('#setup_target_table').DataTable();
			$('#territory_select').change(function(){
			    var select_val = $(this).val();
				doctor_list
					.columns(3)
					.search(select_val)
					.draw();
			});
	    }

	    /*$('#add_new_user_btn').click(function(){
	    	$('#add_new_target').find('.modal-title').text('Add Target');
	    });*/

	    $(document).on('click','.edit_target',function(){
	    	$('#edit_target').modal('show');
	    });
</script>
@endsection