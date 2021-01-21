<?php

namespace App\Http\Controllers;

use App\AnalysisGraphs;
use App\Models\District;
use App\Models\ImplementingPartner;
use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Expr\Array_;
use App\Http\Controllers\FacilityController;
use Carbon\Carbon;

class ImplementingPartnerController extends Controller
{


    public function NumbersByIp()
    {
      $ip_performance=DB::select('SELECT Ip.Ip_name, SUM(NumberCircumcised) As Ip_performance FROM mets_vmmc.circumcision c, mets_vmmc.implementingpartner Ip
  WHERE c.ImplementingPartner=Ip.IP_ID and YEARWEEK(SummaryDate)=YEARWEEK(NOW() - INTERVAL 1 WEEK) group by implementingpartner')  ;
       for($i=0;$i<sizeof($ip_performance);$i++)
       {
           $ip_name[] = $ip_performance[$i]->Ip_name;

       }
       for($i=0;$i<sizeof($ip_performance);$i++)
       {
           $performance[] = $ip_performance[$i]->Ip_performance;
       }

        $ipz_result= array();

        array_push($ipz_result,$ip_name);
        array_push($ipz_result,$performance);
        return json_encode($ipz_result,JSON_NUMERIC_CHECK);
     return $ipz_result;

    }


public function AdverseEffects()
{
        $adverse_effects = DB::select('SELECT concat( date_format( MAKEDATE(YEAR(c.SummaryDate), 1) + INTERVAL QUARTER(c.SummaryDate) QUARTER 
                                       - INTERVAL    1 QUARTER, \'%b \'), \' - \', 
				date_format(MAKEDATE(YEAR(c.SummaryDate), 1) + INTERVAL QUARTER(c.SummaryDate) QUARTER 
                                       - INTERVAL    1 DAY, \'%b %Y\')) as `quarter`,	             
			SUM(c.NumberSevereAnaestheticRelatedEvent)+SUM(c.NumberSevereDamageToPenis)+
                SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereExcessiveSkinRemoved)+SUM(c.NumberSevereInfection)+
                SUM(c.NumberSeverePain)+SUM(c.NumberSevereSwellingHaematoma) As Severe,
                SUM(c.NumberMildAnaestheticRelatedEvent)+SUM(c.NumberMildDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildExcessiveSkinRemoved)+
                SUM(c.NumberMildInfection)+SUM(c.NumberMildPain)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateAnaestheticRelatedEvent)+
                SUM(c.NumberModerateDamageToPenis)+SUM(c.NumberModerateExcessiveBleeding)+SUM(c.NumberModerateExcessiveSkinRemoved)+SUM(c.NumberModerateInfection)+
                SUM(c.NumberModerateSwellingHaematoma) AS Moderate                
                 FROM mets_vmmc.Circumcision c  WHERE "quarter" IS NOT NULL AND YEAR(c.SummaryDate)=2018 group by quarter(c.SummaryDate) order by c.SummaryDate;');

         for($i=0;$i<sizeof($adverse_effects);$i++)
         {
             $quater[]=$adverse_effects[$i]->quarter;
         }
        for($i=0;$i<sizeof($adverse_effects);$i++)
            {
                $severe[]=$adverse_effects[$i]->Severe;
            }
    for($i=0;$i<sizeof($adverse_effects);$i++)
    {
        $moderate[]=$adverse_effects[$i]->Moderate;
    }
 $result = array();

         array_push($result,$quater);
         array_push($result,$severe);
         array_push($result,$moderate);
        return json_encode($result,JSON_NUMERIC_CHECK);
}





}
