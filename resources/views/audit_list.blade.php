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
                <span>Audit List</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Audit List</span>
				            </div>

				            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button type="button" class="btn btn-primary" id="add_new_audit"><i class="icon-plus icons"></i>Add New Audit</button>
                                </div>

                                <div class="form-group hidden" id="audit_type">
			                        <select class="form-control" id="audit_type_select">
			                            <option value="">Select Audit Type</option>
			                            <option value="ASA">ASA</option>
			                            <option value="DISA">DISA</option>
			                            <option value="BSCI">BSCI</option>
			                            <option value="SEDEX">SEDEX</option>
			                            <option value="CMA">CMA</option>
			                            <option value="Structural">ACCORD Structural</option>
			                            <option value="Electrical">ACCORD Electrical</option>
			                            <option value="Fire">ACCORD Fire</option>
			                        </select>
			                    </div>

			                    <div class="btn-group btn-group-devided pull-right m-l-10 hidden" id="cancel_audit">
                                    <a href="javascript:;" class="btn btn-danger">Cancel</a>
                                </div>

                                <div class="btn-group btn-group-devided pull-right hidden" id="add_audit">
                                    <a href="javascript:;" class="btn btn-primary">Add</a>
                                </div>
   
                            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">

		                        <select class="form-control edited" id="select_type">
		                            <option value="" selected="">Filter By</option>
		                            <option value="ASA">ASA</option>
		                            <option value="DISA">DISA</option>
		                            <option value="BSCI">BSCI</option>
		                            <option value="SEDEX">SEDEX</option>
		                            <option value="ACCORD Structural">ACCORD Structural</option>
		                            <option value="ACCORD Electrical">ACCORD Electrical</option>
		                            <option value="ACCORD Fire">ACCORD Fire</option>
		                            <option value="CMA">CMA</option>
		                        </select>

					            <table class="table table-bordered" id="audit_list" width="100%" cellspacing="0">
					              	<thead>
						                <tr>
						                  <th>Sl. No.</th>
						                  <th>Audit Name</th>
						                  <th class="text-center">Audit Type</th>
						                  <th class="text-center">Result</th>
						                  <th class="text-center">Audited by</th>
						                  <th class="text-center">Date Of Audit</th>
						                  <th class="text-center">Action</th>
						                </tr>
					              	</thead>
					              	<tbody>
						                <tr>
						                  	<td>01</td>
						                  	<td>ASA</td>
						                  	<td class="text-center">Initial</td>
						                  	<td class="text-center">A</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/12/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'asa_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>02</td>
						                  	<td>DISA</td>
						                  	<td class="text-center">Followup</td>
						                  	<td class="text-center">B</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/10/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'disa_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>
						                <tr>
						                  	<td>03</td>
						                  	<td>BSCI</td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">C</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/12/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'bsci_details'}}"  class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>04</td>
						                  	<td>SEDEX</td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">D</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/10/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'sedex_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>
						                <tr>
						                  	<td>05</td>
						                  	<td>ACCORD Structural </td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">E</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/12/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'accord_structural_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>06</td>
						                  	<td>ACCORD Electrical</td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">Improvement Needed</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/10/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'accord_electrical_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>
						                <tr>
						                  	<td>07</td>
						                  	<td>ACCORD Fire</td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">Acceptable</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/12/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'accord_fire_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
						                  		</a>
						                  	</td>
						                </tr>

						                <tr>
						                  	<td>08</td>
						                  	<td>CMA</td>
						                  	<td class="text-center">Re-audit</td>
						                  	<td class="text-center">Not acceptable</td>
						                  	<td class="text-center">John Doe</td>
						                  	<td class="text-center">12/10/2017</td>
						                  	<td class="text-center">
						                  		<a href="{{'cma_details'}}" class="btn btn-sm btn-info audit_detalis_link">
						                  			<i class="icon-eye icons"></i>
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

@endsection

@section('js')
    <script>

    </script>
@endsection