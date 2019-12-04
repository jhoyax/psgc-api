<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['code', 'name', 'income_classification', 'population'];

    /**
     * Get all cities of the province
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities()
    {
        return $this->morphMany(City::class, 'city');
    }

    /**
     * Get all municipalities of the province
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function municipalities()
    {
        return $this->morphMany(Municipality::class, 'municipality');
    }
}
