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
				        					<p>Lorem ipsum dolor</p>
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
				        					<p>Male</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Contact Number:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>0427422424</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Home Address:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>Phoenix Tower, 2nd & 3rd Floor<br>
												407, Tejgoan Industrial Area<br>
												Dhaka 1208<br>
												Bangladesh
											</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Chember Address:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>Phoenix Tower, 2nd & 3rd Floor<br>
												407, Tejgoan Industrial Area<br>
												Dhaka 1208<br>
												Bangladesh
											</p>

											<p>C&F Tower, 11th Floor<br>
												No. 1712 (Old No 1222) Sheik Mujib Road<br>
												Agrabad C/A<br>
												Chittagong 4100<br>
												Bangladesh<br>
											</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Qualification:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>FCPS</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Specialty:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>Heart</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Class:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>A</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Special Day Type:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>Birthday</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Special Day:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>12/12/2018</p>
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

@endsection

@section('js')
    <script>

    </script>
@endsection