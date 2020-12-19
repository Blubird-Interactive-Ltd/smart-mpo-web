        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('assets/custom/images/logo_con.png') }}" alt="logo" class="logo-default" />
                        <!-- <p>Sustainability Platform</p -->
                    </a>
                </div>
                <!-- END LOGO -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> <span class="font-400"><!-- You are logged in as --></span> {{ Session::get('first_name')." ".Session::get('last_name') }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">

                                @if(\App\Utility::userRolePermission(Session::get('role_id'),73))
                                <li>
                                    <a href="{{'profile'}}"><i class="icon-people icons"></i>Profile 
                                    </a>
                                </li>
                                @endif

                                <li class="divider"> </li>
                                <li>
                                    <a href="{{'logout'}}">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->

            <div class="secondary_main_nav">
                <!-- BEGIN MEGA MENU -->
                <div class="hor-menu   hidden-sm" id="hr_top_menu">
                    <ul class="nav navbar-nav navbar-collapse collapse">
                        <li class="classic-menu-dropdown @if($page=='Dashboard') active @endif">
                            <a href="{{ url('dashboard')}}">
                                Dashboard
                                @if($page=='Dashboard') <span class="selected"> </span> @endif
                            </a>
                        </li>

                        <li class="classic-menu-dropdown @if($page=='Product') active @endif">
                            <a href="{{url('product_list')}}">
                                Products
                                @if($page=='Product') <span class="selected"> </span> @endif
                            </a>
                        </li>

                        <li class="classic-menu-dropdown @if($page=='Doctor') active @endif">
                            <a href="{{url('doctor_list')}}">
                                Doctors
                                @if($page=='Doctor') <span class="selected"> </span> @endif
                            </a>
                        </li>

                        <li class="classic-menu-dropdown @if($page=='Chemist') active @endif">
                            <a href="{{url('chemist_list')}}">
                                Chemists
                                @if($page=='Chemist') <span class="selected"> </span> @endif
                            </a>
                        </li>

                        <li class="classic-menu-dropdown @if($page=='Prescription') active @endif">
                            <a href="{{url('prescription')}}">
                                Prescriptions
                                @if($page=='Prescription') <span class="selected"> </span> @endif
                            </a>
                        </li>   
                        <li class="classic-menu-dropdown @if($page=='Report') active @endif">
                            <a href="javascript:;"> 
                                Reports
                                <i class="fa fa-angle-down"></i>
                                @if($page=='Report') <span class="selected"> </span> @endif
                            </a>
                            <ul class="dropdown-menu pull-left">
                                @if(Session::get('role_id')==4)
                                    <li>
                                        <a href="{{url('am_report',Session::get('id'))}}">
                                            AM DCR
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{url('am_list')}}">
                                            AM DCR
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('mpo_list')}}">
                                        MPO DCR
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('prescription_report')}}">
                                        Prescription
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('zone_report')}}">
                                        Zone Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('report_activity')}}">
                                        Activity
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('report_order')}}">
                                        Order Collection 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="classic-menu-dropdown @if($page=='Setting') active @endif">
                            <a href="javascript:;"> 
                                Settings
                                <i class="fa fa-angle-down"></i>
                                @if($page=='Setting') <span class="selected"> </span> @endif
                            </a>
                            <ul class="dropdown-menu pull-left">
                                <li>
                                    <a href="{{url('setup_target')}}">
                                        Setup Target
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('setup_user')}}">
                                        Setup User 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('user_role_permission')}}">
                                        User role Permission
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('setup_location')}}">
                                         Setup Location
                                    </a>
                                </li>
                                <!--li>
                                    <a href="{{url('location_maping')}}">
                                         Location Maping
                                    </a>
                                </li-->
                                <li>
                                    <a href="{{'chemist_category'}}">
                                         Chemist Category setup
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('create_dspDay')}}">
                                        Create Special Day
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/create_doctor_speciality')}}">
                                         Create Doctor Specialty  
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('create_doctor_class')}}">
                                        Create Doctor Class
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{url('create_chemist_class')}}">
                                        Create Chemist Class
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:;">
                                        Special day Type
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li>
                                            <a href="{{url('chemist_sp_day_type')}}">
                                                Chemist
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('doctor_sp_day_type')}}">
                                                Doctor
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </li>

                    @if(\App\Utility::userRolePermission(Session::get('role_id'),76))
                        <li class="classic-menu-dropdown">
                            <a href="#" onclick="download_excel()">
                                Download Doctor Event
                            </a>
                        </li>
                    @endif

                    @if(\App\Utility::userRolePermission(Session::get('role_id'),72))
                        <!--li class="classic-menu-dropdown @if($page=='Notification') active @endif">
                            <a href="{{'notifications'}}"> 
                                Notification
                                <span class="badge badge-default notify-badge">4</span>
                                @if($page=='Notification') <span class="selected"> </span> @endif
                            </a>
                            <div class="dropdown-menu pull-right notify-list">
                                <ul>
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                                    </li>
                                     <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                                    </li>
                                     <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                                    </li>
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                    </li>
                                </ul>
                                <ul class="view-all">
                                    <li>
                                        <a href="#">View all</a>
                                    </li>
                                </ul>
                            </div>
                        </li-->
                        @endif
                    </ul>
                </div>
                <!-- END MEGA MENU -->
            </div>
        </div>
        <!-- END HEADER -->