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
                borderWidth: 1,
            },
            title: {
                text: 'IP Mechanism Targets and  Achievements'
            },
            subtitle: {
                text: 'Click the columns to view perfomance '
            },
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
                    data: chartSeriesData
                },
                {
                    type: 'column',
                    name: 'Achievement',
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
                      {name:districtdata[1].name,y:districtdata[1].data,drilldown:facilitydata[1].drilldown},
                  ],

              },
                  {
                      id:chartperformancedata[1].drilldown, //RHSP
                      data:[
                          {name:districtdata[3].name,y:districtdata[3].data,drilldown:'bukomansimbi'},//bukomansimbi
                          {name:districtdata[4].name,y:districtdata[4].data,drilldown:'kalangala'},
                          {name:districtdata[5].name,y:districtdata[5].data,drilldown:'kalungu'},
                          {name:districtdata[10].name,y:districtdata[10].data,drilldown:'Masaka'},
                          {name:districtdata[8].name,y:districtdata[8].data,drilldown:'lwengo'},
                          {name:districtdata[9].name,y:districtdata[9].data,drilldown:'lyantonde'},
                          {name:districtdata[16].name,y:districtdata[16].data,drilldown:'Rakai'},
                          {name:districtdata[17].name,y:districtdata[17].data,drilldown:'Sembambule'},

                      ]
                  },
                  {
                      id: facilitydata[0].drilldown, //kampala
                      data:[
                          [facilitydata[4].name,facilitydata[4].data],[facilitydata[5].name,facilitydata[5].data],
                          [facilitydata[6].name,facilitydata[6].data],[facilitydata[7].name,facilitydata[7].data],
                          [facilitydata[8].name,facilitydata[8].data]

                      ]
                  },
                  {
                      id: facilitydata[1].drilldown, //Wakiso
                      data:[
                          [facilitydata[39].name,facilitydata[39].data],
                          [facilitydata[40].name,facilitydata[40].data],[facilitydata[41].name,facilitydata[41].data],
                          [facilitydata[42].name,facilitydata[42].data],[facilitydata[43].name,facilitydata[43].data]
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
                          [facilitydata[2].name,facilitydata[2].data]
                      ]
                  },
                  {
                      id: 'lwengo',
                      data:[
                          [facilitydata[16].name,facilitydata[16].data],[facilitydata[17].name,facilitydata[17].data]
                      ]
                  },
                  {
                      id: 'lyantonde',
                      data:[
                          [facilitydata[18].name,facilitydata[18].data]
                      ]
                  },
                  {
                      id: 'Masaka',
                      data:[
                          [facilitydata[19].name,facilitydata[19].data],[facilitydata[20].name,facilitydata[20].data],
                      ]
                  },
                  {
                      id: 'Rakai',
                      data:[
                          [facilitydata[31].name,facilitydata[31].data],[facilitydata[32].name,facilitydata[32].data],
                          [facilitydata[33].name,facilitydata[33].data]
                      ]
                  },
                  {
                      id: 'Sembambule',
                      data:[
                          [facilitydata[34].name,facilitydata[34].data],[facilitydata[35].name,facilitydata[35].data]
                      ]
                  },
                  {
                      id:chartperformancedata[2].drilldown,
                      data:[
                          {name:districtdata[24].name,y:districtdata[24].data,drilldown:'kabarole'},
                          {name:districtdata[25].name,y:districtdata[25].data,drilldown:'kamwenge'},
                          {name:districtdata[26].name,y:districtdata[26].data,drilldown:'kyenjonjo'}
                      ]
                  },
                  {
                      id: 'kabarole',
                      data:[
                          [facilitydata[59].name,facilitydata[59].data],[facilitydata[60].name,facilitydata[60].data],
                          [facilitydata[61].name,facilitydata[61].data]
                      ]
                  },
                  {
                      id: 'kamwenge',
                      data:[
                          [facilitydata[62].name,facilitydata[62].data],[facilitydata[63].name,facilitydata[63].data],
                          [facilitydata[64].name,facilitydata[64].data]
                      ]
                  },
                  {
                      id: 'kyenjonjo',
                      data:[
                          [facilitydata[67].name,facilitydata[67].data]
                      ]
                  },

                  {
                      id:chartperformancedata[3].drilldown,
                      data:[
                          {name:districtdata[28].name,y:districtdata[28].data,drilldown:'kaberamaido'},
                          {name:districtdata[29].name,y:districtdata[29].data,drilldown:'katakwi'},
                          {name:districtdata[30].name,y:districtdata[30].data,drilldown:'Serere'},
                          {name:districtdata[31].name,y:districtdata[31].data,drilldown:'Soroti'}
                      ]
                  },
                  {
                      id:'kaberamaido',
                      name:'kaberamaido',
                      data:[
                          [facilitydata[44].name,facilitydata[44].data]
                      ]
                  },
                  {
                      id:'katakwi',
                      data:[
                          [facilitydata[45].name,facilitydata[45].data],[facilitydata[46].name,facilitydata[46].data],[facilitydata[56].name,facilitydata[56].data]
                      ]
                  },
                  {
                      id:'Serere',
                      data:[
                          [facilitydata[47].name,facilitydata[47].data]
                      ]
                  },
                  {
                      id:'Soroti',
                      data:[
                          [facilitydata[48].name,facilitydata[48].data]
                      ]
                  },
                  {
                      id:chartperformancedata[4].drilldown,
                      name:'MILDMAY',
                      data:[
                          {name:districtdata[33].name,y:districtdata[33].data,drilldown:'kiboga'},
                          {name:districtdata[34].name,y:districtdata[34].data,drilldown:'Kyankwanzi'},
                          {name:districtdata[35].name,y:districtdata[35].data,drilldown:'luweero'},
                          {name:districtdata[36].name,y:districtdata[36].data,drilldown:'Mityana'},
                          {name:districtdata[37].name,y:districtdata[37].data,drilldown:'Mubende'},
                          {name:districtdata[38].name,y:districtdata[38].data,drilldown:'Nakaseke'},
                          {name:districtdata[39].name,y:districtdata[39].data,drilldown:'Nakasongola'},
                          {name:districtdata[40].name,y:districtdata[40].data,drilldown:'Kassanda'},


                      ]
                  },
                  {
                      id:'kiboga',
                      name:'KIBOGA',
                      data:[
                          [facilitydata[9].name,facilitydata[9].data],
                          [facilitydata[10].name,facilitydata[10].data]
                      ]
                  },
                  {
                      id:'Kyankwanzi',
                      name:'KYANKWANZI',
                      data:[
                          [facilitydata[11].name,facilitydata[11].data]
                      ]
                  },
                  {
                      id:'luweero',
                      name:'LUWEERO',
                      data:[
                          [facilitydata[12].name,facilitydata[12].data],
                          [facilitydata[13].name,facilitydata[13].data],
                          [facilitydata[14].name,facilitydata[14].data]
                      ]
                  },
                  {
                      id:'Mityana',
                      name:'MITYANA',
                      data:[
                          [facilitydata[21].name,facilitydata[21].data],
                          [facilitydata[22].name,facilitydata[22].data],
                          [facilitydata[23].name,facilitydata[23].data]
                      ]
                  },
                  {
                      id:'Mubende',
                      name:'MUBENDE',
                      data:[
                          [facilitydata[27].name,facilitydata[27].data]
                      ]
                  },
                  {
                      id:'Nakaseke',
                      name:'NAKASEKE',
                      data:[
                          [facilitydata[28].name,facilitydata[28].data],
                          [facilitydata[29].name,facilitydata[29].data]
                      ]
                  },
                  {
                      id:'Nakasongola',
                      name:'NAKASONGOLA',
                      data:[
                          [facilitydata[30].name,facilitydata[30].data],
                      ]
                  },
                  {
                      id:'Kassanda',
                      name:'KASSANDA',
                      data:[
                          [facilitydata[73].name,facilitydata[73].data],
                      ]
                  },
                  {
                      id:chartperformancedata[5].drilldown, //idi western and westnile
                      name:'IDI W&WN',
                      data:[
                          {name:districtdata[42].name,y:districtdata[42].data,drilldown:'Arua'},
                          {name:districtdata[43].name,y:districtdata[43].data,drilldown:'Nebbi'},
                          {name:districtdata[44].name,y:districtdata[44].data,drilldown:'Hoima'},
                          {name:districtdata[45].name,y:districtdata[45].data,drilldown:'Kibaale'},
                          {name:districtdata[46].name,y:districtdata[46].data,drilldown:'Masindi'},
                          {name:districtdata[47].name,y:districtdata[47].data,drilldown:'kagadi'},
                          {name:districtdata[48].name,y:districtdata[48].data,drilldown:'Paidha'}
                      ]
                  },
                  {
                      id:'Arua',
                      name:'ARUA',
                      data:[
                          [facilitydata[49].name,facilitydata[49].data],
                          [facilitydata[50].name,facilitydata[50].data],
                          [facilitydata[51].name,facilitydata[51].data],
                          [facilitydata[52].name,facilitydata[52].data],
                          [facilitydata[53].name,facilitydata[53].data],
                      ]
                  },
                  {
                      id:'Nebbi',
                      name:'NEBBI',
                      data:[
                          [facilitydata[54].name,facilitydata[54].data],
                          [facilitydata[55].name,facilitydata[55].data],
                         ]
                  },
                  {
                      id:'Hoima',
                      name:'HOIMA',
                      data:[
                          [facilitydata[56].name,facilitydata[56].data],
                          [facilitydata[57].name,facilitydata[57].data],
                          [facilitydata[58].name,facilitydata[58].data],

                      ]
                  },
                  {
                      id:'kibaale',
                      name:'KIBAALE',
                      data:[
                          [facilitydata[65].name,facilitydata[65].data],
                          [facilitydata[66].name,facilitydata[66].data],
                      ]
                  },
                  {
                      id:'Masindi',
                      name:'MASINDI',
                      data:[
                          [facilitydata[68].name,facilitydata[68].data],
                          [facilitydata[69].name,facilitydata[69].data],

                      ]
                  },
                  {
                      id:'kagadi',
                      name:'KAGADI',
                      data:[
                          [facilitydata[70].name,facilitydata[70].data],
                      ]
                  },
                  {
                      id:'Paidha',
                      name:'PAIDHA',
                      data:[
                          [facilitydata[72].name,facilitydata[72].data],
                      ]
                  },


              ]

            },



        });
    })

});

