<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubMunicipality extends JsonResource
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
            'barangays' => Barangay::collection($this->whenLoaded('barangays')),
            $this->mergeWhen(
                isWordExist($request->get('parents'), 'show'),
                getGeographicParents($this)
            ),
        ];
    }
}
