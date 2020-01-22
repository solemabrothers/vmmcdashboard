$(document).ready(function()
{
    $.getJSON("drilldowns", function(performance) {
        var chartSeriesData = [];
        var districtdata =[];
        var districtdata1 =[1000,2000];
        var facilitydata=[];
        var ipmechanismperformance=[];
        var chartperformancedata =[];
        var vmmcperformancedata = performance;
        var ipmechanismtarget = vmmcperformancedata[0];
        var ipperformanceandtarget = vmmcperformancedata[1];
        var ipdistrictperformance = vmmcperformancedata[2];
        var facilityperformance =vmmcperformancedata[3];
        var ipmechanismoutput =vmmcperformancedata[4];
        for (var i = 0; i < ipperformanceandtarget.length; i++) {
            var  ip_ids=ipperformanceandtarget[i].IP_ID
            var   series_name=ipperformanceandtarget[i].Ipmechanismname;
            var ipperformance=ipperformanceandtarget[i].ipmechanismperformance

            chartperformancedata.push({
                name: series_name,
                y: ipperformance,
            });
        }

        for(var i=0;i<ipmechanismtarget.length;i++)
        {
            var iptargets =ipmechanismtarget[i].Target;
            chartSeriesData.push({
                y: iptargets,
            });
        }
        for (var i = 0; i < ipmechanismoutput.length; i++) {
            var  ip_ids=ipmechanismoutput[i].IP_ID
            var   series_name=ipmechanismoutput[i].Ipmechanismname;
            var ipperformance=ipmechanismoutput[i].Performance
            ipmechanismperformance.push({
                y: ipperformance,
            });
                  }


        for (var i = 0; i < ipdistrictperformance.length; i++) {
             var  ip_ids=ipdistrictperformance[i].IP_ID
            var   district_series_name=ipdistrictperformance[i].District_name;
            var districtperfomance=ipdistrictperformance[i].totalperformance
            var districtperfomance1=ipdistrictperformance[i].totalperformance

            districtdata.push({
                name: district_series_name,
                data: districtperfomance,
                data1: districtperfomance1,
                drilldown:ip_ids
            });

        }
        for(var x=0;x < vmmcperformancedata[3].length;x++){
             var district_ids=vmmcperformancedata[3][x].district_id;
             var facilityname=vmmcperformancedata[3][x].facility_name;
             var facilityperformance=vmmcperformancedata[3][x].facilitydata;

            facilitydata.push({
                name:facilityname,
                data:facilityperformance,
                drilldown:district_ids
            })
        }

        Highcharts.chart('ipmechanismtargetandperformance', {
            chart: {
                type: 'column',
                borderWidth: 1,
            },
            title: {
                text: 'IP Mechanism Targets and  Achievements'
            },
            subtitle: {
                text: 'Click the columns to view perfomance '
            },
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            xAxis: {
                type: 'category'
            },
            legend: {
                enabled: true
            },

            plotOptions: {
                series: {
                    colorByPoint: false,
                    allowPointSelect:true,
                    dataLabels: {
                        enabled: true,
                    },
                    showInLegend:true
                }
            },
            series: [
                {
                    type: 'column',
                    color: 'Green',
                    name: 'Target',
                    data: chartSeriesData,

                   },
                {
                    type: 'line',
                    color: 'White',
                    name: 'Performance',
                    yAxis: 1,
                    dataLabels:{
                        pointFormat: '<span style="color:{series.color}"></span>({point.y}%)<br/>',
                    },
                    fillOpacity: 0,
                    data: ipmechanismperformance
                },
              {
                    type: 'column',
                    name: 'Achievement',
                    colorByPoint: false,
                    data: chartperformancedata,
                }

            ],

        });
    })

});

