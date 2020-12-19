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
                                <div class="btn-group btn-group-devided">
                                    <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#add_new_sp"><i class="icon-plus icons"></i> Add New</button>
                                </div>
                            </div>
				        </div>

				        <div class="portlet-body Details">

				        	<div class="portlet light bordered">
								<div class="portlet-body">
									<div class="">
				                        <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
							              	<thead>
								                <tr>
								                  <th class="w100">Sl. No.</th>
								                  <th>Specialty</th>
								                  <th class="text-center w250">Action</th>
								                </tr>
							              	</thead>
							              	<tbody>
								                <tr>
								                  	<td>01</td>
								                  	<td>
								                  		<p>Specialty 01 </p>
								                  	</td>
								                  	<td class="text-center">
								                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#spEditModal">
								                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								                  		</a>

								                  		<a href="javascript:;" class="btn btn-sm btn-danger">
								                  			<i class="fa fa-eye" aria-hidden="true"></i>
								                  		</a>
								                  	</td>
								                </tr>
								                
								                <tr>
								                  	<td>02</td>
								                  	<td>
								                  		<p>Specialty 02</p>
								                  	</td>
								                  	<td class="text-center">
								                  		<a href="javascript:;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#spEditModal">
								                  			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								                  		</a>

								                  		<a href="javascript:;" class="btn btn-sm btn-danger">
								                  			<i class="fa fa-eye" aria-hidden="true"></i>
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
		        	<h4 class="modal-title">Add Specialty</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
		        		<div class="col-sm-12">
		        			<div class="form-group form-md-line-input form-md-floating-label">
		                        <input type="text" class="form-control" id="Specialty" name="">
		                        <label for=""> Specialty</label>
		                        <span class="help-block">Enter Specialty...</span>
		                    </div>
		        		</div>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
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
		        	<h4 class="modal-title" id="myModalLabel">Edit Specialty</h4>
		      	</div>
		      	<div class="modal-body">
		        	<div class="col-sm-12">
	        			<div class="form-group form-md-line-input form-md-floating-label">
	                        <input type="text" class="form-control" id="editSpecialty" name="" value="Specialty A">
	                        <label for=""> Specialty</label>
	                        <span class="help-block">Enter Specialty...</span>
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