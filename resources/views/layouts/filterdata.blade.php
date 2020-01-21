{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: ssolomon--}}
 {{--* Date: 8/8/18--}}
 {{--* Time: 3:43 PM--}}
 {{--*/--}}

@extends('home')
@section('content')
    <body>
    <div class="content-wrapper">
{{--    @include('layouts.header')--}}
    <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="card" id="title">:TOTAL WEEKLY PERFORMANCE</div>
        <div class="row">
            <div class="col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text" id="boxcontent">Clients Circmscissed</span>
                        <span class="info-box-number" id="boxnumbers">{{number_format($Ip_weekly_performance[0]->total)}}</span>
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
                        <span class="info-box-number" id="boxnumbers">{{number_format($clientsHIVnegative[0]->negative)}}</span>
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
                        <span class="info-box-number" id="boxnumbers">{{number_format($clientsHIVpositive[0]->positive)}}</span>
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
                        <span class="info-box-number" id="boxnumbers">{{number_format($Ip_severeadverseeffects[0]->ClientsAffected)}}</span>
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

            </div>
        </div>
    </div>
    <!-- /.content -->
    </body>
@endsection
