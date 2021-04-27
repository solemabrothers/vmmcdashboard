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
Route::get('/daily', 'AgeGroupAchievement@Circumscissionbyweek');
Route::get('/ipnumbers','VmmcOutputandPerformance@NumbersByIp');
Route::get('/ipcategories','VmmcOutputandPerformance@Ip_Category');
Route::get('/adverseefffects','VmmcOutputandPerformance@AdverseEffects');
Route::get('/ipmechanismtargetandperformance','VmmcOutputandPerformance@IpMechanismPerfomanceandTarget');
Route::get('/districtperformance','VmmcOutputandPerformance@getIpperformnacebydistrict');
Route::get('/drilldowns','VmmcOutputandPerformance@IpMechanismdrilldowntesting');
Route::get('/devicetypeused','VmmcOutputandPerformance@deviceTypeUsed');
Route::get('/facilitynumbers', 'FacilityController@getFacilityNumbers');
Route::get('/getfilteredData', 'Controller@getfilteredData');
Route::get('/getfacilityNumbersByIp', 'RegionController@getCircurimscissedClientsinFacilityByIp');
Route::get('/categoriesByAgegroup','AgeGroupAchievement@numbersByAgeGroup');
Route::get('/dateandtime', 'DateManipulation@index');
Route::get('/connect', 'DatabaseConnection@index');
Route::get('/hivstatus','AgeGroupAchievement@hivStatusClients');
Route::get('/getInsertData','DateManipulation@getMysqlData');
Route::get('/insertdata','DateManipulation@insertdata');
Route::get('/filterdata','FilterData@index');




Route::get('/charts', function (){
    return view('');
});

Route::resource('/','Controller');
Route::resource('dateandtime','DateManipulation');
Route::resource('region', 'RegionController');
Route::resource('circumscssion','AgeGroupAchievement');
Route::resource('district','DistrictController');
Route::resource('ipz','VmmcOutputandPerformance');
Route::resource('charts', 'ChartsController');
Route::resource('facility', 'FacilityController');


