<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VMMC </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="    https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    {{--    {!! Charts/::styles() !!}--}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('css/customcss.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script type="text/javascript" charset="utf8" src="{{URL::asset('js/highCharts.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{URL::asset('js/ipchart.js')}}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    {{--<!-- jQuery library -->--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>--}}

    <!-- Latest minified bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php

use App\Models\FilteredAgeGroups;

 $selected_ip =  $_GET["ips"];
 $age_categories = DB::select("SELECT SUM(NumberCircumcisedBetween10And14) As between10And14 FROM mets_vmmc.circumcision c
 WHERE c.ImplementingPartner='$selected_ip' and YEARWEEK(c.SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)");
$between15And19 = DB::select("SELECT SUM(NumberCircumcisedBetween15And19) As Ip_performance FROM mets_vmmc.circumcision c
WHERE c.ImplementingPartner='$selected_ip' and YEARWEEK(c.SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)");
$status_of_Clients = DB::select('SELECT monthname(SummaryDate) as months,
SUM(c.NumberCircumcised) As Clients,SUM(c.NumberHIVPositive) AS HIVPOstive, SUM(c.NumberHIVNegative) As HIVNegative
FROM mets_vmmc.Circumcision c WHERE YEAR(SummaryDate)= YEAR(CURDATE()) group by monthname(c.SummaryDate) order by c.SummaryDate;');

$Between10And14= new FilteredAgeGroups('From10to14',$age_categories);
$agedata = json_encode($Between10And14,JSON_NUMERIC_CHECK);
echo $agedata;

?>
<div id="container">

</div>
 <script type="text/javascript">

 $(document).ready(function() {

   var options = {
    chart: {
        renderTo: 'container',
        type: 'column',
            borderColor: '#92a8d1',
             borderWidth: 1
    },
    title: {
        text: ' VMMC OUTPUT BY AGE ',
        x: 10 //center
    },
    subtitle: {
        text: '',
        x: -20
    },
    xAxis: {
        categories: []
    },
    yAxis: {
        title: {
            text: 'Number of Clients'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    colors: [
        '#4572A7',
        '#AA4643',
        '#89A54E',
        '#80699B',
        '#3D96AE',
        '#DB843D',
        '#92A8CD',
        '#A47D7C',
        '#B5CA92'
    ],
    plotOptions: {

        series: {
            colorByPoint: true,
            allowPointSelect:true,
            dataLabels:{
                enabled:true,
            },
            showInLegend:false
        }

    },
    legend: {
        layout: 'center',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 100,
        floating: false,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    series: []
};
var data = <?php echo json_encode($agedata); ?>;



    var series={
        data:[]
    }
    for(i in data)
    {
        console.log(data);
        options.xAxis.categories.push(data[i].objectname);
         console.log(data[i].objectname);
        series.data.push((data[i].objectvalue));
        // console.log(data[i].objectname);

        }
    options.series.push(series);
    chart = new Highcharts.Chart(options);
});
</script>

</body>
</html>
