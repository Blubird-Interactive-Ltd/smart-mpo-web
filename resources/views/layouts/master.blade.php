<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->

    <!-- Head sections  -->
    @include('layouts.includes.head')

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-full-width page-md">

    <!-- Header sections  -->
    @include('layouts.includes.header')

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
    <div>
        <table class="table" id="doctor_event_table" style="display:none">
            <thead>
                <tr>
                    <th><strong>S/N</strong></th>
                    <th><strong>Name of Doctor</strong></th>
                    <th><strong>Gender</strong></th>
                    <th><strong>Qualification (Degree)</strong></th>
                    <th><strong>Specialty</strong></th>
                    <th><strong>Class A/B/C</strong></th>
                    <th><strong>Honorarium</strong></th>
                    <th><strong>Mobile No.</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Event name</strong></th>
                    <th><strong>Date</strong></th>
                </tr>
            </thead>
            <tbody id="doctor_event_list">

            </tbody>
        </table>
    </div>
    <!-- Header sections  -->
    @include('layouts.includes.footer')

    @yield('js')

    <script>
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "{{ url('doctor_events') }}",
                data: {},
                dataType: "JSON",
                cache : false,
                beforeSend: function() {

                },
                success: function(data){ console.log(data);
                    if(data.status == 200){
                        $('#doctor_event_list').html(data.events);
                    }
                    if(data.status == 401){
                        show_success_message(data);                }
                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        })

        function download_excel(){
            var d = new Date();
            var today = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();

            $("#doctor_event_table").table2excel({
                exclude: ".noExl",
                name: "Concord doctor event",
                filename: "doctor-event-"+today+".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        }
    </script>

    </body>

</html>