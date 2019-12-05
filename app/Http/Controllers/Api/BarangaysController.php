<?php

namespace App\Http\Controllers\Api;

use App\Barangay;
use App\Http\Controllers\Controller;
use App\Http\Resources\Barangay as ResourcesBarangay;
use Illuminate\Http\Request;

class BarangaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Barangay::paginate($request->get('per_page'));

        return ResourcesBarangay::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function show(Barangay $barangay)
    {
        return new ResourcesBarangay($barangay);
    }
}
