<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Province as ResourcesProvince;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
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
        $data = Province::with($children)->paginate($request->get('per_page'));

        return ResourcesProvince::collection($data);
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
        
        return new ResourcesProvince($province->load($children));
    }
}
