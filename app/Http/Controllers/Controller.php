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
//       index $ips = DB::table('implementingPartner')->get();
//        $districts=DB::table('District')->get();
        $current_Date = Carbon::today();

        $numbersCircumscissedaily=DB::select('SELECT SUM(c.NumberCircumcised) As total FROM mets_vmmc.circumcision c WHERE YEARWEEK(SummaryDate)=YEARWEEK(NOW()- INTERVAL 1 WEEK)');
        $numbersHIVnegative=DB::select('SELECT SUM(c.NumberHIVNegative) as negative FROM mets_vmmc.circumcision c WHERE YEARWEEK(SummaryDate)=YEARWEEK(NOW()- INTERVAL 1 WEEK)');
        $numbersHIVpositive =DB::select('SELECT SUM(c.NumberHIVPositive) as positive FROM mets_vmmc.circumcision c WHERE YEARWEEK(SummaryDate)=YEARWEEK(NOW()- INTERVAL 1 WEEK)');

        $SeverelyAffected =DB::select('  
  SELECT SUM(c.NumberSeverePain)+ SUM(c.NumberSevereExcessiveBleeding)+SUM(c.NumberSevereSwellingHaematoma)+ 
 +SUM(c.NumberSevereAnaestheticRelatedEvent)+ SUM(c.NumberSevereExcessiveSkinRemoved)+ 
 SUM(c.NumberSevereInfection)+SUM(c.NumberSevereDamageToPenis) As ClientsAffected
  FROM mets_vmmc.circumcision c WHERE YEARWEEK(SummaryDate)=YEARWEEK(NOW() - INTERVAL 1 WEEK)');




        $monthly_data = DB::select('SELECT 
IFNULL(District_name, \'TOTAL\') AS District_name,
 SUM(IF (MONTH(c.SummaryDate) = 1, c.NumberCircumcised, 0)) AS January ,
 SUM(IF (MONTH(c.SummaryDate) = 2, c.NumberCircumcised, 0)) AS February ,
 SUM(IF (MONTH(c.SummaryDate) = 3, c.NumberCircumcised, 0)) AS March ,
 SUM(IF (MONTH(c.SummaryDate) = 4, c.NumberCircumcised, 0)) AS April ,
 SUM(IF (MONTH(c.SummaryDate) = 5, c.NumberCircumcised, 0)) AS May  ,
 SUM(IF (MONTH(c.SummaryDate) = 6, c.NumberCircumcised, 0)) AS June ,
 SUM(IF (MONTH(c.SummaryDate) = 7, c.NumberCircumcised, 0)) AS July ,
   SUM(c.NumberCircumcised) as  DistrictTotal

FROM mets_vmmc.Circumcision c, facility f, District d WHERE
  c.Facility = f.Facility AND f.district_id = d.District_ID AND YEAR(c.SummaryDate)=2018 GROUP BY f.district_id WITH ROLLUP');
        return view('layouts.index', compact('districts','ips','SeverelyAffected','monthly_data','modelObjectJson', 'numbersCircumscissedaily','numbersHIVnegative','numbersHIVpositive','clientsAffected'));
    }
    public function getfilteredData(Request $request)
    {
        $ips = DB::table('implementing_partner')->get();
        $districts=DB::table('districts')->get();
       $clientscircumscissedbyunit=0;
        $ip_name = $request->input('ip');
        $district_id=$request->input('district');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if($ip_name=='allIps')
        {
            $clients_hiv_positive_ip =DB::table('circumscission')->where('ImplementingPartner','=',$ip_name)->whereBetween('SummaryDate',[$start_date,$end_date])->sum('NumberHIVPositive');
            $clients_hiv_negative_ip=DB::table('circumscission')->where('ImplementingPartner','=',$ip_name)->whereBetween('SummaryDate',[$start_date,$end_date])->sum('NumberHIVNegative');
            $district_facilities = DB::table('facility')->where('Districts_District_ID','=',$district_id)->distinct()->get();
            for($i=0;$i<sizeof($district_facilities);$i++)
            {
                $district_facility_name = DB::table('facility')->select('Facility_name')->where('Facility_ID','=',$district_facilities[$i]->Facility_ID)->first();
                $clientscircumscissed =DB::table('circumscission')->where('Facility_Facility_ID','=',$district_facilities[$i]->Facility_ID)->whereBetween('SummaryDate',[$start_date,$end_date])->sum('NumberCircumcised');
                $facilitymodel = new AnalysisGraphs($district_facility_name,$clientscircumscissed,$district_id);
                $clientscircumscissedbyunit+=$clientscircumscissed;
                $facilitynumbers[]=$facilitymodel;

            }

        }
        elseif($district_id =='alldistricts')
        {
            $clientscircumscissedbyunit = DB::table('circumscission')->where('ImplementingPartner','=',$ip_name)->sum('NumberCircumcised');
            $clients_hiv_positive_ip =DB::table('circumscission')->where('ImplementingPartner','=',$ip_name)->sum('NumberHIVPositive');
            $clients_hiv_negative_ip=DB::table('circumscission')->where('ImplementingPartner','=',$ip_name)->sum('NumberHIVNegative');

            $facilitybyip = DB::table('circumscission')->select('Facility_Facility_Id')->where('implementingPartner','=',$ip_name)->distinct()->get();
            for($i=0;$i<sizeof($facilitybyip);$i++)
            {
                $facilityname = DB::table('facility')->select('Facility_name')->where('Facility_ID','=',$facilitybyip[$i]->Facility_Facility_Id)->first();
                $circumscission = DB::table('circumscission')->where([['Facility_Facility_ID','=',$facilitybyip[$i]->Facility_Facility_Id],['ImplementingPartner','=',$ip_name]])
                   ->whereBetween('SummaryDate',[$start_date,$end_date])->sum('NumberCircumcised');
                $facilitymodel = new AnalysisGraphs($facilityname,$circumscission,$facilitybyip[$i]->Facility_Facility_Id);
                $facilitynumbers[]=$facilitymodel;

            }
        }
        else{
            $district_facilities = DB::table('facility')->where('Districts_District_ID','=',$district_id)->distinct()->get();
            for($i=0;$i<sizeof($district_facilities);$i++)
            {
                $district_facility_name = DB::table('facility')->select('Facility_name')->where('Facility_ID','=',$district_facilities[$i]->Facility_ID)->first();
                $clients_hiv_positive_ip =DB::table('circumscission')->where([['Facility_Facility_ID','=',$district_facilities[$i]->Facility_ID],['ImplementingPartner','=',$ip_name]])->sum('NumberHIVPositive');
                $clients_hiv_negative_ip=DB::table('circumscission')->where([['Facility_Facility_ID','=',$district_facilities[$i]->Facility_ID],['ImplementingPartner','=',$ip_name]])->sum('NumberHIVNegative');
                $circumscission = DB::table('circumscission')->where([['Facility_Facility_ID','=',$district_facilities[$i]->Facility_ID],['ImplementingPartner','=',$ip_name]])
                    ->sum('NumberCircumcised');
                $facilitymodel = new AnalysisGraphs($district_facility_name,$circumscission,$district_facilities[$i]->Facility_ID);
                $facilitynumbers[]=$facilitymodel;
            }

        }

        return view('layouts.filters', compact( 'districts','ips','clientscircumscissedbyunit','clients_hiv_positive_ip','clients_hiv_negative_ip','facilitynumbers'));
    }

}
