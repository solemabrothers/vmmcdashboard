<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\PieChart;

use Illuminate\Routing\Controller as BaseController;
class FilterData extends BaseController
{
    public function index(Request $request)
    {
       
        $Ip_ID = $request->input('ips');
               
        $ips = DB::table('implementingpartner')->get();
        $startDate =$request->input('startdate');
        $endDate =$request->input('enddate');

        $regions=DB::table('region')->get();
        $districts=DB::table('district')->get();


        if($Ip_ID!=0)
        {
        $Ip_name =DB::table('implementingpartner')->select('Ip_name as IP')->where('Ip_ID','=',$Ip_ID)->get();

        $Ip_weekly_performance =DB::select("SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c WHERE c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
         $clientsHIVnegative=DB::select("SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c  WHERE c.ImplementingPartner='$Ip_ID' AND DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
         $clientsHIVpositive =DB::select("SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  WHERE c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
         $weeklyadverseeffects = DB::select("SELECT Ip.Ip_name,Ip.Ip_ID,f.facility_name,d.District_name,SUM(c.NumberSevereSwellingHaematoma) AS Severe,
         SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
         FROM mets_vmmc.circumcision c 
         inner join facility f on(c.Facility=f.Facility) 
         inner join district d on(f.district_id=d.district_id)
         inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
         WHERE c.ImplementingPartner='$Ip_ID' AND DATE(c.SummaryDate) BETWEEN '$startDate' AND '$endDate' group by f.facility
         HAVING  ClientsAffected !=0 OR Severe!=0");
         $Ip_severeadverseeffects =DB::select("SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+ 
         +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+ 
         SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+
         +SUM(c.NumberMildSwellingHaematoma)
          +SUM(c.NumberModerateInfection) As ClientsAffected
          FROM mets_vmmc.circumcision c WHERE c.ImplementingPartner='$Ip_ID' AND DATE(c.SummaryDate) between '$startDate' AND '$endDate'");


         $HIVpositiveclients =DB::select("SELECT Ip.Ip_name, d.District_name, f.facility_name,SUM(c.NumberHIVPositive) as positive 
         FROM mets_vmmc.circumcision c 
         inner join facility f on(c.Facility=f.Facility) 
         inner join district d on(f.district_id=d.district_id)
         inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
         WHERE c.ImplementingPartner='$Ip_ID' AND DATE(c.SummaryDate) BETWEEN '$startDate' AND '$endDate' group by f.facility
         HAVING  positive !=0");

            $below10 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBelow10');
            $Between10And14 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween10And14');
            $Between15And19 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween15And19');
            $Between20And24 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween20And24');
            $Between26And30 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween25And29');
            $Between31And34= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween30And34');
            $Between35And39= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween35And39');
            $Between40And44= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->sum('NumberCircumcisedBetween40And44');
            $Above45= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->whereRaw("ImplementingPartner='$Ip_ID'")->value(DB::raw("SUM(NumberCircumcisedBetween45And49+NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)"));
                
            $below10= new PieChart('< 10',$below10);
            $Between10And14= new PieChart('10-14',$Between10And14);
            $Between15And19= new PieChart('15-19',$Between15And19);
            $Between20And24= new PieChart('20-24',$Between20And24);
            $Between26And30= new PieChart('25-29',$Between26And30);
            $Between31And34= new PieChart('30-34',$Between31And34);
            $Between35And39= new PieChart('35-39',$Between35And39);
            $Between40And44= new PieChart('40-44',$Between40And44);
            $Above45= new PieChart('>45',$Above45);
            $piechartArray= array($below10,$Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Above45);

            $Ip_District_output =DB::select("SELECT d.District_name,                                 
            SUM(c.NumberCircumcised) As Clients 
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate) between '$startDate' AND '$endDate' GROUP BY f.district_id");

 
        }
        else{
        $Ip_name =DB::table('implementingpartner')->select('Ip_name as IP')->where('Ip_ID','=',14)->get();

            $Ip_weekly_performance =DB::select("SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c  WHERE DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
            $clientsHIVnegative=DB::select("SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c  WHERE  DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
            $clientsHIVpositive =DB::select("SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  WHERE  DATE(c.SummaryDate) between '$startDate' AND '$endDate'");
            $weeklyadverseeffects = DB::select("SELECT Ip.Ip_name,Ip.Ip_ID,f.facility_name,d.District_name,SUM(c.NumberSevereSwellingHaematoma) AS Severe,
         SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
         FROM mets_vmmc.circumcision c 
         inner join facility f on(c.Facility=f.Facility) 
         inner join district d on(f.district_id=d.district_id)
         inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
         WHERE DATE(c.SummaryDate) BETWEEN '$startDate' AND '$endDate' group by f.facility
         HAVING  ClientsAffected !=0 OR Severe!=0");
         $Ip_severeadverseeffects =DB::select("SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+ 
         +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+ 
         SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+
         +SUM(c.NumberMildSwellingHaematoma)
          +SUM(c.NumberModerateInfection) As ClientsAffected
          FROM mets_vmmc.circumcision c WHERE DATE(c.SummaryDate) between '$startDate' AND '$endDate'");

        $HIVpositiveclients =DB::select("SELECT Ip.Ip_name, d.District_name, f.facility_name,SUM(c.NumberHIVPositive) as positive 
        FROM mets_vmmc.circumcision c 
        inner join facility f on(c.Facility=f.Facility) 
        inner join district d on(f.district_id=d.district_id)
        inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
        WHERE DATE(c.SummaryDate) BETWEEN '$startDate' AND '$endDate' group by f.facility
        HAVING  positive !=0");

        $below10 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])-> sum('NumberCircumcisedBelow10');
        $Between10And14 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween10And14');
        $Between15And19 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween15And19');
        $Between20And24 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween20And24');
        $Between26And30 = DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween25And29');
        $Between31And34= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween30And34');
        $Between35And39= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween35And39');
        $Between40And44= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->sum('NumberCircumcisedBetween40And44');
        $Above45= DB::table('circumcision')->WHEREBETWEEN('SummaryDate',[$startDate, $endDate])->value(DB::raw("SUM(NumberCircumcisedBetween45And49+NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)"));
            
        $below10= new PieChart('< 10',$below10);
        $Between10And14= new PieChart('10-14',$Between10And14);
        $Between15And19= new PieChart('15-19',$Between15And19);
        $Between20And24= new PieChart('20-24',$Between20And24);
        $Between26And30= new PieChart('25-29',$Between26And30);
        $Between31And34= new PieChart('30-34',$Between31And34);
        $Between35And39= new PieChart('35-39',$Between35And39);
        $Between40And44= new PieChart('40-44',$Between40And44);
        $Above45= new PieChart('>45',$Above45);
        $piechartArray= array($below10,$Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Above45);

        $Ip_District_output =DB::select("SELECT d.District_name,                                 
        SUM(c.NumberCircumcised) As Clients 
        FROM mets_vmmc.circumcision c,facility f,district d
        WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID  AND  DATE(c.SummaryDate) between '$startDate' AND '$endDate' GROUP BY f.district_id");

}
// return $Ip_name;

return view('layouts.filterdata', compact('districts','ips','Ip_name','Ip_District_output','regions','endDate','startDate','weeklyadverseeffects','Ip_severeadverseeffects','annual_ip_performance','modelObjectJson', 'Ip_weekly_performance','clientsHIVnegative','HIVpositiveclients','clientsHIVpositive','clientsAffected','piechartArray'));    
       
    
    
}

}
// /Users/ssolomon/Projects/vmmcdashboard/app/Http/Controllers/FilterData.php

