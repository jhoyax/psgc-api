<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::prefix('regions')->group(function () {
        Route::get('/', 'RegionsController@index');
        Route::get('{region}', 'RegionsController@show');
    });

    Route::prefix('provinces')->group(function () {
        Route::get('/', 'ProvincesController@index');
        Route::get('{province}', 'ProvincesController@show');
    });
    
    Route::prefix('districts')->group(function () {
        Route::get('/', 'DistrictsController@index');
        Route::get('{district}', 'DistrictsController@show');
    });
    
    Route::prefix('cities')->group(function () {
        Route::get('/', 'CitiesController@index');
        Route::get('{city}', 'CitiesController@show');
    });
    
    Route::prefix('municipalities')->group(function () {
        Route::get('/', 'MunicipalitiesController@index');
        Route::get('{municipality}', 'MunicipalitiesController@show');
    });
    
    Route::prefix('sub-municipalities')->group(function () {
        Route::get('/', 'SubMunicipalitiesController@index');
        Route::get('{subMunicipality}', 'SubMunicipalitiesController@show');
    });
    
    Route::prefix('barangays')->group(function () {
        Route::get('/', 'BarangaysController@index');
        Route::get('{barangay}', 'BarangaysController@show');
    });
});