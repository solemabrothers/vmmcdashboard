$(document).ready(function()
{
    $.getJSON("drilldowns", function(performance) {
        var chartSeriesData = [];
        var districtdata =[];
        var facilitydata=[];
        var chartperformancedata =[];
        var vmmcperformancedata = performance;
        var ipperformanceandtarget = vmmcperformancedata[0];
        var ipdistrictperformance = vmmcperformancedata[1];
        var facilityperformance =vmmcperformancedata[2];
        for (var i = 0; i < ipperformanceandtarget.length; i++) {
            var  ip_ids=ipperformanceandtarget[i].IP_ID
            var   series_name=ipperformanceandtarget[i].Ipmechanismname;
            var  iptargets=ipperformanceandtarget[i].ipmechanismtarget;
            var ipperformance=ipperformanceandtarget[i].ipmechanismperformance
            chartSeriesData.push({
                y: iptargets,
            });
            chartperformancedata.push({
                name: series_name,
                y: ipperformance,
                drilldown:ip_ids
            });
        }
        for (var i = 0; i < ipdistrictperformance.length; i++) {
             var  ip_ids=ipdistrictperformance[i].IP_ID
            var   district_series_name=ipdistrictperformance[i].District_name;
            var districtperfomance=ipdistrictperformance[i].totalperformance

            districtdata.push({
                name: district_series_name,
                data: districtperfomance,
                drilldown:ip_ids
            });

        }
        for(var x=0;x < vmmcperformancedata[2].length;x++){
             var district_ids=vmmcperformancedata[2][x].district_id;
             var facilityname=vmmcperformancedata[2][x].facility_name;
             var facilityperformance=vmmcperformancedata[2][x].facilitydata;

            facilitydata.push({
                name:facilityname,
                data:facilityperformance,
                drilldown:district_ids
            })
        }
        console.log(districtdata)
        Highcharts.chart('ipmechanismtargetandperformance', {
            chart: {
                type: 'column',
            },
            title: {
                text: 'IP Mechanism Targets and  Performance'
            },
            subtitle: {
                text: 'Click the columns to view perfomance by district'
            },
            xAxis: {
                type: 'category'
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
            series: [
                {
                    type: 'column',
                    color: 'Green',
                    name: 'Target',
                    data: chartSeriesData
                },
                {
                    type: 'column',
                    colorByPoint: false,
                    data: chartperformancedata,
                    drilldown:[chartperformancedata[0].drilldown,chartperformancedata[1].drilldown,chartperformancedata[2].drilldown,
                               chartperformancedata[3].drilldown,chartperformancedata[4].drilldown,chartperformancedata[5].drilldown]
                }
            ],
            drilldown: {
              series:
              [{
                  id:chartperformancedata[0].drilldown, //IDI IPMEchanism
                  data:[
                      {name:districtdata[0].name,y:districtdata[0].data,drilldown:facilitydata[0].drilldown},
                      {name:districtdata[3].name,y:districtdata[3].data,drilldown:facilitydata[3].drilldown},
                  ],

              },
                  {
                      id:chartperformancedata[1].drilldown, //RHSP
                      data:[
                          {name:districtdata[9].name,y:districtdata[9].data,drilldown:'bukomansimbi'},//bukomansimbi
                          {name:districtdata[10].name,y:districtdata[10].data,drilldown:'kalangala'},
                          {name:districtdata[11].name,y:districtdata[11].data,drilldown:'kalungu'},
                          {name:districtdata[14].name,y:districtdata[14].data,drilldown:'lwengo'},
                          {name:districtdata[15].name,y:districtdata[15].data,drilldown:'lyantonde'},
                          {name:districtdata[16].name,y:districtdata[16].data,drilldown:'Masaka'},
                          {name:districtdata[19].name,y:districtdata[19].data,drilldown:'Rakai'},
                          {name:districtdata[20].name,y:districtdata[20].data,drilldown:'Sembambule'},
                      ]
                  },
                  {
                      id: facilitydata[0].drilldown, //kampala
                      data:[
                          [facilitydata[4].name,facilitydata[4].data],[facilitydata[5].name,facilitydata[5].data],
                          [facilitydata[6].name,facilitydata[6].data],[facilitydata[7].name,facilitydata[7].data],
                          [facilitydata[8].name,facilitydata[8].data],[facilitydata[9].name,facilitydata[9].data],
                          [facilitydata[10].name,facilitydata[10].data],[facilitydata[11].name,facilitydata[11].data],
                          [facilitydata[12].name,facilitydata[12].data]
                      ]
                  },
                  {
                      id: facilitydata[3].drilldown, //Wakiso
                      data:[
                          [facilitydata[44].name,facilitydata[44].data],[facilitydata[45].name,facilitydata[45].data],
                          [facilitydata[46].name,facilitydata[46].data],[facilitydata[47].name,facilitydata[47].data],
                          [facilitydata[46].name,facilitydata[46].data],[facilitydata[47].name,facilitydata[47].data],
                          [facilitydata[48].name,facilitydata[48].data],[facilitydata[49].name,facilitydata[49].data],
                          [facilitydata[50].name,facilitydata[50].data],[facilitydata[51].name,facilitydata[51].data],
                          [facilitydata[52].name,facilitydata[52].data]
                          ]
                  },
                  {
                      id: 'bukomansimbi',
                      data:[
                          [facilitydata[0].name,facilitydata[0].data]
                      ]
                  },
                  {
                      id: 'kalangala',
                      data:[
                          [facilitydata[1].name,facilitydata[1].data]
                      ]
                  },
                  {
                      id: 'kalungu',
                      data:[
                          [facilitydata[2].name,facilitydata[2].data],[facilitydata[3].name,facilitydata[3].data]
                      ]
                  },
                  {
                      id: 'lwengo',
                      data:[
                          [facilitydata[20].name,facilitydata[20].data],[facilitydata[21].name,facilitydata[21].data]
                      ]
                  },
                  {
                      id: 'lyantonde',
                      data:[
                          [facilitydata[22].name,facilitydata[22].data]
                      ]
                  },
                  {
                      id: 'Masaka',
                      data:[
                          [facilitydata[23].name,facilitydata[23].data],[facilitydata[24].name,facilitydata[24].data],
                          [facilitydata[25].name,facilitydata[25].data],[facilitydata[26].name,facilitydata[26].data],
                      ]
                  },
                  {
                      id: 'Rakai',
                      data:[
                          [facilitydata[39].name,facilitydata[39].data],[facilitydata[40].name,facilitydata[40].data],
                          [facilitydata[41].name,facilitydata[41].data]
                      ]
                  },
                  {
                      id: 'Sembambule',
                      data:[
                          [facilitydata[42].name,facilitydata[42].data],[facilitydata[43].name,facilitydata[43].data]
                      ]
                  },
                  {
                      id:chartperformancedata[2].drilldown,
                      data:[
                          {name:districtdata[33].name,y:districtdata[33].data,drilldown:'kamwenge'},
                          {name:districtdata[34].name,y:districtdata[34].data,drilldown:'kasese'},
                          {name:districtdata[35].name,y:districtdata[35].data,drilldown:'kyenjonjo'}
                      ]
                  },
                  {
                      id:'kamwenge',
                      data:[
                          [facilitydata[74].name,facilitydata[74].data],[facilitydata[75].name,facilitydata[75].data],
                          [facilitydata[76].name,facilitydata[76].data]
                      ]
                  },
                  {
                      id:'kasese',
                      data:[
                          [facilitydata[77].name,facilitydata[77].data],[facilitydata[78].name,facilitydata[78].data],
                          ]
                  },
                  {
                      id:'kyenjonjo',
                      data:[
                          [facilitydata[81].name,facilitydata[81].data],[facilitydata[82].name,facilitydata[82].data],
                      ]
                  },
                  {
                      id:chartperformancedata[3].drilldown,
                      data:[
                          {name:districtdata[37].name,y:districtdata[37].data,drilldown:'kaberamaido'},{name:districtdata[38].name,y:districtdata[38].data,drilldown:'katakwi'}, {name:districtdata[39].name,y:districtdata[39].data,drilldown:'kumi'},
                          {name:districtdata[40].name,y:districtdata[40].data,drilldown:'Soroti'}
                      ]
                  },
                  {
                      id:'kaberamaido',
                      data:[
                          [facilitydata[53].name,facilitydata[81].data]
                      ]
                  },
                  {
                      id:'katakwi',
                      data:[
                          [facilitydata[54].name,facilitydata[54].data],[facilitydata[55].name,facilitydata[55].data],[facilitydata[56].name,facilitydata[56].data]
                      ]
                  },
                  {
                      id:'kumi',
                      data:[
                          [facilitydata[57].name,facilitydata[57].data]
                      ]
                  },
                  {
                      id:'Soroti',
                      data:[
                          [facilitydata[59].name,facilitydata[59].data]
                      ]
                  },
                  {
                      id:chartperformancedata[4].drilldown,
                      data:[
                          {name:districtdata[42].name,y:districtdata[42].data,drilldown:'kiboga'},{name:districtdata[43].name,y:districtdata[43].data,drilldown:'Kyankwanzi'},{name:districtdata[44].name,y:districtdata[44].data,drilldown:'luweero'},
                          {name:districtdata[45].name,y:districtdata[45].data,drilldown:'Mityana'},{name:districtdata[46].name,y:districtdata[46].data,drilldown:'Mubende'},{name:districtdata[47].name,y:districtdata[47].data,drilldown:'Nakaseke'},
                      ]
                  },
                  {
                      id:'kiboga',
                      data:[
                          [facilitydata[13].name,facilitydata[13].data],[facilitydata[14].name,facilitydata[14].data]
                      ]
                  },
                  {
                      id:'Kyankwanzi',
                      data:[
                          [facilitydata[15].name,facilitydata[15].data]
                      ]
                  },
                  {
                      id:'luweero',
                      data:[
                          [facilitydata[16].name,facilitydata[16].data],[facilitydata[17].name,facilitydata[17].data],[facilitydata[18].name,facilitydata[18].data],[facilitydata[19].name,facilitydata[19].data]
                      ]
                  },
                  {
                      id:'Mityana',
                      data:[
                          [facilitydata[27].name,facilitydata[27].data],[facilitydata[28].name,facilitydata[28].data],[facilitydata[29].name,facilitydata[29].data]
                      ]
                  },
                  {
                      id:'Mubende',
                      data:[
                          [facilitydata[34].name,facilitydata[34].data],[facilitydata[35].name,facilitydata[35].data]
                      ]
                  },
                  {
                      id:'Nakaseke',
                      data:[
                          [facilitydata[36].name,facilitydata[36].data],[facilitydata[37].name,facilitydata[37].data],[facilitydata[38].name,facilitydata[38].data]
                      ]
                  },
                  {
                      id:chartperformancedata[5].drilldown,
                      data:[
                          {name:districtdata[53].name,y:districtdata[53].data,drilldown:'Arua'},
                          {name:districtdata[54].name,y:districtdata[54].data,drilldown:'Nebbi'},
                          {name:districtdata[55].name,y:districtdata[55].data,drilldown:'Zombo'},
                          {name:districtdata[56].name,y:districtdata[56].data,drilldown:'Hoima'},
                          {name:districtdata[57].name,y:districtdata[57].data,drilldown:'Kibaale'},
                          {name:districtdata[58].name,y:districtdata[58].data,drilldown:'Masindi'},
                          {name:districtdata[59].name,y:districtdata[59].data,drilldown:'kagadi'}
                      ]
                  },
                  {
                     id:'Arua',
                      data:[
                          [facilitydata[59].name,facilitydata[59].data],[facilitydata[60].name,facilitydata[60].data],[facilitydata[61].name,facilitydata[61].data],
                          [facilitydata[62].name,facilitydata[62].data],[facilitydata[63].name,facilitydata[63].data],[facilitydata[64].name,facilitydata[64].data]

                      ]
                  },
                  {
                      id:'Nebbi',
                      data:[
                          [facilitydata[65].name,facilitydata[65].data],[facilitydata[66].name,facilitydata[66].data]
                      ]
                  },
                  {
                      id:'Zombo',
                      data:[
                          [facilitydata[67].name,facilitydata[67].data]
                      ]
                  },
                  {
                      id:'Hoima',
                      data:[
                          [facilitydata[68].name,facilitydata[68].data],[facilitydata[69].name,facilitydata[69].data],[facilitydata[70].name,facilitydata[70].data]
                      ]
                  },
                  {
                      id:'Kibaale',
                      data:[
                          [facilitydata[79].name,facilitydata[79].data],[facilitydata[80].name,facilitydata[80].data]
                      ]
                  },
                  {
                      id:'Masindi',
                      data:[
                          [facilitydata[83].name,facilitydata[83].data],[facilitydata[84].name,facilitydata[84].data],[facilitydata[85].name,facilitydata[85].data]
                      ]
                  },
                  {
                      id:'kagadi',
                      data:[
                          [facilitydata[86].name,facilitydata[86].data]
                      ]
                  }
              ]

            },



        });
    })

});

