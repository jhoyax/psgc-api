<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = ['code', 'name', 'income_classification', 'population'];

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
