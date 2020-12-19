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
            <span> Activity List</span>
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
                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-table"></i> Activity List</span>
                        </div>
                    </div>

                    <div class="portlet-body Details">
                        <div class="row	">
                            <div class="col-sm-12">

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<b>Date:</b> {{ date('d/m/Y', strtotime($last_date)) }} <br>
										<b>Total RX Submitted:</b><span id="total_rx_submitted"> 12</span><br>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group form-md-line-input pull-right" style="max-width: 300px; margin-bottom: 20px; padding-top: 0;">
											<form id="date_filter_form" method="post" action="">
                                                {{ csrf_field() }}
												<div class="col-md-12">
													<input type="text" class="form-control input-sm datepicker edited" placeholder="Filter by Date" id="date_filter" name="date">
													<div class="form-control-focus"> </div>
												</div>
											</form>
			                            </div>
									</div>
								</div>

                                <table class="table table-bordered" id="activity_table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="w50 text-center">Sl. No.</th>
                                        <th class="text-center">Zone</th>
                                        <th class="text-center">Number of AM</th>
                                        <th class="text-center">Number of MPO</th>
                                        <th class="text-center">Number of Rx submitted</th>
                                        <th class="w120 text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $zone_count = 1;
                                        $rx_grand_total = 0;
                                        ?>
                                        @foreach($zones as $zone)
                                            @if(count($zone->regions)!=0)
                                                <?php
                                                $total_ams = 0;
                                                $total_mpos = 0;
                                                $rx_total = 0;
                                                ?>
                                                @foreach($zone->regions as $region)
                                                <?php
                                                $total_ams = $total_ams+$region->ams;
                                                $total_mpos = $total_mpos+$region->mpos;
                                                $rx_total = $rx_total+$region->current_date_prescriptions[0]->total;
                                                $rx_grand_total = $rx_grand_total+$region->current_date_prescriptions[0]->total;
                                                ?>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">{{ $zone_count }}</td>
                                                    <td class="text-center">{{ $zone->zone_name."(".$zone->first_name." ".$zone->last_name.")" }}</td>
                                                    <td class="text-center">{{ $total_ams }}</td>
                                                    <td class="text-center">{{ $total_mpos }}</td>
                                                    <td class="text-center">{{ $rx_total }}</td>
                                                    <td class="text-center">
                                                        <div>
                                                            <a title="Download" class="btn btn-sm btn-success xl_download"><i class="fa fa-download" aria-hidden="true"></i></a>

                                                            <div class="input-group downloadpicker m-t-10 hidden">
                                                                <input type="text" class="form-control downloaddatepicker activity_date" style="height: 28px;">
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-success downloadpicker_btn" data-id="{{ $zone->zsm_id }}"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $zone_count++; ?>
                                            @endif
                                        @endforeach
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


<table class="table hidden" id="myTable">
  <thead>
    <tr>
      <th colspan="4" rowspan="4">
            <h2>Concord Pharmaceutical</h2>
            <h4>Date: {{ date('d/m/Y', strtotime($last_date)) }}</h4>
            <h4>Zone Name: <span id="zone_name">Dhaka</span></h4>
            <h4>Total AM: <span id="total_am">120</span></h4>
            <h4>Total MPO: <span id="total_mpo">200</span></h4>
            <h4>Total Rx Submitted: <span id="total_rx">200</span></h4>
      </th>
    </tr>
    <tr>
      <th scope="col">Sl No.</th>
      <th scope="col">Name</th>
      <th scope="col">Designation</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody id="am_mpo_list">

  </tbody>
</table>
@endsection

@section('js')
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script type="text/javascript">

    $('#total_rx_submitted').text('{{ $rx_grand_total }}');

    $('#activity_table').dataTable({
    	"pageLength": 25
    });

    $(".downloaddatepicker").datepicker().datepicker("setDate", new Date());

    $(document).on('click','.xl_download',function(){
        $(this).parent('div').eq(0).children('.downloadpicker').toggleClass('hidden');
    });

    $(document).on('click','.downloadpicker_btn',function(){
        $(this).parents('.downloadpicker ').addClass('hidden');
    })

    $(document).on('click','.downloadpicker_btn',function(){
        var zsm_id = $(this).attr('data-id');
        var date = $(this).parents('.downloadpicker').eq(0).find('.activity_date').val();
        var url = '{{ url('/report_activity_detail_ajax') }}';
        var dataString = {
            _token: "{{ csrf_token() }}",
            zsm_id:zsm_id,
            date:date
        };
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ console.log(data);
                if(data.status == 200){
                    var total_ams = 0;
                    var total_mpos = 0;
                    var rx_total = 0;
                    var list = '';
                    var count = 1;
                    $('#zone_name').text(data.zone.zone_name);
                    $.each( data.zone.regions, function( index, value ){
                        total_ams = total_ams+value.ams;
                        total_mpos = total_mpos+value.mpos;
                        if(value.current_date_prescriptions[0].total!=null){
                            rx_total = rx_total+parseInt(value.current_date_prescriptions[0].total);
                        }

                        $.each( value.am_list, function( index, am ){
                            if(am.prescriptions[0].total==null){
                                var quantity = 0;
                            }
                            else{
                                var quantity = am.prescriptions[0].total;
                            }
                            list+='<tr>';
                            list+='<th>'+count+'</th>';
                            list+='<td>'+am.first_name+" "+am.last_name+'</td>';
                            list+='<td>AM</td>';
                            list+='<td>'+quantity+'</td>';
                            list+='</tr>';
                            count++;
                        });

                        $.each( value.mpo_list, function( index, mpo ){
                            if(mpo.prescriptions[0].total==null){
                                var quantity = 0;
                            }
                            else{
                                var quantity = mpo.prescriptions[0].total;
                            }
                            list+='<tr>';
                            list+='<th>'+count+'</th>';
                            list+='<td>'+mpo.first_name+" "+mpo.last_name+'</td>';
                            list+='<td>MPO</td>';
                            list+='<td>'+quantity+'</td>';
                            list+='</tr>';
                            count++;
                        });
                    });
                    $('#total_am').text(total_ams);
                    $('#total_mpo').text(total_mpos);
                    $('#total_rx').text(rx_total);
                    $('#am_mpo_list').html(list);

                    $("#myTable").table2excel({
                        exclude: ".noExl",
                        name: "Rx Activity Report",
                        filename: "Rx Activity Report.xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true
                    });
                }

                if(data.status == 401){

                }


            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });

    });

    $(document).on('change','#date_filter',function(){
        $('#date_filter_form').submit();
    });
</script>
@endsection