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
                <span>Chemist Details</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">

	      	<!-- Audit List-->
	      	<div class="row">
	      		<div class="col-lg-8 col-lg-offset-2 col-sm-12">
			      	<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Chemist Details</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
				        	<div class="row">
				        		<div class="col-sm-12">
				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Chemist Name:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $chemist->name }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Contact Number:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>
												<?php
													$count = 1;
												foreach($chemist->contacts as $key=>$contact){
													echo $contact->contact_no;
													if($count < count($chemist->contacts)){
														echo ", ";
													}
													$count++;
												} ?>
											</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Chemist Address:</label>
				        				</div>
				        				<div class="col-sm-9">
											<?php foreach($chemist->chemist_address as $key=>$address){ ?>
				        					<p>{{ $address->address_line1 }}<br>
												{{ $address->thana_name }}<br>
												{{ $address->district_name }}<br>
												{{ $address->division_name." ".$address->zip_code }}<br>
											</p>
											<?php } ?>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Territory:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>
												<?php
												$count = 1;
												foreach($chemist->territories as $key=>$territory){
													echo $territory->name;
													if($count < count($chemist->territories)){
														echo ", ";
													}
													$count++;
												} ?>
											</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Class:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $chemist->class_name }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Category:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $chemist->category_name }}</p>
				        				</div>
				        			</div>
									<?php foreach($chemist->special_days as $key=>$special_day){ ?>
										<div class="row">
											<div class="col-sm-3 text-right">
												<label>Special Day Type:</label>
											</div>
											<div class="col-sm-9">
												<p>{{ $special_day->name }}</p>
											</div>
										</div>

										<div class="row">

											<div class="col-sm-3 text-right">
												<label>Special Day:</label>
											</div>
											<div class="col-sm-9">
												<p>{{ date('M d, Y', strtotime($special_day->date)) }}</p>
											</div>
										</div>
									<?php } ?>

				        		</div>
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