<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as ResourcesCity;
use App\Http\Resources\CityCollection;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    protected $geographicChildren = ['subMunicipalities', 'barangays'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));
        $data = City::paginate($request->get('per_page'));

        return response()->json(new CityCollection($data->load($children)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));

        return response()->json(new ResourcesCity($city->load($children)));
    }
}
