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
        $data = [
            [
                'code' => '000000000',
                'name' => 'Philippines',
                'provinces' => Province::count(),
                'cities' => City::count(),
                'municipalities' => Municipality::count(),
                'barangays' => Barangay::count(),
            ],
        ];

        $regions = Region::all();
        if ($regions) {
            foreach ($regions as $region) {
                array_push($data, $this->getRegionSummary($region));
            }
        }

        return $data;
    }

    /**
     * Get Region summary
     *
     * @param  object  $item
     * @return array
     */
    protected function getRegionSummary($item)
    {
        $countCities = 0;
        $countMunicipalities = 0;
        $countBarangays = 0;

        $this->countGeographics($item->provinces, $countCities, $countMunicipalities, $countBarangays);
        $this->countGeographics($item->districts, $countCities, $countMunicipalities, $countBarangays);

        return [
            'code' => $item->code,
            'name' => $item->name,
            'provinces' => $item->provinces->count(),
            'cities' => $item->cities->count() + $countCities,
            'municipalities' => $countMunicipalities,
            'barangays' => $countBarangays,
        ];
    }

    /**
     * Count geographics
     * 
     * @param  object  $items
     * @param  integer  &$countCities
     * @param  integer  &$countMunicipalities
     * @param  integer  &$countBarangays
     */
    protected function countGeographics($items, &$countCities, &$countMunicipalities, &$countBarangays)
    {
        if ($items) {
            foreach ($items as $item) {
                $countCities += $item->cities->count();
                $countMunicipalities += $item->municipalities->count();

                if ($item->cities) {
                    foreach ($item->cities as $city) {
                        $countBarangays += $city->barangays->count();

                        if ($city->subMunicipalities) {
                            foreach ($city->subMunicipalities as $subMunicipality) {
                                $countBarangays += $subMunicipality->barangays->count();
                            }
                        }
                    }
                }

                if ($item->municipalities) {
                    foreach ($item->municipalities as $municipality) {
                        $countBarangays += $municipality->barangays->count();
                    }
                }
            }
        }
    }
}