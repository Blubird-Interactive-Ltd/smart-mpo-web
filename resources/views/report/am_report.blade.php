@extends('layouts.master')
@section('content')
	<style type="text/css">
	#print *{display: none;} 
	@page { size: landscape; }
	@media print
	{
	body * { visibility: hidden; }
	#print * { visibility: visible; }
	#print { position: absolute; top: 40px; left: 30px; }
	}
	.date_sort{
		width: 250px;
	    margin: 0 auto;
	    position: absolute;
	    left: 0;
	    right: 0;
	}
	.controls>a {
	    position: absolute;
	    top: 50%;
	}
	.controls_left{
		left: 10px;
	}
	.controls_right{
		right: 10px;
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
                <span> AM DCR</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">
		@if(\App\Utility::userRolePermission(Session::get('role_id'),21))
	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> AM DCR</span>
				            </div>

				            <div class="actions">
				            	<span class="print-option">
                        			<a href="javascript:;" title="Print" onclick="PrintElem('#print')">
				                        <img src="{{ asset('assets/custom/images/printer.png') }}" alt="Print"/>
				                    </a>
                        		</span>
				            </div>	
				        </div>

				        <div class="portlet-body Details">
		                    <div class="row	">
		                    	<div class="col-sm-12">
		                    		<div class="date_sort">
			                    		
				                    </div>

		                    		<!-- HEADER -->
									<table class="head-wrap">
										<tr>
											<td class="header" >
												<div class="content" style="max-width: 95%;">
													<?php
													$next_day = $stop_date = date('Y-m-d H:i:s', strtotime($last_date . ' +1 day'));
													$previous_day = $stop_date = date('Y-m-d H:i:s', strtotime($last_date . ' -1 day'));
													?>
													
													<table>
														<tr>
															<td>
																<b>Date:</b> {{ date('m/d/y', strtotime($last_date)) }} <br>
																<b>Name:</b><span> {{ $user_details->first_name." ".$user_details->last_name }}</span><br>
																<b>Location:</b> {{ $user_details->name }}<br>
															</td>

															<td>
											                    <div class="form-group form-md-line-input pull-right" style="max-width: 300px; margin-bottom: 0;">
																	<form id="date_filter_form" method="post" action="{{ url('am_report',$user_details->id) }}">
																	{{ csrf_field() }}
																	<!-- <label class="col-md-4 control-label" for=""><b>Filter by Date</b></label> -->
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm datepicker edited" placeholder="Filter by Date" id="date_filter" name="date">
																			<div class="form-control-focus"> </div>
																		</div>
																	</form>
					                                            </div>
															</td>
														</tr>
													</table>
												</div>
											</td>
										</tr>
									</table><!-- /HEADER -->

									<!-- BODY -->
									<div class="content table-responsive" style="max-width: 95%;">
										<table class="body-wrap table">
											<tbody>
												<tr>
													<td colspan="2">
														<h6 class="xs-margin-auto" style="text-align: center; margin-bottom: 10px;">Doctor Visit</h6>
														
														<table class="border-table">
															<thead>
																<tr>
																    <td rowspan="2" width="50px">SL No.</td>
																    <td rowspan="2" style="text-align: center;">Time</td>
																    <td  rowspan="2" width="100px">Doctor Name</td>
																    <td rowspan="2" width="100px">Contact<br>Number</td>
																    <td rowspan="2">Qualification</td>
																    <td rowspan="2">Speciality</td>
																    <td rowspan="2">Class<br>(A,B,C)</td>
																    <td rowspan="2" width="100px">Visited With</td>
																    <td rowspan="2" width="100px">Commitment/ Remark</th>
																    <th style="text-align: center;" colspan="7" scope="colgroup">Product Promoted</th>
																</tr>
																<tr>
																    <th scope="col w70">Product</th>
																    <th scope="col w70">Sample</th>
																    <th scope="col w70">Ppm</th>
																    <th scope="col w70">Gift</th>
																</tr>
															</thead>

															<tbody>
															<?php
															$count = 1;
															foreach($doctor_dcr as $d_dcr){ ?>
															<tr>
																<td style="text-align: center">{{ $count }}</td>
																<td style="text-align: center">{{ date('h:i a', strtotime($d_dcr->time)) }}</td>
																<td style="color: #2ba6cb;cursor: pointer" onclick="show_doctor_detail({{ $d_dcr->doctor_id }})">{{ $d_dcr->doctor_name }}</td>
																<td>
																	@if(isset($d_dcr->contacts))
																		@foreach($d_dcr->contacts as $key=>$contact)
																			{{ $contact->contact_no }}
																			@if($key < count($d_dcr->contacts)-1)
																				{{ ',' }}
																			@endif
																		@endforeach
																	@endif
																</td>
																<td style="text-align: center;">{{ $d_dcr->qualification }}</td>
																<td>
																	@foreach($d_dcr->specialities as $key=>$speciality)
																		{{ $speciality->speciality_name }}
																		@if($key < count($d_dcr->specialities)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
																<td style="text-align: center;">{{ $d_dcr->class_name }}</td>
																<td>
																	@foreach($d_dcr->visitors as $key=>$visitor)
																		{{ $visitor->first_name." ".$visitor->last_name }}
																		@if($key < count($d_dcr->visitors)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
																<td>{{ $d_dcr->remark }}</td>
																<td>
																	@foreach($d_dcr->products as $key=>$product)
																		{{ $product->product_name }}
																		@if($key < count($d_dcr->products)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
																<td>
																	@foreach($d_dcr->samples as $key=>$sample)
																		{{ $sample->product_name."(".$sample->quantity.")" }}
																		@if($key < count($d_dcr->samples)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
																<td>
																	@foreach($d_dcr->ppms as $key=>$ppm)
																		{{ $ppm->ppm_name }}
																		@if($key < count($d_dcr->ppms)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
																<td>
																	@foreach($d_dcr->gifts as $key=>$gift)
																		{{ $gift->gift_name }}
																		@if($key < count($d_dcr->gifts)-1)
																			{{ ',' }}
																		@endif
																	@endforeach
																</td>
															</tr>

															<tr>
																<th width="50px">Location</th>
																<td style="text-align: center;" colspan="12" scope="colgroup">{{ $d_dcr->location }}</td>
															</tr>
															<?php $count++;
															} ?>
															</tbody>
														</table>
													</td>
												</tr>

												<tr>
													<td width="40%" style="vertical-align: top;">
														<h6 style="text-align: center; margin-bottom: 10px; margin-top: 10px;">Chemist Visit</h6>
														<table class="border-table">
															<thead>
																<tr>
																    <td width="50px">SL No.</td>
																    <td width="100px">Chemist Name</td>
																    <td>Contact No.</td>
																    <td>Category<br>(W/R)</td>
																    <td>Order<br>Value(TK)</td>
																    <td>Cash<br>(TK)</td>
																    <td>Credit<br>(TK)</td>
																</tr>
															</thead>

															<tbody>
															<?php
															$count = 1;
															foreach($chemist_dcr as $c_dcr){ ?>
															<tr>
																<td style="text-align: center">{{ $count }}</td>
																<td style="color: #2ba6cb;cursor: pointer" onclick="show_chemist_detail({{ $c_dcr->chemist_id }})">{{ $c_dcr->chemist_name }}</td>
																<td>
																	@if(isset($c_dcr->contacts))
																		@foreach($c_dcr->contacts as $key=>$contact)
																			{{ $contact->contact_no }}
																			@if($key < count($c_dcr->contacts)-1)
																				{{ ',' }}
																			@endif
																		@endforeach
																	@endif
																</td>
																<td style="text-align: center;">{{ $c_dcr->category }}</td>
																<td>{{ $c_dcr->order_value }}</td>
																<td>{{ $c_dcr->cash }}</td>
																<td>{{ $c_dcr->credit }}</td>
															</tr>
															<?php $count++;
															} ?>
															</tbody>
														</table>
													</td>
													<td align="right" width="60%">
														<div style="margin-left: 10px;">
															<h6 style="text-align: center; margin-bottom: 10px; margin-top: 10px;">Team Status</h6>
															<table class="border-table">
																<thead>
																	<tr>
																	    <td rowspan="2" width="50px">SL No.</td>
																	    <td rowspan="2" width="100px">Name of MPO</td>
																	    <td rowspan="2" width="80px">Territory</td>
																	    <td rowspan="2" width="80px">Territory Code</td>
																	    <th style="text-align: center;" colspan="3" scope="colgroup">Doctor Visit</th>
																	    <th style="text-align: center;" colspan="3" scope="colgroup">Order</th>
																	    <th style="text-align: center;" colspan="3" scope="colgroup">Collection</th>
																	</tr>
																	<tr>
																	    <th scope="col">Plan</th>
																	    <th scope="col">Actual</th>
																	    <th scope="col">Today</th>
																	    <th scope="col">Plan</th>
																	    <th scope="col">Actual</th>
																		<th scope="col">Today</th>
																	    <th scope="col">Plan</th>
																	    <th scope="col">Actual</th>
																		<th scope="col">Today</th>
																	</tr>
																</thead>

																<tbody>
																<?php
																$count = 1;
																$total_visits = 0;
																$total_orders = 0;
																$total_collections = 0;
																foreach($mpos as $mpo){
																$total_visits = $total_visits+$mpo->visits['actual'];
																$total_orders = $total_orders+$mpo->orders['actual'];
																$total_collections = $total_collections+$mpo->collections['actual'];
																	?>
																	<tr>
																	    <td style="text-align: center">{{ $count }}</td>
																	    <td>{{ $mpo->first_name." ".$mpo->last_name }}</td>
																	    <td>{{ $mpo->name }}</td>
																	    <td>{{ $mpo->code }}</td>
																	    <td>{{ $mpo->visits['target'] }}</td>
																	    <td>{{ $mpo->visits['actual'] }}</td>
																	    <td>{{ $mpo->visits['today'] }}</td>
																		<td>{{ $mpo->orders['target'] }}</td>
																		<td>{{ $mpo->orders['actual'] }}</td>
																		<td>{{ $mpo->orders['today'] }}</td>
																	    <td style="text-align: center;">{{ $mpo->collections['target'] }}</td>
																	    <td style="text-align: center;">{{ $mpo->collections['actual'] }}</td>
																	    <td style="text-align: center;">{{ $mpo->collections['today'] }}</td>
																	</tr>
																<?php $count++;
																} ?>
																</tbody>

																<tfoot>
																	<tr>
																	    <td colspan="4"><b>Total</b></td>
																	    <td class="text-center" colspan="3"><b>{{ $total_visits }}</b></td>
																	    <td class="text-center" colspan="3"><b>{{ $total_orders }}</b></td>
																	    <td class="text-center" colspan="3"><b>{{ $total_collections }}</b></td>
																	</tr>
																</tfoot>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table><!-- /BODY -->
									</div><!-- /content -->	

									<div class="controls">
										<a class="controls_left" href="javascript:;"><i class="fa fa-3x fa-angle-left" onclick="show_report('{{ $previous_day }}')"></i></a>
										<a class="controls_right" href="javascript:;"><i class="fa fa-3x fa-angle-right" onclick="show_report('{{ $next_day }}')"></i></a>
									</div>
		                    	</div>
		                    </div>
		                </div>
		            </div>
	      		</div>
	      	</div>
		@endif
		</div>
	</div>

	<div id="print">
		<style type="text/css">
		@page { size: landscape; }
		#print *{margin:0;padding:0}*{font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{margin:0;padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%}a{color:#2ba6cb} .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;} p.callout{padding:15px;background-color:#ecf8ff;margin-bottom:15px}.callout a{font-weight:bold;color:#2ba6cb}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center}a.fb{background-color:#3b5998 !important}a.tw{background-color:#1daced !important}a.gp{background-color:#db4a39 !important}a.ms{background-color:#000 !important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px;padding-left:0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both !important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px}.footer-wrap .container td.content p{font-size:10px;font-weight:bold}h1,h2,h3,h4,h5,h6{font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0 !important}p,ul{margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;margin-right:10px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #fff;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0 !important}.container{display:block !important;max-width:1000px !important;margin:0 auto !important;clear:both !important; font-size: 15px;}.content{padding:0px;max-width:950px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0 !important;margin:0 auto;max-width:600px !important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class="btn"]{display:block !important;margin-bottom:10px !important;background-image:none !important;margin-right:0 !important}div[class="column"]{width:auto !important;float:none !important}table.social div[class="column"]{width:auto !important}}
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
			table thead>tr>td, table thead>tr>th{font-weight: 600; font-size: 12px;}
			table tbody>tr>td{font-size: 12px;}
		</style>

		<!-- HEADER -->
		<table class="head-wrap" background="border.png">
			<tr>
				<td class="header container" >
					<div class="content">
						<h6 class="collapse" style="text-align: center;font-size: 24px;margin-bottom: 0px !important;">Concord Pharmaceuticals Ltd</h6>
						<p align="center">Sima Blossom (11th Floor), House# 3 (New), 390 (Old), Road# 16 (New),</p>
						<div style="color: #000; width: 130px; text-align: center;margin: 0 auto 10px auto;">Area Manager</div>
						<h6 class="collapse" style="text-align: center; border-bottom: 1px solid #333; width: 210px; padding-bottom: 5px; margin: 15px auto 10px auto !important;">Daily Call Report</h6>
						<table>
							<tr>
								<td style="text-align: center;">
									<b>Date:</b> {{ date('m/d/y', strtotime($last_date)) }} <br>
									<b>Name:</b><span> {{ $user_details->first_name." ".$user_details->last_name }}</span><br>
									<b>Location:</b> {{ $user_details->name }}<br>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table><!-- /HEADER -->

		<!-- BODY -->
		<div class="content">
			<table class="body-wrap">
				<tbody>
					<tr>
						<td colspan="2">
							<h6 style="text-align: center; margin-bottom: 10px; margin-top: 10px;">Doctor Visit</h6>
							
							<table class="border-table">
								<thead>
									<tr>
									    <td rowspan="2" width="50px">SL No.</td>
									    <td rowspan="2" style="text-align: center;">Time</td>
									    <td rowspan="2" width="100px">Doctor Name</td>
									    <td rowspan="2" width="100px">Contact<br>Number</td>
									    <td rowspan="2">Qualification</td>
									    <td rowspan="2">Speciality</td>
									    <td rowspan="2">Class<br>(A,B,C)</td>
									    <td rowspan="2" width="100px">Visited Witd</td>
									    <td rowspan="2" width="100px">Commitment</th>
									    <th style="text-align: center;" colspan="7" scope="colgroup">Product Promoted</th>
									</tr>
									<tr>
									    <th scope="col w70">Product</th>
									    <th scope="col w70">Sample</th>
									    <th scope="col w70">Ppm</th>
									    <th scope="col w70">Gift</th>
									</tr>
								</thead>

								<tbody>
								<?php
								$count = 1;
								foreach($doctor_dcr as $d_dcr){ ?>
								<tr>
									<td style="text-align: center">{{ $count }}</td>
									<td style="text-align: center">{{ date('h:i a', strtotime($d_dcr->time)) }}</td>
									<td>{{ $d_dcr->doctor_name }}</td>
									<td>
										@if(isset($d_dcr->contacts))
											@foreach($d_dcr->contacts as $key=>$contact)
												{{ $contact->contact_no }}
												@if($key < count($d_dcr->contacts)-1)
													{{ ',' }}
												@endif
											@endforeach
										@endif
									</td>
									<td style="text-align: center;">{{ $d_dcr->qualification }}</td>
									<td>
										@foreach($d_dcr->specialities as $key=>$speciality)
											{{ $speciality->speciality_name }}
											@if($key < count($d_dcr->specialities)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
									<td style="text-align: center;">{{ $d_dcr->class_name }}</td>
									<td>
										@foreach($d_dcr->visitors as $key=>$visitor)
											{{ $visitor->first_name." ".$visitor->last_name }}
											@if($key < count($d_dcr->visitors)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
									<td>{{ $d_dcr->remark }}</td>
									<td>
										@foreach($d_dcr->products as $key=>$product)
											{{ $product->product_name }}
											@if($key < count($d_dcr->products)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
									<td>
										@foreach($d_dcr->samples as $key=>$sample)
											{{ $sample->product_name }}
											@if($key < count($d_dcr->samples)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
									<td>
										@foreach($d_dcr->ppms as $key=>$ppm)
											{{ $ppm->ppm_name }}
											@if($key < count($d_dcr->ppms)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
									<td>
										@foreach($d_dcr->gifts as $key=>$gift)
											{{ $gift->gift_name }}
											@if($key < count($d_dcr->gifts)-1)
												{{ ',' }}
											@endif
										@endforeach
									</td>
								</tr>
								<?php $count++;
								} ?>
								</tbody>
							</table>
						</td>
					</tr>

					<tr>
						<td width="40%" style="vertical-align: top;">
							<h6 style="text-align: center; margin-bottom: 10px; margin-top: 10px;">Chemist Visit</h6>
							<table class="border-table">
								<thead>
									<tr>
									    <td width="50px">SL No.</td>
									    <td width="100px">Chemist Name</td>
									    <td>Contact No.</td>
									    <td>Category<br>(W/R)</td>
									    <td>Order<br>Value(TK)</td>
										<td>Cash<br>(TK)</td>
										<td>Credit<br>(TK)</td>
									</tr>
								</thead>

								<tbody>
								<?php
								$count = 1;
								foreach($chemist_dcr as $c_dcr){ ?>
								<tr>
									<td style="text-align: center">{{ $count }}</td>
									<td>{{ $c_dcr->chemist_name }}</td>
									<td>
										@if(isset($c_dcr->contacts))
											@foreach($c_dcr->contacts as $key=>$contact)
												{{ $contact->contact_no }}
												@if($key < count($c_dcr->contacts)-1)
													{{ ',' }}
												@endif
											@endforeach
										@endif
									</td>
									<td style="text-align: center;">{{ $c_dcr->category }}</td>
									<td>{{ $c_dcr->order_value }}</td>
									<td>{{ $c_dcr->cash }}</td>
									<td>{{ $c_dcr->credit }}</td>
								</tr>
								<?php $count++;
								} ?>
								</tbody>
							</table>
						</td>
						<td align="right" width="60%">
							<h6 style="text-align: center; margin-bottom: 10px; margin-top: 10px;">Team Status</h6>
							<table class="border-table">
								<thead>
									<tr>
									    <td rowspan="2" width="50px">SL No.</td>
									    <td rowspan="2" width="100px">Name of MPO</td>
									    <td rowspan="2" width="80px">Territory</td>
									    <td rowspan="2" width="80px">Territory Code</td>
									    <th style="text-align: center;" colspan="2" scope="colgroup">Doctor Visit</th>
									    <th style="text-align: center;" colspan="2" scope="colgroup">Business</th>
									    <th style="text-align: center;" colspan="2" scope="colgroup">Credit <br>Collection</th>
									</tr>
									<tr>
									    <th scope="col">Plan</th>
									    <th scope="col">Actual</th>
									    <th scope="col">Plan</th>
									    <th scope="col">Actual</th>
									    <th scope="col">Plan</th>
									    <th scope="col">Actual</th>
									</tr>
								</thead>

								<tbody>
								<?php
								$count = 1;
								foreach($mpos as $mpo){?>
								<tr>
									<td style="text-align: center">{{ $count }}</td>
									<td>{{ $mpo->first_name." ".$mpo->last_name }}</td>
									<td>{{ $mpo->name }}</td>
									<td>{{ $mpo->code }}</td>
									<td>{{ $mpo->visits['target'] }}</td>
									<td>{{ $mpo->visits['actual'] }}</td>
									<td>{{ $mpo->orders['target'] }}</td>
									<td>{{ $mpo->orders['actual'] }}</td>
									<td style="text-align: center;">{{ $mpo->collections['target'] }}</td>
									<td style="text-align: center;">{{ $mpo->collections['target'] }}</td>
								</tr>
								<?php $count++;
								} ?>
								</tbody>

								<tfoot>
									<tr>
										<td colspan="4"><b>Total</b></td>
										<td class="text-center" colspan="2"><b>{{ $total_visits }}</b></td>
										<td class="text-center" colspan="2"><b>{{ $total_orders }}</b></td>
										<td class="text-center" colspan="2"><b>{{ $total_collections }}</b></td>
									</tr>
								</tfoot>

							</table>
						</td>
					</tr>
				</tbody>
			</table><!-- /BODY -->
		</div><!-- /content -->	
	</div>

	<!-- Doctor detail Modal -->
	<div class="modal fade" id="doctorDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Doctor Detail</h4>
				</div>
					<div class="modal-body">

						<div class="portlet-body Details">
							<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Doctor Name:</label>
										</div>
										<div class="col-sm-9" id="doctor_name">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Email:</label>
										</div>
										<div class="col-sm-9" id="doctor_email">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Gender:</label>
										</div>
										<div class="col-sm-9" id="doctor_gender">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Contact Number:</label>
										</div>
										<div class="col-sm-9" id="doctor_contact_number">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Home Address:</label>
										</div>
										<div class="col-sm-9" id="doctor_home_address">
											<p> </p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Chember Address:</label>
										</div>
										<div class="col-sm-9" id="doctor_chamber_address">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Qualification:</label>
										</div>
										<div class="col-sm-9" id="doctor_qualification">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Specialty:</label>
										</div>
										<div class="col-sm-9" id="doctor_speciality">
											<p></p>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-3 text-right">
											<label>Class:</label>
										</div>
										<div class="col-sm-9" id="doctor_class">
											<p></p>
										</div>
									</div>

									<div id="doctor_special_day">
										<div class="row">
											<div class="col-sm-3 text-right">
												<label>Special Day Type:</label>
											</div>
											<div class="col-sm-9">
												<p></p>
											</div>
										</div>

										<div class="row">

											<div class="col-sm-3 text-right">
												<label>Special Day:</label>
											</div>
											<div class="col-sm-9">
												<p></p>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<span class="hidden" id="ajax_loader"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Doctor detail Modal -->
	<div class="modal fade" id="chemistDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Chemist Detail</h4>
				</div>
				<div class="modal-body">

					<div class="portlet-body Details">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Chemist Name:</label>
									</div>
									<div class="col-sm-9" id="chemist_name">

									</div>
								</div>

								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Contact Number:</label>
									</div>
									<div class="col-sm-9" id="chemist_contact_number">

									</div>
								</div>

								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Chemist Address:</label>
									</div>
									<div class="col-sm-9" id="chemist_address">

									</div>
								</div>

								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Territory:</label>
									</div>
									<div class="col-sm-9" id="chemist_territory">

									</div>
								</div>

								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Class:</label>
									</div>
									<div class="col-sm-9" id="chemist_class">

									</div>
								</div>

								<div class="row">
									<div class="col-sm-3 text-right">
										<label>Category:</label>
									</div>
									<div class="col-sm-9" id="chemist_category">
										<p></p>
									</div>
								</div>
								<div id="chemist_special_day">

								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<span class="hidden" id="ajax_loader"><img style="width: 35px;" src="{{ asset('assets/custom/images/ajax-loader.gif') }}"></span>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


@endsection

@section('js')
    <script type="text/javascript">
    	$('.no-config-datatable').DataTable({
			"searching": false,
			"ordering": false,
		    "info":     false
		});
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

		$(document).on('change','#date_filter',function(){
			$('#date_filter_form').submit();
		})

		function show_report(date){
			$('#date_filter').val(date);
			$('#date_filter_form').submit();
		}

        function show_doctor_detail(doctor_id){
            var url = '{{ url('/get_doctor_detail_ajax') }}';
            var dataString = {
                _token: "{{ csrf_token() }}",
                doctor_id:doctor_id
            };
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                dataType: "json",
                cache : false,
                success: function(data){ console.log(data);
                    if(data.status == 200){
                        var contact = '';
                        var home_address = '';
                        var chamber_address = '';
                        var specialities = '';
                        var special_day = '';
                        $('#doctor_name').text(data.doctor.name);
                        $('#doctor_email').text(data.doctor.email);
                        $('#doctor_gender').text(data.doctor.gender);
                        $.each( data.doctor.contacts, function( index, value ){
                            contact += value.contact_no;
                            if(index < data.doctor.contacts.length-1){
                                contact += ',';
                            }
                        });
                        $('#doctor_contact_number').text(contact);

                        $.each( data.doctor.home_address, function( index, value ){
                            home_address += '<p>'+value.address_line1+'<br>';
                            home_address += value.thana_name+'<br>';
                            home_address += value.district_name+'<br>';
                            home_address += value.division_name+' '+value.zip_code+'<br>';
                            home_address += '</p>';
                        });
                        $('#doctor_home_address').html(home_address);

                        $.each( data.doctor.chambers, function( index, value ){
                            chamber_address += '<p>'+value.address_line1+'<br>';
                            chamber_address += value.thana_name+'<br>';
                            chamber_address += value.district_name+'<br>';
                            chamber_address += value.division_name+' '+value.zip_code+'<br>';
                            chamber_address += '</p>';
                        });
                        $('#doctor_chamber_address').html(chamber_address);

                        $('#doctor_qualification').text(data.doctor.qualification);

                        $.each( data.doctor.doctor_specialities, function( index, value ){
                            specialities += value.name;
                            if(index < data.doctor.doctor_specialities.length-1){
                                specialities += ',';
                            }
                        });
                        $('#doctor_speciality').html(specialities);

                        if(data.doctor.class_name==null){
                            $('#doctor_class').text('');
                        }
                        else{
                            $('#doctor_class').text(data.doctor.class_name);
                        }

                        $.each( data.doctor.special_days, function( index, value ){
                            special_day += '<div class="row">';
                            special_day += '<div class="col-sm-3 text-right">';
                            special_day += '<label>Special Day Type:</label>';
                            special_day += '</div>';
                            special_day += '<div class="col-sm-9">';
                            special_day += value.name;
                            special_day += '</div>';
                            special_day += '</div>';

                            special_day += '<div class="row">';

                            special_day += '<div class="col-sm-3 text-right">';
                            special_day += '<label>Special Day:</label>';
                            special_day += '</div>';
                            special_day += '<div class="col-sm-9">';
                            special_day += value.date;
                            special_day += '</div>';
                            special_day += '</div>';
                        });
                        $('#doctor_special_day').html(special_day);

                        $('#doctorDetailModal').modal('show');
                    }

                    if(data.status == 401){

                    }


                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }

        function show_chemist_detail(chemist_id){
            var url = '{{ url('/get_chemist_detail_ajax') }}';
            var dataString = {
                _token: "{{ csrf_token() }}",
                chemist_id:chemist_id
            };
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                dataType: "json",
                cache : false,
                success: function(data){ console.log(data);
                    if(data.status == 200){
                        var contact = '';
                        var home_address = '';
                        var chamber_address = '';
                        var territories = '';
                        var special_day = '';
                        $('#chemist_name').text(data.chemist.name);
                        $.each( data.chemist.contacts, function( index, value ){
                            contact += value.contact_no;
                            if(index < data.chemist.contacts.length-1){
                                contact += ',';
                            }
                        });
                        $('#chemist_contact_number').text(contact);

                        $.each( data.chemist.chemist_address, function( index, value ){
                            home_address += '<p>'+value.address_line1+'<br>';
                            home_address += value.thana_name+'<br>';
                            home_address += value.district_name+'<br>';
                            home_address += value.division_name+' '+value.zip_code+'<br>';
                            home_address += '</p>';
                        });
                        $('#chemist_address').html(home_address);

                        $('#doctor_qualification').text(data.chemist.qualification);

                        $.each( data.chemist.territories, function( index, value ){
                            territories += value.name;
                            if(index < data.chemist.territories.length-1){
                                territories += ',';
                            }
                        });
                        $('#chemist_territory').html(territories);

                        $('#chemist_class').text(data.chemist.class_name);
                        $('#chemist_category').html(data.chemist.category_name);

                        $.each( data.chemist.special_days, function( index, value ){
                            special_day += '<div class="row">';
                            special_day += '<div class="col-sm-3 text-right">';
                            special_day += '<label>Special Day Type:</label>';
                            special_day += '</div>';
                            special_day += '<div class="col-sm-9">';
                            special_day += value.name;
                            special_day += '</div>';
                            special_day += '</div>';

                            special_day += '<div class="row">';

                            special_day += '<div class="col-sm-3 text-right">';
                            special_day += '<label>Special Day:</label>';
                            special_day += '</div>';
                            special_day += '<div class="col-sm-9">';
                            special_day += value.date;
                            special_day += '</div>';
                            special_day += '</div>';
                        });
                        $('#chemist_special_day').html(special_day);

                        $('#chemistDetailModal').modal('show');
                    }

                    if(data.status == 401){

                    }


                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        }
	</script>
@endsection