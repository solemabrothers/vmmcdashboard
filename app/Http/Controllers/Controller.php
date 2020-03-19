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
    $districts=DB::table('district')->get();
        $numbersHIVnegative=DB::select('SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c   where c.SummaryDate >= \'2019-10-01\'');
        $numbersHIVpositive =DB::select('SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c  where c.SummaryDate >= \'2019-10-01\'');

        $SeverelyAffected =DB::select(' SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+
 +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+
 SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberMildExcessiveBleeding)+
 +SUM(c.NumberMildSwellingHaematoma)
  +SUM(c.NumberModerateInfection) As ClientsAffected
  FROM mets_vmmc.circumcision c   where c.SummaryDate >= \'2019-10-01\'');
  $adverseeventsbyfacility = DB::select('SELECT Ip.Ip_name,d.District_name,f.facility_name,f.Facility,SUM(c.NumberSevereSwellingHaematoma)
+SUM(c.NumberSevereAnaestheticRelatedEvent)+SUM(c.NumberSevereDamageToPenis)+SUM(c.NumberSevereExcessiveBleeding)
+SUM(c.NumberSevereInfection)+SUM(c.NumberSeverePain)AS Severe,
    SUM(c.NumberMildExcessiveBleeding)+SUM(c.NumberMildSwellingHaematoma)+SUM(c.NumberModerateInfection)
    +SUM(c.NumberMildAnaestheticRelatedEvent)+SUM(c.NumberMildDamageToPenis)+SUM(c.NumberMildExcessiveSkinRemoved)
    +SUM(c.NumberMildPain)As ClientsAffected
      FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate >= \'2019-10-01\'  group by facility,implementingpartner
      HAVING  ClientsAffected !=0 OR Severe!=0');

$clientsHIVPositivebyfacility =DB::select('SELECT Ip.Ip_name, d.District_name, f.facility_name,SUM(c.NumberHIVPositive) as positive
FROM mets_vmmc.circumcision c,mets_vmmc.facility f , mets_vmmc.implementingpartner Ip, mets_vmmc.district d
 WHERE  c.Facility=f.Facility AND c.ImplementingPartner= Ip.IP_ID  AND f.district_id= d.district_id
  AND c.SummaryDate >= \'2019-10-01\' group by c.Facility,c.ImplementingPartner
  HAVING positive !=0');

        $monthly_data = DB::select('SELECT  i.Ip_name as ipmechanism,SUM(c.NumberCircumcisedBelow10) as category1, SUM(c.NumberCircumcisedBetween10And14) as category2,SUM(c.NumberCircumcisedBetween15And19)as category3,
SUM(c.NumberCircumcisedBetween20And24) as category4,SUM(c.NumberCircumcisedBetween25And29) as category5,SUM(c.NumberCircumcisedBetween30And34) as category6,
SUM(c.NumberCircumcisedBetween35And39) as category7,SUM(c.NumberCircumcisedBetween40And44) as category8,SUM(NumberCircumcisedBetween45And49)as category9,
SUM(c.NumberCircumcisedBetween50And54)+ SUM(c.NumberCircumcisedBetween55And59)+ SUM(c.NumberCircumcised60andabove) as category10
from circumcision c
inner join implementingpartner i on c.ImplementingPartner = i.IP_ID
where c.SummaryDate >= \'2019-10-01\'
group by IP_ID');


        $totalnumbercircumscised =DB::select('SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c
where c.SummaryDate >= \'2019-10-01\'');

        $totaltarget =DB::select('SELECT SUM(TARGET) as target from ipmechanismtargets t  where t.Year_of_target=\'2020\'');

 $totalnumbercircumscisedusingdevices=DB::select('select SUM(NumberDeviceType) as DevicesUsed from circumcision c where c.SummaryDate >=\'2019-10-01\'');
 $facilitiesusingdevices=DB::select('SELECT Ip.Ip_name,d.District_name,f.facility_name,f.Facility,SUM(c.NumberDeviceType) AS DevicesUsed
      FROM mets_vmmc.circumcision c,mets_vmmc.implementingpartner Ip,mets_vmmc.district d, mets_vmmc.facility f WHERE c.ImplementingPartner=Ip.IP_ID AND c.Facility=f.Facility AND f.district_id=d.district_id
      AND c.SummaryDate >= \'2019-10-01\'  group by facility,implementingpartner
HAVING DevicesUsed !=0');
        $totalperformance =number_format(($totalnumbercircumscised[0]->total/$totaltarget[0]->target)*100,2,'.','');
       return view('layouts.home', compact('districts','ips','totalperformance','totaltarget','totalnumbercircumscised','adverseeventsbyfacility','facilitiesusingdevices','SeverelyAffected','monthly_data','modelObjectJson','numbersHIVnegative','clientsHIVPositivebyfacility','numbersHIVpositive','clientsAffected','totalnumbercircumscisedusingdevices'));
    }


}

