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
                <span>Profile</span>
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
				                <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Profile Details</span>
				            </div>
				        </div>

				        <div class="portlet-body Details">
				        	<div class="row">
				        		<div class="col-sm-12">
				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>User name:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->user_id }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>User Type:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->role }}</p>
				        				</div>
				        			</div>

									@if(Auth::user()->role_id != 1)
				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>{{ $users->userParent->role }} Name:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->userParent->first_name.' '.$users->userParent->last_name }} </p>
				        				</div>
				        			</div>
				        			

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>{{ $users->locType }} :</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p> {{ $users->location }} </p>
				        				</div>
				        			</div>
				        			@endif
									
									<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Full Name:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->first_name.' '.$users->last_name  }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>HR Code:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>#{{ $users->hr_port }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Account Code:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->account_port }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Home Contact:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->home_contact  }}</p>
										</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Work Contact:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->work_contact }}</p>
										</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>Email:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->email }}</p>
				        				</div>
				        			</div>

				        			<div class="row">
				        				<div class="col-sm-3 text-right">
				        					<label>IMEI:</label>
				        				</div>
				        				<div class="col-sm-9">
				        					<p>{{ $users->active_imei }}</p>
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