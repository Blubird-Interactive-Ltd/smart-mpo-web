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
				@if(\App\Utility::userRolePermission(Session::get('role_id'),1))
		        <div class="col-lg-8">
		          	<!-- Example Bar Chart Card-->
		          	<div class="portlet light bordered" id="db_bar_chart">
						<div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-bar-chart font-dark hide"></i>
			                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-bar-chart"></i> Top 5 products RECOMMENDED by doctors</span>
			                    <!-- <span class="caption-helper">weekly stats...</span> -->
			                </div>
			            </div>

			            <div class="portlet-body">
			            	<canvas id="myBarChart" width="100" height="50"></canvas>
			            </div>
		          	</div>
		        </div>
				@endif


				@if(\App\Utility::userRolePermission(Session::get('role_id'),2))
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
			@endif

	      	<!-- Example DataTables Card-->
	      	<div class="row">

				@if(\App\Utility::userRolePermission(Session::get('role_id'),3))
	      		<div class="col-lg-6">
			      	<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Top 10 doctors</span>
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
					              	<tbody><?php $num=1; ?>
					              	@if(isset($topDoctor))	
									@foreach($topDoctor as $key => $val)
										@if($key < 10)
						                <tr>
						                  <td>{{ $num }}</td>
						                  	<td>{{ $topDoctor[$key]['docName'] }}</td>
						                  	<td class="text-center">{{ $topDoctor[$key]['count'] }}</td>
						                </tr><?php $num++; ?>
						                @endif
						            @endforeach 
						            @endif   
						            </tbody>
					            </table>
				          	</div>
				        </div>
				  	</div>
		  		</div>
				@endif

				@if(\App\Utility::userRolePermission(Session::get('role_id'),4))
		  		<div class="col-lg-6">
			      	<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Top 10 Product Show </span>
				                <!-- <span class="caption-helper">weekly stats...</span> -->
				            </div>
				        </div>

				        <div class="portlet-body">
				        	<div class="">
					            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					              	<thead>
						                <tr>
						                  <th class="w10">Sl. No.</th>
						                  <th>Produuct Name</th>
						                  <th class="text-center">Total Hits</th>
						                </tr>
					              	</thead>
					              	<tbody><?php $num=1; ?>
					              	@if(isset($topProduct))	
									@foreach($topProduct as $key => $val)
										@if($key < 10)
						                <tr>
						                  <td>{{ $num }}</td>
						                  	<td>{{ $topProduct[$key]['pro'] }}</td>
						                  	<td class="text-center">{{ $topProduct[$key]['count'] }}</td>
						                </tr><?php $num++; ?>
						                @endif
						            @endforeach 
						            @endif   
						            </tbody>
					            </table>
				          	</div>
				        </div>
				  	</div>
		  		</div>
				@endif
	      	</div>
		</div>
	</div>

<?php 
// if (isset($topProByDoc)) {
// 	foreach ($topProByDoc as $key => $value) {
// 		$name = '". $topProByDoc[$key][] .",';
// 	}
// }
?>

    <!-- /.container-fluid-->
@endsection

@section('js')
<script type="text/javascript">
// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example

@if(\App\Utility::userRolePermission(Session::get('role_id'),1))
// -- Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
    @if(isset($topProByDoc))
    @foreach($topProByDoc as $key => $val)
    @if($key < 5)
     "{{ $topProByDoc[$key]['proName'] }}",
     @endif
     @endforeach
     @endif
     ],
    datasets: [{
      label: "Doctor Recommended",
      backgroundColor: "#3c9aea",
      borderColor: "rgba(2,117,216,1)",
      data: [
      @if(isset($topProByDoc))
      @foreach($topProByDoc as $key => $val)
      @if($key < 5)
     {{ $topProByDoc[$key]['count'] }},
     @endif
     @endforeach
     @endif
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
@endif


@if(\App\Utility::userRolePermission(Session::get('role_id'),2))
// -- Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [
    @if(isset($prescription))
    @foreach($prescription as $key => $p)
    @if($key < 8)
     "{{ $prescription[$key]['divName'] }}",
     @endif
     @endforeach
     @endif
    ],
    datasets: [{
      data: [
      @if(isset($prescription))
      @foreach($prescription as $key => $p)
      @if($key < 8)
     {{ $prescription[$key]['count'] }},
     @endif
     @endforeach
     @endif			
      ],
      backgroundColor: ['#007bff', '#ff84fa', '#FF8200', '#16CC81','#1226FF', '#dc3543', '#ffd659', '#40FFFD'],
    }],
  },
});
@endif
	

</script>
@endsection