<?php

namespace App\Http\Controllers\Api;

use App\Barangay;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Region as ResourcesRegion;
use App\Municipality;
use App\Province;
use App\Region;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            'code' => '000000000',
            'name' => 'Philippines',
            'provinces' => Province::count(),
            'cities' => City::count(),
            'municipalities' => Municipality::count(),
            'barangays' => Barangay::count(),
        ];
    }
}
