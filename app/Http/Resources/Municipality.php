<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Municipality extends JsonResource
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
            'income_class' => $this->income_class,
            'population' => $this->population,
            $this->mergeWhen(
                isWordExist($request->get('parents'), 'show') && $request->municipality,
                getGeographicParents($this)
            ),
            'barangays' => Barangay::collection($this->whenLoaded('barangays')),
        ];
    }
}
