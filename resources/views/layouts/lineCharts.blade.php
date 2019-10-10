<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>

    <style type="text/css">

    </style>
</head>
<body>
<script type="text/javascript">

    Highcharts.chart('regionbar', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Numbers Circumscised  by Region'
        },

        xAxis: {
            categories: ['Central', 'Nothern', 'Western', 'Eastern'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (000)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' thousands'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 2014',
            data: [107, 31, 635, 203]
        }, {
            name: 'Year 2015',
            data: [133, 156, 947, 408]
        }, {
            name: 'Year 2016',
            data: [814, 841, 3714, 727]
        }, {
            name: 'Year 2017',
            data: [1216, 1001, 4436, 738]
        }]
    });
</script>
</body>
</html>
