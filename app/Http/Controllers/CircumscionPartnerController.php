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
        $start_week = Carbon::today()->startOfWeek();
        $end_week = Carbon::today()->endOfWeek();

        $Below10 = DB::table('Circumcision')->whereBetween('SummaryDate',array($end_week,$start_week))->sum('NumberCircumcisedBelow10');
        $Between10And14 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween10And14');
        $Between15And19 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween15And19');
        $Between20And24 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween20And24');
        $Between26And30 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween25And29');
        $Between31And34 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween30And34');
        $Between35And39 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween35And39');
        $Between40And44 = DB::table('Circumcision')->whereBetween('SummaryDate',array($start_week,$end_week))->sum('NumberCircumcisedBetween40And44');

        $below10= new PieChart('Lessthan 10',$Below10);
        $Between10And14= new PieChart('Between10And14',$Between10And14);
        $Between15And19= new PieChart('Between15And19',$Between15And19);
        $Between20And24= new PieChart('Between20And24',$Between20And24);
        $Between26And30= new PieChart('Between26And30',$Between26And30);
        $Between31And34= new PieChart('Between31And34',$Between31And34);
        $Between35And39= new PieChart('Between35And39',$Between35And39);
        $Between40And44= new PieChart('Between40And44',$Between40And44);

        $pichartArray= array($below10,$Between10And14,$Between15And19,$Between20And24,$Between26And30,$Between31And34,$Between35And39,$Between40And44);

       return $pichartArray;


    }
    public function hivStatusClients()
    {
        $status_of_Clients = DB::select('SELECT monthname(SummaryDate) as months,                                        
		SUM(c.NumberCircumcised) As Clients,SUM(c.NumberHIVPositive) AS HIVPOstive, SUM(c.NumberHIVNegative) As HIVNegative
 FROM mets_vmmc.Circumcision c WHERE YEAR(SummaryDate)= 2018 group by monthname(c.SummaryDate) order by c.SummaryDate;');

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
//        return $status_of_Clients;

    }

}
