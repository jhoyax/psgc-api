<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
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
     * Get all provinces of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function provinces()
    {
        return $this->morphMany(Province::class, 'geographic')->orderBy('name')->orderBy('name');
    }

    /**
     * Get all districts of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function districts()
    {
        return $this->morphMany(District::class, 'geographic')->orderBy('name')->orderBy('name');
    }

    /**
     * Get all cities of the region
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities()
    {
        return $this->morphMany(City::class, 'geographic')->orderBy('name')->orderBy('name');
    }
}
