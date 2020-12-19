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
                <span> Notifications</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Notifications</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
		                    <div class="row	">
		                        <div class="col-sm-12 col-xs-12">

									<table class="table table-bordered datatable" id="notify-table" width="100%" cellspacing="0">
						              	<thead>
							                <tr>
							                  <th class="w70">Sl. No.</th>
							                  <th class="">Title</th>
							                  <th class="w100 text-center">Date</th>
							                </tr>
						              	</thead>
						              	<tbody>
							                <tr>
							                  	<td>01</td>
							                  	<td>
							                  		<a class="notification_title unread" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
							                </tr>
							                <tr>
							                  	<td>02</td>
							                  	<td>
							                  		<a class="notification_title unread" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
							                </tr>
							                <tr>
							                  	<td>03</td>
							                  	<td>
							                  		<a class="notification_title" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
							                </tr>

							                <tr>
							                  	<td>04</td>
							                  	<td>
							                  		<a class="notification_title" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
							                </tr>
							                <tr>
							                  	<td>05</td>
							                  	<td>
							                  		<a class="notification_title" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
							                </tr>
							                 <tr>
							                  	<td>06</td>
							                  	<td>
							                  		<a class="notification_title" href="javascript:;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, sed.</a>
							                  	</td>
							                  	<td class="text-center">12/12/2018</td>
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

	<!-- Notification modal START-->
	<div id="notification_details_modal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Details</h4>
		      	</div>
		      	<div class="modal-body">
		      		<h4 class="no-margin"><b>Lorem ipsum dolor sit amet, consectetur.</b></h4>
		      		<p class="font-11 no-margin"><i>12/12/2018</i></p>
		        	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet incidunt iste atque excepturi? Obcaecati placeat rerum tempore vero aut, ea rem magnam alias voluptate similique.</p>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
		    </div>

	  	</div>
	</div>
	<!-- Accept /reject modal END-->

@endsection

@section('js')
    <script>

    </script>
@endsection