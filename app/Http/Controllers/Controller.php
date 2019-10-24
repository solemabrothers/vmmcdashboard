<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\ImplementingPartner;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\AnalysisGraphs;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //populate the homepage
    public function index()
    {
     $ips = DB::table('implementingpartner')->get();
     $regions=DB::table('region')->get();
    $districts=DB::table('district')->get();
        $numbersHIVnegative=DB::select('SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c   where c.SummaryDate between \'2018-10-01\' and \'2019-09-30\'');
        $numbersHIVpositive =DB::select('SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  where c.SummaryDate between \'2018-10-01\' and \'2019-09-30\'');

        $SeverelyAffected =DB::select(' SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+
 +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+
 SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+
 +SUM(c.NumberMildSwellingHaematoma)
  +SUM(c.NumberModerateInfection) As ClientsAffected
  FROM mets_vmmc.circumcision c   where c.SummaryDate between \'2018-10-01\' and \'2019-09-30\'');
  $weeklyadverseeffects = DB::select('SELECT Ip.Ip_name,d.District_name,f.facility_name,f.Facility,SUM(c.NumberSevereSwellingHaematoma)
+SUM(c.NumberSevereAnaestheticRelatedEvent)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberSevereExcessiveBleeding)
+SUM(c.NumberSevereInfection)+SUM(c.NumberSeverePain)AS Severe,
    SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection)
    +SUM(c.NumberMildAnaestheticRelatedEvent)+SUM(c.NumberMildDamageToPenis)+SUM(c.NumberMildExcessiveSkinRemoved)
    +SUM(c.NumberMildPain)As ClientsAffected
      FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate between \'2018-10-01\' and \'2019-09-30\' group by facility,implementingpartner
      HAVING  ClientsAffected !=0 OR Severe!=0');

$HIVpositiveclients =DB::select('SELECT Ip.Ip_name, d.District_name, f.facility_name,SUM(c.NumberHIVPositive) as positive
FROM mets_vmmc.circumcision c,mets_vmmc.facility f , mets_vmmc.implementingpartner Ip, mets_vmmc.district d
 WHERE  c.Facility=f.Facility AND c.ImplementingPartner= Ip.IP_ID  AND f.district_id= d.district_id
  AND c.SummaryDate between \'2018-10-01\' and \'2019-09-30\' group by c.Facility,c.ImplementingPartner
  HAVING positive !=0');

        $monthly_data = DB::select('SELECT  District_name,
         SUM(IF (MONTH(c.SummaryDate) = 1, c.NumberCircumcised, 0)) AS January ,
         SUM(IF (MONTH(c.SummaryDate) = 2, c.NumberCircumcised, 0)) AS February ,
         SUM(IF (MONTH(c.SummaryDate) = 3, c.NumberCircumcised, 0)) AS March ,
         SUM(IF (MONTH(c.SummaryDate) = 4, c.NumberCircumcised, 0)) AS April ,
         SUM(IF (MONTH(c.SummaryDate) = 5, c.NumberCircumcised, 0)) AS May  ,
         SUM(IF (MONTH(c.SummaryDate) = 6, c.NumberCircumcised, 0)) AS June ,
         SUM(IF (MONTH(c.SummaryDate) = 7, c.NumberCircumcised, 0)) AS July ,
         SUM(IF (MONTH(c.SummaryDate) = 8, c.NumberCircumcised, 0)) AS August,
         SUM(IF (MONTH(c.SummaryDate) = 9, c.NumberCircumcised, 0)) AS September,
         SUM(IF (MONTH(c.SummaryDate) = 10, c.NumberCircumcised, 0)) AS October,
         SUM(IF (MONTH(c.SummaryDate) = 11, c.NumberCircumcised, 0)) AS November,
         SUM(c.NumberCircumcised) as  DistrictTotal FROM mets_vmmc.circumcision c, facility f, district d WHERE
          c.Facility = f.Facility AND f.district_id = d.District_ID AND YEAR(c.SummaryDate)=YEAR(CURDATE()) GROUP BY f.district_id
          UNION ALL
        SELECT   "TOTALS" as District_name,
                SUM(IF (MONTH(c.SummaryDate) = 1, c.NumberCircumcised, 0)) AS January ,
         SUM(IF (MONTH(c.SummaryDate) = 2, c.NumberCircumcised, 0)) AS February ,
         SUM(IF (MONTH(c.SummaryDate) = 3, c.NumberCircumcised, 0)) AS March ,
         SUM(IF (MONTH(c.SummaryDate) = 4, c.NumberCircumcised, 0)) AS April ,
         SUM(IF (MONTH(c.SummaryDate) = 5, c.NumberCircumcised, 0)) AS May  ,
         SUM(IF (MONTH(c.SummaryDate) = 6, c.NumberCircumcised, 0)) AS June ,
         SUM(IF (MONTH(c.SummaryDate) = 7, c.NumberCircumcised, 0)) AS July ,
         SUM(IF (MONTH(c.SummaryDate) = 8, c.NumberCircumcised, 0)) AS August,
         SUM(IF (MONTH(c.SummaryDate) = 9, c.NumberCircumcised, 0)) AS September,
         SUM(IF (MONTH(c.SummaryDate) = 10, c.NumberCircumcised, 0)) AS October,
         SUM(IF (MONTH(c.SummaryDate) = 11, c.NumberCircumcised, 0)) AS November,

                SUM(c.NumberCircumcised) AS TOTAL
        FROM  mets_vmmc.circumcision c where  YEAR(c.SummaryDate)=YEAR(CURDATE()) ');


        $totalnumbercircumscised =DB::select('SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c
where c.SummaryDate between \'2018-10-01\' and \'2019-09-30\'');

        $totaltarget =DB::select('SELECT SUM(TARGET) as target from mets_vmmc.ipmechanismtargets');


        $totalperformance =number_format(($totalnumbercircumscised[0]->total/$totaltarget[0]->target)*100,2,'.','');

        return view('layouts.home', compact('districts','ips','totalperformance','regions','weeklyadverseeffects','SeverelyAffected','monthly_data','modelObjectJson','numbersHIVnegative','HIVpositiveclients','numbersHIVpositive','clientsAffected'));
    }



    public function getfilteredData(Request $request)
    {
        // $ips = DB::table('ImplementingPartner')->get();
        $ips = DB::table('implementingpartner')->get();
        $regions=DB::table('region')->get();
        $districts=DB::table('district')->get();

        $ip_name = $request->input('ips');
        $today= Carbon::today();
        $yesterday=$today->subWeek();
       $sql= "SELECT SUM(circumcision.NumberCircumcised) As ipweeklyperformance  FROM `mets_vmmc`.`circumcision`
                        WHERE  circumcision.SummaryDate>=DATE (NOW() - INTERVAL 7 DAY) AND circumcision.ImplementingPartner=$ip_name";
       $ipweeklyperformance = DB::select(DB::raw($sql));

        $sql_query="SELECT SUM(circumcision.NumberHIVNegative) As ipnegativeclients  FROM `mets_vmmc`.`circumcision`
                        WHERE  circumcision.SummaryDate>=DATE (NOW() - INTERVAL 7 DAY) AND circumcision.ImplementingPartner=$ip_name";
        $numbersHIVnegative=DB::select(DB::raw($sql_query));

        $sql_positive="SELECT SUM(circumcision.NumberHIVPositive) As ippositiveclients  FROM `mets_vmmc`.`circumcision`
                        WHERE  circumcision.SummaryDate>=DATE (NOW() - INTERVAL 7 DAY) AND circumcision.ImplementingPartner=$ip_name";
        $numbersHIVpositive=DB::select(DB::raw($sql_positive));

        $clientsaffected ="SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+ 
                        +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+ 
                      SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis) As ClientsAffected
                    FROM mets_vmmc.circumcision c WHERE c.SummaryDate>=DATE (NOW() - INTERVAL 7 DAY) AND c.ImplementingPartner=$ip_name ";
        $clientsseverelyaffected=DB::select(DB::raw($clientsaffected));

        $monthlydistrictPerformance ="SELECT 
IFNULL(District_name, 'TOTAL') AS District_name,
 SUM(IF (MONTH(c.SummaryDate) = 1, c.NumberCircumcised, 0)) AS January ,
 SUM(IF (MONTH(c.SummaryDate) = 2, c.NumberCircumcised, 0)) AS February ,
 SUM(IF (MONTH(c.SummaryDate) = 3, c.NumberCircumcised, 0)) AS March ,
 SUM(IF (MONTH(c.SummaryDate) = 4, c.NumberCircumcised, 0)) AS April ,
 SUM(IF (MONTH(c.SummaryDate) = 5, c.NumberCircumcised, 0)) AS May  ,
 SUM(IF (MONTH(c.SummaryDate) = 6, c.NumberCircumcised, 0)) AS June ,
 SUM(IF (MONTH(c.SummaryDate) = 7, c.NumberCircumcised, 0)) AS July ,
   SUM(c.NumberCircumcised) as  DistrictTotal

FROM mets_vmmc.Circumcision c, facility f, District d WHERE
  c.Facility = f.Facility AND f.district_id = d.District_ID AND YEAR(c.SummaryDate)=2018  AND c.implementingpartner=$ip_name GROUP BY f.district_id WITH ROLLUP";
        $monthly_data = DB::select(DB::raw($monthlydistrictPerformance));
         return view('layouts.filterdata', compact('ipweeklyperformance','numbersHIVnegative','monthly_data','ips','numbersHIVpositive','clientsseverelyaffected'));




    }

}

