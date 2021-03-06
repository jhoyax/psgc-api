<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
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
     * Get all barangays of the municipality
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
