$(document).ready(function()
{
    $.getJSON("ipnumbers", function($ipz_result) {

        var categories = $ipz_result[0]
        var data= $ipz_result[1]
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
            renderTo: '',
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
    $.getJSON("ipmechanismtargetandperformance", function(results) {

        var categories = results[0]
        var ipmechanismtarget = results[1]
        var ipmechanismperformance = results[2]

        var options={
            chart: {
                type:'column',
                renderTo:'ipmechanismtargetandperformance',
                borderWidth:1
            },

            title: {
                text: 'IP Mechanism Targets and  Performance '
            },

            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'IP Mechanism Performance'
                }

            },
            plotOptions: {

                series: {
                    colorByPoint: false,
                    allowPointSelect:true,
                    dataLabels:{
                        enabled:true,
                    },
                    showInLegend:true
                }

            },

            series: [{
               type:'column',

                name: 'Target',
                color:'Green',
                data: ipmechanismtarget,

            }, {
                type:'column',
                name: 'Performance',
                data:ipmechanismperformance,
            }]
        };
       chart = new Highcharts.Chart(options);

    });

})

$(document).ready(function()
{
    $.getJSON("categoriesByAgegroup", function(ageperformance) {

        var categories = ageperformance[0]
        var agecategoryperformance= ageperformance[1]
        var $agecategorytarget = ageperformance[2]
        console.log(categories)
        var options={
            chart: {

                renderTo:'categories',
                borderWidth:1
            },

            title: {
                text: 'TOTAL  AGE CATEGORY PERFORMANCE  '
            },

            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Number Circumscissed'
                }

            },
            series:[
                {
                    type:'column',
                    name:'Target',
                    color:'Green',
                    data:$agecategorytarget
                },
                {
                    type:'column',
                    color: 'Blue',
                    name:'Performance',
                    data:agecategoryperformance
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
    $.getJSON("categoriesByAgegroup", function(agegrouptargets) {
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






