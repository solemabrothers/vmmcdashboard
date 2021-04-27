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

    //IP Mechanism Performance by targets
public function IpMechanismPerfomanceandTarget()
{
    $performanceandtarget=DB::select('SELECT Ip_name As Ipmechanismname, sum(NumberCircumcised) as ipmechanismperformance,TARGET as ipmechanismtarget from implementingpartner
                                                       inner join circumcision c on implementingpartner.IP_ID = c.ImplementingPartner
                                                       inner join ipmechanismtargets t on implementingpartner.IP_ID = t.IP_ID
where c.SummaryDate >= \'2018-10-01 00:00:00\' group by ImplementingPartner');
    $districtperformance=DB::select('SELECT Ip.IP_ID,d.district_id, d.District_name,SUM(c.NumberCircumcised)
AS totalperformance FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate between \'2018-10-01\' and \'2019-09-30\' group by implementingpartner,d.district_id');
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $ip_id[] = $districtperformance[$i]-> IP_ID;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $district_id[] = $districtperformance[$i]-> district_id;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $district_name[] = $districtperformance[$i]-> District_name;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $districtvalues[] = $districtperformance[$i]-> totalperformance;
    }

    $districtarray = array();

    array_push($districtarray,$ip_id);
    array_push($districtarray,$district_id);
    array_push($districtarray,$district_name);
    array_push($districtarray,$districtvalues);

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

    $combinedarray=array();
    array_push($combinedarray,$result);
    array_push($combinedarray,$districtarray);
   return json_encode($result,JSON_NUMERIC_CHECK);
// return $combinedarray[1][];
}
public function getIpperformnacebydistrict()
{
    $districtperformance=DB::select('SELECT Ip.IP_ID,d.district_id, d.District_name,SUM(c.NumberCircumcised)
AS totalperformance FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate between \'2018-10-01\' and \'2019-09-30\' group by implementingpartner,d.district_id');
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $ip_id[] = $districtperformance[$i]-> IP_ID;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $district_id[] = $districtperformance[$i]-> district_id;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $district_name[] = $districtperformance[$i]-> District_name;
    }
    for($i=0;$i<sizeof($districtperformance);$i++)
    {
        $districtvalues[] = $districtperformance[$i]-> totalperformance;
    }

    $districtarray = array();

    array_push($districtarray,$ip_id);
    array_push($districtarray,$district_id);
    array_push($districtarray,$district_name);
    array_push($districtarray,$districtvalues);

//    return json_encode($districtarray,JSON_NUMERIC_CHECK);
    return $districtperformance;
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

    public function IpMechanismdrilldowntesting()
    {
        $performanceandtarget=DB::select('SELECT implementingpartner.IP_ID, Ip_name As Ipmechanismname, sum(NumberCircumcised) as ipmechanismperformance,TARGET as ipmechanismtarget from implementingpartner
                                                       inner join circumcision c on implementingpartner.IP_ID = c.ImplementingPartner
                                                       inner join ipmechanismtargets t on implementingpartner.IP_ID = t.IP_ID
where c.SummaryDate >= \'2019-10-01 00:00:00\' AND t.Year_of_target=\'2020\' group by ImplementingPartner');
        $districtperformance=DB::select('SELECT Ip.IP_ID,d.district_id, d.District_name,SUM(c.NumberCircumcised)
AS totalperformance FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate >= \'2019-10-01\'  group by implementingpartner,d.district_id');

        $facilityperformance=DB::select('SELECT d.district_id,facility_name, SUM(NumberCircumcised) as facilitydata from mets_vmmc.circumcision c
                                        inner join facility f on c.Facility=f.Facility
                                        inner join district d on f.district_id = d.district_id
                                        WHERE c.SummaryDate >= \'2019-10-01\'
                                        group by f.Facility,d.district_id order by district_id');


        $combinedarray=array();
        array_push($combinedarray,$performanceandtarget);
        array_push($combinedarray,$districtperformance);
        array_push($combinedarray,$facilityperformance);
        return json_encode($combinedarray,JSON_NUMERIC_CHECK);
    }





}

