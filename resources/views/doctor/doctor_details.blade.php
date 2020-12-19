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
                <span>Doctor Details</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Doctor Details</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
				        	<div class="row">
				        		<div class="col-sm-12">
				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Doctor Name:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $doctor->name }}</p>
				        				</div>
				        			</div>
									
									<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Email:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>dolor@gmail.com</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Gender:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $doctor->gender }}</p>
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
												foreach($doctor->contacts as $key=>$contact){
													echo $contact->contact_no;
													if($count < count($doctor->contacts)){
														echo ", ";
													}
													$count++;
												} ?>
											</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Home Address:</label>
				        				</div>
				        				<div class="col-sm-9">
											<?php foreach($doctor->home_address as $key=>$home){ ?>
											<p>{{ $home->address_line1 }}<br>
												{{ $home->thana_name }}<br>
												{{ $home->district_name }}<br>
												{{ $home->division_name." ".$home->zip_code }}<br>
											</p>
											<?php } ?>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Chember Address:</label>
				        				</div>
				        				<div class="col-sm-9">
											<?php foreach($doctor->chambers as $key=>$chamber){ ?>
											<p>{{ $chamber->address_line1 }}<br>
												{{ $chamber->thana_name }}<br>
												{{ $chamber->district_name }}<br>
												{{ $chamber->division_name." ".$chamber->zip_code }}<br>
											</p>
											<?php } ?>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Qualification:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $doctor->qualification }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Specialty:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>
												<?php
												$count = 1;
												foreach($doctor->doctor_specialities as $key=>$speciality){
													echo $speciality->name;
													if($count < count($doctor->doctor_specialities)){
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
				        					<p>{{ $doctor->class_name }}</p>
				        				</div>
				        			</div>

									<?php foreach($doctor->special_days as $key=>$special_day){ ?>
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