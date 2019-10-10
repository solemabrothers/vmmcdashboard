
@extends('.home')

@section('region')

    @foreach($district as $districts)
        {
            <h4>{{$districts->District_name}}</h4>
        <small>belongs to{{$districts->region}}</small>
        }@endforeach
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-body">--}}
                        {{--<table class="table-active" id="table">--}}
                            {{--<thead>--}}
                            {{--<tr><th>Region IDs</th>--}}
                                {{--<th>District IDs</th>--}}
                                {{--<th>District Name</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--@foreach($district as $Region_Region_ID =>$districts)--}}
                                    {{--<td>{{$Region_Region_ID}}</td>--}}
                                    {{--<td>{{$districts->}}</td>--}}
                                            {{--<td>{{$region->District_ID}}</td>--}}
                                        {{--<td>{{$region->District_name}}</td>--}}
                                         {{--@endforeach--}}
                                    {{--</tr>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
