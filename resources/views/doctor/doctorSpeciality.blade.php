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
                <span>Create Doctor Specialty  </span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Doctor Specialty  </span>
				            </div>

				            <div class="actions">
								@if(\App\Utility::userRolePermission(Session::get('role_id'),48))
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#addDoctorSpeciality"><i class="icon-plus icons"></i> Add New</button>
                                </div>
								@endif
                            </div>
				        </div>

				        <div class="portlet-body Details">

				        	<div class="portlet light bordered">
								@if(\App\Utility::userRolePermission(Session::get('role_id'),47))
								<div class="portlet-body">
									<div class="">
				                        <table class="table table-bordered datatable" width="100%" cellspacing="0" id="speciality_list">
							              	<thead>
								                <tr>
								                  <th class="w100">Sl. No.</th>
								                  <th>Specialty</th>
								                  <th class="text-center w250">Action</th>
								                </tr>
							              	</thead>
							              	<tbody id="set_speciality">



								            </tbody>
							            </table>
				                    </div>
								</div>
								@endif
				        	</div>

		                </div>
		            </div>
	      		</div>
	      	</div>
		</div>
	</div>



	<!-- Modal -->
	<div id="addDoctorSpeciality" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Doctor Specialty</h4>
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
		                        <label for=""> Doctor Specialty Name</label>
		                        <span class="help-block">Enter Doctor Specialty Name...</span>
		                    </div>
		        		</div>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" id="saveDoctorSpeciality">Save</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

	<!-- Product Edit Modal -->
	<div class="modal fade" id="DoctorSpecialityEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Edit Doctor Specialty</h4>
		      	</div>
		      	<div class="modal-body">

		      	<!-- Alert Massage Section -->
		  		<div class="alert alert-danger print-error-msg" style="display:none" id="edit_error"><ul></ul></div>
		  		<div class="alert alert-success print-error-msg" style="display:none" id="edit_success"></div>
		  		<!-- Alert Massage Section -->

		        	<div class="col-sm-12">
	        			<div class="form-group form-md-line-input form-md-floating-label">
	                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="Class A">
	                        <label for=""> Doctor Specialty Name</label>
	                        <span class="help-block">Enter Doctor Specialty Name...</span>
	                    </div>
	        		</div>
		      	</div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        <button type="button" data-id="" class="btn btn-success" id="editSpeciality">Save changes</button>
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
		        	<a href="#" data-id="" data-status="" class="btn btn-success" id="delchClass">Yes, Continue</a>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->



@endsection

@section('js')
<script type="text/javascript">
//Del product Ajax
function delDoctorSpeciality(a,b){
	$('#activeInactive').modal('show');
	if(b==1){$("#confirm").html('Are you sure you want to active this doctor specialty?');}
	if(b==2){$("#confirm").html('Are you sure you want to inactive this doctor Specialty?');}
    $("#delchClass").attr('data-id',a);
    $("#delchClass").attr('data-status',b);
}

$("#delchClass").click(function(){
	var a = $("#delchClass").attr('data-id');
	var b = $("#delchClass").attr('data-status');
	var url = '{{ url('/Doctor/delDoctorSpeciality') }}';
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
$("#editSpeciality").click(function(){
	var url = '{{ url('/Doctor/DoctorSpecialityUpdate') }}';
	var name = $('#edit_name').val();
	var id = $("#editSpeciality").attr('data-id');

	if(name.trim() === ''){
		$("#edit_error").css('display','block');
		$("#edit_error").html('The name field is required. ');
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
            success: function(data){
                if(data.status == 200){
					$("#edit_success").css('display','block');
					$("#edit_success").html(data.reason);
					setTimeout(function() {$('#edit_success').hide(); },2000);
					setTimeout(function() {$('#DoctorSpecialityEditModal').modal('hide');},2000);
					getData();
                }

                if(data.status == 404){
					$("#edit_error").css('display','block');
					$("#edit_error").html(data.reason);
					setTimeout(function() {$('#edit_error').hide(); },3000);
                }

                if(data.status == 401){
                	printErrorMsgEdit(data.error);
                }
            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
});

//Save product Ajax
function editDoctorSpeciality(a){
    var url = '{{ url('/DoctorSpeciality/getEditVal') }}';
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
        success: function(data){
              if(data.status == 200){
              	$("#edit_name").val(data.val.name);
              	$('#DoctorSpecialityEditModal').modal('show');
				$("#editSpeciality").attr('data-id',a);
            }

            if(data.status == 401){

            }


        } ,error: function(xhr, status, error) {
            alert(error);
        },
    });
}

//Save product Ajax
$("#saveDoctorSpeciality").click(function(){
	var url = '{{ url('/Doctor/DoctorSpecialityStore') }}';
	var name = $('#name').val();

	if(name.trim() === ''){
		$("#error").css('display','block');
		$("#error").html('The name field is required. ');
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
					setTimeout(function() {$('#addDoctorSpeciality').modal('hide');},2000);
					getData();
                }

                if(data.status == 404){
					$("#error").css('display','block');
					$("#error").html(data.reason);
					setTimeout(function() {$('#error').hide(); },3000);
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
	var url = "{{ url('/Doctor/getDoctorSpeciality') }}";
		var dataString = {
            _token: "{{ csrf_token() }}",
        };

        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
                //Datatable destroy function	
                $('#speciality_list').DataTable().destroy();

                	var html = '';
                	var count = 1;
                	$.each(data.val, function (index, value) {
                	if(value.name !== null){ var name = value.name}else{ var name = ''; }
				        html += '<tr>';
				        html += '<td>'+count+'</td>';
				        html += '<td>'+name+'</td>';
				        html += '<td class="text-center">';

						@if(\App\Utility::userRolePermission(Session::get('role_id'),49))
				        html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editDoctorSpeciality('+value.speciality_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
				        @endif

						@if(\App\Utility::userRolePermission(Session::get('role_id'),50))
						if(value.status == 'active'){
						html += '<a title=" Inactive" href="#" class="btn btn-sm btn-danger" onclick="delDoctorSpeciality('+value.speciality_id+','+2+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
						}else{
						html += '<a title="Active" href="#" class="btn btn-sm btn-success" onclick="delDoctorSpeciality('+value.speciality_id+','+1+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
						}
						@endif

				        html += '</td>';
				        html += '</tr>';
				        count++;
				    });
					$('#set_speciality').html(html);

					//Datatable Initialize 
				    $('#speciality_list').dataTable();
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
	setTimeout(function(){ $('#error').hide(); }, 3000);
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






	<script>
	$( function() {
	var availableTags = [
	  	"Heart",
	  	"Neuro",
	  	"ABC"
	];
	$( "#Specialty, #editSpecialty" ).autocomplete({
	  source: availableTags
	});
	});
	</script>
@endsection