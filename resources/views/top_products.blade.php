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
                <span> Top Shown Products</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Top Shown Products</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
		                    <div class="row	">
		                        <div class="col-sm-12 col-xs-12">

									<table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <th class="w100">Sl. No.</th>
							                  <th class="">Product Name</th>
							                  <th class="w200">Total Hit</th>
							                </tr>
						              	</thead>
						              	<tbody>
							                <tr>
							                  	<td>01</td>
							                  	<td>Product 01</td>
							                  	<td>1200</td>
							                </tr>

							                <tr>
							                  	<td>02</td>
							                  	<td>Product 02</td>
							                  	<td>150</td>
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

@endsection

@section('js')
    <script>

    </script>
@endsection