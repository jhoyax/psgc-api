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
        ];
    }
}
