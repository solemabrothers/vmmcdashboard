<?php

namespace App\Http\Controllers;

use App\AnalysisGraphs;
use App\Models\District;
use App\Models\Facility;
use App\Models\PieChart;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class CircumscionPartnerController extends Controller
{

    public function index()
    {
        $facilities= DB::table('facility')->get();
        $clientsAffected = DB::table('circumscission')->select(DB::raw('SUM(NumberMildPain+NumberSeverePain+NumberMildExcessiveBleeding+NumberMildPain+
		NumberSeverePain+NumberMildExcessiveBleeding+NumberModerateExcessiveBleeding+NumberSevereExcessiveBleeding+NumberMildSwellingHaematoma+NumberMildSwellingHaematoma+
		NumberModerateSwellingHaematoma+NumberSevereSwellingHaematoma+NumberMildAnaestheticRelatedEvent+NumberModerateAnaestheticRelatedEvent+NumberSevereAnaestheticRelatedEvent+
		NumberMildExcessiveSkinRemoved+NumberModerateExcessiveSkinRemoved+NumberSevereExcessiveSkinRemoved+NumberMildInfection+NumberModerateInfection+NumberSevereInfection+
		NumberMildDamageToPenis+NumberModerateDamageToPenis+NumberSevereDamageToPenis)'))->get();


        
        echo'<pre>';
        print_r($clientsAffected);


    }

       public function numbersByAgeGroup()
    {
        $below10 = DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBelow10');
       $Between10And14 = DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween10And14');
       $Between15And19 = DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween15And19');
       $Between20And24 = DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween20And24');
       $Between26And30 = DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween25And29');
       $Between31And34= DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween30And34');
       $Between35And39= DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween35And39');
       $Between40And44= DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->sum('NumberCircumcisedBetween40And44');
       $Above45= DB::table('circumcision')->whereRaw('YEARWEEK(SummaryDate,2) = YEARWEEK(NOW() - INTERVAL 1 WEEK,2)')->value(DB::raw("SUM(NumberCircumcisedBetween45And49+NumberCircumcisedBetween50And54+NumberCircumcisedBetween55And59+NumberCircumcised60andabove)"));
       
        $below10= new PieChart('< 10',$below10);
       $Between10And14= new PieChart('10-14',$Between10And14);
       $Between15And19= new PieChart('15-19',$Between15And19);
       $Between20And24= new PieChart('20-24',$Between20And24);
       $Between26And30= new PieChart('25-29',$Between26And30);
       $Between31And34= new PieChart('30-34',$Between31And34);
       $Between35And39= new PieChart('35-39',$Between35And39);
       $Between40And44= new PieChart('40-44',$Between40And44);
       $Above45= new PieChart('>45',$Above45);
       

       $pichartArray= array($below10,$Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44,$Above45);

      return $pichartArray;

    }
    //test the age categories functionality
    public function getAgeCategories()
    {

       $today= Carbon::today();
       $yesterday=$today->subDays(7);
       $category = DB::table('Circumcision')->where('SummaryDate','>=',$yesterday)->value(DB::raw("SUM(NumberCircumcisedBetween10And14 + NumberCircumcisedBetween15And19)"));
       return $category;
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
// /Users/ssolomon/Projects/vmmcdashboard/app/Http/Controllers/CircumscionPartnerController.php
