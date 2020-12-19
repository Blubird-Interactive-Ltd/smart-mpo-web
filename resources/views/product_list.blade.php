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
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="add_new_product" data-toggle="modal" data-target="#productModal"><i class="icon-plus icons"></i>Add New</button>
                                </div>
   
                            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">

					            <table class="table table-bordered" id="product_list" width="100%" cellspacing="0">
					              	<thead>
						                <tr>
						                  <th class="w70">Sl. No.</th>
						                  <th class="w250">Product name</th>
						                  <th class="text-center">Packet size</th>
						                  <th class="text-center">Price TP</th>
						                  <th class="text-center">Price VAT</th>
						                  <th class="w200 text-center">Action</th>
						                </tr>
					              	</thead>
					              	<tbody>
						                <tr>
						                  	<td>01</td>
						                  	<td>Product 01</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">10</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productEditModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>02</td>
						                  	<td>Product 02</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">120</td>
						                  	<td class="text-center">12</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productEditModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>
						                  	</td>
						                </tr>
						                <tr>
						                  	<td>03</td>
						                  	<td>Product 03</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">120</td>
						                  	<td class="text-center">12</td>
					                  		<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productEditModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>04</td>
						                  	<td>Product 04</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">120</td>
						                  	<td class="text-center">12</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productEditModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
						                  		</a>
						                  	</td>
						                </tr>
						                <tr>
						                  	<td>05</td>
						                  	<td>Product 05</td>
						                  	<td class="text-center">100</td>
						                  	<td class="text-center">170</td>
						                  	<td class="text-center">17</td>
						                  	<td class="text-center">
						                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productEditModal">
						                  			Edit
						                  		</a>

						                  		<a href="javascript:;" class="btn btn-sm btn-danger">
						                  			Inactive
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

	<!-- Product Add Modal -->
	<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Add New Product</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-12 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for="">Product Name</label>
		                        <span class="help-block">Enter Product Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="">
		                        <label for=""> Product Code</label>
		                        <span class="help-block">Enter Product Code...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="">
		                        <label for="">Packet Size</label>
		                        <span class="help-block">Enter Packet Size...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="">
		                        <label for="">Price TP</label>
		                        <span class="help-block">Enter Price TP...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="">
		                        <label for="">Price VAT</label>
		                        <span class="help-block">EnterPrice VAT...</span>
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


	<!-- Product Edit Modal -->
	<div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Edit Product</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-12 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="" value="Product 01">
		                        <label for="">Product Name</label>
		                        <span class="help-block">Enter Product Name...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="" name="" value="#213154">
		                        <label for=""> Product Code</label>
		                        <span class="help-block">Enter Product Code...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="" value="100">
		                        <label for="">Packet Size</label>
		                        <span class="help-block">Enter Packet Size...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="" value="120">
		                        <label for="">Price TP</label>
		                        <span class="help-block">Enter Price TP...</span>
		                    </div>
		        		</div>

		        		<div class="col-sm-6 col-xs-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="number" class="form-control" id="" name="" value="12">
		                        <label for="">Price VAT</label>
		                        <span class="help-block">EnterPrice VAT...</span>
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