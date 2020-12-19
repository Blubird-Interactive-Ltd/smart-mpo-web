@extends('layouts.master')
@section('content')
	<style type="text/css">
		#print *{display: none;}
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
		.w70{
			width: 70px;
			min-width: 70px;
			max-width: 70px;
		}
		.zone_name {
			padding: 0;
		}
		.zone_name>p {
			font-size: 12px;
			font-weight: 600;
			letter-spacing: 1px;
			transform: rotate(-90deg);
			-webkit-transform: rotate(-90deg);
			-moz-transform: rotate(-90deg);
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
				<span> MPO DCR</span>
			</li>
		</ul>
	</div>
	<!-- END PAGE BAR -->

	<div class="row m-t-25">
		<div class="col-lg-12">

		@if(\App\Utility::userRolePermission(Session::get('role_id'),23))
			<!-- Audit List-->
				<div class="row">
					<div class="col-sm-12">
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-bar-chart font-dark hide"></i>
									<span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Zone Report</span>
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

										<!-- HEADER -->
										<table class="head-wrap">
											<tr>
												<td class="header" >
													<div class="content" style="max-width: 100%;">

														<table class="head-wrap">
															<tr>
																<td class="header" >
																	<div class="content" style="max-width: 95%;">

																		<table>
																			<tr>
																				<td>
																					<b>Date:</b> {{ date('d/m/Y',strtotime(Session::get('zone_report_date'))) }} <br>
																				</td>

																				<td>
																					<div class="form-group form-md-line-input pull-right" style="max-width: 300px; margin-bottom: 10px;">
																						<form id="date_filter_form" method="post" action="">
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
													</div>
												</td>
											</tr>
										</table><!-- /HEADER -->

										<!-- BODY -->
										<div class="content table-responsive" style="max-width: 95%;">

                                            <?php
                                            $next_day = $stop_date = date('Y-m-d', strtotime($last_date . ' +1 day'));
                                            $previous_day = $stop_date = date('Y-m-d', strtotime($last_date . ' -1 day'));
                                            ?>
											<table class="body-wrap table">
												<tbody>
												<tr>
													<td colspan="2">
														<!-- <h6 class="xs-margin-auto" style="text-align: center; margin-bottom: 10px;">Doctor Visit</h6> -->

														<table class="border-table m-t-20">
															<tbody>
															<tr>
																<td></td>
																<td colspan="4" style="text-align: center"><b>Rx Report</b></td>
																<td colspan="2" style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_date'))) }}</b></td>
																<td style="text-align: center"><b>Today Rx</b></td>
																<td style="text-align: center"><b>Current Month Rx</b></td>
																<td style="text-align: center"><b>Last Month Rx</b></td>
																<td style="text-align: center" rowspan="2"><b>Comparison</b></td>
																<td style="text-align: center" rowspan="2"><b>Last Month Total</b></td>
															</tr>
                                                            <?php
															$zone_count = 1;
                                                            $region_count = 1;
															?>
															@foreach($zones as $zone)
																@if(count($zone->regions)!=0)
																	@if($zone_count==1)
																	<tr>
																		<td class="zone_name" style="text-align: center; width: 60px; height: 150px;" rowspan="{{ count($zone->regions)+1 }}"><p>{{ $zone->zone_name }}</p></td>
																		<td><b>SL#</b></td>
																		<td style="text-align: center" width="100px"><b>Region</b></td>
																		<td style="text-align: center" ><b>No. of AM</b></td>
																		<td style="text-align: center" ><b>No. of MPO</b></td>
																		<td style="text-align: center"><b>Rx Accepted</b></td>
																		<td style="text-align: center"><b>Rx Rejected</b></td>
																		<td style="text-align: center"><b>Total</b></td>
																		<td style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_date'))) }}</b></td>
																		<td style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_last_month_date'))) }}</b></td>
																	</tr>
																	@endif

																	<?php
																	$zone_row = 1;
																	$total_ams = 0;
																	$total_mpos = 0;
																	$total_rx_accepted = 0;
																	$total_rx_rejected = 0;
																	$rx_total = 0;
																	$current_month_rx = 0;
																	$last_month_rx = 0;
																	$total_comparison = 0;
																	$total_last_month_total_rx = 0;
																	?>
																	@foreach($zone->regions as $region)
																		<?php
																		$comparison = $region->prescription_this_month[0]->total-$region->prescription_last_month[0]->total;
                                                                        $total_comparison = $total_comparison+$comparison;
                                                                        $total_ams = $total_ams+$region->ams;
                                                                        $total_mpos = $total_mpos+$region->mpos;
                                                                        $total_rx_accepted = $total_rx_accepted+$region->current_date_prescriptions[0]->accepted;
                                                                        $total_rx_rejected = $total_rx_rejected+$region->current_date_prescriptions[0]->rejected;
                                                                        $rx_total = $rx_total+$region->current_date_prescriptions[0]->total;
                                                                        $current_month_rx = $current_month_rx+$region->prescription_this_month[0]->total;
                                                                        $last_month_rx = $last_month_rx+$region->prescription_last_month[0]->total;
                                                                        $total_last_month_total_rx = $total_last_month_total_rx+$region->prescription_last_month_total[0]->total;
                                                                        ?>
																		<tr>
																			@if($zone_count > 1 && $zone_row==1)
																			<td class="zone_name" style="text-align: center; width: 70px; height: 150px;" rowspan="{{ count($zone->regions) }}"><p>{{ $zone->zone_name }}</p></td>
																			@endif
																			<td style="text-align: center">{{ $region_count }}</td>
																			<td style="text-align: center">{{ $region->first_name." ".$region->last_name }}</td>
																			<td style="text-align: center">{{ $region->ams }}</td>
																			<td style="text-align: center">{{ $region->mpos }}</td>
																			<td style="text-align: center">{{ $region->current_date_prescriptions[0]->accepted!='' ? $region->current_date_prescriptions[0]->accepted : 0  }}</td>
																			<td style="text-align: center">{{ $region->current_date_prescriptions[0]->rejected!='' ? $region->current_date_prescriptions[0]->rejected : 0  }}</td>
																			<td style="text-align: center">{{ $region->current_date_prescriptions[0]->total ? $region->current_date_prescriptions[0]->total : 0 }}</td>
																			<td style="text-align: center">{{ $region->prescription_this_month[0]->total!='' ? $region->prescription_this_month[0]->total : 0  }}</td>
																			<td style="text-align: center">{{ $region->prescription_last_month[0]->total!=0 ? $region->prescription_last_month[0]->total : 0 }}</td>
																			<td style="text-align: center"><span class="compare_icon" style="margin-left: 10px; float: left;"><i class="fa @if($comparison<0) fa-angle-down @elseif($comparison>0) fa-angle-up @endif"></i></span>{{ $comparison }}</td>
																				<td style="text-align: center">{{ $region->prescription_last_month_total[0]->total!='' ? $region->prescription_last_month_total[0]->total : 0 }}</td>
																		</tr>
                                                                        <?php
																		$region_count++;
                                                                        $zone_row++;?>
																	@endforeach

																	<tr>
																		<td  style="text-align: center" colspan="3"><b>{{ $zone->first_name." ".$zone->last_name }}<b></td>
																		<td  style="text-align: center">{{ $total_ams }}</td>
																		<td  style="text-align: center">{{ $total_mpos }}</td>
																		<td  style="text-align: center">{{ $total_rx_accepted }}</td>
																		<td  style="text-align: center">{{ $total_rx_rejected }}</td>
																		<td  style="text-align: center">{{ $rx_total }}</td>
																		<td  style="text-align: center">{{ $current_month_rx }}</td>
																		<td  style="text-align: center">{{ $last_month_rx }}</td>
																		<td  style="text-align: center"><span class="compare_icon" style="margin-left: 10px; float: left;"><i class="fa @if($total_comparison<0) fa-angle-down @elseif($total_comparison>0) fa-angle-up @endif"></i></span>{{ $total_comparison }}</td>
																		<td  style="text-align: center">{{ $total_last_month_total_rx }}</td>
																	</tr>
                                                                    <?php $zone_count++; ?>
																@endif
															@endforeach
															</tbody>
														</table>
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
		<style>
			@page { size: auto; }
			#print *{margin:0;padding:0}*{font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{margin:0;padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%}a{color:#2ba6cb} .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;} p.callout{padding:15px;background-color:#ecf8ff;margin-bottom:15px}.callout a{font-weight:bold;color:#2ba6cb}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center}a.fb{background-color:#3b5998 !important}a.tw{background-color:#1daced !important}a.gp{background-color:#db4a39 !important}a.ms{background-color:#000 !important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px;padding-left:0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both !important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px}.footer-wrap .container td.content p{font-size:10px;font-weight:bold}h1,h2,h3,h4,h5,h6{font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0 !important}p,ul{margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;margin-right:10px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #fff;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0 !important}.container{display:block !important;max-width:800px !important;margin:0 auto !important;clear:both !important; font-size: 15px;}.content{padding:0px;max-width:800px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0 !important;margin:0 auto;max-width:600px !important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class="btn"]{display:block !important;margin-bottom:10px !important;background-image:none !important;margin-right:0 !important}div[class="column"]{width:auto !important;float:none !important}table.social div[class="column"]{width:auto !important}}
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
			table { page-break-inside:auto }
			tr { page-break-inside:avoid; page-break-after:auto } 
		</style>

		<!-- HEADER -->
		<table class="head-wrap" background="border.png">
			<tr>
				<td class="header container" >
					<div class="content">
						<h6 class="collapse" style="text-align: center;font-size: 24px;margin-bottom: 0px !important;">Concord Pharmaceuticals Ltd</h6>
						<!-- <p align="center">Sima Blossom (11th Floor), House# 3 (New), 390 (Old), Road# 16 (New),</p> -->
						<h6 class="collapse" style="text-align: center; padding-bottom: 5px; margin: 15px auto 0px auto !important; font-size: 16px;">RX Report</h6>
						<h6 class="collapse" style="text-align: center; padding-bottom: 5px; margin: 10px auto 20px auto !important; font-size: 16px; font-weight: 400;">Perpared By Rabbika</h6>
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
						<table class="border-table m-t-20">
							<tbody>
							<tr>
								<td></td>
								<td colspan="4" style="text-align: center"><b>Rx Report</b></td>
								<td colspan="2" style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_date'))) }}</b></td>
								<td style="text-align: center"><b>Today Rx</b></td>
								<td style="text-align: center"><b>Current Month Rx</b></td>
								<td style="text-align: center"><b>Last Month Rx</b></td>
								<td style="text-align: center" rowspan="2"><b>Comparison <span><i class="fa fa-angle-down"></i></span></b></td>
								<td style="text-align: center" rowspan="2"><b>Last Month Total</b></td>
							</tr>
                            <?php
                            $zone_count = 1;
                            $region_count = 1;
                            ?>
							@foreach($zones as $zone)
								@if(count($zone->regions)!=0)
									@if($zone_count==1)
										<tr>
											<td class="zone_name" style="height: 200px; text-align: center; width: 60px;" rowspan="{{ count($zone->regions)+1 }}"><p style="text-align: center; font-size: 12px;font-weight: 600;letter-spacing: 1px;transform: rotate(-90deg);">{{ $zone->zone_name }}</p></td>
											<td><b>SL#</b></td>
											<td style="text-align: center" widtd="80px"><b>Region</b></td>
											<td style="text-align: center" ><b>No. of AM</b></td>
											<td style="text-align: center" ><b>No. of MPO</b></td>
											<td style="text-align: center"><b>Rx Accepted</b></td>
											<td style="text-align: center"><b>Rx Rejected</b></td>
											<td style="text-align: center"><b>Total</b></td>
											<td style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_date'))) }}</b></td>
											<td style="text-align: center"><b>{{ date('d/m/Y',strtotime(Session::get('zone_report_last_month_date'))) }}</b></td>
										</tr>
									@endif

                                    <?php
                                    $zone_row = 1;
                                    $total_ams = 0;
                                    $total_mpos = 0;
                                    $total_rx_accepted = 0;
                                    $total_rx_rejected = 0;
                                    $rx_total = 0;
                                    $current_month_rx = 0;
                                    $last_month_rx = 0;
                                    $total_comparison = 0;
                                    $total_last_month_total_rx = 0;
                                    ?>
									@foreach($zone->regions as $region)
                                        <?php
                                        $comparison = $region->prescription_this_month[0]->total-$region->prescription_last_month[0]->total;
                                        $total_comparison = $total_comparison+$comparison;
                                        $total_ams = $total_ams+$region->ams;
                                        $total_mpos = $total_mpos+$region->mpos;
                                        $total_rx_accepted = $total_rx_accepted+$region->current_date_prescriptions[0]->accepted;
                                        $total_rx_rejected = $total_rx_rejected+$region->current_date_prescriptions[0]->rejected;
                                        $rx_total = $rx_total+$region->current_date_prescriptions[0]->total;
                                        $current_month_rx = $current_month_rx+$region->prescription_this_month[0]->total;
                                        $last_month_rx = $last_month_rx+$region->prescription_last_month[0]->total;
                                        $total_last_month_total_rx = $total_last_month_total_rx+$region->prescription_last_month_total[0]->total;
                                        ?>
										<tr>
											@if($zone_count > 1 && $zone_row==1)
												<td class="zone_name" style="height: 200px; text-align: center; width: 60px;" rowspan="{{ count($zone->regions) }}"><p style="text-align: center; font-size: 12px;font-weight: 600;letter-spacing: 1px;transform: rotate(-90deg);">{{ $zone->zone_name }}</p></td>
											@endif
											<td style="text-align: center">{{ $region_count }}</td>
											<td style="text-align: center">{{ $region->first_name." ".$region->last_name }}</td>
												<td style="text-align: center">{{ $region->ams }}</td>
												<td style="text-align: center">{{ $region->mpos }}</td>
												<td style="text-align: center">{{ $region->current_date_prescriptions[0]->accepted!='' ? $region->current_date_prescriptions[0]->accepted : 0  }}</td>
												<td style="text-align: center">{{ $region->current_date_prescriptions[0]->rejected!='' ? $region->current_date_prescriptions[0]->rejected : 0  }}</td>
												<td style="text-align: center">{{ $region->current_date_prescriptions[0]->total ? $region->current_date_prescriptions[0]->total : 0 }}</td>
												<td style="text-align: center">{{ $region->prescription_this_month[0]->total!='' ? $region->prescription_this_month[0]->total : 0  }}</td>
												<td style="text-align: center">{{ $region->prescription_last_month[0]->total!=0 ? $region->prescription_last_month[0]->total : 0 }}</td>
												<td style="text-align: center"><span class="compare_icon" style="margin-left: 10px; float: left;">@if($comparison<0) &darr; @elseif($comparison>0) &uarr; @endif</span>{{ $comparison }}</td>
												<td style="text-align: center">{{ $region->prescription_last_month_total[0]->total!='' ? $region->prescription_last_month_total[0]->total : 0 }}</td>
										</tr>
                                        <?php
                                        $region_count++;
                                        $zone_row++;?>
									@endforeach

									<tr>
										<td  style="text-align: center" colspan="3"><b>{{ $zone->first_name." ".$zone->last_name }}<b></td>
										<td  style="text-align: center">{{ $total_ams }}</td>
										<td  style="text-align: center">{{ $total_mpos }}</td>
										<td  style="text-align: center">{{ $total_rx_accepted }}</td>
										<td  style="text-align: center">{{ $total_rx_rejected }}</td>
										<td  style="text-align: center">{{ $rx_total }}</td>
										<td  style="text-align: center">{{ $current_month_rx }}</td>
										<td  style="text-align: center">{{ $last_month_rx }}</td>
										<td style="text-align: center"><span style="margin-left: 10px; float: left;">@if($total_comparison<0) &darr; @elseif($total_comparison>0) &uarr; @endif</span>{{ $total_comparison }}</td>
										<td  style="text-align: center">{{ $total_last_month_total_rx }}</td>
									</tr>
                                    <?php $zone_count++; ?>
								@endif
							@endforeach
							</tbody>
						</table>
					</td>
				</tr>
				</tbody>
			</table><!-- /BODY -->
		</div><!-- /content -->
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
            //mywindow.document.write('<html><head><title>my div</title>');
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
	</script>
@endsection