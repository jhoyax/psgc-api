<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
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
     * Get all cities of the district
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities()
    {
        return $this->morphMany(City::class, 'geographic')->orderBy('name');
    }

    /**
     * Get all municipalities of the district
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function municipalities()
    {
        return $this->morphMany(Municipality::class, 'geographic')->orderBy('name');
    }

    /**
     * Get the owning geographic model.
     */
    public function geographic()
    {
        return $this->morphTo();
    }
}
