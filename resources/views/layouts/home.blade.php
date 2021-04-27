
{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: SOLEMA--}}
{{--* Date: 14/07/2018--}}
{{--* Time: 17:56--}}
{{--*/--}}
{{--/**--}}

@extends('home')
@section('content')
    <body>
    <div class="content-wrapper"  style="min-height: 324px;margin-left: 185px;">

    @include('layouts.header')
    <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="card" id="title">:TOTAL  PERFORMANCE FOR COP20 AS OF {{date("d.M.Y")}}</div>
        <div class="row" id="districttable">
            <div class="col-lg-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px">% Total Performance</span>
                        <span class="info-box-number" id="boxnumbers">{{($totalperformance)}}%</span>
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
                        <span class=f"info-box-number" id="boxnumbers">{{number_format($totalnumbercircumscised[0]->total)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px">Total Target</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($totaltarget[0]->target)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-2">
                <div class="info-box mb-3" id="infobox">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>

                    <div class="info-box-content"  id="boxcontent" data-toggle="modal" data-target="#deviceused">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px">Devices Used</span>
                        <span class="progress-description"  data-toggle="modal" data-target="#devicesused" id="footnotes">Click to View Details
                          </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($totalnumbercircumscisedusingdevices[0]->DevicesUsed)}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-2">
                <div class="info-box mb-3" id="infobox">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>

                    <div class="info-box-content"  id="boxcontent" data-toggle="modal" data-target="#hivpositive">
                        <span class="info-box-text" id="boxcontent" style="font-size:12px">HIV Postive</span>
                        <span class="progress-description"  data-toggle="modal" data-target="#hivpositive" id="footnotes">Click to View Details
                          </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($numbersHIVpositive[0]->positive)}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-lg-2">
                <div class="info-box mb-3"id="infobox" >
                    <span class=" info-box-icon bg-warning elevation-1"><i class="fa fa-wheelchair"></i></span>

                    <div class="info-box-content" data-toggle="modal" id="boxcontent" data-target="#adverseEffects">
                        <span class="info-box-text" >Adverse Events </span>
                        <span class="progress-description" id="footnotes">Click to View Details
                          </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($SeverelyAffected[0]->ClientsAffected)}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        @if(isset($errorMessageDuration))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $errorMessageDuration }}
                {{ Input::get('title') }}
            </div>
    @endif

        <!-- /.row -->

        <div class="card" id="title">:IP Mechanism Perfomance FOR COP20 AS of {{date("d.M.Y")}}</div>
        <div class="row">
            <div class="col-lg-12" id="ipmechanismtargetandperformance">
            </div>

                </div>

         <div class="row" style="padding-top:15px"  >
             <div class="col-lg-12" id="categories">

             </div>
{{--        <div class="col-lg-6" id="devicesused">--}}
{{--            </div>--}}

        </div>


        <div class="row">
            <div class="col-12">
            <div class="panel-body">
                <h4 style="padding: 0px;">IP MECHANISM  PERFORMANCE  BY AGE GROUP FOR COP20 AS  of {{date("d.M.Y")}} </h4>
                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="mytables">
                    <thead>
                    <tr class="table-primary"><th style="width: 100px;">IP Mechanism</th>
                        <th ><10</th>
                        <th >10<14</th>
                        <th >15<19</th>
                        <th >20<24</th>
                        <th >25<29</th>
                        <th >30<34</th>
                        <th >35<39</th>
                        <th >40<44</th>
                        <th >45<49</th>
                        <th >50></th>

                    </thead>
                    <tbody>
                    <tr>
                        @foreach($monthly_data as $data)
                            <td>{{$data->ipmechanism}}</td>
                            <td>{{$data->category1}}</td>
                            <td>{{$data->category2}}</td>
                            <td>{{$data->category3}}</td>
                            <td>{{$data->category4}}</td>
                            <td>{{$data->category5}}</td>
                            <td>{{$data->category6}}</td>
                            <td>{{$data->category7}}</td>
                            <td>{{$data->category8}}</td>
                            <td>{{$data->category9}}</td>
                            <td>{{$data->category10}}</td>


                    </tr>
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
    <!-- /.content -->
    </body>
@endsection

<!-- /Users/ssolomon/Projects/vmmcdashboard/resources/views/layouts/home.blade.php -->

