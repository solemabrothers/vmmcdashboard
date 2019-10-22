<?php

namespace App\Http\Controllers;

use App\AnalysisGraphs;
use App\Models\District;
use App\Models\ImplementingPartner;
use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Expr\Array_;
use Carbon\Carbon;

class ImplementingPartnerController extends Controller
{

    //return all the facilities supported by perticular facilities;

    public function NumbersByIp()
    {
      $ip_performance=DB::select('SELECT Ip.Ip_name, SUM(NumberCircumcised) As Ip_performance FROM mets_vmmc.circumcision c, mets_vmmc.implementingpartner Ip
  WHERE c.ImplementingPartner=Ip.IP_ID and  YEARWEEK(c.SummaryDate) = YEARWEEK(NOW() - INTERVAL 1 WEEK) group by implementingpartner')  ;
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
    public function Ip_Category()
{
        $ip_performance_by_agegroup=DB::select('SELECT ip.Ip_name, SUM(c.NumberCircumcisedBelow10) As Lessthan10, 
       SUM(c.NumberCircumcisedBetween10And14) As Between11AND14,
       SUM(c.NumberCircumcisedBetween15And19)+SUM(c.NumberCircumcisedBetween20And24)+SUM(c.NumberCircumcisedBetween26And29) As PivotAge,
       SUM(c.NumberCircumcisedBetween31And34)+SUM(c.NumberCircumcisedBetween35And39)+SUM(c.NumberCircumcisedBetween40And44)+SUM(c.NumberCircumcisedBetween45And49)+
       SUM(c.NumberCircumcisedBetween45And49)+SUM(c.NumberCircumcisedBetween50And54)+SUM(c.NumberCircumcisedBetween55And59)+SUM(c.NumberCircumcised60andabove) As Above30
       
       FROM mets_vmmc.circumscission  c, mets_vmmc.implementing_partner ip WHERE c.ImplementingPartner=ip.IP_ID group by c.ImplementingPartner');

        $category['name']='Levels';
        $series1['name']='IDI';
        $series2['name']='BAYLOR';
        $series3['name']='URC';
        for($i=0;$i< sizeof($ip_performance_by_agegroup);$i++)
        {

        }


        echo'<pre>';
        print_r( $ip_performance_by_agegroup);
}


//IP Mechanism Performance by targets
public function IpMechanismPerfomanceandTarget()
{
    $performanceandtarget=DB::select('SELECT Ip_name As Ipmechanismname, sum(NumberCircumcised) as ipmechanismperformance,TARGET as ipmechanismtarget from implementingpartner
                                                       inner join circumcision c on implementingpartner.IP_ID = c.ImplementingPartner
                                                       inner join ipmechanismtargets t on implementingpartner.IP_ID = t.IP_ID
where c.SummaryDate >= \'2018-10-01 00:00:00\' group by ImplementingPartner');
     for($i=0;$i<sizeof($performanceandtarget);$i++)
     {
         $ipmechanismname[] = $performanceandtarget[$i]-> Ipmechanismname;
     }
    for($i=0;$i<sizeof($performanceandtarget);$i++)
    {
        $ipmechanismtarget[] = $performanceandtarget[$i]-> ipmechanismtarget;
    }
    for($i=0;$i<sizeof($performanceandtarget);$i++)
    {
        $ipmechanismperformance[] = $performanceandtarget[$i]-> ipmechanismperformance;
    }
    $result = array();

    array_push($result,$ipmechanismname);
    array_push($result,$ipmechanismtarget);
    array_push($result,$ipmechanismperformance);
    return json_encode($result,JSON_NUMERIC_CHECK);

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
                 FROM mets_vmmc.circumcision c  WHERE "quarter" IS NOT NULL AND YEAR(c.SummaryDate)=YEAR(CURDATE()) group by quarter(c.SummaryDate) order by c.SummaryDate;');

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
