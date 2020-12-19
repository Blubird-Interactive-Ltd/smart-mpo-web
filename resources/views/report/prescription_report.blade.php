@extends('layouts.master')

@section('css')

<style type="text/css">
	#print *{display: none;} 
	@page { size: landscape; }
	@media print
	{
	body * { visibility: hidden; }
	#print * { visibility: visible; }
	#print { position: absolute; top: 40px; left: 30px; }
	}

	#print2 *{display: none;} 
	@page { size: landscape; }
	@media print2
	{
	body * { visibility: hidden; }
	#print2 * { visibility: visible; }
	#print2 { position: absolute; top: 40px; left: 30px; }
	}
	</style>
@endsection


@section('content')
	<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Prescription</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Prescription</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
			      			<div class="">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
									@if(\App\Utility::userRolePermission(Session::get('role_id'),24))
		                            <li role="presentation" class="active">
		                                <a href="#MPO" data-toggle="tab">
		                                    MPO 
		                                </a>
		                            </li>
									@endif

									@if(\App\Utility::userRolePermission(Session::get('role_id'),25))
		                            <li role="presentation">
		                                <a href="#AM" data-toggle="tab">
		                                    AM
		                                </a>
		                            </li>
									@endif
		                        </ul>

		                        <!-- Tab panes -->
		                        <div class="tab-content">
									@if(\App\Utility::userRolePermission(Session::get('role_id'),24))
		                            <div role="tabpanel" class="tab-pane fade in active" id="MPO">
		                            	<div class="report-heading font-bold">
			                            	<h3 class="text-center">
			                            		MPO Reports
			                            		<span class="print-option">
			                            			<a href="javascript:;" title="Print" onclick="PrintElem('#print')">
								                        <img src="{{ asset('assets/custom/images/printer.png') }}" alt="Print"/>
								                    </a>
			                            		</span>
			                            	</h3>
											<div>

												<div class="alert alert-success filter_success_msg" style="display:none" id="success"></div>
												<div class="alert alert-danger filter_error_msg" style="display:none" id="error"><ul></ul></div>

												<form id="filter_by_date_mpo_form" method="post" action="">
													{{ csrf_field() }}
													<input class="form-control three-option-filter-02 datepicker" name="end_date" id="end_date" value="" placeholder="Filter by Date(From)">
													<input class="form-control three-option-filter-01 datepicker" name="start_date" id="start_date" value="" placeholder="Filter by Date(To)">
													<button type="submit" class="btn btn-primary filter-btn" id="filter_by_date_mpo">Filter</button>
												</form>
											</div>
			                            	<p>
			                            		<span>Accept: <span id="mpoAccepted"></span></span>
			                            		<span class="pull-right">Target: <span id="mpoTarget"></span></span>
			                            	</p>
			                            	<p>
			                            		<span>Reject: <span id="mpoRejected"></span></span>
			                            		<span class="pull-right">Percentage: <span id="mpoPercent"></span> %</span>
			                            	</p>
		                            	</div>

		                            	<hr>

		                                <div class="">

											<select class="form-control edited double_filter_02" id="filter_month">
					                            <option value="" selected="">Filter by Month</option>
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

					                        <select class="form-control edited double_filter_01" id="filter_year">
					                            <option value="" selected="">Filter by Year</option>
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
								            <table class="table table-bordered datatable" id="mpoData_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w100">Sl. No.</th>
									                  <th class="">MPO</th>
									                  <th class="">AM Name</th>
									                  <th class="">Territory</th>
									                  <th class="text-center">Total Accept </th>
									                  <th class="text-center">Total Reject </th>
									                  <th class="text-center">Total Add</th>
									                  <th class="text-center">Target</th>
									                  <th class="text-center">Percentage</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_mpoData">


									            </tbody>
								            </table>
							          	</div>
		                            </div>
									@endif

									@if(\App\Utility::userRolePermission(Session::get('role_id'),25))
		                            <div role="tabpanel" class="tab-pane fade" id="AM">
		                                <div class="report-heading font-bold">
			                            	<h3 class="text-center">
			                            		AM Reports
			                            		<span class="print-option">
			                            			<a href="javascript:;" title="Print" onclick="PrintElem('#print2')">
								                        <img src="{{ asset('assets/custom/images/printer.png') }}" alt="Print"/>
								                    </a>
			                            		</span>
			                            	</h3>
											<div>

												<div class="alert alert-success filter_success_msg" style="display:none" id="success"></div>
												<div class="alert alert-danger filter_error_msg" style="display:none" id="error"><ul></ul></div>

												<form id="filter_by_date_am_form" method="post" action="">
													{{ csrf_field() }}
													<input class="form-control three-option-filter-02 datepicker" name="end_date" id="am_end_date" value="" placeholder="Filter by Date(From)">
													<input class="form-control three-option-filter-01 datepicker" name="start_date" id="am_start_date" value="" placeholder="Filter by Date(To)">
													<button type="submit" class="btn btn-primary filter-btn" id="filter_by_date_am">Filter</button>
												</form>
											</div>
			                            	<p>
			                            		<span>Accept: <span id="amAccepted"></span></span>
			                            		<span class="pull-right">Target: <span id="amTarget"></span></span>
			                            	</p>
			                            	<p>
			                            		<span>Reject: <span id="amRejected"></span></span>
			                            		<span class="pull-right">Percentage: <span id="amPercent"></span> % </span>
			                            	</p>
		                            	</div>

		                            	<hr>

		                                <div class="">

											<select class="form-control edited double_filter_02" id="Amfilter_month">
					                            <option value="" selected="">Filter by Month</option>
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

					                        <select class="form-control edited double_filter_01" id="Amfilter_year">
					                            <option value="" selected="">Filter by Year</option>
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
								            <table class="table table-bordered datatable" id="amData_table" width="100%" cellspacing="0">
								              	<thead>
									                <tr>
									                  <th class="w100">Sl. No.</th>
									                  <th class="">AM Name</th>
									                  <th class="">RSM name</th>
									                  <th class="">Area</th>
									                  <th class="text-center">Total Accept </th>
									                  <th class="text-center">Total Reject </th>
									                  <th class="text-center">Total Add</th>
									                  <th class="text-center">Target</th>
									                  <th class="text-center">Percentage</th>
									                </tr>
								              	</thead>
								              	<tbody id="set_amData">

									                <tr>
									                  	<td>01</td>
									                  	<td>Lorem Ipsum</td>
									                  	<td>Lorem Doller</td>
									                  	<td>Area 01</td>
									                  	<td class="text-center">1100</td>
									                  	<td class="text-center">50</td>
									                  	<td class="text-center">1120</td>
									                  	<td class="text-center">1400</td>
									                  	<td class="text-center">12%</td>
									                </tr>

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
		        	<h3>Are you sure want to inactive?</h3>
		      	</div>
		      	<div class="modal-footer" style="text-align: center;">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        	<button type="button" class="btn btn-success" data-dismiss="modal">Yes, Continue</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

<!-- MPO Prescription print section -->
	<div id="print">
		<style type="text/css">
			#print *{margin:0;padding:0}*{font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{margin:0;padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%}a{color:#2ba6cb} .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;color: #333;background-color: white;border-color: #CCC;} p.callout{padding:15px;background-color:#ecf8ff;margin-bottom:15px}.callout a{font-weight:bold;color:#2ba6cb}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center}a.fb{background-color:#3b5998 !important}a.tw{background-color:#1daced !important}a.gp{background-color:#db4a39 !important}a.ms{background-color:#000 !important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px;padding-left:0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both !important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px}.footer-wrap .container td.content p{font-size:10px;font-weight:bold}h1,h2,h3,h4,h5,h6{font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0 !important}p,ul{margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;margin-right:10px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #fff;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0 !important}.container{display:block !important;max-width:700px !important;margin:0 auto !important;clear:both !important; font-size: 15px;}.content{padding:0px;max-width:700px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0 !important;margin:0 auto;max-width:600px !important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class="btn"]{display:block !important;margin-bottom:10px !important;background-image:none !important;margin-right:0 !important}div[class="column"]{width:auto !important;float:none !important}table.social div[class="column"]{width:auto !important}}
	.border-table{
		border-collapse: collapse;
	}
	.border-table th{
		text-align: left;
		font-size: 13px;
	}
	.border-table th,.border-table td{
		border: 1px solid #b9b9b9;
		box-sizing: content-box;
		padding: 5px;
	}
	i{font-size: 13px;}
		</style>
	<!-- HEADER -->
	<table class="head-wrap" background="border.png">
		<tr>
			<td class="header container" >
				<div class="content">
					<h6 class="collapse" style="text-align: center;font-size: 24px;margin-bottom: 15px !important;">CONCORD</h6>
					<h6 class="collapse" style="text-align: center">MPO PRESCRIPTION REPORT</h6>
					<table>
						<tr>
							<td>Accept: <span id="mpoPrintAcc"></span> </td>
							<td align="right">Reject: <span id="mpoPrintRej"></span></td>
						</tr>
						<tr>
							<td>Target: <span id="mpoPrintTar"></span></td>
							<td align="right">percentage: <span id="mpoPrintPer"></span> %</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table><!-- /HEADER -->


	<!-- BODY -->
	<table class="body-wrap">
		<tr>
			<td class="container" bgcolor="#FFFFFF">

				<div class="content">
				<table>
					<tr>
						<table class="border-table">
							<thead>
								<tr>
								    <th width="8%">SL</th>
								    <th>MPO Name</th>
								    <th>AM Name</th>
								    <th>Territory</th>
								    <th>Total Accept</th>
								    <th>Total Reject</th>
								    <th>Total Add</th>
								    <th>Target</th>
								    <th>Percentage</th>
								</tr>
							</thead>

							<tbody id="mpoPrintSetData">
								<tr>
								    <td style="text-align: center">1</td>
								    <td>John Smith, <br><i>#124, Tarritory</i></td>
								    <td>John Doe, <br><i>some description goes here...</i></td>
								    <td>Territory 01</td>
								    <td>1200</td>
								    <td>100</td>
								    <td>1100</td>
								    <td>1500</td>
								    <td>71%</td>
								</tr>
								<tr>
								    <td style="text-align: center">2</td>
								    <td>John Smith, <br><i>#124, Tarritory</i></td>
								    <td>John Doe, <br><i>some description goes here...</i></td>
								    <td>Territory 01</td>
								    <td>1200</td>
								    <td>100</td>
								    <td>1100</td>
								    <td>1500</td>
								    <td>71%</td>
								</tr>
								<tr>
								    <td style="text-align: center">3</td>
								    <td>John Smith, <br><i>#124, Tarritory</i></td>
								    <td>John Doe, <br><i>some description goes here...</i></td>
								    <td>Territory 01</td>
								    <td>1200</td>
								    <td>100</td>
								    <td>1100</td>
								    <td>1500</td>
								    <td>71%</td>
								</tr>
								<tr>
								    <td style="text-align: center">4</td>
								    <td>John Smith, <br><i>#124, Tarritory</i></td>
								    <td>John Doe, <br><i>some description goes here...</i></td>
								    <td>Territory 01</td>
								    <td>1200</td>
								    <td>100</td>
								    <td>1100</td>
								    <td>1500</td>
								    <td>71%</td>
								</tr>
							</tbody>
						</table>
					</tr>
				</table>
				</div><!-- /content -->
										
			</td>
			<td></td>
		</tr>
	</table><!-- /BODY -->
	</div>



<!-- MPO Prescription print section -->
	<div id="print2">
		<style type="text/css">
			#print *{margin:0;padding:0}*{font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{margin:0;padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%}a{color:#2ba6cb} .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;color: #333;background-color: white;border-color: #CCC;} p.callout{padding:15px;background-color:#ecf8ff;margin-bottom:15px}.callout a{font-weight:bold;color:#2ba6cb}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center}a.fb{background-color:#3b5998 !important}a.tw{background-color:#1daced !important}a.gp{background-color:#db4a39 !important}a.ms{background-color:#000 !important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px;padding-left:0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both !important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px}.footer-wrap .container td.content p{font-size:10px;font-weight:bold}h1,h2,h3,h4,h5,h6{font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0 !important}p,ul{margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;margin-right:10px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #fff;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0 !important}.container{display:block !important;max-width:700px !important;margin:0 auto !important;clear:both !important; font-size: 15px;}.content{padding:0px;max-width:700px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0 !important;margin:0 auto;max-width:600px !important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class="btn"]{display:block !important;margin-bottom:10px !important;background-image:none !important;margin-right:0 !important}div[class="column"]{width:auto !important;float:none !important}table.social div[class="column"]{width:auto !important}}
	.border-table{
		border-collapse: collapse;
	}
	.border-table th{
		text-align: left;
		font-size: 13px;
	}
	.border-table th,.border-table td{
		border: 1px solid #b9b9b9;
		box-sizing: content-box;
		padding: 5px;
	}
	i{font-size: 13px;}
		</style>
	<!-- HEADER -->
	<table class="head-wrap" background="border.png">
		<tr>
			<td class="header container" >
				<div class="content">
					<h6 class="collapse" style="text-align: center;font-size: 24px;margin-bottom: 15px !important;">CONCORD</h6>
					<h6 class="collapse" style="text-align: center">AM PRESCRIPTION REPORT</h6>
					<table>
						<tr>
							<td>Accept: <span id="amPrintAcc"></span> </td>
							<td align="right">Reject: <span id="amPrintRej"></span></td>
						</tr>
						<tr>
							<td>Target: <span id="amPrintTar"></span></td>
							<td align="right">percentage: <span id="amPrintPer"></span> %</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table><!-- /HEADER -->


	<!-- BODY -->
	<table class="body-wrap">
		<tr>
			<td class="container" bgcolor="#FFFFFF">

				<div class="content">
				<table>
					<tr>
						<table class="border-table">
							<thead>
								<tr>
								    <th width="8%">SL</th>
								    <th>AM Name</th>
								    <th>SM Name</th>
								    <th>Area</th>
								    <th>Total Accept</th>
								    <th>Total Reject</th>
								    <th>Total Add</th>
								    <th>Target</th>
								    <th>Percentage</th>
								</tr>
							</thead>

							<tbody id="amPrintSetData">

							</tbody>
						</table>
					</tr>
				</table>
				</div><!-- /content -->
										
			</td>
			<td></td>
		</tr>
	</table><!-- /BODY -->
	</div>


@endsection

@section('js')
<script type="text/javascript">
//MPO monthly filter
$( "#Amfilter_month" ).change(function() {
  	var month = $(this).val();
	var year = $('#Amfilter_year').val();
    amGetData(month,year);
});
//MPO yearly filter
$( "#Amfilter_year" ).change(function() {
  	var month = $('#Amfilter_month').val();
	var year = $(this).val();
    amGetData(month,year);
});

// MPO onload data
$( document ).ready(function() {
	var month = $('#Amfilter_month').val();
	var year = $('#Amfilter_year').val();
    amGetData(month,year);	
});


$(document).on('submit','#filter_by_date_am_form',function(event) {
	event.preventDefault();
	var start_date = $('#am_start_date').val();
	var end_date = $('#am_end_date').val();
	var validate = '';

	if(start_date==''){
		validate=validate+'Enter start date<br>';
	}
	if(end_date==''){
		validate=validate+'Enter end date<br>';
	}

	if(start_date > end_date){
		validate=validate+'Start date can not be greater than end date<br>';
	}

	if(validate==''){
		var url = "{{ url('/report/MpoPrescriptionFilter') }}";
		var dataString = {
			_token: "{{ csrf_token() }}",
			start_date:start_date,
			end_date:end_date
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
					$('#amData_table').DataTable().destroy();

					var html = '';
					var count = 1;
					var totAccepted = 0;
					var totRejected = 0;
					var totTarget = 0;
					$.each(data.data.amPres, function (index, value) {
						if(value.amName !== null){ var amName = value.amName}else{ var amName = ''; }
						if(value.hr !== null){ var hr = value.hr}else{ var hr = ''; }
						if(value.smName !== null){ var smName = value.smName}else{ var smName = ''; }
						if(value.arName !== null){ var arName = value.arName; }else{ var arName = ''; }
						if(value.accepted !== null){ var accepted = value.accepted; totAccepted = parseInt(totAccepted) + parseInt(accepted); }else{ var accepted = ''; }
						if(value.rejected !== null){ var rejected = value.rejected; totRejected = parseInt(totRejected) + parseInt(rejected); }else{ var rejected = ''; }
						if(value.totalAdd !== null){ var totalAdd = value.totalAdd}else{ var totalAdd = ''; }
						if(value.target !== null){ var target = value.target; totTarget = parseInt(totTarget)+parseInt(target);}else{ var target = ''; }
						if(value.percentage !== null){ var percentage = value.percentage}else{ var percentage = ''; }

						html += '<tr>';
						html += '<td>'+count+'</td>';
						html += '<td><p>'+amName+'</p><span> #'+hr+'</span></td>';
						html += '<td><p>'+ smName +'</p></td>';
						html += '<td>'+arName+'</td>';
						html += '<td>'+ accepted +'</td>';
						html += '<td>'+ rejected +'</td>';
						html += '<td>'+ totalAdd +'</td>';
						html += '<td>'+ target +'</td>';
						html += '<td>'+ percentage.toFixed(2) +' % </td>';

						html += '</tr>';
						count++;
					});
					$('#set_amData').html(html);
					$('#amAccepted').html(totAccepted);
					$('#amRejected').html(totRejected);
					$('#amTarget').html(totTarget);
					if(totTarget==0){
						$('#amPercent').html(100);
					}
					else{
						$('#amPercent').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));
					}

					$('#amPrintSetData').html(html);
					$('#amPrintAcc').html(totAccepted);
					$('#amPrintRej').html(totRejected);
					$('#amPrintTar').html(totTarget);
					$('#amPrintPer').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));

					//Datatable Initialize
					$('#amData_table').dataTable();
					//dataFilter();
				}
				else{

				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}
	else{
		$('.filter_success_msg').hide();
		$('.filter_error_msg').show();
		$('.filter_error_msg').html(validate);
	}
	setTimeout(function(){
		$('.filter_success_msg').hide();
		$('.filter_error_msg').hide();
	}, 2000);

});

//Get Data Ajax Function
function amGetData(month,year){
	var url = "{{ url('/report/MpoPrescription') }}";
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
            success: function(data){
                console.log(data);
                if(data.status == 200){
                //Datatable destroy function	
                $('#amData_table').DataTable().destroy();

                	var html = '';
                	var count = 1;
                	var totAccepted = 0;
                	var totRejected = 0;
                	var totTarget = 0;
                	$.each(data.data.amPres, function (index, value) {
                	if(value.amName !== null){ var amName = value.amName}else{ var amName = ''; }
                	if(value.hr !== null){ var hr = value.hr}else{ var hr = ''; }
                	if(value.rsmName !== null){ var rsmName = value.rsmName}else{ var rsmName = ''; }
                	if(value.arName !== null){ var arName = value.arName; }else{ var arName = ''; }
                	if(value.accepted !== null){ var accepted = value.accepted; totAccepted = parseInt(totAccepted) + parseInt(accepted); }else{ var accepted = ''; }
                	if(value.rejected !== null){ var rejected = value.rejected; totRejected = parseInt(totRejected) + parseInt(rejected); }else{ var rejected = ''; }
                	if(value.totalAdd !== null){ var totalAdd = value.totalAdd}else{ var totalAdd = ''; }
                	if(value.target !== null){ var target = value.target; totTarget = parseInt(totTarget)+parseInt(target);}else{ var target = ''; }
                	if(value.percentage !== null){ var percentage = value.percentage}else{ var percentage = ''; }

				        html += '<tr>';
				        html += '<td>'+count+'</td>';
				        html += '<td><p>'+amName+'</p><span> #'+hr+'</span></td>';
				        html += '<td><p>'+ rsmName +'</p></td>';
				        html += '<td>'+arName+'</td>';
				        html += '<td>'+ accepted +'</td>';
				        html += '<td>'+ rejected +'</td>';
				        html += '<td>'+ totalAdd +'</td>';
				        html += '<td>'+ target +'</td>';
				        html += '<td>'+ percentage.toFixed(2) +' % </td>';

				        html += '</tr>';
				        count++;
				    });
					$('#set_amData').html(html);
					$('#amAccepted').html(totAccepted);
					$('#amRejected').html(totRejected);
					$('#amTarget').html(totTarget);
					if(totTarget==0){
						$('#amPercent').html(100);
					}
					else{
						$('#amPercent').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));
					}

					$('#amPrintSetData').html(html);
					$('#amPrintAcc').html(totAccepted);
					$('#amPrintRej').html(totRejected);
					$('#amPrintTar').html(totTarget);
					$('#amPrintPer').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));

					//Datatable Initialize 
				    $('#amData_table').dataTable();
				    //dataFilter();
                }
                else{
                
                }

            } ,error: function(xhr, status, error) {
                //alert(error);
            },
        });
}


//MPO monthly filter
$( "#filter_month" ).change(function() {
  	var month = $(this).val();
	var year = $('#filter_year').val();
    mpoGetData(month,year);
});
//MPO yearly filter
$( "#filter_year" ).change(function() {
  	var month = $('#filter_month').val();
	var year = $(this).val();
    mpoGetData(month,year);
});

// MPO onload data
$( document ).ready(function() {
	var month = $('#filter_month').val();
	var year = $('#filter_year').val();
    mpoGetData(month,year);	
});

$(document).on('submit','#filter_by_date_mpo_form',function(event){
	event.preventDefault();
	var start_date = $('#start_date').val();
	var end_date = $('#end_date').val();
	var validate = '';

	if(start_date==''){
		validate=validate+'Enter start date<br>';
	}
	if(end_date==''){
		validate=validate+'Enter end date<br>';
	}

	if(start_date > end_date){
		validate=validate+'Start date can not be greater than end date<br>';
	}

	if(validate==''){
		var url = "{{ url('/report/MpoPrescriptionFilter') }}";
		var dataString = {
			_token: "{{ csrf_token() }}",
			start_date:start_date,
			end_date:end_date
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
					$('#mpoData_table').DataTable().destroy();

					var html = '';
					var count = 1;
					var totAccepted = 0;
					var totRejected = 0;
					var totTarget = 0;
					$.each(data.data.mpoPres, function (index, value) {
						if(value.mpoName !== null){ var mpoName = value.mpoName}else{ var mpoName = ''; }
						if(value.hr !== null){ var hr = value.hr}else{ var hr = ''; }
						if(value.amName !== null){ var amName = value.amName}else{ var amName = ''; }
						if(value.trName !== null){ var trName = value.trName; }else{ var trName = ''; }
						if(value.accepted !== null){ var accepted = value.accepted; totAccepted = parseInt(totAccepted) + parseInt(accepted); }else{ var accepted = ''; }
						if(value.rejected !== null){ var rejected = value.rejected; totRejected = parseInt(totRejected) + parseInt(rejected); }else{ var rejected = ''; }
						if(value.totalAdd !== null){ var totalAdd = value.totalAdd}else{ var totalAdd = ''; }
						if(value.target !== null){ var target = value.target; totTarget = parseInt(totTarget)+parseInt(target);}else{ var target = ''; }
						if(value.percentage !== null){ var percentage = value.percentage}else{ var percentage = ''; }

						html += '<tr>';
						html += '<td>'+count+'</td>';
						html += '<td><p>'+mpoName+'</p><span> #'+hr+'</span></td>';
						html += '<td><p>'+ amName +'</p></td>';
						html += '<td>'+trName+'</td>';
						html += '<td>'+ accepted +'</td>';
						html += '<td>'+ rejected +'</td>';
						html += '<td>'+ totalAdd +'</td>';
						html += '<td>'+ target +'</td>';
						html += '<td>'+ percentage.toFixed(2) +' % </td>';

						html += '</tr>';
						count++;
					});
					$('#set_mpoData').html(html);
					$('#mpoAccepted').html(totAccepted);
					$('#mpoRejected').html(totRejected);
					$('#mpoTarget').html(totTarget);
					if(totTarget==0){
						$('#mpoPercent').html(100);
					}
					else{
						$('#mpoPercent').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));
					}

					$('#mpoPrintSetData').html(html);
					$('#mpoPrintAcc').html(totAccepted);
					$('#mpoPrintRej').html(totRejected);
					$('#mpoPrintTar').html(totTarget);
					$('#mpoPrintPer').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));

					//Datatable Initialize
					$('#mpoData_table').dataTable();
					//dataFilter();
				}
				else{

				}

			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	}
	else{
		$('.filter_success_msg').hide();
		$('.filter_error_msg').show();
		$('.filter_error_msg').html(validate);
	}
	setTimeout(function(){
		$('.filter_success_msg').hide();
		$('.filter_error_msg').hide();
	}, 2000);

})

//Get Data Ajax Function
function mpoGetData(month,year){
	var url = "{{ url('/report/MpoPrescription') }}";
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
                $('#mpoData_table').DataTable().destroy();

                	var html = '';
                	var count = 1;
                	var totAccepted = 0;
                	var totRejected = 0;
                	var totTarget = 0;
                	$.each(data.data.mpoPres, function (index, value) {
                	if(value.mpoName !== null){ var mpoName = value.mpoName}else{ var mpoName = ''; }
                	if(value.hr !== null){ var hr = value.hr}else{ var hr = ''; }
                	if(value.amName !== null){ var amName = value.amName}else{ var amName = ''; }
                	if(value.trName !== null){ var trName = value.trName; }else{ var trName = ''; }
                	if(value.accepted !== null){ var accepted = value.accepted; totAccepted = parseInt(totAccepted) + parseInt(accepted); }else{ var accepted = ''; }
                	if(value.rejected !== null){ var rejected = value.rejected; totRejected = parseInt(totRejected) + parseInt(rejected); }else{ var rejected = ''; }
                	if(value.totalAdd !== null){ var totalAdd = value.totalAdd}else{ var totalAdd = ''; }
                	if(value.target !== null){ var target = value.target; totTarget = parseInt(totTarget)+parseInt(target);}else{ var target = ''; }
                	if(value.percentage !== null){ var percentage = value.percentage}else{ var percentage = ''; }

				        html += '<tr>';
				        html += '<td>'+count+'</td>';
				        html += '<td><p>'+mpoName+'</p><span> #'+hr+'</span></td>';
				        html += '<td><p>'+ amName +'</p></td>';
				        html += '<td>'+trName+'</td>';
				        html += '<td>'+ accepted +'</td>';
				        html += '<td>'+ rejected +'</td>';
				        html += '<td>'+ totalAdd +'</td>';
				        html += '<td>'+ target +'</td>';
				        html += '<td>'+ percentage.toFixed(2) +' % </td>';

				        html += '</tr>';
				        count++;
				    });
					$('#set_mpoData').html(html);
					$('#mpoAccepted').html(totAccepted);
					$('#mpoRejected').html(totRejected);
					$('#mpoTarget').html(totTarget);
					if(totTarget==0){
						$('#mpoPercent').html(100);
					}
					else{
						$('#mpoPercent').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));
					}

					$('#mpoPrintSetData').html(html);
					$('#mpoPrintAcc').html(totAccepted);
					$('#mpoPrintRej').html(totRejected);
					$('#mpoPrintTar').html(totTarget);
					$('#mpoPrintPer').html(((parseInt(totAccepted)*100)/(totTarget)).toFixed(2));

					//Datatable Initialize 
				    $('#mpoData_table').dataTable();
				    //dataFilter();
                }
                else{
                
                }

            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
}

    	function PrintElem(elem)
	    {
	        Popup($(elem).html());
	    }

	    function Popup(data)
	    {
	        var mywindow = window.open('', 'new div', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>my div</title>');
	        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
	        mywindow.document.write('</head><body >');
	        mywindow.document.write(data);
	        mywindow.document.write('</body></html>');

	        mywindow.print();
	        mywindow.close();

	        return true;
	    }	
</script>
@endsection