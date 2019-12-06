<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMunicipality extends Model
{
    protected $fillable = ['code', 'name', 'population'];

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
     * Get all barangays of the subMunicipality
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic')->orderBy('name');
    }

    /**
     * Get the city that owns the submunicipality.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
