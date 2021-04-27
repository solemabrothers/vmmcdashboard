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
                data:[  ]
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


