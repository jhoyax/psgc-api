<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['code', 'name', 'city_class', 'income_class', 'population'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * Get all subMunicipalities of the city
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function subMunicipalities()
    {
        return $this->morphMany(SubMunicipality::class, 'geographic')->orderBy('name')->orderBy('name');
    }

    /**
     * Get all barangays of the city
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic')->orderBy('name');
    }

    /**
     * Get the owning geographic model.
     */
    public function geographic()
    {
        return $this->morphTo();
    }
}
