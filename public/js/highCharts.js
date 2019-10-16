    $(document).ready(function() {

        var options = {

            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Districts Per Region',
                x: 10 //center
            },
            subtitle: {
                text: 'Courses',
                x: -20
            },
            xAxis: {
                categories: [],
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Number Of Districts'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> of total<br/>'

            },
            plotOptions: {
                series: {
                    borderWidth: 0,

                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },
            legend: {
                layout: 'center',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            series: [
                {
                    colorByPoint:true,
                    data:[]
                }
            ]
        };
        $.getJSON("test", function(data) {
            console.log(data);
            // var series={
            //     data: []
            // }
            //
            //     options.xAxis.categories.push(data.name[0].Region_name); //xAxis: {categories: []}
            //     series.data.push(data.values);
            //     options.series.push(series);
            // chart = new Highcharts.Chart(options);
        });
    });

