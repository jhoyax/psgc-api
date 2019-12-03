<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['code', 'name', 'city_class', 'income_classification', 'population'];

    /**
     * Get all subMunicipalities of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subMunicipalities()
    {
        return $this->hasMany(SubMunicipality::class)->orderBy('name');
    }

    /**
     * Get all barangays of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangays()
    {
        return $this->hasMany(Barangay::class)->orderBy('name');
    }
}
