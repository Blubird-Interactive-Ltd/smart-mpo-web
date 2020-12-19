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
                <span>Order Collection</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
		
	<div class="row m-t-25">
		<div class="col-lg-12">
			<div class="row">
	      		<div class="col-lg-8 col-lg-offset-2 col-sm-12">
			      	<div class="portlet light bordered">
						<div class="portlet-title">
				            <div class="caption">
				                <i class="icon-bar-chart font-dark hide"></i>
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Order Collection</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
				        	<div class="row m-b-20">
				        		<div class="col-sm-12">
				        			<div class="form-inline m-b-20 text-center">
				        				<label for="">Date</label>
				        				<div class="input-group">
											<form id="search_form" method="post" action="{{ url('report_order') }}">
												{{ csrf_field() }}
												<input class="form-control order_datepicker" name="date">
												<div class="input-group-btn">
													<button class="btn btn-success" type="submit">search</button>
												</div>
											</form>
										</div>	
				        			</div>
				        		</div>

				        		<div class="col-sm-6 col-xs-12 text-center">
				        			<h3>Total Collection: {{ $chemist_dcr->total_collection !='' ? $chemist_dcr->total_collection : 0 }}</h3>
				        		</div>
				        		<div class="col-sm-6 col-xs-12 text-center">
				        			<h3>Order Value: {{ $chemist_dcr->total_order !='' ? $chemist_dcr->total_order : 0 }}</h3>
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
	    $('.order_datepicker').datepicker().datepicker("setDate", "{{ Session::get('report_order_date') }}");
    </script>
@endsection