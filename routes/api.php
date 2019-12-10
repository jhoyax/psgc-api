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
    Route::get('summaries', 'SummaryController@index')->name('summaries.index');

    Route::prefix('regions')->group(function () {
        Route::get('/', 'RegionController@index')->name('regions.index');
        Route::get('{region}', 'RegionController@show')->name('regions.show');
    });

    Route::prefix('provinces')->group(function () {
        Route::get('/', 'ProvinceController@index')->name('provinces.index');
        Route::get('{province}', 'ProvinceController@show')->name('provinces.show');
    });

    Route::prefix('districts')->group(function () {
        Route::get('/', 'DistrictController@index')->name('districts.index');
        Route::get('{district}', 'DistrictController@show')->name('districts.show');
    });

    Route::prefix('cities')->group(function () {
        Route::get('/', 'CityController@index')->name('cities.index');
        Route::get('{city}', 'CityController@show')->name('cities.show');
    });

    Route::prefix('municipalities')->group(function () {
        Route::get('/', 'MunicipalityController@index')->name('municipalities.index');
        Route::get('{municipality}', 'MunicipalityController@show')->name('municipalities.show');
    });

    Route::prefix('sub-municipalities')->group(function () {
        Route::get('/', 'SubMunicipalityController@index')->name('sub_municipalities.index');
        Route::get('{subMunicipality}', 'SubMunicipalityController@show')->name('sub_municipalities.show');
    });

    Route::prefix('barangays')->group(function () {
        Route::get('/', 'BarangayController@index')->name('barangays.index');
        Route::get('{barangay}', 'BarangayController@show')->name('barangays.show');
    });
});
