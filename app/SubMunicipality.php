<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMunicipality extends Model
{
    protected $fillable = ['code', 'name', 'population'];

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
