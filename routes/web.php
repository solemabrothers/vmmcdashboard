<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/region', function () {
    return view('viewregions');
});
Route::get('/facility', function () {
    return view('facilities');
});
//Route::get('/circumscissionnumbers','CircumscionPartnerController');

Route::get('/getRegionValues', 'RegionController@getDistricts');
Route::get('/daily', 'CircumscionPartnerController@Circumscissionbyweek');
Route::get('/ipnumbers','ImplementingPartnerController@NumbersByIp');
Route::get('/ipcategories','ImplementingPartnerController@Ip_Category');
Route::get('/adverseefffects','ImplementingPartnerController@AdverseEffects');
Route::get('/facilitynumbers', 'FacilityController@getFacilityNumbers');
Route::get('/getfilteredData', 'Controller@getfilteredData');
Route::get('/getfacilityNumbersByIp', 'RegionController@getCircurimscissedClientsinFacilityByIp');
Route::get('/categoriesByAgegroup','CircumscionPartnerController@numbersByAgeGroup');
Route::get('/dateandtime', 'DateManipulation@index');
Route::get('/connect', 'DatabaseConnection@index');
Route::get('/hivstatus','CircumscionPartnerController@hivStatusClients');
Route::get('/getInsertData','DateManipulation@getMysqlData');
Route::get('/insertdata','DateManipulation@insertdata');



Route::get('/charts', function (){
    return view('');
});

Route::resource('/','Controller');
Route::resource('dateandtime','DateManipulation');
Route::resource('region', 'RegionController');
Route::resource('circumscssion','CircumscionPartnerController');
Route::resource('district','DistrictController');
Route::resource('ipz','ImplementingPartnerController');
Route::resource('charts', 'ChartsController');
Route::resource('facility', 'FacilityController');

