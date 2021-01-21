<?php

namespace App\Http\Controllers;

use App\Models\Circumscission;
use App\Models\District;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CummulativePerformanceController extends Controller
{
   public function getCumulativeData()
   {
       $newYear = new Carbon('first day of January 2018');
       $today = Carbon::today();
       $ips = DB::table('implementingpartner')->get();
        $regions=DB::table('region')->get();
        $districts=DB::table('district')->get();
        $annualclients = DB::select('SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c WHERE YEAR(c.SummaryDate) = YEAR(CURDATE())');
        $negativeclients = DB::select("SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c  WHERE YEAR(c.SummaryDate) = YEAR(CURDATE())");
        $positiveclients = DB::select("SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  WHERE YEAR(c.SummaryDate) = YEAR(CURDATE())");
        $severlyaffected = DB::select("SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+ 
        +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+ 
        SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)
        As ClientsAffected
         FROM mets_vmmc.circumcision c WHERE YEAR(c.SummaryDate) = YEAR(CURDATE())");
         $moderateadverseeffects = DB::select('SELECT SUM(c.NumberMildAnaestheticRelatedEvent)+ SUM(c.NumberMildDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+ 
         +SUM(c.NumberMildExcessiveSkinRemoved)+ SUM(c.NumberMildInfection)+ 
         SUM(c.NumberMildPain)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberMildExcessiveBleeding)+
         +SUM(c.NumberMildSwellingHaematoma)
          +SUM(c.NumberModerateInfection)+ SUM(c.NumberModerateAnaestheticRelatedEvent)+ SUM(c.NumberModerateDamageToPenis)
          + SUM(c.NumberModerateExcessiveBleeding)+SUM(c.NumberModerateExcessiveSkinRemoved)
          +SUM(c.NumberModeratePain)+SUM(c.NumberModerateSwellingHaematoma)As ClientsAffected
          FROM mets_vmmc.circumcision c WHERE YEAR(c.SummaryDate) = YEAR(CURDATE())');
        return view('layouts.cumulativedata', compact('annualclients','severlyaffected','newYear','today','moderateadverseeffects','districts','ips','negativeclients','regions','positiveclients','SeverelyAffected','monthly_data','clientsAffected'));
    //  return $annualclients;
   }
   public function getIpmechanismPerfomanceAnnually()
   {
       $ipmechanismperformance = DB::select("SELECT Ip.Ip_name, SUM(NumberCircumcised) As Ip_performance FROM mets_vmmc.circumcision c, mets_vmmc.implementingpartner Ip
       WHERE c.ImplementingPartner=Ip.IP_ID and YEAR(c.SummaryDate) = YEAR(CURDATE()) group by implementingpartner");
       for($i=0;$i<sizeof($ipmechanismperformance);$i++)
       {
           $ip_name[] = $ipmechanismperformance[$i]->Ip_name;

       }
       for($i=0;$i<sizeof($ipmechanismperformance);$i++)
       {
           $performance[] = $ipmechanismperformance[$i]->Ip_performance;
       }

        $ipmechanismperformance_result= array();
        array_push($ipmechanismperformance_result,$ip_name);
        array_push($ipmechanismperformance_result,$performance);
        return json_encode($ipmechanismperformance_result,JSON_NUMERIC_CHECK);
       return $ipmechanismperformance_result;
   }

}
