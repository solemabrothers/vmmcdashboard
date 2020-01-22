

<h4>VOLUNTARY MEDICAL MALE  CIRCUMCISION  DASHBOARD

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-left: 300px;">National/IP Mechanism Filter</button></h4>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Filter</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" method="GET" action="filterdata" id="filterdata">
                    <div class="form-group">
                        <table class="table" id="filtertable">
                            <tr>
                                <td><label id="label">IMPLEMENTING MECHANISM</label></td>
                                <td><select class="form-control form-control-lg" name="ips">
                                        <option>National</option>
                                        @foreach($ips as $ip)
                                            {
                                            <option value="{{$ip->IP_ID}}">{{$ip->Ip_name}}</option>
                                            }
                                        @endforeach
                                    </select></td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td> <label id="label">Start Date:</label> </td>--}}
{{--                                <td><input type="date" class="form-control" name="startdate"></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <label id="label">End Date:</label>--}}

{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="date" class="form-control" name="enddate">--}}

{{--                                </td>--}}
{{--                            </tr>--}}
                        </table>



                        <div class="modal-footer">
                            <input type="Submit" class="btn btn-success" value="Filter" name="filter"/>
                        </div>
                    </div>

                </form>


            </div>

        </div>

    </div>
</div>

<!-- Adverse Effects Table -->
<div id="adverseEffects" class="modal fade" role="dialog">
    <div class="modal-dialog" >

        <!-- Modal content -->
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ADVERSE EVENTS</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="table-primary">
                        <th>IP</th>
                        <th>District</th>
                        <th>Facility</th>
                        <th th style="width: 100px;">Severe</th>
                        <th th style="width: 100px;">Moderate</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($weeklyadverseeffects as $effects)
                        <tr>
                            <td>{{$effects->Ip_name}}</td>
                            <td>{{$effects->District_name}}</td>
                            <td>{{$effects->facility_name}}</td>
                            <td>{{$effects->Severe}}</td>
                            <td>{{$effects->ClientsAffected}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>




<!-- Clients Diagnosised Postivie with HIV -->
<div id="hivpositive" class="modal fade" role="dialog">
    <div class="modal-dialog " id="hivmodal" >

        <!-- Modal content -->
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CLIENT HIV POSITIVE</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="table">
                    <thead>
                    <tr class="table-primary">
                        <th>IP</th>
                        <th>District</th>
                        <th>Facility</th>
                        <th>Clients</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($HIVpositiveclients as $positiveclients)
                        <tr>
                            <td>{{$positiveclients->Ip_name}}</td>
                            <td>{{$positiveclients->District_name}}</td>
                            <td>{{$positiveclients->facility_name}}</td>
                            <td>{{$positiveclients->positive}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>


<!-- Filter data Models -->
<!-- Adverse Events Summary -->
<div id="adverseeventsfilter" class="modal fade" role="dialog">
    <div class="modal-dialog"  id="hivmodal">

        <!-- Modal content -->
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Adverse Effects</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="table-primary">
                        <th>IP</th>
                        <th>District</th>
                        <th>Facility</th>
                        <th th style="width: 100px;">Severe</th>
                        <th th style="width: 100px;">Moderate</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($weeklyadverseeffects as $effects)
                        <tr>
                            <td>{{$effects->Ip_name}}</td>
                            <td>{{$effects->District_name}}</td>
                            <td>{{$effects->facility_name}}</td>
                            <td>{{$effects->Severe}}</td>
                            <td>{{$effects->ClientsAffected}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>





{{--Number of devices used by facilities--}}
<div id="deviceused" class="modal fade" role="dialog">
    <div class="modal-dialog-centered" id="hivmodal">

        <!-- Modal content -->
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Devices Used in Facility</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="table">
                    <thead>
                    <tr class="table-primary">
                        <th>IP</th>
                        <th>District</th>
                        <th>Facility</th>
                        <th>Clients</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($facilitiesusingdevices as $devicesused)
                        <tr>
                            <td>{{$devicesused->Ip_name}}</td>
                            <td>{{$devicesused->District_name}}</td>
                            <td>{{$devicesused->facility_name}}</td>
                            <td>{{$devicesused->DevicesUsed}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>
