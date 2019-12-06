<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Region extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'population' => $this->population,
            'provinces' => Province::collection($this->whenLoaded('provinces')),
            'districts' => District::collection($this->whenLoaded('districts')),
            'cities' => City::collection($this->whenLoaded('cities')),
            $this->mergeWhen(
                isWordExist($request->get('summary'), 'show'),
                $this->getRegionSummary()
            ),
        ];
    }

    /**
     * Get Region summary
     *
     * @param  obj  $item
     */
    public function getRegionSummary()
    {
        $countCities = 0;
        $countMunicipalities = 0;
        $countBarangays = 0;

        $this->countGeographics($this->provinces, $countCities, $countMunicipalities, $countBarangays);
        $this->countGeographics($this->districts, $countCities, $countMunicipalities, $countBarangays);

        $summary = [
            'provinces' => $this->provinces->count(),
            'cities' => $this->cities->count() + $countCities,
            'municipalities' => $countMunicipalities,
            'barangays' => $countBarangays,
        ];

        return ['summary' => $summary];
    }

    /**
     * Count geographics
     */
    public function countGeographics($items, &$countCities, &$countMunicipalities, &$countBarangays)
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
