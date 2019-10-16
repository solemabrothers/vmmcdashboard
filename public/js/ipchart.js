$(document).ready(function()
{
    $.getJSON("ipnumbers", function($ipz_result) {
            console.log($ipz_result)
        var categories = $ipz_result[0]
        var data= $ipz_result[1]

        console.log(data)
        var options={
            chart: {

                renderTo:'implementingpattners'
            },

            title: {
                text: 'IP  PERFORMANCE'
            },

            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Number Circumscissed'
                }

            },
            colors: [
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
                        enabled:false,
                    },
                    showInLegend:true
                }

            },
            series:[ {
                type: 'column',
                name: 'Clients Circumcised',
                data:data

            }]

        };

        chart = new Highcharts.Chart(options);

    });

})
$(document).ready(function() {

    var options = {
        chart: {
            renderTo: 'categories',
            type: 'column'
        },
        title: {
            text: 'Clients Categorised By Age group ',
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
                    enabled:false,
                },
                showInLegend:true
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
        series: []
    };
    $.getJSON("categoriesByAgegroup", function(data) {
        var series={
            name:'Client Age Groups',
            data:[]
        }
        for(i in data)
        {
            options.xAxis.categories.push(data[i].objectname);
            series.data.push(JSON.parse(data[i].objectvalue));
            }
        options.series.push(series);
        chart = new Highcharts.Chart(options);
    });
});


 $(document).ready(function()
{
    $.getJSON("adverseefffects", function(results) {

        var categories = results[0]
        var severe = results[1]
        var moderate = results[2]

        var options={
            chart: {
                type:'column',
                renderTo:'adverseeffects'
            },

            title: {
                text: 'Adverse Effects By Quater'
            },

            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Quarter'
                }

            },
            series: [{

                name: 'Severe',
                data: severe

            }, {

                name: 'Moderate',
                data:moderate

            }]

        };

       chart = new Highcharts.Chart(options);

    });

})

$(document).ready(function()
{
    $.getJSON("hivstatus", function(clientsstatus) {

        var categories = clientsstatus[0]
        var clients= clientsstatus[1]
        var clientspositive = clientsstatus[2]
        var clientsnegative = clientsstatus[3]

        var options={
            chart: {

                renderTo:'hivstatus'
            },

            title: {
                text: '  MONTHLY HIV STATUS '
            },

            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Number Circumscissed'
                }

            },
            series:[ {
                type:'column',
                name: 'Clients  Circumscissed',
                data:clients

            },
                {
                    type:'line',
                    name:'Negative',
                    color:'Green',
                    data:clientsnegative
                },
                {
                    type:'line',
                    color: 'red',
                    name:'Postive',
                    data:clientspositive
                }]

        };

        chart = new Highcharts.Chart(options);

    });

})





