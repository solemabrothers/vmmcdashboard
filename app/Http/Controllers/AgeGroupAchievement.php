<?php

namespace App\Http\Controllers;

use App\AnalysisGraphs;
use App\Models\District;
use App\Models\Facility;
use App\Models\AgeGroupCategories;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class AgeGroupAchievement extends Controller
{

    public function index()
    {
            //TODO
    }

       public function numbersByAgeGroup()
    {
        $start_cop_year='2020-10-01';
       $Between10And14 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween10And14');
       $Between15And19 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween15And19');
       $Between20And24 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween20And24');
       $Between26And30 = DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween25And29');
       $Between31And34= DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween30And34');
       $Between35And39= DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween35And39');
        $Between40And44= DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween40And44');
        $Between45And49= DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->sum('NumberCircumcisedBetween45And49');
        $Above45= DB::table('circumcision')->whereRaw('SummaryDate >= \'2020-10-01\'')->value(DB::raw("SUM(NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)"));

        $Between10And14target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('10<14');
        $Between15And19target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('15<19');
        $Between20And24target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('20<24');
        $Between26And30target = DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('25<29');
        $Between31And34target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('30<34');
        $Between35And39target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('35<39');
        $Between40And44target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('40<44');
        $Between45And49target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('45<49');

        $Above50target= DB::table('ipmechanismtargets')->whereRaw('Year_of_target=\'2021\'')->sum('50>');

       $Between10And14= new AgeGroupCategories('10-14',$Between10And14,$Between10And14target);
       $Between15And19= new AgeGroupCategories('15-19',$Between15And19,$Between15And19target);
       $Between20And24= new AgeGroupCategories('20-24',$Between20And24,$Between20And24target);
       $Between26And30= new AgeGroupCategories('25-29',$Between26And30,$Between26And30target);
       $Between31And34= new AgeGroupCategories('30-34',$Between31And34,$Between31And34target);
       $Between35And39= new AgeGroupCategories('35-39',$Between35And39,$Between35And39target);
       $Between40And44= new AgeGroupCategories('40-44',$Between40And44,$Between40And44target);
        $Between45And49= new AgeGroupCategories('45-49',$Between45And49,$Between45And49target);

        $Above45= new AgeGroupCategories('>50',$Above45,$Above50target);

       $pichartArray= array($Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Between45And49,$Above45);
        for($i=0;$i<sizeof($pichartArray);$i++)
         {
            $agecategorynames[] =$pichartArray[$i]->objectname;
        }
        for($i=0;$i<sizeof($pichartArray);$i++)
        {
            $agecategoryperformance[] =$pichartArray[$i]->objectvalue;
        }
        for($i=0;$i<sizeof($pichartArray);$i++)
        {
            $agecategorytarget[] =$pichartArray[$i]->target;
        }
        $ageperformance = array();

        array_push($ageperformance,$agecategorynames);
        array_push($ageperformance,$agecategoryperformance);
        array_push($ageperformance,$agecategorytarget);

        return json_encode($ageperformance,JSON_NUMERIC_CHECK);
    }







    public function hivStatusClients()
    {
        $status_of_Clients = DB::select('SELECT monthname(SummaryDate) as months,
		SUM(c.NumberCircumcised) As Clients,SUM(c.NumberHIVPositive) AS HIVPOstive, SUM(c.NumberHIVNegative) As HIVNegative
 FROM mets_vmmc.circumcision c WHERE YEAR(SummaryDate)=YEAR(CURDATE())  group by monthname(c.SummaryDate) order by c.SummaryDate;');

        for($i=0;$i<sizeof($status_of_Clients);$i++)
        {
            $quarter[] = $status_of_Clients[$i]->months;
        }
        for($i=0;$i<sizeof($status_of_Clients);$i++)
        {
            $clients[] = $status_of_Clients[$i]->Clients;
        }
        for($i=0;$i<sizeof($status_of_Clients);$i++)
        {
            $clientspositive[] = $status_of_Clients[$i]->HIVPOstive;
        }
        for($i=0;$i<sizeof($status_of_Clients);$i++)
        {
            $clientsnegative[] = $status_of_Clients[$i]->HIVNegative;
        }

        $clientsstatus = array();

        array_push($clientsstatus,$quarter);
        array_push($clientsstatus,$clients);
        array_push($clientsstatus,$clientspositive);
        array_push($clientsstatus,$clientsnegative);
        return json_encode($clientsstatus,JSON_NUMERIC_CHECK);
    }

}

