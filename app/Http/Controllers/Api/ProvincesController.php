<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Province as ResourcesProvince;
use App\Http\Resources\ProvinceCollection;
use App\Province;
use Illuminate\Http\Request;

class ProvincesController extends Controller
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
        $data = Province::paginate($request->get('per_page'));

        return response()->json(new ProvinceCollection($data->load($children)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));
        
        return response()->json(new ResourcesProvince($province->load($children)));
    }
}
