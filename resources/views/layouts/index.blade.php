
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: SOLEMA--}}
 {{--* Date: 14/07/2018--}}
 {{--* Time: 17:56--}}
 {{--*/--}}
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
        @include('layouts.header')
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="card" id="title">:TOTAL WEEKLY PERFORMANCE</div>
        <div class="row">
            <div class="col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">Clients Circmscissed</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($numbersCircumscissedaily[0]->total)}}</span>
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
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">HIV Postive</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($numbersHIVpositive[0]->positive)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-lg-3">
                <div class="info-box mb-3">
                    <span class=" info-box-icon bg-warning elevation-1"><i class="fa fa-wheelchair"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">Clients Severely Affected </span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($SeverelyAffected[0]->ClientsAffected)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->


            <!-- /.col -->

        <!-- /.row -->
        <div class="container">
            <div class="card" id="title">:WEEKLY REPORTING</div>
            <div class="row">
                    <div class="col-lg-6" id="implementingpattners">
                    </div>
                    <div class="col-lg-6" id="categories">

                    </div>

            </div>

            <div class="row" style="padding-top:15px" >
                <div class="col-lg-6" id="adverseeffects">

                </div>
                <div class="col-lg-6" id="hivstatus">

                </div>

            </div>


            <div class="row">
                <div class="panel-body">
                <table class="table table-striped table-bordered " id="table">
                <thead>
                <tr class="table-primary"><th style="width: 100px;">District Name</th>
                <th style="width:100px">January</th>
                <th style="width:100px"> Febuary</th>
                <th style="width: 100px;">March</th>
                <th style="width: 100px;">April</th>
                <th style="width: 100px;">May</th>
                <th style="width: 100px;">June</th>
                <th style="width: 100px;">July</th>
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
                {{--<td>{{$data->August}}</td>--}}
                {{--<td>{{$data->September}}</td>--}}
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