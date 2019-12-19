$(document).ready(function()
{
    $.getJSON("", function($ipz_result) {

        var categories = $ipz_result[0]
        var data= $ipz_result[1]
        var options={
            chart: {

                renderTo:''
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


 $(document).ready(function()
{
    $.getJSON("ipmechanismtargetandperformance", function(results) {

        var categories = results[0]
        var ipmechanismtarget = results[1]
        var ipmechanismperformance = results[2]

        var options={
            chart: {
                type:'column',
                renderTo:'',
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
                data:[
                    {
                        x:"IDI Kampala",
                        y: 68622,
                        drilldown: "idi"
                    },
                    {

                        y: 56524,
                        drilldown: "rhsp"
                    },
                    {
                        y: 48919,
                        drilldown: "baylor"
                    },
                    {
                        y: 21300,
                        drilldown: "taso"
                    },
                    {

                        y: 59484,
                        drilldown: "mildmay"
                    },
                    {

                        y: 68856,
                        drilldown: "idiwest"
                    },

                ]
            }],

        };
       chart = new Highcharts.Chart(options);

    });

});

$(document).ready(function()
{
    $.getJSON("categoriesByAgegroup", function(ageperformance) {

        var categories = ageperformance[0]
        var agecategoryperformance= ageperformance[1]
        var $agecategorytarget = ageperformance[2]
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
            series:[
                {
                    type:'column',
                    name:'Target',
                    color:'Green',
                    data:$agecategorytarget
                },
                {
                    type:'column',
                    name:'Performance',
                    data:agecategoryperformance
                }]

        };


        chart = new Highcharts.Chart(options);

    });

});


$(document).ready(function()
{
    // Create the chart
    Highcharts.chart('devicesused', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'IP Mechanism Targets and  Performance'
        },
        subtitle: {
            text: 'Click Device to view Facilities using Devices'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Number Circumscised by Method used'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },

        tooltip: {
        },

        series: [
            {
                type:'column',
                color:'Green',
                name: 'Target',
                data:[
                    {
                        name:'Surgical',
                        y:315241
                    },
                    {
                        name:'Device',
                        y:176,
                        drilldown:'device'
                    }
                ]

            }
        ],
        drilldown: {
            series: [
                {
                    name: "Device",
                    id: "device",
                    data: [
                        [
                             "Kisenyi Health Centre",
                            34
                        ],
                        [
                            "IDI Omugo Health Centre",
                            15
                        ],
                        [
                            "IDI Rhino Camp Health Centre IV",
                            34
                        ],
                        [
                            "Luwero Health Centre IV.",
                            60
                        ],
                        [
                            "IDI Buwambo HC IV",
                            32
                        ],
                        [
                            "Kakumiro HCIV",
                            1
                        ]
                    ]
                }
            ]
        }
    });

})






