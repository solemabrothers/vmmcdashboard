{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: SOLEMA--}}
 {{--* Date: 03/07/2018--}}
 {{--* Time: 13:25--}}
 {{--*/--}}
@extends('home')
@section('content')
    <body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients Circmscissed</span>
                        <span class="info-box-number">{{$numbersCircumscissedaily}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">HIV Negative</span>
                        <span class="info-box-number">{{$numbersHIVnegative}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-warning elevation-1"><i class="fa fa-wheelchair"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients Affected </span>
                        <span class="info-box-number">{{10}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">HIV Postive</span>
                        <span class="info-box-number">{{$numbersHIVpositive}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="container">
            <div class="row">
                <div class="col-6" id="adverseeffects">

                </div>
                <div class="col-6" id="adverseeffects">

                </div>

            </div>
            <div class="row">
                <div class="col-6" id="implementingpattners">
                </div>
                <div class="col-6" id="categories">

                </div>

            </div>


           <div class="row">
               {{--<div class="panel-body">--}}
                   {{--<table class="table table-striped table-bordered" id="table">--}}
                       {{--<thead>--}}
                       {{--<tr><th>District Name</th>--}}
                           {{--<th>January</th>--}}
                           {{--<th> Febuary</th>--}}
                            {{--<th>March</th>--}}
                           {{--<th>April</th>--}}
                           {{--<th>May</th>--}}
                           {{--<th>June</th>--}}
                           {{--<th>July</th>--}}
                           {{--<th>August</th>--}}
                           {{--<th>September</th>--}}

                           {{--<th>Total</th></tr>--}}
                       {{--</thead>--}}
                       {{--<tbody>--}}
                       {{--<tr>--}}
                           {{--@foreach($monthly_data as $data)--}}
                               {{--<td>{{$data->District_name}}</td>--}}
                               {{--<td>{{$data->January}}</td>--}}
                               {{--<td>{{$data->February}}</td>--}}
                               {{--<td>{{$data->March}}</td>--}}
                               {{--<td>{{$data->April}}</td>--}}
                               {{--<td>{{$data->May}}</td>--}}
                               {{--<td>{{$data->June}}</td>--}}
                               {{--<td>{{$data->July}}</td>--}}
                               {{--<td>{{$data->August}}</td>--}}
                               {{--<td>{{$data->September}}</td>--}}
                               {{--<td>{{$data->DistrictTotal}}</td>--}}
                       {{--</tr>--}}
                       {{--@endforeach--}}
                       {{--</tbody>--}}
                   {{--</table>--}}
               </div>


    </div>
    </div>
    </div>
    <!-- /.content -->
    </body>
    @endsection