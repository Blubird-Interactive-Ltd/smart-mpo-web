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
                <span>Chemist Special Day Type</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Chemist Special Day Type</span>
				            </div>

				            <div class="actions">
								@if(\App\Utility::userRolePermission(Session::get('role_id'),60))
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#add_new_sp"><i class="icon-plus icons"></i> Add New</button>
                                </div>
								@endif
                            </div>
				        </div>

				        <div class="portlet-body Details">

							@if(\App\Utility::userRolePermission(Session::get('role_id'),59))
				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<div class="">
				                        <table class="table table-bordered datatable" id="data_list" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w100">Sl. No.</th>
								                  <th>Type</th>
								                  <th class="text-center w250">Action</th>
								                </tr>
							              	</thead>
							              	<tbody id="set_data">

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

	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="add_new_sp" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Special Day Type</h4>
		      	</div>
		      	<div class="modal-body">
				
				<!-- Alert Massage Section -->
	      		<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
	      		<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
	      		<!-- Alert Massage Section -->

		        	<div class="row">
		        		<div class="col-sm-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="name" name="name">
		                        <label for=""> Type</label>
		                        <span class="help-block">Enter Type...</span>
		                    </div>
		        		</div>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" id="save_date_type">Save</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

	<!-- Product Edit Modal -->
	<div class="modal fade" id="spEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Edit Special Day Type</h4>
		      	</div>
		      	<div class="modal-body">

		      	<!-- Alert Massage Section -->
		  		<div class="alert alert-danger print-error-msg" style="display:none" id="edit_error"><ul></ul></div>
		  		<div class="alert alert-success print-error-msg" style="display:none" id="edit_success"></div>
		  		<!-- Alert Massage Section -->

		        	<div class="row">
		        		<div class="col-sm-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="Birth Day">
		                        <label for=""> Type</label>
		                        <span class="help-block">Enter Type...</span>
		                    </div>
		        		</div>
		        	</div>
		      	</div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-success" id="edit_data" data-id="">Save changes</button>
			    </div>
			</div>
	  	</div>
	</div>

		<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="activeInactive" class="modal fade" role="dialog">
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

		        	<h3 id="confirm"></h3>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<a href="#" data-id="" data-status="" class="btn btn-success" id="delData">Yes, Continue</a>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
<script type="text/javascript">

//Del product Ajax
function delData(a,b){
	$('#activeInactive').modal('show');
	if(b==1){$("#confirm").html('Are you sure you want to active this chemist special day type?');}
	if(b==2){$("#confirm").html('Are you sure you want to inactive this chemist special day type?');}
    $("#delData").attr('data-id',a);
    $("#delData").attr('data-status',b);
}

$("#delData").click(function(){
	var a = $("#delData").attr('data-id');
	var b = $("#delData").attr('data-status');
	var url = '{{ url('/delChemistSpecialDayType') }}';
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
					setTimeout(function() {$('#activeInactive').modal('hide');},2000);
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


//Edit product Ajax
$("#edit_data").click(function(){
	var url = '{{ url('/ChemistSpecialDayTypeUpdate') }}';
	var name = $('#edit_name').val();
	var id = $("#edit_data").attr('data-id');

	if(name.trim() === ''){
		$("#edit_error").css('display','block');
		$("#edit_error").html('The type field is required. ');
		setTimeout(function() {$('#edit_error').hide(); },2000);
		return false;
	}
	
	var dataString = {
	  _token: "{{ csrf_token() }}",
	  name:name,id:id
	};
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
					$("#edit_success").css('display','block');
					$("#edit_success").html(data.reason);
					setTimeout(function() {$('#edit_success').hide(); },2000);
					setTimeout(function() {$('#spEditModal').modal('hide');},2000);
					getData();
                }

                if(data.status == 401){
                	printErrorMsgEdit(data.error);
                }
            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
});

//Edit val Ajax
function editData(a){
    var url = '{{ url('/getChemistSpDayEditVal') }}';
	var dataString = {
	  _token: "{{ csrf_token() }}",
	  id:a
	};
    $.ajax({
        type: "POST",
        url: url,
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){ console.log(data);
              if(data.status == 200){
              	$("#edit_name").val(data.val.name);
              	$('#spEditModal').modal('show');
				$("#edit_data").attr('data-id',a);
            }

            if(data.status == 401){

            }


        } ,error: function(xhr, status, error) {
            alert(error);
        },
    });
}

//Save product Ajax
$("#save_date_type").click(function(){
	var url = '{{ url('/ChemistSpecialDayStore') }}';
	var name = $('#name').val();

	if(name.trim() === ''){
		$("#error").css('display','block');
		$("#error").html('The type field is required. ');
		setTimeout(function() {$('#error').hide(); },2000);
		return false;
	}
	
	var dataString = {
	  _token: "{{ csrf_token() }}",
	  name:name
	};
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
					$("#success").css('display','block');
					$("#success").html(data.reason);
					$('#name').val('');
					$('#name').removeClass('edited');
					setTimeout(function() {$('#success').hide(); },2000);
					setTimeout(function() {$('#add_new_sp').modal('hide');},2000);
					getData();
                }

                if(data.status == 401){
                	printErrorMsg(data.error);
                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
});

// A $( document ).ready() block.
$( document ).ready(function() {
     getData();	
});

//Get Data Ajax Function
function getData(){
	var url = "{{ url('/getChemistSpecialDayType') }}";
		var dataString = {
            _token: "{{ csrf_token() }}",
        };

        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){
                if(data.status == 200){
                //Datatable destroy function	
                $('#data_list').DataTable().destroy();

                	var html = '';
                	var count = 1;
                	$.each(data.val, function (index, value) {
                	if(value.name !== null){ var name = value.name}else{ var name = ''; }
				        html += '<tr>';
				        html += '<td>'+count+'</td>';
				        html += '<td>'+name+'</td>';
				        html += '<td class="text-center">';

						@if(\App\Utility::userRolePermission(Session::get('role_id'),61))
				        html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editData('+value.chemist_special_day_type_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
				        @endif

						@if(\App\Utility::userRolePermission(Session::get('role_id'),62))
						if(value.status == 'active'){
						html += '<a title=" Inactive" href="#" class="btn btn-sm btn-danger" onclick="delData('+value.chemist_special_day_type_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
						}else{
						html += '<a title="Active" href="#" class="btn btn-sm btn-success" onclick="delData('+value.chemist_special_day_type_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
						}
						@endif

				        html += '</td>';
				        html += '</tr>';
				        count++;
				    });
					$('#set_data').html(html);
					//Datatable Initialize 
				    $('#data_list').dataTable();
                }
                else{
                
                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
}




//Print error Message JS function
function printErrorMsg (msg) {
	$("#error").find("ul").html('');
	$("#error").css('display','block');
	$.each( msg, function( key, value ) {
		$("#error").find("ul").append('<li>'+value+'</li>');
	});
	setTimeout(function() { $('#error').hide(); }, 3000);
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









</script>
@endsection