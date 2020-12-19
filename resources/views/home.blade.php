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
                <span>Dashboard</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

	<div class="row m-t-25">
    	<div class="col-lg-12">

	      	<div class="row">
		        <div class="col-lg-8">
		          	<!-- Example Bar Chart Card-->
		          	<div class="portlet light bordered" id="db_bar_chart">
						<div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-bar-chart font-dark hide"></i>
			                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-bar-chart"></i> Top 5 products recommened by doctors</span>
			                    <!-- <span class="caption-helper">weekly stats...</span> -->
			                </div>
			            </div>

			            <div class="portlet-body">
			            	<canvas id="myBarChart" width="100" height="50"></canvas>
			            </div>
		          	</div>
		        </div>

		        <div class="col-lg-4">
		          	<!-- Example Pie Chart Card-->
		          	<!-- Example Pie Chart Card-->
		          	<div class="portlet light bordered" id="db_pie_chart">
						<div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-bar-chart font-dark hide"></i>
			                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-pie-chart"></i> Prescription by division (monthly)</span>
			                    <!-- <span class="caption-helper">weekly stats...</span> -->
			                </div>
			            </div>

			            <div class="portlet-body">
			            	<canvas id="myPieChart" width="100%" height="100" style=""></canvas>
			            </div>
		          	</div>
		        </div>
	      	</div>

	      	<!-- Example DataTables Card-->
	      	<div class="row">
	      		<div class="col-lg-12">
			      	<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Top 10 doctors (monthly)</span>
				                <!-- <span class="caption-helper">weekly stats...</span> -->
				            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">
					            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					              	<thead>
						                <tr>
						                  <th class="w10">Sl. No.</th>
						                  <th>Doctor Name</th>
						                  <th class="text-center">Total Hits</th>
						                </tr>
					              	</thead>
					              	<tbody>
						                <tr>
						                  <td>01</td>
						                  	<td>Doctor 02</td>
						                  	<td class="text-center">13</td>
						                </tr>

						                <tr>
						                  <td>02</td>
						                  	<td>Doctor 05</td>
						                  	<td class="text-center">7</td>
						                </tr>

						                <tr>
						                  <td>03</td>
						                  	<td>Doctor 06</td>
						                  	<td class="text-center">13</td>
						                </tr>

						                <tr>
						                  <td>04</td>
						                  	<td>Doctor 10</td>
						                  	<td class="text-center">27</td>
						                </tr>

						                <tr>
						                  <td>05</td>
						                  	<td>Doctor 05</td>
						                  	<td class="text-center">17</td>
						                </tr>

						                <tr>
						                  <td>06</td>
						                  	<td>Doctor 11</td>
						                  	<td class="text-center">20</td>
						                </tr>

						                <tr>
						                  <td>07</td>
						                  	<td>Doctor 12</td>
						                  	<td class="text-center">6</td>
						                </tr>

						            </tfoot>
					            </table>
				          	</div>
				        </div>
				  	</div>
		  		</div>
	      	</div>
		</div>
	</div>
    <!-- /.container-fluid-->
@endsection

@section('js')
	
@endsection