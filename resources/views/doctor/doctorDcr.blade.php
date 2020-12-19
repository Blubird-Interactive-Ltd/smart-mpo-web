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
                <span>Doctor DCR</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Doctor DCR</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
			      			<div class="">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
		                            <li role="presentation" class="active">
		                                <a href="#All" data-toggle="tab">
		                                    All 
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Accept" data-toggle="tab">
		                                    Accept
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Pending" data-toggle="tab">
		                                    Pending
		                                    <span class="badge badge-primary"></span>
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Reject" data-toggle="tab">
		                                    Reject 
		                                </a>
		                            </li>
		                            <li role="presentation">
		                                <a href="#Absence" data-toggle="tab">
		                                    Absence 
		                                </a>
		                            </li>
		                        </ul>

		                        <!-- Tab panes -->
		                        <div class="tab-content">
		                            <div role="tabpanel" class="tab-pane fade in active" id="All">
		                                <div class="">
							        		<select class="form-control edited double_filter_02" id="doctor_all_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">
					                        <button class="btn btn-primary" id="filterAcc" style=" width: 100px; position: absolute; left: 0; margin: 0 auto; z-index: 999; right: -500px">Filter</button>

								            <table class="table table-bordered" id="doctor_all_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_doctorDcrAll">

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Accept">
		                                 <div class="">
							        		<select class="form-control edited double_filter_02" id="doctor_accept_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="doctor_accept_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_doctorDcrAcc">


									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Pending">
		                                <div class="">
											<select class="form-control edited double_filter_02" id="doctor_pending_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="doctor_pending_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_doctorDcrPen">

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Reject">
		                                <div class="">
							        		<select class="form-control edited double_filter_02" id="doctor_reject_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="doctor_reject_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_doctorDcrRej">
		

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Absence">
		                                <div class="">

					                        <input class="form-control datepicker single_filter" placeholder="Filter by Date">

								            <table class="table table-bordered datatable" id="doctor_absence_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_doctorDcrAbs">


									            </tbody>
								            </table>
							          	</div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
	      		</div>
	      	</div>
		</div>
	</div>

	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="RejectModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3>Are you sure want to accept?</h3>
		        	<h3>Are you sure want to reject?</h3>

		        	<div class="form-group m-t-20">
		        		<textarea class="form-control" rows="5" placeholder="Please Enter Reject Reason" id="rejReson"></textarea>
		        		<span style="color:red;" id="err_reson"></span>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-success" data-id="" data-status="" id="rejectDcr">Yes, Continue</button>

		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

		<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="acceptModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">&nbsp;</h4>
		      	</div>
		      	<div class="modal-body text-center">
		        	<h3>Are you sure want to accept?</h3>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" data-id="" data-status="" class="btn btn-success" id="AcceptDcr">Yes, Continue</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
<script type="text/javascript">
//Del product Ajax
function accDcr(a,b){
	$('#acceptModal').modal('show');
    $("#AcceptDcr").attr('data-id',a);
    $("#AcceptDcr").attr('data-status',b);
}

//Del product Ajax
function rejDcr(a,b){
	$('#RejectModal').modal('show');
    $("#rejectDcr").attr('data-id',a);
    $("#rejectDcr").attr('data-status',b);
}

//Accept DCR Sections
$("#rejectDcr").click(function(){
	var id = $("#rejectDcr").attr('data-id');
	var status = $("#rejectDcr").attr('data-status');
	var reson = $("#rejReson").val();
	if(reson.trim() == ''){
		$("#err_reson").html('Please leave a reson!');
		return false;
	}
	var url = '{{ url('/doctor/rejectDoctorDcr') }}';
	var dataString = {
	  _token: "{{ csrf_token() }}",
	  id:id,status:status,reson:reson
	};
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
					getData();
					setTimeout(function() {$('#RejectModal').modal('hide');},2000);
                }

                if(data.status == 401){

                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
 });



//Accept DCR Sections
$("#AcceptDcr").click(function(){
	var a = $("#AcceptDcr").attr('data-id');
	var b = $("#AcceptDcr").attr('data-status');
	var url = '{{ url('/doctor/acceptDoctorDcr') }}';
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
					getData();
					setTimeout(function() {$('#acceptModal').modal('hide');},2000);
                }

                if(data.status == 401){

                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
 });



//Filter Function
$("#filter").click(function(){
   var date = $('#start').val();
   var form = formatDate(start)+' '+'00:00:00';
   var to = formatDate(end)+' '+'23:59:00';
   getData(form,to);

});


// A $( document ).ready() block.
$( document ).ready(function() {
     getData('all','all');	
});

//Get Data Ajax Function
function getData(a,b){
	var url = "{{ url('/doctor/getDoctorDcr') }}";
		var dataString = {
            _token: "{{ csrf_token() }}",
            date:a,
            status:b
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
    			$('#doctor_pending_table').DataTable().destroy();
    			$('#doctor_accept_table').DataTable().destroy();           
                $('#doctor_all_table').DataTable().destroy();
                $('#doctor_reject_table').DataTable().destroy();
                $('#doctor_absence_table').DataTable().destroy();
                
                	var html = '';
                	var html_acc = '';
                	var html_pen = '';
                	var html_rej = '';
                	var html_abs = '';

                	var count = 1;
                	var count_acc =1;
                	var count_pen=1;
                	var count_rej = 1;
                	var count_abs=1;

                	$.each(data.val.dcr, function (index, value) {
                		if(value.first_name !== null){ var first_name = value.first_name}else{ var first_name = ''; }
                		if(value.last_name !== null){ var last_name = value.last_name}else{ var last_name = ''; }
	                	if(value.name !== null){ var name = value.name}else{ var name = ''; }
	                	if(value.reject_reason !== null){ var reject_reason = value.reject_reason}else{ var reject_reason = ''; }
	                	if(value.remark !== null){ var remark = value.remark}else{ var remark = ''; }
	                	if(value.status !== null){ var status = value.status}else{ var status = ''; }
	                	if(value.trrName !== null){ var trrName = value.trrName}else{ var trrName = ''; }
	                	if(value.created_at !== null){ var created_at = value.created_at}else{ var created_at = ''; }

	                	var pro = '';
	                	$.each(value.products, function (index,val){
	                	 pro += value.products[index].name;
	                	});
		

				        html += '<tr>';
				        html += '<td class="text-center">'+count+'</td>';
				        html += '<td class="text-center">'+pro+'</td>';
				        html += '<td class="text-center">'+name+'</td>';
				        html += '<td class="text-center">'+first_name+' '+last_name+'</td>';
				        html += '<td class="text-center">'+trrName+'</td>';
				        html += '<td class="text-center">'+created_at+'</td>';
				        html += '<td class="text-center">'+remark+'</td>';
				        html += '<td class="text-center">'+status+'</td>';
				        html += '<td class="text-center">'+reject_reason+'</td>';

						html += '<td class="text-center">';
						if(status == 'pending'){
						html += '<a href="javascript:;" class="btn btn-sm btn-success" onclick="accDcr('+value.doctor_dcr_id+','+1+')">Accept</a>';

						html += '<a href="javascript:;" class="btn btn-sm btn-danger" onclick="rejDcr('+value.doctor_dcr_id+','+2+')">Reject</a></td>';
						}
						if(status == 'accepted'){
						html += '<a href="javascript:;" class="btn btn-sm btn-danger" onclick="rejDcr('+value.doctor_dcr_id+','+2+')">Reject</a></td>';
						}

						if(status == 'rejected'){
						html += '<a href="javascript:;" class="btn btn-sm btn-success" onclick="accDcr('+value.doctor_dcr_id+','+1+')">Accept</a>';
						}

				        html += '</tr>';
				        count++;

				        if(status === 'accepted'){
				        html_acc += '<tr>';
				        html_acc += '<td class="text-center">'+count_acc+'</td>';
				        html_acc += '<td class="text-center">'+name+'</td>';
				        html_acc += '<td class="text-center">'+name+'</td>';
				        html_acc += '<td class="text-center">'+first_name+' '+last_name+'</td>';
				        html_acc += '<td class="text-center">'+trrName+'</td>';
				        html_acc += '<td class="text-center">'+created_at+'</td>';
				        html_acc += '<td class="text-center">'+remark+'</td>';
				        html_acc += '<td class="text-center">'+status+'</td>';
				        html_acc += '</tr>';
				        count_acc++;
				    	}

				    	if(status === 'pending'){
				        html_pen += '<tr>';
				        html_pen += '<td class="text-center">'+count_pen+'</td>';
				        html_pen += '<td class="text-center">'+name+'</td>';
				        html_pen += '<td class="text-center">'+name+'</td>';
				        html_pen += '<td class="text-center">'+first_name+' '+last_name+'</td>';
				        html_pen += '<td class="text-center">'+trrName+'</td>';
				        html_pen += '<td class="text-center">'+created_at+'</td>';
				        html_pen += '<td class="text-center">'+remark+'</td>';
				        html_pen += '<td class="text-center">'+status+'</td>';
				        html_pen += '<td class="text-center">'+reject_reason+'</td>';

						html_pen += '<td class="text-center">';
						html_pen += '<a href="javascript:;" class="btn btn-sm btn-success" onclick="accDcr('+value.doctor_dcr_id+','+1+')" >Accept</a>';

						html_pen += '<a href="javascript:;" class="btn btn-sm btn-danger" onclick="rejDcr('+value.doctor_dcr_id+','+2+')">Reject</a></td>';
				        html_pen += '</tr>';
				        count_pen++;
				    	}

				    	if(status === 'rejected'){
				        html_rej += '<tr>';
				        html_rej += '<td class="text-center">'+count_rej+'</td>';
				        html_rej += '<td class="text-center">'+name+'</td>';
				        html_rej += '<td class="text-center">'+name+'</td>';
				        html_rej += '<td class="text-center">'+first_name+' '+last_name+'</td>';
				        html_rej += '<td class="text-center">'+trrName+'</td>';
				        html_rej += '<td class="text-center">'+created_at+'</td>';
				        html_rej += '<td class="text-center">'+remark+'</td>';
				        html_rej += '<td class="text-center">'+status+'</td>';
				        html_rej += '<td class="text-center">'+reject_reason+'</td>';
				        html_rej += '</tr>';
				        count_rej++;
				    	} 

				    	if(status === 'absence'){
				        html_abs += '<tr>';
				        html_abs += '<td class="text-center">'+count_abs+'</td>';
				        html_abs += '<td class="text-center">'+first_name+' '+last_name+'</td>';
				        html_abs += '<td class="text-center">'+trrName+'</td>';
				        html_abs += '<td class="text-center">'+created_at+'</td>';
				        html_abs += '</tr>';
				        count_abs++;
				    	} 
				    });

					if (html != ''){ $('#set_doctorDcrAll').html(html); }
					if (html_acc != ''){ $('#set_doctorDcrAcc').html(html_acc); }
					if (html_pen != ''){ $('#set_doctorDcrPen').html(html_pen); }
					if (html_abs != ''){ $('#set_doctorDcrAbs').html(html_abs); }
					if (html_rej != ''){ $('#set_doctorDcrRej').html(html_rej); }
					$('.badge').html(count_pen-1);




					//Datatable Initialize 
				    $('#doctor_all_table').dataTable();
				    $('#doctor_accept_table').dataTable();
				    $('#doctor_pending_table').dataTable();
				    $('#doctor_reject_table').dataTable();
				   if (html_abs != ''){ $('#doctor_absence_table').dataTable(); }
                }
            	   else{
                }
            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
	}
</script>
@endsection