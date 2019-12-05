<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['code', 'name', 'income_class', 'population'];

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
     * Get all cities of the province
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities()
    {
        return $this->morphMany(City::class, 'geographic')->orderBy('name');
    }

    /**
     * Get all municipalities of the province
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
