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
                <span>Chemist DCR</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Chemist DCR</span>
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
		                                    <span class="badge badge-primary">4</span>
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
							        		<select class="form-control edited double_filter_02" id="chemist_all_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="chemist_all_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Order value</th>
									                  <th class="text-center w100">Collection</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody>
									                <tr>
									                  	<td>01</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">1000</td>
									                  	<td class="text-center">901</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-danger">Pending</p></td>
									                  	<td >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, id.</td>
									                  	<td class="text-center">
									                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Accept
									                  		</a>

									                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Reject
									                  		</a>
									                  	</td>
									                </tr>
									                
									                <tr>
									                  	<td>02</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 02</td>
									                  	<td class="text-center">1000</td>
									                  	<td class="text-center">901</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-primary">Accept</p></td>
									                  	<td class="text-center"></td>
									                  	<td class="text-center">
									                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Accept
									                  		</a>

									                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Reject
									                  		</a>
									                  	</td>
									                </tr>

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Accept">
		                                 <div class="">
							        		<select class="form-control edited double_filter_02" id="chemist_accept_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="chemist_accept_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Order value</th>
									                  <th class="text-center w100">Collection</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                </tr>
								              	</thead>
								              	<tbody>
									                <tr>
									                  	<td>01</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-danger">Pending</p></td>
									                </tr>
									                
									                <tr>
									                  	<td>02</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 02</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-primary">Accept</p></td>
									                </tr>

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Pending">
		                                <div class="">
											<select class="form-control edited double_filter_02" id="chemist_pending_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="chemist_pending_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Order value</th>
									                  <th class="text-center w100">Collection</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                  <th class="w200 text-center">Action</th>
									                </tr>
								              	</thead>
								              	<tbody>
									                <tr>
									                  	<td>01</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-danger">Pending</p></td>
									                  	<td >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, id.</td>
									                  	<td class="text-center">
									                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Accept
									                  		</a>

									                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Reject
									                  		</a>
									                  	</td>
									                </tr>
									                
									                <tr>
									                  	<td>02</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 02</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-primary">Accept</p></td>
									                  	<td class="text-center"></td>
									                  	<td class="text-center">
									                  		<a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Accept
									                  		</a>

									                  		<a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptRejectModal">
									                  			Reject
									                  		</a>
									                  	</td>
									                </tr>

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Reject">
		                                <div class="">
							        		<select class="form-control edited double_filter_02" id="chemist_reject_sort">
					                            <option value="" selected="">Filter by Status</option>
					                            <option value="Accept">Accept</option>
					                            <option value="Pending">Pending</option>
					                            <option value="Reject">Reject</option>
					                        </select>

					                        <input class="form-control datepicker double_filter_01" placeholder="Filter by Date">

								            <table class="table table-bordered" id="chemist_reject_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th>Product Name</th>
									                  <th class="w150">Doctor Name</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Order value</th>
									                  <th class="text-center w100">Collection</th>
									                  <th class="text-center w100">Date</th>
									                  <th class="w100">Remark</th>
									                  <th class="text-center">Status</th>
									                  <th class="w150">Reject reason</th>
									                </tr>
								              	</thead>
								              	<tbody>
									                <tr>
									                  	<td>01</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-danger">Pending</p></td>
									                  	<td >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, id.</td>
									                </tr>
									                
									                <tr>
									                  	<td>02</td>
									                  	<td>
									                  		<p>Paracitamol</p>
									                  		<p>Paracitamol</p>
									                  	</td>
									                  	<td>John Doe, Heart specialist, Class A</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 02</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                  	<td>Lorem ipsum dolor sit amet.</td>
									                  	<td class="text-center"><p class="font-bold text-primary">Accept</p></td>
									                  	<td class="text-center"></td>
									                </tr>

									            </tbody>
								            </table>
							          	</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane fade" id="Absence">
		                                <div class="">

					                        <input class="form-control datepicker single_filter" placeholder="Filter by Date">

								            <table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w40">Sl. No.</th>
									                  <th class="text-center w100">MPO Name</th>
									                  <th class="text-center w100">Territory</th>
									                  <th class="text-center w100">Date</th>
									                </tr>
								              	</thead>
								              	<tbody>
									                <tr>
									                  	<td>01</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
									                </tr>
									                
									                <tr>
									                  	<td>02</td>
									                  	<td class="text-center">
									                  		<p>ABC</p>
									                  		<p>Post</p>
									                  	</td>
									                  	<td class="text-center">Territory 01</td>
									                  	<td class="text-center">12/12/2018 12.00 PM</td>
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
	</div>

	<!-- Accept /reject modal START-->
	<!-- Modal -->
	<div id="acceptRejectModal" class="modal fade" role="dialog">
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
		        		<textarea class="form-control" rows="5" placeholder="Please Enter Reject Reason"></textarea>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Yes, Continue</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
    <script>

    </script>
@endsection