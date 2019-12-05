<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Barangay extends JsonResource
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
            'area_type' => $this->area_type,
            'population' => $this->population,
            $this->mergeWhen(
                isWordExist($request->get('parents'), 'show'),
                getGeographicParents($this)
            ),
        ];
    }
}
