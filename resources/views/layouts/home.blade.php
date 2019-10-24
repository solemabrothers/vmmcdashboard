
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
        <div class="card" id="title">:TOTAL  PERFORMANCE FOR COP18</div>
        <div class="row" id="districttable">
            <div class="col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">% Total Performance</span>
                        <span class="info-box-number" id="boxnumbers">{{($totalperformance)}}%</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">HIV Negative</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($numbersHIVnegative[0]->negative)}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-3">
                <div class="info-box mb-3" id="infobox">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>

                    <div class="info-box-content"  id="boxcontent" data-target="#hivpositive">
                        <span class="info-box-text" id="boxcontent">HIV Postive</span>
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
            <div class="col-lg-3">
                <div class="info-box mb-3"id="infobox" >
                    <span class=" info-box-icon bg-warning elevation-1"><i class="fa fa-wheelchair"></i></span>

                    <div class="info-box-content" data-toggle="modal" id="boxcontent" data-target="#adverseEffects">

                        <span class="info-box-text" >Adverse Effects </span>
                        <span class="progress-description" id="footnotes">Click to View Details
                          </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($SeverelyAffected[0]->ClientsAffected)}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->


            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="card" id="title">:IP Mechanism Perfomance FOR COP18</div>
        <div class="row">
            <div class="col-lg-6" id="ipmechanismtargetandperformance">
            </div>
            <div class="col-lg-6" id="categories">

            </div>

        </div>

{{--         <div class="row" style="padding-top:15px"  >--}}
{{--        <div class="col-lg-6" id="hivstatus">--}}

{{--            </div>--}}
{{--            <div class="col-lg-6" id="ipmechanismtargetandperformance">--}}

{{--            </div>--}}


{{--        </div>--}}


        <div class="row">
            <div class="panel-body">
                <h4 style="padding: 0px;">MONTHLY DISTRICT PERFORMANCE  FOR 2019</h4>
                <table class="table table-striped table-bordered" id="mytables">
                    <thead>
                    <tr class="table-primary"><th style="width: 100px;">District Name</th>
                        <th style="width:100px">Jan</th>
                        <th style="width:100px"> Feb</th>
                        <th style="width: 100px;">Mar</th>
                        <th style="width: 100px;">Apr</th>
                        <th style="width: 100px;">May</th>
                        <th style="width: 100px;">June</th>
                        <th style="width: 100px;">July</th>
                        <th style="width: 100px;">Aug</th>
                        <th style="width: 100px;">Sept</th>
                        <th style="width: 100px;">Oct</th>
                        <th style="width: 100px;">Nov</th>
                        <th>Total</th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($monthly_data as $data)
                            <td>{{$data->District_name}}</td>
                            <td>{{$data->January}}</td>
                            <td>{{$data->February}}</td>
                            <td>{{$data->March}}</td>
                            <td>{{$data->April}}</td>
                            <td>{{$data->May}}</td>
                            <td>{{$data->June}}</td>
                            <td>{{$data->July}}</td>
                            <td>{{$data->August}}</td>
                            <td>{{$data->September}}</td>
                            <td>{{$data->October}}</td>
                            <td>{{$data->November}}</td>
                            <td>{{$data->DistrictTotal}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    </div>
    </div>
    <!-- /.content -->
    </body>
@endsection

<!-- /Users/ssolomon/Projects/vmmcdashboard/resources/views/layouts/home.blade.php -->
