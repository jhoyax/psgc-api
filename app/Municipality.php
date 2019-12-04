<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = ['code', 'name', 'income_classification', 'population'];

    /**
     * Get all barangays of the municipality
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'barangay');
    }

    /**
     * Get the owning municipality model.
     */
    public function municipality()
    {
        return $this->morphTo();
    }
}
