<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['code', 'name', 'city_class', 'income_class', 'population'];

    /**
     * Get all subMunicipalities of the city
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subMunicipalities()
    {
        return $this->hasMany(SubMunicipality::class)->orderBy('name');
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
