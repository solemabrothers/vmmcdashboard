<?php

namespace App\Http\Controllers;
use App\Models\AgeGroupCategories;
use DB;
use Illuminate\Http\Request;
use App\Models\FilteredAgeGroups;

use Illuminate\Routing\Controller as BaseController;
class FilterData extends BaseController
{
    public function index(Request $request)
    {
        try{
        $Ip_ID = $request->input('ips');
        $districts_ID = $request->input('$districts');
        $ips = DB::table('implementingpartner')->get();
        $ipmechanismname = DB::select("SELECT implementingpartner.Ip_name from implementingpartner where implementingpartner.IP_ID='$Ip_ID'");
        $startDate =$request->input('startdate');
        $endDate =$request->input('enddate');

        $districts=DB::table('district')->get();
        if($Ip_ID!=0)
        {
            $ipmechanismname = DB::select("SELECT implementingpartner.Ip_name from implementingpartner where implementingpartner.IP_ID='$Ip_ID'");
            $Ip_mechanismachievement =DB::select("SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c WHERE c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate) >'2019-10-01'");
            $IP_target =DB::select("SELECT SUM(Total) As IpMechanismtarget from facilitytargets where ImplementingPartner = '$Ip_ID'");
            $devicesusedbyip=DB::select("select SUM(NumberDeviceType) as DevicesUsed from circumcision c where c.ImplementingPartner=ImplementingPartner = '$Ip_ID'  AND  DATE(c.SummaryDate) >'2019-10-01'");
            $ipmechanismperformance =number_format(($Ip_mechanismachievement[0]->total/$IP_target[0]->IpMechanismtarget)*100,2,'.','');
            $clientsHIVpositive=DB::select("SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  WHERE c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate) >'2019-10-01'");
            $ipadverseevents=DB::select("SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+
                                         SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
                                         FROM mets_vmmc.circumcision c   where c.ImplementingPartner='$Ip_ID' AND c.SummaryDate >= '2019-10-01'");

            $adverseeventsbyfacility=DB::Select("SELECT Ip.Ip_name,Ip.Ip_ID,f.facility_name,d.District_name,SUM(c.NumberSevereSwellingHaematoma) AS Severe,
         SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
         FROM mets_vmmc.circumcision c inner join facility f on(c.Facility=f.Facility) inner join district d on(f.district_id=d.district_id) inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
         WHERE c.ImplementingPartner='$Ip_ID'  AND DATE(c.SummaryDate)  >='2019-10-01' group by f.facility
         HAVING  ClientsAffected !=0 OR Severe!=0");
            $clientsHIVPositivebyfacility =DB::select("SELECT d.District_name, f.facility_name, SUM(c.NumberHIVPositive) As positive
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate)>='2019-10-01'
GROUP BY f.district_id");

            $facilitiesusingdevices=DB::select('SELECT Ip.Ip_name,d.District_name,f.facility_name,f.Facility,SUM(c.NumberDeviceType) AS DevicesUsed
      FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate >= \'2019-10-01\'  group by facility,implementingpartner HAVING DevicesUsed !=0');

            $districtperformance=DB::select("SELECT d.District_name,
            SUM(c.NumberCircumcised) As Achievement
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND c.ImplementingPartner='$Ip_ID' AND  DATE(c.SummaryDate)>='2019-10-01' GROUP BY f.district_id");

            $districttarget=DB::select("SELECT d.District_name,SUM(c.Total) As Target FROM mets_vmmc.facilitytargets c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND c.ImplementingPartner='$Ip_ID'  GROUP BY f.district_id");

            $ipAgeCategoryTargets=DB::select("Select SUM(ft.`10-14`) As '10-14' ,SUM(ft.`15-19`) As '15-19',SUM(ft.`20-24`) As '20-24',SUM(ft.`25-29`) As '25-29',SUM(ft.`30-34`) As '30-34',SUM(ft.`35-39`) As '35-39',SUM(ft.`40-44`) As '40-44',
                                                             SUM(ft.`45-49`) As '45-49',SUM(ft.`50+`) As 'Above50' from facilitytargets ft where ImplementingPartner ='$Ip_ID'");
            $ipAgeCategoryAchievements=DB::select("select SUM(NumberCircumcisedBetween10And14),SUM(NumberCircumcisedBetween15And19),SUM(NumberCircumcisedBetween20And24),
                                                        SUM(NumberCircumcisedBetween25And29), SUM(NumberCircumcisedBetween30And34),SUM(NumberCircumcisedBetween35And39),
                                                        SUM(NumberCircumcisedBetween40And44),SUM(NumberCircumcisedBetween45And49),SUm(NumberCircumcisedBetween50And54)+SUM(NumberCircumcisedBetween55And59) As Above50
                                              from circumcision  c where c.ImplementingPartner=1 and c.SummaryDate >='2019-10-01'");


            $ipagecategoryBetween10And14 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween10And14');
            $ipagecategoryBetween15And19 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween15And19');
            $ipagecategoryBetween20And24 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween20And24');
            $ipagecategoryBetween26And30 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween25And29');
            $ipagecategoryBetween31And34= DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween30And34');
            $ipagecategoryBetween35And39= DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween35And39');
            $ipagecategoryBetween40And44= DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween40And44');
            $ipagecategoryBetween45And49= DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")-> sum('NumberCircumcisedBetween45And49');
            $Above50= DB::table('circumcision')->whereRaw('SummaryDate >= \'2019-10-01\'')->whereRaw("ImplementingPartner='$Ip_ID'")->value(DB::raw("SUM(NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)"));

            $Between10And14target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('10<14');
            $Between15And19target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('15<19');
            $Between20And24target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('20<24');
            $Between26And30target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('25<29');
            $Between31And34target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('30<34');
            $Between35And39target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('35<39');
            $Between40And44target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('40<44');
            $Between45And49target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('45<49');
            $Above50target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2020\'')->whereRaw("IP_ID='$Ip_ID'")->SUM('50>');;


            $Between10And14= new AgeGroupCategories('10-14',$ipagecategoryBetween10And14,$Between10And14target);
            $Between15And19= new AgeGroupCategories('15-19',$ipagecategoryBetween15And19,$Between15And19target);
            $Between20And24= new AgeGroupCategories('20-24',$ipagecategoryBetween20And24,$Between20And24target);
            $Between26And30= new AgeGroupCategories('25-29',$ipagecategoryBetween26And30,$Between26And30target);
            $Between31And34= new AgeGroupCategories('30-34',$ipagecategoryBetween31And34,$Between31And34target);
            $Between35And39= new AgeGroupCategories('35-39',$ipagecategoryBetween35And39,$Between35And39target);
            $Between40And44= new AgeGroupCategories('40-44',$ipagecategoryBetween40And44,$Between40And44target);
            $Between45And49= new AgeGroupCategories('45-49',$ipagecategoryBetween45And49,$Between45And49target);
            $Above50= new AgeGroupCategories('>50',$Above50,$Above50target);

            $pichartArray= array($Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Between45And49,$Above50);


            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategorynames[] =$pichartArray[$i]->objectname;
            }
            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategoryperformance[] =$pichartArray[$i]->objectvalue;
            }
            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategorytarget[] =$pichartArray[$i]->target;
            }
            $ipAgeperformance = array();

            array_push($ipAgeperformance,$ipagecategorynames);
            array_push($ipAgeperformance,$ipagecategoryperformance);
            array_push($ipAgeperformance,$ipagecategorytarget);

            $facilityoutputperformance=DB::select("SELECT d.district_id,d.District_name,SUM(c.NumberCircumcised) as Achievement,ft.Total As Target,ROUND((sum(NumberCircumcised)/ft.Total*100),2) As Performance FROM mets_vmmc.facilitytargets ft,mets_vmmc.circumcision c ,facility f,district d
             WHERE  c.Facility=ft.Facility and  ft.Facility = f.Facility and c.SummaryDate>'2019-10-01' and c.ImplementingPartner=ft.implementingpartner and c.ImplementingPartner='$Ip_ID' AND f.district_id = d.District_ID group by d.district_id");
        }
        else {

              $districts_ID = $request->input('$districts');
              $ipmechanismname = DB::select("select d.District_name  as Ip_name from district d where d.district_id='$districts_ID'");
            $Ip_mechanismachievement =DB::select("SELECT  SUM(c.NumberCircumcised) As total
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01' GROUP BY f.district_id");
            $IP_target =DB::select("SELECT SUM(Total) As IpMechanismtarget from facilitytargets where district_id ='$districts_ID'");

            $devicesusedbyip=DB::select("SELECT   SUM(c.NumberDeviceType) As DevicesUsed FROM mets_vmmc.circumcision c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01' GROUP BY f.district_id");
            $ipmechanismperformance =number_format(($Ip_mechanismachievement[0]->total/$IP_target[0]->IpMechanismtarget)*100,2,'.','');

            $clientsHIVpositive=DB::select("SELECT   SUM(c.NumberHIVPositive) As positive
            FROM mets_vmmc.circumcision c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01' GROUP BY f.district_id");

            $ipadverseevents=DB::select("SELECT   SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+
         SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01' GROUP BY f.district_id");

            $adverseeventsbyfacility=DB::Select("SELECT Ip.Ip_name,Ip.Ip_ID,f.facility_name,d.District_name,SUM(c.NumberSevereSwellingHaematoma) AS Severe,
         SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection) As ClientsAffected
         FROM mets_vmmc.circumcision c inner join facility f on(c.Facility=f.Facility) inner join district d on(f.district_id=d.district_id) inner join implementingpartner Ip on (c.ImplementingPartner=Ip.IP_ID)
         WHERE d.district_id='$districts_ID'  AND DATE(c.SummaryDate)  >='2019-10-01' group by f.facility
         HAVING  ClientsAffected !=0 OR Severe!=0");


            $clientsHIVPositivebyfacility =DB::select("SELECT d.District_name, f.facility_name, SUM(c.NumberHIVPositive) As positive
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'
GROUP BY f.district_id");

            $facilitiesusingdevices=DB::select('
SELECT Ip.Ip_name,d.District_name,f.facility_name,f.Facility,SUM(c.NumberDeviceType) AS DevicesUsed
      FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE d.district_id=5 AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate >= \'2019-10-01\'  group by facility,implementingpartner HAVING DevicesUsed !=0');

            $districttarget=DB::select("SELECT f.facility_name as District_name ,c.Total As Target FROM mets_vmmc.facilitytargets c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");


             $districtperformance=DB::select("SELECT f.facility_name as District_name,
            SUM(c.NumberCircumcised) As Achievement
            FROM mets_vmmc.circumcision c,facility f,district d
            WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01' group by  f.Facility
");

             $distrctagecategory1=DB::select("SELECT   SUM(c.NumberCircumcisedBetween10And14) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
             $distrctagecategory2=DB::select("SELECT   SUM(c.NumberCircumcisedBetween15And19) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory3=DB::select("SELECT   SUM(c.NumberCircumcisedBetween20And24) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory4=DB::select("SELECT   SUM(c.NumberCircumcisedBetween25And29) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory5=DB::select("SELECT   SUM(c.NumberCircumcisedBetween30And34) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory6=DB::select("SELECT   SUM(c.NumberCircumcisedBetween35And39) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory7=DB::select("SELECT   SUM(c.NumberCircumcisedBetween40And44) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory8=DB::select("SELECT   SUM(c.NumberCircumcisedBetween45And49) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");
            $distrctagecategory9=DB::select("SELECT   SUM((NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)) As Achievement FROM mets_vmmc.circumcision c,facility f,district d  WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID' AND  DATE(c.SummaryDate)>='2019-10-01'");

            $facilityagecategory1=DB::select("SELECT  SUM(c.`10-14`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory2=DB::select("SELECT  SUM(c.`15-19`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory3=DB::select("SELECT  SUM(c.`20-24`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory4=DB::select("SELECT  SUM(c.`25-29`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory5=DB::select("SELECT  SUM(c.`30-34`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory6=DB::select("SELECT  SUM(c.`35-39`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory7=DB::select("SELECT  SUM(c.`40-44`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory8=DB::select("SELECT  SUM(c.`45-49`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");
            $facilityagecategory9=DB::select("SELECT  SUM(c.`50+`) As target FROM mets_vmmc.facilitytargets c,facility f,district d WHERE   c.Facility = f.Facility AND f.district_id = d.District_ID AND d.district_id='$districts_ID'");

            $Between10And14= new AgeGroupCategories('10-14',$distrctagecategory1[0]->Achievement,$facilityagecategory1[0]->target);
            $Between15And19= new AgeGroupCategories('15-19',$distrctagecategory2[0]->Achievement,$facilityagecategory2[0]->target);
            $Between20And24= new AgeGroupCategories('20-24',$distrctagecategory3[0]->Achievement,$facilityagecategory3[0]->target);
            $Between26And30= new AgeGroupCategories('25-29',$distrctagecategory4[0]->Achievement,$facilityagecategory4[0]->target);
            $Between31And34= new AgeGroupCategories('30-34',$distrctagecategory5[0]->Achievement,$facilityagecategory5[0]->target);
            $Between35And39= new AgeGroupCategories('35-39',$distrctagecategory6[0]->Achievement,$facilityagecategory6[0]->target);
            $Between40And44= new AgeGroupCategories('40-44',$distrctagecategory7[0]->Achievement,$facilityagecategory7[0]->target);
            $Between45And49= new AgeGroupCategories('45-49',$distrctagecategory8[0]->Achievement,$facilityagecategory8[0]->target);
            $Above50= new AgeGroupCategories('>50',$distrctagecategory9[0]->Achievement,$facilityagecategory9[0]->target);
            $pichartArray= array($Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Between45And49,$Above50);

            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategorynames[] =$pichartArray[$i]->objectname;
            }
            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategoryperformance[] =$pichartArray[$i]->objectvalue;
            }
            for($i=0;$i<sizeof($pichartArray);$i++)
            {
                $ipagecategorytarget[] =$pichartArray[$i]->target;
            }
            $ipAgeperformance = array();

            $facilityoutputperformance=DB::Select("SELECT f.facility_name,SUM(c.NumberCircumcised) as Achievement,ft.Total As Target,ROUND((sum(NumberCircumcised)/ft.Total*100),2) As Performance FROM mets_vmmc.facilitytargets ft,mets_vmmc.circumcision c ,facility f,district d WHERE  c.Facility=ft.Facility and  ft.Facility = f.Facility and c.SummaryDate>'2019-10-01' AND f.district_id = d.District_ID AND d.district_id='$districts_ID' group by f.Facility");

            array_push($ipAgeperformance,$ipagecategorynames);
            array_push($ipAgeperformance,$ipagecategoryperformance);
            array_push($ipAgeperformance,$ipagecategorytarget);
        }

        return view('layouts.filterdata',compact('ipAgeperformance','districts','ips','ipmechanismname','ipmechanismperformance','IP_target','districtperformance','Ip_mechanismachievement','devicesusedbyip','clientsHIVpositive','ipadverseevents','clientsHIVPositivebyfacility','adverseeventsbyfacility','facilitiesusingdevices','districttarget','facilityoutputperformance'));
}
catch (\Exception $exception)
{
    return back()->withError($exception->getMessage());
}
    }

}

