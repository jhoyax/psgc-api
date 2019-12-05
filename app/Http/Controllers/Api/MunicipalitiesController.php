<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Municipality as ResourcesMunicipality;
use App\Http\Resources\MunicipalityCollection;
use App\Municipality;
use Illuminate\Http\Request;

class MunicipalitiesController extends Controller
{
    protected $geographicChildren = ['barangays'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));
        $data = Municipality::paginate($request->get('per_page'));

        return response()->json(new MunicipalityCollection($data->load($children)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));

        return response()->json(new ResourcesMunicipality($municipality->load($children)));
    }
}
