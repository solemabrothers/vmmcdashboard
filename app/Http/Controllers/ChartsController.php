<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use DB;
use Charts;
//use ConsoleTVs\Charts\Charts;

class ChartsController extends Controller
{

    public function index()
    {



        $charts = Charts::new('line','highcharts')
                  ->setTitle("My Users")
                  ->setLabels('ES','FR','RU')
            ->setValues(100,45,90)->setElementLabel('Total Users');
        return view('layout.lineCharts',['chart'=>$charts]);



}}
