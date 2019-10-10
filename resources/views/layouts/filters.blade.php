
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: SOLEMA--}}
 {{--* Date: 03/07/2018--}}
 {{--* Time: 14:29--}}
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
                        <span class="info-box-number">{{$clientscircumscissedbyunit}}</span>
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
                        <span class="info-box-number">{{$clients_hiv_negative_ip}}</span>
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
                        <span class="info-box-number">41,410</span>
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
                        <span class="info-box-number">{{$clients_hiv_positive_ip}}</span>
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
                <div class="col-6">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered" id="table">
                            <thead>
                            <tr><th>Facility Name</th>
                                <th>Clients Circumscissed</th></tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($facilitynumbers as $facilitynumber)
                                    <td>{{$facilitynumber->name->Facility_name}}</td>
                                    <td>{{$facilitynumber->values}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>


        <div class="container">
        </div>
    </div>

    </div>
    </div>

    <!-- /.content -->
    </body>
@endsection