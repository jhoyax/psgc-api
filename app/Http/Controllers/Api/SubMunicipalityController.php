<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubMunicipality as ResourcesSubMunicipality;
use App\SubMunicipality;
use Illuminate\Http\Request;

class SubMunicipalityController extends Controller
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
        $data = SubMunicipality::paginate($request->get('per_page'));

        return ResourcesSubMunicipality::collection($data->load($children));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubMunicipality  $subMunicipality
     * @return \Illuminate\Http\Response
     */
    public function show(SubMunicipality $subMunicipality, Request $request)
    {
        $children = arrIntersect($this->geographicChildren, $request->get('include'));

        return new ResourcesSubMunicipality($subMunicipality->load($children));
    }
}
