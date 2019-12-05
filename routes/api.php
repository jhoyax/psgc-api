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
        Route::get('/', 'RegionController@index')->name('region.index');
        Route::get('{region}', 'RegionController@show')->name('region.show');
    });

    Route::prefix('provinces')->group(function () {
        Route::get('/', 'ProvinceController@index')->name('province.index');
        Route::get('{province}', 'ProvinceController@show')->name('province.show');
    });
    
    Route::prefix('districts')->group(function () {
        Route::get('/', 'DistrictController@index')->name('district.index');
        Route::get('{district}', 'DistrictController@show')->name('district.show');
    });
    
    Route::prefix('cities')->group(function () {
        Route::get('/', 'CityController@index')->name('city.index');
        Route::get('{city}', 'CityController@show')->name('city.show');
    });
    
    Route::prefix('municipalities')->group(function () {
        Route::get('/', 'MunicipalityController@index')->name('municipality.index');
        Route::get('{municipality}', 'MunicipalityController@show')->name('municipality.show');
    });
    
    Route::prefix('sub-municipalities')->group(function () {
        Route::get('/', 'SubMunicipalityController@index')->name('subMunicipality.index');
        Route::get('{subMunicipality}', 'SubMunicipalityController@show')->name('subMunicipality.show');
    });
    
    Route::prefix('barangays')->group(function () {
        Route::get('/', 'BarangayController@index')->name('barangay.index');
        Route::get('{barangay}', 'BarangayController@show')->name('barangay.show');
    });
});