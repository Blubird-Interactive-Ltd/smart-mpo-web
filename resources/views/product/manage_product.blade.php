@extends('layouts.master')
@section('content')
	<style>
		#pagination_area .pagination{
			float: right;
			margin-top: -15px;
			z-index: 999;
		}
		#ajax_loader_list {
			position:relative;
			height: 80px;
			width: 80px;
			z-index: 999;
			top: 0;
			left: 0;
			text-align: center;
			padding-top: 35%;
		}
		#ajax_loader_list>img{
			width: 55px !important;
			margin: 20px auto;
			display: block;
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
                <span>Product List</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Product  List</span>
				            </div>

				            <div class="actions">

								@if(\App\Utility::userRolePermission(Session::get('role_id'),6))
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="add_new_product" data-toggle="modal" data-target="#productModal"><i class="icon-plus icons"></i>Add New</button>
                                </div>
								@endif
   
                            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">

								@if(\App\Utility::userRolePermission(Session::get('role_id'),5))
					            <table class="table table-bordered" id="product_list" width="100%" cellspacing="0">
					              	<thead >
						                <tr>
						                  <!--th class="w70">Sl. No.</th-->
						                  <th class="w250">Product name</th>
						                  <th class="text-center">Packet size</th>
						                  <th class="text-center">Price TP</th>
						                  <th class="text-center">Price VAT</th>
						                  <th class="w200 text-center">Action</th>
						                </tr>
					              	</thead>
					              	<tbody id="set_product">
						                
						            </tbody>
							</div>
					            </table>
							<div id="pagination_area">

							</div>
								@endif
				          	</div>
				        </div>
				  	</div>
		  		</div>
	      	</div>
		</div>
	</div>

	<!-- Product Add Modal -->
	<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Add New Product</h4>
		      	</div>
		      	<form action="" id="productAddForm" method="POST">
			      	<div class="modal-body">

			      		<!-- Alert Massage Section -->
			      		<div class="alert alert-danger print-error-msg" style="display:none" id="error"><ul></ul></div>
			      		<div class="alert alert-success print-error-msg" style="display:none" id="success"></div>
			      		<!-- Alert Massage Section -->

			        	<div class="row">
			        		<div class="col-sm-12 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control" id="name" name="name">
			                        <label for="">Product Name</label>
			                        <span class="help-block">Enter Product Name...</span>
			                    </div>
			        		</div>

			        		<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control" id="code" name="code">
			                        <label for=""> Product Code</label>
			                        <span class="help-block">Enter Product Code...</span>
			                    </div>
			        		</div>

			        		<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="text" class="form-control" id="size" name="size">
			                        <label for="">Packet Size</label>
			                        <span class="help-block">Enter Packet Size...</span>
			                    </div>
			        		</div>

			        		<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="number" class="form-control" id="price" name="price">
			                        <label for="">Price TP</label>
			                        <span class="help-block">Enter Price TP...</span>
			                    </div>
			        		</div>

			        		<div class="col-sm-6 col-xs-12">
			        			<div class="form-group form-md-line-input form-md-floating-label">
			                        <input type="number" class="form-control" id="vat" name="vat">
			                        <label for="">Price VAT</label>
			                        <span class="help-block">EnterPrice VAT...</span>
			                    </div>
			        		</div>
			        	</div>
			      	</div>
		      	</form>
			    <div class="modal-footer">
					<span class="hidden" id="ajax_loader"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-success" id="saveProduct">Save data</button>
			    </div>
			</div>
	  	</div>
	</div>


	<!-- Product Edit Modal -->
	<div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">

	  		

		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Edit Product</h4>
		      	</div>
		      	<div class="modal-body">

		      		<!-- Alert Massage Section -->
					<div class="alert alert-success print-error-msg" style="display:none" id="edit_success"></div>
					<div class="alert alert-danger print-error-msg" style="display:none" id="edit_error"><ul></ul></div>
			  		<!-- Alert Massage Section -->
			  		
		        	<div class="row">
		        		<div class="col-sm-12 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="Product1">
		                        <label for="">Product Name</label>
		                        <span class="help-block">Enter Product Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="edit_code" name="edit_code" value="#123
		                        ">
		                        <label for=""> Product Code</label>
		                        <span class="help-block">Enter Product Code...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="edit_size" name="edit_size" value="12">
		                        <label for="">Packet Size</label>
		                        <span class="help-block">Enter Packet Size...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="edit_price" name="edit_price" value="1320">
		                        <label for="">Price TP</label>
		                        <span class="help-block">Enter Price TP...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="edit_vat" name="edit_vat" value="14">
		                        <label for="">Price VAT</label>
		                        <span class="help-block">EnterPrice VAT...</span>
		                    </div>
		        		</div>
		        	</div>
		      	</div>
			    <div class="modal-footer">
					<span class="hidden" id="ajax_loader_edit"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-success" data-id="" id="editPro">Save changes</button>
			    </div>
			</div>
	  	</div>
	</div>


	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="proDelete" class="modal fade" role="dialog">
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
		        	<h3>Are you sure you want to change the status ??</h3>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<a href="#" data-id="" data-status="" class="btn btn-success" id="delpro">Yes, Continue</a>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
<script type="text/javascript">
//Save product Ajax
function editProduct(a){
    var url = '{{ url('/product/getEditVal') }}';
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
                  	$("#edit_code").val(data.val.product_code);
                  	$("#edit_size").val(data.val.packet_size);
                  	$("#edit_price").val(data.val.price_tp);
                  	$("#edit_vat").val(data.val.price_vat);
                  	$('#productEditModal').modal('show');
    				$("#editPro").attr('data-id',a);
                }

                if(data.status == 401){

                }


            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
}

//Edit product Ajax
$("#editPro").click(function(){
	$('#ajax_loader_edit').removeClass('hidden');
	var url = '{{ url('/product/ProductUpdate') }}';
	var name = $('#edit_name').val();
	var code = $('#edit_code').val();
	var size = $('#edit_size').val();
	var price = $('#edit_price').val();
	var vat = $('#edit_vat').val();
	var id = $("#editPro").attr('data-id');

	var validate = '';

	if(name.trim()==''){
		validate = validate+'Name is required<br>';
	}
	if(code.trim()==''){
		validate = validate+'Code is required<br>';
	}
	if(size.trim()==''){
		validate = validate+'Size is required<br>';
	}
	if(price.trim()==''){
		validate = validate+'Price is required<br>';
	}
	if(vat.trim()==''){
		validate = validate+'Vat is required<br>';
	}

	if(validate==''){
		var dataString = {
			_token: "{{ csrf_token() }}",
			name:name,code:code,size:size,price:price,vat:vat,id:id
		};
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){ console.log(data);
				if(data.status == 200){
					$("#edit_success").show();
					$("#edit_error").hide();
					$("#edit_success").html(data.reason);
					$('#ajax_loader_edit').addClass('hidden');
					setTimeout(function() {$('#edit_success').hide(); },2000);
					$('#productAddForm')[0].reset();
					setTimeout(function() {$('#productEditModal').modal('hide');},2000);
					getData();
				}

				if(data.status == 401){
					$('#ajax_loader_edit').addClass('hidden');
					$("#edit_success").hide();
					$("#edit_error").show();
					$("#edit_error").html(data.reason);
				}


			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}
	else{
		$('#ajax_loader_edit').addClass('hidden');
		$("#edit_success").hide();
		$("#edit_error").show();
		$("#edit_error").html(validate);
	}

});




//Del product Ajax
function delProduct(a,b){
	$('#proDelete').modal('show');
    $("#delpro").attr('data-id',a);
    $("#delpro").attr('data-status',b);
}

$("#delpro").click(function(){
	var a = $("#delpro").attr('data-id');
	var b = $("#delpro").attr('data-status');
	var url = '{{ url('/product/ProductDelete') }}';
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
					  $('#productAddForm')[0].reset();
					setTimeout(function() {$('#proDelete').modal('hide');},2000);
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

//Save product Ajax
$("#saveProduct").click(function(){
	$('#ajax_loader').removeClass('hidden');
	var url = '{{ url('/product/ProductStore') }}';
	var name = $('#name').val();
	var code = $('#code').val();
	var size = $('#size').val();
	var price = $('#price').val();
	var vat = $('#vat').val();

	var validate = '';

	if(name.trim()==''){
		validate = validate+'Name is required<br>';
	}
	if(code.trim()==''){
		validate = validate+'Code is required<br>';
	}
	if(size.trim()==''){
		validate = validate+'Size is required<br>';
	}
	if(price.trim()==''){
		validate = validate+'Price is required<br>';
	}
	if(vat.trim()==''){
		validate = validate+'Vat is required<br>';
	}

	if(validate==''){
		var dataString = {
			_token: "{{ csrf_token() }}",
			name:name,code:code,size:size,price:price,vat:vat
		};
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			dataType: "json",
			cache : false,
			success: function(data){ console.log(data);
				if(data.status == 200){
					$("#success").show();
					$("#error").hide();
					$("#success").html(data.reason);
					$('#ajax_loader').addClass('hidden');
					setTimeout(function() {$('#success').hide(); },2000);
					$('#productAddForm')[0].reset();
					setTimeout(function() {$('#productModal').modal('hide');},2000);
					getData();
					//location.reload();
				}

				if(data.status == 401){
					$('#ajax_loader').addClass('hidden');
					$("#success").hide();
					$("#error").show();
					$("#error").html(data.reason);
				}


			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}
	else{
		$('#ajax_loader').addClass('hidden');
		$("#success").hide();
		$("#error").show();
		$("#error").html(validate);
	}
});

// A $( document ).ready() block.
$( document ).ready(function() {
     getData();	
});

//Get Data Ajax Function
function getData(){
	var loader = '<tr>';
	loader += '<td colspan="9"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
	loader += '</tr>';
	$('#set_product').html(loader);

	var url = "{{ url('/product/getProducts') }}";
		var dataString = {
            _token: "{{ csrf_token() }}",
        };

        $.ajax({
            type: "GET",
            url: url,
            data: {},
            dataType: "json",
            cache : false,
            success: function(data){
                if(data.status == 200){
                //Datatable destroy function	
                $('#product_list').DataTable().destroy();

                	var html = '';
                	var count = 1;
                	$.each(data.val.data, function (index, value) {
                		if(value.name !== null){ var name = value.name}else{ var name = ''; }
	                	if(value.packet_size !== null){ var pack = value.packet_size}else{ var pack = ''; }
	                	if(value.price_tp !== null){ var price_tp = value.price_tp}else{ var price_tp = ''; }
	                	if(value.price_vat !== null){ var price_vat = value.price_vat}else{ var price_vat = ''; }

				        html += '<tr>';
				        //html += '<td class="text-center">'+count+'</td>';
				        html += '<td class="text-center">'+name+'</td>';
				        html += '<td class="text-center">'+pack +'</td>';
				        html += '<td class="text-center">'+price_tp+'</i></td>';
				        html += '<td class="text-center">'+price_vat+'</td>';
				        html += '<td class="text-center">';

						@if(\App\Utility::userRolePermission(Session::get('role_id'),7))
				        html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editProduct('+value.product_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
						@endif

						@if(\App\Utility::userRolePermission(Session::get('role_id'),8))
				        if(value.status == 'active'){
						html += '<a title="Inactive" href="#" class="btn btn-sm btn-danger" onclick="delProduct('+value.product_id+','+1+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
						}else{
						html += '<a title="Active" href="#" class="btn btn-sm btn-success" onclick="delProduct('+value.product_id+','+2+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
						}
						@endif

				        html += '</td>';
				        html += '</tr>';
				        count++;
				    });
					$('#set_product').html(html);
					$('#pagination_area').html(data.pagination);

					//Datatable Initialize 
				    $('#product_list').dataTable({
						"paging": false,
						"lengthChange": false
					});
                }
                else{
                
                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
}

$(document).on('click','.pagination>li>a',function(e) {
	e.preventDefault();
	var loader = '<tr>';
	loader += '<td colspan="9"><span class="" id="ajax_loader_list"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span></td>';
	loader += '</tr>';
	$('#set_product').html(loader);

	var url = $(this).attr('href');
	$.ajax({
		type: "GET",
		url: url,
		data: {},
		dataType: "json",
		cache : false,
		success: function(data){
			if(data.status == 200){
				//Datatable destroy function
				$('#product_list').DataTable().destroy();

				var html = '';
				var count = 1;
				$.each(data.val.data, function (index, value) {
					if(value.name !== null){ var name = value.name}else{ var name = ''; }
					if(value.packet_size !== null){ var pack = value.packet_size}else{ var pack = ''; }
					if(value.price_tp !== null){ var price_tp = value.price_tp}else{ var price_tp = ''; }
					if(value.price_vat !== null){ var price_vat = value.price_vat}else{ var price_vat = ''; }

					html += '<tr>';
					//html += '<td class="text-center">'+count+'</td>';
					html += '<td class="text-center">'+name+'</td>';
					html += '<td class="text-center">'+pack +'</td>';
					html += '<td class="text-center">'+price_tp+'</i></td>';
					html += '<td class="text-center">'+price_vat+'</td>';
					html += '<td class="text-center">';

					@if(\App\Utility::userRolePermission(Session::get('role_id'),7))
							html += '<a title="Edit" href="javascript:;" class="btn btn-sm btn-info" onclick="editProduct('+value.product_id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
					@endif

							@if(\App\Utility::userRolePermission(Session::get('role_id'),8))
					if(value.status == 'active'){
						html += '<a title="Inactive" href="#" class="btn btn-sm btn-danger" onclick="delProduct('+value.product_id+','+1+')"><i class="fa fa-ban" aria-hidden="true"></i></a>';
					}else{
						html += '<a title="Active" href="#" class="btn btn-sm btn-success" onclick="delProduct('+value.product_id+','+2+')"><i class="fa fa-flash" aria-hidden="true"></i></a>';
					}
					@endif

							html += '</td>';
					html += '</tr>';
					count++;
				});
				$('#set_product').html(html);
				$('#pagination_area').html(data.pagination);

				//Datatable Initialize
				$('#product_list').dataTable({
					"paging": false,
					"lengthChange": false
				});
			}
			else{

			}

		} ,error: function(xhr, status, error) {
			alert(error);
		},
	});
});


$("#productEditModal").on('hidden.bs.modal', function () {
	location.reload();
});

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