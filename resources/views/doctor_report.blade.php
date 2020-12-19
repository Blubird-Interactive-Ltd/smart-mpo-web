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
                <span> Doctor DCR</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Doctor DCR</span>
				            </div>

				            <div class="actions">
				            	<span class="print-option">
                        			<a href="javascript:;" title="Print">
				                        <img src="{{ asset('assets/custom/images/printer.png') }}" alt="Print"/>
				                    </a>
                        		</span>
				            </div>	
				        </div>

				        <div class="portlet-body Details">
		                    <div class="row	">
		                        <div class="col-sm-12 col-xs-12">
		                        	<input class="form-control datepicker double_filter_01" placeholder="Filter by Start Date" id="">
		                        	<input class="form-control datepicker double_filter_02" placeholder="Filter by End Date" id="">

									<table class="table table-bordered datatable" id="" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <th class="w100">Sl. No.</th>
							                  <th class="w100">Date</th>
							                  <th class="">MPO Name</th>
							                  <th class="">Chemist Name</th>
							                  <th class="">Product Name</th>
							                  <th class="">Order Value </th>
							                  <th class="">Collection </th>
							                </tr>
						              	</thead>
						              	<tbody>
							                <tr>
							                  	<td>01</td>
							                  	<td>12/12/2018</td>
							                  	<td>
							                  		Lorem Ipsum
							                  		<i class="font-11">#123, Tarritory01</i>
							                  	</td>
							                  	<td>
							                  		Lorem Dolor
							                  		<i class="font-11">Some summery text goes here...</i>
							                  	</td>
							                  	<td class="">Product 01</td>
							                  	<td class="">1500</td>
							                  	<td class="">1000</td>
							                </tr>

							                <tr>
							                  	<td>02</td>
							                  	<td>12/12/2018</td>
							                  	<td>
							                  		Lorem Ipsum
							                  		<i class="font-11">#123, Tarritory01</i>
							                  	</td>
							                  	<td>
							                  		Lorem Dolor
							                  		<i class="font-11">Some summery text goes here...</i>
							                  	</td>
							                  	<td class="">Product 01</td>
							                  	<td class="">1500</td>
							                  	<td class="">1000</td>
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