<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Region as ResourcesRegion;
use App\Http\Resources\RegionCollection;
use App\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    protected $geographicChildren = ['provinces', 'districts', 'cities'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));
        $data = Region::paginate($request->get('per_page'));

        return response()->json(new RegionCollection($data->load($children)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));

        return response()->json(new ResourcesRegion($region->load($children)));
    }
}
