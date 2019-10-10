
/**
 * Created by PhpStorm.
 * User: SOLEMA
 * Date: 12/06/2018
 * Time: 13:06
 */
@extends('.home')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table-active" id="table">
                        <thead>
                        <tr><th>Region IDs</th>
                            {{--<th>Region Names</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($districtfacilities->children as $region)
                                <td>{{$region[0]}}</td>
                                {{--<td>{{$region->Facility_name}}</td>--}}
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
