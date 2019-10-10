<?php

namespace App\Http\Controllers;

use App\Models\Circumscission;
use App\Models\District;
use Illuminate\Http\Request;

class DatabaseConnection extends Controller
{
   public function index()
   {

               $someModel = new Circumscission();

               $someModel->setConnection('sqlsrv');

               $something = $someModel->find(1);

               return $something;



   }
}
