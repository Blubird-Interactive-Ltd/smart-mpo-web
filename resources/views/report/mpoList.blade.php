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
                <span> MPO List</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">

		@if(\App\Utility::userRolePermission(Session::get('role_id'),22))
	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> MPO List</span>
				            </div>	
				        </div>

				        <div class="portlet-body Details">
		                    <div class="row	">
		                    	<div class="col-sm-12">
		                    		<select class="form-control edited three-option-filter-02" id="territory_sort">
			                            <option value="" selected="">Filter by Territory</option>
										<?php foreach($territories as $territory){ ?>
			                            <option value="{{ $territory->name }}">{{ $territory->name }}</option>
										<?php } ?>
			                        </select>

			                        <input class="form-control three-option-filter-01 datepicker" name="" id="" value="" placeholder="Filter by Date">

		                    		<table class="table table-bordered datatable" id="mpo_table" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <th class="w30">Sl. No.</th>
							                  <th>MPO Name</th>
							                  <th>Territory</th>
							                  <th class="w120 text-center">Action</th>
							                </tr>
						              	</thead>

						              	<tbody>
										<?php
										$count = 1;
										foreach($mpos as $mpo){ ?>
						              		<tr>
						              			<td class="text-center">{{ $count }}</td>
						              			<td>{{ $mpo->first_name." ".$mpo->last_name }}</td>
						              			<td>{{ $mpo->name }}</td>
						              			<td class="text-center"> 
						              				<a title="View" href="{{url('mpo_report',$mpo->id)}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
						              			</td>
						              		</tr>
										<?php $count++;
										} ?>
						              	</tbody>
						            </table>
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
    <script type="text/javascript">
    	var doctor_list = $('#mpo_table').DataTable();
		$('#territory_sort').change(function(){
		    var select_val = $(this).val();
			doctor_list
				.columns(2)
				.search(select_val)
				.draw();
		});
	</script>
@endsection