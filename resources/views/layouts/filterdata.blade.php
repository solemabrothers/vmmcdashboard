{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: ssolomon--}}
 {{--* Date: 8/8/18--}}
 {{--* Time: 3:43 PM--}}
 {{--*/--}}

@extends('home')
@section('content')
    <body>
    <div class="content-wrapper"  style="min-height: 324px;margin-left: 185px;">
    @include('layouts.header')
    <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="card" id="title">:{{$ipmechanismname[0]->Ip_name}} PERFORMANCE FOR COP19 AS of {{date("d.M.Y")}}</div>

        <div class="row">
            <div class="col-lg-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">% Performance</span>
                        <span class="info-box-number" id="boxnumbers">{{($ipmechanismperformance)}}%</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px"> Target</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($IP_target[0]->IpMechanismtarget)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px">Male Circumscised</span>
                        <span class=f"info-box-number" id="boxnumbers">{{number_format($Ip_mechanismachievement[0]->total)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-2">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">Devices Used</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($devicesusedbyip[0]->DevicesUsed)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-lg-2">
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>
                    <div class="info-box-content" id="boxcontent" data-toggle="modal" data-target="#hivpositive">
                        <span class="info-box-text" id="boxcontent">HIV Postive</span>
                        <span class="progress-description"  data-toggle="modal" data-target="#hivpositive" id="footnotes">Click to View Details</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($clientsHIVpositive[0]->positive)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-lg-2">
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-warning elevation-1"><i class="fa fa-wheelchair"></i></span>
                    <div class="info-box-content" data-toggle="modal" id="boxcontent" data-target="#adverseEffects">
                        <span class="info-box-text" id="boxcontent">Adverse Events</span>
                        <span class="progress-description" id="footnotes">Click to View Details
                          </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($ipadverseevents[0]->ClientsAffected)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="card" id="title">:{{$ipmechanismname[0]->Ip_name}} PERFORMANCE FOR COP19 AS of {{date("d.M.Y")}}</div>
                        <div class="row">
                    <div class="col-lg-12" id="specificipdata">
                        <script type="text/javascript">
                            var districttargets = <?php echo json_encode($districttarget);?>;
                            var districtperformance=<?php echo json_encode($districtperformance);?>;
                            var faciltyperfomance=<?php echo json_encode($facilityoutputperformance);?>;

                            var districttargetarrays =[];
                            var districtachievement=[];
                            var facilitypercentageperfomance=[];
                            for(var i=0;i< districttargets.length;i++)
                            {
                                var series_names=districttargets[i].District_name;
                                var district_target=JSON.parse(districttargets[i].Target);
                                districttargetarrays.push({
                                    name:series_names,
                                    y:district_target,
                                })
                            }
                            for(var i=0;i< districtperformance.length;i++)
                            {
                                var series_names=districtperformance[i].District_name;
                                var district_achievement=JSON.parse(districtperformance[i].Achievement);
                                districtachievement.push({
                                    name:series_names,
                                    y:district_achievement,
                                })
                            }
                            for(var i=0;i< faciltyperfomance.length;i++)
                            {
                               // var series_names=districtperformance[i].District_name;
                                var facility_achievement=JSON.parse(faciltyperfomance[i].Performance);
                                facilitypercentageperfomance.push({
                                    y:facility_achievement,
                                })
                            }
                            console.log(facility_achievement)
                            $(document).ready(function()
                            {
                            Highcharts.chart('specificipdata',{

                                chart: {
                                    type: 'column',
                                    borderWidth: 1,
                                },
                                title: {
                                    text: 'Targets and  Achievements'
                                },
                                yAxis: [
                                    { // Primary yAxis
                                    labels: {
                                        format: '{value}',
                                        style: {
                                            color: Highcharts.getOptions().colors[1]
                                        }
                                    },
                                    title: {
                                        style: {
                                            color: Highcharts.getOptions().colors[1]
                                        }
                                    }
                                },
                                    { // Secondary yAxis
                                        title: {
                                            text: '',
                                            style: {
                                                color: Highcharts.getOptions().colors[0]
                                            }
                                        },
                                        labels: {
                                            format: '{value}',
                                            style: {
                                                color: Highcharts.getOptions().colors[0]
                                            }
                                        },
                                        opposite: true
                                    }

                                ],
                                xAxis: {
                                    type: 'category'
                                },
                                legend: {
                                    enabled: true
                                },

                                plotOptions: {
                                    series: {
                                        colorByPoint: false,
                                        allowPointSelect:true,
                                        dataLabels: {
                                            enabled: true,
                                        },
                                        showInLegend:true
                                    }
                                },
                                series: [
                                    {
                                        type: 'column',
                                        color: 'Green',
                                        name: 'Target',
                                        data: districttargetarrays,

                                    },
                                    {
                                        type: 'line',
                                        color: 'grey',
                                        name: 'Performance',
                                        yAxis: 1,
                                        dataLabels:{
                                            pointFormat: '<span style="color:{series.color}"></span>({point.y}%)<br/>',
                                        },
                                        fillOpacity: 0,
                                        data: facilitypercentageperfomance
                                    },
                                    {
                                        type: 'column',
                                        name: 'Achievement',
                                        colorByPoint: false,
                                        data: districtachievement,
                                    }]
                              })
                            })
                        </script>
                    </div>
                </div>
        <div class="row">
            <div class="col-lg-12" id="ipagecategories">--}}
                                <script type="text/javascript">
                                    var ipageperformancejson = <?php echo json_encode($ipAgeperformance);?>;
                                       var categories=ipageperformancejson[0];
                                       var ipageperformance=ipageperformancejson[1];
                                    var ipagetarget =ipageperformancejson[2];
                                       var ipageperformanceseries=[]
                                       var ipagetargetseries=[];
                                       for( var i=0;i<ipageperformance.length;i++) {
                                           ipageperformanceseries.push({
                                               y: JSON.parse(ipageperformance[i])
                                           })
                                       }
                                    for( var i=0;i<ipagetarget.length;i++) {

                                        ipagetargetseries.push({
                                            y: JSON.parse(ipagetarget[i])
                                        })
                                    }
                                    $(document).ready(function()
                                    {
                                        Highcharts.chart('ipagecategories',{

                                            chart: {
                                                type: 'column',
                                                borderWidth: 1,
                                            },
                                            title: {
                                                text: 'Targets and  Achievements By Age Groups'
                                            },
                                            yAxis: [{ // Primary yAxis
                                                labels: {
                                                    format: '{value}',
                                                    style: {
                                                        color: Highcharts.getOptions().colors[1]
                                                    }
                                                },
                                                title: {
                                                    style: {
                                                        color: Highcharts.getOptions().colors[1]
                                                    }
                                                }
                                            },
                                            ],
                                            xAxis: {
                                                categories: categories
                                            },
                                            legend: {
                                                enabled: true
                                            },

                                            plotOptions: {
                                                series: {
                                                    colorByPoint: false,
                                                    allowPointSelect:true,
                                                    dataLabels: {
                                                        enabled: true,
                                                    },
                                                    showInLegend:true
                                                }
                                            },
                                            series: [
                                                {
                                                    type: 'column',
                                                    color: 'Green',
                                                    name: 'Target',
                                                    data: ipagetargetseries,

                                                },
                                                {
                                                    type: 'column',
                                                    name: 'Achievement',
                                                    colorByPoint: false,
                                                    data: ipageperformanceseries,
                                                }]
                                        })
                                    })
                                    </script>
                            </div>
                        </div>
        </div>




                </div>
            </div>
        </div>
        <!-- /.content -->
        </body>

@endsection
