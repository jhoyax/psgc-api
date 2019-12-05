<?php

namespace App\Http\Controllers\Api;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Resources\District as ResourcesDistrict;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    protected $geographicChildren = ['municipalities', 'cities'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));
        $data = District::paginate($request->get('per_page'));

        return ResourcesDistrict::collection($data->load($children));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));

        return new ResourcesDistrict($district->load($children));
    }
}
