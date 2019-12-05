<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as ResourcesCity;
use Illuminate\Http\Request;

class CityController extends Controller
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

        return ResourcesCity::collection($data->load($children));
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

        return new ResourcesCity($city->load($children));
    }
}
