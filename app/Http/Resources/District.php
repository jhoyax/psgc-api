<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class District extends JsonResource
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
            $this->mergeWhen(
                isWordExist($request->get('parents'), 'show') && $request->district,
                getGeographicParents($this)
            ),
            'cities' => City::collection($this->whenLoaded('cities')),
            'municipalities' => Municipality::collection($this->whenLoaded('municipalities')),
        ];
    }
}
