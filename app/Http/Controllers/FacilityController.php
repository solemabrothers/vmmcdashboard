<?php

namespace App\Http\Controllers;

use App\AnalysisGraphs;
use App\Models\Facility;
use App\Models\Region;
use App\Models\District;
use Illuminate\Http\Request;
use DB;

class FacilityController extends Controller
{
    public function index()
    {
        $ip_name =1;
        $district_id=1;

            $district_facilities = DB::table('facility')->where('Districts_District_ID','=',$district_id)->distinct()->get();
            for($i=0;$i<sizeof($district_facilities);$i++)
            {
                $district_facility_name = DB::table('facility')->select('Facility_name')->where('Facility_ID','=',$district_facilities[$i]->Facility_ID)->get();
                $circumscission = DB::table('circumscission')->where([['Facility_Facility_ID','=',$district_facilities[$i]->Facility_ID],['ImplementingPartner','=',$ip_name]])
                    ->sum('NumberCircumcised');
                $facilitymodel = new AnalysisGraphs($district_facility_name,$circumscission);
                $facilitynumbers[]=$facilitymodel;
            }



        return $facilitynumbers;

    }

   public function getFacilityNumbers()
   {
       $facilitynumbers = array();
       $facilities =DB::table('facility')->get();
       foreach ($facilities as $facility)
       {
           $facilityname = DB::table('facility')->select('Facility_name')->where('Facility_ID',$facility->Facility_ID)->first();
           $circumscission = DB::table('circumscission')->where('Facility_Facility_ID','=',$facility->Facility_ID)->sum('NumberCircumcised');
           $facilitymodel = new AnalysisGraphs($facilityname,$circumscission);
           $facilitynumbers[]=$facilitymodel;
       }
      return $facilitynumbers;

   }

}
