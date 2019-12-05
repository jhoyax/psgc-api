<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Province extends JsonResource
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
            'cities' => City::collection($this->whenLoaded('cities')),
            'municipalities' => Municipality::collection($this->whenLoaded('municipalities')),
            $this->mergeWhen(
                isWordExist($request->get('parents'), 'show'),
                getGeographicParents($this)
            ),
        ];
    }
}
